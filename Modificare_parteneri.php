<?php // connectare bazadedate
global $mysqli;
include("Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
if (is_numeric($_POST['id']))
{ // preluam variabilele din URL/form
$ID = $_POST['id'];
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
// verificam daca numele, prenumele, an si grupa nu sunt goale
if ($nume == '')
{ // daca sunt goale afisam mesaj de eroare
echo "<div> ERROR: Completati campurile obligatorii!</div>";
}else
{ // daca nu sunt erori se face update name, code, image, price, descriere, categorie
if ($stmt = $mysqli->prepare("UPDATE parteneri SET nume=? WHERE ID='".$ID."'"))
{
$stmt->bind_param("s", $nume);
$stmt->execute();
$stmt->close();
}// mesaj de eroare in caz ca nu se poate face update
else
{echo "ERROR: nu se poate executa update.";}
}
}
// daca variabila 'id' nu este valida, afisam mesaj de eroare
else
{echo "id incorect!";} }}?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
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
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<p>ID: <?php echo isset($_GET['id']) ? $_GET['id'] : '';
if ($result = $mysqli->query("SELECT * FROM parteneri where ID='".$_GET['id']."'"))
{
if ($result->num_rows > 0)
{ $row = $result->fetch_object();?></p>
<strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;
}}}?>"/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="Vizualizare_parteneri.php">Index</a>
</div></form></body> </html>