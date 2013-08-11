<?php
/**
 * Add answer form
 */

$question = elgg_extract('entity', $vars, false);

if ($question && elgg_is_logged_in()) {
	$container = get_entity($question->container_guid);

	if ($container instanceof ElggGroup && !$container->canWriteToContainer()) {
		echo elgg_echo("answers:answer:mustbeingroup", array($container->name));
	} else {
		echo '<div>';
		echo '<label id="add_answer" class="mbm">' . elgg_echo('answers:answer:add') . '</label>';
		echo elgg_view('input/longtext', array('name' => 'answer_text'));
		echo '</div>';
		echo '<div>';
		echo elgg_view('input/hidden', array(
			'name' => 'question_guid',
			'value' => $question->getGUID()
		));
		echo elgg_view('input/submit', array('value' => elgg_echo("answers:answer:answer")));
		echo '</div>';
	}
}
