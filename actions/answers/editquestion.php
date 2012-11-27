<?php
/**
 * Edit question action
 */

// Get input data
$guid = (int) get_input('question_id');
$title = get_input('questiontitle');
$body = get_input('questiondetails');
$tags = get_input('questiontags');
$access = get_input('access_id');

// Make sure we actually have permission to edit
$question = get_entity($guid);
if ($question->getSubtype() == "question" && $question->canEdit()) {

	// Convert string of tags into a preformatted array
	$tagarray = string_to_tag_array($tags);

	// Make sure the title / description aren't blank
	if (empty($title)) {
		register_error(elgg_echo("answers:blank"));
		forward("mod/answers/edit.php?question_id=" . $guid);

		// Otherwise, save the answer post
	} else {

		// Get owning user
		$owner = get_entity($question->getOwner());
		//$question->access_id = $access;
		// Set its title and description appropriately
		$question->title = $title;
		$question->description = $body;
		// Before we can set metadata, we need to save the question post
		if (!$question->save()) {
			register_error(elgg_echo("answers:error"));
			forward("mod/answers/edit.php?question_id=" . $guid);
		}
		// Now let's add tags. We can pass an array directly to the object property! Easy.
		$question->clearMetadata('tags');
		if (is_array($tagarray)) {
			$question->tags = $tagarray;
		}

		// Success message
		system_message(elgg_echo("answers:question:updated"));

		// Forward to the main answer page
		forward($question->getURL());
	}
}
