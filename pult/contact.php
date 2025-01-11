<?php
session_start(); // Inicjalizacja sesji
function PokazKontakt() {
    echo '<form action="contact.php" method="post">
        <label for="name">Imię:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Wiadomość:</label><br>
        <textarea id="message" name="message" required></textarea><br>
        <input type="submit" name="sendMail" value="Wyślij">
    </form>';
}

function WyslijMailKontakt() {
    if (isset($_POST['sendMail'])) {
        $to = 'admin@example.com';
        $subject = 'Wiadomość z formularza kontaktowego';
        $message = 'Imię: ' . htmlspecialchars($_POST['name']) . "\n";
        $message .= 'Email: ' . htmlspecialchars($_POST['email']) . "\n";
        $message .= 'Wiadomość: ' . htmlspecialchars($_POST['message']);
        $headers = 'From: webmaster@example.com';

        if (mail($to, $subject, $message, $headers)) {
            echo 'Wiadomość została wysłana!';
        } else {
            echo 'Błąd przy wysyłaniu wiadomości.';
        }
    }
}

function PrzypomnijHaslo() {
    // Logika wysyłania maila z przypomnieniem hasła - podobna do WyslijMailKontakt
    // Uwaga: Uproszczona metoda i słabo zabezpieczona
}

// Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    WyslijMailKontakt(); // Obsługa wysyłania wiadomości
}

// Wyświetlenie formularza kontaktowego
PokazKontakt();
?>
