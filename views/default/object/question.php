<?php
/**
 * View for question objects
 *
 * @package Questions
 */

$full = elgg_extract('full_view', $vars, FALSE);
$question = elgg_extract('entity', $vars, FALSE);

if (!$question) {
	return TRUE;
}

$owner = $question->getOwnerEntity();
$container = $question->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

$owner_icon = elgg_view_entity_icon($owner, 'small');
$owner_link = elgg_view('output/url', array(
	'href' => "answers/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($question->time_created);

$comments_count = $question->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $question->getURL() . '#comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $question,
	'handler' => 'answers',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

$params = array(
	'entity' => $question,
	'title' => false,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
);
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full === true) {

	$rating_block = elgg_view("answers/rating_block", $vars);

	$body = elgg_view('output/longtext', array(
		'value' => $question->description,
		'class' => 'question-post',
	));

	$question_info = elgg_view_image_block($owner_icon, $summary, array('class' => 'mbs'));
	
	$question_comments = elgg_list_annotations(array(
		'guid' => $question->getGUID(),
		'annotation_name' => 'generic_comment',
		'full_view' => 'tiny'
	));

	if (elgg_is_logged_in()) {
		$question_add_comment = elgg_view('answers/comment_toggle', $vars);
	}
		
	echo <<<HTML
<div id="elgg-object-{$question->guid}" class="elgg-item-question">
	$rating_block
	<div class="question-content mbl">
		$question_info
		$body
		<div id="comments">
			$question_comments
			$question_add_comment
		</div>
	</div>
</div>
HTML;

} else {
	// brief view
	elgg_load_library('answers:utilities'); // need it for brief view in group module
	
	$score = answers_overall_rating($question);
	if ($score > 1) {
		$score_text = elgg_echo('answers:score:more');
	} else {
		$score_text = elgg_echo('answers:score:one');
	}
	
	$num_answers = answers_count_question_answers($question);
	if ($num_answers > 1) {
		$answers_text = elgg_echo('answers:answers');
	} else {
		$answers_text = elgg_echo('answers:answer');
	}
	
	$rating_block = <<<HTML
<div class="rating-block float center">
	<div class="briefscore">
		<div class="pvs">$score</div>
		$score_text
	</div>
	<div class="answers">
		<div>$num_answers</div>
		$answers_text
	</div>
</div>
HTML;

	$title_link = elgg_view('output/url', array(
		'text' => $question->title,
		'href' => $question->getURL(),
	));
	
	if ( $full != 'searched') {
		$content = elgg_get_excerpt($question->description, '300');
	} else {
		$content = $question->description;
	}

	echo <<<HTML
<div id="elgg-object-{$question->guid}" class="elgg-item-question">
	$rating_block
	<div class="question-content mts">
		<h3>$title_link</h3>
		$content
		$summary
	</div>
</div>
HTML;

}
