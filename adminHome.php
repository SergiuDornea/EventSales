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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>PST-EVENTS - admin - PANOU DE CONTROL</h1>
        <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
        <a href="adminHome.php">Home</a>
        <a href="index.php">Events</a>
    </div>
</nav>
<div class="content">
  
    <p>Bine ati revenit, <?=$_SESSION['name']?>!</p>
    <div class = "crud">
        <p>Events : <a href="vizualizareEvenimente.php">manage events here</a></p>
        <p>Users : <a href="vizualizareUser.php">manage users here</a></p>
        <p>Tickets : <a href="vizualizareTichete.php">manage tickets here</a></p>
        <p>Payments : <a href="vizualizarePayments.php">manage payments here</a></p>
        <p>Speakers : <a href="vizualizareSpeaker.php">manage speakers here</a></p>
        <p>Bookings : <a href="vizualizareBookings.php">manage bookings here</a></p>
        <p>Sponsors : <a href="Vizualizare_sponsori.php">manage sponsors here</a></p>
        <p>Partners : <a href="Vizualizare_parteneri.php">manage partners here</a></p>
    </div>

</div>
</body>
</html>
