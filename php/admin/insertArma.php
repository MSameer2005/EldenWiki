<?php
session_start();

include __DIR__ . '/../lib/config.php';

try {
    // Handling Form 1 - Registering the weapon
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $descrizione = $_POST['descrizione'];
        $link_img = $_POST['link-immagine'];
        $categoria = $_POST['Categorie'];
        $peso = $_POST['peso'];
        $ottenimento = $_POST['ottenimento'];
        $effetti = $_POST['Effetti'];

        // Check if weapon already exists
        $query = "SELECT id_arma, nome FROM armi WHERE nome = :nome";
        $sql = $conn->prepare($query);
        $sql->execute(array(':nome' => $nome));
        $arma = $sql->fetch(PDO::FETCH_ASSOC);

        if ($arma) {
            $_SESSION['error_message'] = "Errore: Arma già registrata";
            header('Location: addArma.php');
            exit();
        } else {
            $conn->beginTransaction(); // Inizia una transazione

            try {
                // Insert weapon data into 'armi' table
                $query_armi = "
                INSERT INTO armi (nome, descrizione, immagine, id_categoria, peso, ottenimento)
                VALUES (:nome, :descrizione, :link_img, :categoria, :peso, :ottenimento)
                ";

                $sql = $conn->prepare($query_armi);
                $sql->execute(array(':nome' => $nome,
                    ':descrizione' => $descrizione,
                    ':link_img' => $link_img,
                    ':categoria' => $categoria,
                    ':peso' => $peso,
                    ':ottenimento' => $ottenimento
                ));

                // Get the ID of the newly inserted weapon
                $query = "SELECT id_arma, nome FROM armi WHERE nome = :nome";
                $sql = $conn->prepare($query);
                $sql->execute(array(':nome' => $nome));
                $arma = $sql->fetch(PDO::FETCH_ASSOC);

                $id_arma = $arma['id_arma'];

                // Insert weapon effects if any
                if ($effetti != '') {
                    $valoreEffetto = $_POST['effetto-valore'];
                    $query_armiEffetto = "
                    INSERT INTO armieffetti (id_arma, nome_effetto, valore)
                    VALUES (:id_arma, :id_effetto, :valore);
                    ";
                    $sql = $conn->prepare($query_armiEffetto);
                    $sql->execute(array(
                        ':id_arma' => $id_arma,
                        ':id_effetto' => $effetti,
                        ':valore' => $valoreEffetto
                    ));
                }

                // Commit the transaction
                $conn->commit(); // Se tutto è andato a buon fine, esegui il commit

                // Success message
                $_SESSION['error_message'] = "Weapon registered successfully";
                $_SESSION['id_arma'] = $id_arma;
                $_SESSION['step'] = 2;
                header("location: addArma.php");
                exit();

            } catch (PDOException $e) {
                // Rollback in case of error
                $conn->rollBack(); // Annula tutte le modifiche
                $_SESSION['error_message'] = "Error saving data: " . $e->getMessage();
                header("location: addArma.php");
                exit();
            }
        }
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
