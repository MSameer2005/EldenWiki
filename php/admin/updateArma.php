<?php
session_start();

include '../lib/fetchOptions.php';
require_once __DIR__ . '/../lib/config.php';

// Recupera dati arma
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_arma'])) {
    $id_arma = $_POST['id_arma'];

    try {
        // Recupera dati principali
        $stmt = $conn->prepare("SELECT * FROM Armi WHERE id_arma = :id_arma");
        $stmt->execute([':id_arma' => $id_arma]);
        $arma = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recupera statistiche
        $stats = $conn->prepare("SELECT * FROM Statistiche WHERE id_arma = :id_arma");
        $stats->execute([':id_arma' => $id_arma]);
        $statistiche = $stats->fetchAll(PDO::FETCH_ASSOC);

        // Recupera scaling
        $scaling = $conn->prepare("SELECT * FROM Scaling WHERE id_arma = :id_arma");
        $scaling->execute([':id_arma' => $id_arma]);
        $scalings = $scaling->fetchAll(PDO::FETCH_ASSOC);

        // Recupera effetti
        $effetti = $conn->prepare("SELECT * FROM ArmiEffetti WHERE id_arma = :id_arma");
        $effetti->execute([':id_arma' => $id_arma]);
        $effetto = $effetti->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error fetching weapon data: " . $e->getMessage());
    }
}

