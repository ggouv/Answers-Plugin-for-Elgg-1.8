<?php
/**
 * Add a new question/answer comment
 */

// Get input
$object_id = (int) get_input('object_id');
// modified to work with ckeditor wysiwyg
$comment_text = get_input("comment_text{$object_id}", false);

$object = get_entity($object_id);
if (!($object instanceof ElggEntity)) {
	register_error(elgg_echo("answers:notfound"));
	forward("answers");
}

$subtype = $object->getSubtype();
if ($subtype != 'question' && $subtype != 'answer') {
	register_error(elgg_echo("answers:notfound"));
	forward("answers");
}

if (!empty($comment_text)) {
	$action_result = $object->annotate("comment", $comment_text, $object->access_id, $_SESSION['guid']);
	if (!$action_result) {
		register_error(elgg_echo("answers:comment:failure"));
	} else {
		answers_notify_comment($object, $comment_text, $_SESSION['user']);
		
		add_to_river('river/object/question/comment', 'comment', elgg_get_logged_in_user_guid(), $object->getGUID());
		//add_to_river('river/object/question/comment', 'comment', $_SESSION['user']->guid, $object_id);
	}
} else {
	register_error(elgg_echo("answers:comment:blank"));
}
forward($object->getURL());
