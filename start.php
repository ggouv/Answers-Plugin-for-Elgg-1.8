<?php
/**
 * Questions and Answers plugin
 *
 * @author John F. Norton
 * @copyright JHU/APL 2009-2011
 */

elgg_register_event_handler('init', 'system', 'answers_init');

function answers_init() {

	// register a library of helper functions
	$root = dirname(__FILE__);
	elgg_register_library('answers:utilities', "$root/lib/answers.php");
	
	// Add a menu item to the main site menu
	$item = new ElggMenuItem('answers', elgg_echo('answers:questions'), 'answers/all');
	elgg_register_menu_item('site', $item);

	// Extend css and js
	elgg_extend_view('css/elgg', 'answers/css');
	elgg_extend_view('js/elgg', 'answers/js');

	elgg_register_widget_type('answers', elgg_echo('answers'), elgg_echo('answers:widget'));

	elgg_register_page_handler('answers', 'answers_page_handler');

	elgg_register_entity_url_handler('object', 'answer', 'answer_url');
	elgg_register_entity_url_handler('object', 'question', 'question_url');

	register_notification_object('object', 'question', elgg_echo('answers:question:new'));
	register_notification_object('object', 'answer', elgg_echo('answers:answer:new'));
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'answers_notify_message');

	// support group questions/answers
	elgg_extend_view('groups/tool_latest', 'answers/group_module');	
	add_group_tool_option('answers', elgg_echo('groups:enableanswers'), true);

	// register questions and answers for search
	elgg_register_entity_type('object', 'question'); // on enregistre les objets que l'on veux pouvoir trouver par la recherche ou voir dans les colonnes du deck.
	elgg_register_entity_type('object', 'answer');
	
	// register actions. Les actions sont dans le dossier actions/answers. C'est mieux si on veut les overrider.
	$action_path = "$root/actions/answers";
	elgg_register_action("answers/question/save", "$action_path/question/save.php");

	elgg_register_action("answers/answer/save", "$action_path/answer/save.php");
	elgg_register_action("answer/edit", "$action_path/editanswer.php");
	elgg_register_action("answers/delete", "$action_path/delete.php");
	elgg_register_action("answer/choose", "$action_path/chooseanswer.php");
	elgg_register_action("answer/like", "$action_path/like.php");
	elgg_register_action("answer/dislike", "$action_path/dislike.php");

	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'answers_owner_block_menu');
}

/**
* Dispatcher for answers.
 *
 * URLs take the form of
 *  All questions:         answers/all
 *  User's questions:      answers/owner/<username>
 *  Friends' questions:    answers/friends/<username>
 *  View questions:        answers/view/<guid>/<title>
 *  New questions:         answers/add/<guid> (container: user, group, parent)
 *  Edit questions:        answers/edit/<guid>
 *  Group questions:       answers/group/<guid>/all
 *
 * Title is ignored
 * @param array $page From the page_handler function
 * @return true|false Depending on success
 */
function answers_page_handler($page) {

	elgg_load_library('answers:utilities');
	
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
	
	elgg_push_breadcrumb(elgg_echo('answers'), 'answers/all');

	$pages = dirname(__FILE__) . '/pages/answers';

	switch ($page[0]) {
		case "read":
		case "view":
			set_input('question_id', $page[1]);
			include "$pages/view.php";
			break;
		case "owner":
			include	"$pages/owner.php";
			break;
		case "friends":
			include	"$pages/friends.php";
			break;
		case "add":
			gatekeeper();
			include	"$pages/add.php";
			break;
		case "edit":
			set_input('question_guid', $page[1]);
			gatekeeper();
			include	"$pages/edit.php";
			break;
		case "group":
			group_gatekeeper();
			include	"$pages/owner.php";
			break;
		case "all":
		case "world":
			include	"$pages/world.php";
			break;
		default:
			return false;
			break;
	}

	return true;
}

/**
 * Add a menu item to an ownerblock
 * 
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function answers_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "answers/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('answers', elgg_echo('answers'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->answers_enable != 'no') {
			$url = "answers/group/{$params['entity']->guid}";
			$item = new ElggMenuItem('answers', elgg_echo('answers:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}



/**
 * Override the answer object URL
 *
 * @param ElggEntity $answer
 * @return string
 */
function answer_url($answer) {
	$question = answers_get_question_for_answer($answer);
	if ($question) {
		return $question->getURL() . "#elgg-object-" . $answer->getGUID();
	} else {
		return '';
	}
}

/**
 * Override the default URL for question object
 *
 * @param ElggEntity $question
 * @return string
 */
function question_url($question) {
	$title = $question->title;
	$title = elgg_get_friendly_title($title);
	return elgg_get_site_url() . "answers/view/" . $question->getGUID() . "/" . $title;
}

/**
 * Get the rating for an answer
 *
 * @param ElggObject $answer
 * @return int
 */
function answers_overall_rating($answer) {
	return answers_count_likes($answer) - answers_count_dislikes($answer);
}

/**
 * Get the number of people that like an answer
 *
 * @param ElggObject $answer
 * @return int
 */
function answers_count_likes($answer) {
	return elgg_get_annotations(array(
		'guid' => $answer->getGUID(),
		'annotation_name' => 'like',
		'count' => true,
	));
}

/**
 * Get the number of people that like an answer
 *
 * @param ElggObject $answer
 * @return int
 */
