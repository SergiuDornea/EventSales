<?php // connectare bazadedate
global $mysqli;
include("conectare.php");
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
        $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

// verificam daca val nu sunt goale
        if ($ID == '' || $nume == '' || $prenume == '' || $descriere == '')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
            if ($stmt = $mysqli->prepare("UPDATE speakers SET nume=?, prenume=?, descriere=?  WHERE ID='".$ID."'"))
            {
                $stmt->bind_param("sss", $nume, $prenume,$descriere);
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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo isset($_GET['id']) ? $_GET['id'] : '';
            if ($result = $mysqli->query("SELECT * FROM speakers where ID='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>

        <strong>nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;?>"/><br/>
        <strong>prenume: </strong> <input type="text" name="prenume" value="<?php echo$row->prenume;?>"/><br/>
        <strong>descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere;
        }}}?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareSpeaker.php">Index</a>
    </div></form></body> </html>