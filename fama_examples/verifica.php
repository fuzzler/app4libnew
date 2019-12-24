<?php

session_start();
require_once("conn2db.php");

// CONTROLLO CONNESSIONE
if ($conn2mfn->connect_error) 
	echo 'connessione fallita: '.$conn2mfn->connect_error;
else
	echo "connessione a <b> MyFuzzlerNet </b> riuscita! <br><br>";


var_dump($conn2mfn);

// CONTROLLI LOGIN

$username = $_POST['user'];
$password = $_POST['pw'];



//$query = "SELECT username,password FROM my_fuzzlernet.login_fama WHERE username='".$username."' AND password=PASSWORD('".$password."')";
            
$query = "SELECT username,password FROM my_fuzzlernet.login_fama WHERE username= :username AND password=PASSWORD(:password)";          


$stmt = $conn2mfn->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',$password);
$stmt->execute();


$res = $stmt->rowCount(); // conta le righe (result) ritornate dal DB
echo "Conto righe: ".$res; //die;



if($res) { 
	//echo "<br>passato<br>";
	unset($_SESSION['error']);
    $_SESSION['username'] = $_POST['user'];
	$_SESSION['password'] = $_POST['pw'];
	header('Location: countdown.php');
}
else {
	//echo "<br>fallito<br>";
	$_SESSION['error'] = "Utente o Password errati! Riprovare...";
	header('Location: login.php');	
}
		
/*
echo "<br>POST<br>";
var_dump($_POST);
echo "<br>SESSION<br>";
var_dump($_SESSION);
echo "<br>Statement<br>";
var_dump($stmt);
echo "<br>RES<br>";
var_dump($res);
echo "<br>Row<br>";
var_dump($row);
*/

?>

