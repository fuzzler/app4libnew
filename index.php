
<head>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">    
    </script>
</head>

<?php



// Requirements
require_once('functions.php');
require_once('conn2db.php');

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
$urls = [
'sconto' => 'https://www.libraccio.it/libro/9788858135815/stefano-mancuso/nazione-delle-piante.html',
'usato' => 'https://www.libraccio.it/libro/9788891908216/al-kelley-ira-pohl/c-didattica-e-programmazione-ediz-mylab-con-contenuto-digitale-per-download-e-accesso-on-line.html',
'ebook' => 'https://www.libraccio.it/libro/9788809831360/stefano-mancuso/plant-revolution.html',
'ctrl' => 'https://www.libraccio.it/libro/9788833620008/jerry-richardson/introduzione-alla-pnl-come-capire-e-farsi-capire-meglio-usando-programmazione-neuro-linguistica.html',
'ctrl' => 'https://www.libraccio.it/libro/9788897461784/elisa-martinez-garrido/romanzi-di-elsa-morante-scrittura-poesia-ed-etica.html',
'ctrl3' => 'https://www.libraccio.it/libro/9788876158377/tom-wolfe/decennio-io.html',
'ctrl4' => 'https://www.libraccio.it/libro/9788881184163/palladio-nel-nord-europa-libri-viaggiatori-architetti.html',
'ebook2' => 'https://www.libraccio.it/libro/9788868952471/justin-seitz/python-per-hacker-tecniche-offensive-black-hat.html',
'usato2' => 'https://www.libraccio.it/libro/9788804589105/gyatso-tenzin-dalai-lama-howard-c-cutler/arte-della-felicita.html'
];

foreach($urls as $key => $value) {

    echo "<hr>";
    echo "<h1>".ucfirst($key)."</h1>";
    echo "<h4>URL: <a href=\"$value\" target=\"_blank\"> VAI ALLA PAGINA DEL LIBRO </a> </h4>";
    

    $result = findOccurrence($value);

    //echo "<pre>"; var_dump($result); echo "</pre>";

    foreach($result as $k => $v) {
        
        if($v === true)
            $v = 'Disponibile';

        if($v === false || $v === '')
            $v = '<u>NON disponibile</u>';

        echo ucfirst($k) . ": <b> $v </b> <br>";
    }

    /*
    if($key === 'sconto') {
        $sconto = file_get_contents($value);
        $sconto = strip_tags($sconto);
        //$sconto = explode(" ", $sconto);
        //$sconto = array_filter($sconto);
        //var_dump($sconto);
        echo $sconto;
    }

    if($key === 'usato') {
        $usato = file_get_contents($value);
        $usato = strip_tags($usato);
        echo $usato;
    }

    if($key === 'ebook') {
        $ebook = file_get_contents($value);
        $ebook = strip_tags($ebook);
        echo $ebook;
    }

    if($key === 'ctrl') {
        $ctrl = file_get_contents($value);
        $ctrl = strip_tags($ctrl);
        echo $ctrl;
    }

    */

    //echo "<h3>".$value."</h3>";

}

?>


<hr>

<script> 

$(document).ready(function () {
    var cp = " STAMPA DI: <?php echo $prova; ?>" ;
    console.log(cp);

});

var URL = 'https://www.libraccio.it/libro/9788891908216/al-kelley-ira-pohl/c-didattica-e-programmazione-ediz-mylab-con-contenuto-digitale-per-download-e-accesso-on-line.html';



</script>