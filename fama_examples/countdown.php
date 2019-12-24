<?php

session_start();

// Verifica che ci si trovi in una sessione valida
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
	header('Location: login.php');

$page=$_SERVER['PHP_SELF'];
//header('Refresh: 1; url=' . $page);

$dest = mktime(20, 30, 40, 06, 18, 19);

//$destpro = mktime(16, 58, 00, 01, 14, 19);

$now = time();

$cdsec = $dest - $now ;

$data = date('d-m-y H:i:s',$dest);

//$datapro = date('d-m-Y H:i:s',$destpro);

if(date('H') == 21 && date('i') > 50)
	//header("Refresh:1; url=famapage.php");

//echo "<br><br>";

?>

<! DOCTYPE HTML>
<html lang="it">

<head>
	<meta charset="UTF-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> FaMaPage - Countdown </title>

<style type="text/css">

/* IMPORT dei font dalle API di google ( https://fonts.google.com/ ) */
@import url('https://fonts.googleapis.com/css?family=Charm:700');
@import url('https://fonts.googleapis.com/css?family=Charm');
@import url('https://fonts.googleapis.com/css?family=Shadows+Into+Light');


body {
	background-color: #FCA0D1;
	background-image: url("famaimg/heart.png");
	background-repeat: no-repeat; /* nel caso l'immagine sia piccola non la ripete (
							altre opzioni REPEAT-X | REPEAT-Y */
	background-size: 1100px 950px; /* altre opzioni COVER = la adatta alla pagina
							CONTAIN = la inserisce nella pagina con le dimensioni originali */
	background-position: top center; /* altre opzioni LEFT , RIGHT , TOP , BOTTOM , 
						PIXEL (numero di pixel di collocamento) , % (numero in percentuale) 
						! IMP ! => se non si mettono due valori adatta il primo */
	color: white;
	font-family: Verdana, "Times New Roman", serif, sans-serif; 
	/* Mettendo più font verrà selezionato il primo che trova sulla macchina ospite, se manca Verdana
	shifterà su Times New Roman ... ( => quest'ultimo va tra virgolette perchè ci sn degli spazi nel nome)
	*/
	font-size: 27px;
	/* Ci sono quattro modalità per esprimere la grandezza del testo: 
		* Pixel (px -> Consigliata!) 
		* Percentuale (%) adatta in percentuale (non attendibile -> meglio lavorare con la responsività)
		* EM => ereditato dalla tipografia (poco usato)
		* Attributi: small, large ...
	*/
	
}

h1 {
	color: #71045D;
	font-family: "Charm:700", 'Charm', cursive, Verdana, arial;
	font-size: 67px;
	font-weight: bolder;
	/* Ci sono due modalità per esprimere la grassezza del testo: 
		* numero da 100 a 900 (non frammentabile -> non esiste 635)
		* Attributi: bold, bolder, normal (default equivale a 400), lighter ...
	*/
}

h3 {
	color: yellow;
	font-family: 'Charm', cursive, arial;
	font-size: 53px;
	font-style: oblique; /* ci sono 3 attributi: normal (default), oblique e italic */
}

p {

	color: white;
	font-family: serif;
	font-size: 50px;
	font-style: oblique;
	font-weight: bolder;

}

#data {

	background-color: #F114C9;
	color: white;
	font-family: serif;
	font-size: 45px;
	font-style: oblique;
	font-weight: bolder;
	width: 550px;
	height: 70px;
	padding-top:5px;

}

#heart2 {
	width: 35px;
    height: 35px;
}

#ap {
	color: #2D0595;
	font-family: 'Shadows Into Light', cursive;
	font-size: 59px;
	width: 850px;
	height: 79px;
	border-width: 10px; /* thick, thin, medium ... Npx */
	border-color: lightblue;
	border-style: double; /* solid, dotted, double,  */
	border-radius: 20px; /* smussatura angoli dei border */
	text-shadow: 2px 0px white;
	text-decoration: overline underline;
}





a {
	color: yellow;
	font-family: arial;
	font-size: 20px;
}

/* PSEUDO CLASSE -> regola lo stato di un link */


#data:link {
	color: yellow;
	font-family: arial;
	font-size: 55px;
}

#data:visited {
	color: red;
	font-family: arial;
	font-size: 55px;
}

#data:hover {
	color: orange;
	font-family: arial;
	font-size: 55px;
	text-decoration:none;
}

#data:active {
	color: green;
	font-style: oblique;
	font-size: 55px;
	text-decoration:none;
}

#orologio {
	padding:30px;
	color: white;
	font-size: bold;
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

<body onload="OrologioScorrevole()">

<div style="width: 1200px; height: 20px;">
<p class="pa"><a href="logout.php"> Logout </a></p>
</div>




<!-- JAVASCRIPT CHE EMULA UN COUNTDOWN -->

<script>
// Set the date we're counting down to
var countDownDate = new Date("Jun 18, 2019 20:30:40").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="ap"
  document.getElementById("ap").innerHTML = days + " gg " + hours + " ore "
  + minutes + " min " + seconds + " sec ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("ap").innerHTML = "EXPIRED";
	location.href = "famapage.php";
  }
}, 1000);


function OrologioScorrevole()
{
    var data = new Date();
    var hh = data.getHours();
    var mm = data.getMinutes();
    var ss = data.getSeconds();
    var ora = hh + ":" + mm + ":" + ss;
    document.getElementById("orologio").innerText = ora;
    window.setTimeout("OrologioScorrevole()", 1);
}

</script>


<center>


<h1> Pagina di F & M (since 1998 to ...) </h1>

<h3> Al prossimo incontro del... </h3>

<p id="data"> <?= $data ?> </p>

<p id="m"> Mancano... </p>

<p id="ap"> </p>
<br /><br /><br />

</center>


<a href="famapage.php"> <img id="heart2" src="famaimg/heart.png" /> </a>

</body>
</html>
