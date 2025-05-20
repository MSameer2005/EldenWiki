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
    <link href="../css/Profilo.css" rel="stylesheet">
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
             class="profile-icon"
             width="60px">
    </div>
</header>

<main class="sfondo">
    <div class="profile-container">
        <div class="profile-image">
            <img src="<?php echo "../" . $_SESSION['profilePicture']; ?>" alt="Profile Picture">
        </div>
        <div class="profile-details">
            <h2><?php echo $_SESSION['nickname']; ?></h2>
            <p><?php echo $_SESSION['email']; ?></p>
            <p>Role: <?php echo $_SESSION['isAdmin'] ? 'Admin' : 'User'; ?></p>
        </div>
        <button onclick="window.location.href='lib/LogOut.php'">Logout</button>
    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>
</body>
</html>
