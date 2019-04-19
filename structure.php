<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 25/03/2019
 * Time: 14:58
 */


$page= __FILE__;
include "./header.php";
include "./navbar.php";

echo "Structure work : $page";
echo '<br/>';
// jour 1 lundi 25/03/2019
// comparaison de 2 valeurs avec un if
$var1 = 2;
$var2 = 4;

// comparaison en entrant les valeurs dans le navigateur
//var_dump($_GET);
//if ($_GET['var1'] === $_GET['var2']){
//    echo "Resultat identique";
//}

if ($var1 === $var2){
    echo "Resultat identique";
}


else{
    echo "Les données ne sont pas identiques";

}

echo '<br/>';

switch ($var1){
    case 2:
        echo "C'est 2";
        break;
    case 4:
        echo "C'est 4";
        break;
    case 5:
        echo "C'est 5";
        break;
}

// afficher la date en français
echo '<br/>';
echo 'Date en francais';

setlocale(LC_ALL, 'fr_FR');

$day = strftime('%A');
var_dump( ($day));

$d = strftime("%A");

//switch afficher le jour correspondant en fonction du  jour actuel
switch ($d){
    case "lundi":
        echo "On est $d";
        break;

    case "mardi":
        echo "On est $d";
        break;

    case "mercredi":
        echo "On est $d";
        break;

    case "jeudi":
        echo "On est $d";
        break;

    case "vendredi":
        echo "On est $d";
        break;

    case "samedi":
        echo "On est $d";
        break;

    case "dimanche":
        echo "On est $d";
        break;

    default:
        echo "Quel jour est-on ?";
}

echo '<br/>';

// afficher date en anglais
$d = date("D");

switch ($d){
    case "Mon":
        echo "Today is Monday";
        break;

    case "Tue":
        echo "Today is Tuesday";
        break;

    case "Wed":
        echo "Today is Wednesday";
        break;

    case "Thu":
        echo "Today is Thursday";
        break;

    case "Fri":
        echo "Today is Friday";
        break;

    case "Sat":
        echo "Today is Saturday";
        break;

    case "Sun":
        echo "Today is Sunday";
        break;

    default:
        echo "Wonder which day is this ?";
}


echo '<br/>';

// comparateur
$a = 1;
$b = "1";
if($a == $b){
    echo "Egal";
}
else{
    echo "Non egal";
}
echo '<br/>';

// boucle de 0 à 20
for($i = 0; $i <=20; $i++){
echo $i;
if($i >= 10)
    break;
}

// afficher boucle dans une boucle
$i = 0;
$j = 0;
for ($j=0; $j <=5 ; $j++) {
    for ($i=0; $i <= 10; $i++) {
        if ($i >= 6 ) {
            break;
        }
        echo "<br>boucle 1 :  $i";
    }
    echo "<br>boucle 2 :  $j";
}

echo "</p>";
//et celui avec le break 2 :
$i = 0;
 $j = 0;
for ($j=0; $j <=5 ; $j++) {
    for ($i=0; $i <= 10; $i++) {
        if ($i >= 6 ) {
            break 2;
        }
        echo "<br>boucle 1 :  $i";
    }
    echo "<br>boucle 2 :  $j";
}

echo "</p>";
echo '<br/>';
echo '<br/>';

// jour 2 mardi/26/03/19
//creer un while et les ajouter dans un tableau et l'afficher

$i = 1;
$array = array();
while ($i <= 12){
    $array[] = $i;
    echo $i++; /* La valeur affichée est $i avant l'incrémentation (post-incrémentation)  */

}
var_dump($array);

echo '<br/>';
// creer un melange des nombres
$numbers = range(1, 12);
$array = array();
shuffle($numbers);
foreach ($numbers as $number){
    echo "$number";
    $array[] = $number;

}
var_dump($array);

echo '<br/>';
//creer melange de nombres
// Créer le tableau
for($i=1, $array=[]; $i<=20; $i++){
    $array[] = $i;
}
// Melanger un tableau
shuffle($array);
// Afficher le tableau
        var_dump($array);

echo '<br/>';


?>