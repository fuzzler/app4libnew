<?php
// file di connessione al DB
// echo "CONNECTION 2 DB FILE INCLUDED!";

try {
	$hostname = 'localhost';
	$dbname = 'my_fuzzlernet';
	$username = 'fuzzlernet';
	$password = '';
	$dbo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
	
    //var_dump($dbo);
	//if($dbo == null) {die("Oggetto nullo!");}else {echo "Connessione A: Ok! <br /> ";}
} 
catch (PDOException $e) {
	echo "Errore Conn. A! <br /> ". $e->getMessage();
}

