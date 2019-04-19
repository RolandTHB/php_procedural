<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 05/04/2019
 * Time: 09:39
 */

    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";

    //nom du fichier php de la page

    echo "<h1>". $page. "</h1>";

    // afficher nom et prenom
    // creation de variables

    $firstname = "Roland";
    $lastname = "Tabet";

        //afficher à l'aide d'un echo
    echo "<h2>". $firstname. $lastname. "</h2>";

    //afficher date du jour et l'heure

    $date = date("D-M-y");
    echo "<h2>We are the ". $date . " ";

    $time = date("H:i");
    echo "and it is ". $time. "</h2>";

    // tableau des mois et des temperatures en utilisant un for
    // creer variables qui sont des tableaux vides

    $months = [];
    $data = [];

    for ($i=0; $i < 12 ; $i++){
        array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
        array_push($data, rand(-10, 30));
    }
    // afficher tableau
    var_dump($months);
    var_dump($data);


    // fonction anonyme
    function (int $months)
    {
        return $months;

    };

    echo $months[2];
//    $closure_months = function (int $months)
//    {
//        return $months;
//
//    };
//
//    $closure_months("5");
    ?>

    <br/>
    <br/>
    <br/>
   <!-- formulaire avec bouton radio -->☺
    <div class="container">
        <form method="post">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">Jan</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">Feb</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                <label class="form-check-label" for="inlineRadio3">Mar</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="4">
                <label class="form-check-label" for="inlineRadio4">Apr</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="5">
                <label class="form-check-label" for="inlineRadio5">May</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="6">
                <label class="form-check-label" for="inlineRadio6">Jun</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio7" value="7">
                <label class="form-check-label" for="inlineRadio7">Jul</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio8" value="8">
                <label class="form-check-label" for="inlineRadio8">Aug</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio9" value="9">
                <label class="form-check-label" for="inlineRadio9">Sep</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio10" value="10">
                <label class="form-check-label" for="inlineRadio10">Oct</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio11" value>
                <label class="form-check-label" for="inlineRadio1">Nov</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio12" value="12">
                <label class="form-check-label" for="inlineRadio1">Dec</label>
            </div>




           <!-- // creation bouton temperature -->
            <button type="button" class="btn btn-primary" onclick="();">Find Temperature</button>
        </form>
    </div>


    <br/>
    <br/>
    <br/>
<!-- // affiche la temperature du mois -->
<?php
$idmonth =$_POST['inlineRadioOptions'];
?>


<!-- //afficher tableau à 3 colonnes -->

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Month</th>
      <th scope="col">Temperature</th>

    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($months as $value) {
//      var_dump($value);
      echo "<tr>";
      echo "<th scope=\"row\">". "</th>";
      echo "<td>" . $value . "</td>";
      foreach ($data as $value2) {
//          var_dump($value2);

          echo "<th scope=\"row\">". "</th>";
          echo "<td>" . $value2 . "</td>";


      }


      echo "</tr>";
  }
  foreach ($data as $value2) {
//      var_dump($value2);

      echo "<th scope=\"row\">". "</th>";
      echo "<td>" . $value2 . "</td>";


  }


  ?>
  </tbody>
</table>

<br/>
<br/>
<br/>


        <?php
    include "./footer.php";
?>
<!-- exam gaetan -->
<?php
//$page = __FILE__;
//include "./header.php";
//include "./navbar.php";
//
////Création des variables relatives à la page
//$user = "Thomas Gaëtan";
//$date = date('l j F Y');
//$fileName = basename($page);
//echo "<div class='container'><h3>$fileName,$user $date </h3>";
//
////Création des tableaux
//$months = [];
//$temps = [];
//
////Fonction anonyme dans une variable qui créé un bouton radio pour un certain entier
//$createRadioButton = function($int){
//    $month = date('M',mktime(0,0,0,$int,1));//On récupère le mois en string de 3 caractères
//    //On créé pour chaque mois un bouton radio
//    echo "<input class='form-check-input mx-2' type='radio' name='inlineRadioOptions' id='inline-radio$int' value='$int'></input><label class='form-check-label' for='inline-radio$int'>$month</label>";
//};
////Remplissage tableaux
//for ($month=1; $month < 13; $month++) {
//    array_push($months,$month);
//    array_push($temps,rand(-10,30));
//}
////Test de la fonction annonyme pour 1 et 10
//// echo $createRadioButton(1) . "<br>" . $createRadioButton(10);
//
////Création du formulaire
//echo "<form class='form-check form-check-inline' method='post'>";
////On parcours le tableau $months et a chacun des éléments on appel la fonction $createRadioButton avec la valeur de l'element en argument
//array_walk($months,$createRadioButton);
////Boutton pour recupérer le $_POST
//echo "<button class='btn bg-info mx-5'>Display the Temp</button></form>";
//
////Si $_POST est défini
//if (isset($_POST["inlineRadioOptions"])) {
//    $monthStr = date('F',mktime(0,0,0,$_POST["inlineRadioOptions"],1));
//    //On affiche le mois relatif au bouton et la temperature relative au mois
//    echo "<p class='mt-4'>Sur Mars la température moyenne du mois de " . $monthStr . " est de " .$temps[$_POST["inlineRadioOptions"]-1]."</p>";
//}
//
////Création du tableau
//echo "<div class='container text-center p-2'>
//    <table class='table'><thead><tr>
//    <th scope='col'>Index</th>
//    <th scope='col'>Month</th>
//    <th scope='col'>Moy Temp</th></tr></thead><tbody>";
////Pour chaque mois
//for ($i=0; $i < 12; $i++) {
//    $month = date('M',mktime(0,0,0,$months[$i],1));
//    //On affiche tous le mois et sa température
//    echo "<tr><th scope='row'>".$i."</th><td>".$month."</td><td>".$temps[$i]."</td></tr>";
//}
//echo "</tbody></table></div></div>";
//
//include "./footer.php";
//?>