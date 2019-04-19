<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 03/04/2019
 * Time: 14:12
 */



    $data = [];

    for($i = 0; $i < 10; $i++){
        $name = htmlspecialchars(stripslashes(file_get_contents('http://faker.hook.io/?property=name.lastName&locale=fr')));
        $name = preg_replace('/[^a-zA-Z0-9"]/', '', $name);
        $name = preg_replace('[quot]', '', $name);
        $array = array('name' => "$name");
        array_push($data, $array);
    }

    echo json_encode($data);



//$data = [];
//
////Le nb_name est récupéré depuis le formulaire dans faker.php après avori transité par le fake.js
//for($i = 1; $i <= $_GET['nb_name']; $i++) {
//
//    $name = htmlspecialchars(stripslashes(file_get_contents('http://faker.hook.io/?property=name.lastName&locale=fr')));
//
//    $name = preg_replace('/[^a-zA-Z0-9"]/', '', $name);
//
//    $name = preg_replace('[quot]', '', $name);
//
//    $array = array('name' => "$name");
//
//    array_push($data, $array);
//
//}
//
//
//echo json_encode($data);
?>