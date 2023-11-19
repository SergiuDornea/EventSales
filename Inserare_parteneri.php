<?php
global $mysqli;
include("Conectare.php");
$error='';

if (isset($_POST['submit'])) {
    // preluam datele de pe formular
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);

    // verificam daca sunt completate
    if ($nume == '') {
        // daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
        // insert
        if ($stmt = $mysqli->prepare("INSERT into parteneri (nume) VALUES (?)")) {
            $stmt->bind_param("s", $nume);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.".$mysqli->error;
        }
    }
}

// se inchide conexiune mysqli
$mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php echo "Inserare inregistrare"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navtop">
        <div>
            <h1>PST-EVENTS - admin</h1>
            <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
            <a href="adminHome.php">Home</a>
        </div>
    </nav>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>"; } ?>

    <form action="" method="post">
        <div>
            <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="Vizualizare_parteneri.php">Index</a>
        </div>
    </form>
</body>
</html>
