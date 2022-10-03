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

<form action="register.php" method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Nom utilisateur" name="Username" required>
      <br/>
      <label for="mail"><b>Email</b></label>
      <input type="email" placeholder="email" name="Email" required>
      <br/>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Mot de passe" name="Pass" required>
      <br/>
      <button type="submit">Register</button>
    </div>
  </form>
  <?php
  if (isset($_GET['msg']))
    {echo "erreur ";echo $_GET['msg']."<br/>";}
  ?>
</BODY>
</HTML>