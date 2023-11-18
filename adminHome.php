<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PST-EVENTS</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>PST-EVENTS - admin</h1>
        <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
    </div>
</nav>
<div class="content">
  
    <p>Bine ati revenit, <?=$_SESSION['name']?>!</p>
    <div class = "crud">
        <p>Users : <a href="vizualizareUser.php">manage users here</a></p>
        <p>Tickets : <a href="vizualizareTichete.php">manage tickets here</a></p>

    </div>

</div>
</body>
</html>
