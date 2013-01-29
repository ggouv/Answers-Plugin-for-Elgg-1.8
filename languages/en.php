<?php
/**
 * English language file
 */

$english = array(
	
	/**
	 * Menu items and titles
	 */
	'answers' => "Questions",
	'answers:add' => "Add question",
	'answers:question' => "Question",
	'answers:questions' => "Questions",
	'answers:answers' => "Answers",
	'answers:question:pretitle' => "Question: ",
	'answers:answers:best' => "Best Answer",
	'answers:answers:other_answers' => 'Other Answers',
	'answers:answer' => "Answer",
	'answers:owner' => "%s's questions",
	'answers:user:friends' => "%s's following questions",
	'answers:your' => "Your questions",
	'answers:group' => "Group questions",
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
	'answers:questions:more' => "More questions",
	'answers:questions:none' => "There are no questions here.",
	'groups:enableanswers' => "Enable group questions",
	'answers:group:questions:none' => "This group does not have any questions yet",
	'answers:question:tooltip:edit' => "Edit question",
	'answers:answer:tooltip:delete' => "Delete answer",
	'answers:answer:tooltip:like' => "'like' this answer",
	'answers:answer:tooltip:dislike' => "'dislike' this answer",
	'answers:answer:tooltip:unlike' => "remove vote",
	'answers:answer:tooltip:choose' => "choose this answer as best",
	'answers:answer:tooltip:bestanswer' => "This answer was chosen as best answer by question's owner",
	'answers:question:new' => "New question",
	'answers:answer:new' => "New answer",
	'answers:answer:edit' => "Edit answer",
	'answers:comment:comment' => "Add Comment",
	'answers:comment:save' => "Post",
	'answers:score:one' => "vote",
	'answers:score:more' => "votes",
	'answers:search_and_submit' => "Search or submit question:",
	'answers:charleft' => "chars left.",
	'answers:search:skip_words' => "the,and,for,are,but,not,you,all,any,can,her,was,one,our,out,day,get,has,him,his,how,man,new,now,old,see,two,way,who,boy,did,its,let,put,say,she,too,use,dad,mom", // write words you want to skip separate by coma. Automaticaly skip word less than 3 chars, don't write them.
	'answers:search:submit_and_content' => "Check before the search results below to see whether the question is already covered. If not, you can ",
	'answers:search:submit_no_content' => "There were no result matching the query. You can ",
	'answers:search:no_content' => "There were no result matching the query.",
	
	/**
	 * Answers river
	 */
	'answers:river:answered' => "answered",
	'answers:river:best_answer' => "the best answer",
	'answers:river:the_answer' => "an answer",
	'question:river:created' => "%s asked the question %s %s",
	'question:river:answered' => "%s %s the question %s %s",
	'question:river:answer:comment' => "%s commented %s of the question %s %s",
	'question:river:chosen' => "%s chose %s to the question %s %s",
	'question:river:updated' => "%s updated the question",
	'river:comment:object:question' => "%s commented the question %s",
	'river:comment:object:answer' => "%s commented an answer to the question %s",
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
	'answers:answer:posted' => "Your answer was successfully posted.",
	'answers:answer:updated' => "Your answer was successfully updated.",
	'answers:answer:mustbeingroup' => "You must be a member of %s to answer or comment on this question.",
	'answers:deleted' => "Deletion was successful.",
	'answers:liked' => "You 'liked' an answer.",
	'answers:disliked' => "You 'disliked' an answer.",
	'answers:unliked' => "You 'unliked' an answer.",
	'answers:answer:chosen' => "Your favorite answer was successfully chosen.",
	'answers:answer:notchosen' => "Your must be owner of the question to choose favorite answer.",

	/**
	 * Error messages
	 */
	'answers:question:blank' => "The question cannot be blank",
	'answers:answer:blank' => "Sorry; your answer must not be blank.",
	'answers:error' => 'Something went wrong. Please try again.',
	'answers:save:failure' => "Your answers post could not be saved. Please try again.",
	'answers:failure' => "Your answer could not be saved. Please try again.",
	'answers:blank' => "Sorry; your question title can't be blank.",
	'answers:notfound' => "Sorry; we could not find the specified question.",
	'answers:notdeleted' => "Sorry; deletion failed.",
	'answers:liked:failure' => "Sorry; we failed to save your 'like'.",
	'answers:liked:failure:owner' => "Sorry; you cannot like your own answer.",
	'answers:disliked:failure' => "Sorry; we failed to save your 'dislike'.",
	'answers:unliked:failure' => "Sorry; we failed to save your 'unlike'.",
	
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

);
					
add_translation("en", $english);
