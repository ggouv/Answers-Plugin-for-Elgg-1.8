<?php
/**
 * Choose the best answer action
 */

// Get input
$answer_id = (int) get_input('answer_id');

// Let's see if we can get an entity with the specified GUID
$answer = get_entity($answer_id);
$question = get_question_for_answer($answer);
if ($question && $answer) {
	if ($question->getSubtype() == "question" && $question->canEdit()) {
		$question->chosen_answer = $answer->getGUID();

		system_message(elgg_echo("answers:answer:chosen"));
		//add to river
		add_to_river('river/object/question/choose', 'choose', $question->getGUID(), $answer->getGUID());
		//add_to_river('river/object/question/choose', 'choose', $_SESSION['user']->guid, $question->getGUID());
	} else {
		error_log("couldn't edit: " . $question->getSubtype() . ", " . $question->canEdit() . ", " . $answer->getGUID());
	}
} else {
	register_error(elgg_echo("answers:notfound"));
}

forward($question->getURL());
