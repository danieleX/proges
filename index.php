<?php

// Credenziali
include_once('DB/data.php');
//phpinfo();
// Connetto
$conndb = mysqli_connect($host, $userDB, $pswdDB, $database);
// Controlla connessione
if (!$conndb) {
    header("location:DB/homeDB.php");
}  else {
        session_start();
        if(!isset($_SESSION['login_user'])){
            header("location:function/login.php");
        } else {
            header("location:home.php");
        }
}

?>
