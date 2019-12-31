<?php

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************

// Controllo che esista ID dell'Url (nurl/urlid)
if(isset($_POST['urlid']) && isset($_POST['titolo']) && isset($_POST['cat'])) {
    $urlid = $_POST['urlid'];
    $titolo = $_POST['titolo'];
    $cat = $_POST['cat'];
}
else if(isset($_SESSION['tmp_urlid_2d'])) {
    $urlid = $_SESSION['tmp_urlid_2d'];
    $titolo = $_SESSION['tmp_titolo'];
    $cat = $_SESSION['tmp_cat'];
}
else {
    header('Location: index.php');
}

//var_dump($_POST);

?>
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-2"></div>
        <div class="col-8 txtcenter txtbolder">
            <h2 class="titolo">Eliminazione dell'Url salvato (<?= $urlid ?>)</h2>
<?php

/*
$query = "SELECT * FROM my_fuzzlernet.a4l_urls WHERE nurl=?";

$stmt = $dbo->prepare($query);
$stmt->execute([$urlid]);

$urldata = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($urldata as $ud) {
    $nurl = $ud['nurl'];
    $furl = $ud['furl'];
    $cat = $ud['cat'];
}

$stmt = null;
*/

// salvo in sessione il N° Url nel caso possa servire...
$_SESSION['tmp_urlid_2d'] = $urlid;
$_SESSION['tmp_titolo'] = $titolo;
$_SESSION['tmp_cat'] = $cat;


//echo "$nurl => $furl => $cat";//var_dump($urldata);

if(!isset($_POST['DEL'])) {
?> 
                <br><br>
                <h3 class="txtbolder">Vuoi davvero cancellare</h3>
                <b><u><?=$titolo ?></u></b>
                <br>
                <h1>?</h1>
                <div class="form-group">
                    <form action="delete.php" method="POST">
                                      
                        <br>
                        <input type="submit" name="DEL" value="Cancella" class="pulsante">
                    </form>
                </div>
           
<?php
} // fine if isset post->del
else {
    //var_dump($nurl);var_dump($_POST);die;
    //echo "urlid: $urlid userid: $userid cat: $cat<br><br>";

    $userid = $_SESSION['usr_data']['usrid'];

    $query = "DELETE FROM my_fuzzlernet.a4l_rels WHERE urlid = ? AND userid = ? AND cat = ? LIMIT 1"; //elimina la prima occorrenza (non tutte in caso di duplicati)

    $stmt = $dbo->prepare($query);
    $stmt->execute([$urlid,$userid,$cat]);

    if($stmt->rowCount() > 0) {
        echo "<span class=\"valid_mess\">URL cancellato con successo!!!</span><br>";
        echo "Verrai reindirizzato alla tua pagina personale in pochi secondi ...";
        header("Refresh: 2, url=index.php");
    }
    else {
        echo "<span class=\"err_mess\">Non è stato possibile cancellare l'URL indicato!!!</span><br>";
        echo "Prova a ripetere la procedura...";
        //echo $resp = $stmt->errorInfo(); echo "<br>RespMSG:<br>";var_dump($resp);die;
        header("Refresh: 3, url=index.php");
    }

}

?>
        </div> <!-- fine div col-8 -->
        <div class="col-2"></div>
    </div>

    <div class="row">
        <div class="col-2">
            <br>
            <br>
            <br><a href="index.php">TORNA INDIETRO</a>
        </div>
        <div class="col-8"></div>
        <div class="col-2"></div>
    </div>
</div>

<?php
//echo "POST:";var_dump($_POST);
//echo "<br>SES:";var_dump($_SESSION["tmp_urlid_2m"]);

