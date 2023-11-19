<?php
global $mysqli;
    include("conectare.php");
    $error = "";
    if (isset($_POST['submit']))
    {
        // Preluam datele de pe formular:
        $id_speaker = htmlentities($_POST['id_speaker'], ENT_QUOTES);
        $id_event = htmlentities($_POST['id_event'], ENT_QUOTES);

        // Verificam daca sunt completate:
        if ($id_speaker == '' || $id_event == '')
        {
            // Daca sunt goale se afiseaza un mesaj:
            $error = 'ERROR: Campuri goale!';
        }
        else
        {
            // Facem INSERT:
            if ($stmt = $mysqli->prepare("INSERT into BOOKING (id_speaker, id_event) VALUES (?, ?)"))
            {
                $stmt->bind_param("ii", $id_speaker, $id_event);
                $stmt->execute();
                $stmt->close();
            }
            else
            {
                // Eroare la inserare:
                echo "ERROR: Nu se poate executa INSERT!";
            }
        }
    }

    // Se inchide conexiunea mysqli:
    $mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Inserare Evenimente</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>INSERARE EVENIMENTE</h1>

        <?php
            if ($error != "")
            {
                echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
            }
        ?>
        
        <form action="" method="post">
            <div>
                <strong>ID Speaker: </strong> <input type="text" name="id_speaker" value=""/><br/>
                <strong>ID Eveniment: </strong> <input type="text" name="id_event" value=""/><br/>
                <br>
                <input type="submit" name="submit" value="Submit"/>
                <a href="vizualizareBookings.php">Vizualizare Bookings</a>
            </div>
        </form>
    </body>
</html>