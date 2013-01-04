<?php
/**
 * Add answer form
 */

$question = elgg_extract('entity', $vars, false);

if ($question && elgg_is_logged_in()) {
	$container = get_entity($question->container_guid);
	
	if ($container instanceof ElggGroup && !$container->canWriteToContainer()) {
		echo elgg_echo("answers:answer:mustbeingroup");
	} else {
		echo '<h3 id="add_answer" class="mbm">' . elgg_echo('answers:answer:add') . '</h3>';
		echo elgg_view('input/longtext', array('name' => 'answer_text'));
		echo elgg_view('input/hidden', array(
			'name' => 'question_id',
			'value' => $question->getGUID()
		));
		echo elgg_view('input/submit', array('value' => elgg_echo("answers:answer:answer")));
	}
}
