//<script>
elgg.provide('elgg.answers');

elgg.answers.init = function() {

	// ajaxified action for vote
	$('.answer_like, .answer_dislike').live('click', function(e) {
		var answer = $(this).parents('div[id*=elgg-object]'),
			action = $(this).hasClass('answer_like') ? 'like' : 'dislike';

		elgg.action('answer/'+action, {
			data: {
				answer_guid: answer.attr('id').replace(/elgg-object-/, ''),
			},
			success: function(json) {
				if (json.status == 0) {
					var oldDiv = answer.find('.score div'),
						oldVal = parseInt(oldDiv.text()),
						diff = json.output.score - oldVal,
						h = oldDiv.outerHeight(),
						array = [];
					if (diff >= 1) {
						var method = 'prepend',
							h0 = -h*diff,
							c = 1;
					} else {
						var method = 'append',
							h0 = 0,
							c = -1;
					}

					// add new value
					for (var i = 1; i < Math.abs(diff)+1; i++) {
						answer.find('.score')[method]($('<div>', {class: i == Math.abs(diff) ? 'pvm new' : 'pvm'}).text(oldVal + i*c));
					}
					
					// animate
					var firstDiv = answer.find('.score div:first-child').css({marginTop: h0});
					if (method == 'prepend') h = 0;
					firstDiv.animate({marginTop: -h*Math.abs(diff)}, 500, function() {
						answer.find('.score div').not('.new').remove().add('.score div').removeClass('new');
					});
					
					//add class
					answer.find('.answer_like, .answer_dislike').removeClass('liked disliked');
					if (json.output.like_dislike == 'like') answer.find('.answer_like').addClass('liked');
					if (json.output.like_dislike == 'dislike') answer.find('.answer_dislike').addClass('disliked');
				}
			}, error: function() {
				elgg.register_error(elgg.echo('answers:liked:failure'));
			}
		});
		e.preventDefault();
		return false;
	});
}
elgg.register_hook_handler('init', 'system', elgg.answers.init);
