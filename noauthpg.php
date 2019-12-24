<?php
// qui viene reindirizzato l'utente non loggato (o che non è ancora registrato)

// Variabili importanti
$pagename = "Chi sei? - ". NOME_APP; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************