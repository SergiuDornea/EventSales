<?php
global $mysqli;
    include("conectare.php");
    $error = "";
    if (isset($_POST['submit']))
    {
        // Preluam datele de pe formular:
        $amount = htmlentities($_POST['amount'], ENT_QUOTES);
        $date = htmlentities($_POST['date'], ENT_QUOTES);
        $id_user = htmlentities($_POST['id_user'], ENT_QUOTES);

        // Verificam daca sunt completate:
        if ($amount == '' || $date == '' || $id_user == '')
        {
            // Daca sunt goale se afiseaza un mesaj:
            $error = 'ERROR: Campuri goale!';
        }
        else
        {
            // Facem INSERT:
            if ($stmt = $mysqli->prepare("INSERT into PAYMENTS (amount, date, ID_USER) VALUES (?, ?, ?)"))
            {
                $stmt->bind_param("dsi", $amount, $date, $id_user);
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
        <title>Inserare Payments</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>INSERARE PAYMENTS</h1>

        <?php
            if ($error != "")
            {
                echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
            }
        ?>
        
        <form action="" method="post">
            <div>
                <strong>Amount: </strong> <input type="number" step="0.01" min="0" name="amount" value=""/><br/>
                <strong>Data: </strong> <input type="datetime-local" name="date" value=""/><br/>
                <strong>ID USER: </strong> <input type="text" name="id_user" value=""/><br/>
                <br>
                <input type="submit" name="submit" value="Submit"/>
                <a href="vizualizarePayments.php">Vizualizare Payments</a>
            </div>
        </form>
    </body>
</html>