<?php
/**
 * Summary view for a question
 *
 * Called from object/question
 */

$owner = $vars['entity']->getOwnerEntity();
$container = get_entity($vars['entity']->container_guid);
$friendlytime = elgg_view_friendly_time($vars['entity']->time_created);
$icon = elgg_view_entity_icon($owner, 'small');
/*$icon = elgg_view("profile/icon", array(
			'entity' => $owner,
			'size' => 'small',
		));*/
$count_answers = count_question_answers($vars['entity']);
$info = "<p>".elgg_echo('answers:question').": <a href=\"{$vars['entity']->getURL()}\">{$vars['entity']->title}</a></p>";
//$info .= "<p class=\"owner_timestamp\">{$friendlytime} ({$count_answers} answer" . ($count_answers == 1 ? "" : "s") . ($vars['entity']->chosen_answer ? " - resolved" : "") . ")</p>";
$info .= "<p class=\"owner_timestamp\"><a href=\"{$vars['url']}answers/owner/{$owner->username}/\">{$owner->name}</a> {$friendlytime}";
if ($count_answers)
	$answers_text = elgg_echo('answers');
	$info .= ", <a href=\"{$vars['entity']->getURL()}\">$answers_text ({$count_answers})</a>";
$info .= "</p>";
if ($container instanceof ElggGroup) {
	$info .= "<p><a href=\"{$vars['url']}answers/owner/{$container->username}/\">{$container->name}</a></p>";
}
echo (elgg_view_image_block($icon, $info));
//echo elgg_view_listing($icon, $info);
