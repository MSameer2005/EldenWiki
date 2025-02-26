<?php
session_start();

$id_arma = $_POST['id_arma'];
$_SESSION['id_arma'] = $id_arma;

// Se l'id dell'arma non è presente nella sessione, reindirizza a changeArma.php
if (empty($_SESSION['id_arma'])) {
    header("Location: changeArma.php");
    exit();
}

// Includi il file di configurazione e le funzioni per le opzioni
require_once __DIR__ . '/../lib/config.php';
include_once '../lib/fetchOptions.php';

// Recupera i dati dell'arma dal database
try {
    // Dati principali dell'arma
    $stmt = $conn->prepare("SELECT * FROM Armi WHERE id_arma = :id_arma");
    $stmt->execute([':id_arma' => $id_arma]);
    $arma = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$arma) {
        $_SESSION['error_message'] = "Weapon not found!";
        header("Location: changeArma.php");
        exit();
    }

    // Recupera le statistiche (attacco e difesa)
    $stmtStats = $conn->prepare("SELECT * FROM Statistiche WHERE id_arma = :id_arma");
    $stmtStats->execute([':id_arma' => $id_arma]);
    $statistiche = $stmtStats->fetchAll(PDO::FETCH_ASSOC);

    // Recupera i dati di scaling
    $stmtScaling = $conn->prepare("SELECT * FROM Scaling WHERE id_arma = :id_arma");
    $stmtScaling->execute([':id_arma' => $id_arma]);
    $scalings = $stmtScaling->fetchAll(PDO::FETCH_ASSOC);

    // Recupera l'effetto passivo, se presente
    $stmtEffetti = $conn->prepare("SELECT * FROM ArmiEffetti WHERE id_arma = :id_arma");
    $stmtEffetti->execute([':id_arma' => $id_arma]);
    $effetto = $stmtEffetti->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error while receiving data: " . $e->getMessage());
}

// Funzione di supporto per generare le options segnando quella selezionata
function generateSelectedOptions($table, $selectedValue)
{
    $options = generateOptions($table);
    return str_replace("value='$selectedValue'", "value='$selectedValue' selected", $options);
}

// Imposta valori di default per le statistiche di attacco e difesa
$defaultStats = [
    'attack' => ['phy' => 0, 'mag' => 0, 'fire' => 0, 'light' => 0, 'holy' => 0, 'crit' => 0],
    'defense' => ['phy' => 0, 'mag' => 0, 'fire' => 0, 'light' => 0, 'holy' => 0, 'boost' => 0]
];

// Mappatura per statistiche di attacco (FIS, MAG, FUO, FUL, SAC, CRT)
$mappingAttack = ['FIS' => 'phy', 'MAG' => 'mag', 'FUO' => 'fire', 'FUL' => 'light', 'SAC' => 'holy', 'CRT' => 'crit'];
// Mappatura per statistiche di difesa (FIS, MAG, FUO, FUL, SAC, BST)
$mappingDefense = ['FIS' => 'phy', 'MAG' => 'mag', 'FUO' => 'fire', 'FUL' => 'light', 'SAC' => 'holy', 'BST' => 'boost'];

foreach ($statistiche as $stat) {
    if ($stat['tipologia'] == 'ATT' && isset($mappingAttack[$stat['id_tipo']])) {
        $defaultStats['attack'][$mappingAttack[$stat['id_tipo']]] = $stat['valore'];
    }
    if ($stat['tipologia'] == 'DEF' && isset($mappingDefense[$stat['id_tipo']])) {
        $defaultStats['defense'][$mappingDefense[$stat['id_tipo']]] = $stat['valore'];
    }
}

