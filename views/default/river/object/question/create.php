<?php
/**
 * Add question river view
 */

$subject = $vars['item']->getSubjectEntity();
$object = $vars['item']->getObjectEntity();
$container = $object->getContainerEntity();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$object_link = elgg_view('output/url', array(
	'href' => $object->getURL(),
	'text' => $object->title,
	'class' => 'elgg-river-object',
	'is_trusted' => true,
));

$group_link = elgg_view('output/url', array(
	'href' => $container->getURL(),
	'text' => $container->name,
	'is_trusted' => true,
));
$group_string = elgg_echo('river:ingroup', array($group_link));

$excerpt = strip_tags(elgg_get_excerpt($object->description, 100));

$summary = elgg_echo("question:river:created", array($subject_link, $object_link, $group_string));

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'summary' => $summary,
	'message' => $excerpt,
));