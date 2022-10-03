<?php
session_start();
function existefav($Username,$id)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","sae203")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as nbUserid FROM favoris where Username =? AND idRecipe= ?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"si",$Username,$id) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
//print_r($row);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['nbUserid'];
return $nb==1;
}

function ajoutefav($Username,$id){
    $conn=mysqli_connect("localhost:13306", "root","","sae203") or die("Connexion non possible! <br/>". mysqli_connect_error());;

$requete = 'INSERT INTO favoris (Username,idRecipe ) VALUES(?, ?)';
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"si",$Username,$id) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));
mysqli_close($conn) or die(mysqli_error($conn));
}

if(isset($_POST["id"])){

$Username= $_SESSION['OK'];
$id=$_POST["id"];
if (existefav($Username,$id))
{
    header("Location: ListeRecettes.php?msg=Recette déjà ajoutée");
    exit;
}
 ajoutefav($Username,$id);
echo("ajouté aux favoris avec succès,redirection dans 5 secondes");
header("Refresh: 5;URL=ListeRecettes.php");
}