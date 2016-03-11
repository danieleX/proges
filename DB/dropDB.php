<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['confirm'] == 'Yes') {
        // Credenziali
        include_once("config.php");
        // Cancella database
        $sql = "DROP DATABASE IF EXISTS $database";
        if (mysqli_query($conndb, $sql)) {
            echo "Database eliminato con successo";
            header('Refresh: 3; URL = homeDB.php');
          $fp = fopen('data.php', 'w');
            fwrite($fp,
        '<?php
        $host = "";
        $userDB = "";
        $pswdDB = "";
        $database = "";
        ?>'  ); } else {
            echo "C'e' stato un errore eliminando il database: " . mysqli_error($conndb);
        }
    }
    if ($_POST['confirm'] == 'No') {
    echo "Ottima scelta. Il DB e' salvo. Attendi 5 secondi";
    header('Refresh: 3; URL = homeDB.php');
    }
}
?>
<form method="POST">
    Sei sicuro/a?
    <input type="submit" name="confirm" value="Yes">
    <input type="submit" name="confirm" value="No">
</form>
