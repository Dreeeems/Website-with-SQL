<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <style>
      
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.image {
    width: 500px;
    height:400px;
}

html,
body {
    height: 100%;
}

.card {
    position: relative;
    background: #fff;
    width: 500px;
    margin: 20px auto;
    box-shadow: 0px 0px 30px 2px #000;
    float:left;
    margin-left:40px;
}

.card .header {
    background: url("") no-repeat center;
    background-size: cover;
    min-height: 400px;
}

.card .header .icon a .fa-heart-o {
    position: absolute;
    left: 85%;
    bottom: 30.7%;
    background: #802ff1;
    color: #fff;
    font-size: 1.3em;
    font-weight: bold;
    padding: 15px;
    border-radius: 50%;
    box-shadow: 0px 5px 30px 1px #802ff1;
}

.card .text .food {
    color: #212129;
    text-align: left;
    font-weight: normal;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin: 5px 30px;
}

.card .info {
    margin: 10px 30px;
    color: #000;
    text-align: left;
    height:80px;
    overflow-y:auto;
}

.card a.btn {
    display: block;
    background: #e5ba95;
    color: rgb(66, 66, 66);
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-align: center;
    padding: 10px;
    transition: 250ms;
}

.card a.btn:hover {
    background: #802ff1;
    transition: 250ms;
    color: #fff;
}
h4{
  text-align:center;
}
</style>
</head>
<body>
<?php
if(isset($_SESSION["type"])){
  if($_SESSION["type"]=="client"){
    require("menu.user.php");
  }
  else{
    require("menuAdmin.php");
  }
}
else{
  require ("menu.html");
}function favoris(){
$login=$_SESSION['OK'];
$conn=mysqli_connect("localhost:13306", "root","","SAE203")  or die(mysqli_error($conn));
$requetes = "SELECT COUNT(*) as total FROM favoris WHERE Username='$login'";
$statement =mysqli_prepare($conn, $requetes)  or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));
$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
$nb=$row['total'];
echo("<h4>Vous avez : $nb favoris enregistrés ! <br><h4>");
$requetes = "SELECT recipe.name,recipe.description,recipe.image from recipe,favoris where favoris.Username='$login' and favoris.idRecipe=recipe.idRecipe";
$result = mysqli_query($conn,$requetes);
$resultCheck =mysqli_num_rows($result);

if($resultCheck>0){
  while($row = mysqli_fetch_array($result)){
    echo ("
    <div class='card'>
            <div class='header'>
            <img class='image' width:'300px' src='$row[image]'>
            </div>
            <div class='text'>
                <h4 class='food'>
                  $row[name]
                </h4>
                </br>
                <p class='info'>$row[description]</p>
            </div>
            </form>
        </div>
    ");  
  }
}
}
            // echo ("<h1 class='title'> $row[name] </h1><br> <p class='description'> $row[description] </p> <br> <img class='image' src='$row[image]'>");
   
  
?>



<?php
favoris();
?>
</BODY>
</HTML>