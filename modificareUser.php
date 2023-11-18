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
        $username = htmlentities($_POST['username'], ENT_QUOTES);
        $password = htmlentities($_POST['password'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
        $isAdmin = htmlentities($_POST['isAdmin'], ENT_QUOTES);
// verificam daca val nu sunt goale
        if ($ID == '' || $username == '' || $password == '' || $email == '' || $nume == '' || $isAdmin == '')
        { // daca sunt goale afisam mesaj de eroare
            echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        { // daca nu sunt erori se face update name, code, image, price, descriere, categorie
            if ($stmt = $mysqli->prepare("UPDATE users SET username=?, password=?, email=?, nume=?, isAdmin=?  WHERE ID='".$ID."'"))
            {
                $stmt->bind_param("ssssi", $username, $password,$email, $nume,$isAdmin);
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
    <link href="style.css" rel="stylesheet" type="text/css"></head>
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo isset($_GET['id']) ? $_GET['id'] : '';
            if ($result = $mysqli->query("SELECT * FROM users where ID='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>

        <strong>username: </strong> <input type="text" name="username" value="<?php echo$row->username;?>"/><br/>
        <strong>password: </strong> <input type="text" name="password" value="<?php echo$row->password;?>"/><br/>
        <strong>email: </strong> <input type="text" name="email" value="<?php echo$row->email;?>"/><br/>
        <strong>nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;?>"/><br/>
        <strong>isAdmin (0 - Nu, 1-Da): </strong> <input type="text" name="nume" value="<?php echo$row->isAdmin;
            }}}?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareUser.php">Index</a>
    </div></form></body> </html>