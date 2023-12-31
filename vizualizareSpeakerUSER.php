<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari SPEAKER</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navtop">
    <div>
        <h1>PST-EVENTS - user</h1>
        <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
        <a href="userHome.php">Home</a>
    </div>
</nav>
<h1>Inregistrarile din tabela SPEAKER</h1>
<p><b>Toate inregistrarile din SPEAKER</b</p>
<?php


// connectare bazadedate
include("conectare.php");
global $mysqli;
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM speakers ORDER BY id "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";
// antetul tabelului
        echo
        "<tr>
<th>nume</th>
<th>prenume</th>
<th>descriere</th>
</tr>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
           
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" . $row->prenume . "</td>";
            echo "<td>" . $row->descriere . "</td>";
        }
        echo "</table>";
    }
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
    else
    {
        echo "Nu sunt inregistrari in tabela!";
    }
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error; }
// se inchide
$mysqli->close();
?>
<a href="userHome.php">Inapoi la Home</a>
</body>
</html>
