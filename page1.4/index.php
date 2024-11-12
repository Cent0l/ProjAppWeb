<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="language" content="pl">
    <meta name="author" content="Mateusz Cętkowski">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Moje hobby to simracing</title>
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
</head>

<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if ($_GET['idp'] == '') {
    $strona = 'html/mainpage.html';
} elseif ($_GET['idp'] == 'main') {
    $strona = 'html/koszta_subpage.html';
} elseif ($_GET['idp'] == 'koszta') {
    $strona = 'html/skrypty.html';
} elseif ($_GET['idp'] == 'skrypty') {
    $strona = 'html/gry_subpage.html';
} elseif ($_GET['idp'] == 'placeholder') {
    $strona = 'html/placeholder.html';
} else {
    $strona = 'html/glowna.html';
}

if (file_exists($strona)) {
    include($strona);
} else {
    echo "Nie znaleziono strony.";
}





 $nr_indeksu = '169226';
 $nrGrupy = 'isi1';
 echo 'Autor: Mateusz Cętkowski '.$nr_indeksu.' grupa '.$nrGrupy.'';
 
?>



</html>
