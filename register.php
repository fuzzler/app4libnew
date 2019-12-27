<?php
// pagina di registrazione all'app

//session_start();

// Variabili importanti
$pagename = "Registrati"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************

// Logiche di scrittura nel DB

if(isset($_POST['usr']) && $_POST['usr'] !== ' ' && $_POST['pw'] !== ' ') {

    if($_POST['pw'] !== $_POST['pw2']) {
        $outcome = 4; // Pw non uguali
        //header('Location: register.php');
    }
    else {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $usr = $_POST['usr'];
        $pw = $_POST['pw'];
    
        // verifica che il nome utente non sia già presente nel DB
        $query = "SELECT usr FROM my_fuzzlernet.a4l_users WHERE usr=:usr;";

        $stmt = $dbo->prepare($query);
        $stmt->bindParam(':usr', $usr);
        $stmt->execute();
    
        $resp_usr = $stmt->rowCount();

        if($resp_usr > 0) {
            //die("gia presente"); // username gia esistente
            $outcome = 5;
        }
        else {
            $stmt = null;
            //die("disponibile"); // username gia esistente
            $query = "INSERT INTO my_fuzzlernet.a4l_users (nome,cognome,email,usr,pw) VALUES (?, ?, ?, ?, PASSWORD(?));";
        
            // Statement
            try {
                $stmt = $dbo->prepare($query);
                $stmt->execute([$nome, $cognome, $email, $usr, $pw]); // esecuzione diretta (no bind)
        
                //var_dump($stmt->errorInfo());
                $response = $stmt->rowCount(); // conta le righe ritornate dal DB (esito)
        
            }
            catch(PDOException $e) {
                throw new MyDatabaseException( $e->getMessage( ) , $e->getCode( ) );
                echo "ERRORE! => ";
                var_dump($e->getMessage());
                //die("fine programma");
            }
            
            //echo "Conto righe: ".$response; //die; // stampa di debug
        
            if($response > 0) {                

                $stmt = null; // chiudo lo statement

                //Estraggo i dati dell'utente appena inserito
                $query = "SELECT * FROM my_fuzzlernet.a4l_users WHERE usr=:usr;";

                $stmt = $dbo->prepare($query);
                $stmt->bindParam(':usr', $usr);
                $stmt->execute();
            
                $resp_usrdata = $stmt->rowCount();

                if($resp_usrdata > 0) {

                    // Estraggo i dati dal DB
                    $usrdata = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    $_SESSION['usr_data']['usrid'] = $usrdata['id'];
                    $_SESSION['usr_data']['nome'] = $usrdata['nome'];
                    $_SESSION['usr_data']['cognome'] = $usrdata['cognome'];
                    $_SESSION['usr_data']['email'] = $usrdata['email'];
                    $_SESSION['usr_data']['username'] = $usrdata['usr'];
                    //$_SESSION['usr_data']['password'] = $usrdata['pw'];

                    $outcome = 1; // esito positivo -> dati scritti nel DB
            
                    //var_dump($_SESSION); die;
                }
                else {
                    $outcome = 6; // dati utente irraggiungibili -> login.php
                }           

            }
            else {
                $outcome = 2; // esito negativo -> errore nella scrittura del DB
            }
        }    
        
    } // fine else pw =

    //echo "<pre>"; var_dump($usrdata); echo "</pre>"; // stampa di debug

} // fine if controllo usr e pw ' '
else {
    $outcome = 3; // username o password errati (spazio vuoto)
}



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

        <?php

        switch($outcome) {

            case 1:
                // esito positivo                         
                echo "<span class=\"valid_mess\">Dati inseriti con successo nel Database!!!</span><br><br>";
                echo "Verrai reindirizzato alla tua pagina personale tra qualche secondo...<br>";
                header('Refresh: 4; url=index.php');                
            break;

            case 2:
                // esito negativo                
                echo "<span class=\"err_mess\">Dati NON inseriti Database!!!</span><br>";
                echo "Provare a ripetere la procedura o contattare l'amministratore del sito. <br><br>";                
            break;

            case 3:
                // Username o Pw errati
                echo "<span class=\"err_mess\">Errore nell'inserimento di Username o della Password!</span><br>";
                echo "Prova a ricompilare il form facendo attenzione di non mettere spazi vuoti nei campi. <br><br>";

            break;

            case 4:
                // Pw non Uguali
                echo "<span class=\"err_mess\">Password inserite non uguali!</span><br>";
                echo "Le due password devono essere uguali così che ci sia maggiore certezza. <br><br>";
            break;

            case 5:
                // Username già presente nel DB
                echo "<span class=\"err_mess\">Username già presente nel nostro elenco!</span><br>";
                echo "Scegline un altro per cortesia. <br><br>";
            break;

            case 6:
                // dati inseriti nel DB ma non reperiti nella ricerca (non in sessione) -> goto login.php         
                echo "<span class=\"valid_mess\">Dati inseriti con successo nel Database!!!</span><br><br>";
                echo "Tuttavia devi effettuare il login per entrare: verrai reindirizzato in pochi secondi<br>";
                header('Refresh: 6; url=login.php');                
            break;

            default:
                // do nothing
            break;
                
        } // fine switch          

        ?>
        Inserisci i tuoi dati:
        <br><br>

            <form action="register.php" method="POST">
                (*) Nome:
                <input type="text" name="nome" placeholder="Nome" required><br><br>
                Cognome:
                <input type="text" name="cognome" placeholder="Cognome" ><br><br>
                E-mail:
                <input type="email" name="email" placeholder="Email" ><br><br>
                (*) Username:
                <input type="text" name="usr" placeholder="Nome utente" required><br><br>
                (*) Password:
                <input type="password" name="pw" placeholder="Password" required> <br><br>
                (*) Password:
                <input type="password" name="pw2" placeholder="Reinserisci la Password" required> <br><br>

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