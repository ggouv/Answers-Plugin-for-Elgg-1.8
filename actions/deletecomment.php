<?php
/**
 * Delete question/answer comment action
 */
		
$comment_id = (int)get_input('comment_id');

$comment = elgg_get_annotation_from_id($comment_id);
if (!($comment instanceof ElggAnnotation) || $comment->name != "comment") {
	register_error(elgg_echo("answers:notfound"));
	forward("answers");
}

$entity = get_entity($comment->entity_guid);
if (!answers_can_edit_comment($comment)) {
	register_error(elgg_echo("answers:comment:error"));
	forward($entity->getURL());
}

if (!$comment->delete()) {
	register_error(elgg_echo("answers:comment:failure"));
} else {
	system_message(elgg_echo("answers:comment:deleted"));
}

forward($entity->getURL());
