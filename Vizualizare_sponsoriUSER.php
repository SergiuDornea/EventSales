<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Inregistrari</title>
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
<h1>Inregistrarile din tabela sponsori</h1>
<p><b>Toate inregistrarile din sponsori</b</p><br>
<?php
global $mysqli;
// connectare bazadedate
include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM sponsori ORDER BY ID "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>Nume</th>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";

echo "<td>" . $row->nume . "</td>";

}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo " <br>";
echo "Nu sunt inregistrari in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<a href="userHome.php">Inapoi la Home</a>
</body>
</html>
