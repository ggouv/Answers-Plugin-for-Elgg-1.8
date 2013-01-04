<?php
/**
 * View a question
 */

// Get the specified question
$question_guid = (int) get_input('question_id');
$sort = get_input('sort', 'votes');

// If we can get question ...
$question = get_entity($question_guid);

$page_owner = elgg_get_page_owner_entity();

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($page_owner->name, "answers/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($page_owner->name, "answers/owner/$page_owner->username");
}

if ($question instanceof ElggEntity && $question->getSubtype() == "question") {

	// Set the title appropriately
	$title = $question->title;
	elgg_push_breadcrumb($title);
/*
	// Set the page owner
	if ($question->container_guid) {
		elgg_set_page_owner_guid($question->container_guid);
	} else {
		set_page_owner($question->owner_guid);
	}*/

	// Display question
	$content = elgg_view_entity($question, array('full_view' => true));
	
	// Display answers
	$answers = get_sorted_question_answers($question);
	if (is_array($answers)) {
		$chosen = '';
		$others = '';
		
		foreach ($answers as $answer) {
			if ($answer->getGUID() == $chosen_answer_id) {
				$chosen .= elgg_view_entity($answer, array('full_view' => true));
			} else {
				$others .= elgg_view_entity($answer, array('full_view' => true));
			}
		}
	}
	$count = count($answers);
	if ($count == 0) {
		$answers_title = '';
	} else if ($count == 1) {
		$answers_title = count($answers) .' ' . elgg_echo('answers:answer');
	} else {
		$answers_title = count($answers) .' ' . elgg_echo('answers:answers');
	}
	
	$content .= '<div class="question-answers">' . elgg_view('answers/filter_answers', array(
		'sort' => $sort,
		'title' => $answers_title
	));
	$content .= $chosen . $others;
	$content .= elgg_view_form('answers/addanswer', array('class' => 'mtl'), array('entity' => $question)) . '</div>';


	// Display through the correct canvas area
	$body = elgg_view_layout('content', array(
		'content' => $content,
		'title' => $title,
		'filter_override' => '',
		'class' => 'question-view'
	));

	// If we're not allowed to see the question
} else {

	// Display the 'post not found' page instead
	$body = elgg_view('answers/notfound');
	$title = elgg_echo('answers:notfound');
}

echo elgg_view_page($title, $body);
