<?php
/**
 * Generic delete action for questions and answers
 */

$guid = (int) get_input('guid');
$entity = get_entity($guid);

if (!$entity->canEdit()) {
	// @todo
	register_error();
	forward();
}

if (elgg_instanceof($entity, 'object', 'question')) {
	$owner = $entity->getOwnerEntity();
	$forward_url = 'answers/owner/' . $owner->username;
	$answers = answers_get_question_answers($entity);
	if ($answers && is_array($answers)) {
		foreach ($answers as $answer) {
			$answer->delete();
		}
	}	
} else if (elgg_instanceof($entity, 'object', 'answer')) {
	$question = answers_get_question_for_answer($entity);
	$forward_url = $question->getURL();
} else {
	// @todo
	register_error();
	forward();	
}

$rowsaffected = $entity->delete();
if ($rowsaffected > 0) {
	system_message(elgg_echo("answers:deleted"));
} else {
	register_error(elgg_echo("answers:notdeleted"));
}

forward($forward_url);
