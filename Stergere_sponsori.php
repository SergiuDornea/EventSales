<?php
global $mysqli;
// conectare la baza de date database
include("Conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$ID = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("DELETE FROM sponsori WHERE ID = ? LIMIT 1"))
{
$stmt->bind_param("i",$ID);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate executa delete.";
}
$mysqli->close();
echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"Vizualizare_sponsori.php\">Index</a></p>";
?>
