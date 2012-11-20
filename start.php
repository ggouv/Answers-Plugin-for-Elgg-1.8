<?php
/**
 * Questions and Answers plugin
 *
 * @author John F. Norton
 * @copyright JHU/APL 2009-2011
 */

function answers_init() {

	global $CONFIG;

	elgg_register_menu_item('site', array(
		'name' => 'answers',
		'href' => $CONFIG->wwwroot . "answers/",
		'text' => elgg_echo("answers:questions")
	));
	if (  elgg_get_context() == "answers")
		elgg_register_menu_item('filter', array(
					'name' => "answers:add",
					'href' => $CONFIG->wwwroot . "answers/group",
					'text' => elgg_echo("answers:group:filter"),
					'priority' => 500
		));
	//add_menu(elgg_echo('answers:answers'), $CONFIG->wwwroot . "answers/");
	elgg_extend_view('css', 'answers/css');

	elgg_register_widget_type('answers', elgg_echo('answers'), elgg_echo('answers:widget'));

	elgg_register_page_handler('answers', 'answers_page_handler');

	elgg_register_entity_url_handler('object', 'answer', 'answer_url');
	elgg_register_entity_url_handler('object', 'question', 'question_url');

	register_notification_object('object', 'question', elgg_echo('answers:question:new'));
	register_notification_object('object', 'answer', elgg_echo('answers:answer:new'));
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'answers_notify_message');

	// support group questions/answers
	elgg_extend_view('groups/tool_latest', 'answers/groupprofile_answers');
	
	//elgg_extend_view('object/answer', 'answers/best_answer');
	
	add_group_tool_option('answers', elgg_echo('groups:enableanswers'), true);

	// register questions and answers for search
	//elgg_register_event_handler('object', 'question');
	//elgg_register_event_handler('object', 'answer');

	elgg_register_action("question/add", $CONFIG->pluginspath . "answers/actions/addquestion.php");
	elgg_register_action("question/edit", $CONFIG->pluginspath . "answers/actions/editquestion.php");
	elgg_register_action("question/delete", $CONFIG->pluginspath . "answers/actions/deletequestion.php");

	elgg_register_action("answer/add", $CONFIG->pluginspath . "answers/actions/addanswer.php");
	elgg_register_action("answer/edit", $CONFIG->pluginspath . "answers/actions/editanswer.php");
	elgg_register_action("answer/delete", $CONFIG->pluginspath . "answers/actions/deleteanswer.php");
	elgg_register_action("answer/choose", $CONFIG->pluginspath . "answers/actions/chooseanswer.php");
	elgg_register_action("answer/like", $CONFIG->pluginspath . "answers/actions/like.php");
	elgg_register_action("answer/dislike", $CONFIG->pluginspath . "answers/actions/like.php");
	elgg_register_action("answer/unlike", $CONFIG->pluginspath . "answers/actions/like.php");

	elgg_register_action("answers/comment/add", $CONFIG->pluginspath . "answers/actions/addcomment.php");
	elgg_register_action("answers/comment/edit", $CONFIG->pluginspath . "answers/actions/editcomment.php");
	elgg_register_action("answers/comment/delete", $CONFIG->pluginspath . "answers/actions/deletecomment.php");
	
	elgg_register_css('answer', 'mod/answers/vendor/answers.css');
	elgg_load_css('answer');
	
	elgg_register_js('answers', 'mod/answers/vendor/answers.js');
	elgg_load_js('answers');
}

/**
 * Page handler for answers plugin
 *
 * @param array $page From the page_handler function
 * @return true|false Depending on success
 */
function answers_page_handler($page) {

	// what page are we serving
	if (isset($page[0]) && !empty($page[0])) {
		switch ($page[0]) {
			case "view":
				set_input('question_id', $page[1]);
				include(dirname(__FILE__) . "/read.php");
				return true;
				break;
			case "owner":
				set_input('username', $page[1]);
				include(dirname(__FILE__) . "/index.php");
				return true;
				break;
			case "friends":
				set_input('username', $page[1]);
				include(dirname(__FILE__) . "/friends.php");
				return true;
				break;
			case "ask":
				set_input('username', $page[1]);
				include(dirname(__FILE__) . "/add.php");
				return true;
				break;
			case "group":
				set_input('username', $page[1]);
				include(dirname(__FILE__) . "/group.php");
				return true;
				break;
			case "world":
			default:
				include(dirname(__FILE__) . "/everyone.php");
				return true;
				break;
		}
	} else {
		include(dirname(__FILE__) . "/everyone.php");
		return true;
	}

	return false;
}

/**
 * Setup sidebar menus
 */
