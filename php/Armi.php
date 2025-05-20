<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}

include __DIR__ . '/lib/fetchOptions.php';
require_once __DIR__ . '/lib/config.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

try {
    if (isset($_SESSION['search'])) {
        if (is_array($_SESSION['search'])) {
            $result = $_SESSION['search'];
        } else {
            $errorMessage = $_SESSION['search'];
        }
        unset($_SESSION['search']);
    } else {
        // Query SQL con LIMIT e OFFSET
        $sql = "
        SELECT *
        FROM ViewArmi
        ORDER BY id
        LIMIT :limit
        OFFSET :offset
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':limit', $records_per_page, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query per ottenere il numero totale di record
        $sql_count = "SELECT COUNT(*) FROM ViewArmi";
        $stmt_count = $conn->prepare($sql_count);
        $stmt_count->execute();
        $total_records = $stmt_count->fetchColumn();

        $conn = null;
    }

} catch (PDOException $e) {
    // In caso di errore, visualizziamo un messaggio d'errore
    die("Connection failed: " . $e->getMessage());
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

<main class="sfondo"><h1 align="center" class="titolo" style="padding-top: 1.5%;">Armi</h1>

    <div class="contenitoreFiltro">
        <?php if ($_SESSION['isAdmin']): ?>
            <button id="deleteFilter"><a href="admin/addArma.php">Add Weapon</a></button>
            <button id="deleteFilter"><a href="admin/changeArma.php">Update Weapon</a></button>
            <button id="deleteFilter"><a href="admin/deleteArma.php">Delete Weapon</a></button>
            <br>
        <?php endif; ?>
        <button id="openFormButton">Filter</button>
        <button id="deleteFilter" onclick="window.location.href='lib/eliminaSearch.php'">Remove Filter</button>
    </div>

    <div id="sideForm" class="side-form">
        <span id="closeFormButton" class="close-btn">&times;</span>
        <div class="search-container">
            <form action="lib/Search.php" method="post">
                <input type="hidden" name="hiddenVariable" value="Armi">
                <label for="search">Name:</label>
                <input type="search" placeholder="Search.." name="search">
                <label for="categoria">Weapons Types:</label>
                <select id="categoria" name="categoria">
                    <option value="">ALL</option>
                    <?php echo generateOptions("Categorie") ?>
                </select>
                <label for="attacco">Attack:</label>
                <input id="attacco" name="attacco" type="number" min="0" step="1">
                <label for="effetto-passivo">Passive:</label>
                <select id="effetto-passivo" name="effetto-passivo">
                    <option value="-">-</option>
                    <?php echo generateOptions("Effetti") ?>
                </select>
                <button type="submit"><img src="../img/Icon/SearchBar.png" class="fa fa-search" width="30px"></button>
            </form>
        </div>
    </div>

    <script src="../js/sideForm.js"></script>

    <div class="weapons-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; padding: 20px;">
        <?php
        if (isset($errorMessage)) {
            echo "<div class='error-message'><img src='../img/error-404.jpg'><br>" . $errorMessage . "</div>";
        } elseif (count($result) > 0) {
            foreach ($result as $row) {
                echo "<div class='weapon-card' style='background-color: rgba(0, 0, 0, 0.7); border-radius: 10px; padding: 15px; text-align: center; cursor: pointer;' onclick='window.location.href=\"weapon_details.php?id=" . $row['id'] . "\"'>
                        <img src='" . $row['immagine'] . "' class='weapon-image' style='width: 100%; height: auto; border-radius: 5px;'>
                        <h3 style='color: #fff; margin: 10px 0;'>" . $row['nome_arma'] . "</h3>
                        <p style='color: #ccc;'>" . $row['categoria'] . "</p>
                    </div>";
            }
        } else {
            echo "<div class='error-message'><img src='../img/error-404.jpg'><br>No data found.</div>";
        }
        ?>
    </div>

    <div class="pagination">
        <?php
        if (isset($total_records)) {
            $total_pages = ceil($total_records / $records_per_page);
            $page_range = 5; // Numero massimo di numeri di pagina da mostrare
            $start_page = max(1, $page - floor($page_range / 2));
            $end_page = min($total_pages, $start_page + $page_range - 1);

            if ($end_page - $start_page + 1 < $page_range) {
                $start_page = max(1, $end_page - $page_range + 1);
            }

            // Pulsante per la prima pagina
            if ($page > 1) {
                echo "<a href='Armi.php?page=1'>&laquo; First</a> ";
            }

            // Pagine numerate
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $page) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='Armi.php?page=$i'>$i</a> ";
                }
            }

            // Pulsante per l'ultima pagina
            if ($page < $total_pages) {
                echo "<a href='Armi.php?page=$total_pages'>Last &raquo;</a>";
            }
        }
        ?>
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
