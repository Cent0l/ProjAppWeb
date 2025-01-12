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

// Funkcje zarządzania podstronami
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
    // Dodaj tutaj kod edycji podstrony
}

function DodajNowaPodstrone() {
    // Dodaj tutaj kod dodawania nowej podstrony
}

function UsunPodstrone($id) {
    // Dodaj tutaj kod usuwania podstrony
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
    // Dodaj tutaj kod edycji kategorii
}

function DodajNowaKategorie() {
    // Dodaj tutaj kod dodawania nowej kategorii
}

function UsunKategorie($id) {
    // Dodaj tutaj kod usuwania kategorii
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
    // Dodaj tutaj kod edycji produktu
}

function DodajNowyProdukt() {
    // Dodaj tutaj kod dodawania nowego produktu
}

function UsunProdukt($id) {
    // Dodaj tutaj kod usuwania produktu
}

// Obsługa akcji dla podstron, kategorii i produktów
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

