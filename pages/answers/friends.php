<?php
/**
 * Friends' questions
 */

// Get the current page's owner
$owner = elgg_get_page_owner_entity();
if (!$owner) {
	forward('answers/all');
}

elgg_push_breadcrumb($owner->name, "answers/owner/$owner->username");
elgg_push_breadcrumb(elgg_echo('friends'));

//set the title
if ($owner->getGUID() == elgg_get_logged_in_user_guid()) {
	$title = elgg_echo('answers:friends');
} else {
	$title = elgg_echo('answers:user:friends', array($owner->name));
}

// get the user's friends' questions
if (!$friends = $owner->getFriends()) {
	$content = elgg_echo('friends:none:you');
} else {
	$friendguids = array();
	foreach ($friends as $friend) {
		$friendguids[] = $friend->getGUID();
	}
	$content = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'question',
		'owner_guids' => $friendguids,
		'full_view' => false,
		'show_group' => true,
		'pagination' => true,
		'limit' => 10
	));
}

$body = elgg_view_layout("content", array(
	'content' => $content,
	'title' => $title,
	'filter_context' => 'friends',
));

echo elgg_view_page($title, $body);
