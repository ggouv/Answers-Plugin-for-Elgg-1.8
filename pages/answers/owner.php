<?php
/**
 * Owner's questions
 */

$sort = get_input('sort', 'newest');

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('answers/all');
}

elgg_push_breadcrumb($page_owner->name);

$questions = answers_get_sorted_questions($page_owner->guid, $sort);

$content = elgg_view_entity_list($questions, array(
	'full_view' => false,
	'pagination' => true,
));

if (!$content) {
	$content = elgg_echo('answers:none');
}

$title = elgg_echo('answers:owner', array($page_owner->name));

$vars = array(
	'content' => $content,
	'title' => $title,
);

if ($page_owner instanceof ElggGroup) {
	$vars['filter'] = elgg_view('answers/search_and_submit_question', array('owner' => $page_owner));
	$vars['filter'].= elgg_view('answers/filter_questions', array(
		'sort' => $sort
	));
} else {
	$vars['filter_context'] = '';
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);
