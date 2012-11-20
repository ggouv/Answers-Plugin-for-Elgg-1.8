<?php
/**
 * Edit question/answer comment
 */
		
$comment_id = (int)get_input('comment_id');
// modified to work with ckeditor wysiwyg
$comment_text = get_input("comment_text{$comment_id}", false);

$comment = elgg_get_annotation_from_id($comment_id);
if(!($comment instanceof ElggAnnotation) || $comment->name != "comment") {
	register_error(elgg_echo("answers:notfound"));
	forward("answers");
}

$entity = get_entity($comment->entity_guid);
if(empty($comment_text) || !answers_can_edit_comment($comment)) {
	register_error(elgg_echo("answers:comment:error"));
	forward($entity->getURL());
}

$comment->value = $comment_text;
if (!$comment->save()) {
	register_error(elgg_echo("answers:comment:failure"));
} else {
	system_message(elgg_echo("answers:comment:updated"));
}

forward($entity->getURL());
