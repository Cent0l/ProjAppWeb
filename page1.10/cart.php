<?php
session_start(); // Inicjalizacja sesji
require 'cart_functions.php'; // Funkcje koszyka
include 'header.php'; // Nagłówek strony

echo "<h1>Twój koszyk</h1>";

// Obsługa usuwania produktu z koszyka
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']); // Pobranie ID produktu z URL
    removeFromCart($product_id);
    echo "<p>Produkt został usunięty z koszyka.</p>";
}

showCart(); // Wyświetlenie zawartości koszyka

include 'footer.php'; // Stopka strony
?>
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