function answers_pagesetup() {

	global $CONFIG;

	$page_owner = elgg_get_page_owner_entity();
	

	// Group submenu option
	if ($page_owner instanceof ElggGroup && elgg_get_context() == "groups") {
		if ($page_owner->answers_enable != "no") {
			//add_submenu_item(sprintf(elgg_echo("answers:group"), $page_owner->name), $CONFIG->wwwroot . "answers/owner/" . $page_owner->username);#
			elgg_register_menu_item('title', array(
				'name' => "answers:add",
				'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
				'text' => elgg_echo("answers:add"),
				'link_class' => 'elgg-button elgg-button-action',
			));
		}
	}

	if (elgg_get_context() == "answers") {
		if ((elgg_get_page_owner_guid() == elgg_get_logged_in_user_guid() || !elgg_get_page_owner_guid()) && elgg_is_logged_in()) {
			//add_submenu_item(elgg_echo('answers:your'), $CONFIG->wwwroot . "answers/owner/" . elgg_get_logged_in_user_entity()->username . '/');
			elgg_register_menu_item('title', array(
				'name' => "answers:add",
				'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
				'text' => elgg_echo("answers:add"),
				'link_class' => 'elgg-button elgg-button-action',
			));
			//add_submenu_item(elgg_echo('answers:friends'), $CONFIG->wwwroot . "answers/friends/" . elgg_get_logged_in_user_entity()->username . "/");
		} else if (elgg_get_page_owner_guid()) {
			//add_submenu_item(sprintf(elgg_echo('answers:user'), $page_owner->name), $CONFIG->wwwroot . "answers/owner/" . $page_owner->username . '/');
			elgg_register_menu_item('title', array(
				'name' => "answers:add",
				'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
				'text' => elgg_echo("answers:add"),
				'link_class' => 'elgg-button elgg-button-action',
			));
			if ($page_owner instanceof ElggUser) {
				//add_submenu_item(sprintf(elgg_echo('answers:user:friends'), $page_owner->name), $CONFIG->wwwroot . "answers/friends/" . $page_owner->username . "/");
				elgg_register_menu_item('page', array(
					'name' => 'answers:friends',
					'href' => $CONFIG->wwwroot . "answers/friends/" . $page_owner->username . "/",
					'text' => sprintf(elgg_echo('answers:user:friends'), $page_owner->name),
					'priority' => 200
				));
			}
		}
		
			
		//add_submenu_item(elgg_echo('answers:everyone'), $CONFIG->wwwroot . "answers/world/");

		if ($page_owner instanceof ElggGroup && can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) {
			//add_submenu_item(sprintf(elgg_echo('answers:question:groupadd'), $page_owner->name), $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/");
			elgg_register_menu_item('title', array(
				'name' => "answers:add",
				'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
				'text' => elgg_echo("answers:add"),
				'link_class' => 'elgg-button elgg-button-action',
			));
		} else if (!($page_owner instanceof ElggGroup) && elgg_is_logged_in()) {
			//add_submenu_item(elgg_echo('answers:question:add'), $CONFIG->wwwroot . "answers/ask/" . elgg_get_logged_in_user_entity()->username . "/");
			elgg_register_menu_item('title', array(
				'name' => "answers:add",
				'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
				'text' => elgg_echo("answers:add"),
				'link_class' => 'elgg-button elgg-button-action',
			));
		}
		
	}
}

/**
 * Override the answer object URL
 *
 * @param ElggEntity $answer
 * @return string
 */
