<?php
/**
 * Add answer form
 */

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
}
