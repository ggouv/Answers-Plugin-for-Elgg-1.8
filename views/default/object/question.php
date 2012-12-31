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
$excerpt = elgg_get_excerpt($question->description);

$owner_icon = elgg_view_entity_icon($owner, 'small');
$owner_link = elgg_view('output/url', array(
	'href' => "answers/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($question->time_created);

// The "on" status changes for comments, so best to check for !Off
if ($question->comments_on != 'Off') {
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

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full) {

	$body = elgg_view('output/longtext', array(
		'value' => $question->description,
		'class' => 'question-post',
	));

	$params = array(
		'entity' => $question,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$question_info = elgg_view_image_block($owner_icon, $summary, array('class' => 'mbs'));
	
	$question_comments = elgg_list_annotations(array(
		'guid' => $question->getGUID(),
		'annotation_name' => 'generic_comment',
		'full_view' => 'tiny',
	));

	if (elgg_is_logged_in()) {
		$question_add_comment = '<a rel="toggle" href="#comment-question" class="t">' . elgg_echo("generic_comments:add") . '</a>';
		$question_add_comment .= '<div id="comment-question" class="hidden">' . elgg_view_form('comments/add', '', $vars) . '</div>';
	}
		
	echo <<<HTML
<div id="elgg-object-{$question->guid}" class="elgg-item-question">
	<div class="question-left-column">$vote</div>
	<div class="question-content mbl">
		$question_info
		$body
		$question_comments
		$question_add_comment
	</div>
</div>
HTML;

} else {
	// brief view

	$params = array(
		'entity' => $question,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body);
}
