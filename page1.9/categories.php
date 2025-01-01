<?php
include('cfg.php');

// Funkcja do wyświetlania kategorii i podkategorii
function PokazKategorie($parent_id = 0, $level = 0) {
    global $link;

    $query = "SELECT * FROM categories WHERE parent_id = ? ORDER BY name";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $parent_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        echo str_repeat('--', $level) . $row['name'] . '<br>';
        PokazKategorie($row['id'], $level + 1); // Rekurencja dla podkategorii
    }
}

// Funkcja do dodawania kategorii
function DodajKategorie($parent_id, $name) {
    global $link;

    $query = "INSERT INTO categories (parent_id, name) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "is", $parent_id, $name);
    mysqli_stmt_execute($stmt);

    echo 'Kategoria dodana!';
}

// Funkcja do edytowania kategorii
function EdytujKategorie($id, $name) {
    global $link;

    $query = "UPDATE categories SET name = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "si", $name, $id);
    mysqli_stmt_execute($stmt);

    echo 'Kategoria zaktualizowana!';
}

// Funkcja do usuwania kategorii
function UsunKategorie($id) {
    global $link;

    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    echo 'Kategoria usunięta!';
}
?>
