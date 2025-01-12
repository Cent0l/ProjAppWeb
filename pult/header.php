<?php
require 'db_connection.php'; // Załaduj połączenie z bazą danych
?>

<header>
    <h1>Moja Strona WWW</h1>
    <nav>
        <?php
        // Pobranie aktywnych stron z bazy danych do wygenerowania menu
        $menu_query = "SELECT id, page_title, alias FROM page_list WHERE status = 1";
        $menu_result = $mysqli->query($menu_query);

        while ($menu_row = $menu_result->fetch_assoc()) {
            $link = 'index.php?idp=' . (isset($menu_row['alias']) && $menu_row['alias'] ? $menu_row['alias'] : $menu_row['id']);
            echo '<a href="' . $link . '">' . htmlspecialchars($menu_row['page_title']) . '</a>';
        }
        ?>
        <!-- Link do koszyka -->
        <a href="cart.php">Koszyk</a>
		<a href="login.php">Logowanie</a> <!-- Link do strony logowania -->
		
    </nav>
</header>
