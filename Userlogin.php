<?php
session_start();
?>

<?php

//Fonction qui retourne si le couple login/password est dans la table utilisateurs
function loginPassOk($Username,$Pass)
{
$passEncode=md5($Pass.'$x21**');

//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","SAE203")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as nb FROM comptes where Username =? and Pass=?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"ss",$Username,$passEncode) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['nb'];
return $nb==1;
}

// reprise de l'ancien code de login.
if( isset($_POST["Pass"]))
{   
    $login=htmlspecialchars($_POST['Username']);
    $pass=htmlspecialchars($_POST['Pass']);
    if (loginPassOk($login, $pass))
    {
        $_SESSION['OK']=$login;
        header("Location: accueil.php");
        exit;
    }
    
    else
    {
        //print("Vous n'etes pas enregistré !");
        //print("<br>");
        //print("redirection dans 5 secondes...");
        //print('<meta http-equiv="refresh" content="5;formLogin.php">');
        header("Location: formLogin.php?msg=connexion invalide");
        exit;
    }
}

?>
</BODY>
</HTML>