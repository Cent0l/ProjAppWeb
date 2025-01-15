<head>
    <meta charset="UTF-8">
    <meta name="language" content="pl">
    <meta name="author" content="Mateusz Cętkowski">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Moje hobby to simracing</title>
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<?php
session_start();
include('cfg.php');  // Załaduj dane logowania i połączenie z bazą danych
include 'header.php'; // Nagłówek strony
// Jeśli użytkownik jest już zalogowany, przekieruj go do panelu administracyjnego
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: admin.php");
    exit();
}

// Funkcja wyświetlająca formularz logowania
function FormularzLogowania($error = '') {
    echo '<h2>Logowanie</h2>';
    if ($error) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
    echo '
    <form method="POST" class="login-form">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Zaloguj">
    </form>';
}

// Sprawdzenie danych logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_input = $_POST['login'];
    $password_input = $_POST['password'];

    if ($login_input === $admin_login && $password_input === $admin_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login'] = $login_input;
        header("Location: admin.php"); // Przekierowanie po zalogowaniu
        exit();
    } else {
        FormularzLogowania('Błędny login lub hasło!');
        exit();
    }
}

FormularzLogowania(); // Wywołanie funkcji formularza logowania
include 'footer.php'; // stopka
?>
