.question-content, .answer-content {
	margin-left: 60px;
}
.question-view .elgg-image-block:after {
	content: "";
	display: inline-block;
}
.rating-block, .rating-block > * {
	width: 50px;
}
.question-view .rating-block .gwf {
	float: none;
}
.rating-block .score {
	font-size: 2em;
}
.rating-block .score {
	font-weight: bold;
	height: 40px;
	overflow: hidden;
}
.rating-block > a {
	font-size: 3em;
	color: #CCC;
	text-decoration: none;
}
.rating-block > a.answer_like:hover, .rating-block > a.answer_dislike:hover {
	font-size: 4em;
}
.rating-block > a.liked, .rating-block > a.disliked {
	color: #ff9900;
}
.rating-block > .choose {
	background-color: #CCC;
	border-radius: 9px;
	color: white;
	display: block;
	font-size: 3.5em;
	height: 18px;
	margin: 0 auto;
	width: 18px;
}
.rating-block > .choose:hover, .rating-block > .choose.chosen {
	background-color: green;
}
.rating-block > a.choose.chosen:hover {
	background-color: red;
}
.rating-block > div.choose.chosen:hover {
	cursor: default;
}
/* rating-block in brief view */
.elgg-list .rating-block {
	border: 1px solid #DEDEDE;
	border-radius: 5px;
}
.elgg-list .rating-block .briefscore {
	font-weight: bold;
	border-bottom: 1px solid #DEDEDE;
}
.elgg-list .rating-block .briefscore > div {
	font-size: 2em;
}
.elgg-list .rating-block .answers {
	font-size: 0.8em;
	padding-top: 2px;
}
.elgg-list .rating-block .answers > div {
	font-size: 1.8em;
}

.question-content .question-post {
	border-bottom: 1px dotted #CCC;
	padding-bottom: 20px;
}
.question-view .elgg-annotation-list {
	margin-left: 20px;
}
.question-view .elgg-annotation-list .elgg-item {
	opacity: 0.75;
}
.question-view .elgg-annotation-list .elgg-item:hover {
	opacity: 1;
	background-color: #FCFCFC;
}
.question-view .elgg-item > .elgg-menu-annotation {
	float: none;
	display: none;
}
.question-view .elgg-item > .elgg-menu-annotation > li {
	height: 15px;
	margin-top: -6px;
}
.question-view .elgg-annotation-list .elgg-item:hover > .elgg-menu-annotation {
	display: inline;
}
.question-view .elgg-item > .elgg-menu-annotation a.gwf {
	font-size: 24px;
	margin-top: 0px;
}
.question-view .elgg-item > .elgg-menu-annotation .elgg-icon-delete:before {
	font-size: 42px;
}
.question-view a.add-comment {
	padding: 2px 10px 3px;
	color: #555;
}
.question-view a.add-comment.elgg-state-active {
	background-color: #DEDEDE;
	color: #333;
	display: block;
	float: left;
	font-size: 110%;
	font-weight: bold;
	margin: 10px 0 -1px;
}
.question-view a.add-comment.elgg-state-active:hover {
	text-decoration: none;
}
#comment-question {
	clear: both;
}
.question-view .elgg-form-comments-add label {
	display: none;
}
.question-answers > h3 {
	float: left;
	position: absolute;
}
.question-answers .elgg-menu-filter li {
	float: right;
}
.question-answers .elgg-menu-filter li:first-child {
	margin-right: 10px;
}
.question-view .elgg-item-answer {
	border-bottom: 1px solid #CCC;
}
.answer-content .elgg-image-block {
	border-bottom: 1px dotted #CCC;
}
.answer-content .elgg-image-block .elgg-body {
	padding-top: 7px;
}

#answers-characters-remaining.loading {
	background: url('<?php echo elgg_get_site_url(); ?>/mod/Answers-Plugin-for-Elgg-1.8/graphics/ajax-loader.gif') no-repeat scroll 0 6px transparent;
	padding-left: 20px;
}
.answers-highlight {
	background-color: yellow;
}
/*
.collapsible_box {
	background:#dedede;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	padding:5px 10px 5px 10px;
	margin:4px 0 4px 0;
	display:none;
}	

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
	font-size: 80%;
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
	background: transparent url(_graphics/icon_tag.gif) no-repeat scroll left 2px;
	margin: 1px 3px 3px;
	min-height: 22px;
	padding: 0 0 0 16px;
}

.topic_post table td {
	padding: 6px 0 6px 0;
}


.river_object_question_create, .river_object_question_update {
	background: url(mod/answers/graphics/river_icon_question.gif) no-repeat left -1px;
}

.river_object_question_answer, .river_object_answer_update {
	background: url(mod/answers/graphics/river_icon_answer.gif) no-repeat left -1px;
}

.river_object_question_choose {
	background: url(mod/answers/graphics/river_icon_choose.gif) no-repeat left -1px;
}

.river_object_question_comment, .river_object_answer_comment {
	background: url(mod/answers/graphics/river_icon_comment.gif) no-repeat left -1px;
}

.generic_comment_owner {
	font-size: 90%;
	color:#666666;
}
.generic_comment {
	background:#F0F0EE;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	padding:10px;
	margin:0 10px 10px 10px;
}
.generic_comment_icon {
	float:left;
}
.generic_comment_details {
	margin-left: 60px;
}
.generic_comment_details p {
	margin: 0 0 5px 0;
}
.generic_comment_owner {
	color:#666666;
	margin: 0px;
	font-size:90%;
	border-top: 1px solid #aaaaaa;
}
*/