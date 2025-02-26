<?php
session_start();
require_once __DIR__ . '/../lib/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal form
    $id_arma      = $_SESSION["id_arma"];
    $nome         = $_POST['nome'];
    $descrizione  = $_POST['descrizione'];
    $immagine     = $_POST['link-immagine'];
    $categoria    = $_POST['categoria'];
    $peso         = $_POST['peso'];
    $ottenimento  = $_POST['ottenimento'];
    $effetto      = isset($_POST['Effetti']) ? $_POST['Effetti'] : '';
    $effetto_val  = isset($_POST['effetto-valore']) ? $_POST['effetto-valore'] : 0;

    // Recupera gli array inviati dal form per le statistiche e lo scaling
    $attack   = isset($_POST['attack']) ? $_POST['attack'] : [];
    $defense  = isset($_POST['defense']) ? $_POST['defense'] : [];
    $scaling  = isset($_POST['scaling']) ? $_POST['scaling'] : [];
    $requires = isset($_POST['requires']) ? $_POST['requires'] : [];

    // Mappature per le statistiche:
    $mappingAttack = [
        'phy'  => 'FIS',
        'mag'  => 'MAG',
        'fire' => 'FUO',
        'light'=> 'FUL',
        'holy' => 'SAC',
        'crit' => 'CRT'
    ];
    $mappingDefense = [
        'phy'   => 'FIS',
        'mag'   => 'MAG',
        'fire'  => 'FUO',
        'light' => 'FUL',
        'holy'  => 'SAC',
        'boost' => 'BST'
    ];
    // Mappatura per lo scaling: le chiavi del form (str, dex, int, fai, arc)
    $mappingScaling = [
        'str' => 'FOR',
        'dex' => 'DES',
        'int' => 'INT',
        'fai' => 'FED',
        'arc' => 'ARC'
    ];

    try {
        // Inizia la transazione
        $conn->beginTransaction();

        // 1. Aggiornamento dei dati principali dell'arma
        $stmt = $conn->prepare("UPDATE Armi SET 
            nome = :nome,
            descrizione = :descrizione,
            immagine = :immagine,
            id_categoria = :categoria,
            peso = :peso,
            ottenimento = :ottenimento
            WHERE id_arma = :id_arma");
        $stmt->execute([
            ':nome'         => $nome,
            ':descrizione'  => $descrizione,
            ':immagine'     => $immagine,
            ':categoria'    => $categoria,
            ':peso'         => $peso,
            ':ottenimento'  => $ottenimento,
            ':id_arma'      => $id_arma
        ]);

        // 2. Gestione dell'effetto passivo:
        // Elimina l'eventuale effetto esistente per questa arma
        $stmtDelEffetto = $conn->prepare("DELETE FROM ArmiEffetti WHERE id_arma = :id_arma");
        $stmtDelEffetto->execute([':id_arma' => $id_arma]);
        // Se è stato fornito un effetto, lo inseriamo
        if (!empty($effetto)) {
            $stmtInsEffetto = $conn->prepare("INSERT INTO ArmiEffetti (id_arma, nome_effetto, valore) 
                VALUES (:id_arma, :effetto, :valore)");
            $stmtInsEffetto->execute([
                ':id_arma' => $id_arma,
                ':effetto' => $effetto,
                ':valore'  => $effetto_val
            ]);
        }

        // 3. Aggiornamento delle statistiche:
        // Elimina le statistiche esistenti per questa arma
        $stmtDelStats = $conn->prepare("DELETE FROM Statistiche WHERE id_arma = :id_arma");
        $stmtDelStats->execute([':id_arma' => $id_arma]);

        // Inserisce le nuove statistiche per l'attacco
        foreach ($attack as $key => $val) {
            if (!empty($val) && $val > 0) {
                $stmtInsStat = $conn->prepare("INSERT INTO Statistiche (id_arma, id_tipo, valore, tipologia) 
                    VALUES (:id_arma, :id_tipo, :valore, 'ATT')");
                $stmtInsStat->execute([
                    ':id_arma' => $id_arma,
                    ':id_tipo' => $mappingAttack[$key],
                    ':valore'  => $val
                ]);
            }
        }
        // Inserisce le nuove statistiche per la difesa
        foreach ($defense as $key => $val) {
            if (!empty($val) && $val > 0) {
                $stmtInsStat = $conn->prepare("INSERT INTO Statistiche (id_arma, id_tipo, valore, tipologia) 
                    VALUES (:id_arma, :id_tipo, :valore, 'DEF')");
                $stmtInsStat->execute([
                    ':id_arma' => $id_arma,
                    ':id_tipo' => $mappingDefense[$key],
                    ':valore'  => $val
                ]);
            }
        }

        // 4. Aggiornamento dello scaling:
        // Elimina le registrazioni di scaling esistenti
        $stmtDelScaling = $conn->prepare("DELETE FROM Scaling WHERE id_arma = :id_arma");
        $stmtDelScaling->execute([':id_arma' => $id_arma]);

        // Inserisce i nuovi dati di scaling per ogni attributo se è stato fornito un grado
        foreach ($scaling as $key => $grade) {
            if (!empty($grade)) {
                // Recupera il requisito per lo stesso attributo (default 0 se non impostato)
                $requirement = isset($requires[$key]) ? $requires[$key] : 0;
                $stmtInsScaling = $conn->prepare("INSERT INTO Scaling (id_arma, id_attributo, grado_scaling, parametro)
                    VALUES (:id_arma, :id_attributo, :grado, :parametro)");
                $stmtInsScaling->execute([
                    ':id_arma'      => $id_arma,
                    ':id_attributo' => $mappingScaling[$key],
                    ':grado'        => $grade,
                    ':parametro'    => $requirement
                ]);
            }
        }

        // Commetti la transazione se tutto è andato a buon fine
        $conn->commit();
        unset($_SESSION['id_arma']);
        $_SESSION['error_message'] = "Arma aggiornata con successo!";
        header("Location: changeArma.php");
        exit();

    } catch (PDOException $e) {
        // In caso di errore, annulla la transazione
        $conn->rollBack();
        $_SESSION['error_message'] = "Aggiornamento fallito: " . $e->getMessage();
        header("Location: updateArma.php");
        exit();
    }
} else {
    header("Location: changeArma.php");
    exit();
}
?>
