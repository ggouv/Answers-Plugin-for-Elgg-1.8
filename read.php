<?php
/**
 * View a question
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get the specified question
$post = (int) get_input('question_id');

// If we can get question ...
$question = get_entity($post);

if ($question instanceof ElggEntity && $question->getSubtype() == "question") {

	// Set the page owner
	if ($question->container_guid) {
		elgg_set_page_owner_guid($question->container_guid);
	} else {
		set_page_owner($question->owner_guid);
	}

	// Display it
	//$area2 = elgg_view_title(elgg_echo("answers"));
	$area2 .= elgg_view_entity($question, array('full_view' => true));

	// Set the title appropriately
	$title = sprintf(elgg_echo("answers:question:fulltitle"), $question->title);

	// Display through the correct canvas area
	//$body = elgg_view_layout("two_column_left_sidebar", '', $area2);
	$body = elgg_view_layout("content", array('content' => $area2, 'title' => sprintf(elgg_echo("answers:question:fulltitle"), $question->title), 'filter_override' => ''));

	// If we're not allowed to see the question
} else {

	// Display the 'post not found' page instead
	$body = elgg_view("answers/notfound");
	$title = elgg_echo("answers:notfound");
}

echo elgg_view_page($title, $body);
//page_draw($title, $body);
