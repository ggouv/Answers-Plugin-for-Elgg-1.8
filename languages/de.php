<?php
/**
 * English language file
 */

$english = array(
	
	/**
	 * Menu items and titles
	 */
	'answers' => "Antworten",
	'answers:add' => "Fragen",
	'answers:question' => "Frage",
	'answers:questions' => "Fragen",
	'answers:answers' => "Antworten",
	'answers:question:pretitle' => "Frage: ",
	'answers:answers:best' => "Beste Antwort",
	'answers:answers:other_answers' => 'Andere Antworten',
	'answers:answer' => "Antwort",
	'answers:user' => "%ss Fragen",
	'answers:user:friends' => "%ss folgende Fragen",
	'answers:your' => "Deine Fragen",
	'answers:group' => "Gruppenantworten",
	'answers:group:filter' => "Gruppen",
	'answers:group:pretitle' => "Gruppenfrage: ",
	'answers:group:title' => "Gruppenfragen",
	'answers:posttitle' => "%ss Fragen: %s",
	'answers:friends' => "Fragen von Freunden",
	'answers:everyone' => "Alle Fragen",
	'answers:via' => "über Fragen",
	'answers:read' => "Frage lesen",
	'answers:question:add' => "Eine Frage stellen",
	'answers:question:groupadd' => "Eine Frage in %s stellen",
	'answers:question:edit' => "Frage bearbeiten",
	'answers:question:fulltitle' => "%s",
	'answers:questiontitle' => "Frage",
	'answers:questiondetails' => "Zusätzliche Details",
	'answers:strapline' => "%s",
	'item:object:question' => 'Fragen',
	'item:object:answer' => 'Antworten',
	'answers:answer:add' => "Diese Frage beantworten",
	'answers:answer:answer' => "Antwort",
	'answers:answer:mustbeingroup' => "Du musst ein Mitglied von %s sein um diese Frage zu beantworten oder eine Frage zu stellen",
	'answers:questions:more' => "Mehr Fragen",
	'answers:questions:none' => "Keine Fragen vorhanden.",
	'groups:enableanswers' => "Gruppenfragen aktivieren",
	'answers:group:questions:none' => "Diese Gruppe hat noch keine Fragen",
	'answers:question:tooltip:edit' => "Frage beantworten",
	'answers:question:tooltip:delete' => "Frage löschen",
	'answers:answer:tooltip:delete' => "Antwort löschen",
	'answers:answer:tooltip:like' => "diese Antwort gefällt mir",
	'answers:answer:tooltip:dislike' => "diese Antwort gefällt mir nicht",
	'answers:answer:tooltip:unlike' => "Stimme entfernen",
	'answers:answer:tooltip:choose' => "diese Antwort als die Beste auswählen",
	'answers:question:new' => "Neue Frage",
	'answers:answer:new' => "Neue Antwort",
	'answers:comment:comment' => "Kommentieren",
	'answers:comment:save' => "Speichern",

	/**
	 * Answers river
	 */
	'question:river:created' => "%s fragte %s",
	'question:river:answered' => "%s beantwortete die Frage %s",
	'question:river:chosen' => "%s wählte die beste Antwort für die Frage %s",
	'question:river:updated' => "%s hat folgende Frage aktualisiert:",
	'question:river:comment:question' => "%s kommentierte die Frage %s",
	'question:river:comment:answer' => "%s kommentierte eine Antwort auf eine Frage",
	'answer:river:updated' => "%s hat eine Antwort auf folgende Frage aktualisiert:",

	/**
	 * Widget
	 */
	'answers:widget' => 'Die letzten Fragen anzeigen',
	'answers:widget:numbertodisplay' => 'Anzahl der Fragen',
	'answers:widget:type' => "Wessen Fragen angezeigt werden",

	/**
	 * Status messages
	 */	
	'answers:question:posted' => "Deine Frage wurde erfolgreich gestellt.",
	'answers:question:updated' => "Deine Frage wurde erfolgreich aktualisiert.",
	'answers:question:deleted' => "Deine Frage wurde erfolgreich gelöscht.",
	'answers:answer:posted' => "Deine Antwort wurde erfolgreich gestellt.",
	'answers:answer:updated' => "Deine Antwort wurde erfolgreich aktualisiert.",
	'answers:answer:deleted' => "Deine Antwort wurde erfolgreich gelöscht.",
	'answers:liked' => "Dir gefällt eine Antwort.",
	'answers:disliked' => "Dir gefällt eine Antwort nicht.",
	'answers:unliked' => "Dir gefällt eine Antwort nciht mehr.",
	'answers:answer:chosen' => "Deine Favoritenantwort wurde gespeichert.",
	'answers:comment:posted' => "Dein Kommentar wurde erfolgreich veröffentlicht.",
	'answers:comment:updated' => "Dein Kommentar wurde erfolgreich aktualisiert.",
	'answers:comment:deleted' => "Dein Kommentar wurde erfolgreich gelöscht.",

	/**
	 * Error messages
	 */
	'answers:answer:blank' => "Entschuldigung aber deine Antwort darf nicht leer sein.",
	'answers:error' => 'Etwas ist schief gegangen. Bitte verscuhe es erneut.',
	'answers:save:failure' => "Deine Antwort konnte nicht gespeichert werden, bitte versuche es erneut.",
	'answers:failure' => "Deine Antwort konnte nicht gespeichert werden, bitte versuche es erneut.",
	'answers:blank' => "Entschuldigung aber der Titel darf nicht leer sein",
	'answers:notfound' => "Entschuldigung aber wir konnten die Frage nicht finden",
	'answers:question:notdeleted' => "Entschuldigung aber wir konnten die Frage nicht löschen",
	'answers:liked:failure' => "Entschuldigung aber die Wertung konnte nicht vorgenommen werden.",
	'answers:disliked:failure' => "Entschuldigung aber die Wertung konnte nicht vorgenommen werden.",
	'answers:unliked:failure' => "Entschuldigung aber die Wertung konnte nicht vorgenommen werden.",
	'answers:comment:blank' => "Entschuldigung aber dein Kommentar darf nicht leer sein",
	
	/**
	 * Email Notifications
	 */
	'answers:notify:question:subject' => "%s hat gefragt \"%s\"",
	'answers:notify:answer:subject' => "%s hat folgende Frage beantwortet \"%s\"",
	
	'answers:notify:body' => "Link zu %s:\n%s",

	'answers:question:comment:email:subject' => "Frage Kommentieren: %s",
	'answers:answer:comment:email:subject' => "Antwort auf Frage kommentieren: %s",
	'answers:question:comment:email:body' => "%s hat eine Antwort auf folgende Frage gegeben: %s

Kommentar:
%s

Link zum Kommentar:
%s
",
	'answers:answer:comment:email:body' => "%s hat eine antwort auf folgende Frage gegeben:: %s

Kommentar:
%s

Link zum Kommentar:
%s
",
	'river:comment:object:default' => '%s kommentierte eine Frage.'

);
					
add_translation("de", $english);
