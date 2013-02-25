<?php
/**
 * View for answer object
 *
 * @package Questions
 */

$full = elgg_extract('full_view', $vars, FALSE);
$answer = elgg_extract('entity', $vars, FALSE);

if (!$answer) {
	return TRUE;
}

$answer_guid = $answer->getGUID();
$owner = $answer->getOwnerEntity();
$container = $answer->getContainerEntity();

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
	'href' => "answers/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($answer->time_created);

// The "on" status changes for comments, so best to check for !Off
if ($answer->comments_on != 'Off') {
	$comments_count = $answer->countComments();
	//only display if there are commments
	if ($comments_count != 0) {
		$text = elgg_echo("comments") . " ($comments_count)";
		$comments_link = elgg_view('output/url', array(
			'href' => "#answer-comment-$answer_guid",
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
	'entity' => $answer,
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

	$rating_block = elgg_view("answers/rating_block", $vars);

	$body = elgg_view('output/longtext', array(
		'value' => $answer->description,
		'class' => 'question-post',
	));

	$params = array(
		'entity' => $answer,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$answer_info = elgg_view_image_block($owner_icon, $summary, array('class' => 'mts'));

	$answer_comments = elgg_list_annotations(array(
		'guid' => $answer_guid,
		'annotation_name' => 'generic_comment',
		'full_view' => 'tiny',
	));

	if (elgg_is_logged_in()) {
		$answer_edit_form = elgg_view_form('answers/answer/edit', array('id' => 'edit-answer-'.$answer_guid, 'class' => 'hidden'), $vars);
		$answer_add_comment = elgg_view('answers/comment_toggle', $vars);
	}

	echo <<<HTML
<div id="elgg-object-{$answer->guid}" class="elgg-item-answer">
	$rating_block
	<div class="answer-content mbl">
		<div class="answer-output">
			$body
		</div>
		$answer_info
		$answer_edit_form
		<div id="answer-comment-$answer_guid" class="elgg-comments">
			$answer_comments
			$answer_add_comment
		</div>
	</div>
</div>
HTML;

} else {
	// brief view

	$params = array(
		'entity' => $answer,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body);
}
