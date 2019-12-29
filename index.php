<?php

// Variabili importanti
$pagename = "Homepage"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';
require_once 'functions.php';

// *************
?>

<body>
<div class="container-fluid">

<?php
// Controlli iniziali (login...sessione...)

//session_start();

//	var_dump($_SESSION);

if(isset($_SESSION['usr_data'])) {
	$nome_utente = $_SESSION['usr_data']['nome'];
	$nome_utente = strtolower($nome_utente);
	$nome_utente = ucfirst($nome_utente);

	// Estraggo la lista degli indirizzi
	
	//var_dump($_SESSION); die;

	$userid = $_SESSION['usr_data']['usrid'];

	$query = "SELECT nurl,furl,cat	 FROM `a4l_urls` as u JOIN `a4l_rels`as r ON u.nurl = r.urlid WHERE userid=:userid;";

	$stmt = $dbo->prepare($query);
	$stmt->bindParam(':userid',$userid);
	$stmt->execute();

	if($stmt->rowCount() > 0) {
		//$urls = $stmt->fetchAll();
		$urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//echo "<pre>"; var_dump($extract); die;

		//foreach($extract as $u) { $urls[] = $u['furl'];	}
	}
	else {
		$urls = [];
	}

	//echo "<pre>"; var_dump($urls); die;

}
else {
	header('Location: noauthpg.php');
}

?>
<div class="row">

<div class="col-2"></div>

<div class="col-8"></div>

<div class="col-2">
	<br>
	<form action="logout.php" method="POST">
	<input type="submit" value="LOGOUT" > 
	</form>
	<br>
</div>

</div> <!-- fine row -->

<div class="row">
<div class="col-2"></div>
<div class="col-8">
<h1 class="titolo">Benvenuto nella tua pagina personale <?php echo $nome_utente ?> </h1>

<?php

if(empty($urls) || count($urls) === 0) {
	//echo "<hr><br><span class=\"txtcenter txtbolder\"> *** Non hai ancora inserito alcun Url da monitorare  ***</span><br><br>";
	//echo "<span class=\"txtcenter\">Inseriscine uno da <a class=\"link\" href=\"insert.php\">QUI</a></span><br><hr>";
	?>
	<hr><br>
	<span class="txtcenter txtbolder"> 
		*** Non hai ancora inserito alcun Url da monitorare  ***
	</span><br><br>
	<span class="txtcenter">
		Inseriscine uno da <a class="link" href="insert.php">QUI</a>
	</span><br><hr>
	<?php
}
else {

	// Aggiorna la pagina piu volte (responso più attendibile / più lento <- trovare altro sistema)
	while($_SESSION['count'] < 2) {
		// ricarico la pagina
		header("Location: index.php");
		$_SESSION['count']++;	
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

	echo "<b><u>Titoli Usati in Evidenza:</u></b> <br><ul>";

	foreach($titoli as $titolo) {

		echo '<li><a href="'.current($titolo).'" target="_blank">'.key($titolo).' </li>';
	}

	echo "</ul>";
	
	foreach($urls as $key => $url) {

		echo "<hr>";

		$style = '';



		$result = findOccurrence($url['furl']);
		
		// stampa titolo in produzione
		echo "<h1>".($key+1).') <a href="'.$url.'" target="_blank">'.ucfirst($result['titolo'])."</a></h1>";

		$n_usato = $result['n_usato'];

		//echo "<pre>"; var_dump($result); echo "</pre>";

		// Listato
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

		// menu
		?>

		<table>
			<tr>
				<th>
				<form action="modify.php" method="POST">
					<input type="hidden" name="urlid" value="<?php echo $url['nurl'] ?>">
					<input type="submit" value="Modifica">
				</form>
				</th>

				<th>
				<form action="delete.php" method="POST">
					<input type="hidden" name="urlid" value="<?php echo $url['nurl'] ?>">
					<input type="submit" value="Elimina">
				</form>
				</th>
				
  			</tr>
		</table>
		

		

		<?php
	} // fine foreach urls
} // fine else (no url)


?>
</div> <!-- fine col-8 (main)-->

<div class="col-2"></div>
</div> <!-- fine row (main)-->

<hr>
<div class="row">

	<div class="col-5"></div>

	<div class="col-2">

	<code>Copyright 2019</code>

	</div>

	<div class="col-5"></div>

</div> <!-- fine row -->


</div> <!-- fine container -->
</body>
