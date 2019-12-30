<?php

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************

if(isset($_POST['urlid']) && isset($_POST['titolo']) && isset($_POST['cat'])) {
    $urlid = $_POST['urlid'];
    $titolo = $_POST['titolo'];
    $cat = $_POST['cat'];    
}
else if(isset($_SESSION['tmp_urlid_2m'])) {
    $urlid = $_SESSION['tmp_urlid_2m'];
    $titolo = $_SESSION['tmp_titolo'];
    $cat = $_SESSION['tmp_cat_2m'];
}
else {
    header('Location: index.php');
}

?>
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-2"></div>
        <div class="col-8 txtcenter txtbolder">
            <h2 class="titolo">Modifica l'Url salvato</h2>
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
*/

// salvo in sessione il N° Url e la categoria nel caso possa servire...
$_SESSION['tmp_urlid_2m'] = $urlid;
$_SESSION['tmp_cat_2m'] = $cat;
$_SESSION['tmp_titolo'] = $titolo;

$stmt = null;
//echo "$nurl => $furl => $cat";//var_dump($urldata);

if(!isset($_POST['MOD'])) {
?> 
            <br>
            <h3 class="txtbolder txtcenter"><?php echo $titolo ?></h3>
            <br>
            <div class="form-group">
                <form action="modify.php" method="POST">                  
                    
                
                    Cambia Categoria:
                    <select name="cat" class="form-control">
                        <option value="normal" <?php echo ($cat == 'normal') ? 'selected' : ''; ?> >Normale</option>
                        <option value="prior" <?php echo ($cat == 'prior') ?  'selected' : ''; ?> >Prioritaria</option>
                        <option value="curios" <?php echo ($cat == 'curios') ?  'selected' : '';?> >Curiosità</option>
                        <option value="personal" disabled>Personalizzata</option>
                    </select>                        
                    <br>
                    <input type="submit" name="MOD" value="Modifica" class="pulsante">
                </form>
            </div>
           
<?php
} // fine if isset post->furl
else {
    //var_dump($_POST);die;

    $query = "UPDATE my_fuzzlernet.a4l_rels SET cat= ? WHERE urlid= ?;";

    $stmt = $dbo->prepare($query);
    $stmt->execute([$_POST['cat'],$urlid]);

    if($stmt->rowCount() > 0) {
        ?> <span class="valid_mess">Modifica effettuata con successo!!!</span><br> 
        Verrai reindirizzato alla tua pagina personale in pochi secondi ...<?php
        header("Refresh: 2, url=index.php");
    }
    else {
        ?> <span class="err_mess">Non è stato possibile effettuare la modifica!!!</span><br> 
        Prova a ripetere la procedura, se l'errore persiste contatta l'amministratore...<?php
        //var_dump($stmt->errorInfo()); die;
        $_POST = null;
        $stmt = null;
        header("Refresh: 3, url=modify.php");
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

