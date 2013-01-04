<?php
/**
 * Save a question action
 */

// Get input data
$title = get_input('title');
$description = get_input('description');
$tags = get_input('tags');
$access = get_input('access_id');
$container_guid = (int) get_input('container_guid');
$guid = (int) get_input('guid');

$user = elgg_get_logged_in_user_entity();

elgg_make_sticky_form('question');

// Make sure the title / description aren't blank
if (empty($title)) {
	register_error(elgg_echo("answers:question:blank"));
	forward(REFERER);
}

// Otherwise, save the question
if ($guid) {
	$question = get_entity($guid);
} else {
	$question = new ElggObject();
	$question->subtype = "question";
}
$question->access_id = $access;
$question->title = $title;
$question->description = $description;
$question->tags = string_to_tag_array($tags);
$question->container_guid = $container_guid;

if (!$question->save()) {
	register_error(elgg_echo("answers:question:saveerror"));
	forward(REFERER);
}

elgg_clear_sticky_form('question');

system_message(elgg_echo("answers:question:posted"));
if ($guid != 0) {
	// only add river item when this is a new question
	add_to_river('river/object/question/create', 'create', $user->guid, $question->guid);
}

forward($question->getURL());
