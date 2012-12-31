<?php
/**
 * Owner's questions
 */

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('answers/all');
}

elgg_push_breadcrumb($page_owner->name);

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'container_guid' => $page_owner->guid,
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

if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
	$vars['filter_context'] = 'mine';
}

if ($page_owner->type == 'group') {
	$vars['filter'] = '';
}
$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);
