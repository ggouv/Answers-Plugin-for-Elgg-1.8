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
	cursor: pointer;
}
.elgg-list .rating-block .answers a {
	text-decoration: none;
}
.elgg-list .rating-block .answers div {
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
#question-answers > h3 {
	float: left;
	position: absolute;
}
#question-answers .elgg-menu-filter li {
	float: right;
}
#question-answers .elgg-menu-filter li:first-child {
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