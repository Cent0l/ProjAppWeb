<?php

$host = 'localhost';       // Adres serwera MySQL
$username = 'root';        // Nazwa użytkownika MySQL
$password = '';            // Hasło do MySQL (zostaw puste, jeśli nie ustawiłeś hasła)
$database = 'moja_strona'; // Nazwa istniejącej bazy danych

// Tworzenie połączenia
$mysqli = new mysqli($host, $username, $password, $database);

// Sprawdzenie połączenia
if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}

// Ustawienie kodowania znaków na utf8
$mysqli->set_charset("utf8");

// echo "Połączono z bazą danych!";
?>
