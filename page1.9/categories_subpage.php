<?php
include('cfg.php'); // Połączenie z bazą danych
include('categories.php'); // Funkcje kategorii

// Wyświetlenie wszystkich kategorii w formie drzewa
echo '<h2>Struktura kategorii</h2>';
PokazKategorie();

// Link do panelu administracyjnego
echo '<br><a href="admin.php?action=add">Przejdź do zarządzania kategoriami</a>';
?>
