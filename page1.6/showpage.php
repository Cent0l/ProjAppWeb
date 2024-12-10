<?php
// Funkcja do pobrania i wyświetlenia treści podstrony na podstawie ID
function PokazPodstrone($id) {
    global $link; // Połączenie z bazą danych z pliku cfg.php

    // Ochrona przed SQL Injection
    $id_clear = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');

    // Przygotowanie zapytania SQL
    $query = "SELECT page_content FROM page_list WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_clear);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['page_content'];
        } else {
            return '[Strona nie znaleziona]';
        }
    } else {
        return '[Błąd zapytania SQL]';
    }
}
?>
