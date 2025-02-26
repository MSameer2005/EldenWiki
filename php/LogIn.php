<?php
session_start();

require_once __DIR__ . '/lib/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperiamo i dati inviati dal form di login
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepariamo la query SQL per verificare l'utente nel database
    $query = "SELECT * FROM utenti WHERE Email = :email";
    $sql = $conn->prepare($query);
    $sql->execute(array(':email' => $email));
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    $conn = null;

    if ($user && password_verify($password, $user['Password'])) {

        $_SESSION['email'] = $user['Email'];
        $_SESSION['nickname'] = $user['Nickname'];
        $_SESSION['sesso'] = $user['Sesso'];
        $_SESSION['password'] = $user['Password'];
        $_SESSION['profilePicture'] = $user['ProfilePicture'];
        $_SESSION['isAdmin'] = $user['isAdmin'];
        $_SESSION['isLogged'] = true;

        header('Location: Profilo.php');

    } else {
        $_SESSION['error_message'] = "Error: Incorrect email or password";
        header('Location: ../php/Login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Log In</title>
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
            <li><a href="Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <button class="sign-up" onclick="window.location.href='../php/SignUp.php'">Sign Up</button>
        <button class="log-in" onclick="window.location.href='../php/LogIn.php'">Log in</button>
    </div>
</header>

<main class="sfondo">
    <div class="form-container">
        <?php
        if (isset($_SESSION['error_message'])) {
            $errorMessage = $_SESSION['error_message'];
            echo "<script type='text/javascript'>alert('$errorMessage');</script>";
            unset($_SESSION['error_message']); // Cancella il messaggio di errore dopo averlo mostrato
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <label for="email">Email:</label>
            <input id="email" name="email" required type="email">

            <label for="password">Password:</label>
            <input id="password" name="password" required type="password" minlength="8">

            <button type="submit">Log In</button>
        </form>
    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>
</body>
</html>
