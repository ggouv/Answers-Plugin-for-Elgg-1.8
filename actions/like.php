<?php
/**
 * Answer voting action
 */

// Get input
$answer_id = (int) get_input('answer_id');
$ajax = get_input('ajax', false);

if ($answer = get_entity($answer_id)) {
	$owns_answer = $answer->getOwnerGUID() == $_SESSION['guid'];
	if ($owns_answer) {
		if ($ajax) {
			echo elgg_view("answers/rating_block", array('entity' => $answer));
			exit;
		} else {
			register_error(elgg_echo("answers:liked:failure"));
			forward($answer->getURL());
		}
	}

	$action_result = false;
	switch ($action) {
		case "answer/like":
			$action_result = answers_like($answer, $_SESSION['guid']);
			break;
		case "answer/dislike":
			$action_result = answers_dislike($answer, $_SESSION['guid']);
			break;
		case "answer/unlike":
			$action_result = answers_unlike($answer, $_SESSION['guid']);
			break;
	}
	if ($action_result) {
		if ($ajax) {
			echo elgg_view("answers/rating_block", array('entity' => $answer));
			exit;
		} else {
			forward($answer->getURL());
		}
	} else {
		if ($ajax) {
			echo elgg_view("answers/rating_block", array('entity' => $answer));
			echo "<div>Failed to save.</div>";
			exit;
		} else {
			register_error(elgg_echo("answers:liked:failure"));
			forward($answer->getURL());
		}
	}
} else {
	if ($ajax) {
		echo "Error.";
	} else {
		register_error(elgg_echo("answers:notfound"));
		forward("answers/");
	}
}
