<?php
session_start();
?>
<?php

//Fonction qui retourne si le userid $pseudo est present (true) ou non dans la table utilisateurs (false)
$client = "client";
function existeUserid($Username)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","sae203")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as nbUserid FROM comptes where Username =?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"s",$Username) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
//print_r($row);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['nbUserid'];
return $nb==1;
}

function existeEmail($Email)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","sae203")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as Emailid FROM comptes where Email =?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"s",$Email) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
//print_r($row);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['Emailid'];
return $nb==1;
}

function ajouteUser($Username,$Pass,$Email,$client)
{
    $passEncode=md5($Pass.'$x21**');// ou $x21** est une chaîne ajoutée au mot de passe pour rentre plus complexe son déchiffrage
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","sae203") or die("Connexion non possible! <br/>". mysqli_connect_error());;

$requete = 'INSERT INTO comptes (Username, Pass, Email, client) VALUES(?, ?, ?, ?)';
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"ssss",$Username,$passEncode,$Email,$client) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));
mysqli_close($conn) or die(mysqli_error($conn));
}

if (!isset($_POST['Username'])) 
    {header("Location: formInscription.php");
    exit;
    }

$Username=htmlspecialchars($_POST['Username']);

// si le userid est deja utilisé redirection
if (existeUserid($Username))
{
    header("Location: formRegister.php?msg=Username déjà utilisé");
    exit;
}
$Pass=htmlspecialchars($_POST['Pass']);

$Email=htmlspecialchars($_POST['Email']);
if (existeEmail($Email))
{
    header("Location: formRegister.php?msg=Email déjà utilisé");
    exit;
}

ajouteUser($Username,$Pass,$Email, $client);
$_SESSION['OK']=$Username;
header("Location: formlogin.php");
?>