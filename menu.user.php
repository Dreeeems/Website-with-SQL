<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->
<?php

echo'<div class="block1">
    <div class="menu">
    <span> Bienvenue '.$_SESSION["OK"].'</span>
    <a href="index.php" class="button">Home</a>
    <a href="formRecette.php" class="button">Select a recipe by number</a>
    <a href="ListeRecettes.php" class="button">Recettes</a>
    <a href="favoris.php" class="button">Favoris</a>
    <a href="logout.php" class="button">Déconnexion</a>
    </div>
    </div>'

?>