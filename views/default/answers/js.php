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
	
	// live search
	var timeout;
	$("#answers-textarea").keypress(function(e) {
		if ( $(this).val().length > 140 && e.which != 8 || e.which == 13) return false;
		elgg.answers.textCounter(this, $("#answers-characters-remaining span"), 140);
		var search_input = $(this).val();
		var search_container = $('#answers-search-response');

		if (search_input.length > 3) {
			if (timeout) {
				clearTimeout(timeout);
				timeout = null;
			}
			
			timeout = setTimeout(function() {
				search_input = $("#answers-textarea").val();
				if (search_input.length > 3) { // @todo check why need to do it again ?
					elgg.post('ajax/view/answers/search', {
						data: {
							group:elgg.get_page_owner_guid(),
							keyword: $("#answers-textarea").val()
						},
						beforeSend:  function() {
							$('#answers-characters-remaining').addClass('loading');
						},
						success: function(response) {
							clearTimeout(timeout);
							$('.elgg-menu-filter-default, .elgg-list-entity').hide();
							if ( search_container.is(':hidden') ) {
								search_container.css('opacity', 0).html(response).fadeTo('slow', 1);
							} else {
								search_container.html(response);
							}
							$('#answers-characters-remaining').removeClass("loading");
						}
					});
				}
			}, 500);
		} else if ( $('.elgg-list-entity').css('opacity') != '1' || $('.elgg-list-entity').is(":hidden") ) {
			search_container.hide().html('');
			$('.elgg-menu-filter-default, .elgg-list-entity').css('opacity', 0).fadeTo('slow', 1);
		}
	});
}
elgg.register_hook_handler('init', 'system', elgg.answers.init);


/**
 * Update the number of characters left with every keystroke
 *
 * @param {Object}  textarea
 * @param {Object}  status
 * @param {integer} limit
 * @return void
 */
elgg.answers.textCounter = function(textarea, status, limit) {

	var remaining_chars = limit - $(textarea).val().length;
	status.html(remaining_chars);

	if (remaining_chars < 0) {
		status.parent().css("color", "#D40D12");
	} else {
		status.parent().css("color", "");
	}
}