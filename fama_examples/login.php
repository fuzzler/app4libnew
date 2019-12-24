<?php

session_start();
require_once("../conn2db.php");

$page = "FaMaPage";
$nome1 = "FABRIZIO";
$nome2 = "MANUELA";

?>

<html>

<head>

<title> 
Login di <?= isset($_SESSION['username'])? $page : str_shuffle($page) ?> 
</title>

<link rel="stylesheet" type="text/css" href="style.css" >

<style type="text/css">

	body {
		background-color: pink;
		font-size: 30px;
		color: red;
	}

	h1 {
		color: white;
		font-size:55px;
		text-shadow: 2px 2px 2px red;
	}

	h3 {
		color: #FA5C98;               /* colore del testo    */
		font-size: 35px;
		font-weight: bold;         /* testo in grassetto  */
		text-decoration: underline;
		text-shadow: 2px 2px 2px white;
	}

	fieldset {
		background-color: #D1F9F4; 
		border: 3px solid #FA5C98; 
		border-radius: 15px;
		height: 320px; 
		width: 530px;
	}

	legend {
		background-color: red; 
		border: 3px solid #FA5C98; 
		border-radius: 15px;
		color: white; 
		font-size: 30px;
		padding: 5px 7px;
	}

	#login {
		background-color: #FAD8E9; /* colore di sfondo    */
		border: 3px solid red; /* bordo dell'elemento */ 
		border-radius: 15px;
		font-size: 30px;
		font-weight: bold;         /* testo in grassetto  */
		padding: 2px;                /* padding             */
		margin: 5px;
		height: 59px;              /* altezza             */
		width: 399px;               /* larghezza           */
	}

	#submit {
		background-color: #F9D1E0; /* colore di sfondo    */
		border: 3px solid red; /* bordo dell'elemento */ 
		border-radius: 15px;
		font-size: 30px;
		font-weight: bold;         /* testo in grassetto  */
		color: red;
		margin-top: 15px;
		padding-bottom: 8px;
		padding-top: 0px
		height: 40px;              /* altezza             */
		width: 150px;               /* larghezza           */
	}

	.error {
		background-color: yellow; /* colore di sfondo    */
		color: blue;               /* colore del testo    */
		font-size: 25px;
		font-weight: bold;         /* testo in grassetto  */
		text-decoration: underline;
		width: 320px;
	}

	.err_sugg {
		color: blue;
		font-size: 20px;
	}

	.pa {
		float: right;
		margin-top: 0px;
		clear: both;
		font-family: Arial;
		font-size:20px;
	}

</style>

</head>

<body>


<?php

if(isset($_SESSION['username'])) {

	if($_SESSION['username'] == 'fazione33')
		$username = 'Fabrizio';
	if($_SESSION['username'] == 'manuelapg')
		$username = 'Manuela';

	$nome1 = "FABRIZIO";
	$nome2 = "MANUELA";
?>
	<div style="width: 1200px; height: 20px;">
	<p class="pa"><a href="logout.php"> Logout </a></p>
	</div>
<?php
}
else {
	$username = "";
	$nome1 = str_shuffle("FABRIZIO");
	$nome2 = str_shuffle("MANUELA");
}

?>


<center>
<h1> Benvenuto <?= $username ?> nella pagina di </h1>
<h1><?= $nome1 ?> e di <?= $nome2 ?> </h1>
<h3 > Inserisci le tue credenziali per accedere alla Pagina </h3>


<?php

if(isset($_SESSION['error'])) {
	echo '<p class="error"> '.$_SESSION['error'].'</p>';
	echo '<p class="err_sugg"> Controlla di scrivere correttamente sia nome utente che password </p>';
	echo '<p class="err_sugg"> Verifica che non ci sia il BLOCC MAIUSC inserito </p>';	
}


	
?>


<fieldset>

<legend> 
ACCEDI AL SITO
</legend>

<!-- form inserimento libri --> 

<form action="verifica.php" method="POST" >

<table>
<tr>
	<td><b> (*) </b></td>
	<td>
		<cite title="Inserisci qui lo Username">
		<input type="text" placeholder="Username" name="user" id="login" required/> 
		</cite>

	</td>
</tr>
<tr>
	<td><b> (*)  </b></td>
	<td>
		<cite title="Inserisci qui la PassWord">
		<input type="password" placeholder="Password" name="pw" id="login" required/> 
		</cite>
	</td>
</tr>

</table>
<input type="submit" value="Entra" id="submit" />

</form>
(*) = Obbligatorio
</fieldset>

<br>

<!--
<details>
	<summary> <b>Scopri di più... </b> (espandibile...) </summary>
	<p> L'utenza <b>Ospite</b> (Guest) permette di cercare un libro per volta. </p>
	<p> Inoltre i <b><u>dati non saranno salvati</u></b> quindi non saranno più disponibili se si esce dalla pagina. </p>
	<p> E' fortemente consigliato registrarsi, basta un minuto.  </p>
</details>
-->

</center>



<br><br><br><br>

</body>
</html>
