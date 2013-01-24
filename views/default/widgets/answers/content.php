<?php
/**
 * Answers widget content view
 */

$content_type = $vars['entity']->content_type;

$page_owner = elgg_get_page_owner_entity();

$num = $vars['entity']->num_display;

if ($content_type == 'mine') {
	$objects = $page_owner->getObjects('question', $num);
} else if ($content_type == 'friends') {
	$objects = get_user_friends_objects($page_owner->getGUID(), 'question', $num);
} else { // site
	$options = array(
		'type' => 'object',
		'subtype' => 'question',
		'limit' => $num,
	);
	$objects = elgg_get_entities($options);
}

if (is_array($objects) && sizeof($objects) > 0) {
	foreach ($objects as $object) {
		echo elgg_view_entity($object);
	}
}
