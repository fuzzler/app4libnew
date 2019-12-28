<?php

// popola massicciamente il database di dati (da usare con cautela per evitare ridondanze inutili)

$pagename = 'Pop DB';

require_once '../conn2db.php';
require_once '../template.php';

$urls = [
    
];

$counter = 0; // conta i record inseriti

if(isset($_POST['populate'])) {

    foreach($urls as $u) {

        $query = "INSERT INTO my_fuzzlernet.a4l_urls (furl,cat) VALUES (:url, 'normal');";
    
        $stmt = $dbo->prepare($query);
        $stmt->bindParam(':url',$u);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $counter++;
        }
    }

    if($counter > 0) {
        echo "<span class=\"valid_mess\">Inseriti $counter record nel DB</span><br>";
    }
    else {
        echo "<span class=\"err_mess\">NESSUN RECORD INSERITO!</span><br>";
    }
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-2"></div>

        <div class="col-8">

            <?php

            echo "<h3 class=\"titolo\">Popola il Database con i seguenti URL:</h3>";

            if(!isset($_POST['populate'])) {
                foreach($urls as $u) {

                    echo "$u <br>";
                }
            
            ?>
            <br>
            <form action='populate_db.php' method="POST">
            <input type="submit" name="populate" value="POPOLA" class="pulsante" >
            </form>

            <?php
            }
            ?>
            

        </div>
        <div class="col-2"></div>


    </div>

</div>






