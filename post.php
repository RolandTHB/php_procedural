<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 27/03/2019
 * Time: 15:00
 */

$page= __FILE__;
include "./header.php";
include "./navbar.php";

?>
 <!-- Formulaire avec méthode post -->
    <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputAge">Age</label>
            <input type="number" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="Entrez votre âge ">
          </div>
          <div class="form-group">
            <label for="exampleInputPays">Pays</label>
            <input type="text" name="pays" class="form-control" id="pays" aria-describedby="paysHelp" placeholder="Entrez votre pays ">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>


<?php

    // Fonction qui vérifie si on est majeur selon le pays.
    function isMajeur($age, $pays){

            // Switch qui vérifie si le pays est correct.
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

            // If qui vérifie si on est majeur ou mineur.
            if ($age >= $majeur){
                // Ici on est majeur.
                echo "On est majeur quand on a $age ans dans le pays $pays.";
            }else if($age == 1){
                // Ici on est mineur avec 1 an (pour orthographe).
                echo "On est mineur quand on a $age an dans le pays $pays.";
            }else if($age < 0){
                // Ici l'âge est incorrect (en négatif).
                echo "Veuillez entrer un âge correct";
            }else{
                // Ici on est mineur.
                echo "On est mineur quand on a $age ans dans le pays $pays.";
            }
     }


    //  If qui vérifie si l'âge et le pays sont entrés et corrects.
    if ( isset($_POST['age']) && isset($_POST['pays']) && $_POST['pays'] != '' && $_POST['age'] != '') {

        /* Si tout est correct on lance la fonction. On récupère l'âge et le pays du formulaire.
        strtolower pour mettre tout en minuscule. */

        isMajeur( (int)$_POST['age'], strtolower($_POST['pays']) );
    } else {
        // Si ce n'est pas correct on affiche une erreur.
        echo "Veuillez entrer un âge et un pays.";
    }

?>
    <!-- Fin du container -->
    </div>



<!-- Formulaire calcul puissance avec méthode post -->
<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="exampleInputTitle">Nombre</label>
            <input type="number" name="nombre" class="form-control" id="nombre" aria-describedby="ageHelp" placeholder="Entrez votre nombre ">

        </div>
        <button type="submit" class="btn btn-primary">Power</button>
    </form>

    <?php

    // Fonction puissance
    function puissance(int $number):int
    {$a = $number * $number;
        echo "$number = $a";
        return $a;

    }

    //  If qui vérifie si l'âge et le pays sont entrés et corrects.
    if ( isset($_POST['nombre'])) {

        /* Si tout est correct on lance la fonction. On récupère le nombre du formulaire.
        */
        puissance( (int)$_POST['nombre']);
    }
    echo"<br/>";
    echo"<br/>";
    echo"<br/>";
    ?>
    <!-- Fin du container -->
</div>

    <h5>Paramètres	par	valeur	:	travail	sur	une	copie	de	la	variable</h5>
<?php
    function by_val(int $x)
    {
        $x ++;
        echo "<h6>\$x = $x into call</h6>";
        echo func_num_args();
    }
    $x	=	1;
    echo "<h6>\$x = $x before call</h6>";
    by_val($x);
    echo "<h6>\$x = $x after call</h6>";

    echo "<h2>By ref</h2>";
    function by_val2(int &$x)
    {
    $x++;
    echo "<h6>\$x= $x into call</h6>";

    }

    $x = 1;
    echo "<h6>\$x = $x before call</h6>";
    by_val2($x);
    echo "<h6>\$x = $x after call</h6>";

    echo "<br/>";
    echo "<br/>";
    echo"<h5>Closure</h5>";
    $toto = function ($y){
        echo "Hello " . ($y + 3). " ";
    };
    //call the closure
    $toto(4);
    echo "<br/>";
    $tab = [1, 2 ,3];
    array_walk($tab, $toto);

    echo "<br/>";
    echo "<br/>";

    // Sans le array_walk il faudrait faire :
    echo "<br/>";
    //foreach($tab as $key => $value){
    //    echo $toto($value);
    //}

    echo "<br/>";

    $abc = function ($name) {
        echo "<br/>" . ucwords(strtolower($name));
    };
    $joueurs = ["tOtO", "titi", "TATA"];
    array_walk($joueurs, $abc);
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";




include "./footer.php";
?>