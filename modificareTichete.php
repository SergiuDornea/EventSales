<?php
global $mysqli;
    // Conectare la baza de date:
    include("conectare.php");

    // Se preia ID din pagina de vizualizare:
    $error = "";
    if (!empty($_POST['id']))
    {
        if (isset($_POST['submit']))
        {
            // Verificam daca id-ul din URL este unul valid:
            if (is_numeric($_POST['id']))
            {
                // Preluam variabilele din URL/form:
                $id = $_POST['id'];
                $price = htmlentities($_POST['price'], ENT_QUOTES);
                $status = htmlentities($_POST['status'], ENT_QUOTES);
                $id_user = htmlentities($_POST['id_user'], ENT_QUOTES);
                $id_payment = htmlentities($_POST['id_payment'], ENT_QUOTES);
                $id_event = htmlentities($_POST['id_event'], ENT_QUOTES);

                // Verificam ca datele sa nu fie goale:
                if ($price == '' || $status == ''|| $id_user == ''|| $id_payment == '' || $id_event == '')
                {
                    // Daca sunt goale afisam mesaj de eroare:
                    echo "<div>ERROR: Completati campurile obligatorii!</div>";
                }
                else
                {
                    // Daca nu sunt erori, se face UPDATE:
                    if ($stmt = $mysqli->prepare("UPDATE tickets SET price=?, status=?, ID_USER=?, ID_PAYMENT=?, ID_EVENT=? WHERE ID ='".$id."'"))
                    {
                        $stmt->bind_param("dsiii", $price, $status, $id_user, $id_payment, $id_event);
                        $stmt->execute();
                        $stmt->close();
                    }
                    else
                    {
                        // Mesaj de eroare in caz ca nu poate face UPDATE:
                        echo "<div>ERROR: Nu se poate executa UPDATE!</div>";
                    }
                }
            }
            else
            {
                // Daca variabila 'id' nu este valida, afisam mesaj de eroare:
                echo "ERROR: ID incorrect!";
            }
        }
    } 
?>

<html>
    <head>
        <title>
            <?php
                if ($_GET['id'] != '')
                {
                    echo "Modificare Tichete";
                }
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>
            <?php
                if ($_GET['id'] != '')
                {
                    echo "Modificare Tichete";
                }
            ?>
        </h1>

        <?php
            if ($error != '')
            {
                echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
            }
        ?>

        <form action="" method="POST">
            <div>
                <?php
                    if ($_GET['id'] != '')
                    {
                ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                <p>
                    ID: 
                    <?php 
                        echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM tickets where ID = '".$_GET['id']."'"))
                        {
                            if ($result->num_rows > 0)
                            { 
                                $row = $result->fetch_object();
                    ?>
                </p>
                <strong>Pret: </strong> <input type="number" step="0.01" min="0" name="price" value="<?php echo $row->price; ?>"/><br/>
                <strong>Status: </strong> <input type="text" name="status" value="<?php echo $row->status; ?>"/><br/>
                <strong>ID User: </strong> <input type="number" name="id_user" value="<?php echo $row->ID_USER; ?>"/><br/>
                <strong>ID Payment: </strong> <input type="number" name="id_payment" value="<?php echo $row->ID_PAYMENT; ?>"/><br/>
                <strong>ID Eveniment: </strong> <input type="number" name="id_event" value="<?php echo $row->ID_EVENT;}}} ?>"/><br/>
                <br>
                <input type="submit" name="submit" value="Submit" />
                <a href="vizualizareTichete.php">Vizualizare Tichete</a>
            </div>
        </form>
    </body>
</html>