<?php
    /**
     * Created by PhpStorm.
     * User: HB
     * Date: 04/04/2019
     * Time: 16:20
     */

    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";

    $name = 'Toto';
    echo $name;
    var_dump($name);
    $fruit = [];
    $fruit[0] = "pomme";
    $fruit[1] = "poire";
    $fruit[2] = "banane";
    echo'Test';

    var_dump($fruit);


    $date_du_jour = date("d-m-y");

    echo $date_du_jour . " ";

    $heure_du_jour = date("H:i");
    echo $heure_du_jour;

    echo 'Votre ip est : ' . $_SERVER['HTTP_USER_AGENT'];


?>


<?php


    include "./footer.php";
?>
