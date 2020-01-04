<?php

session_start();

error_reporting(1);

//require_once 'conn2db.php';

// funzione che esamina il testo della pagina

function findOccurrence(string $url, $id, $cat, $dbo) :array {

    $findPrezzo = "'productcover_price'"; // => per cercare prezzo di copertina
    $findSconto = "'productdiscount_price'"; // => per cercare prezzo scontato
    $findUsato = "'prezzousato'"; // => per cercare il prezzo dell'usato
    $findEbook = 'Disponibile';

    $return = [
        'titolo' => '',
        'autore' => '',
        'prezzo' => '',
        'sconto' => '',
        'usato' => '',
        'ebook' => '',
        'url' => $url,
        'id' => $id,
        'cat' => $cat
    ];

    $text = file_get_contents($url);
    $text = strip_tags($text);
    $text = trim($text);

    // stampa di debug di $text
    // echo "<br><hr> $text <br><hr><hr>";

    // ##################################################################################################
    // TROVA TITOLO
    $return['titolo'] = strstr($text,' - ',true);

    // Scrive Titolo nel DB
    $query = "UPDATE my_fuzzlernet.a4l_urls SET titolo = ? WHERE nurl = ?;";
    $stmt = $dbo->prepare($query);
    $stmt->execute([$return['titolo'], $id]);


    // ##################################################################################################
    // TROVA AUTORE

    $text4autore = strstr($text,' - ');
    $return['autore'] = strstr($text4autore,'Libro',true);
    $return['autore'] = str_replace('-','',$return['autore']);


    // ##################################################################################################
    // TROVA PREZZO

    $text4prezzo = strstr($text, $findPrezzo);
    $return['prezzo'] = strstr($text4prezzo, $findSconto, true);
    $return['prezzo'] = str_replace($findPrezzo, '', $return['prezzo']);
    $return['prezzo'] = str_replace(':', '', $return['prezzo']);
    $return['prezzo'] = str_replace(',', '', $return['prezzo']);
    $return['prezzo'] = str_replace("'", '', $return['prezzo']);

    $prezzo2comp = $return['prezzo']; // variabile temp per fare paragone con prezzo di sconto

    if((int) $return['prezzo'] > 0) {
        $return['prezzo'] = str_replace(".", ',', $return['prezzo']);
        $return['prezzo'] .= '€';
    }
    else {
        $return['prezzo'] = false; // inserire una stringa più indicativa
    }


    // ##################################################################################################
    // TROVA SCONTO

    $text4sconto = strstr($text, $findSconto);
    $return['sconto'] = strstr($text4sconto, "'product_discount'", true);
    $return['sconto'] = str_replace($findSconto, '', $return['sconto']);
    $return['sconto'] = str_replace(':', '', $return['sconto']);
    $return['sconto'] = str_replace(',', '', $return['sconto']);
    $return['sconto'] = str_replace("'", '', $return['sconto']);

    // stampa di debug
    //echo "<br><hr>prezzo:".$prezzo2comp."<br>sconto:".$return['sconto']."<hr><br>";
    //var_dump($prezzo2comp);    var_dump($return['sconto']);

    if((int) $return['sconto'] > 0 && (double) $return['sconto'] !== (double) $prezzo2comp ) {
        $return['sconto'] = str_replace(".", ',', $return['sconto']);
        $return['sconto'] .= '€';
    }
    else {
        $return['sconto'] = false; // inserire una stringa più indicativa
    }

    // ##################################################################################################
    // TROVA USATO   

    $text4usato = strstr($text, $findUsato);
    $return['usato'] = strstr($text4usato, "'categoriaprodotto'", true);
    $return['usato'] = str_replace($findUsato, '', $return['usato']);
    $return['usato'] = str_replace(':', '', $return['usato']);
    $return['usato'] = str_replace(',', '', $return['usato']);
    $return['usato'] = str_replace("'", '', $return['usato']);
    
    // stampa di debug
    // echo "<br><hr>USATO:".$return['usato']."<hr><br>";

    if((int) $return['usato'] > 0) {
        $return['usato'] = str_replace(".", ',', $return['usato']);
        $return['usato'] = trim($return['usato']);
        $return['usato'] .= '€';
        $_SESSION['titoli'][] = [ $return['titolo'] => $url ];
        
        //Aggiornamento nel DB (valore campo 'usato' settato a 1)
        $usatoVal = 1;
        setUsato($id, $usatoVal, $dbo);

    }
    else {
        $usatoVal = 0;
        setUsato($id, $usatoVal, $dbo);
        $return['usato'] = ''; // inserire una stringa più indicativa
    }


    // ##################################################################################################
    // TROVA EBOOK


    $text4ebook = strstr($text, $findEbook);
    $return['ebook'] = strstr($text4ebook, 'Note', true);
    $return['ebook'] = str_replace($findEbook, '', $return['ebook']);
    $return['ebook'] = str_replace(':', '', $return['ebook']);
    $return['ebook'] = str_replace('anche', '', $return['ebook']);
    $return['ebook'] = str_replace('in', '', $return['ebook']);
    $return['ebook'] = str_replace('eBook', '', $return['ebook']);
    $return['ebook'] = str_replace('a', '', $return['ebook']);
    $return['ebook'] = str_replace('€', '', $return['ebook']);
    $return['ebook'] = str_replace("'", '', $return['ebook']);
    // equivalente di trim
    $return['ebook'] = str_replace(" ", '', $return['ebook']);
    $return['ebook'] = str_replace("\n", '', $return['ebook']);
    $return['ebook'] = str_replace("\t", '', $return['ebook']);
    $return['ebook'] = str_replace("\r", '', $return['ebook']);

    $return['ebook'] = trim($return['ebook']);

    // stampa di debug
    //echo "<br><hr>eBook:".$return['ebook']."<hr><br>";

    if($return['ebook'] !== '') {
        $return['ebook'] = str_replace(".", ',', $return['ebook']);
        $return['ebook'] .= '€';
    }
    else {
        $return['ebook'] = false; // inserire una stringa più indicativa
    }
    return $return;

} // fine findOccurrence()


