<?php
/**
 * Choose the best answer action
 */

// Get input
$answer_id = (int) get_input('answer_id');

// Let's see if we can get an entity with the specified GUID
$answer = get_entity($answer_id);
$question = answers_get_question_for_answer($answer);
if ($question && $answer) {
	if ($question->getSubtype() == "question" && $question->canEdit()) {
		$question->chosen_answer = $answer->getGUID();
		$user_guid = elgg_get_logged_in_user_guid();

		system_message(elgg_echo("answers:answer:chosen"));
		//add to river
		add_to_river('river/object/question/choose', 'update', $user_guid, $answer->getGUID()); // @ManUtopiK prefer 'update' to correspond to elgg standard.
	} else {
		register_error(elgg_echo('answers:answer:notchosen'));
	}
} else {
	register_error(elgg_echo("answers:notfound"));
}

forward($question->getURL());