// Processa modifica
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id_arma = $_POST['id_arma'];

    try {
        $conn->beginTransaction();

        // Aggiorna dati principali
        $stmt = $conn->prepare("UPDATE Armi SET 
            nome = :nome, 
            descrizione = :descrizione, 
            immagine = :immagine, 
            id_categoria = :id_categoria, 
            peso = :peso, 
            ottenimento = :ottenimento 
            WHERE id_arma = :id_arma");

        $stmt->execute([
            ':nome' => $_POST['nome'],
            ':descrizione' => $_POST['descrizione'],
            ':immagine' => $_POST['link-immagine'],
            ':id_categoria' => $_POST['Categorie'],
            ':peso' => $_POST['peso'],
            ':ottenimento' => $_POST['ottenimento'],
            ':id_arma' => $id_arma
        ]);

        // Gestione effetti stato
        if (!empty($_POST['Effetti'])) {
            $stmt = $conn->prepare("REPLACE INTO ArmiEffetti 
                (id_arma, nome_effetto, valore) 
                VALUES (:id_arma, :nome_effetto, :valore)");

            $stmt->execute([
                ':id_arma' => $id_arma,
                ':nome_effetto' => $_POST['Effetti'],
                ':valore' => $_POST['effetto-valore']
            ]);
        } else {
            $stmt = $conn->prepare("DELETE FROM ArmiEffetti WHERE id_arma = :id_arma");
            $stmt->execute([':id_arma' => $id_arma]);
        }

        // Aggiorna statistiche ATT/DEF
        // ... codice simile a insertAttributi.php con UPDATE ...

        // Aggiorna scaling
        // ... ciclo sugli attributi con REPLACE ...

        $conn->commit();
        $_SESSION['error_message'] = "Weapon updated successfully!";
        header("Location: changeArma.php");

    } catch (PDOException $e) {
        $conn->rollBack();
        $_SESSION['error_message'] = "Update failed: " . $e->getMessage();
        header("Location: updateArma.php?id=$id_arma");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Update Weapon</title>
    <link href="../../css/style.css" rel="stylesheet">
    <script>
        function confirmUpdate(form) {
            if (confirm("Do you want to proceed?")) {
                form.confirm.value = '1';
                form.submit();
            } else {
                alert("Operation Canceled!");
            }
        }
    </script>
</head>
<body>

<div class="myVideo">
    <video autoplay class="myVideo" loop muted>
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
        <img src="<?= "../../" . $_SESSION['profilePicture'] ?>" alt="Profilo" width="60px"
             style="border-radius: 50%"
             onclick="window.location.href='../Profilo.php'">
    </div>
</header>

<main class="sfondo"><h1 align="center" class="titolo" style="padding-top: 1.5%;">Update Weapon</h1>

    <form action="<?php echo htmlspecialchars("PHP_SELF") ?>" method="POST" class="form_addArma">
        <label for="id_arma">ID:</label>
        <input type="text" name="id_arma" value="<?= $arma['id_arma'] ?>" disabled>

        <label for="nome">Name:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($arma['nome']) ?>" required>

        <label for="descrizione">Description:</label>
        <textarea name="descrizione"><?= htmlspecialchars($arma['descrizione']) ?></textarea>

        <label for="link-immagine">Link Image:</label>
        <input type="url" name="link-immagine" value="<?= htmlspecialchars($arma['immagine']) ?>" required>

        <label for="categoria">Weapons Types:</label>
        <select id="categoria" name="categoria">
            <?php
            $categorie = generateOptions('Categorie');
            echo str_replace(
                "value='{$arma['id_categoria']}'",
                "value='{$arma['id_categoria']}' selected",
                $categorie
            );
            ?>
        </select>

        <label for="peso">Weight:</label>
        <input type="number" name="peso" min="0" step="0.01" value="<?= htmlspecialchars($arma['peso']) ?>" required>

        <label for="ottenimento">How to Obtain:</label>
        <textarea type="text" name="ottenimento" required><?= htmlspecialchars($arma['ottenimento']) ?></textarea>

        <label for="effetto-stato">Passive:</label>
        <select name="Effetti">
            <?php
            if (empty($effetto)) {
                echo "<option value=''>No Passive Effect</option>" . generateOptions('Effetti');
            } else {
                $effetti = generateOptions('Effetti');
                echo str_replace(
                        "value='{$arma['id_arma']}'",
                        "value='{$arma['id_arma']}' selected",
                        $effetti
                    ) . "<option value=''>No Passive Effect</option>";
            }
            ?>
        </select>

        <div id="valore-container">
            <label for="effetto-valore">Value:</label>
            <?php if (empty($effetto)): ?>
                <input type="number" id="effetto-valore" name="effetto-valore" min="0" step="1">
            <?php else: ?>
                <input type="number" id="effetto-valore" name="effetto-valore" min="0" step="1"
                       value="<?= htmlspecialchars($effetto['valore']) ?>">
            <?php endif; ?>
        </div>

        <div class="form_addArma_2">
            <!-- Attack Section -->
            <div class="form-section">
                <h3>Attack</h3>
                <div class="form-group">
                    <label for="phy">Physical:</label> <!-- TODO -->
                    <input type="number" id="phy" name="attack[phy]" min="0" step="1" placeholder="0" value="">
                </div>
                <div class="form-group">
                    <label for="mag">Magic:</label>
                    <input type="number" id="mag" name="attack[mag]" min="0" step="1" values="0" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="fire">Fire:</label>
                    <input type="number" id="fire" name="attack[fire]" min="0" step="1" values="0" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="ligt">Lightning:</label>
                    <input type="number" id="light" name="attack[light]" min="0" step="1" values="0" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="holy">Sacred:</label>
                    <input type="number" id="holy" name="attack[holy]" min="0" step="1" values="0" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="crit">Critical:</label>
                    <input type="number" id="crit" name="attack[crit]" min="0" step="1" placeholder="0" required>
                </div>
            </div>

            <!-- Guard Section -->
            <div class="form-section">
                <h3>Defence</h3>
                <div class="form-group">
                    <label for="guard_phy">Physical:</label>
                    <input type="number" id="guard_phy" name="guard[phy]" min="0" step="1" values="0" placeholder="0"
                           required>
                </div>
                <div class="form-group">
                    <label for="guard_mag">Magic:</label>
                    <input type="number" id="guard_mag" name="guard[mag]" min="0" step="1" values="0" placeholder="0"
                           required>
                </div>
                <div class="form-group">
                    <label for="guard_fire">Fire:</label>
                    <input type="number" id="guard_fire" name="guard[fire]" min="0" step="1" values="0" placeholder="0"
                           required>
                </div>
                <div class="form-group">
                    <label for="guard_ligt">Lightning:</label>
                    <input type="number" id="guard_light" name="guard[light]" min="0" step="1" values="0"
                           placeholder="0"
                           required>
                </div>
                <div class="form-group">
                    <label for="guard_holy">Sacred:</label>
                    <input type="number" id="guard_holy" name="guard[holy]" min="0" step="1" values="0" placeholder="0"
                           required>
                </div>
                <div class="form-group">
                    <label for="boost">Boost:</label>
                    <input type="number" id="boost" name="guard[boost]" min="0" step="1" values="0" placeholder="0"
                           required>
                </div>
            </div>

            <!-- Scaling Section -->
            <div class="form-section scaling">
                <h3>Scaling</h3>
                <div>
                    <label for="str_scaling">Strength:</label>
                    <select name="scaling[str]">
                        <option id="str_scaling" name="scaling[str]" value="">Null</option>
                        <option id="str_scaling" name="scaling[str]" value="S">S</option>
                        <option id="str_scaling" name="scaling[str]" value="A">A</option>
                        <option id="str_scaling" name="scaling[str]" value="B">B</option>
                        <option id="str_scaling" name="scaling[str]" value="C">C</option>
                        <option id="str_scaling" name="scaling[str]" value="D">D</option>
                        <option id="str_scaling" name="scaling[str]" value="E">E</option>
                    </select>
                </div>
                <div>
                    <label for="dex_scaling">Dexterity:</label>
                    <select name="scaling[dex]">
                        <option id="dex_scaling" name="scaling[dex]" value="">Null</option>
                        <option id="dex_scaling" name="scaling[dex]" value="S">S</option>
                        <option id="dex_scaling" name="scaling[dex]" value="A">A</option>
                        <option id="dex_scaling" name="scaling[dex]" value="B">B</option>
                        <option id="dex_scaling" name="scaling[dex]" value="C">C</option>
                        <option id="dex_scaling" name="scaling[dex]" value="D">D</option>
                        <option id="dex_scaling" name="scaling[dex]" value="E">E</option>
                    </select>
                </div>
                <div>
                    <label for="int_scaling">Intelligence:</label>
                    <select name="scaling[int]">
                        <option id="int_scaling" name="scaling[int]" value="">Null</option>
                        <option id="int_scaling" name="scaling[int]" value="S">S</option>
                        <option id="int_scaling" name="scaling[int]" value="A">A</option>
                        <option id="int_scaling" name="scaling[int]" value="B">B</option>
                        <option id="int_scaling" name="scaling[int]" value="C">C</option>
                        <option id="int_scaling" name="scaling[int]" value="D">D</option>
                        <option id="int_scaling" name="scaling[int]" value="E">E</option>
                    </select>
                </div>
                <div>
                    <label for="fai_scaling">Faith:</label>
                    <select name="scaling[fai]">
                        <option id="fai_scaling" name="scaling[fai]" value="">Null</option>
                        <option id="fai_scaling" name="scaling[fai]" value="S">S</option>
                        <option id="fai_scaling" name="scaling[fai]" value="A">A</option>
                        <option id="fai_scaling" name="scaling[fai]" value="B">B</option>
                        <option id="fai_scaling" name="scaling[fai]" value="C">C</option>
                        <option id="fai_scaling" name="scaling[fai]" value="D">D</option>
                        <option id="fai_scaling" name="scaling[fai]" value="E">E</option>
                    </select>
                </div>
                <div>
                    <label for="arc_scaling">Arcane:</label>
                    <select name="scaling[arc]">
                        <option id="arc_scaling" name="scaling[arc]" value="">Null</option>
                        <option id="arc_scaling" name="scaling[arc]" value="S">S</option>
                        <option id="arc_scaling" name="scaling[arc]" value="A">A</option>
                        <option id="arc_scaling" name="scaling[arc]" value="B">B</option>
                        <option id="arc_scaling" name="scaling[arc]" value="C">C</option>
                        <option id="arc_scaling" name="scaling[arc]" value="D">D</option>
                        <option id="arc_scaling" name="scaling[arc]" value="E">E</option>
                    </select>
                </div>
            </div>

            <!-- Requires Section -->
            <div class="form-section requires">
                <h3>Requirement</h3>
                <div>
                    <label for="str_requires">Strength:</label>
                    <input type="number" id="str_requires" name="requires[str]" min="0" max="99" step="1"
                           placeholder="0">
                </div>
                <div>
                    <label for="dex_requires">Dexterity:</label>
                    <input type="number" id="dex_requires" name="requires[dex]" min="0" max="99" step="1"
                           placeholder="0">
                </div>
                <div>
                    <label for="int_requires">Intelligence:</label>
                    <input type="number" id="int_requires" name="requires[int]" min="0" max="99" step="1"
                           placeholder="0">
                </div>
                <div>
                    <label for="fai_requires">Faith:</label>
                    <input type="number" id="fai_requires" name="requires[fai]" min="0" max="99" step="1"
                           placeholder="0">
                </div>
                <div>
                    <label for="arc_requires">Arcane:</label>
                    <input type="number" id="arc_requires" name="requires[arc]" min="0" max="99" step="1"
                           placeholder="0">
                </div>
            </div>
        </div>

        <button type="submit" id='deleteFilter' onclick='confirmUpdate(this.form)'>Save Changes</button>
    </form>
</main>
</body>
</html>