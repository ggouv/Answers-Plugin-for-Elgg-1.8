<?php
/**
 * Edit question form
 */

// Set title, form destination
if (isset($vars['entity'])) {
	$pagetitle = sprintf(elgg_echo("answers:editpost"), $object->title);
	$action = "answer/edit";
	$title = $vars['entity']->title;
	$message = $vars['entity']->description;
	$tags = $vars['entity']->tags;
	$access_id = $vars['entity']->access_id;
} else {
	$pagetitle = elgg_echo("answers:addpost");
	$action = "answer/add";
	$tags = "";
	$title = "";
	$message = "";
	$description = "";
	if (defined('ACCESS_DEFAULT'))
		$access_id = ACCESS_DEFAULT;
	else
		$access_id = 0;
}

// set the title
echo elgg_view_title($pagetitle);
?>
<div class="contentWrapper">
	<!-- display the input form -->
	<form action="<?php echo $vars['url']; ?>action/<?php echo $action; ?>" method="post">

		<p>
			<label><?php echo elgg_echo("answers:question"); ?><br />
<?php
//display the topic title input
echo elgg_view("input/text", array(
	"internalname" => "questiontitle",
	"value" => $title,
));
?>
			</label>
		</p>

		<!-- display the tag input -->
		<p>
			<label><?php echo elgg_echo("tags"); ?><br />
<?php
				echo elgg_view("input/tags", array(
					"internalname" => "questiontags",
					"value" => $tags,
				));
?>
		</p>

		<!-- topic message input -->
		<p class="longtext_editarea">
			<label><?php echo elgg_echo("answers:questiondetails"); ?><br />
<?php
				echo elgg_view("input/longtext", array(
					"internalname" => "questiondetails",
					"value" => $message,
				));
?>
			</label>
		</p>

		<!-- access -->
		<p>
			<label>
<?php echo elgg_echo('access'); ?><br />
<?php echo elgg_view('input/access', array('internalname' => 'access_id', 'value' => $access_id)); ?>
			</label>
		</p>

		<!-- required hidden info and submit button -->
		<p>
			<input type="submit" class="submit_button" value="<?php echo elgg_echo('save'); ?>" />
		</p>
<?php
				if (isset($vars['entity'])) {
					echo elgg_view('input/hidden', array('internalname' => 'answerid', 'value' => $vars['entity']->getGUID()));
				}
?>

	</form>
</div>