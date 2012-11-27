<?php
/**
 * Answers helper functions
 *
 * @package Answers
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $question A question object.
 * @return array
 */
function answers_prepare_form_vars($question = null) {
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $question,
	);

	if ($question) {
		foreach (array_keys($values) as $field) {
			if (isset($question->$field)) {
				$values[$field] = $question->$field;
			}
		}
	}

	if (elgg_is_sticky_form('question')) {
		$sticky_values = elgg_get_sticky_values('question');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('question');

	return $values;
}
