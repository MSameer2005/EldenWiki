<?php

/**
 * Resetta l'auto_increment di una tabella in base al massimo valore della colonna specificata.
 *
 * @param PDO $conn Connessione al database.
 * @param string $table Il nome della tabella.
 * @param string $columnName Il nome della colonna auto_increment (es. "id_arma").
 * @return bool                     True in caso di successo, false in caso di errore.
 */
function resetAutoIncrement(PDO $conn, $table, $columnName)
{
    try {
        // Recupera il massimo valore esistente nella colonna
        $query = "SELECT MAX($columnName) AS max_val FROM $table";
        $sql = $conn->prepare($query);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        // Se la tabella è vuota, il nuovo valore deve partire da 1
        $newAutoInc = ($result['max_val'] !== null ? $result['max_val'] : 0) + 1;

        // Debugging: stampare il valore calcolato (da rimuovere in produzione)
        error_log("Reset AUTO_INCREMENT for $table: $newAutoInc");

        // Imposta il nuovo valore dell'auto_increment con ALTER TABLE
        $queryAlter = "ALTER TABLE $table AUTO_INCREMENT = :newAutoInc";
        $sql = $conn->prepare($queryAlter);
        $sql->bindParam(':newAutoInc', $newAutoInc, PDO::PARAM_INT);
        $sql->execute();

        return true;
    } catch (PDOException $e) {
        error_log("Error resetting AUTO_INCREMENT: " . $e->getMessage());
        return false;
    }
}

?>