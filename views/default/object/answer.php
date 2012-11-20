<?php
if (isset($vars['entity'])) {
	$answer = $vars['entity'];
	$question = get_question_for_answer($answer);

	$owner = $answer->getOwnerEntity();
	$canedit = $answer->canEdit();

	$chosen_answer = ($question->chosen_answer == $answer->getGUID());
	$full = isset($vars['full']) && $vars['full'] == true;
?>

<?php if ($chosen_answer) { ?>
		<div class="answers_header answers_chosen_heading"><?php echo elgg_echo('answers:answers:best');?></div>
<?php } ?>
	<a name="<?php echo $answer->getGUID(); ?>"></a>
	<div class="generic_comment<?php echo $chosen_answer ? " answers_chosen" : ""; ?>">

<?php if ($full) { ?>
			<div class="answers_rating_container">
<?php echo elgg_view("answers/rating_block", $vars); ?>
			</div>
<?php } ?>
	<div class="generic_comment_details">

		<!-- output the actual comment -->
<?php echo elgg_view("output/longtext", array("value" => $answer->description)); ?>

		<div class="answers_answer_byline">
			<div class="answers_answer_owner_icon">
<?php
	echo elgg_view_entity_icon($owner, 'tiny');
	/*echo elgg_view("profile/icon",
			array(
				'entity' => $owner,
				'size' => 'tiny'));*/
?>
			</div>
			<div class="answers_answer_owner">
				<a href="<?php echo $owner->getURL(); ?>"><?php echo $owner->name; ?></a> <?php echo elgg_view_friendly_time($answer->time_created); ?>
			</div>

<?php
				// if the user looking at the comment can edit, show the delete link
				if ($full && $canedit) {
?>
					<div class="answers_answer_delete">
			<?php
					echo elgg_view("output/confirmlink", array(
						'href' => $vars['url'] . "action/answer/delete?answer_id=" . $answer->getGUID(),
						'text' => elgg_echo('delete'),
						'confirm' => elgg_echo('deleteconfirm'),
						'is_action' => true,
					));
			?>
				</div>
				<div class="answers_answer_delete">
					<a class="collapsibleboxlink"><?php echo elgg_echo('edit'); ?></a>
				</div>
				<div class="collapsible_box" style="clear:both;">
<?php echo elgg_view("answers/forms/editanswer", $vars); ?>
				</div>
<?php
				} //end of can edit if statement
?>

			<div><br/><br/></div>
		</div>



<?php
				if ($full) {
					$comments = $answer->getAnnotations('comment', 9999, 0, "asc");
					if ($comments) {
						foreach ($comments as $comment) {
							echo elgg_view("answers/comment", array('entity' => $comment));
						}
					}

					// can this user add a comment - must be logged in or site admin
					if (elgg_is_logged_in() || elgg_is_admin_logged_in()) {
						//display the add comment form, this will appear after all the existing comments
						echo elgg_view("answers/forms/comment", array('entity' => $answer));
					}
				}
?>


				<p>
				</p>
			</div><!-- end of generic_comment_details -->
		</div><!-- end of generic_comment div -->
<?php
			}
