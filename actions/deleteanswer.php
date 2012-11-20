<?php
/**
 * Delete answer action
 */

// Get input data
$guid = (int) get_input('answer_id');

// Make sure we actually have permission to edit
$answer = get_entity($guid);
if ($answer->getSubtype() == "answer" && $answer->canEdit()) {

	$question = get_question_for_answer($answer);

	$rowsaffected = $answer->delete();
	if ($rowsaffected > 0) {
		system_message(elgg_echo("answers:answer:deleted"));
	} else {
		register_error(elgg_echo("answers:answer:notdeleted"));
	}

	forward($question->getURL());
}
