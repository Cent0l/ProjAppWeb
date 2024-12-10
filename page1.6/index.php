<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include('cfg.php');
include('showpage.php'); 

// Ustalanie ID podstrony
$id = isset($_GET['idp']) ? $_GET['idp'] : '';

// Wyświetlenie podstrony na podstawie zawartości bazy
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="language" content="pl">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mateusz Cętkowski">
    <title>Moje hobby - Simracing</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <h1>Moje hobby - Simracing</h1>
    </header>

    <!-- Menu nawigacyjne -->
    <nav>
        <?php
        // Generowanie dynamicznego menu na podstawie bazy danych
        $query = "SELECT id, page_title FROM page_list WHERE status = 1";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="index.php?idp=' . $row['id'] . '">' . $row['page_title'] . '</a>';
        }
        ?>
    </nav>

    <div class="container">
        <?php
        // Wyświetlenie zawartości podstrony
        if ($id) {
            echo PokazPodstrone($id);
        } else {
            echo '<h2>Witamy na stronie głównej!</h2><p>Wybierz podstronę z menu.</p>';
        }
        ?>
    </div>

    <footer>
        <p>Autor: Mateusz Cętkowski</p>
    </footer>
</body>
</html>
