<?php
session_start(); // Rozpoczęcie sesji
include('cfg.php'); // Łączenie z bazą danych

// Funkcja logowania
function FormularzLogowania() {
    echo '
    <form method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        <br>
        <label for="pass">Hasło:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <input type="submit" value="Zaloguj">
    </form>';
}

// Funkcja wyświetlająca listę podstron
function ListaPodstron() {
    global $link;
    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($link, $query);

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
}

// Funkcja edytowania podstrony
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
        echo "Podstrona zaktualizowana!";
    }

    $query = "SELECT * FROM page_list WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    echo '
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="' . $row['page_title'] . '" required>
        <br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required>' . $row['page_content'] . '</textarea>
        <br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status" ' . ($row['status'] ? 'checked' : '') . '>
        <br>
        <input type="submit" value="Zapisz zmiany">
    </form>';
}

// Funkcja dodawania nowej podstrony
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
        echo "Nowa podstrona została dodana!";
    }

    echo '
    <form method="POST">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status">
        <br>
        <input type="submit" value="Dodaj podstronę">
    </form>';
}

// Funkcja usuwania podstrony
function UsunPodstrone($id) {
    global $link;

    $query = "DELETE FROM page_list WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    echo "Podstrona została usunięta!";
}

// Obsługa logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['loggedin'])) {
    include('cfg.php');
    $login_input = $_POST['login'];
    $pass_input = $_POST['pass'];

    if ($login_input === 'admin' && $pass_input === 'admin123') { // Zmień na odpowiednie dane logowania
        $_SESSION['loggedin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo 'Błędny login lub hasło!';
        FormularzLogowania();
        exit();
    }
}

// Sprawdzenie sesji
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    FormularzLogowania();
    exit();
}

// Obsługa akcji w panelu administracyjnym
if (isset($_GET['edit'])) {
    EdytujPodstrone($_GET['edit']);
} elseif (isset($_GET['delete'])) {
    UsunPodstrone($_GET['delete']);
} elseif (isset($_GET['add'])) {
    DodajNowaPodstrone();
} else {
    ListaPodstron();
    echo '<br><a href="admin.php?add">Dodaj nową podstronę</a>';
}
?>
