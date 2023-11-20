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
        if ($stmt = $mysqli->prepare("DELETE FROM events WHERE ID =? LIMIT 1"))
        {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();

            // Apelăm funcția pentru ștergerea paginii generată automat
            deleteGeneratedPage($id);
        }
        else
        {
            echo "ERROR: Nu se poate executa DELETE.";
        }
        $mysqli->close();
        echo "<div>Inregistrarea a fost stearsa cu succes!</div>";
    }
    echo "<p><a href=\"vizualizareEvenimente.php\">Vizualizare Evenimente</a></p>";

    // Funcție pentru ștergerea paginii generată automat
    function deleteGeneratedPage($id) 
    {
        $filename = "eveniment_$id.html";

        // Verificare dacă fișierul există înainte de ștergere
        if (file_exists($filename)) 
        {
            // Șterge fișierul
            unlink($filename);
            echo "<div>Pagina generată a fost ștearsă cu succes!</div>";
        } 
        else 
        {
            echo "<div>Pagina generată nu există.</div>";
        }
    }
?>