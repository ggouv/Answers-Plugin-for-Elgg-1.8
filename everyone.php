<?php
/**
 * All site questions
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get the current page's owner
$page_owner = elgg_get_logged_in_user_entity();
elgg_set_page_owner_guid($page_owner->guid);

//$area2 = elgg_view_title(elgg_echo("answers") . ": " . elgg_echo('answers:everyone'));

$area2 = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'full_view' => false,
));
$containerEntity = get_entity($page_owner->container_guid );

//elgg_register_title_button();
elgg_register_menu_item('title', array(
	'name' => "answers:add",
	'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
	'text' => elgg_echo("answers:add"),
	'link_class' => 'elgg-button elgg-button-action',
));
//$body = elgg_view_layout("two_column_left_sidebar", '', $area2);
$body = elgg_view_layout("content", array('content' => $area2, 'title' => elgg_echo('answers:everyone')));

echo elgg_view_page(elgg_echo('answers:everyone'), $body);
//page_draw(elgg_echo('answers:everyone'), $body);
