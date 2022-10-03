<?php
session_start();
if(!isset($_SESSION['OK']))
{
    header("Location: accueil.php?msg=acces invalide");
    exit;
}
?>