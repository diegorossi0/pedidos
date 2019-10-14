<?php
session_start();
$_SESSION["logado"] = null;
$_SESSION["idusu"] = null;
$_SESSION["cliente"] = null;
     session_destroy();

     header("location:index.php");
?>