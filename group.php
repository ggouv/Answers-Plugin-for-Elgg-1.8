<?php
/**
 * Friends' questions
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get the current page's owner
$page_owner = elgg_get_logged_in_user_entity();

if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($_SESSION['guid']);
}
if (!($page_owner instanceof ElggEntity)) {
	forward();
}
//elgg_set_context('group_profile');
//set the title
$title = elgg_echo('answers:group:title');

elgg_register_menu_item('title', array(
	'name' => "answers:add",
	'href' => $CONFIG->wwwroot . "answers/ask/group:" . $page_owner->username . "/",
	'text' => elgg_echo("answers:add"),
	'link_class' => 'elgg-button elgg-button-action',
));
$groups = elgg_get_entities_from_relationship(array('type' => 'group',
		'relationship' => 'member',
		'relationship_guid' => $page_owner->guid,
		'inverse_relationship' => false,
		'full_view' => false,));

foreach ($groups as $group){
	$vars['entity'] = $group;
	//var_dump($vars['entity']->container_guid);
	$number = (int) $vars['entity']->num_display;
	if (!$number) {
		$number = 2;
	}

	//get the groups questions
	$options = array(
		'type' => 'object',
		'subtype' => 'question',
		'container_guid' => $vars['entity']->guid,

	);
	$questions = elgg_get_entities($options);
	$options['count'] = true;
	$count = elgg_get_entities($options);
	if ($questions) {

		//display in list mode
		foreach ($questions as $question) {
			$area2 .= elgg_view_entity($question);
		}
	} 
}
$body = elgg_view_layout("content", array('content' => $area2, 'title' => $title, 'filter_context' => 'groups'));

echo elgg_view_page(elgg_echo('answers:everyone'), $body);