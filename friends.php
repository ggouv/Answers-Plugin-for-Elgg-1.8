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

//set the title
if ($page_owner == $_SESSION['user']) {
	$title = elgg_echo('answers:friends');
} else {
	$title = sprintf(elgg_echo('answers:user:friends'), $page_owner->name);
}
elgg_register_menu_item('title', array(
	'name' => "answers:add",
	'href' => $CONFIG->wwwroot . "answers/ask/" . $page_owner->username . "/",
	'text' => elgg_echo("answers:add"),
	'link_class' => 'elgg-button elgg-button-action',
));
// get the user's friends' questions
$area2 .= list_user_friends_objects($page_owner->getGUID(), 'question', 10, false);

//display groupquestions
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
	foreach ($page_owner->getFriends() as $friendsEntity){
		$options = array(
			'type' => 'object',
			'subtype' => 'question',
			'container_guid' => $vars['entity']->guid,
			'owner_guid' => $friendsEntity->getGUID(),
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
}

//$body = elgg_view_layout("two_column_left_sidebar", '', $area2);

$body = elgg_view_layout("content", array('content' => $area2, 'title' => $title, 'filter_context' => 'friends'));

echo elgg_view_page(elgg_echo('answers:everyone'), $body);
//page_draw(elgg_echo('answers:everyone'), $body);
