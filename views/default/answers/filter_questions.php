<?php
/**
 * Main questions filter
 *
 * Select between newest, votes, oldest, and active questions
 *
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['sort']            Page sort
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$filter_context = elgg_extract('sort', $vars, 'newest');

// generate a list of default tabs
$tabs = array(
	'newest' => array(
		'text' => elgg_echo('newest'),
		'href' => "?sort=newest",
		'selected' => ($filter_context == 'newest'),
		'priority' => 200,
	),
	'votes' => array(
		'text' => elgg_echo('votes'),
		'href' => "?sort=votes",
		'selected' => ($filter_context == 'votes'),
		'priority' => 200,
	),
	'activity' => array(
		'text' => elgg_echo('activity'),
		'href' => "?sort=activity",
		'selected' => ($filter_context == 'activity'),
		'priority' => 300,
	),
	'unanswered' => array(
		'text' => elgg_echo('unanswered'),
		'href' => "?sort=unanswered",
		'selected' => ($filter_context == 'unanswered'),
		'priority' => 400,
	)
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;
	
	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));