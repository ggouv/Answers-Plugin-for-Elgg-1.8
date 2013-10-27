<?php
/**
 * Add answer river view
 */

global $jsonexport;

$subject = $vars['item']->getSubjectEntity();
$object = $vars['item']->getObjectEntity();
$question = get_entity($object->question_guid);
$container = $object->getContainerEntity();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$object_link = elgg_view('output/url', array(
	'href' => $object->getURL(),
	'text' => elgg_echo('answers:river:the_answer'),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
));

$question_link = elgg_view('output/url', array(
	'href' => $question->getURL(),
	'text' => $question->title,
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

$summary = elgg_echo("question:river:answer:comment", array($subject_link, $object_link, $question_link, $group_string));

$vars['item']->summary = $summary;
$vars['item']->message = $excerpt;

$jsonexport['results'][] = $vars['item'];