<?php
session_start(); // Inicjalizacja sesji
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'moja_strona';

// Dane logowania do panelu admina
$admin_login = 'admin';
$admin_password = 'admin123';

// Połączenie z bazą danych
$link = mysqli_connect($host, $user, $pass, $dbname);

if (!$link) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
?>
