<?php
include('cfg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (login, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "sss", $login, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "Rejestracja zakończona sukcesem!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}
?>
<form method="POST">
    <label>Login:</label>
    <input type="text" name="login" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Hasło:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Zarejestruj</button>
</form>
