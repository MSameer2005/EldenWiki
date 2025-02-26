<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Contact Us</title>
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
            <?php if ($isLogged): ?>
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
            <?php endif; ?>
            <li><a href="Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <?php if ($isLogged): ?>
            <img src="<?php echo "../" . $_SESSION['profilePicture']; ?>" alt="Profilo" width="60px"
                 style="border-radius: 50%"
                 onclick="window.location.href='../php/Profilo.php'">
        <?php else: ?>
            <button class="sign-up" onclick="window.location.href='../php/SignUp.php'">Sign Up</button>
            <button class="log-in" onclick="window.location.href='../php/LogIn.php'">Log in</button>
        <?php endif; ?>
    </div>
</header>

<main class="sfondo">
    <section class="contenuto">
        <!-- Sezione con i dettagli di contatto -->
        <div class="contact-info">
            <h3 align="center">Contact Us</h3>
            <p align="center">Shouldst thou seek any counsel or information, hesitate not to contact us using the
                following details:</p>
            <h4 align="center">The Details of Contact:</h4>
            <ul>
                <li><strong>Name of the Entity:</strong> Muhammad Sameer Ali</li>
                <li><strong>Email:</strong> <a href="mailto:info@eldenring.com">info@eldenring.com</a></li>
                <li><strong>The Address:</strong> Via Carso, 10 - 21047 Saronno, Italia</li>
                <li><strong>The Telephone:</strong> +39 123 456 789</li>
            </ul>
        </div>
    </section>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>

</body>
</html>