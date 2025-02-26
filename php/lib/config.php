<?php

// Impostiamo i dati per la connessione al database
$servername = 'localhost';
$username = 'root';
$password = 'mysql';
$dbName = 'eldenring';

// Cerchiamo di stabilire una connessione al database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // Impostiamo il modo di gestione degli errori: in caso di errore viene lanciata un'eccezione
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
