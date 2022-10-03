<?php
//require ("fct.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
<?php
    require ("menu.html");
?>
<?php

function infoRecette($conn,$num)
{
  $requete = "SELECT name,description,image FROM recipe where idRecipe =?" ;
  $statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
  mysqli_stmt_bind_param($statement,"i",$num) or die(mysqli_error($conn));
  mysqli_execute($statement)  or die(mysqli_error($conn));
  
  $resultat=mysqli_stmt_get_result($statement);
  $row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);

  return $row;
}

function afficheTitre($titre)
{
  echo "<h1>".$titre."</h1>";
}

function afficheImage($image)
{
  echo "<style> .imgRecette { background-image:url(".$image."); Background-size:cover; background-position: center;  background-repeat: no-repeat; width: 300px; height: 300px;}</style><div class='imgRecette'></div>";
}

function afficheRecette($description)
{
  // echo ($description);
  // remplace les . par .<br/>
  echo '<h2> Recipe </h2>';
  $recette=str_replace(".",".<br/>",$description);
  echo ($recette);
}

function traitementIngredient($row)
{
  echo '<tr>';
  echo '<td class="name">'.$row["name"]."</td>";
  echo "<td class='quantity'>".$row["quantity"]."</td>"; 
  echo '</tr>';
}

function afficheIngredients($conn,$num)
{
// Recuperation Ingredient et Quantité.
$requete="SELECT name,quantity FROM Composition INNER JOIN Ingredient ON Composition.idIngredient = Ingredient.idIngredient where Composition.idRecipe=?";
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"i",$num) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));

echo '<div id="ingredients">';
echo '<h2> Ingredients </h2>';
echo '<input class="search" placeholder="search"/>';

echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th><button class="sort" data-sort="name">Sort by name</button></th>';
echo '<th><button class="sort" data-sort="quantity">Sort by quantity</button></th>';

echo '</tr>';
echo '</thead>';

echo '<tbody class="list">';
$resultat = mysqli_stmt_get_result($statement);
while ($row = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
  traitementIngredient($row);
}
echo '</tbody>';
echo '</table>';
echo '<ul class="pagination"></ul>';
echo '</div>';
}

if (!isset($_REQUEST["numeroRecette"])) 
{
  header("Location: formRecette.php");
  exit;
}

$num=htmlspecialchars($_REQUEST["numeroRecette"]);
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","SAE203") or die("Connexion non possible! <br/>". mysqli_connect_error());;
// $conn=mysqli_connect("localhost", "leo.lacrabere","","22102786") or die("Connexion non possible! <br/>". mysqli_connect_error());;

// Recuperation du nom de la recette et de sa description
$info=infoRecette($conn,$num);

//affichage de la recette
afficheTitre($info['name']);
afficheImage($info['image']);
afficheRecette($info['description']);
mysqli_close($conn) or die(mysqli_error($conn));

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script src="script.js"></script>
</BODY> 
</HTML>