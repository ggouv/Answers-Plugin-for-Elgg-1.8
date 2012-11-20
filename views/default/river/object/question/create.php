<?php

$item = $vars['item'];
$question = get_entity($item->object_guid);
$user = get_entity($question->getOwnerGUID());

$questionurl = "<a href=".$question->getURL().">".$question->title."</a>";
$userurl = "<a href=".$user->getURL().">".$user->name."</a>";
$excerpt = elgg_get_excerpt($question->description);

$summary = sprintf(elgg_echo("question:river:created"), $userurl, $questionurl);

$vars['item']->subject_guid = $user->getGUID();

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'summary' => $summary,
	'message' => $excerpt,
));