// Imposta valori di default per scaling e requisiti
$defaultScaling = [
    'str' => ['scaling' => '', 'requirement' => 0],
    'dex' => ['scaling' => '', 'requirement' => 0],
    'int' => ['scaling' => '', 'requirement' => 0],
    'fai' => ['scaling' => '', 'requirement' => 0],
    'arc' => ['scaling' => '', 'requirement' => 0]
];
// Mappatura degli attributi: FOR->str, DES->dex, INT->int, FED->fai, ARC->arc
$mappingScaling = ['FOR' => 'str', 'DES' => 'dex', 'INT' => 'int', 'FED' => 'fai', 'ARC' => 'arc'];
foreach ($scalings as $scaling) {
    if (isset($mappingScaling[$scaling['id_attributo']])) {
        $key = $mappingScaling[$scaling['id_attributo']];
        $defaultScaling[$key]['scaling'] = $scaling['grado_scaling'];
        $defaultScaling[$key]['requirement'] = $scaling['parametro'];
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Weapon</title>
    <link href="../../css/style.css" rel="stylesheet">
    <script>
        function confirmUpdate(form) {
            if (confirm("Do you want to proceed?")) {
                form.submit();
            } else {
                alert("Operation Canceled!");
            }
        }
    </script>
</head>
<body>

<div class="myVideo">
    <video autoplay loop muted class="myVideo">
        <source src="../../img/EldenRing.mp4" type="video/mp4">
    </video>
</div>

<header class="sfondo">
    <a href="../Home.php"><h1>Elden Wiki</h1></a>
    <div class="menu">
        <ul>
            <li><a href="../Home.php">Home</a></li>
            <li><a href="../Lore.php">Lore</a></li>
            <li><a href="../Walkthrough.php">Walkthrough</a></li>
            <div class="dropdown">
                <li class="dropbtn">Equipment</li>
                <div class="dropdown-content">
                    <a href="../Armi.php">Weapons</a>
                    <a href="../Armature.php">Armor</a>
                    <a href="../Incantesimi.php">Incatations</a>
                    <a href="../Stregonerie.php">Sorcery</a>
                    <a href="../CeneriDiGuerra.php">Ashes of War</a>
                </div>
            </div>
            <li><a href="../EffettiStato.php">Status Effects</a></li>
            <li><a href="../Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <img src="<?php echo "../../" . $_SESSION['profilePicture']; ?>" alt="Profilo" width="60px"
             style="border-radius: 50%"
             onclick="window.location.href='../Profilo.php'">
    </div>
</header>

<main class="sfondo">

    <?php
    if (isset($_SESSION['error_message'])) {
        echo "<script type='text/javascript'>alert('" . $_SESSION['error_message'] . "')</script>";
        unset($_SESSION['error_message']);
    }
    ?>

    <h1 align="center" class="titolo" style="padding-top: 1.5%;">Aggiorna Arma</h1>
    <form action="processUpdate.php" method="POST" class="form_addArma">

        <label for="id_arma">ID:</label>
        <input type="text" name="id_arma" value="<?= htmlspecialchars($arma['id_arma']) ?>" disabled>

        <label for="nome">Name:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($arma['nome']) ?>" required>

        <label for="descrizione">Description:</label>
        <textarea name="descrizione" required><?= htmlspecialchars($arma['descrizione']) ?></textarea>

        <label for="link-immagine">Image Link:</label>
        <input type="url" name="link-immagine" value="<?= htmlspecialchars($arma['immagine']) ?>" required>

        <label for="categoria">Category:</label>
        <select name="categoria" id="categoria">
            <?= generateSelectedOptions("Categorie", $arma['id_categoria']) ?>
        </select>

        <label for="peso">Weight:</label>
        <input type="number" name="peso" step="0.01" min="0" value="<?= htmlspecialchars($arma['peso']) ?>" required>

        <label for="ottenimento">How to Obtain:</label>
        <textarea name="ottenimento" required><?= htmlspecialchars($arma['ottenimento']) ?></textarea>

        <label for="Effetti">Passive Effects:</label>
        <select name="Effetti">
            <?php
            // Se non esiste un effetto, mostra l'opzione "No Passive Effect"
            if (empty($effetto)) {
                echo "<option value=''>No Passive Effect</option>";
                echo generateOptions("Effetti");
            } else {
                $selectedEffetto = $effetto['nome_effetto'];
                $optionsEffetti = generateOptions("Effetti");
                // Evidenzia l'effetto attualmente impostato
                $selectedOptions = str_replace("value='$selectedEffetto'", "value='$selectedEffetto' selected", $optionsEffetti);
                echo $selectedOptions;
                echo "<option value=''>No Passive Effect</option>";
            }
            ?>
        </select>

        <label for="effetto-valore">Passive Effects Value:</label>
        <input type="number" name="effetto-valore" min="0" step="1"
               value="<?= ($effetto) ? htmlspecialchars($effetto['valore']) : '' ?>">

        <div class="form_addArma_2" style="width: 90%; border: none">
            <div class="form-section">
                <h3>Attack Statistics</h3>
                <?php
                // Campi per le statistiche di attacco: phy, mag, fire, light, holy, crit
                foreach ($defaultStats['attack'] as $key => $value) {
                    echo "<div class='form-group'>";
                    echo "<label for='attack_$key'>" . ucfirst($key) . ":</label>";
                    echo "<input type='number' id='attack_$key' name='attack[$key]' min='0' step='1' value='$value'>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="form-section">
                <h3>Defensive Statistic</h3>
                <?php
                // Campi per le statistiche di difesa: phy, mag, fire, light, holy, boost
                foreach ($defaultStats['defense'] as $key => $value) {
                    echo "<div class='form-group'>";
                    echo "<label for='defense_$key'>" . ucfirst($key) . ":</label>";
                    echo "<input type='number' id='defense_$key' name='defense[$key]' min='0' step='1' value='$value'>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="form-section">
                <div class="update-arma-section">
                    <h3>Scaling and Requirements</h3>
                    <div class="scaling-requisites">
                        <?php
                        // Per ogni attributo: str, dex, int, fai, arc
                        foreach ($defaultScaling as $key => $data) {

                            echo "<div class='scaling-item'>";
                            echo "<label for='scaling_$key'>" . strtoupper($key) . " Scaling:</label>";
                            echo "<select name='scaling[$key]' id='scaling_$key'>";
                            $grades = ['', 'S', 'A', 'B', 'C', 'D', 'E'];
                            foreach ($grades as $grade) {
                                $selected = ($data['scaling'] === $grade) ? "selected" : "";
                                $display = ($grade === '') ? "Null" : $grade;
                                echo "<option value='$grade' $selected>$display</option>";
                            }
                            echo "</select>";
                            echo "</div>";

                            echo "<div class='scaling-item'>";
                            echo "<label for='requirement_$key'>" . strtoupper($key) . " Req.:</label>";
                            echo "<input type='number' id='requirement_$key' name='requires[$key]' min='0' max='99' step='1' value='{$data['requirement']}'>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" onclick="confirmUpdate(this.form)">Update Weapon</button>
    </form>
</main>
</body>
</html>
