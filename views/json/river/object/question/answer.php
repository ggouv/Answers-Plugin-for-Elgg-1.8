<?php
/**
 * Add answer river view
 */

global $jsonexport;

$item = $vars['item'];
$answer = get_entity($item->object_guid);
$question = get_entity($item->subject_guid);
$user = get_entity($answer->getOwnerGUID());

$timestamp = elgg_view_friendly_time($item->getPostedTime());
$questionurl = "<a href=".$question->getURL().">".$question->title."</a>";
$userurl = "<a href=".$user->getURL().">".$user->name."</a>";
$excerpt = elgg_get_excerpt($answer->description);

$summary = elgg_echo("question:river:answered", array($userurl, $questionurl));

$vars['item']->subject_guid = $user->getGUID();

$vars['item']->summary = $summary;
$vars['item']->message = $excerpt;

$jsonexport['activity'][] = $vars['item'];
