<?php
// qui viene reindirizzato l'utente non loggato (o che non è ancora registrato)

//session_start();

// Variabili importanti
$pagename = "Registrati"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************


?>
<div class="container-fluid">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <h2 class="titolo">Devi essere autenticato per poter accedere a <?php echo NOME_APP?> </h2>
        
        </div>

        <div class="col-2"></div>
    </div> <!-- fine row1 -->

    <div class="row">
        <div class="col"></div>

        <div class="col">
        <br><br>
        Sei già registrato? Effettua il <b> <a href="login.php">Login</a></b><br>
        Se non sei ancora registrato, puoi farlo in 2 minuti cliccando <b><a href="register.php">QUI</a></b>
        
        </div>

        <div class="col"></div>
    </div> <!-- fine row2 -->
  
</div> <!-- fine container -->