<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 02/04/2019
 * Time: 09:58
 */
$page= __FILE__;
include "./header.php";
include "./navbar.php";

?>
<!-- Formulaire avec méthode post -->
    <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputAge">Factoriel</label>
            <input type="number" name="number" class="form-control" id="number" aria-describedby="number" placeholder="Entrez votre nombre ">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

<?php
//
//var_dump($_POST);
// Au lancement du formulaire, si le formulaire est vide on affiche le message "Entrez un nombre compris entre 1 et 170"
if ( !isset($_POST['number']) || $_POST['number'] == '' ) {
    echo "Entrez un nombre compris entre 1 et 170";
    //On teste que l'utilisateur rentre bien un nombre ou un chiffre et non une chaîne de caractère ou un caractère.
} else if (!is_numeric($_POST['number'])) {
    echo "Les lettres ne sont pas acceptées, vous devez entrer un chiffre";
//On teste que l'utilisateur entre un nombre supérieur à 0. Dans le cas contraire on affiche le message.
} else if (($_POST['number']) <= 0) {
    echo"Entrez un nombre supérieur à 0";
//On teste que l'utilisateur rentre un nombre inférieur à 170. Dans le cas contraire on affiche le message.
} else if (($_POST['number']) > 170) {
    echo"Entrez un nombre inférieur à 170";
//On lance la fonction pour calculer le factoriel.
} else {
    echo fact($_POST['number']);
}

// factoriel
function fact($n)
{
    if ($n == 0) {
        return 1;
    } else {
        return $n*fact($n-1);
    }

}
//    echo fact(5);
//    echo"<br>";
//
//    echo"<h5>Test 0 </h5>";
//    echo fact(0);
//    echo"<br>";
//
//    echo"<h5>Test 1 </h5>";
//    echo"<br>";
//
//    echo fact(1);
//    echo"<br>";

// define variables and set to empty values
//$nameErr = $emailErr = $genderErr = $websiteErr = "";
//$name = $email = $gender = $comment = $website = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["name"])) {
//        $nameErr = "Name is required";
//    }else {
//        $name = test_input($_POST["name"]);
//    }
//
//    if (empty($_POST["email"])) {
//        $emailErr = "Email is required";
//    }else {
//        $email = test_input($_POST["email"]);
//        // check if e-mail address is well-formed
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $emailErr = "Invalid email format";
//        }
//    }
//
//    if (empty($_POST["website"])) {
//        $website = "";
//    }else {
//        $website = test_input($_POST["website"]);
//    }
//
//    if (empty($_POST["comment"])) {
//        $comment = "";
//    }else {
//        $comment = test_input($_POST["comment"]);
//    }
//
//    if (empty($_POST["gender"])) {
//        $genderErr = "Gender is required";
//    }else {
//        $gender = test_input($_POST["gender"]);
//    }
//}
//
//function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}


include "./footer.php";
?>