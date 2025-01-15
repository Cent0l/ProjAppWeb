<?php
session_start(); // Inicjalizacja sesji
require 'db_connection.php'; // Połączenie z bazą danych
include 'header.php'; // Nagłówek strony

echo "<h1>Sklep</h1>";

// Sprawdzenie, czy użytkownik wybrał kategorię
if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);
    var_dump($category_id); // Tymczasowe debugowanie

    // Pobranie nazwy kategorii
    $category_query = "SELECT name FROM categories WHERE id = ?";
    $stmt = $mysqli->prepare($category_query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $category_result = $stmt->get_result();

    if ($category_row = $category_result->fetch_assoc()) {
        echo "<h2>Kategoria: " . htmlspecialchars($category_row['name']) . "</h2>";

        // Pobranie produktów z wybranej kategorii
        $product_query = "SELECT * FROM products WHERE category_id = ? AND availability_status = 1";
        $stmt = $mysqli->prepare($product_query);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $products = $stmt->get_result();

        if ($products->num_rows > 0) {
            echo "<div class='products-container'>";
            while ($product = $products->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h3>" . htmlspecialchars($product['title']) . "</h3>";
                echo "<p>" . htmlspecialchars($product['description']) . "</p>";
                echo "<p>Cena netto: " . number_format($product['net_price'], 2) . " PLN</p>";
                echo "<p>VAT: " . $product['vat_rate'] . "%</p>";
                echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['title']) . "' style='width:200px;'>";

                // Formularz dodawania do koszyka
                echo "<form method='POST' action='cart.php'>
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
            echo "<p>Brak produktów w tej kategorii.</p>";
        }
    } else {
        echo "<p>Nie znaleziono takiej kategorii.</p>";
    }
} else {
    // Wyświetlenie listy kategorii, jeśli nie wybrano kategorii
    $categories_query = "SELECT * FROM categories";
    $categories_result = $mysqli->query($categories_query);

    if ($categories_result->num_rows > 0) {
        echo "<h2>Wybierz kategorię:</h2>";
        echo "<ul class='categories'>";
        while ($category = $categories_result->fetch_assoc()) {
            echo "<li><a href='store.php?category_id=" . $category['id'] . "'>" . htmlspecialchars($category['name']) . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Brak dostępnych kategorii.</p>";
    }
}

include 'footer.php'; // Stopka strony
$mysqli->close();
?>
