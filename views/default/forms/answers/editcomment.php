<?php
/**
 * Edit comment form
 */

if (isset($vars['entity']) && elgg_is_logged_in()) {
	$comment_id = $vars['entity']->id;
	$form_body = "<div class=\"answers_add_comment_wrapper\"><p class='longtext_editarea'>";
	$form_body .= elgg_view('input/longtext', array('name' => "comment_text{$comment_id}", 'value' => $vars['entity']->value)) . "</p>";
	$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'comment_id', 'value' => $vars['entity']->id));
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo("save"))) . "</p></div>";

	echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$vars['url']}action/answers/comment/edit"));
}
