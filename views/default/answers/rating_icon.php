<?php
/**
 * Voting icons
 */

//	<img src="<?php echo $vars['url']; _graphics/spacer.gif" width="24" height="24" />

$tooltip = $vars['tooltip'];
$type = $vars['type'];
$selected = $vars['selected'];
$href = $vars['href'];
	
$class = "answers_" . $type . ($selected ? " answers_" . $type . "_selected" : "");
?>
<a title="<?php echo elgg_echo("answers:answer:tooltip:$tooltip"); ?>" class="answer_rate <?php echo $class; ?>" href="<?php echo $href; ?>"  style="position:relative;">
	<span></span>
</a>
