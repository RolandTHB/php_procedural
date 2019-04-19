<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 25/03/2019
 * Time: 13:51
 */


$page= __FILE__;
include "./header.php";
include "./navbar.php";

echo "Var work : $page";


var_dump($page);
var_dump($_GET);
$var1 = 4;
$var2 = "5";
$var3 = $var1 + $var2;
echo "var3 = $var3";

echo "<br>";


//test


echo $_SERVER['HTTP_USER_AGENT'];

include "./footer.php";



?>