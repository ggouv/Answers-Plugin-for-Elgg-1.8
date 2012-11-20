<?php
/**
 * Edit answer action
 */

// Get input data
$guid = (int) get_input('answer_id');

// modified to work with ckeditor
$answer_text = get_input("answer_text{$guid}");

// Make sure we actually have permission to edit
$answer = get_entity($guid);
if ($answer && $answer->getSubtype() == "answer" && $answer->canEdit()) {
	if (empty($answer_text)) {
		register_error(elgg_echo("answers:answer:blank"));
		forward($answer->getURL());
	}
	
	$answer->description = $answer_text;

	if (!$answer->save()) {
		register_error(elgg_echo("answers:error"));
		forward($answer->getURL());
	}

	system_message(elgg_echo("answers:answer:updated"));
	forward($answer->getURL());
}

forward();
