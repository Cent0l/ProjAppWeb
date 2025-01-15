<?php
session_start(); // Inicjalizacja sesji
require_once 'db_connection.php'; // Plik zawierający połączenie z bazą danych $pdo

// Funkcje zarządzania produktami
function DodajProdukt($title, $description, $expires_at, $net_price, $vat_rate, $stock_quantity, $availability_status, $category_id, $product_size, $image_url) {
    global $pdo;
    $sql = "INSERT INTO products (title, description, expires_at, net_price, vat_rate, stock_quantity, availability_status, category_id, product_size, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $expires_at, $net_price, $vat_rate, $stock_quantity, $availability_status, $category_id, $product_size, $image_url]);
}

function UsunProdukt($id) {
    global $pdo;
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

function EdytujProdukt($id, $title, $description, $expires_at, $net_price, $vat_rate, $stock_quantity, $availability_status, $category_id, $product_size, $image_url) {
    global $pdo;
    $sql = "UPDATE products SET title = ?, description = ?, expires_at = ?, net_price = ?, vat_rate = ?, stock_quantity = ?, availability_status = ?, category_id = ?, product_size = ?, image_url = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $expires_at, $net_price, $vat_rate, $stock_quantity, $availability_status, $category_id, $product_size, $image_url, $id]);
}

function PokazProdukty() {
    global $pdo;
    $sql = "SELECT * FROM products";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ID: " . $row['id'] . " - Title: " . htmlspecialchars($row['title']) . "<br>";
    }
}
?>
