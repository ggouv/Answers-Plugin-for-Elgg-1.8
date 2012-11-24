<?php
/**
 * Choose a best answer river view
 */

global $jsonexport;

$item = $vars['item'];
$answer = get_entity($item->object_guid);
$question = get_entity($item->subject_guid);
$useranswer = get_entity($answer->getOwnerGUID());
$userquestion = get_entity($question->getOwnerGUID());

$questionurl = "<a href=".$question->getURL().">".$question->title."</a>";
$userurl = "<a href=".$userquestion->getURL().">".$userquestion->name."</a>";
$excerpt = elgg_get_excerpt($answer->description);

$summary = elgg_echo("question:river:chosen", array($userurl, $questionurl));

$vars['item']->subject_guid = $useranswer->getGUID();

$vars['item']->summary = $summary;
$vars['item']->message = $excerpt;

$jsonexport['activity'][] = $vars['item'];
