<?php
/**
 * Add question river view
 */
global $jsonexport;

$object = $vars['item']->getObjectEntity();
$excerpt = strip_tags($object->description);
$excerpt = elgg_get_excerpt($excerpt, 140);

$vars['item']->summary = elgg_view('river/elements/summary', array('item' => $vars['item']), FALSE, FALSE, 'default');
$vars['item']->message = $excerpt;

$jsonexport['results'][] = $vars['item'];
