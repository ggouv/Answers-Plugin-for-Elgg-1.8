<?php
/**
 * Group "widget" for answers
 */

if ($vars['entity']->answers_enable != 'no') {
	global $CONFIG;
	$page_owner = elgg_get_logged_in_user_entity();
	elgg_register_menu_item('title', array(
		'name' => "answers:add",
		'href' => $CONFIG->wwwroot . "answers/ask/group:" . $vars['entity']->guid . "/",
		'text' => elgg_echo("answers:add"),
		'link_class' => 'elgg-button elgg-button-action',
	));
?>

	<div id="answers_widget_layout">
		<h2>
			<a href="<?php echo $CONFIG->wwwroot . "answers/owner/group:" . $vars['entity']->guid; ?>">
				<?php echo elgg_echo("answers:group"); ?>
			</a>
		</h2>

<?php
	$number = (int) $vars['entity']->num_display;
	if (!$number) {
		$number = 2;
	}

	//get the groups questions
	$options = array(
		'type' => 'object',
		'subtype' => 'question',
		'container_guid' => $vars['entity']->guid,
		'limit' => $number,
	);
	$questions = elgg_get_entities($options);
	$options['count'] = true;
	$count = elgg_get_entities($options);
	if ($questions) {

		//display in list mode
		foreach ($questions as $question) {
			echo elgg_view_entity($question);
		}

		if ($count > $number) {
			//get a link to the groups questions
			$more_questions_url = $vars['url'] . "answers/owner/" . elgg_get_page_owner_entity()->username;
			echo "<div class=\"forum_latest\"><a href=\"{$more_questions_url}\">" . elgg_echo('answers:questions:more') . "</a></div>";
		}
	} else {

		// no questions so show link to ask a question if member of the group
		echo "<div class=\"forum_latest\">" . elgg_echo("answers:group:questions:none");
		echo "</div>";
	}

	if (false && $vars['entity']->isMember()) {
		echo '<div class="group_widget_menu">';
		echo "<a href=\"" . $CONFIG->wwwroot . "answers/ask/" . page_owner_entity()->username . "/\">" . elgg_echo('answers:question:add') . "</a>";
		echo '</div>';
	}
?>
	<div class="clearfloat"></div>
</div>

<?php
}//end of activate check statement
