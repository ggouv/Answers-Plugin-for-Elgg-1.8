<?php
/**
 * Display comment view
 */

if (isset($vars['entity'])) {
	$comment = $vars['entity'];
	$owner = get_user($comment->owner_guid);
	$canedit = answers_can_edit_comment($comment);
	
	$markdown = is_callable('markdown_text');
	
	if ($comment && $owner) {
		$full_comment_text = parse_urls(filter_tags($comment->value)) . ($markdown ? "\n" : " ") . "&mdash; " . 
							 "<span class=\"answers_comment_owner\">" .
							 "<a href=\"" . $owner->getURL() . "\">" . $owner->name . "</a>" .
							 " " . elgg_view_friendly_time($comment->time_created) . "</span>";
							 
		
        if ($canedit) {
        	$full_comment_text .= "&nbsp;&nbsp;" . elgg_view("output/confirmlink",array(
										'href' => $vars['url'] . "action/answers/comment/delete?comment_id=" . $comment->id,
										'text' => elgg_echo('delete'),
										'confirm' => elgg_echo('deleteconfirm'),
										'class' => '',
    									'is_action' => true,
									));
			$edit = elgg_echo('edit');
			$full_comment_text .= "&nbsp;&nbsp;<a class=\"collapsibleboxlink\">$edit</a>";
		}
		
		if ($markdown) {
        	$full_comment_text = markdown_text($full_comment_text);
		} else {
        	$full_comment_text = autop($full_comment_text);
		}
?>
	<div class="answers_comment">
		<a name="<?php echo $comment->id; ?>"></a>
        <?php echo $full_comment_text; ?>
		<?php
			if ($canedit) {
		?>
			<div class="collapsible_box">
				<?php echo elgg_view("answers/forms/editcomment", $vars); ?>
			</div>
		<?php
			}
		?>
	</div>
<?php
	}
}
