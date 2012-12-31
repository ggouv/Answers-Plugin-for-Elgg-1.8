<?php
/**
 * Main answers filter
 *
 * Select between votes, oldest, and active answers
 *
 * @uses $vars['sort']            Filter context: all, friends, mine
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['context']         Page context (override)
 * @uses $vars['title']           Title for answers block
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$filter_context = elgg_extract('sort', $vars, 'all');

// generate a list of default tabs
$tabs = array(
	'votes' => array(
		'text' => elgg_echo('votes'),
		'href' => "?sort=votes",
		'selected' => ($filter_context == 'votes'),
		'priority' => 200,
	),
	'oldest' => array(
		'text' => elgg_echo('oldest'),
		'href' => "?sort=oldest",
		'selected' => ($filter_context == 'oldest'),
		'priority' => 300,
	),
	'active' => array(
		'text' => elgg_echo('active'),
		'href' => "?sort=active",
		'selected' => ($filter_context == 'active'),
		'priority' => 400,
	)
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;
	
	elgg_register_menu_item('filter', $tab);
}

echo '<h3>' . $vars['title'] . '</h3>';
echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));