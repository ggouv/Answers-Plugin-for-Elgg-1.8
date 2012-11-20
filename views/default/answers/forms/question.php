<?php
/**
 * Add question form
 */

// Set title, form destination
if (isset($vars['entity'])) {
	$pagetitle = elgg_echo("answers") . ": " . sprintf(elgg_echo("answers:question:edit"), $object->title);
	$action = "question/edit";
	$title = $vars['entity']->title;
	$message = $vars['entity']->description;
	$tags = $vars['entity']->tags;
	$access_id = $vars['entity']->access_id;
} else {
	$pagetitle = elgg_echo("answers") . ": ";
	$container = get_entity($vars["container_guid"]);
	if ($container instanceof ElggGroup) {
		$pagetitle .= sprintf(elgg_echo("answers:question:groupadd"), $container->name);
	} else {
		$pagetitle .= elgg_echo("answers:question:add");
	}

	$action = "question/add";
	$tags = "";
	$title = "";
	$message = "";
	$description = "";
	if (defined('ACCESS_DEFAULT')) {
		$access_id = ACCESS_DEFAULT;
	} else {
		$access_id = 0;
	}
}


// set the title
//echo elgg_view_title($pagetitle);
?>
<div class="contentWrapper">
	<!-- display the input form -->
	<form action="<?php echo $vars['url']; ?>action/<?php echo $action; ?>" method="post">
		<p>
			<label><?php echo elgg_echo("answers:question"); ?><br />
			<?php echo elgg_view("input/text", array(
							"name" => "questiontitle",
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
					"name" => "questiontags",
					"value" => $tags,
				));
			?>
			</label>
		</p>

		<!-- topic message input -->
		<p class="longtext_editarea">
			<label><?php echo elgg_echo("answers:questiondetails"); ?><br />
			<?php
				echo elgg_view("input/longtext", array(
					"name" => "questiondetails",
					"value" => $message,
				));
			?>
			</label>
		</p>

		<?php /* ?>
				  <!-- access -->
				  <p>
				  <label>
				  <?php echo elgg_echo('access'); ?><br />
				  <?php echo elgg_view('input/access', array('internalname' => 'access_id','value' => $access_id)); ?>
				  </label>
				  </p>
				  <?php */
		?>

		<!-- required hidden info and submit button -->
		<p>
			<?php echo elgg_view('input/submit', array('value' => elgg_echo("save"))); ?>
		</p>
		<?php
		echo elgg_view('input/securitytoken');

		if (isset($vars['container_guid'])) {
			echo "<input type=\"hidden\" name=\"container_guid\" value=\"{$vars['container_guid']}\" />";
		}
		if (isset($vars['entity'])) {
			echo elgg_view('input/hidden', array('name' => 'question_id', 'value' => $vars['entity']->getGUID()));
		}
		?>
	</form>
</div>
