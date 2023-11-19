<?php
    global $mysqli;
    // Conectare la baza de date:
    include("conectare.php");

    // Se verifica daca id-ul a fost primit:
    if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
        // Preluam variabila 'id' din URL:
        $id = $_GET['id'];

        // Stergem inregistrarea cu id = $id:
        if ($stmt = $mysqli->prepare("DELETE FROM payments WHERE ID =? LIMIT 1"))
        {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Nu se poate executa DELETE.";
        }
        $mysqli->close();
        echo "<div>Inregistrarea a fost stearsa cu succes!</div>";
    }
    echo "<p><a href=\"vizualizarePayments.php\">Vizualizare Payments</a></p>";
?>