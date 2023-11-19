<?php
global $mysqli;
include("conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
// verificam daca sunt completate
    if ($nume == '' || $prenume == ''||$descriere=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert.
        if ($stmt = $mysqli->prepare("INSERT into speakers (nume, prenume, descriere) VALUES (?, ?, ?)"))
        {
            $stmt->bind_param("sss", $nume, $prenume,$descriere);
            $stmt->execute();
            $stmt->close();
            echo "Speaker adaugat cu succes";
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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head> <body>
<h1><?php echo "Insereaza SPEAKER"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <strong>nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>prenume: </strong> <input type="text" name="prenume" value=""/><br/>
        <strong>descriere: </strong> <input type="text" name="descriere" value=""/><br/>

        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareSpeaker.php">Index</a>
    </div></form></body></html>