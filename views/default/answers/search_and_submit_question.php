<?php
/**
 * Answers plugin search and submit question form
 *
 */

$container = elgg_extract('owner', $vars);

if ($container->canWriteToContainer()) {
	$echo = elgg_echo('answers:search_and_submit');
} else {
	$echo = elgg_echo('answers:search');
}

echo '<h3 class="mbs">' . $echo . '</h3>';

echo elgg_view('input/text', array(
	'name' => 'body',
	'class' => 'mbm',
	'id' => 'answers-textarea',
));

?>

<div id="answers-characters-remaining">
	<span>140</span>&nbsp;<?php echo elgg_echo('answers:charleft'); ?>
</div>
<div id="answers-search-response"></div>