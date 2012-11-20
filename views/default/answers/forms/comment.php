<?php
/**
 * Add comment form
 */

if (isset($vars['entity']) && elgg_is_logged_in()) {
	$container = get_entity($vars['entity']->container_guid);
	if (!($container instanceof ElggGroup) || can_write_to_container(0, $container->getGUID())) {
		echo "<div class=\"answers_comment\">";
		echo "<div><a class=\"collapsibleboxlink\">" . elgg_echo('answers:comment:comment') . "</a></div>";
		echo "<div class=\"collapsible_box\">";

		$entity_guid = $vars['entity']->getGUID();

		$form_body = "<div class=\"answers_add_comment_wrapper\"><p class='longtext_editarea'>";
		$form_body .= elgg_view('input/longtext', array('name' => "comment_text{$entity_guid}")) . "</p>";
		$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'object_id', 'value' => $entity_guid));
		$form_body .= elgg_view('input/submit', array('value' => elgg_echo("answers:comment:save"))) . "</p></div>";

		echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$vars['url']}action/answers/comment/add"));
		echo "</div>";
		echo "</div>";
	}
}
