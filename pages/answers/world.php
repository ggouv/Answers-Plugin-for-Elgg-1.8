<?php
/**
 * All site questions
 */

// Get the current page's owner
$page_owner = elgg_get_logged_in_user_entity();
elgg_set_page_owner_guid($page_owner->guid);

$area2 = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'full_view' => false,
	'show_group' => true,
));
$containerEntity = get_entity($page_owner->container_guid );

$body = elgg_view_layout("content", array('content' => $area2, 'title' => elgg_echo('answers:everyone')));

echo elgg_view_page(elgg_echo('answers:everyone'), $body);
