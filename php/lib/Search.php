<?php
session_start();

require_once __DIR__ . '/config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
        $attacco = isset($_POST['attacco']) ? $_POST['attacco'] : '';
        $effetto_passivo = isset($_POST['effetto-passivo']) ? $_POST['effetto-passivo'] : '';

        // Query SQL
        if ($_POST["hiddenVariable"] == "Armi" || $_POST["hiddenVariable"] == "deleteArma" || $_POST["hiddenVariable"] == "changeArma") {
            $query = "
            SELECT * 
            FROM ViewArmi 
            WHERE 1=1
            ";
        } elseif ($_POST["hiddenVariable"] == "EffettiStato") {
            $query = "
            SELECT *
            FROM effettiStato
            WHERE 1=1;
            ";
        }

        // Aggiungiamo condizioni solo se i filtri sono impostati
        if (!empty($search)) {
            $query .= " AND nome_arma LIKE :search";
        }
        if (!empty($attacco)) {
            $query .= " AND attacco LIKE :attacco";
        }
        if ((!empty($effetto_passivo) && $effetto_passivo !== '-') && ($_POST["hiddenVariable"] == "Armi" || $_POST["hiddenVariable"] == "deleteArma" || $_POST["hiddenVariable"] == "changeArma")) {
            $query .= " AND effetto_passivo LIKE :effetto_passivo";
        } elseif ((!empty($effetto_passivo) && $effetto_passivo !== '-') && $_POST["hiddenVariable"] == "EffettiStato") {
            $query .= " AND nome LIKE :effetto_passivo";
        }
        if (!empty($categoria)) {
            $query .= " AND categoria = (SELECT nome FROM categorie WHERE id_categoria LIKE :categoria)";
        }

        $stmt = $conn->prepare($query);

        // Binding dei parametri
        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($categoria)) {
            $stmt->bindValue(':categoria', $categoria);
        }
        if (!empty($attacco)) {
            $stmt->bindValue(':attacco', '%' . $attacco . '%');
        }
        if ((!empty($effetto_passivo) && $effetto_passivo !== '-')) {
            $stmt->bindValue(':effetto_passivo', '%' . $effetto_passivo . '%');
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $count = null;

        // Verifica del risultato
        if ($result) {
            $_SESSION['search'] = $result;
        } else {
            $_SESSION['search'] = '404 - Not Found';
        }

        if ($_POST["hiddenVariable"] == "Armi") {
            header('Location: ../Armi.php');
        } elseif ($_POST["hiddenVariable"] == "EffettiStato") {
            header('Location: ../EffettiStato.php');
        } elseif ($_POST["hiddenVariable"] == "deleteArma") {
            header('Location: ../admin/deleteArma.php');
        } elseif ($_POST["hiddenVariable"] == "changeArma") {
            header('Location: ../admin/changeArma.php');
        }
        exit();
    } else {
        $_SESSION['error_message'] = "418 I'm a teapot";
        if ($_POST["hiddenVariable"] == "Armi") {
            header('Location: ../Armi.php');
        } elseif ($_POST["hiddenVariable"] == "EffettiStato") {
            header('Location: ../EffettiStato.php');
        } elseif ($_POST["hiddenVariable"] == "deleteArma") {
            header('Location: ../admin/deleteArma.php');
        } elseif ($_POST["hiddenVariable"] == "changeArma") {
            header('Location: ../admin/changeArma.php');
        }
        exit();
    }
} catch (PDOException $e) {
    // In caso di errore, visualizziamo un messaggio d'errore
    echo "Connection failed: " . $e->getMessage();
}
?>
