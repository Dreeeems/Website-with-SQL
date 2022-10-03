<?php
function connexion()

{
    $conn=mysqli_connect("localhost:13306", "root","","SAE203") or die("Connexion non possible! <br/>". mysqli_connect_error());;
}



?>

