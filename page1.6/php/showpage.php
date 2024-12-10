<?php
// Funkcja do wyświetlania podstrony na podstawie ID
function PokazPodstrone($id)
{
    // Używamy htmlspecialchars() dla ochrony przed atakami typu SQL Injection
    $id_clear = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');

    // Połączenie z bazą danych - musisz połączyć się z bazą przed wykonaniem zapytania
    include('cfg.php'); // Połączenie z bazą danych (plik cfg.php z mysqli)

    // Przygotowanie zapytania SQL
    $query = "SELECT * FROM page_list WHERE id = ? LIMIT 1";

    // Przygotowanie zapytania
    if ($stmt = mysqli_prepare($link, $query)) {
        // Związanie zmiennej z zapytaniem
        mysqli_stmt_bind_param($stmt, "i", $id_clear); // 'i' oznacza typ zmiennej jako integer
        
        // Wykonanie zapytania
        mysqli_stmt_execute($stmt);
        
        // Pobranie wyniku
        $result = mysqli_stmt_get_result($stmt);
        
        // Sprawdzenie, czy strona istnieje w bazie
        if ($row = mysqli_fetch_assoc($result)) {
            $web = $row['page_content']; // Zawartość strony
        } else {
            $web = '[nie_znaleziono_strony]'; // Brak strony
        }

        // Zamknięcie zapytania
        mysqli_stmt_close($stmt);
    } else {
        $web = '[błąd zapytania]';
    }

    return $web;
}

// Sprawdzenie, czy zostało podane ID strony
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo PokazPodstrone($id);
} else {
    echo '[brak ID strony]';
}

?>
