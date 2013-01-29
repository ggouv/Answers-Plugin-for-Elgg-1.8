<?php

$keyword = get_input('keyword', 'false');

if ( $keyword != 'false' ) {
	$owner_guid = (int)get_input('owner', 'false');
	
	if ( $owner_guid ) {
		$owner = get_entity($owner_guid);
		$db_prefix = elgg_get_config('dbprefix');
		
		$likes = $keys = array();
		$keywords = explode(' ', sanitise_string($keyword));
		$skip_words = explode(',', elgg_echo('answers:search:skip_words'));
		
		foreach ($keywords as $key) {
			if ( strlen($key) > 2 && !in_array($key, $skip_words) ) {
				$keys[] = $key;
				$likes[] = "oe.title LIKE '%$key%' OR oe.description LIKE '%$key%'";
			}
		}
		if ( !empty($keys) ) {
			$params = array(
				'type' => 'object',
				'subtype' => 'question',
				'limit' => 0
			);
			$container_or_owner = elgg_instanceof($owner, 'group') ? 'container_guid' : 'owner_guid';
			$params[$container_or_owner] = $owner_guid;
		
			$params['wheres'] = array('(' . implode(' OR ', $likes) . ')');
			$params['joins'] = array("JOIN {$db_prefix}objects_entity oe ON e.guid = oe.guid");

			$questions = elgg_get_entities($params);
			
			// hightlight result.
			foreach ($questions as $item => $question) {
				$excerpt_description = elgg_get_excerpt($question->description, '300');
				foreach ($keys as $key) {
					$question->title = preg_replace("/($key)/i", "<span class='answers-highlight'>$1</span>", $question->title);
					$excerpt_description = preg_replace("/($key)/i", "<span class='answers-highlight'>$1</span>", $excerpt_description);
				}
				$question->description = $excerpt_description;
			}
			if ($questions) {
				$content = elgg_view_entity_list($questions, array(
					'full_view' => 'searched',
					'pagination' => true,
					'limit' => 0
				));
			}
		}
		
		if ($owner->canWritetoContainer()) {
			if ($content) {
				$html = '<span>' . elgg_echo('answers:search:submit_and_content') . '</span>';
			} else {
				$html = '<span>' . elgg_echo('answers:search:submit_no_content') . '</span>';
			}
			
			$html_keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
			$html .= "<a class='elgg-button elgg-button-action' href='" . elgg_get_site_url() . "answers/add/{$owner_guid}/?search={$html_keyword}'>" . elgg_echo('answers:add') . '</a>';
			echo $html . $content;
		} else {
			if ($content) {
				echo $content;
			} else {
				echo '<span>' . elgg_echo('answers:search:no_content') . '</span>';
			}
		}
	}
}