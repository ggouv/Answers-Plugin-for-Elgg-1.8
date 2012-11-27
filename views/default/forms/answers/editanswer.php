<?php
/**
 * Edit answer form
 */

if (isset($vars['entity']) && elgg_is_logged_in()) {
	$guid = $vars['entity']->getGUID();
	$form_body = "<div class=\"contentWrapper\"><p class='longtext_editarea'>";
	$form_body .= elgg_view('input/longtext',array('name' => "answer_text{$guid}", 'value' => $vars['entity']->description)) . "</p>";
	$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'answer_id', 'value' => $guid));
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo("save"))) . "</p></div>";
		
	echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$vars['url']}action/answer/edit"));
}
