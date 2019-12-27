<?php
// inserisce un nuovo url nel DB

//session_start();

// Variabili importanti
$pagename = "Inserisci"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <h1 class="title">Pagina di inserimento nuovi URL</h1>
        
        </div>

        <div class="col-2"></div>
    </div> <!-- fine row1 -->

    <div class="row">
        <div class="col"></div>

        <div class="col">

        <br><br>
        Inserisci un nuovo URL da monitorare:
        <br><br>

            <form action="register.php" method="POST">
                (*) URL:
                <input type="text" name="furl" placeholder="Nome" required><br><br>
                (*) Categoria:
                <input type="text" name="cat" placeholder="Cognome" required><br><br>

                <input type="submit" name="reg" value="INVIA" >
            </form>

            <br><br>
            (*) Campi obbligatori

        
        </div>
        
        <div class="col"></div>
    </div> <!-- fine row2 -->
  
</div> <!-- fine container -->

<?php

// logiche di registrazione (inserimento dati DB)