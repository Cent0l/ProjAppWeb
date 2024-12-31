<?php
// Funkcja do pobrania i wyświetlenia treści podstrony na podstawie ID
function PokazPodstrone($id) {
    global $link; // Połączenie z bazą danych z pliku cfg.php

    // Ochrona przed SQL Injection
    $id_clear = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');

    // Przygotowanie zapytania SQL
    $query = "SELECT page_content, page_title FROM page_list WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_clear);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (strtolower($row['page_title']) == 'kontakt') {
                // Jeśli podstrona to "Kontakt", pokaż formularze
                PokazKontakt();
                WyslijMailKontakt();
                PrzypomnijHaslo();
            } else {
                return $row['page_content'];
            }
        } else {
            return '[Strona nie znaleziona]';
        }
    } else {
        return '[Błąd zapytania SQL]';
    }
}

// Funkcja do wyświetlania formularza kontaktowego
function PokazKontakt() {
    echo '
    <h2>Formularz Kontaktowy</h2>
    <form method="POST">
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="message">Wiadomość:</label>
        <textarea id="message" name="message" required></textarea><br>
        
        <input type="submit" name="sendMail" value="Wyślij">
    </form>';
}

// Funkcja do wysyłania wiadomości z formularza kontaktowego
function WyslijMailKontakt() {
    if (isset($_POST['sendMail'])) {
        $to = 'admin@example.com'; // Adres odbiorcy
        $subject = 'Formularz Kontaktowy';
        $message = "Imię: " . htmlspecialchars($_POST['name']) . "\nEmail: " . htmlspecialchars($_POST['email']) . "\nWiadomość:\n" . htmlspecialchars($_POST['message']);
        $headers = 'From: webmaster@example.com';

        if (mail($to, $subject, $message, $headers)) {
            echo '<p>Wiadomość została wysłana!</p>';
        } else {
            echo '<p>Wystąpił błąd podczas wysyłania wiadomości.</p>';
        }
    }
}

// Funkcja do obsługi przypomnienia hasła
function PrzypomnijHaslo() {
    echo '
    <h2>Przypomnienie hasła</h2>
    <form method="POST">
        <label for="email">Podaj swój email:</label>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" name="resetPassword" value="Wyślij przypomnienie">
    </form>';

    if (isset($_POST['resetPassword'])) {
        $email = htmlspecialchars($_POST['email']);
        echo '<p>Instrukcja resetowania hasła została wysłana na adres: ' . $email . '</p>';
    }
}
?>
