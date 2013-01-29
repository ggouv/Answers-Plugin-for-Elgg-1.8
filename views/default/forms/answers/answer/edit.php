<?php
/**
 * Edit answer form
 */

$answer = elgg_extract('entity', $vars, false);

if ($answer && elgg_is_logged_in()) {
	
	if ($container instanceof ElggGroup && !$container->canWriteToContainer()) {
		echo elgg_echo("answers:answer:mustbeingroup");
	} else {
		echo '<div>';
		echo '<label class="mbm">' . elgg_echo('answers:answer:edit') . '</label>';
		echo elgg_view('input/longtext', array('name' => 'answer_text', 'value' => $answer->description));
		echo '</div>';
		echo '<div class="elgg-foot">';
		echo elgg_view('input/hidden', array(
			'name' => 'question_guid',
			'value' => $answer->getGUID()
		));
		echo elgg_view('input/submit', array('value' => elgg_echo("save")));
		echo '</div>';
	}
}
