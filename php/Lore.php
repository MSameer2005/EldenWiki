<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Elden Ring - Lore</title>
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
    <section class="lore-lista">
        <h2 class="titolo">Lore</h2>
        <ul>
            <li>
                <span class="icon"></span>
                <h2>Story</h2>
                <p>
                    Long ago, in The Lands Between, Queen Marika became a vessel for the Elden Ring. And so, in the name
                    of the Erdtree, Marika conquered the Lands with the aid of her husband Godfrey — a mighty warrior
                    and first Elden Lord — who fought alongside his warriors in the name of the Queen until his very
                    last worthy enemy was defeated and Marika's reign was absolute.<br>
                    <br>
                    Marika removed the Rune of Death from the Elden Ring and commanded her loyal shadow, Maliketh, to
                    seal it away. Thus, she and everyone blessed by her Grace would live forever, granting her the title
                    of Queen Marika the Eternal. However, this very same Grace was taken away from Godfrey and his army,
                    whom she instructed to wage war and die abroad, with the promise that life and Grace would be
                    returned to them when needed.<br>
                    <br>
                    All those who were stripped of their Grace, as well as their descendants, became known as the
                    Tarnished. True to Marika's promise, their Grace was returned to them after their deaths, and they
                    were called back to the Lands Between to repair the shattered Elden Ring.<br>
                    <br>
                    Will the new Tarnished heed the call, or perish and be forgotten?
                </p>
            </li>
            <li>
                <span class="icon"></span>
                <h2>Shadow of the Erdtree</h2>
                <p>
                    Long ago, Queen Marika ordered a mass purging of the Realm of Shadow, a land now obscured by the
                    Erdtree, and its inhabitants fell before Messmer's flame. Now, the Empyrean Miquella has journeyed
                    into these forsaken lands, a cadre of loyal followers in tow. The Tarnished, urged on by a
                    mysterious knightess, enters the Realm of Shadow and picks up the young Demigod's trail, all the
                    while uncovering the lost history of the Realm of Shadow.
                </p>
            </li>
            <h2>Continue...</h2>
            </li>
        </ul>
    </section>
</main>
<footer class="sfondo">
    <p>&copy; 2024 Elden Ring. Tutti i diritti riservati.</p>
</footer>
</body>

</html>