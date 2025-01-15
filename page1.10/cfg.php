<?php


// Parametry połączenia z bazą danych
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'moja_strona';

// Dane logowania do panelu admina
$admin_login = 'admin';
$admin_password = 'admin123';

// Połączenie z bazą danych
$link = mysqli_connect($host, $user, $pass, $dbname);

// Sprawdzanie połączenia z bazą danych
if (!$link) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Ustawienie zmiennych sesji w celu zarządzania logowaniem
function login($login, $password) {
    global $admin_login, $admin_password;

    if ($login === $admin_login && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login'] = $login;
    } else {
        $_SESSION['loggedin'] = false;
        $_SESSION['login'] = '';
    }
}

// Funkcja do sprawdzenia, czy użytkownik jest zalogowany
function checkLogin() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Funkcja do wylogowania użytkownika
function logout() {
    session_unset();
    session_destroy();
}
?>
