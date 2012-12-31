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

/*
if (isset($vars['entity']) && elgg_is_logged_in()) {
	$container = get_entity($vars['entity']->container_guid);
	if ($container instanceof ElggGroup && !can_write_to_container(0, $container->getGUID())) {
		echo "<div class=\"generic_comment\">" . sprintf(elgg_echo("answers:answer:mustbeingroup"), $container->name) . "</div>";
	} else {
		$form_body = "<div class=\"contentWrapper\"><p class='longtext_editarea'><label>" . elgg_echo("answers:answer:add") . "<br />" . elgg_view('input/longtext', array('name' => 'answer_text')) . "</label></p>";
		$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'question_id', 'value' => $vars['entity']->getGUID()));
		$form_body .= elgg_view('input/submit', array('value' => elgg_echo("answers:answer:answer"))) . "</p></div>";

		echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$vars['url']}action/answer/add"));
	}
}*/
