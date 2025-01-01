<?php
include('cfg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32));

    $query = "INSERT INTO password_resets (email, token) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $token);

    if (mysqli_stmt_execute($stmt)) {
        echo "Link do resetowania hasła został wysłany na email!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}
?>
<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <button type="submit">Resetuj hasło</button>
</form>
