<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libri Usati - V.2.0.0 by Fuzz</title>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">    
    </script>
	
	<style>
	
		body {
			background-color: #E5FEA2;
		}

		a {
			color: black;
		}

		a:visited {
			color: black;
		}

		a:hover {
			color: purple;
		}
	
		.pulsante {
			height: 45px;
			width: 135px;
			background-color: green;
			color: lightblue;
			font-size: 25px;
			font-weight: bolder;
		}

		.pulsante:hover {
			background-color: yellow;
			color: green;
			cursor: pointer;
		}
        
        #ses_lat {
        	float: right;
        	text-align: right;
            color: darkgreen;
        }

	</style>
</head>

<body>
<?php
if(!isset($_SESSION['count'])) {
	$_SESSION['count'] = 0;
    ?><span id="ses_lat"> N.Ses: <?php echo count($_SESSION['count']) ?></span><?php
}
?>

<h3> Chiudi Sessione Corrente </h3>
<form action="" method="POST">
<input type="submit" value="CHIUDI" name="EOS" class="pulsante" > 
</form>

<?php

// Requirements:
// *************

session_start();

error_reporting(1);
ini_set('display_errors', 2);

require_once('functions.php');
//require_once('conn2db.php');


// Se è settato End Of Session
if(isset($_POST['EOS'])) {
	session_destroy();
	header("Location: indexA4L.php");
}

while($_SESSION['count'] < 5) {
	// ricarico la pagina
	header("Location: indexA4L.php");
	$_SESSION['count']++;
	
	//if(count($_SESSION['count'] > 3)) $_POST = [];	
}

//var_dump($_SESSION);
//echo count($_SESSION['n_usato']);

$n_usato = 0;
$titoli = [];

if(isset($_SESSION['titoli'])) {
	$titoli = $_SESSION['titoli'];
	$n_usato = count($_SESSION['titoli']);
	$_SESSION['titoli'] = [];
}

//$color = 'blue';
$color = ($n_usato > 0) ? 'green' : 'red';

echo "<h3>Usati disponibili: <span style=\"color: $color ;\" >".$n_usato."</span></h3>";

echo "<b><u>Titoli Usati:</u></b> <br><ul>";

foreach($titoli as $titolo) {

	echo '<li><a href="'.current($titolo).'" target="_blank">'.key($titolo).' </li>';
}

echo "</ul>";


/*
STAMPE DI PROVA -> CANCELLABILI DEBUG
$prova = " 12,34 ";
$prova2 = str_replace(",",".",$prova);

$prova2 = trim($prova2);

if(is_numeric($prova2)) {
    echo "<h1>$prova2 E' un cazzo di numero! </h1>";
}
else {
    echo "<h1>$prova2 NON E' un cazzo di minchia di numero! </h1>";
}
*/

// indirizzi di prova
/*
$urls = [
	'sconto + ebook' => 'https://www.libraccio.it/libro/9788858135815/stefano-mancuso/nazione-delle-piante.html',
	'usato' => 'https://www.libraccio.it/libro/9788891908216/al-kelley-ira-pohl/c-didattica-e-programmazione-ediz-mylab-con-contenuto-digitale-per-download-e-accesso-on-line.html',
	'ebook' => 'https://www.libraccio.it/libro/9788809831360/stefano-mancuso/plant-revolution.html',
	'ctrl' => 'https://www.libraccio.it/libro/9788833620008/jerry-richardson/introduzione-alla-pnl-come-capire-e-farsi-capire-meglio-usando-programmazione-neuro-linguistica.html',
	'ctrl2' => 'https://www.libraccio.it/libro/9788897461784/elisa-martinez-garrido/romanzi-di-elsa-morante-scrittura-poesia-ed-etica.html',
	'ctrl3' => 'https://www.libraccio.it/libro/9788876158377/tom-wolfe/decennio-io.html',
	'ctrl4' => 'https://www.libraccio.it/libro/9788881184163/palladio-nel-nord-europa-libri-viaggiatori-architetti.html',
	'ebook2' => 'https://www.libraccio.it/libro/9788868952471/justin-seitz/python-per-hacker-tecniche-offensive-black-hat.html',
	'usato2 + ebook' => 'https://www.libraccio.it/libro/9788850333776/steve-prettyman/programmare-con-php-7.html'
];
*/

// indirizzi di produzione (da inserire nel DB)

