<?php
/**
 * Question view
 */

if (isset($vars['entity'])) {
	$context = elgg_get_context();
	if ($context != "answers" && $vars['entity'] instanceof ElggObject) {

		echo elgg_view("answers/listing", $vars);
	} else {

		$url = $vars['entity']->getURL();
		$owner = $vars['entity']->getOwnerEntity();
		$canedit = $vars['entity']->canEdit();
		$count_answers = count_question_answers($vars['entity']);
		$containerEntity = get_entity($vars['entity']->container_guid );

		$full = (isset($vars['full']) && $vars['full'] == true && $vars['entity'] instanceof ElggEntity);
?>

		<div class="contentWrapper singleview <?php echo $containerEntity->getType() != "group" ? 'user_question' : "group_question";?> ">

			<div class="topic_post">
				<table width="100%">
		            <tr>
		                <td>
							<a name="<?php echo $vars['entity']->getGUID(); ?>"></a>
<?php
		if ($owner) {

			//display the user icon
			echo "<div class=\"post_icon\">" . elgg_view_entity_icon($owner) . "</div>";

			//display the user name
			echo "<p><b>" . $owner->name . "</b><br />";
		} else {
			echo "<div class=\"post_icon\"><img src=\"" . elgg_view('icon/user/default/small') . "\" /></div>";
			echo "<p><b>" . elgg_echo('profile:deleteduser') . "</b><br />";
		}

		echo "<small>" . elgg_view_friendly_time($vars['entity']->time_created) . "</small><br />";

		//$answers_text = "({$count_answers} answer" . ($count_answers == 1 ? "" : "s") . ")";
		$answers_text = elgg_echo('answers') . " ({$count_answers})";
		if (!$full) {
			echo "<a href=\"" . $url . "\">" . $answers_text . "</a>";
		}
		//else
		//	echo $answers_text;

		echo "</p>";


		//if the question owner is looking at it, or admin, or group owner they can edit
		if ($full && $canedit) {
?>
					<p class="topic-post-menu">
					<?php
					echo elgg_view("output/confirmlink", array(
						'href' => $vars['url'] . "action/question/delete?question_id=" . $vars['entity']->getGUID(),
						'text' => elgg_echo('delete'),
						'confirm' => elgg_echo('deleteconfirm'),
						'is_action' => true,
					));
					?>
						<a href="<?php echo $vars['url']; ?>mod/answers/edit.php?question_id=<?php echo $vars['entity']->getGUID(); ?>"><?php echo elgg_echo("edit"); ?></a>  &nbsp;

					</p>

						<?php
		}
						?>
                </td>
                <td width="70%">
					<div class="question_title">
					<?php
					$vars['entity']->title = elgg_echo($containerEntity->getType() != "group" ? 'answers:question:pretitle' : 'answers:group:pretitle') . $vars['entity']->title;
					if ($full) {
						//echo $containerEntity->getType() != "group" ? 'user_question' : "group_question";
						echo $vars['entity']->title;
					} else {
						echo "<a href=\"" . $url . "\">{$vars['entity']->title}</a>";
					}
					?>
                    </div>
					<!-- display tags -->
					<?php
					if ($full) {
						$tags = elgg_view('output/tags', array('tags' => $vars['entity']->tags));
						if (!empty($tags)) {
							echo '<b>' . elgg_echo('tags') . '</b><div class="tags">' . $tags . '</div>';
						}
					}
					?>
						<div class="question_details">
					<?php
						echo elgg_view("output/longtext", array("value" => $vars['entity']->description));
					?>
						</div>
					</td>
	            </tr>
	        </table>


<?php
		// display comments if in full view
		if ($full) {
			$comments = $vars['entity']->getAnnotations('comment', 9999, 0, "asc");
			if ($comments) {
				foreach ($comments as $comment) {
					echo elgg_view("answers/comment", array('entity' => $comment));
				}
			}

			// can this user add a comment
			if (elgg_is_logged_in()) {
				//display the add comment form, this will appear after all the existing comments
				echo elgg_view("answers/forms/comment", array('entity' => $vars['entity']));
			}
		}
		?>
		</div>

	</div>

<?php
		// display current answers
		if ($full) {
			$answers = get_sorted_question_answers($vars['entity']);
			if (is_array($answers)) {
				$chosen = "";
				$others = "";
				$chosen_answer_id = $vars['entity']->chosen_answer;
				
				foreach ($answers as $answer) {
					if ($answer->getGUID() == $chosen_answer_id)
						$chosen .= elgg_view_entity($answer, array('full_view' => true));
					else
						$others .= elgg_view_entity($answer, array('full_view' => true));
				}
				if ($chosen) {
					//echo "<div class=\"answers_header\">Best Answer</div>";
					echo $chosen;
				}
				
				if ($others) {
					echo "<div class=\"answers_header\">";
					echo $chosen ? elgg_echo('answers:answers:other_answers') : elgg_echo('answers:answers');
					echo "</div>";
					echo $others;
				}
			}

			echo elgg_view('answers/forms/addanswer', array('entity' => $vars['entity']));
		}

	}
}
