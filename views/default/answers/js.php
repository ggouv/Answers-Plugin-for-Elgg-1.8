//<script>
elgg.provide('elgg.answers');

elgg.answers.init = function() {

	// ajaxified action for vote
	$('.answer_like, .answer_dislike').live('click', function(e) {
		var answer = $(this).parents('.elgg-item-answer'),
			action = $(this).hasClass('answer_like') ? 'like' : 'dislike';

		elgg.action('answer/'+action, {
			data: {
				answer_id: answer.attr('id').replace(/elgg-object-/, '')
			},
			success: function(json) {
			// perform action. Put in standby to merge cash pull request
/*
				if ($('.answers_like').hasClass('answers_like_selected')) {
					$('.answers_like').removeClass('answers_like_selected');
					$('.answers_rating').val($('.answers_rating').val() - 1);
				}
				else {
					$('.answers_like').addClass('answers_like_selected');
					$('.answers_rating').val($('.answers_rating').val() + 1);
				}
				
				*/
			}
		});
		e.preventDefault();
		return false;
	});
}
elgg.register_hook_handler('init', 'system', elgg.answers.init);
