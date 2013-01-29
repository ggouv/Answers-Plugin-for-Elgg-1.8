<?php
/**
 * French language file
 */

$french = array(
	
	/**
	 * Menu items and titles
	 */
	'answers' => "Questions",
	'answers:add' => "Ajouter une question",
	'answers:questions' => "Questions",
	'answers:answers' => "Réponses",
	'answers:answer' => "Réponse",
	'answers:owner' => "Questions de %s",
	'answers:user:friends' => "%s's following questions",
	'answers:your' => "Mes questions",
	'answers:group' => "Questions du groupe",
	'answers:friends' => "Questions de vos abonnés",
	'answers:everyone' => "Toutes les questions du site",
	'answers:question:edit' => "Modifier la question",
	'item:object:question' => 'Questions',
	'item:object:answer' => 'Réponses',
	'groups:enableanswers' => "Activer les questions/réponses pour le groupe",
	'answers:group:questions:none' => "Ce groupe n'a pas de question pour l'instant.",
	'answers:answer:tooltip:choose' => "Choisir cette réponse comme étant celle qui répond le mieux à votre question",
	'answers:answer:tooltip:bestanswer' => "Cette réponse est celle qui répond le mieux à la question",
	'answers:question:new' => "Nouvelle question",
	'answers:answer:new' => "Nouvelle question",
	'answers:score:one' => "vote",
	'answers:score:more' => "votes",
	'answers:none' => "Il n'y a pas encore de question, posez-en une !",
	'answers:newest' => "Plus récentes",
	'answers:votes' => "Plus votées",
	'answers:activity' => "Plus actives",
	'answers:unanswered' =>"Non répondues",
	'answers:oldest' => "Plus anciennes",
	
	
	/**
	 * Forms
	 */
	'answers:questiondetails' => "Détails supplémentaires",
 	'answers:answer:add' => "Répondre à cette question",
	'answers:answer:edit' => "Modifier la réponse",
	'answers:answer:answer' => "Réponse",
 	'answers:search_and_submit' => "Cherchez ou soumettez une question :",
	'answers:charleft' => "caractères restants.",
	'answers:search:skip_words' => "une,sans,avec,des,dans,pour,car,que,qui,mais,est,donc,elle,elles,nous,vous,ils,son,ses,ici,oui,non,toi,ton",
	'answers:search:submit_and_content' => "Regardez d'abord dans les résultats suivant si la question n'a pas déjà été posée, si non, vous pouvez ",
	'answers:search:submit_no_content' => "Aucune question ne correspond à votre recherche. Vous pouvez ",
	'answers:search:no_content' => "Aucune question ne correspond à votre recherche.",
	
	
	/**
	 * Answers river
	 */
	'answers:river:answered' => "répondu",
	'answers:river:best_answer' => "la meilleure réponse",
	'answers:river:the_answer' => "cette réponse",
	'river:create:object:question' => "%s a posé la question %s",
	'question:river:answered' => "%s %s la question %s %s",
	'question:river:answer:comment' => "%s commenté %s à la question %s %s",
	'question:river:chosen' => "%s a choisi %s à la question %s %s",
	'river:comment:object:question' => "%s commenté la question %s",
	'river:comment:object:answer' => "%s commenté une réponse à la question %s",

	/**
	 * Widget
	 */
	'answers:widget' => 'Afficher les dernières questions',
	'answers:widget:numbertodisplay' => 'Nombre de questions',
	'answers:widget:type' => "Who's questions to display",

	/**
	 * Status messages
	 */	
	'answers:question:posted' => "Votre question a bien été publiée.",
	'answers:answer:posted' => "Votre réponse a bien été publiée.",
	'answers:answer:updated' => "Votre réponse a été mise à jour.",
	'answers:answer:mustbeingroup' => "Vous devez être membre de %s pour répondre ou commenter cette question.",
	'answers:deleted' => "La question a été supprimée.",
	'answers:answer:chosen' => "Votre choix a été enregistré.",
	'answers:answer:notchosen' => "Vous devez être le propriétaire de la question pour choisir une réponse.",

	/**
	 * Error messages
	 */
	'answers:question:blank' => "Vous devez détailler votre question.",
	'answers:answer:blank' => "Désolé, votre réponse ne peut pas être vide.",
	'answers:error' => "Une erreur s'est produite, essayez de nouveau.",
	'answers:answer:failure' => "Votre réponse n'a pas pu être enregistrée, essayez de nouveau.",
	'answers:question:blank' => "Désolé, le titre de la question ne peut pas être vide.",
	'answers:notfound' => "Désolé, la question n'a pas été trouvée.",
	'answers:notdeleted' => "Désolé, la suppression a échouée.",
	'answers:vote:failure' => "Désolé, votre vote n'a pas pu être pris en compte.",
	'answers:vote:failure:owner' => "Désolé, vous ne pouvez pas voter pour vous.",
	
	/**
	 * Email Notifications
	 */
	'answers:notify:question:subject' => "%s demande \"%s\"",
	'answers:notify:answer:subject' => "%s a répondu à la question \"%s\"",
	
	'answers:notify:body' => "Lien sur %s :\n%s",

	'answers:question:comment:email:subject' => "Commenté la question : %s",
	'answers:answer:comment:email:subject' => "Commenté la réponse à la question: %s",
	'answers:question:comment:email:body' => "%s a commenté la question: %s

Texte du commentaire :
%s

Lien du commentaire :
%s
",
	'answers:answer:comment:email:body' => "%s a posté un commentaire à la réponse à la question : %s

Texte du commentaire :
%s

Lien du commentaire :
%s
",

);
					
add_translation("fr", $french);
