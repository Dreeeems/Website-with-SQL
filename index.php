<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
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
    
?>
  <?php
  if (isset($_GET['msg']))
    {echo "error ";echo $_GET['msg']."<br/>";}
  ?>

  <?php
  if (isset($_GET['msg']))
    {}
  ?>
<body>

    <div class="block1">
        <img class="fond" src="https://images.unsplash.com/photo-1631227852854-7c0fac3c9aeb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80" alt="fond wiskey">
    </div>

</body>


<?php
    //require ("footer.php");
?>
</body>
</html>




