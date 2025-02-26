<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Armors</title>
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
        <img src="<?php echo "../" . $_SESSION['profilePicture']; ?>" alt="Profilo" width="60px"
             style="border-radius: 50%"
             onclick="window.location.href='Profilo.php'">
    </div>
</header>

<main class="sfondo"><h1 align="center" class="titolo" style="padding-top: 1.5%;">Sorceries</h1>
    <img src="../img/error-404.jpg" alt="404" align="center" style="margin-left: 40%">
</main>

<footer>
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>

</body>
</html>