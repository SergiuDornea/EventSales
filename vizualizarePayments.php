<!DOCTYPE html  PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Vizualizare Payments</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <nav class="navtop">
        <div>
            <h1>PST-EVENTS - admin</h1>
            <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
            <a href="adminHome.php">Home</a>
        </div>
    </nav>
        <h1>Inregistrarile din Tabela PAYMENTS</h1>
        <?php
            global $mysqli;
            // Conectare la baza de date:
            include("conectare.php");

            // Se preiau inregistrarile din baza de date:
            if ($result = $mysqli->query("SELECT * FROM payments ORDER BY id "))
            {
                // Afisare inregistrari pe ecran:
                if ($result->num_rows > 0)
                {
                    // Afisarea inregistrarilor intr-un tabel:
                    echo "<table border='1' cellpadding='10'>";

                    // Antetul tabelului:
                    echo "<tr><th>ID</th><th>Amount</th><th>Data</th><th>ID User</th><th></th><th></th></tr>";
                    
                    while ($row = $result->fetch_object())
                    {
                        // Definirea unei linii pentru fiecare inregistrare:
                        echo "<tr>";
                        echo "<td>" . $row->ID . "</td>";
                        echo "<td>" . $row->amount . "</td>";
                        echo "<td>" . $row->date . "</td>";
                        echo "<td>" . $row->ID_USER . "</td>";
                        echo "<td><a href='modificarePayments.php?id=" . $row->ID . "'>Modificare</a></td>";
                        echo "<td><a href='stergerePayments.php?id=" .$row->ID . "'>Stergere</a></td>";
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
        <a href="inserarePayments.php">Adaugare PAYMENT NOU</a>
    </body>
</html>