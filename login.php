<?php
// pagina in cui viene effettuato il login

// session_start();

// Variabili importanti
$pagename = "Login"; // Nome della pagina (richiesto nel template)

// Requirements:
require_once 'template.php';
require_once 'conn2db.php';

// *************

//echo "<pre>"; var_dump($_POST); echo "</pre>";  

// Logiche di login

if(isset($_POST['usr'])) {

    $usr = $_POST['usr'];
    $pw = $_POST['pw'];

    $query = "SELECT * FROM my_fuzzlernet.a4l_users WHERE usr= :usr AND pw= PASSWORD(:pw);";

    // Statement
    $stmt = $dbo->prepare($query);
    $stmt->bindParam(':usr',$usr);
    $stmt->bindParam(':pw',$pw);
    $stmt->execute();

    $response = $stmt->rowCount(); // conta le righe ritornate dal DB
    //echo "Conto righe: ".$response; //die; // stampa di debug

    //echo "<pre>"; var_dump($usrdata); echo "</pre>"; // stampa di debug

    if($response > 0) {

        // Estraggo i dati dal DB
        $usrdata = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['usr_data']['usrid'] = $usrdata['id'];
        $_SESSION['usr_data']['nome'] = $usrdata['nome'];
        //$_SESSION['usr_data']['cognome'] = $usrdata['cognome'];
        $_SESSION['usr_data']['email'] = $usrdata['email'];
        $_SESSION['usr_data']['username'] = $usrdata['usr'];
        //$_SESSION['usr_data']['password'] = $usrdata['pw'];

        header('Location: index.php');
    }
    else {
        $errMess = 'Username o Password ERRATI!';
    }

    //echo "<pre>"; var_dump($_SESSION); echo "</pre>"; // stampa di debug
}



?>
<div class="container-fluid">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <h1 class="titolo">Entra in <?php echo NOME_APP?> </h1>
        
        </div>

        <div class="col-2"></div>
    </div> <!-- fine row1 -->

    <div class="row">
        <div class="col"></div>

        <div class="col">

        <br>
            <?php
                if(isset($errMess)) {
                    ?><span class="err_mess" style="color:red; font-weight: bolder"> 
                    <?php echo $errMess ?> </span><br> <?php
                }
            ?>
            <form action="login.php" method="POST">
                Username:
                <input type="text" name="usr" placeholder="Nome utente" required><br><br>
                Password:
                <input type="password" name="pw" placeholder="Password" required><br><br>

                <input type="submit" name="log" value="INVIA" >
            </form>
        
        </div>
        
        <div class="col"></div>
    </div> <!-- fine row2 -->
  
</div> <!-- fine container -->


