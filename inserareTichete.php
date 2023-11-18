<?php
    include("conectare.php");
    $error = "";
    if (isset($_POST['submit']))
    {
        // Preluam datele de pe formular:
        $price = htmlentities($_POST['price'], ENT_QUOTES);
        $status = htmlentities($_POST['status'], ENT_QUOTES);
        $id_user = htmlentities($_POST['id_user'], ENT_QUOTES);
        $id_payment = htmlentities($_POST['id_payment'], ENT_QUOTES);
        $id_event = htmlentities($_POST['id_event'], ENT_QUOTES);

        // Verificam daca sunt completate:
        if ($price == '' || $status == ''|| $id_user == ''|| $id_payment == '' || $id_event == '')
        {
            // Daca sunt goale se afiseaza un mesaj:
            $error = 'ERROR: Campuri goale!';
        }
        else
        {
            // Facem INSERT:
            if ($stmt = $mysqli->prepare("INSERT into TICKETS (price, status, id_user, id_payment, id_event) VALUES (?, ?, ?, ?, ?)"))
            {
                $stmt->bind_param("dsiii", $price, $status, $id_user, $id_payment, $id_event);
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
        <title>Inserare Tichete</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body>
        <h1>INSERARE TICHETE</h1>

        <?php
            if ($error != "")
            {
                echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
            }
        ?>
        
        <form action="" method="post">
            <div>
                <strong>Pret: </strong> <input type="number" step="0.01" min="0" name="price" value=""/><br/>
                <strong>Status: </strong> <input type="text" name="status" value=""/><br/>
                <strong>ID User: </strong> <input type="number" name="id_user" value=""/><br/>
                <strong>ID Payment: </strong> <input type="number" name="id_payment" value=""/><br/>
                <strong>ID Eveniment: </strong> <input type="number" name="id_event" value=""/><br/>
                <br>
                <input type="submit" name="submit" value="Submit"/>
                <a href="vizualizareTichete.php">Vizualizare Tichete</a>
            </div>
        </form>

    </body>
</html>