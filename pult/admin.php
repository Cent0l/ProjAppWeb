<?php
session_start();
include('cfg.php'); // Połączenie z bazą danych

// Dane logowania do panelu admina
$admin_login = 'admin';
$admin_password = 'admin123';

// Funkcja logowania
function FormularzLogowania($error = '') {
    echo '<h2>Logowanie</h2>';
    if ($error) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
    echo '
    <form method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Zaloguj">
    </form>';
}

// Obsługa logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['loggedin'])) {
    global $admin_login, $admin_password;
    $login_input = $_POST['login'];
    $password_input = $_POST['password'];

    if ($login_input === $admin_login && $password_input === $admin_password) {
        $_SESSION['loggedin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        FormularzLogowania('Błędny login lub hasło!');
        exit();
    }
}

// Wylogowanie
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Sprawdzenie sesji
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    FormularzLogowania();
    exit();
}

// Funkcja wyświetlania listy podstron
function ListaPodstron() {
    global $link;
    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($link, $query);

    echo '<h2>Lista Podstron</h2>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['page_title']) . '</td>';
        echo '<td>
            <a href="admin.php?edit_page=' . $row['id'] . '">Edytuj</a> |
            <a href="admin.php?delete_page=' . $row['id'] . '">Usuń</a>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br><a href="admin.php?add_page">Dodaj nową podstronę</a>';
}

function EdytujPodstrone($id) {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $query = "UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssii", $title, $content, $status, $id);
        mysqli_stmt_execute($stmt);

        echo '<p>Podstrona zaktualizowana!</p>';
        return;
    }

    $query = "SELECT * FROM page_list WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    echo '
    <h2>Edytuj Podstronę</h2>
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="' . htmlspecialchars($row['page_title']) . '" required><br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required>' . htmlspecialchars($row['page_content']) . '</textarea><br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status" ' . ($row['status'] ? 'checked' : '') . '><br>
        <input type="submit" value="Zapisz">
    </form>';
}

function DodajNowaPodstrone() {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $status);
        mysqli_stmt_execute($stmt);

        echo '<p>Nowa podstrona została dodana!</p>';
        return;
    }

    echo '
    <h2>Dodaj Nową Podstronę</h2>
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea><br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status"><br>
        <input type="submit" value="Dodaj">
    </form>';
}

function UsunPodstrone($id) {
    global $link;

    $query = "DELETE FROM page_list WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    echo '<p>Podstrona została usunięta!</p>';
}

// Funkcje zarządzania kategoriami
function ListaKategorii() {
    global $link;
    $query = "SELECT id, name FROM categories";
    $result = mysqli_query($link, $query);

    echo '<h2>Lista Kategorii</h2>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nazwa</th><th>Akcje</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>
            <a href="admin.php?edit_category=' . $row['id'] . '">Edytuj</a> |
            <a href="admin.php?delete_category=' . $row['id'] . '">Usuń</a>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br><a href="admin.php?add_category">Dodaj nową kategorię</a>';
}

function EdytujKategorie($id) {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];

        $query = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt);

        echo '<p>Kategoria zaktualizowana!</p>';
        return;
    }

    $query = "SELECT * FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    echo '
    <h2>Edytuj Kategorię</h2>
    <form method="POST">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required><br>
        <input type="submit" value="Zapisz">
    </form>';
}

function DodajNowaKategorie() {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];

        $query = "INSERT INTO categories (name) VALUES (?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        echo '<p>Nowa kategoria została dodana!</p>';
        return;
    }

    echo '
    <h2>Dodaj Nową Kategorię</h2>
    <form method="POST">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" required><br>
        <input type="submit" value="Dodaj">
    </form>';
}

function UsunKategorie($id) {
    global $link;

    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    echo '<p>Kategoria została usunięta!</p>';
}

// Funkcje zarządzania produktami
function ListaProduktow() {
    global $link;
    $query = "SELECT p.id, p.title, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id";
    $result = mysqli_query($link, $query);

    echo '<h2>Lista Produktów</h2>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Kategoria</th><th>Akcje</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
        echo '<td>' . htmlspecialchars($row['category_name']) . '</td>';
        echo '<td>
            <a href="admin.php?edit_product=' . $row['id'] . '">Edytuj</a> |
            <a href="admin.php?delete_product=' . $row['id'] . '">Usuń</a>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br><a href="admin.php?add_product">Dodaj nowy produkt</a>';
}

