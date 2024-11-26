<?
 	$nr_indeksu = ‘169226’;
 	$nrGrupy = ‘ISI1’;
 	echo ‘Mateusz Cetkowski ‘.$nr_indeksu.’ grupa ‘.$nrGrupy.’ <br /><br />’;
 	echo ‘Zastosowanie metody include() <br />’;
?>
echo 'a) Metoda include(), require_once() <br />';


include('randomfile.php');  
require_once('randomfile.php');  

echo 'b) Warunki if, else, elseif, switch <br />';


$number = 10;

if ($number > 10) {
    echo 'Liczba jest większa niż 10 <br />';
} elseif ($number == 10) {
    echo 'Liczba jest równa 10 <br />';
} else {
    echo 'Liczba jest mniejsza niż 10 <br />';
}

// switch
switch ($number) {
    case 10:
        echo 'Liczba wynosi 10 <br />';
        break;
    case 20:
        echo 'Liczba wynosi 20 <br />';
        break;
    default:
        echo 'Nieznana liczba <br />';
}

echo 'c) Pętla while() i for() <br />';

// Pętla while
$i = 0;
while ($i < 3) {
    echo 'Pętla while, iteracja: '.$i.'<br />';
    $i++;
}

// Pętla for
for ($j = 0; $j < 3; $j++) {
    echo 'Pętla for, iteracja: '.$j.'<br />';
}

echo 'd) Typy zmiennych $_GET, $_POST, $_SESSION <br />';

// $_GET - dane z URL
if (isset($_GET['name'])) {
    echo 'Dane z GET: '.$_GET['name'].'<br />';
}

// $_POST - dane z formularza
if (isset($_POST['name'])) {
    echo 'Dane z POST: '.$_POST['name'].'<br />';
}

// $_SESSION - sesje
session_start();
$_SESSION['user'] = 'Jan Kowalski';
echo 'Sesja: '.$_SESSION['user'].'<br />';
