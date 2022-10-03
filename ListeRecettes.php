<?php
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>recipes list</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="style.css">
</head>
<style>
  @import url("https://fonts.googleapis.com/css?family=Roboto");
* {
    margin: 0;
    padding: 0;
    font-family: "Roboto", sans-serif;
    list-style-type: none;
    text-decoration: round;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
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

.number{
    display:none;
}
button{
    cursor:pointer;
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
}   
if(isset($_POST['id'])){
    echo $_POST['id'];
}
?>




<?php
$conn=mysqli_connect("localhost:13306", "root","","SAE203")  or die(mysqli_error($conn));
$requetes = "SELECT name,description,image,idRecipe FROM recipe";
$result = mysqli_query($conn,$requetes);
$resultCheck =mysqli_num_rows($result);
if($resultCheck>0){
    while($row = mysqli_fetch_array($result)){
            // echo ("<h1 class='title'> $row[name] </h1><br> <p class='description'> $row[description] </p> <br> <img class='image' src='$row[image]'>");
            echo ("
<div class='card'>
        <div class='header'>
        <img class='image' width:'300px' src='$row[image]'>
            <div class='icon'>
            <form action='addfav.php' method='post'> 
            <input type='value'name='id' value='$row[idRecipe]' class='number'>
            <a><button type='submit' class='btn btn-default'><a><i class='fa fa-heart-o'></i></a></button>
                </form>
            </div>
        </div>
        <div class='text'>
            <h4 class='food'>
              $row[name]
            </h4>
            </br>
            <p class='info'>$row[description]</p>
        </div>
        <form action='Recipe.php' method='post'> 
        <input type='value'name='id' value='$row[idRecipe]' class='number'>
        <a> <button class='cookingb' type='submit' class='btn btn-default' >Let's Cook!</button></a>
        </form>
    </div>
");  

    }

}
?>
</BODY>
</HTML>