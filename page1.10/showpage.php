<?php
session_start(); // Inicjalizacja sesji
function PokazPodstrone($id, $link) {
    $query = "SELECT page_content FROM page_list WHERE id = ? AND status = 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['page_content'];
    } else {
        return '<h2>Podstrona nie została znaleziona lub jest nieaktywna.</h2>';
    }
}
?>
