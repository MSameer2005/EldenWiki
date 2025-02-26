<?php
session_start();

include_once __DIR__ . '/../lib/config.php';
include __DIR__ . '/../lib/resetAutoIncrement.php';

try {
    // Handling Form 1 - Deleting the weapon
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm']) && $_POST['confirm'] === '1') {
        $id = $_POST['id_arma'];

        // Check if weapon already exists
        $query = "SELECT * FROM viewarmi WHERE id = :id";
        $sql = $conn->prepare($query);
        $sql->execute(array(':id' => $id));
        $arma = $sql->fetch(PDO::FETCH_ASSOC);

        if ($arma) {

            echo "<script type='text/javascript'></script>";

            $conn->beginTransaction(); // Inizia una transazione

            try {
                // Delete weapon data from 'armi' table and related tables
                $query_armieffetti = "
                    DELETE FROM armieffetti
                    WHERE id_arma = :id
                    ";

                $sql = $conn->prepare($query_armieffetti);
                $sql->execute(array(':id' => $id));

                $query_scaling = "
                    DELETE FROM scaling
                    WHERE id_arma = :id;
                    ";

                $sql = $conn->prepare($query_scaling);
                $sql->execute(array(':id' => $id));

                $query_statistiche = "
                    DELETE FROM statistiche
                    WHERE id_arma = :id
                    ";

                $sql = $conn->prepare($query_statistiche);
                $sql->execute(array(':id' => $id));

                $query_armi = "
                    DELETE FROM armi
                    WHERE id_arma = :id
                    ";

                $sql = $conn->prepare($query_armi);
                $sql->execute(array(':id' => $id));

                // Commit the transaction
                $conn->commit(); // Se tutto è andato a buon fine, esegui il commit

                // Ora resetta l'auto_increment richiamando la funzione
                if (!resetAutoIncrement($conn, "armi", "id_arma")) {
                    $_SESSION['error_message'] = "Weapon deleted but failed to update AUTO_INCREMENT.";
                    header("location: deleteArma.php");
                    exit();
                }

                $conn = null;

                // Success message
                $_SESSION['error_message'] = "Weapon deleted successfully";
                header("location: deleteArma.php");
                exit();

            } catch (PDOException $e) {
                // Rollback in case of error
                $conn->rollBack(); // Annula tutte le modifiche
                $_SESSION['error_message'] = "Error deleting data: " . $e->getMessage();
                header("location: deleteArma.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Weapon not found";
            header("location: deleteArma.php");
            exit();
        }
    } else {
        header("location: deleteArma.php");
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>