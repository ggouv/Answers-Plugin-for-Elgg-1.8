<?php
/**
 * Choose a best answer river view
 */

$item = $vars['item'];
$answer = get_entity($item->object_guid);
$question = get_entity($item->subject_guid);
$useranswer = get_entity($answer->getOwnerGUID());
$userquestion = get_entity($question->getOwnerGUID());

$questionurl = "<a href=".$question->getURL().">".$question->title."</a>";
$userurl = "<a href=".$userquestion->getURL().">".$userquestion->name."</a>";
$excerpt = elgg_get_excerpt($answer->description);

$summary = sprintf(elgg_echo("question:river:chosen"), $userurl, $questionurl);

$vars['item']->subject_guid = $useranswer->getGUID();

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'summary' => $summary,
	'message' => $excerpt,
));