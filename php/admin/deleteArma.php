<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true;
if (!$isLogged && !$isAdmin) {
    header('Location: ../Home.php');
}

$errorMessage = null;

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
    // In caso di errore, visualizziamo un messaggio d'errore
    die("Si è verificato un errore durante la connessione al database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="../../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Delete Weapon</title>
    <link href="../../css/style.css" rel="stylesheet">
    <script>
        function confirmDeletion(form) {
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
                    <a href="../Incantesimi.php">Incantations</a>
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

<main class="sfondo"><h1 align="center" class="titolo" style="padding-top: 1.5%;">Delete Weapon</h1>
    <form action="../lib/Search.php" method="post" class="form_deleteArma">
        <input type="hidden" name="hiddenVariable" value="deleteArma">

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
                <th>Weapons Type</th>
                <th>Passive</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php
            if (isset($_SESSION['error_message'])) {
                echo "<script type='text/javascript'>alert('" . $_SESSION['error_message'] . "')</script>";
                unset($_SESSION['error_message']);
            }
            if (empty($result)) {
                echo "<tr><td colspan='10'><img src='../../img/error-404.jpg'></br>" . $errorMessage . "</td></tr>";
            } elseif (count($result) > 0) {
                foreach ($result

                         as $row) {
                    $effetto_passivo = explode('<br>', $row['effetto_passivo']);

                    // Inizializza valori vuoti per icona_effetto e nome_effetto
                    $icona_effetto = '';
                    $nome_effetto = '';

                    echo "<tr>
                    <td class='weapon-container2'>
                        <img src='" . $row['immagine'] . "' class='weapon-image'>
                        <span class='weapon-name2'>" . $row['nome_arma'] . "</span>
                    </td>
                    <td class='categoria2'>" . $row['categoria'] . "</td>
                    ";
                    if (count($effetto_passivo) >= 2) {
                        $icona_effetto = $effetto_passivo[0];
                        $nome_effetto = $effetto_passivo[1];

                        echo "<td class='effetto-container2'>
                                <img src='../" . $icona_effetto . "' class='effetto-image2'>
                                <p class='weapon-name'>" . $nome_effetto . "</p>
                              </td>";
                    } else {
                        echo "<td><b>-</b></td>";
                    }
                    echo "<td>
                            <form action='removeArma.php' method='post'>
                                <input type='hidden' name='id_arma' value=" . $row['id'] . ">
                                <input type='hidden' name='confirm' value='0'>
                                <button type='button' id='deleteFilter' onclick='confirmDeletion(this.form)'>Delete</button>
                            </form>
                        </td>";
                }
            } else {
                echo "
            <tr>
                <td colspan='10'><img src='../../img/error-404.jpg'>No data found.</td>
            </tr>
            ";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<footer>
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>

</body>
</html>