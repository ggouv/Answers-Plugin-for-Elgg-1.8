<?php
/**
 * Answer and question voting down action. Ajaxified.
 */

// Get input
$entity_guid = (int) get_input('answer_guid');
$user_guid = elgg_get_logged_in_user_guid();

if ($entity = get_entity($entity_guid)) {

	$container = get_entity($entity->container_guid);

	// check if the user voted to an owned entity
	if ($entity->getOwnerGUID() == $user_guid) {
		register_error(elgg_echo('answers:vote:failure:owner'));
		return true;
	}

	// check if user can vote on this group
	if (!$container->canWriteToContainer()) {
		register_error(elgg_echo('answers:vote:failure:notmember'));
		return true;
	}

	elgg_load_library('answers:utilities');

	// check the actual user opinion
	if (answers_does_user_dislike_answer($entity, $user_guid)) {
		$action_result = answers_unlike($entity, $user_guid);
	}
	else {
		$action_result = answers_dislike($entity, $user_guid);
	}

	if ($action_result) {
		echo json_encode(array(
			'score' => answers_overall_rating($entity),
			'like_dislike' => answers_get_like_dislike($entity, $user_guid)
		));
	} else {
		register_error(elgg_echo('answers:vote:failure'));
	}
} else {
	register_error(elgg_echo('answers:notfound'));
}
