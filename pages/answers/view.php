<?php
/**
 * View a question
 */

// Get the specified question
$question_guid = (int) get_input('question_id');
$sort = get_input('sort', 'votes');

// If we can get question ...
$question = get_entity($question_guid);

$page_owner = elgg_get_page_owner_entity();

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($page_owner->name, "answers/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($page_owner->name, "answers/owner/$page_owner->username");
}

if (elgg_instanceof($question, 'object', 'question')) {

	// Set the title appropriately
	$title = $question->title;
	elgg_push_breadcrumb($title);

	$content = elgg_view('answers/layout', array(
		'entity' => $question,
		'sort' => $sort,
	));

	// Display through the correct canvas area
	$body = elgg_view_layout('content', array(
		'content' => $content,
		'title' => $title,
		'filter_override' => '',
		'class' => 'question-view'
	));

	// If we're not allowed to see the question
} else {

	// Display the 'post not found' page instead
	$body = elgg_view('answers/notfound');
	$title = elgg_echo('answers:notfound');
}

echo elgg_view_page($title, $body);
