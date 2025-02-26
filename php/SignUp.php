<?php
session_start();

require_once __DIR__ . '/lib/config.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recuperiamo i dati inviati dal form di registrazione
        $email = trim($_POST['email']);
        $nickname = trim($_POST['nickname']);
        $sesso = $_POST['sesso'];
        $password = trim($_POST['password']);
        $profilePicture = "/img/Profile.png";
        $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
        $dataRegistrazione = date('Y-m-d');  // Formato YYYY-MM-DD

        // Controlliamo se l'email è già registrata
        $query = "SELECT * FROM utenti WHERE Email = :email";
        $sql = $conn->prepare($query);
        $sql->execute(array(':email' => $email));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['error_message'] = "Error: the user with this email is already registered.";
            header('Location: SignUp.php');
            exit();
        } else {

            // Proteggiamo la password criptandola con un algoritmo sicuro
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepariamo la query SQL per inserire un nuovo utente nel database
            $query = "INSERT INTO utenti (Email, Nickname, Sesso, Password, ProfilePicture, isAdmin, dataRegistrazione) 
                VALUES (:email, :nickname, :sesso, :password, :profilePicture, :isAdmin, :dataRegistrazione)";

            // Prepariamo la query per prevenire attacchi di SQL injection
            $sql = $conn->prepare($query);

            // Eseguiamo la query, sostituendo i placeholder con i valori reali
            $sql->execute(array(':email' => $email,
                ':nickname' => $nickname,
                ':sesso' => $sesso,
                ':password' => $hashedPassword,
                ':profilePicture' => $profilePicture,
                ':isAdmin' => $isAdmin,
                ':dataRegistrazione' => $dataRegistrazione
            ));

            $conn = null;

            $_SESSION['error_message'] = "User registered successfully. Please log in.";
            header('Location: ../php/LogIn.php');
            exit();
        }
    }

} catch (PDOException $e) {
    echo "An error occurred while connecting to the database: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Sign Up</title>
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
            <label for="nickname">Nickname:</label>
            <input id="nickname" name="nickname" required type="text">

            <div class="gender-container">
                <label>Sex:</label><br>
                <input id="Maschio" name="sesso" required type="radio" value="M">
                <label for="Maschio">Male</label>
                <input id="Femmina" name="sesso" required type="radio" value="F">
                <label for="Femmina">Female</label>
            </div>

            <label for="email">Email:</label>
            <input id="email" name="email" required type="email">

            <label for="password">Password:</label>
            <input id="password" name="password" required type="password" minlength="8">

            <label for="isAdmin">Is Admin</label>
            <input id="isAdmin" name="isAdmin" type="checkbox">

            <button type="submit">Sign Up</button>
        </form>
    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>
</body>

</html>