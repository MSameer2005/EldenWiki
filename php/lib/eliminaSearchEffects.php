<?php
session_start();

// Elimina la variabile $_SESSION['search']
if (isset($_SESSION['search'])) {
    unset($_SESSION['search']);
}

// Reindirizza alla pagina Armi.php
header("Location: ../EffettiStato.php");
exit;
?>