<?php
/**
 * Answers CSS extender
 *
 */

?>

.answers_rating {
	display: block;
	margin-top: 1px;
}

.answers_like, .answers_dislike {
	padding: 0;
	margin: 0;
}

.answer_rate span:after {
	font-size: 24px;
	font-weight: bold;
	color: #777;
	width: 24px;
}

.answer_rate:hover {
	text-decoration: none;
}

.answers_like span:after {
	content: "\25B2";
}

.answers_dislike span:after {
	content: "\25BC";
}

.answers_like_selected span:after, .answers_dislike_selected span:after {
	color: #0054a7;
}

.answers_choose {

}

.answers_chosen {
	background-color: #ff9;
}

.question_title {
	font-weight: bold;
	font-size: 120%;
}

.question_details {

}

#answers_widget_layout {
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	background: white;
	margin: 0 0 20px;
	padding: 0 0 5px;
}

#answers_widget_layout .search_listing {
	background: #dedede !important;
}

.answers_header {
	font-weight: bold;
	font-size: 1.2em;
	margin: 0 0 0 8px;
	padding: 5px;
}

.answers_comment {
	border-top: 1px dotted #AAAAAA;
	color: #000000;
	font-size: 90%;
	width: 90%;
	margin: 7px 0 0 10%;
	padding:2px 0 0 2px;
}

.answers_comment_owner {
	color: #666666;
}

.answers_add_comment_wrapper .input-textarea {
	height: 80px;
}

.answers_add_comment_wrapper .submit_button {
	margin-bottom: 0px;
}


.answers_rating_container {
	margin-left: 10px;
}

.answers_rating {
	font-weight: bold;
	font-size: 130%;
	line-height: 130%;
}

.answers_rating_block {
	float: left;
	clear: left;
	text-align: center;
	width: 40px;
}

.answers_answer_byline {
	border-top: 1px solid #AAAAAA;
	color: #666666;
	font-size: 90%;
	margin: 0;
}

.answers_answer_owner_icon {
	float: left;
	margin: 3px;
}

.answers_answer_owner {
	float: left;
	margin: 6px;
}

.answers_answer_delete {
	float: left;
	margin: 6px 0 6px 15px;
}

.topic_post .tags {
	background: transparent url(<?php echo $vars['url']; ?>_graphics/icon_tag.gif) no-repeat scroll left 2px;
	margin: 1px 3px 3px;
	min-height: 22px;
	padding: 0 0 0 16px;
}

.river_object_question_create, .river_object_question_update {
	background: url(<?php echo $vars['url']; ?>mod/answers/graphics/river_icon_question.gif) no-repeat left -1px;
}

.river_object_question_answer, .river_object_answer_update {
	background: url(<?php echo $vars['url']; ?>mod/answers/graphics/river_icon_answer.gif) no-repeat left -1px;
}

.river_object_question_choose {
	background: url(<?php echo $vars['url']; ?>mod/answers/graphics/river_icon_choose.gif) no-repeat left -1px;
}

.river_object_question_comment, .river_object_answer_comment {
	background: url(<?php echo $vars['url']; ?>mod/answers/graphics/river_icon_comment.gif) no-repeat left -1px;
}