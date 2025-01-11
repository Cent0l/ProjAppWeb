<?php
session_start(); // Inicjalizacja sesji
require 'db_connection.php';  // Wczytanie połączenia z bazą danych

$query = "SELECT * FROM products";  // Zapytanie o wszystkie produkty
$result = mysql_query($query);

if (!$result) {
    die('Błąd zapytania: ' . mysql_error());
}

echo "<h1>Lista produktów</h1>";
echo "<ul>";
while ($row = mysql_fetch_assoc($result)) {
    echo "<li>" . htmlspecialchars($row['title']) . " - " . htmlspecialchars($row['description']) . " - Cena: " . htmlspecialchars($row['net_price']) . " PLN</li>";
}
echo "</ul>";

mysql_free_result($result);
mysql_close($link);
?>
