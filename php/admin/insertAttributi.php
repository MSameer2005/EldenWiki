<?php
session_start();

include __DIR__ . '/../lib/config.php';

try {
    // Handling Form 2 - Weapon statistics and scaling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_arma = $_SESSION['id_arma'];

        // Array for attack statistics
        $statistiche_attacco = [
            'FIS' => $_POST['attack']['phy'],
            'MAG' => $_POST['attack']['mag'],
            'FUO' => $_POST['attack']['fire'],
            'FUL' => $_POST['attack']['light'],
            'SAC' => $_POST['attack']['holy'],
            'CRT' => $_POST['attack']['crit']
        ];

        // Array for defense statistics
        $statistiche_difesa = [
            'FIS' => $_POST['guard']['phy'],
            'MAG' => $_POST['guard']['mag'],
            'FUO' => $_POST['guard']['fire'],
            'FUL' => $_POST['guard']['light'],
            'SAC' => $_POST['guard']['holy'],
            'BST' => $_POST['guard']['boost']
        ];

        // Insert attack and defense stats
        $query_statistiche = "
        INSERT INTO Statistiche (id_arma, id_tipo, valore, tipologia) 
        VALUES (:id_arma, :id_tipo, :valore, :tipologia)
        ";
        $sql = $conn->prepare($query_statistiche);

        try {
            // Insert attack statistics
            foreach ($statistiche_attacco as $tipo => $valore) {
                if (!empty($valore) && $valore != 0) {
                    $sql->execute(array(
                        ':id_arma' => $id_arma,
                        ':id_tipo' => $tipo,
                        ':valore' => $valore,
                        ':tipologia' => 'ATT'
                    ));
                }
            }

            // Insert defense statistics
            foreach ($statistiche_difesa as $tipo => $valore) {
                if (!empty($valore) && $valore != 0) {
                    $sql->execute(array(
                        ':id_arma' => $id_arma,
                        ':id_tipo' => $tipo,
                        ':valore' => $valore,
                        ':tipologia' => 'DEF'
                    ));
                }
            }

            // Scaling and requirements handling
            $scalingForza = $_POST['scaling']['str'] ?? null;
            $scalingDestrezza = $_POST['scaling']['dex'] ?? null;
            $scalingIntelligenza = $_POST['scaling']['int'] ?? null;
            $scalingFede = $_POST['scaling']['fai'] ?? null;
            $scalingArcano = $_POST['scaling']['arc'] ?? null;

            $requisitiForza = $_POST['requires']['str'] ?? null;
            $requisitiDestrezza = $_POST['requires']['dex'] ?? null;
            $requisitiIntelligenza = $_POST['requires']['int'] ?? null;
            $requisitiFede = $_POST['requires']['fai'] ?? null;
            $requisitiArcano = $_POST['requires']['arc'] ?? null;

            function insertScaling($conn, $id_arma, $id_attributo, $grado_scaling, $requisiti)
            {
                if (!empty($grado_scaling) || !empty($requisiti)) { // Controlla se entrambi sono non null e diversi da 0
                    $query = "INSERT INTO Scaling (id_arma, id_attributo, grado_scaling, parametro) 
                        VALUES (:id_arma, :id_attributo, :grado_scaling, :parametro)";
                    $sql = $conn->prepare($query);
                    $sql->execute(array(
                        ':id_arma' => $id_arma,
                        ':id_attributo' => $id_attributo,
                        ':grado_scaling' => $grado_scaling,
                        ':parametro' => $requisiti,
                    ));
                }
            }

            // Insert scaling data
            insertScaling($conn, $id_arma, "FOR", $scalingForza, $requisitiForza);
            insertScaling($conn, $id_arma, "DES", $scalingDestrezza, $requisitiDestrezza);
            insertScaling($conn, $id_arma, "INT", $scalingIntelligenza, $requisitiIntelligenza);
            insertScaling($conn, $id_arma, "FED", $scalingFede, $requisitiFede);
            insertScaling($conn, $id_arma, "ARC", $scalingArcano, $requisitiArcano);

            $_SESSION['error_message'] = "Weapon attributes successfully inserted.";
            unset($_SESSION['step']);
            header("location: addArma.php");
            $conn = null;
            exit();

        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error inserting weapon statistics: " . $e->getMessage();
            header("location: addArma.php");
            exit();
        }
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>