<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 27/03/2019
 * Time: 09:25
 */

    $page= __FILE__;
    include "./header.php";
    include "./navbar.php";

    echo "Function work : $page";
    echo '<br/>';
    //pm5 function age
    echo "<h5>PM5</h5>";

    function isMajeur ($age)
    {
        return $age >= 18;

    }
    var_dump(isMajeur(14));
    var_dump(isMajeur(25));

    echo '<br/>';

    //pm7
    echo "<h5>PM7</h5>";
    function isMajeur2 (int $age) :bool
    {
        return $age >= 18;
    }

    var_dump(isMajeur(14));
    var_dump(isMajeur(54));

    // return de caractere avec if
    echo "<h5>PM7 if</h5>";

    function isMajeur3 (int $age) : string {
        if ($age >= 18) {
            return "Vous etes majeur";
        } else {
            return " Vous etes mineur";
        }
    }
    var_dump(isMajeur3(25));
    var_dump(isMajeur3(2));


    echo '<br/>';

    // pays est facultatif
    echo "<h5>PM7 if pays</h5>";

    function isMajeur4(int $age, string $pays ="fr")
    {
        if ($pays == 'usa') {
            return $age >= 16;
        } else {
            return $age >= 18;
        }


    }

    var_dump(isMajeur4(16,"fr"));
    var_dump(isMajeur4(16,"usa"));
    var_dump(isMajeur4(20));

    echo '<br/>';
    // switch
    echo "<h5>Switch pays</h5>";

    function isMajeur5(int $age, string $pays ) : string {
        switch ($pays) {
            case 'france':
                if ($age >= 18)
                    return "A $age ans, vous êtes majeurs en $pays";
                else
                    return "A $age ans, vous êtes mineurs en $pays";
                break;
            case 'usa':
                if ($age >= 21)
                    return "A $age ans, vous êtes majeurs en $pays";
                else
                    return "A $age ans, vous êtes mineurs en $pays";
                break;
            case 'japon':
                if ($age >= 16)
                    return "A $age ans, vous êtes majeurs en $pays";
                else
                    return "A $age ans, vous êtes mineurs en $pays";
                break;
            case 'russie':
                if ($age >= 18)
                    return "A $age ans, vous êtes majeurs en $pays";
                else
                    return "A $age ans, vous êtes mineurs en $pays";
                break;
            default:
                if ($pays == '')
                    return "Merci de donner un paramètre";
                else
                    return "Ce pays : $pays n'existe pas";
                break;
        }
    }
    var_dump(isMajeur5(17, 'uruguay'));
    var_dump(isMajeur5(17, ''));
    var_dump(isMajeur5(17, 'france'));
    var_dump(isMajeur5(17, 'usa'));
    var_dump(isMajeur5(17, 'japon'));
    var_dump(isMajeur5(17, 'russie'));

    // "? A : B" renvoi un booléen.
    // A renvoi la valeur True.
    // B renvoi la valeur false.
    $age = 18;

    $majeur = isMajeur4($age, 'fr') ? 'Adulte' : 'Enfant';
    echo $majeur; // Adulte

    echo '<br/>';

    $majeur = isMajeur4($age, 'usa') ? 'Adulte' : 'Enfant';


    echo $majeur; // enfant

    echo '<br/>';
    echo "<h5>Puissance</h5>";

    function puissance(int $number):int
    {$a = $number * $number;
        echo "a in function puissance = $a";
        return $a;

    }

    $a = 10;
    var_dump($a);
    var_dump(puissance($a));
    var_dump($a);

    echo $_SERVER['HTTP_USER_AGENT'];
    var_dump($_SERVER);

    //fonction pour avoir la racine d'un nombre :
    //$nbr = $_GET['nombre'];
    function racineCarre ( float $Arg_nbr ) : float { // arg_nbr = argument d'un nombre de votre choix
        return sqrt($Arg_nbr);
    }
    /* var_dump(racineCarre(64)); // là on defini notre argument donc on defini arg_nbr*/
    var_dump(racineCarre($_GET['nombre']));// et là on prend notre variable plus haut
    var_dump(sqrt(25));
    ?>
    <h4>Formulaire</h4>
    <!--Formulaire avec méthode post-->
    <form method="post" action="">
        <input type="number" name="age">
        <input type="text" name="pays">
        <input type="submit">
    </form>


<?php

//    var_dump ($_POST);

//  Fonction principale.
    function lancerMajeur(){

//      On récupère l'âge et le pays du formulaire.
        $age = $_POST['age'];

//      strtolower pour mettre tout en minuscule.
        $pays = strtolower($_POST['pays']);

//      Fonction qui vérifie si on est majeur selon le pays.
        function isMajeur(int $age, string $pays){

//          Switch qui vérifie si le pays est correct.
            switch($pays){
                case "fr":
                    $majeur = 18;
                    break;
                case "usa":
                    $majeur = 21;
                    break;
                case "yemen":
                    $majeur = 15;
                    break;
                default :
                    $majeur = 0;
                    break;
            }

//          If qui vérifie si on est majeur ou mineur.
            if ($age >= $majeur){
//              Ici on est majeur.
                echo "On est majeur quand on a $age ans dans le pays $pays.";
            }else if($age == 1){
//              Ici on est mineur avec 1 an (pour orthographe).
                echo "On est mineur quand on a $age an dans le pays $pays.";
            }else if($age < 0){
//              Ici l'âge est incorrect (en négatif).
                echo "Veuillez entrer un âge correct";
            }else{
//              Ici on est mineur.
                echo "On est mineur quand on a $age ans dans le pays $pays.";
            }
        }

    }

//  If qui vérifie si l'âge et le pays sont entrés et corrects.
    if ( isset($_POST['age']) && isset($_POST['pays']) && $_POST['pays'] != '' && $_POST['age'] != '') {
//      Si tout est correct on lance la fonction.
        lancerMajeur();
    } else {
//      Si ce n'est pas correct on affiche une erreur.
        echo "Veuillez entrer un âge et un pays.";
    }'';





include "./footer.php";
?>