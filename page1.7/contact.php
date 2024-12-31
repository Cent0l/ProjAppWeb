<?php
include('cfg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    if (mysqli_stmt_execute($stmt)) {
        echo "Wiadomość została wysłana!";
    } else {
        echo "Błąd: " . mysqli_error($link);
    }
}
?>
<form method="POST">
    <label>Imię:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Wiadomość:</label>
    <textarea name="message" required></textarea><br>
    <button type="submit">Wyślij</button>
</form>
