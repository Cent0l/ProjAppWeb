<?php
session_start();
include('../cfg.php'); // Połączenie z bazą danych

// Metoda logowania
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
    header("Location: admin.php");
    exit();
}

// Sprawdzenie sesji
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    FormularzLogowania();
    exit();
}

// Wyświetlenie listy podstron
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
        echo '<td>' . $row['page_title'] . '</td>';
        echo '<td>
            <a href="admin.php?edit=' . $row['id'] . '">Edytuj</a> |
            <a href="admin.php?delete=' . $row['id'] . '">Usuń</a>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br><a href="admin.php?add">Dodaj nową podstronę</a>';
}

// Edycja podstrony
function EdytujPodstrone($id) {
    global $link;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST['status']) ? 1 : 0;

        $query = "UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssii", $title, $content, $status, $id);
        mysqli_stmt_execute($stmt);
        echo '<p>Podstrona zaktualizowana!</p>';
    }

    $query = "SELECT * FROM page_list WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    echo '
    <h2>Edytuj Podstronę</h2>
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="' . $row['page_title'] . '" required><br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required>' . $row['page_content'] . '</textarea><br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status" ' . ($row['status'] ? 'checked' : '') . '><br>
        <input type="submit" value="Zapisz">
    </form>';
}

// Dodawanie nowej podstrony
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

// Usuwanie podstrony
function UsunPodstrone($id) {
    global $link;

    $query = "DELETE FROM page_list WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    echo '<p>Podstrona została usunięta!</p>';
}

// Obsługa akcji
if (isset($_GET['edit'])) {
    EdytujPodstrone($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    UsunPodstrone($_GET['delete']);
} elseif (isset($_GET['add'])) {
    DodajNowaPodstrone();
} else {
    ListaPodstron();
    echo '<br><a href="admin.php?logout">Wyloguj</a>';
}
?>
