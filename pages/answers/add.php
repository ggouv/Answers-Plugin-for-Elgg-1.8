<?php
/**
 * Create a question
 */

$title = elgg_echo('answers:add');
elgg_push_breadcrumb($title);

$vars = answers_prepare_form_vars();
$content = elgg_view_form('answers/question', array(), $vars);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'filter' => '',
	'title' => elgg_echo('answers:question:add')
));

echo elgg_view_page(elgg_echo('answers:question:add'), $body);
