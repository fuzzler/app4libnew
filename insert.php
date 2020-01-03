<?php
// inserisce un nuovo url nel DB

//session_start();

// Variabili importanti
$pagename = "Inserisci"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';
require_once 'functions.php';

if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $_SESSION['tmp_userid_2i'] = $userid;
}
else if(isset($_SESSION['tmp_userid_2i'])) {
    $userid = $_SESSION['tmp_userid_2i'];
}
else {
    header('Location: index.php');
}

// *************
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <h1 class="titolo">Pagina di inserimento nuovi URL</h1>
        
        </div>

        <div class="col-2"></div>
    </div> <!-- fine row1 -->

    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">

<?php

if(isset($_POST['ver'])) {

    $furl = $_POST['furl'];
    $cat = $_POST['cat'];

    $errMess = '<div class="txtcenter"><span class="err_mess">
    Proedura di inserimento fallita!!! Provare a ripeterla!</span></div><br>';

    $succMess = '<div class="txtcenter"><span class="valid_mess">
    URL Inserito correttamente trai i tuoi personali!</span>
    <br><span>Verrai reindirizzato alla pagina principale in pochi secondi...</span>
    </div>';

    // Controllo che l'url sia valido!
    $rootUrl = 'https://www.libraccio.it/libro/';

    if(strpos($furl,$rootUrl) !== false) {        
        // Controllo che l'url non esista già nel DB

        $query = "SELECT * FROM my_fuzzlernet.a4l_urls WHERE furl=?";
        $stmt = $dbo->prepare($query);
        $stmt->execute([$furl]);

        if($stmt->rowCount() > 0) {
            // url presente nel DB -> aggiornamento di RELS
            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $urlid = $fetch[0]['nurl'];
            //echo "ID: $urlid - CAT: $cat USERID: $userid <br><br>"; var_dump($fetch); die;
            
            $resp_urt = updateRelsTable($dbo,$urlid,$userid,$cat); // Aggiorna direttamente RELS

            if($resp_urt === true) {
                // tabella Rels Aggiornata correttamente (FINE)
                echo $succMess;
                header("Refresh: 2, url=index.php");
            }
            else {
                // tabella Rels non aggiornata ...
                echo $errMess;
                var_dump($resp_urt);
                header("Refresh: 2, url=insert.php");
            }
        }
        else {
            // url non prensente nel DB
            $resp_uut = updateUrlsTable($dbo,$furl); // Prima di aggiornare RELS occorre inserire l'url dentro URLS

            $query = "SELECT nurl FROM my_fuzzlernet.a4l_urls WHERE furl=?";
            $stmt = $dbo->prepare($query);
            $stmt->execute([$furl]);

            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $urlid = $fetch[0]['nurl'];
            //var_dump($urlid); die;

            if($resp_uut === true) {                                
                //die("entrato in uut");

                $resp_urt = updateRelsTable($dbo,$urlid,$userid,$cat);

                if($resp_urt === true) {
                    // tabella Rels Aggiornata correttamente (FINE)
                    echo $succMess;
                    header("Refresh: 2, url=index.php");
                }
                else {
                    // tabella Rels non aggiornata ...
                    echo $errMess;
                    header("Refresh: 2, url=insert.php");
                }                
            }
            else {
                echo $errMess;
                var_dump($resp_uut);
                header("Refresh: 2, url=insert.php");
            }
        }


    } // fine if valid url
    else {
        ?> <div class="txtcenter"><span class="err_mess">URL NON VALIDO!!!</span><br> 
        Assicurati di aver inserito un indirizzo completo e appartenente a Libraccio...</div><?php
        $_POST['ver'] = null;
        header("Refresh: 2, url=insert.php");
    } // fine else valid url




} // fine if isset post->ver
else {    
?>
        <br><br>
        <div class="txtcenter">
            <span class="txtbolder txtcenter">Inserisci un nuovo URL da monitorare:</span>
        </div>
        <br>
        <div class="form-group">
            <form action="insert.php" method="POST">

                (*) URL:
                <input class="form-control" type="text" name="furl" placeholder="Inserisci il Nuovo Url QUI" required><br>

                (*) Scegli la Categoria:
                <select name="cat" class="form-control" required>
                    <option value="normal">Normale</option>
                    <option value="prior">Prioritaria</option>
                    <option value="curios">Curiosità</option>
                    <option value="personal" disabled>Personalizzata</option>
                </select>                        
                <br> 
                (*) Campi obbligatori
                <br>
                <input type="submit" name="ver" value="Inserisci" class="pulsante">

            </form>
        </div>
        <br>
        

<?php
} // fine else isset post ver
?>
        </div>
       
        <div class="col-3"></div>
    </div> <!-- fine row2 -->

    <div class="row">
        <div class="col-2">
            <br>
            <br>
            <br><a href="index.php">TORNA INDIETRO</a>
        </div>
        <div class="col-8"></div>
        <div class="col-2"></div>
    </div>
  
</div> <!-- fine container -->

<?php

// logiche di registrazione (inserimento dati DB)