function stampaRisultati($key,$result) {

    echo "<hr>";

    $style = '';
    
    // stampa titolo in produzione
	echo "<h1>".($key+1).') <a href="'.$result['url'].'" target="_blank">'.ucfirst($result['titolo'])."</a></h1>";

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
        
        // stampa tutto tranne url e id (servono solo alle funzioni)
        if(strtolower($k) !== 'url' && strtolower($k) !== 'id' && strtolower($k) !== 'cat') {
            echo ucfirst($k) . ': <span style="'.$style.'">'. $v .'</span> <br>';			
        }
		
		
	} 

	// menu
?>
    <br>
	<table>
		<tr>
			<th>
			<form action="modify.php" method="POST">
				<input type="hidden" name="urlid" value="<?php echo $result['id'] ?>">
                <input type="hidden" name="titolo" value="<?php echo $result['titolo'] ?>">
                <input type="hidden" name="cat" value="<?php echo $result['cat'] ?>">
				<input type="submit" value="Modifica">
			</form>
			</th>

			<th>
			<form action="delete.php" method="POST">
				<input type="hidden" name="urlid" value="<?php echo $result['id'] ?>">
                <input type="hidden" name="titolo" value="<?php echo $result['titolo'] ?>">
                <input type="hidden" name="cat" value="<?php echo $result['cat'] ?>">
				<input type="submit" value="Elimina">
			</form>
			</th>
			
        </tr>
    </table>
    
<?php
//var_dump($result);

} // fine stampaRisultati


function updateUrlsTable($dbo,$furl) {

    $query = "INSERT INTO my_fuzzlernet.a4l_urls (furl) VALUES(?)";
    $stmt = $dbo->prepare($query);
    $stmt->execute([$furl]);

    if($stmt->rowCount() > 0) {               
        return true;
    }
    else {
        return $stmt->errorInfo();
    }
} // fine function updateURLS


function updateRelsTable($dbo,$urlid,$userid,$cat) {
    //die("entrato in update rels t");
    $query = "INSERT INTO my_fuzzlernet.a4l_rels (userid,urlid,cat) VALUES(?,?,?)";
    $stmt = $dbo->prepare($query);
    $stmt->execute([$userid,$urlid,$cat]);

    if($stmt->rowCount() > 0) {
        //die("update rels ha funzionato!");
        return true;
    }
    else {
        return $stmt->errorInfo();
    }
} // fine function updateRELS


function setUsato($id, $usatoVal, $dbo) {
    // Controllo se c'è già un valore settato e se c'è aggiorno altrimenti inserisco...
    $query = "SELECT * FROM my_fuzzlernet.a4l_used WHERE urlid = ?;"; 
    $stmt = $dbo->prepare($query);
    $stmt->execute([$id]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = $stmt->rowCount();
    $stmt = null; //resetto lo statement
    //echo "USATO:".$data[0]['usato']."<br>br>";var_dump($data); die;

    if($response > 0) {
        // la riga esiste -> aggiorno
        //$query = "UPDATE my_fuzzlernet.a4l_used SET usato = :us WHERE urlid = :ur;";

        // Controllo che il parametro non sia lo stesso
        if($data[0]['usato'] != $usatoVal) {
            $query = "UPDATE my_fuzzlernet.a4l_used SET usato = ? WHERE urlid = ?;";
        }
        else {
            $query = '';
        }
        
        //$stmt = $dbo->prepare($query);
        //$stmt->execute([$usatoVal,$id]);
    }
    else {
        // inserisco nuovo valore
        //$query = "INSERT INTO my_fuzzlernet.a4l_used (urlid,usato) VALUES(:ur,:us)";
        $query = "INSERT INTO my_fuzzlernet.a4l_used (usato,urlid) VALUES(?,?);";
        //$stmt = $dbo->prepare($query);
        //$stmt->execute([$id,$usatoVal]);
    }
    
    if($query !== '') {
        $stmt = $dbo->prepare($query);
        $stmt->execute([$usatoVal,$id]);
    }
    
    /*
    $stmt = $dbo->prepare($query);
    $stmt->bindParam(':ur',$id);
    $stmt->bindParam(':us',$usatoVal);
    $stmt->execute();
    */

    // Controllo che non sia fallita la procedura
    if($stmt !== null && $stmt->rowCount() == 0 ) {
        $res = $stmt->errorInfo();
        echo "<pre>ID: $id<br>USATO: $usatoVal<br>";
        var_dump($stmt);
        var_dump($res); die;
    }
} // fine setUsato()