function answer_url($answer) {
	$question = get_question_for_answer($answer);
	if ($question) {
		return $question->getURL() . "#" . $answer->getGUID();
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

	global $CONFIG;
	$title = $question->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "answers/view/" . $question->getGUID() . "/" . $title;
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
	//hw: right usage?
	return elgg_get_annotations(array('guid' => $answer->getGUID(), 'annotation_name' => 'like', 'count' => true));
	//return count_annotations($answer->getGUID(), "", "", "like");
	
}

/**
 * Get the number of people that like an answer
 *
 * @param ElggObject $answer
 * @return int
 */
function answers_count_dislikes($answer) {
	return elgg_get_annotations(array('guid' => $answer->getGUID(), 'annotation_name' => 'dislike', 'count' => true));
	//return count_annotations($answer->getGUID(), "", "", "dislike");
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

/**
 * Get whether a user likes/dislikes/ or is neutral about an answer
 *
 * @param <type> $answer
 * @param <type> $user_guid
 * @return <type>
 */
function answers_get_like_dislike($answer, $user_guid) {
	//$likes = elgg_get_annotation_from_id($answer->getGUID(), "", "", "like", "", $user_guid);
	$likes = elgg_get_annotations(array('guid' => $answer->getGUID(), 'annotation_name' => 'like', 'annotation_owner_guids' => $user_guid));
	if (is_array($likes) && count($likes) > 0) {
		return 'like';
	}
	//$dislikes = elgg_get_annotation_from_id($answer->getGUID(), "", "", "dislike", "", $user_guid);
	$dislikes = elgg_get_annotations(array('guid' => $answer->getGUID(), 'annotation_name' => 'dislike', 'annotation_owner_guids' => $user_guid));
	if (is_array($dislikes) && count($dislikes) > 0) {
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
	$annotations = elgg_get_annotations(array('guid' => $answer->getGUID(), 'annotation_owner_guids' => $user_guid));
	//$annotations = get_annotations($answer->getGUID(), "", "", "", "", $user_guid);
	
	if (is_array($annotations)) {
		foreach ($annotations as $anno) {
			$name = $anno->name;
			if ($name == "like" || $name == "dislike")
				$anno->delete();
		}
	}
}

function count_question_answers($question) {
	$options = array(
		'relationship' => 'answer',
		'relationship_guid' => $question->getGUID(),
		'count' => true,
	);
	return elgg_get_entities_from_relationship($options);
}

function get_question_answers($question) {
	$options = array(
		'relationship' => 'answer',
		'relationship_guid' => $question->getGUID(),
		'limit' => 0,
	);
	return elgg_get_entities_from_relationship($options);
}

function get_sorted_question_answers($question) {
	$unsorted_answers = get_question_answers($question);

	$unsorted_ratings = array();
	$unsorted_dates = array();
	foreach ($unsorted_answers as $answer) {
		$unsorted_ratings[] = answers_overall_rating($answer);
		$unsorted_dates[] = $answer->time_created;
	}

	array_multisort($unsorted_ratings, SORT_DESC,
			$unsorted_dates, SORT_ASC,
			$unsorted_answers);

	return $unsorted_answers;
}

function get_question_for_answer($answer) {
	if ($answer->question_guid) {
		$question = get_entity($answer->question_guid);
		if ($question) {
			return $question;
		}
	}

	$questions = get_entities_from_relationship("answer", $answer->getGUID(), true);
	if (count($questions) > 0) {
		return $questions[0];
	} else {
		return false;
	}
}

function answers_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$method = $params['method'];

	if ($entity instanceof ElggEntity) {
		$subtype = $entity->getSubtype();
		if ($subtype == 'question' || $subtype == 'answer') {

			$descr = $entity->description;
			$owner = $entity->getOwnerEntity();

			$ret = array();
			$ret['body'] = $descr;

			if ($subtype == 'answer') { // answer
				$question = get_question_for_answer($entity);
				$ret['subject'] = sprintf(elgg_echo('answers:notify:answer:subject'),
						$owner->name, $question->title);
			} else { // question
				$ret['subject'] = sprintf(elgg_echo('answers:notify:question:subject'),
						$owner->name, $entity->title);
			}

			$link = sprintf(elgg_echo('answers:notify:body'),
					elgg_echo("answers:$subtype"), $entity->getURL());

			$ret['body'] = $ret['subject'] . "\n\n" . $ret['body'] . "\n\n\n" . $link;
			return $ret;
		}
	}
	return null;
}

function answers_notify_comment($object, $comment_text, $commenter) {
	global $CONFIG;

	// find interested users
	// - question owner
	// - if commenting on answer, answer owner
	// - should these be added, too?
	//   - other answers owners
	//   - other commenters
	//   - followers of the commenter
	//   - group members (if group question)

	$commenter_guid = $commenter->guid;
	$interested_users = array();

	$question = $object;
	$answer = null;
	$subtype = $object->getSubtype();
	if ($subtype == 'answer') {
		$answer = $object;
		$question = get_question_for_answer($answer);
	}

	if ($question->owner_guid != $commenter_guid) {
		$interested_users[] = $question->owner_guid;
	}
	if ($answer && $answer->owner_guid != $commenter_guid) {
		$interested_users[] = $answer->owner_guid;
	}

	$interested_users = array_unique($interested_users);

	$email_subject = sprintf(elgg_echo('answers:' . $subtype . ':comment:email:subject'), $question->title);
	$email_body = sprintf(elgg_echo('answers:' . $subtype . ':comment:email:body'),
					$commenter->name,
					$question->title,
					$comment_text,
					$object->getURL(),
					$commenter->getURL()
	);
	foreach ($interested_users as $user_guid) {
		$user = get_user($user_guid);
		notify_user($user_guid, $commenter_guid, $email_subject, $email_body);
	}
}

function answers_can_edit_comment($comment) {
	return ($comment->owner_guid == $_SESSION["guid"] || elgg_is_admin_logged_in());
}

elgg_register_event_handler('init', 'system', 'answers_init');
//elgg_register_event_handler('pagesetup', 'system', 'answers_pagesetup');
