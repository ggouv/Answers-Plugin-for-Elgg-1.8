<?php
/**
 * Create a question
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

gatekeeper();
group_gatekeeper();

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	set_page_owner($_SESSION['guid']);
}

$area2 = elgg_view("answers/forms/question", array('container_guid' => elgg_get_page_owner_guid()));
//$body = elgg_view_layout('two_column_left_sidebar', '', $area2);
$body = elgg_view_layout("content", array('content' => $area2, 'filter_override' => '', 'title' => elgg_echo('answers:question:add')));

echo elgg_view_page(elgg_echo('answers:question:add'), $body);
//page_draw(elgg_echo('answers:question:add'), $body);
