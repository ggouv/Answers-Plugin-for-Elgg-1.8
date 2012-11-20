<?php
/**
 * Add a new question action
 */

// Get input data
$title = get_input('questiontitle');
$body = get_input('questiondetails');
$tags = get_input('questiontags');
//$access = get_input('access_id');
$user = $_SESSION['user']->getGUID();
$container_guid = (int) get_input('container_guid', 0);

// Convert string of tags into a preformatted array
$tagarray = string_to_tag_array($tags);

// Make sure the title / description aren't blank
if (empty($title)) {
	register_error(elgg_echo("answers:question:blank"));
	forward("mod/answers/add.php");

	// Otherwise, save the question
} else {

	$question = new ElggObject();
	$question->subtype = "question";
	//$question->access_id = $access;
	$question->access_id = ACCESS_PUBLIC;
	$question->title = $title;
	$question->description = $body;

	// check if user can add question to group
	if ($container_guid && $container_guid != $_SESSION['guid']) {
		$question->container_guid = $container_guid;
		$group = get_entity($container_guid);
		if (!($group instanceof ElggGroup)) {
			forward();
		}
		if (!can_write_to_container($_SESSION['guid'], $container_guid)) {
			forward();
		}

		if ($group->content_access == ACCESS_PRIVATE) {
			$question->access_id = $group->group_acl;
		}
	}

	if (!$question->save()) {
		register_error(elgg_echo("answers:question:saveerror"));
		forward("mod/answers/add.php");
	}

	if (is_array($tagarray)) {
		$question->tags = $tagarray;
	}

	// Success message
	system_message(elgg_echo("answers:question:posted"));
	// add to river
	add_to_river('river/object/question/create', 'create', $_SESSION['user']->guid, $question->guid);

	forward($question->getURL());
}
