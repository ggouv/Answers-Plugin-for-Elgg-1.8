<?php
/**
 * Comment on a question/answer river view
 */

$item = $vars['item'];
$comment = get_entity($item->object_guid);
$aAnnotations = elgg_get_annotations(array('annotation_names' => array('comment')));
foreach ($aAnnotations as $oAnnotation){
    
    if ($oAnnotation->entity_guid == $item->object_guid && $oAnnotation->owner_guid == $item->subject_guid){
        $user = get_entity($oAnnotation->owner_guid);
        $parent = get_entity($comment->getGUID());
        
        $questionurl = "<a href=".$parent->getURL().">".$parent->title."</a>";
        $userurl = "<a href=".$user->getURL().">".$user->name."</a>";
        $excerpt = elgg_get_excerpt($oAnnotation->value);

        $summary = sprintf(elgg_echo("question:river:comment:".$parent->getSubtype()), $userurl, $questionurl);

        $vars['item']->subject_guid = $user->getGUID();

        echo elgg_view('river/elements/layout', array(
                'item' => $item,
                'summary' => $summary,
                'message' => $excerpt,
        ));
        break;
    }
}
