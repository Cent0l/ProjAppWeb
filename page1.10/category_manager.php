<?php
session_start(); // Inicjalizacja sesji
// Połączenie z bazą danych
$pdo = new PDO('mysql:host=your_host;dbname=your_db_name', 'username', 'password');

// Funkcje zarządzania kategoriami
function DodajKategorie($name, $parent_id = 0) {
    global $pdo;
    $sql = "INSERT INTO categories (name, parent_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $parent_id]);
}

function UsunKategorie($id) {
    global $pdo;
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

function EdytujKategorie($id, $name, $parent_id) {
    global $pdo;
    $sql = "UPDATE categories SET name = ?, parent_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $parent_id, $id]);
}

function PokazKategorie($parent_id = 0, $level = 0) {
    global $pdo;
    $sql = "SELECT id, name FROM categories WHERE parent_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$parent_id]);
    while ($row = $stmt->fetch()) {
        echo str_repeat("&nbsp;", $level * 4) . htmlspecialchars($row['name']) . "<br>";
        PokazKategorie($row['id'], $level + 1);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                DodajKategorie($_POST['name'], $_POST['parent_id']);
                break;
            case 'delete':
                UsunKategorie($_POST['id']);
                break;
            case 'edit':
                EdytujKategorie($_POST['id'], $_POST['name'], $_POST['parent_id']);
                break;
        }
    }
    // Przekierowanie na tę samą stronę, aby uniknąć ponownego wysłania formularza przy odświeżeniu
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>
