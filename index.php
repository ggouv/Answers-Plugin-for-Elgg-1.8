<?php
/**
 * User or group's questions
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($_SESSION['guid']);
}

// set page title
if ($page_owner == $_SESSION['user']) {
	$title = elgg_echo('answers:your');
} else {
	$title = sprintf(elgg_echo('answers:user'), $page_owner->name);
}


$area2 .= elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'owner_guid' => $page_owner->getGUID(),
	'full_view' => false,
));

elgg_register_menu_item('title', array(
	'name' => "answers:add",
	'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
	'text' => elgg_echo("answers:add"),
	'link_class' => 'elgg-button elgg-button-action',
));

//$body = elgg_view_layout("two_column_left_sidebar", '', $area2);
$body = elgg_view_layout("content", array('content' => $area2, 'title' => $title, 'filter_context' => 'mine'));

echo elgg_view_page(sprintf(elgg_echo('answers:user'), $page_ownewr->name), $body);
//page_draw(sprintf(elgg_echo('answers:user'), $page_owner->name), $body);
