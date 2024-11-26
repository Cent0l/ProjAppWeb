<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);


include('cfg.php');
include('showpage.php'); 

if (isset($_GET['idp'])) {
    $id = $_GET['idp'];
    echo PokazPodstrone($id); 
}


if ($_GET['idp'] == '') $strona = 'html/mainpage.html';
if ($_GET['idp'] == 'Sprzet') $strona = 'html/placeholder.html';
if ($_GET['idp'] == 'Zastosowania') $strona = 'html/placeholder.html';
if ($_GET['idp'] == 'Gry') $strona = 'html/gry_subpage.html';
if ($_GET['idp'] == 'Koszta') $strona = 'html/koszta_subpage.html';
if ($_GET['idp'] == 'Wypowiedzi') $strona = 'html/placeholder.html';
if ($_GET['idp'] == 'Skrypty') $strona = 'html/skrypty.html';

$nr_indeksu = '169226';
$nrGrupy = 'isi1';

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
<body onload="startClock()">
    <header>
        <h1>Moje hobby - Simracing</h1>
    </header>

    <nav>
        <a href="index.php?idp=Sprzet">Sprzęt</a>
        <a href="index.php?idp=Zastosowania">Zastosowania</a>
        <a href="index.php?idp=Gry">Gry</a>
        <a href="index.php?idp=Koszta">Koszta</a>
        <a href="index.php?idp=Wypowiedzi">Wypowiedzi</a>
        <a href="index.php?idp=Skrypty">Skrypty</a>
    </nav>

    <div class="container">
        <?php
       
        if (file_exists($strona)) {
            include($strona);
        } else {
            echo 'Nie działa';
        }
        ?>
    </div>

    <footer>
        <p>Autor: Mateusz Cętkowski, numer indeksu: <?php echo $nr_indeksu; ?>, grupa: <?php echo $nrGrupy; ?></p>
    </footer>
</body>
</html>
