<?php
session_start(); // Inicjalizacja sesji
require 'db_connection.php'; // Połączenie z bazą danych
require 'cart_functions.php'; // Funkcje koszyka
include 'header.php'; // Nagłówek strony

// Pobranie identyfikatora podstrony z parametru GET
$idp = isset($_GET['idp']) ? $_GET['idp'] : 'home';

// Pobranie informacji o podstronie na podstawie aliasu lub ID
$query = is_numeric($idp) 
    ? "SELECT * FROM page_list WHERE id = $idp AND status = 1" 
    : "SELECT * FROM page_list WHERE alias = '$idp' AND status = 1";
$result = $mysqli->query($query);

// Sprawdzenie, czy podstrona istnieje
if ($row = $result->fetch_assoc()) {
    echo "<main>";
    echo "<h1>" . htmlspecialchars($row['page_title']) . "</h1>";
    echo "<div>" . htmlspecialchars_decode($row['page_content']) . "</div>";

    // Specjalna obsługa dla podstrony sklepu
    if ($row['alias'] == 'sklep') {
        // Obsługa dodawania do koszyka
        if (isset($_POST['add_to_cart'])) {
            $product_id = intval($_POST['product_id']);
            $product_name = $_POST['product_name'];
            $price = floatval($_POST['price']);
            $vat = intval($_POST['vat']);
            $quantity = intval($_POST['quantity']);

            addToCart($product_id, $product_name, $price, $vat, $quantity);
            echo "<p>Produkt został dodany do koszyka.</p>";
        }

        // Pobranie i wyświetlenie dostępnych produktów
        $product_query = "SELECT * FROM products WHERE availability_status = 1";
        $products = $mysqli->query($product_query);

        if ($products->num_rows > 0) {
            echo "<div class='products-container'>";
            while ($product = $products->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>" . htmlspecialchars($product['title']) . "</h2>";
                echo "<p>" . htmlspecialchars($product['description']) . "</p>";
                echo "<p>Cena netto: " . number_format($product['net_price'], 2) . " PLN</p>";
                echo "<p>VAT: " . $product['vat_rate'] . "%</p>";
                echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['title']) . "' style='width:200px;'>";

                // Formularz dodawania do koszyka
                echo "<form method='POST' action='index.php?idp=sklep'>
                        <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                        <input type='hidden' name='product_name' value='" . htmlspecialchars($product['title']) . "'>
                        <input type='hidden' name='price' value='" . $product['net_price'] . "'>
                        <input type='hidden' name='vat' value='" . $product['vat_rate'] . "'>
                        <label for='quantity'>Ilość:</label>
                        <input type='number' name='quantity' value='1' min='1'>
                        <input type='submit' name='add_to_cart' value='Dodaj do koszyka'>
                      </form>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Brak dostępnych produktów.</p>";
        }
    }

    echo "</main>";
} else {
    echo "<main><h2>Strona nie znaleziona.</h2></main>";
}

include 'footer.php'; // Stopka strony
$mysqli->close();
?>
