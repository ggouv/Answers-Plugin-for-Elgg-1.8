<?php
/**
 * Friends' questions
 */

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('answers/all');
}

elgg_push_breadcrumb($page_owner->name, "answers/owner/$page_owner->username");
elgg_push_breadcrumb(elgg_echo('friends'));

//set the title
if ($page_owner == $_SESSION['user']) {
	$title = elgg_echo('answers:friends');
} else {
	$title = sprintf(elgg_echo('answers:user:friends'), $page_owner->name);
}
elgg_register_title_button();
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
