<?php
/**
 * Answers helper functions
 *
 * @package Answers
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $question A question object.
 * @return array
 */
function answers_prepare_form_vars($question = null) {
	$values = array(
		'title' => get_input('search', ''),
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $question,
	);

	if ($question) {
		foreach (array_keys($values) as $field) {
			if (isset($question->$field)) {
				$values[$field] = $question->$field;
			}
		}
	}

	if (elgg_is_sticky_form('question')) {
		$sticky_values = elgg_get_sticky_values('question');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('question');

	return $values;
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
	$unsorted_actions = array();
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
			$unsorted_ratings, SORT_DESC, // @ManUtopiK I think we don't need it, $unsorted_actions is based on timestamp. What about ?
			$unsorted_answers);
	} else {
		array_multisort($unsorted_ratings, SORT_DESC,
			$unsorted_dates, SORT_ASC,
			$unsorted_answers);
	}
	
	return $unsorted_answers;
}

function answers_get_sorted_questions($owner_guid, $sort = 'newest') {
	$owner = get_entity($owner_guid);
	$params = array(
		'type' => 'object',
		'subtype' => 'question',
	);
	$container_or_owner = elgg_instanceof($owner, 'group') ? 'container_guid' : 'owner_guid';
	$params[$container_or_owner] = $owner_guid;
	$unsorted_questions = elgg_get_entities($params);

	if ($sort != 'newest') { // elgg_get_entities already filter by dates. Doesn't need array_multisort.
		$unsorted_ratings = array();
		$unsorted_actions = array();
		$unsorted_answers = array();
		foreach ($unsorted_questions as $question) {
			$unsorted_ratings[] = answers_overall_rating($question);
			$unsorted_dates[] = $question->time_created;
			$unsorted_actions[] = $question->last_action; // @todo: answer question or vote answer update question last_action ?
			$unsorted_answers[] = answers_count_question_answers($question);
		}
		
		if ($sort == 'votes') {
			array_multisort($unsorted_ratings, SORT_DESC, // most voted
				$unsorted_dates, SORT_ASC, // oldest
				$unsorted_questions);
		} else if ($sort == 'activity') {
			array_multisort($unsorted_actions, SORT_DESC, // most recently edited
				$unsorted_ratings, SORT_DESC, // most voted. @ManUtopiK I think we don't need it, $unsorted_actions is based on timestamp. What about ?
				$unsorted_questions);
		} else if ($sort == 'unanswered') { // @todo change to less answered ?
			array_multisort($unsorted_answers, SORT_ASC, // less answered
				$unsorted_ratings, SORT_DESC, // most voted. That's mind it's a popular question without answer
				$unsorted_dates, SORT_ASC, // oldest
				$unsorted_questions);
		}
	}
	
	return $unsorted_questions;
}