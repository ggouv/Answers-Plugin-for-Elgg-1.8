<?php
/**
 * Delete question action
 */

// Get input data
$guid = (int) get_input('question_id');

// Make sure we actually have permission to edit
$question = get_entity($guid);
if ($question->getSubtype() == "question" && $question->canEdit()) {

	$owner = get_entity($question->getOwnerGUID());

	// delete related answers first
	$answers = get_question_answers($question);
	if ($answers && is_array($answers)) {
		foreach ($answers as $answer) {
			$answer->delete();
		}
	}
	// Delete it!
	$rowsaffected = $question->delete();
	if ($rowsaffected > 0) {
		system_message(elgg_echo("answers:question:deleted"));
	} else {
		register_error(elgg_echo("answers:question:notdeleted"));
	}

	forward("answers/owner/" . $owner->username);
}
