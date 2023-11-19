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
                $id_speaker = htmlentities($_POST['id_speaker'], ENT_QUOTES);
                $id_event = htmlentities($_POST['id_event'], ENT_QUOTES);

                // Verificam ca datele sa nu fie goale:
                if ($id_speaker == '' || $id_event == '')
                {
                    // Daca sunt goale afisam mesaj de eroare:
                    echo "<div>ERROR: Completati campurile obligatorii!</div>";
                }
                else
                {
                    // Daca nu sunt erori, se face UPDATE:
                    if ($stmt = $mysqli->prepare("UPDATE booking SET id_speaker=?, id_event=? WHERE ID ='".$id."'"))
                    {
                        $stmt->bind_param("ii", $id_speaker, $id_event);
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
                    echo "Modificare Booking";
                }
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>
            <?php
                if ($_GET['id'] != '')
                {
                    echo "Modificare Booking";
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
                        if ($result = $mysqli->query("SELECT * FROM booking where ID = '".$_GET['id']."'"))
                        {
                            if ($result->num_rows > 0)
                            { 
                                $row = $result->fetch_object();
                    ?>
                </p>
                <strong>ID speaker: </strong> <input type="text" name="id_speaker" value="<?php echo $row->ID_SPEAKER; ?>"/><br/>
                <strong>ID event: </strong> <input type="text" name="id_event" value="<?php echo $row->ID_EVENT;}}} ?>"/><br/>
                <br>
                <input type="submit" name="submit" value="Submit" />
                <a href="vizualizareBookings.php">Vizualizare Bookings</a>
            </div>
        </form>
    </body>
</html>