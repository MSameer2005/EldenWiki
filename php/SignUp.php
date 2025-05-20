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
        <h1>Sign Up</h1>
        <?php
        if (isset($_SESSION['error_message'])) {
            $errorMessage = $_SESSION['error_message'];
            echo "<script type='text/javascript'>alert('$errorMessage');</script>";
            unset($_SESSION['error_message']); // Cancella il messaggio di errore dopo averlo mostrato
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nickname">Nickname:</label>
                <input type="text" id="nickname" name="nickname" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <i class="toggle-password" onclick="togglePassword('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </i>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <div class="password-container">
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <i class="toggle-password" onclick="togglePassword('confirm_password')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </i>
                </div>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="isAdmin" name="isAdmin">
                <label for="isAdmin">Admin</label>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="LogIn.php">Login</a></p>
    </div>
</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights herein are reserved.</p>
</footer>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
}

document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
    }
});
</script>
</body>

</html>