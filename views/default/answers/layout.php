<?php
/**
 * Layout when viewing a question and its answers 
 * 
 * @uses $vars['entity'] question object
 * @uses $vars['entity'] how the answers should be sorted
 */

$question = $vars['entity'];
$sort = elgg_extract('sort', $vars, 'votes');

// Display question
$content = elgg_view_entity($question, array('full_view' => true));
	
// Display answers
$answers = get_sorted_question_answers($question, $sort);
if (is_array($answers)) {
	$chosen = '';
	$others = '';
	$chosen_answer_id = $question->chosen_answer;

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

$content .= elgg_view_form('answers/answer/save', array('class' => 'mtl'), array('entity' => $question));
$content .= '</div>';

echo $content;
