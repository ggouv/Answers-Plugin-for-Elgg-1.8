<?php
/**
 * English language file
 */

$english = array(
	
	/**
	 * Menu items and titles
	 */
	'answers' => "Questions",
	'answers:add' => "New question",
	'answers:question' => "Question",
	'answers:questions' => "Questions",
	'answers:answers' => "Answers",
	'answers:question:pretitle' => "Question: ",
	'answers:answers:best' => "Best Answer",
	'answers:answers:other_answers' => 'Other Answers',
	'answers:answer' => "Answer",
	'answers:user' => "%s's questions",
	'answers:user:friends' => "%s's following questions",
	'answers:your' => "Your questions",
	'answers:group' => "Group answers",
	'answers:group:filter' => "Groups",
	'answers:group:title' => "Groupquestions",
	'answers:group:pretitle' => "Groupquestion: ",
	'answers:posttitle' => "%s's questions: %s",
	'answers:friends' => "Friends' questions",
	'answers:everyone' => "All site questions",
	'answers:via' => "via questions",
	'answers:read' => "Read questions",
	'answers:question:add' => "Ask a question",
	'answers:question:groupadd' => "Ask a question in %s",
	'answers:question:edit' => "Edit question",
	'answers:question:fulltitle' => "%s",
	'answers:questiontitle' => "Question",
	'answers:questiondetails' => "Additional details",
	'answers:strapline' => "%s",
	'item:object:question' => 'Questions',
	'item:object:answer' => 'Answers',
	'answers:answer:add' => "Answer this question",
	'answers:answer:answer' => "Answer",
	'answers:answer:mustbeingroup' => "You must be a member of %s to answer or comment on this question.",
	'answers:questions:more' => "More questions",
	'answers:questions:none' => "There are no questions here.",
	'groups:enableanswers' => "Enable group answers",
	'answers:group:questions:none' => "This group does not have any questions yet",
	'answers:question:tooltip:edit' => "Edit question",
	'answers:question:tooltip:delete' => "Delete question",
	'answers:answer:tooltip:delete' => "Delete answer",
	'answers:answer:tooltip:like' => "'like' this answer",
	'answers:answer:tooltip:dislike' => "'dislike' this answer",
	'answers:answer:tooltip:unlike' => "remove vote",
	'answers:answer:tooltip:choose' => "choose this answer as best",
	'answers:question:new' => "New question",
	'answers:answer:new' => "New answer",
	'answers:comment:comment' => "Add Comment",
	'answers:comment:save' => "Post",

	/**
	 * Answers river
	 */
	'question:river:created' => "%s asked %s",
	'question:river:answered' => "%s answered the question %s",
	'question:river:chosen' => "%s chose the best answer to the question %s",
	'question:river:updated' => "%s updated the question",
	'question:river:comment:question' => "%s commented on the question %s",
	'question:river:comment:answer' => "%s commented on an answer to a question",
	'answer:river:updated' => "%s updated an answer to the question",

	/**
	 * Widget
	 */
	'answers:widget' => 'Display the latest questions',
	'answers:widget:numbertodisplay' => 'Number of questions',
	'answers:widget:type' => "Who's questions to display",

	/**
	 * Status messages
	 */	
	'answers:question:posted' => "Your question was successfully posted.",
	'answers:question:updated' => "Your question was successfully updated.",
	'answers:question:deleted' => "Your question was successfully deleted.",
	'answers:answer:posted' => "Your answer was successfully posted.",
	'answers:answer:updated' => "Your answer was successfully updated.",
	'answers:answer:deleted' => "Your answer was successfully deleted.",
	'answers:liked' => "You 'liked' an answer.",
	'answers:disliked' => "You 'disliked' an answer.",
	'answers:unliked' => "You 'unliked' an answer.",
	'answers:answer:chosen' => "Your favorite answer was successfully chosen.",
	'answers:comment:posted' => "Your comment was successfully posted.",
	'answers:comment:updated' => "Your comment was successfully updated.",
	'answers:comment:deleted' => "Your comment was successfully deleted.",

	/**
	 * Error messages
	 */
	'answers:answer:blank' => "Sorry; your answer must not be blank.",
	'answers:error' => 'Something went wrong. Please try again.',
	'answers:save:failure' => "Your answers post could not be saved. Please try again.",
	'answers:failure' => "Your answer could not be saved. Please try again.",
	'answers:blank' => "Sorry; your question title can't be blank.",
	'answers:notfound' => "Sorry; we could not find the specified question.",
	'answers:question:notdeleted' => "Sorry; we could not delete this question.",
	'answers:liked:failure' => "Sorry; we failed to save your 'like'.",
	'answers:disliked:failure' => "Sorry; we failed to save your 'dislike'.",
	'answers:unliked:failure' => "Sorry; we failed to save your 'unlike'.",
	'answers:comment:blank' => "Sorry; your comment must not be blank.",
	
	/**
	 * Email Notifications
	 */
	'answers:notify:question:subject' => "%s asked \"%s\"",
	'answers:notify:answer:subject' => "%s answered the question \"%s\"",
	
	'answers:notify:body' => "Link to %s:\n%s",

	'answers:question:comment:email:subject' => "Comment on question: %s",
	'answers:answer:comment:email:subject' => "Comment on answer to question: %s",
	'answers:question:comment:email:body' => "%s posted a comment on the question: %s

Comment text:
%s

Link to comment:
%s
",
	'answers:answer:comment:email:body' => "%s posted a comment on an answer to the question: %s

Comment text:
%s

Link to comment:
%s
",
    'river:comment:object:default' => '%s commented on a question.'

);
					
add_translation("en", $english);
