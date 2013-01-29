<?php
/**
 * Add a new answer action
 */

// Get input
$question_id = (int) get_input('question_guid');
$answer_text = get_input('answer_text');

$question = get_entity($question_id);

if (!$question) {
	register_error(elgg_echo('answers:error'));
	forward(REFERER);
}

$user_guid = elgg_get_logged_in_user_guid();

$container = get_entity($question->container_guid);
if ($container instanceof ElggGroup && !$container->canWriteToContainer($user_guid)) {
	register_error(elgg_echo('answers:answer:mustbeingroup', array($container->name)));
	forward($question->getURL());
}

if (empty($answer_text)) {
	register_error(elgg_echo("answers:answer:blank"));
	forward($question->getURL());
}


$answer = new ElggObject();
$answer->subtype = "answer";
$answer->access_id = $question->access_id;
$answer->question_guid = $question->getGUID();

// if the question is part of a group, answer should be too (otherwise answer will be contained by the answerer)
$container = get_entity($question->container_guid);
if ($container instanceof ElggGroup) {
	$answer->container_guid = $question->container_guid;
}

$answer->description = $answer_text;

if (!$answer->save()) {
	register_error(elgg_echo('answers:answer:failure'));
	forward($question->getURL());
}

if (!add_entity_relationship($question->getGUID(), "answer", $answer->getGUID())) {
	register_error(elgg_echo('answers:answer:failure'));
	forward($question->getURL());
}

system_message(elgg_echo("answers:answer:posted"));
add_to_river('river/object/question/answer', 'create', $user_guid, $answer->getGUID());

// Send response to original question asker if not already registered to receive notification
if ($question->owner_guid != $user_guid) {
	$question_owner = $question->getOwnerEntity();

	if ($container instanceof ElggGroup) {
		$notify_guid = $container->guid;
	} else {
		$notify_guid = $user_guid;
	}
	// check if question owner has notification for this user
	$send_response = true;
	global $NOTIFICATION_HANDLERS;
	foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
		if (check_entity_relationship($question_owner->guid, 'notify' . $method, $notify_guid)) {
			$send_response = false;
		}
	}

	// create the notification message
	if ($send_response) {
		// HACK: need to do this so that subtype works correctly on newly created and saved object
		$answer = get_entity($answer->guid);

		// grab same notification message that goes to everyone else
		$params = array(
			'entity' => $answer,
			'method' => "email",
		);
		$msg = answers_notify_message("", "", "", $params);
		//$subject = elgg_echo('answers:notify:answer:subject', array(
		//	$user->name,
		//	$question->title,
		//));

		// yuck - pulled from how object_notifications() does the subject
		global $CONFIG;
		$subject = $CONFIG->register_objects['object']['answer'];
		
		notify_user($question_owner->guid, $user_guid, $subject, $msg);
	}
}

forward($question->getURL());
