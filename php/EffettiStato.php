<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}

include __DIR__ . '/lib/fetchOptions.php';
require_once __DIR__ . '/lib/config.php';

try {
    if (isset($_SESSION['search'])) {
        if (is_array($_SESSION['search'])) {
            $result = $_SESSION['search'];
        } else {
            $errorMessage = $_SESSION['search'];
        }
        unset($_SESSION['search']);
    } else {
        // Query SQL
        $sql = "
        SELECT *
        FROM effettistato
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Weapons</title>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

<div class="myVideo">
    <video autoplay class="myVideo" loop muted>
        <source src="../img/EldenRing.mp4" type="video/mp4">
    </video>
</div>

<header class="sfondo">
    <a href="Home.php"><h1>Elden Wiki</h1></a>
    <div class="menu">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Lore.php">Lore</a></li>
            <li><a href="Walkthrough.php">Walkthrough</a></li>
            <div class="dropdown">
                <li class="dropbtn">Equipment</li>
                <div class="dropdown-content">
                    <a href="Armi.php">Weapons</a>
                    <a href="Armature.php">Armors</a>
                    <a href="Incantesimi.php">Incantations</a>
                    <a href="Stregonerie.php">Sorcery</a>
                    <a href="CeneriDiGuerra.php">Ashes of War</a>
                </div>
            </div>
            <li><a href="EffettiStato.php">Status Effects</a></li>
            <li><a href="Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <img alt="Profilo" onclick="window.location.href='Profilo.php'"
             src="<?php echo "../" . $_SESSION['profilePicture']; ?>"
             style="border-radius: 50%"
             width="60px">
    </div>
</header>

<main class="sfondo">
    <h1 align="center" class="titolo" style="padding-top: 1.5%;">Status Effects</h1>

    <div class="contenitoreFiltro">
        <button id="openFormButton">Filter</button>
        <button id="deleteFilter" onclick="window.location.href='lib/eliminaSearchEffects.php'">Remove Filter</button>
    </div>

    <div id="sideForm" class="side-form">

        <span id="closeFormButton" class="close-btn">&times;</span>

        <div class="search-container">

            <form action="lib/Search.php" method="post">
                <input type="hidden" name="hiddenVariable" value="EffettiStato"/>

                <label for="effetto-passivo">Passive:</label>
                <select id="effetto-passivo" name="effetto-passivo">
                    <option value="-">All</option>
                    <?php echo generateOptions("Effetti") ?>
                </select>

                <button type="submit"><img src="../img/Icon/SearchBar.png" class="fa fa-search" width="30px"></button>
            </form>

        </div>
    </div>

    <script src="../js/sideForm.js"></script>

    <div style="overflow-x:auto;">
        <table id="csv-table">
            <thead>
            <tr>
                <th>Passive</th>
                <th>Description</th>
                <th>Mitigated By</th>
                <th>Cured By</th>
                <th>Fortitude</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php
            if (isset($errorMessage)) {
                echo "<tr><td colspan='10'><img src='../img/error-404.jpg'></br>" . $errorMessage . "</td></tr>";
            } elseif (count($result) > 0) {
                foreach ($result as $row) {
                    echo "<tr>
                    <td class='weapon-container'>
                        <img src='" . $row['icona'] . "' class='weapon-image'>
                        <span class='weapon-name'>" . $row['nome'] . "</span>
                    </td>
                    <td class='descrizione-eff'>" . $row['descrizione'] . "</td>
                    <td class='mitigatedBy'>" . $row['mitigato_da'] . "</td>
                    <td class='cured_by'>" . $row['curato_da'] . "</td>
                    <td class='fortitude'>" . $row['statistica_resistente'] . "</td>
                    <td class='notes'>" . $row['note'] . "</td>";
                }
            } else {
                echo "<tr><td colspan='10'><img src='../img/error-404.jpg'>No data found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<footer>
    <p>&copy; 2022 Elden Ring. All rights reserved.</p>
</footer>

<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    var images = document.getElementsByClassName('weapon-image');

    for (var i = 0; i < images.length; i++) {
        images[i].onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.nextElementSibling.innerHTML; // Use weapon name as caption
        }
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
</script>

</body>
</html>
