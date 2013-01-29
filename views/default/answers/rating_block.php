<?php
/**
 * Voting area view
 * Used for question and answer object full view
 */

$entity = $vars['entity'];
$user_guid = elgg_get_logged_in_user_guid();

$score = answers_overall_rating($entity);

if ($entity->getOwnerGUID() != $user_guid) {
	$liked = answers_does_user_like_answer($entity, $user_guid) == 'like' ? ' liked' : '';
	$up = elgg_view('output/url', array(
		'text' => '<div class="gwf">í</div>',
		'href' => '#',
		'is_trusted' => true,
		'class' => "t answer_like$liked",
		'title' => elgg_echo('answers:vote:tooltip:like'),
	));

	$disliked = answers_does_user_dislike_answer($entity, $user_guid) == 'dislike' ? ' disliked' : '';
	$down = elgg_view('output/url', array(
		'text' => '<div class="gwf mbm">ì</div>',
		'href' => '#',
		'is_trusted' => true,
		'class' => "t answer_dislike$disliked",
		'title' => elgg_echo('answers:vote:tooltip:dislike'),
	));
}

$subtype = $entity->getSubtype();
if ($subtype == 'question') {
	// here code to favorite question. Usefull ? Todo ?
} else if ($subtype == 'answer') {
	$question = answers_get_question_for_answer($entity);
	
	if ($question->chosen_answer == $entity->getGUID()) {
		$chosen = true;
		$chosen_view = '<div class="choose chosen tooltip w t" title="' . elgg_echo('answers:answer:tooltip:bestanswer') . '"><div class="gwf mtm">œ</div></div>';
	}
	if ($question->getOwnerGUID() == $user_guid) {
		if ($chosen) $class = ' chosen';
		$chosen_view = elgg_view('output/url', array(
			'text' => '<div class="gwf">œ</div>',
			'href' => elgg_get_site_url() . 'action/answers/choose?answer_id=' . $entity->getGUID(),
			'class' => "choose tooltip w t$class",
			'is_action' => true,
			'is_trusted' => true,
			'title' => $chosen ? elgg_echo('answers:answer:tooltip:bestanswer') : elgg_echo('answers:answer:tooltip:choose')
		));
	}

} else {
	return false;
}

echo <<<HTML
<div class="rating-block float center">
	$up
	<div class="score"><div class="pvm">$score</div></div>
	$down
	$chosen_view
</div>
HTML;
