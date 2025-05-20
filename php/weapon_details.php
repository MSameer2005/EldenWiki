<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}

require_once __DIR__ . '/lib/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $sql = "SELECT * FROM ViewArmi WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $weapon = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$weapon) {
        header('Location: Armi.php');
        exit();
    }

    $attacco = explode(',', $weapon['attacco']);
    $difesa = explode(',', $weapon['difesa']);
    $scaling = explode(',', $weapon['scaling']);
    $requisiti = explode(',', $weapon['requisiti']);
    $effetto_passivo = explode('<br>', $weapon['effetto_passivo']);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title><?php echo $weapon['nome_arma']; ?> - Elden Wiki</title>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="myVideo">
    <video autoplay class="myVideo" loop muted>
        <source src="../img/EldenRing.mp4" type="video/mp4">
    </video>
</div>

<header class="sfondo" style="background-color: rgba(0, 0, 0, 0.8); padding: 15px 0; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);">
    <a href="Home.php" style="text-decoration: none;"><h1 style="color: #D4AF37; margin: 0; font-size: 32px;">Elden Wiki</h1></a>
    <div class="menu" style="display: flex; justify-content: center; margin-top: 10px;">
        <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
            <li style="margin: 0 15px;"><a href="Home.php" style="color: #fff; text-decoration: none; font-size: 18px; transition: color 0.3s;">Home</a></li>
            <li style="margin: 0 15px;"><a href="Lore.php" style="color: #fff; text-decoration: none; font-size: 18px; transition: color 0.3s;">Lore</a></li>
            <li style="margin: 0 15px;"><a href="Walkthrough.php" style="color: #fff; text-decoration: none; font-size: 18px; transition: color 0.3s;">Walkthrough</a></li>
            <div class="dropdown" style="position: relative; display: inline-block;">
                <li class="dropbtn" style="margin: 0 15px; color: #fff; font-size: 18px; cursor: pointer;">Equipment</li>
                <div class="dropdown-content" style="display: none; position: absolute; background-color: rgba(0, 0, 0, 0.9); min-width: 160px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); z-index: 1;">
                    <a href="Armi.php" style="color: #fff; padding: 12px 16px; text-decoration: none; display: block; transition: background-color 0.3s;">Weapons</a>
                    <a href="Armature.php" style="color: #fff; padding: 12px 16px; text-decoration: none; display: block; transition: background-color 0.3s;">Armors</a>
                    <a href="Incantesimi.php" style="color: #fff; padding: 12px 16px; text-decoration: none; display: block; transition: background-color 0.3s;">Incantations</a>
                    <a href="Stregonerie.php" style="color: #fff; padding: 12px 16px; text-decoration: none; display: block; transition: background-color 0.3s;">Sorcery</a>
                    <a href="CeneriDiGuerra.php" style="color: #fff; padding: 12px 16px; text-decoration: none; display: block; transition: background-color 0.3s;">Ashes of War</a>
                </div>
            </div>
            <li style="margin: 0 15px;"><a href="EffettiStato.php" style="color: #fff; text-decoration: none; font-size: 18px; transition: color 0.3s;">Status Effects</a></li>
            <li style="margin: 0 15px;"><a href="Contacts.php" style="color: #fff; text-decoration: none; font-size: 18px; transition: color 0.3s;">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons" style="position: absolute; top: 15px; right: 20px;">
        <img alt="Profile" onclick="window.location.href='Profilo.php'" src="<?php echo "../" . $_SESSION['profilePicture']; ?>" style="border-radius: 50%; width: 60px; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
    </div>
</header>

<main class="sfondo">
    <div class="weapon-details" style="max-width: 800px; margin: 0 auto; padding: 20px; background-color: rgba(0, 0, 0, 0.7); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
        <h1 style="color: #fff; text-align: center; margin-bottom: 20px; font-size: 28px;"><?php echo $weapon['nome_arma']; ?></h1>
        <img src="<?php echo $weapon['immagine']; ?>" alt="<?php echo $weapon['nome_arma']; ?>" style="width: 50%; height: auto; border-radius: 5px; margin: 0 auto 20px; display: block;">
        <div style="color: #fff; font-size: 16px; line-height: 1.6;">
            <p><strong>Category:</strong> <span style="color: #D4AF37;"><?php echo $weapon['categoria']; ?></span></p>
            <p><strong>Description:</strong> <span style="color: #ccc;"><?php echo $weapon['descrizione']; ?></span></p>
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; color: #ccc;">
                <tr>
                    <th style="border: 1px solid #D4AF37; padding: 10px; text-align: left;">Attack</th>
                    <th style="border: 1px solid #D4AF37; padding: 10px; text-align: left;">Defense</th>
                    <th style="border: 1px solid #D4AF37; padding: 10px; text-align: left;">Scaling</th>
                    <th style="border: 1px solid #D4AF37; padding: 10px; text-align: left;">Requirements</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #D4AF37; padding: 10px;">
                        <?php foreach ($attacco as $a) echo "$a<br>"; ?>
                    </td>
                    <td style="border: 1px solid #D4AF37; padding: 10px;">
                        <?php foreach ($difesa as $d) echo "$d<br>"; ?>
                    </td>
                    <td style="border: 1px solid #D4AF37; padding: 10px;">
                        <?php foreach ($scaling as $s) echo "$s<br>"; ?>
                    </td>
                    <td style="border: 1px solid #D4AF37; padding: 10px;">
                        <?php foreach ($requisiti as $r) echo "$r<br>"; ?>
                    </td>
                </tr>
            </table>
            <p><strong>Weight:</strong> <span style="color: #ccc;"><?php echo $weapon['peso']; ?></span></p>
            <?php if (count($effetto_passivo) >= 2): ?>
                <p><strong>Passive Effect:</strong></p>
                <img src="<?php echo $effetto_passivo[0]; ?>" alt="Passive Effect" style="width: 50px; height: 50px; margin: 10px 0;">
                <p style="color: #ccc;"><?php echo $effetto_passivo[1]; ?></p>
            <?php endif; ?>
            <p><strong>How to Obtain:</strong> <span style="color: #ccc;"><?php echo $weapon['ottenimento']; ?></span></p>
        </div>
        <button onclick="window.location.href='Armi.php'" style="padding: 12px; background-color: #D4AF37; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 20px;">Back to List</button>
    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>
</body>
</html> 