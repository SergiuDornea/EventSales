<?php
global $mysqli;
    include("conectare.php");
    $error = "";
    if (isset($_POST['submit']))
    {
        // Preluam datele de pe formular:
        $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
        $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
        $date = htmlentities($_POST['date'], ENT_QUOTES);
        $contact = htmlentities($_POST['contact'], ENT_QUOTES);
        $id_partener = htmlentities($_POST['id_partener'], ENT_QUOTES);
        $id_sponsor = htmlentities($_POST['id_sponsor'], ENT_QUOTES);

        // Verificam daca sunt completate:
        if ($titlu == '' || $descriere == ''|| $locatie == '' || $date == ''|| $contact == '' || $id_partener == '' || $id_sponsor == '')
        {
            // Daca sunt goale se afiseaza un mesaj:
            $error = 'ERROR: Campuri goale!';
        }
        else
        {
            // Facem INSERT:
            if ($stmt = $mysqli->prepare("INSERT into EVENTS (titlu, descriere, locatie, date, contact, id_partener, id_sponsor) VALUES (?, ?, ?, ?, ?, ?, ?)"))
            {
                $stmt->bind_param("sssssii", $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor);
                $stmt->execute();
                $id = $stmt->insert_id;
                $stmt->close();

                generateEventPage($id, $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor);
                echo "Evenimentul a fost inserat cu succes! <br> Vezi pagina generata: <a href=\"eveniment_$id.html\">AICI</a>";
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


    function generateEventPage($id, $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor) {
        // Generare HTML pentru pagina web
        $html = "<html>";
        $html .= "<head>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1'>";
        $html .= "<link rel='stylesheet' href='style.css'>";
        $html .= "<title>$titlu</title>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<h1>$titlu</h1>";
        $html .= "<p>Descriere: $descriere</p>";
        $html .= "<p>Locatie: $locatie</p>";
        $html .= "<p>Data: $date</p>";
        $html .= "<p>Contact: $contact</p>";
        $html .= "<p>ID Partener: $id_partener</p>";
        $html .= "<p>ID Sponsor: $id_sponsor</p>";

        // Adaugă formularul cu butonul pentru redirectionare către cos.php
        $html .= '<form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>';
        $html .= '<input type="submit" value="Cumpara Bilet" />';
        $html .= '</form>';

        // Adaugă formularul cu butonul pentru redirectionare către index.php
        $html .= '<form method="post" action="index.php">';
        $html .= '<input type="submit" value="Back to Events" />';
        $html .= '</form>';

        $html .= "</body>";
        $html .= "</html>";
    
        // Salveaza continutul in fisier (poti ajusta calea daca este necesar)
        $filename = "eveniment_$id.html";
        file_put_contents($filename, $html);
    
        // Poti adauga si alte actiuni, cum ar fi redirectionarea catre pagina generata
        // header("Location: $filename");
        // exit();
    }
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
                <strong>Titlu: </strong> <input type="text" name="titlu" value=""/><br/>
                <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
                <strong>Locatie: </strong> <input type="text" name="locatie" value=""/><br/>
                <strong>Data: </strong> <input type="datetime-local" name="date" value=""/><br/>
                <strong>Contact: </strong> <input type="text" name="contact" value=""/><br/>
                <strong>ID Partener: </strong> <input type="text" name="id_partener" value=""/><br/>
                <strong>ID Sponsor: </strong> <input type="text" name="id_sponsor" value=""/><br/>
                <br>
                <input type="submit" name="submit" value="Submit"/>
                <a href="vizualizareEvenimente.php">Vizualizare Evenimente</a>
            </div>
        </form>
    </body>
</html>