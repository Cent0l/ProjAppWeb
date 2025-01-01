<?php
include('cfg.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login'] = $user['login'];
        echo "Logowanie zakończone sukcesem!";
    } else {
        echo "Nieprawidłowy login lub hasło!";
    }
}
?>
<form method="POST">
    <label>Login:</label>
    <input type="text" name="login" required><br>
    <label>Hasło:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Zaloguj</button>
</form>
