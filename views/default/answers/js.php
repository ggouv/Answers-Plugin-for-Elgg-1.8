//<script>
elgg.provide('elgg.answers');

var elgg.answers.init = function() {

	// ajaxified action for vote up
	$('.answers_like').live('click', function() {
		if ($.data(this, 'clicked') || $(this).hasClass('checked')) // Prevent double-click
			return false;
		else {
			$.data(this, 'clicked', true);

			elgg.action('answer/like', {
				data: {
					answer_id: $('answer_id').val();
				}
				success: function(json) {

					if ($('.answers_like').hasClass('answers_like_selected')) {
						$('.answers_like').removeClass('answers_like_selected');
						$('.answers_rating').val($('.answers_rating').val() - 1);
					}
					else {
						$('.answers_like').addClass('answers_like_selected');
						$('.answers_rating').val($('.answers_rating').val() + 1);
					}
					
					$.data(thisVote, 'clicked', false);
				}
			}
		}
	}

	// ajaxified action for vote down
	$('.answers_dislike').live('click', function() {
		if ($.data(this, 'clicked') || $(this).hasClass('checked')) // Prevent double-click
			return false;
		else {
			$.data(this, 'clicked', true);

			elgg.action('answer/dislike', {
				data: {
					answer_id: $('answer_id').val();
				}
				success: function(json) {

					if ($('.answers_dislike').hasClass('answers_dislike_selected')) {
						$('.answers_dislike').removeClass('answers_dislike_selected');
						$('.answers_rating').val($('.answers_rating').val() + 1);
					}
					else {
						$('.answers_dislike').addClass('answers_dislike_selected');
						$('.answers_rating').val($('.answers_rating').val() - 1);
					}
					
					$.data(thisVote, 'clicked', false);
				}
			}
		}
	}
};

elgg.register_hook_handler('init', 'system', elgg.answers.init);
