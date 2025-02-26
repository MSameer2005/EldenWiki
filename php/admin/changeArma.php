<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true;
if (!$isLogged && !$isAdmin) {
    header('Location: ../Home.php');
}

include '../lib/fetchOptions.php';
require_once __DIR__ . '/../lib/config.php';

try {
    if (isset($_SESSION['search'])) {
        if (is_array($_SESSION['search'])) {
            $result = $_SESSION['search'];
        } else {
            $errorMessage = $_SESSION['search'];
        }
        unset($_SESSION['search']);
    } else {
        $result = null;
        $conn = null;
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Update Weapon</title>
    <link href="../../css/style.css" rel="stylesheet">
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
        <img src="<?php echo "../../" . $_SESSION['profilePicture']; ?>" alt="Profilo" width="60px"
             style="border-radius: 50%"
             onclick="window.location.href='../Profilo.php'">
    </div>
</header>

<main class="sfondo"><h1 align="center" class="titolo" style="padding-top: 1.5%;">Update Weapon</h1>
    <form action="../lib/Search.php" method="post" class="form_deleteArma">
        <input type="hidden" name="hiddenVariable" value="changeArma">

        <label for="search">Name:</label>
        <input type="search" placeholder="Search.." name="search">

        <label for="categoria">Weapons Types:</label>
        <select id="categoria" name="categoria">
            <option value="">All</option>
            <?php echo generateOptions("Categorie") ?>
        </select>

        <label for="effetto-passivo">Passive:</label>
        <select id="effetto-passivo" name="effetto-passivo">
            <option value="-">-</option>
            <?php echo generateOptions("Effetti") ?>
        </select>

        <button type="submit">Search</button>
    </form>

    <div style="overflow-x:auto;">
        <table id="csv-table">
            <thead>
            <tr>
                <th>Weapon</th>
                <th>Category</th>
                <th>Passive</th>
                <th>Update</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($errorMessage)) {
                echo "<tr><td colspan='4'><img src='../../img/error-404.jpg'></br>$errorMessage</td></tr>";
            } elseif ($result && count($result) > 0) {
                foreach ($result as $row) {
                    $effetto_passivo = explode('<br>', $row['effetto_passivo']);
                    $icona_effetto = $effetto_passivo[0] ?? '';
                    $nome_effetto = $effetto_passivo[1] ?? '';

                    echo "<tr>
                        <td class='weapon-container2'>
                            <img src='{$row['immagine']}' class='weapon-image'>
                            <span class='weapon-name2'>{$row['nome_arma']}</span>
                        </td>
                        <td>{$row['categoria']}</td>
                        <td class='effetto-container2'>";
                    if ($nome_effetto) {
                        echo "<img src='../$icona_effetto' class='effetto-image2'>
                              <p class='weapon-name'>$nome_effetto</p>";
                    } else {
                        echo "<b>-</b>";
                    }
                    echo "</td>
                        <td>
                            <form action='updateArma.php' method='post'>
                                <input type='hidden' name='id_arma' value='{$row['id']}'>
                                <button type='submit' id='deleteFilter'>Update</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'><img src='../../img/error-404.jpg'>No weapons found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>