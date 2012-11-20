<?php
/**
 * Answers widget content view
 */

$content_type = $vars['entity']->content_type;

// Get the current page's owner
$page_owner = page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($page_owner->getGUID());
}

$num = $vars['entity']->num_display;

if ($content_type == 'mine') {
	$objects = $page_owner->getObjects('question', $num);
	$count = $page_owner->countObjects('question');
} else if ($content_type == 'friends') {
	$objects = get_user_friends_objects($page_owner->getGUID(), 'question', $num);
	$count = count_user_friends_objects($page_owner->getGUID(), 'question');
} else { // site
	$options = array(
		'type' => 'object',
		'subtype' => 'question',
		'limit' => $num,
	);
	$objects = elgg_get_entities($options);
	$options['count'] = true;
	$count = elgg_get_entities($options);
}

if (is_array($objects) && sizeof($objects) > 0) {
	foreach ($objects as $object) {
		echo elgg_view_entity($object);
	}
}
