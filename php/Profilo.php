<?php
SESSION_START();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header("Location: LogIn.php");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Profilo Utente</title>
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
                    <a href="Armature.php">Armor</a>
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
    <div class="profile-container">

        <?php
        if ($_SESSION['isLogged']) {
            // Mostra i dettagli del profilo
            echo "<div class='profile'>
                            <img src='../" . $_SESSION['profilePicture'] . "' alt='Immagine profilo' class='profile-image'>
                            <div class='profile-details'>
                                <h2>Profilo Utente</h2>
                                <p><strong>Nickname:</strong> " . $_SESSION['nickname'] . "</p>
                                <p><strong>Email:</strong> " . $_SESSION['email'] . "</p>
                                <!--<button>Cambia Password</button>-->
                            </div>
                                <form action='../php/lib/Logout.php' method='post'>
                                    <button class='profile-buttons' type='submit'>Log out</button>
                                </form>
                        </div>";
        } else {
            $_SESSION['error_message'] = "Errore: Email o Password sbagliata";
            header('Location: ../php/Login.php');
            exit();
        }

        ?>

    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>
</body>
</html>
