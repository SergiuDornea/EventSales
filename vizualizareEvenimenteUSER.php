<!DOCTYPE html  PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Vizualizare Evenimente</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <nav class="navtop">
        <div>
            <h1>PST-EVENTS - user</h1>
            <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
            <a href="userHome.php">Home</a>
        </div>
    </nav>
        <h1>Inregistrarile din Tabela EVENIMENTE</h1>
        <?php
        global $mysqli;
            // Conectare la baza de date:
            include("conectare.php");

            // Se preiau inregistrarile din baza de date:
            if ($result = $mysqli->query("SELECT * FROM events ORDER BY id "))
            {
                // Afisare inregistrari pe ecran:
                if ($result->num_rows > 0)
                {
                    // Afisarea inregistrarilor intr-un tabel:
                    echo "<table border='1' cellpadding='10'>";

                    // Antetul tabelului:
                    echo "<tr><th>Titlu</th><th>Descriere</th><th>Locatie</th><th>Data</th><th>Contact</th>";
                    
                    while ($row = $result->fetch_object())
                    {
                        // Definirea unei linii pentru fiecare inregistrare:
                        echo "<tr>";
                    
                        echo "<td>" . $row->titlu . "</td>";
                        echo "<td>" . $row->descriere . "</td>";
                        echo "<td>" . $row->locatie . "</td>";
                        echo "<td>" . $row->date . "</td>";
                        echo "<td>" . $row->contact . "</td>";
                        
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                else
                {
                    // Daca nu sunt inregistrari se afiseaza un rezultat de eroare:
                    echo "ERROR: Nu sunt inregistrari in tabela! <br>";
                }
            }
            else
            {
                // Eroare in caz de insucces in interogare:
                echo "Error: " . $mysqli->error; 
            }

            // Se inchide:
            $mysqli->close();
        ?>
        <a href="userHome.php">Inapoi la Home</a>
    </body>
</html>