<?php
// Funkcja dodająca produkt do koszyka
function addToCart($product_id, $product_name, $price, $vat, $quantity = 1) {
    $product_key = "product_" . $product_id;

    if (isset($_SESSION['cart'][$product_key])) {
        $_SESSION['cart'][$product_key]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_key] = [
            'name' => $product_name,
            'price' => $price,
            'vat' => $vat,
            'quantity' => $quantity
        ];
    }
}

// Funkcja usuwająca produkt z koszyka
function removeFromCart($product_id) {
    $product_key = "product_" . $product_id;
    if (isset($_SESSION['cart'][$product_key])) {
        unset($_SESSION['cart'][$product_key]); // Usunięcie produktu z koszyka
    }
}

// Funkcja wyświetlająca zawartość koszyka
function showCart() {
    if (empty($_SESSION['cart'])) {
        echo "<p>Koszyk jest pusty.</p>";
        return;
    }

    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Produkt</th><th>Cena netto</th><th>VAT</th><th>Cena brutto</th><th>Ilość</th><th>Usuń</th></tr>";

    $total = 0;

    foreach ($_SESSION['cart'] as $key => $item) {
        $product_id = str_replace('product_', '', $key); // Usunięcie prefiksu
        $brutto = $item['price'] * (1 + $item['vat'] / 100);
        $subtotal = $brutto * $item['quantity'];
        $total += $subtotal;

        echo "<tr>
                <td>" . htmlspecialchars($item['name']) . "</td>
                <td>" . number_format($item['price'], 2) . " PLN</td>
                <td>" . $item['vat'] . "%</td>
                <td>" . number_format($brutto, 2) . " PLN</td>
                <td>" . $item['quantity'] . "</td>
                <td><a href='cart.php?remove=" . $product_id . "'>Usuń</a></td>
              </tr>";
    }

    echo "</table>";
    echo "<p><strong>Łączna wartość koszyka: " . number_format($total, 2) . " PLN</strong></p>";
}
?>
