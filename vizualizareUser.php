<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari USERS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Inregistrarile din tabela USERS</h1>
<p><b>Toate inregistrarile din USERS</b</p>
<?php


// connectare bazadedate
include("conectare.php");
global $mysqli;
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM users ORDER BY id "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='1' cellpadding='10'>";
// antetul tabelului
        echo
        "<tr>
<th>ID</th>
<th>username</th>
<th>password</th>
<th>email</th>
<th>nume</th>
<th>isAdmin</th>
</tr>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->ID . "</td>";
            echo "<td>" . $row->username . "</td>";
            echo "<td>" . $row->password . "</td>";
            echo "<td>" . $row->email . "</td>";
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" . ($row->isAdmin == 1 ? 'Da' : 'Nu') . "</td>"; // folosim ternary operator pt a afisa da, respectiv nu in locul valorii int stocata
            echo "<td><a href='modificareUser.php?id=" . $row->ID . "'>Modificare</a></td>";
            echo "<td><a href='stergereUser.php?id=" .$row->ID . "'>Stergere</a></td>";
            echo "</tr>";
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
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<a href="inserareUser.php">Adaugarea unei noi inregistrari</a>
</body>
</html>
