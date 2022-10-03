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
    session_start();
    if(isset($_SESSION["OK"])){
    
          require("menu.user.php");
        }
       
      else{
        require ("menu.html");
      }   
  ?>

<form action="numRecette.php" method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Number" name="numeroRecette" required>
      <button type="submit">Rechercher</button>
    </div>
  </form>
  <?php
  if (isset($_GET['msg']))
    {echo "erreur ";echo $_GET['msg']."<br/>";}
  ?>
</BODY>
</HTML>