$urls = [
	'https://www.libraccio.it/libro/9788848140317/enrico-zimuel/sviluppare-in-php-7-realizzare-applicazioni-web-e-api-professionali.html',
    'https://www.libraccio.it/libro/9788891908254/andrew-s-tanenbaum-david-j-wetherall/reti-di-calcolatori-ediz-mylab-con-aggiornamento-online-con-ebook.html',
	'https://www.libraccio.it/libro/9788891902542/james-f-kurose-keith-w-ross/reti-di-calcolatori-e-internet-un-approccio-top-down-ediz-mylab-con-etext-con-aggiornamento-online.html',
    'https://www.libraccio.it/libro/9788850334797/silvio-umberto-zanzi/linux-server-per-amministratore-di-rete-guida-per-sfruttare-con-successo-linux-in-azienda.html',
	'https://www.libraccio.it/libro/9788850332267/marc-wandschneider/node-js-creare-applicazioni-web-in-javascript.html',
	"https://www.libraccio.it/libro/9788820383022/claudio-de-sio-cesari/manuale-di-java-9-programmazione-orientata-agli-oggetti-con-java-standard-edition-9.html",

    
    "https://www.libraccio.it/libro/9788848131209/enrico-zimuel/sviluppare-in-php-7-realizzare-applicazioni-web-e-api-professionali.html",

    "https://www.libraccio.it/libro/9788850334056/jon-duckett/javascript-e-jquery-sviluppare-interfacce-web-interattive-con-contenuto-digitale-per-download-e-accesso-on-line.html",
	'https://www.libraccio.it/libro/9788891909138/luciano-m-barone-enzo-marinari-giovanni-organtini/programmazione-scientifica-linguaggio-c-algoritmi-e-modelli-nella-scienza-ediz-mylab-con-contenuto-digitale-per-download-e-accesso-on-line.html',
	//"https://www.libraccio.it/libro/9788820385255/daniele-bochicchio-stefano-mostarda/html-5-con-css-e-javascript.html",
	//"https://www.libraccio.it/libro/9788899040178/antonio-agliata-mariarita-de-gregorio/html5-tutorial-pratici.html",
	//"https://www.libraccio.it/libro/9788868952310/alessandra-salvaggio/html5-e-css3-guida-completa.html",
	//"https://www.libraccio.it/libro/9788850331314/pellegrino-principe/html5-css3-javascript.html",
	//"https://www.libraccio.it/libro/9788850334049/jon-duckett/html-e-css-progettare-e-costruire-siti-web-con-contenuto-digitale-per-download-e-accesso-on-line.html",
	// Curiosità..
	"https://www.libraccio.it/libro/9788820383145/roberto-garavaglia/tutto-su-blockchain-capire-tecnologia-e-nuove-opportunita.html",
	'https://www.libraccio.it/libro/9788820389253/gianluca-chiap-jacopo-ranalli-raffaele-bianchi/blockchain-tecnologia-e-applicazioni-per-business.html',
	"https://www.libraccio.it/libro/9788848136037/domenico-trisciuoglio/witricity-un-mondo-senza-fili.html",
	"https://www.libraccio.it/libro/9788850332007/stuart-mcclure-george-kurtz-joel-scambray/hacker-7-0.html",
	"https://www.libraccio.it/libro/9788868952471/justin-seitz/python-per-hacker-tecniche-offensive-black-hat.html",
	"https://www.libraccio.it/libro/9788868951528/paolo-aliverti/elettronica-per-maker-guida-completa.html",
	'https://www.libraccio.it/libro/9788858135815/stefano-mancuso/nazione-delle-piante.html',
	"https://www.libraccio.it/libro/9788809831360/stefano-mancuso/plant-revolution.html",
	"https://www.libraccio.it/libro/9788871687674/ella-frances-sanders/tagliare-nuvole-col-naso-modi-di-dire-dal-mondo.html",

	// Libri per Ste
	"https://www.libraccio.it/libro/9788846413109/perche-proprio-qui-grandi-opere-e-opposizioni-locali.html"
];

foreach($urls as $key => $url) {

    echo "<hr>";

	$style = '';

    /*
	// stampa da usare in prova
	echo "<h1>".ucfirst($key)."</h1>";
    echo "<h4>URL: <a href=\"$value\" target=\"_blank\"> VAI ALLA PAGINA DEL LIBRO </a> </h4>";
    */

    $result = findOccurrence($url);
	
	// stampa titolo in produzione
	echo "<h1>".($key+1).') <a href="'.$url.'" target="_blank">'.ucfirst($result['titolo'])."</a></h1>";

	$n_usato = $result['n_usato'];

    //echo "<pre>"; var_dump($result); echo "</pre>";

    foreach($result as $k => $v) {
        
        if($v === true || $v !== '') {
            if($v === true) 
				$v = 'Disponibile';

			$style = "font-weight: bold; color: green;";
		}

        if($v === false || $v === '') {
            $v = 'NON disponibile';
			$style = 'color: red; font-weight: bolder;';
		}

		if(strtolower($k) === 'usato') {

			$style .= 'background-color: yellow';
		}
		
        echo ucfirst($k) . ': <span style="'.$style.'">'. $v .'</span> <br>';
    }

}


?>


<hr>

<center>
<code>Copyright 2019</code>
</center>

</body>
</html>
