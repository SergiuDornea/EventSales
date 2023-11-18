<!DOCTYPE html  PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Vizualizare Tichete</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body>
        <h1>Inregistrarile din Tabela TICKETS</h1>
        <?php
            // Conectare la baza de date:
            include("conectare.php");

            // Se preiau inregistrarile din baza de date:
            if ($result = $mysqli->query("SELECT * FROM tickets ORDER BY id "))
            {
                // Afisare inregistrari pe ecran:
                if ($result->num_rows > 0)
                {
                    // Afisarea inregistrarilor intr-un tabel:
                    echo "<table border='1' cellpadding='10'>";

                    // Antetul tabelului:
                    echo "<tr><th>ID</th><th>Pret</th><th>Status</th><th>ID User</th><th>ID Payment</th><th>ID Eveniment</th><th></th><th></th></tr>";
                    
                    while ($row = $result->fetch_object())
                    {
                        // Definirea unei linii pentru fiecare inregistrare:
                        echo "<tr>";
                        echo "<td>" . $row->ID . "</td>";
                        echo "<td>" . $row->price . "</td>";
                        echo "<td>" . $row->status . "</td>";
                        echo "<td>" . $row->ID_USER . "</td>";
                        echo "<td>" . $row->ID_PAYMENT . "</td>";
                        echo "<td>" . $row->ID_EVENT . "</td>";
                        echo "<td><a href='modificareTichete.php?id=" . $row->ID . "'>Modificare</a></td>";
                        echo "<td><a href='stergereTichete.php?id=" .$row->ID . "'>Stergere</a></td>";
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
        <a href="inserareTichete.php">Adaugare TICHET NOU</a>
    </body>
</html>