function EdytujProdukt($id) {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];

        $query = "UPDATE products SET title = ?, description = ?, category_id = ?, price = ?, stock_quantity = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssiiii", $title, $description, $category_id, $price, $stock_quantity, $id);
        mysqli_stmt_execute($stmt);

        echo '<p>Produkt zaktualizowany!</p>';
        return;
    }

    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

echo '
    <h2>Edytuj Produkt</h2>
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="' . htmlspecialchars($row['title']) . '" required><br>
        
        <label for="description">Opis:</label>
        <textarea id="description" name="description" required>' . htmlspecialchars($row['description']) . '</textarea><br>
        
        <label for="net_price">Cena netto:</label>
        <input type="number" step="0.01" id="net_price" name="net_price" value="' . $row['net_price'] . '" required><br>
        
        <label for="vat_rate">Stawka VAT (%):</label>
        <input type="number" step="0.01" id="vat_rate" name="vat_rate" value="' . $row['vat_rate'] . '" required><br>
        
        <label for="stock_quantity">Stan magazynowy:</label>
        <input type="number" id="stock_quantity" name="stock_quantity" value="' . $row['stock_quantity'] . '" required><br>
        
        <label for="availability_status">Status dostępności (1 = dostępny, 0 = niedostępny):</label>
        <input type="number" id="availability_status" name="availability_status" value="' . $row['availability_status'] . '" required><br>
        
        <label for="category_id">ID kategorii:</label>
        <input type="number" id="category_id" name="category_id" value="' . $row['category_id'] . '" required><br>
        
        <label for="product_size">Rozmiar produktu:</label>
        <input type="text" id="product_size" name="product_size" value="' . htmlspecialchars($row['product_size']) . '"><br>
        
        <label for="image_url">URL obrazka:</label>
        <input type="text" id="image_url" name="image_url" value="' . htmlspecialchars($row['image_url']) . '"><br>
        
        <label for="expires_at">Data ważności:</label>
        <input type="date" id="expires_at" name="expires_at" value="' . $row['expires_at'] . '"><br>
        
        <input type="submit" value="Zapisz">
    </form>';

}

function DodajNowyProdukt() {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];

        $query = "INSERT INTO products (title, description, category_id, price, stock_quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssiii", $title, $description, $category_id, $price, $stock_quantity);
        mysqli_stmt_execute($stmt);

        echo '<p>Nowy produkt został dodany!</p>';
        return;
    }

    echo '
    <h2>Dodaj Nowy Produkt</h2>
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Opis:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="category_id">Kategoria:</label>
        <input type="number" id="category_id" name="category_id" required><br>
        <label for="price">Cena:</label>
        <input type="number" id="price" name="price" required><br>
        <label for="stock_quantity">Stan magazynowy:</label>
        <input type="number" id="stock_quantity" name="stock_quantity" required><br>
        <input type="submit" value="Dodaj">
    </form>';
}

function UsunProdukt($id) {
    global $link;

    $query = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    echo '<p>Produkt został usunięty!</p>';
}

// Obsługa akcji
if (isset($_GET['edit_page'])) {
    EdytujPodstrone($_GET['edit_page']);
} elseif (isset($_GET['delete_page'])) {
    UsunPodstrone($_GET['delete_page']);
} elseif (isset($_GET['add_page'])) {
    DodajNowaPodstrone();
} elseif (isset($_GET['edit_category'])) {
    EdytujKategorie($_GET['edit_category']);
} elseif (isset($_GET['delete_category'])) {
    UsunKategorie($_GET['delete_category']);
} elseif (isset($_GET['add_category'])) {
    DodajNowaKategorie();
} elseif (isset($_GET['edit_product'])) {
    EdytujProdukt($_GET['edit_product']);
} elseif (isset($_GET['delete_product'])) {
    UsunProdukt($_GET['delete_product']);
} elseif (isset($_GET['add_product'])) {
    DodajNowyProdukt();
} else {
    ListaPodstron();
    echo '<hr>';
    ListaKategorii();
    echo '<hr>';
    ListaProduktow();
    echo '<br><a href="admin.php?logout">Wyloguj</a>';
}
?>
