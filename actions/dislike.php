<?php
/**
 * Answer voting down action
 */

// Get input
$answer_id = (int) get_input('answer_id');
$user_guid = elgg_get_logged_in_user_guid();

if ($answer = get_entity($answer_id)) {
	
	// check if the user voted to an owned answer 
	if ($answer->getOwnerGUID() == $user_guid) {
		register_error(elgg_echo("answers:liked:failure"));
		forward($answer->getURL());
	}

	// check the actual user opinion
	if (is_user_dislikes_answer($answer, $user_guid)) {
		$action_result = answers_unlike($answer, $user_guid);
	}
	else {
		$action_result = answers_dislike($answer, $user_guid);
	}
	
	if ($action_result) {
		forward($answer->getURL());
	} else {
		register_error(elgg_echo("answers:liked:failure"));
		forward($answer->getURL());
	}
} else {
	register_error(elgg_echo("answers:notfound"));
	forward("answers/");
}
