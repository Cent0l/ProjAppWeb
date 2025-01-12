<?php
session_start(); // Inicjalizacja sesji
include 'header.php'; // Nagłówek strony
require 'db_connection.php'; // Połączenie z bazą danych

// Metoda wyświetlająca formularz kontaktowy
function PokazKontakt() {
    echo '
    <h2>Formularz Kontaktowy</h2>
    <form method="POST" action="contact.php">
        <label for="name">Imię:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Wiadomość:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" name="sendMail" value="Wyślij">
    </form>';
}

// Metoda wysyłająca mail z formularza kontaktowego
function WyslijMailKontakt() {
    if (isset($_POST['sendMail'])) {
        $to = 'admin@example.com'; // Adres odbiorcy (zmień na prawidłowy adres)
        $subject = 'Formularz Kontaktowy';
        $message = "Imię: " . htmlspecialchars($_POST['name']) . "\n"
                 . "Email: " . htmlspecialchars($_POST['email']) . "\n"
                 . "Wiadomość:\n" . htmlspecialchars($_POST['message']);
        $headers = 'From: webmaster@example.com'; // Adres nadawcy (zmień na prawidłowy)

        if (mail($to, $subject, $message, $headers)) {
            echo '<p>Wiadomość została wysłana!</p>';
        } else {
            echo '<p>Wystąpił błąd podczas wysyłania wiadomości.</p>';
        }
    }
}

// Metoda wyświetlająca formularz przypomnienia hasła
function PrzypomnijHaslo() {
    echo '
    <h2>Przypomnienie Hasła</h2>
    <form method="POST" action="contact.php">
        <label for="email">Podaj swój e-mail:</label><br>
        <input type="email" id="email" name="resetEmail" required><br><br>
        <input type="submit" name="resetPassword" value="Wyślij przypomnienie">
    </form>';

    if (isset($_POST['resetPassword'])) {
        $email = htmlspecialchars($_POST['resetEmail']);
        $to = $email;
        $subject = 'Przypomnienie Hasła';
        $message = "Twoje hasło do panelu admina to: admin123"; // Uproszczone przypomnienie hasła
        $headers = 'From: webmaster@example.com';

        if (mail($to, $subject, $message, $headers)) {
            echo '<p>Wiadomość z hasłem została wysłana na adres: ' . htmlspecialchars($email) . '</p>';
        } else {
            echo '<p>Wystąpił błąd podczas wysyłania wiadomości.</p>';
        }
    }
}

// Obsługa wyświetlania odpowiednich formularzy
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'contact') {
        PokazKontakt();
    } elseif ($_GET['action'] === 'reset') {
        PrzypomnijHaslo();
    }
} else {
    PokazKontakt(); // Domyślnie wyświetl formularz kontaktowy
    WyslijMailKontakt();
}

include 'footer.php'; // Stopka strony
?>
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