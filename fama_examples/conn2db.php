<?php


// ATTENZIONE: CREDENZIALI DI CONNESSIONE DIFFERENTI 

try {
	$hostname = 'localhost';
	$dbname = 'my_fuzzlernet';
	$username = 'fuzzlernet';
	$password = '';
	$conn2mfn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
	//echo "Connessione A: Ok! <br /> ";

	if($conn2mfn == null) {
		die("Oggetto nullo!");
	}
} 
catch (PDOException $e) {
	echo "Errore Conn. A! <br /> ". $e->getMessage();
}


if ($conn2mfn->connect_error) {
	echo 'Errore di connessione (' . $conn2mfn->connect_errno . ') '. 
	$conn2mfn->connect_error.$conn2mfn->host_info . "\n";
}


?>
