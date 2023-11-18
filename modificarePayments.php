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
                $amount = htmlentities($_POST['amount'], ENT_QUOTES);
                $date = htmlentities($_POST['date'], ENT_QUOTES);
                $id_user = htmlentities($_POST['id_user'], ENT_QUOTES);

                // Verificam ca datele sa nu fie goale:
                if ($amount == '' || $date == '' || $id_user == '')
                {
                    // Daca sunt goale afisam mesaj de eroare:
                    echo "<div>ERROR: Completati campurile obligatorii!</div>";
                }
                else
                {
                    // Daca nu sunt erori, se face UPDATE:
                    if ($stmt = $mysqli->prepare("UPDATE payments SET amount=?, date=?, ID_USER=? WHERE ID ='".$id."'"))
                    {
                        $stmt->bind_param("dsi", $amount, $date, $id_user);
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
                    echo "Modificare Payments";
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
                    echo "Modificare Payments";
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
                        if ($result = $mysqli->query("SELECT * FROM payments where ID = '".$_GET['id']."'"))
                        {
                            if ($result->num_rows > 0)
                            { 
                                $row = $result->fetch_object();
                    ?>
                </p>
                <strong>Amount: </strong> <input type="number" step="0.01" min="0" name="amount" value="<?php echo $row->amount; ?>"/><br/>
                <strong>Data: </strong> <input type="datetime-local" name="date" value="<?php echo $row->date; ?>"/><br/>
                <strong>ID User: </strong> <input type="text" name="id_user" value="<?php echo $row->ID_USER;}}} ?>"/><br/>
                <br>
                <input type="submit" name="submit" value="Submit" />
                <a href="vizualizarePayments.php">Vizualizare Payments</a>
            </div>
        </form>
    </body>
</html>