function answers_count_dislikes($answer) {
	return elgg_get_annotations(array(
		'guid' => $answer->getGUID(),
		'annotation_name' => 'dislike',
		'count' => true,
	));
}

/**
 * Vote for an answer
 *
 * @param ElggObject $answer
 * @param int        $user_guid
 * @return bool
 */
function answers_like($answer, $user_guid) {
	answers_clear_like_dislike($answer, $user_guid);
	$result = $answer->annotate("like", 1, ACCESS_PUBLIC, $user_guid);
	return (bool)$result;
}

/**
 * Vote down an answer
 *
 * @param ElggObject $answer
 * @param int        $user_guid
 * @return bool
 */
function answers_dislike($answer, $user_guid) {
	answers_clear_like_dislike($answer, $user_guid);
	$result = $answer->annotate("dislike", 1, ACCESS_PUBLIC, $user_guid);
	return (bool)$result;
}

/**
 * Remove a vote for an answer
 *
 * @param ElggObject $answer
 * @param int $user_guid
 * @return bool
 */
function answers_unlike($answer, $user_guid) {
	answers_clear_like_dislike($answer, $user_guid);
	return true;
}

function answers_does_user_like_answer($answer, $user_guid) {
	$likes = elgg_get_annotations(array(
		'guid' => $answer->getGUID(),
		'annotation_name' => 'like',
		'annotation_owner_guids' => $user_guid,
	));
	if (is_array($likes) && count($likes) > 0) {
		return 'like';
	}

	return false;
}

function answers_does_user_dislike_answer($answer, $user_guid) {
	$dislikes = elgg_get_annotations(array(
		'guid' => $answer->getGUID(),
		'annotation_name' => 'dislike',
		'annotation_owner_guids' => $user_guid,
	));
	if (is_array($dislikes) && count($dislikes) > 0) {
		return 'dislike';
	}

	return false;
}

/**
 * Get whether a user likes/dislikes/ or is neutral about an answer
 *
 * @param <type> $answer
 * @param <type> $user_guid
 * @return <type>
 */
function answers_get_like_dislike($answer, $user_guid) {
	if (answers_does_user_like_answer($answer, $user_guid)) {
		return 'like';
	}
	if (answers_does_user_dislike_answer($answer, $user_guid)) {
		return 'dislike';
	}
	return false;
}

/**
 * Clear votes on this answer for this user
 *
 * @param <type> $answer
 * @param <type> $user_guid
 */
function answers_clear_like_dislike($answer, $user_guid) {
	$annotations = elgg_get_annotations(array(
		'guid' => $answer->getGUID(),
		'annotation_owner_guids' => $user_guid,
	));
	
	if (is_array($annotations)) {
		foreach ($annotations as $anno) {
			$name = $anno->name;
			if ($name == "like" || $name == "dislike")
				$anno->delete();
		}
	}
}

function answers_count_question_answers($question) {
	$options = array(
		'relationship' => 'answer',
		'relationship_guid' => $question->getGUID(),
		'count' => true,
	);
	return elgg_get_entities_from_relationship($options);
}

function answers_get_question_answers($question) {
	$options = array(
		'relationship' => 'answer',
		'relationship_guid' => $question->getGUID(),
		'limit' => 0, // @todo Should enable pagination ?
	);
	return elgg_get_entities_from_relationship($options);
}

function answers_get_sorted_question_answers($question, $sort = 'votes') {
	$unsorted_answers = answers_get_question_answers($question);

	$unsorted_ratings = array();
	$unsorted_dates = array();
	foreach ($unsorted_answers as $answer) {
		$unsorted_ratings[] = answers_overall_rating($answer);
		$unsorted_dates[] = $answer->time_created;
		$unsorted_actions[] = $answer->last_action;
	}
	
	if ($sort == 'oldest') {
		array_multisort($unsorted_dates, SORT_DESC,
			$unsorted_ratings, SORT_DESC,
			$unsorted_answers);
	} else if ($sort == 'active') {
		array_multisort($unsorted_actions, SORT_DESC,
			$unsorted_ratings, SORT_DESC,
			$unsorted_answers);
	} else {
		array_multisort($unsorted_ratings, SORT_DESC,
			$unsorted_dates, SORT_ASC,
			$unsorted_answers);
	}
	
	return $unsorted_answers;
}

function answers_get_question_for_answer($answer) {
	if ($answer->question_guid) {
		$question = get_entity($answer->question_guid);
		if ($question) {
			return $question;
		}
	}
}

function answers_notify_message($hook, $type, $result, $params) {
	$entity = $params['entity'];

	if (elgg_instanceof($entity, 'object')) {
		$subtype = $entity->getSubtype();
		if ($subtype == 'question' || $subtype == 'answer') {

			$descr = $entity->description;
			$owner = $entity->getOwnerEntity();

			$ret = array();

			if ($subtype == 'answer') {
				$question = answers_get_question_for_answer($entity);
				$subject = elgg_echo('answers:notify:answer:subject', array(
					$owner->name,
					$question->title,
				));
			} else {
				$subject = elgg_echo('answers:notify:question:subject', array(
					$owner->name, 
					$entity->title,
				));
			}

			$link = elgg_echo('answers:notify:body', array(
						elgg_echo("answers:$subtype"),
						$entity->getURL()
					));

			return $subject . "\n\n" . $descr . "\n\n\n" . $link;
		}
	}
	return null;
}
