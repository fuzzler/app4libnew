<?php
// pagina di registrazione all'app

//session_start();

// Variabili importanti
$pagename = "Registrati"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************
?>
<div class="container">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <h1 class="title">Registrati per accedere a <?php echo NOME_APP?> </h1>
        
        </div>

        <div class="col-2"></div>
    </div> <!-- fine row1 -->

    <div class="row">
        <div class="col"></div>

        <div class="col">

        <br><br>
        Inserisci i tuoi dati:
        <br><br>

            <form action="register.php" method="POST">
                (*) Nome:
                <input type="text" name="nome" placeholder="Nome" required><br><br>
                Cognome:
                <input type="text" name="cognome" placeholder="Cognome" ><br><br>
                E-mail:
                <input type="text" name="email" placeholder="Email" ><br><br>
                (*) Username:
                <input type="text" name="usr" placeholder="Nome utente" required><br><br>
                (*) Password:
                <input type="text" name="pw" placeholder="Password" required> <br><br>

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