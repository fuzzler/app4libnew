<?php

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************

if(isset($_POST['urlid'])) {
    $urlid = $_POST['urlid'];
}
else if(isset($_SESSION['tmp_urlid_2m'])) {
    $urlid = $_SESSION['tmp_urlid_2m'];
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

$query = "SELECT * FROM my_fuzzlernet.a4l_urls WHERE nurl=?";

$stmt = $dbo->prepare($query);
$stmt->execute([$urlid]);

$urldata = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($urldata as $ud) {
    $nurl = $ud['nurl'];
    $furl = $ud['furl'];
    $cat = $ud['cat'];
}

// salvo in sessione il N° Url nel caso possa servire...
$_SESSION['tmp_urlid_2m'] = $nurl;

$stmt = null;
//echo "$nurl => $furl => $cat";//var_dump($urldata);

if(!isset($_POST['MOD'])) {
?> 
                <div class="form-group">
                    <form action="modify.php" method="POST">
                    
                        Cambia indirizzo:
                        <input class="form-control" type="text" name="furl" value="<?php echo $furl ?>">
                    
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

    $query = "UPDATE my_fuzzlernet.a4l_urls SET furl= ?,cat= ? WHERE nurl= ?;";

    $stmt = $dbo->prepare($query);
    $stmt->execute([$_POST['furl'],$_POST['cat'],$nurl]);

    if($stmt->rowCount() > 0) {
        ?> <span class="valid_mess">Modifica effettuata con successo!!!</span><br> 
        Verrai reindirizzato alla tua pagina personale in pochi secondi ...<?php
        header("Refresh: 2, url=index.php");
    }
    else {
        ?> <span class="err_mess">Non è stato possibile effettuare la modifica!!!</span><br> 
        Assicurati di non aver inserito un indirizzo errato oppure un numero al posto di un testo...<?php
        $_POST = null;
        $stmt = null;
        header("Refresh: 4, url=modify.php");
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

