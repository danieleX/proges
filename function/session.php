<?php
   session_start();

   $user = $_SESSION['login_user'];

   if(!isset($_SESSION['login_user'])){
      header("location:function/login.php");
   }
?>
