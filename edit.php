<?php
/**
 * Edit a question
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
gatekeeper();

// Get the current page's owner
$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid($_SESSION['guid']);
}

// Get the question if it exists
$question_id = (int) get_input('question_id');
if ($question = get_entity($question_id)) {

	if ($question->canEdit()) {
		$area2 .= elgg_view("answers/forms/question", array('entity' => $question));
	}
}

//$body = elgg_view_layout('two_column_left_sidebar', '', $area2);

$body = elgg_view_layout("content", array('content' => $area2, 'title' => elgg_echo('answers:question:edit')));

echo elgg_view_page(elgg_echo('answers:everyone'), $body);

//page_draw(elgg_echo('answers:question:edit'), $body);
