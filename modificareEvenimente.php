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
                $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
                $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
                $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
                $date = htmlentities($_POST['date'], ENT_QUOTES);
                $contact = htmlentities($_POST['contact'], ENT_QUOTES);
                $id_partener = htmlentities($_POST['id_partener'], ENT_QUOTES);
                $id_sponsor = htmlentities($_POST['id_sponsor'], ENT_QUOTES);

                // Verificam ca datele sa nu fie goale:
                if ($titlu == '' || $descriere == ''|| $locatie == '' || $date == ''|| $contact == '' || $id_partener == '' || $id_sponsor == '')
                {
                    // Daca sunt goale afisam mesaj de eroare:
                    echo "<div>ERROR: Completati campurile obligatorii!</div>";
                }
                else
                {
                    // Daca nu sunt erori, se face UPDATE:
                    if ($stmt = $mysqli->prepare("UPDATE events SET titlu=?, descriere=?, locatie=?, date=?, contact=?, id_partener=?, id_sponsor=? WHERE ID ='".$id."'"))
                    {
                        $stmt->bind_param("sssssii", $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor);
                        $stmt->execute();
                        $stmt->close();
                        
                        // Apelam functia de modificare a paginii generate automat, dupa ce s-au modificat cu succes datele:
                        modifyEventPage($id, $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor);
                        echo "Evenimentul a fost modificat cu succes! <br> Vezi pagina modificata: <a href=\"eveniment_$id.html\">AICI</a>";
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

<?php
    function modifyEventPage($id, $titlu, $descriere, $locatie, $date, $contact, $id_partener, $id_sponsor) {
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
    
        // Salveaza continutul in fisier 
        $filename = "eveniment_$id.html";
        file_put_contents($filename, $html);
    
        // redirectionarea catre pagina generata nu ne trebuie cat timp avem link mai sus
        // header("Location: $filename");
        // exit();
    }
?>
<html>
    <head>
        <title>
            <?php
                if ($_GET['id'] != '')
                {
                    echo "Modificare Evenimente";
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
                    echo "Modificare Evenimente";
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
                        if ($result = $mysqli->query("SELECT * FROM events where ID = '".$_GET['id']."'"))
                        {
                            if ($result->num_rows > 0)
                            { 
                                $row = $result->fetch_object();
                    ?>
                </p>
                <strong>Titlu: </strong> <input type="text" name="titlu" value="<?php echo $row->titlu; ?>"/><br/>
                <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>"/><br/>
                <strong>Locatie: </strong> <input type="text" name="locatie" value="<?php echo $row->locatie; ?>"/><br/>
                <strong>Data: </strong> <input type="datetime-local" name="date" value="<?php echo $row->date; ?>"/><br/>
                <strong>Contact: </strong> <input type="text" name="contact" value="<?php echo $row->contact; ?>"/><br/>
                <strong>ID Partener: </strong> <input type="text" name="id_partener" value="<?php echo $row->ID_PARTENER; ?>"/><br/>
                <strong>ID Sponsor: </strong> <input type="text" name="id_sponsor" value="<?php echo $row->ID_SPONSOR;}}} ?>"/><br/>
                <br>
                <input type="submit" name="submit" value="Submit" />
                <a href="vizualizareEvenimente.php">Vizualizare Evenimente</a>
            </div>
        </form>
    </body>
</html>