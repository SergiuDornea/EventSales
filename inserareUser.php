<?php
global $mysqli;
include("conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $isAdmin = htmlentities($_POST['isAdmin'], ENT_QUOTES);
// verificam daca sunt completate
    if ($username == '' || $password == ''||$email==''||$nume==''||$isAdmin=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert.
        if ($stmt = $mysqli->prepare("INSERT into users (username, password, email, nume, isAdmin) VALUES (?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("ssssi", $username, $password,$email,$nume,$isAdmin);
            $stmt->execute();
            $stmt->close();
            echo "User adaugat cu succes";
        }
// eroare le inserare
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="style.css" rel="stylesheet" type="text/css">
</head> <body>
<h1><?php echo "Insereaza USER"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <strong>username: </strong> <input type="text" name="username" value=""/><br/>
        <strong>password: </strong> <input type="text" name="password" value=""/><br/>
        <strong>email: </strong> <input type="text" name="email" value=""/><br/>
        <strong>nume: </strong> <input type="text" name="nume" value=""/><br/>

<!--        butoane radio pt a selecta rolul noului user-->
        <strong>Atriubuie rol de admin: </strong> <label>
            <input type="radio" name="isAdmin" value="1">Da
            <span class="select"></span>
        </label>
        <label>
            <input type="radio" name="isAdmin" value="0">Nu
            <span class="select"></span>
        </label>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareUser.php">Index</a>
    </div></form></body></html>