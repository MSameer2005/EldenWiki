<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true;
if (!$isLogged && !$isAdmin) {
    header('Location: ../Home.php');
}

include '../lib/fetchOptions.php';

if (isset($_SESSION['step']))
    $step = $_SESSION['step'];
else
    $step = 1;

require_once __DIR__ . '/../lib/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Add Weapons</title>
    <link href="../../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <link href="../../css/style.css" rel="stylesheet">
    <script>
        function confirmInsert(form) {
            if (confirm("Vuoi procedere con l'aggiornamento?")) {
                form.submit();
            } else {
                alert("Operazione annullata!");
            }
        }
    </script>
</head>
<body>

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

    <!-- Form 1 -->

    <h2>Add Weapon</h2>
    <form action="insertArma.php" method="POST" class="form_addArma <?php echo ($step != 1) ? 'form-disabled' : ''; ?>">

        <label for="nome">Name:</label>
        <input type="text" name="nome" required>

        <label for="desrizione">Description:</label>
        <textarea type="text" name="descrizione" required></textarea>

        <label for="link-immagine">Link Image:</label>
        <input type="url" name="link-immagine" required>

        <label for="Categorie">Weapons Type:</label>
        <select name="Categorie">
            <?php echo generateOptions('Categorie'); ?>
        </select>

        <label for="peso">Weight:</label>
        <input type="number" name="peso" required min="0" step="0.01">

        <label for="ottenimento">How to Obtain:</label>
        <textarea type="text" name="ottenimento" required></textarea>

        <label for="effetto-stato">Passive:</label>
        <select name="Effetti">
            <option value="">No Passive Effect</option>
            <?php echo generateOptions('Effetti'); ?>
        </select>

        <div id="valore-container">
            <label for="effetto-valore">Value:</label>
            <input type="number" id="effetto-valore" name="effetto-valore" min="0" step="1">
        </div>

        <button type="submit" onclick="confirmInsert(this.form)">Next</button>
    </form>

    <!-- Form 2 -->

    <h2>Add Attributes:</h2>
    <form action="insertAttributi.php" method="POST"
          class="form_addArma_2 <?php echo ($step != 2) ? 'form-disabled' : ''; ?>">

        <!-- Attack Section -->
        <div class="form-section">
            <h3>Attack</h3>
            <div class="form-group">
                <label for="phy">Physical:</label>
                <input type="number" id="phy" name="attack[phy]" min="0" step="1" values="0" placeholder="0">
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
                <input type="number" id="guard_light" name="guard[light]" min="0" step="1" values="0" placeholder="0"
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
                <input type="number" id="str_requires" name="requires[str]" min="0" max="99" step="1" placeholder="0">
            </div>
            <div>
                <label for="dex_requires">Dexterity:</label>
                <input type="number" id="dex_requires" name="requires[dex]" min="0" max="99" step="1" placeholder="0">
            </div>
            <div>
                <label for="int_requires">Intelligence:</label>
                <input type="number" id="int_requires" name="requires[int]" min="0" max="99" step="1" placeholder="0">
            </div>
            <div>
                <label for="fai_requires">Faith:</label>
                <input type="number" id="fai_requires" name="requires[fai]" min="0" max="99" step="1" placeholder="0">
            </div>
            <div>
                <label for="arc_requires">Arcane:</label>
                <input type="number" id="arc_requires" name="requires[arc]" min="0" max="99" step="1" placeholder="0">
            </div>
        </div>

        <button type="submit" onclick="confirmInsert(this.form)">Finish</button>
    </form>

</body>
</html>