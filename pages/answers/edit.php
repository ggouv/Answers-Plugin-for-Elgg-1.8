<?php
/**
 * Edit a question
 */

gatekeeper();

$question_guid = get_input('question_guid');
$question = get_entity($question_guid);

if (!elgg_instanceof($question, 'object', 'question') || !$question->canEdit()) {
	register_error(elgg_echo('answers:unknown_question'));
	forward(REFERRER);
}

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('answers:question:edit');
elgg_push_breadcrumb($title);

$vars = answers_prepare_form_vars($question);
$content = elgg_view_form('answers/question/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title
));

echo elgg_view_page($title, $body);