<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 26/03/2019
 * Time: 10:29
 */

$page= __FILE__;
include "./header.php";
include "./navbar.php";


// jeu 52 cartes melanger cartes et distribuer 4 cartes à 4 personnes autour d'une table

//creer nombre avec un while et les ajouter dans un tableau et l'afficher

$symboles = array('Coeur', "Carreau", "Trèfle", "Pique");
$valeurs = array("As", "2", "3", "4","5", "6", "7", "8", "9", "10", "Roi", "Dame", "Valet");
$players = array("Luffy", "Zoro", "Trafalgar", "Kid");
$cartes = array();;

//creer les cartes
foreach ($valeurs as $valeur){
    foreach ($symboles as $symbole){
        $cartes[] = $valeur. " ". $symbole;
    }
}

// Melanger cartes
shuffle($cartes);
// Afficher le tableau des cartes
var_dump($cartes);

echo "<h5>Code Romain</h5>";


// code romain avec boucle for
$cardNumbers= array("AS","2","3","4","5","6","7","8","9","10","J","Q","K");
$cardSymbols= array(":cœurs:", ":carreau:", ":trèfle_noir:", ":pique:");
$deck = array();
for($symbols=0; $symbols <=3; $symbols++){
    for($numbers=0; $numbers <=12; $numbers++){
        $deck[] = $cardNumbers[$numbers] . ' ' . $cardSymbols[$symbols];
    }
};
var_dump ($deck);

shuffle($deck);

var_dump ($deck);

// code nicolas

echo "<h5>Code Nicolas</h5>";
echo '<hr/><h5>Jeu de cartes</h5><br/>';

// Créer les couleurs et symboles
$couleurs = array(':spades:', ':hearts:', ':diamonds:', ':clubs:');
$valeurs = array('As', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi');
$cartes = array();
$nb_joueurs = 4;
$mains = array();
$num_joueur = 1;

// Creer les cartes
foreach($couleurs as $couleur){
    foreach($valeurs as $valeur){
        $cartes[] = $valeur . ' ' . $couleur;
    }
}

// Compter le nombre de cartes
$nb_cartes = count($cartes);

// Melanger le tableau
shuffle($cartes);

// Pour chaque carte
foreach(array_keys($cartes) as $key){
    // Si on a donné à tous les joueurs on recommence un tour
    $num_joueur++;
    if($num_joueur==4)
        $num_joueur=0;

    // on donne une carte
    $mains[$num_joueur][]=array_pop($cartes);

}

// Afficher le tableau
$i=0;
foreach($mains as $main){
    echo 'Joueur '.$i.' --> ';
    foreach($main as $c){
        echo '| '.$c.' |';
    }
    $i++;
    echo '<br/>';
}

// Compter le nombre de cartes
echo count($cartes);

echo '<br/><br/><br/><br/>';

//Code gaetan
echo "<h5>Code Gaetan</h5>";
$signs = ["♣","♥","♦","♠"];
$values = ["Deux","Trois","Quatre","Cinq","Six","Sept","Huit","Neuf","Dix","Valet","Dame","Roi","As"];
$points = [2,3,4,5,6,7,8,9,10,11,12,13,14];
$deck = [];

// Boucle des signes
for ($sign=0; $sign < count($signs); $sign++) {
    // Boucle des valeurs
    for ($value=0; $value < count($values); $value++) {
        //Création tableau
        $deck[] = array(
            $values[$value],
            $signs[$sign],
            $points[$value]
        );
    }
}
for ($i=0; $i < 2; $i++) {

    $deck[] = array(
        "Joker",
        "☺",
        15
    );

}
shuffle($deck);

//Création des joueurs
$playerNames = ['Romain','Greg nul','Som','Roland'];
foreach ($playerNames as $playerName) {
    //Chaque joueur a un [] de cartes
    $playersCards[$playerName] = array();
    $sums[$playerName] = 0;
}

//Distribution des cartes
for ($tour=0; $tour < 4; $tour++) {
    // array push ajoute la carte au joueur / pop retirer la carte du deck et la retourne
    //array_push(tableau, variable);

    //Méthode 1
    // $carte = array_pop($deck);
    // array_push($playersCards[0], $carte);

    // array_push($playersCards[1], array_pop($deck));
    // array_push($playersCards[2], array_pop($deck));
    // array_push($playersCards[3], array_pop($deck));

    //Méthode 2
    // for ($player=0; $player < count($playersCards); $player++) {
    //     array_push($playersCards[$player], array_pop($deck));
    // }

    foreach ($playersCards as $key => $player) {
        array_push($playersCards["$key"], array_pop($deck));
    }
}
// count(deck) , compte le nombre d'elements dans le tableau
echo "Il reste " . count($deck) . " cartes";
echo "<div class='row'>";
// On crée la somme de points des joueurs en parcourant leur cartes

//Boucle d'affichage des cartes
//POur chaque joueur on recupere chaque main
foreach ($playersCards as $key => $playerHand) {
    echo "<div class='col-md-2 text-center'>";
    echo "Joueur ". $key;
    //Pour chaque main je recupere chaque cartes
    foreach ($playerHand as $card) {
        //Affichage 'nom' et 'symbol'
        echo "<p> $card[0]  $card[1] $card[2] </p>";
        $sums[$key] += $card[2];
    }
    echo "</div>'";
}
echo "</div>'";
// affichage des sommes
foreach ($sums as $key => $sum) {
    echo "<p class='m-2'>Joueur  $key :  $sum </p>";
}
var_dump($sums["Som"]);





include "./footer.php";
?>