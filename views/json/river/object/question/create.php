<?php

global $jsonexport;

$item = $vars['item'];
$question = get_entity($item->object_guid);
$user = get_entity($question->getOwnerGUID());

$questionurl = "<a href=".$question->getURL().">".$question->title."</a>";
$userurl = "<a href=".$user->getURL().">".$user->name."</a>";
$excerpt = elgg_get_excerpt($question->description);

$summary = elgg_echo("question:river:created", array($userurl, $questionurl));

$vars['item']->subject_guid = $user->getGUID();

$vars['item']->summary = $summary;
$vars['item']->message = $excerpt;

$jsonexport['activity'][] = $vars['item'];
