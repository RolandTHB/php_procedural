<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 28/03/2019
 * Time: 10:40
 */

    $page= __FILE__;
    include "./header.php";
    include "./navbar.php";

    // lit un fichier et le place dans une chaine
    $filename = "something";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    echo $contents;
    fclose($handle);

    echo"<br/>";

    //cookies

    setcookie("name",	"John	Watkin",	time()+3600,	"/","",	0);
    setcookie("age",	"36",	time()+3600,	"/",	"",	0);


echo"<br/>";
    //affiche
// image

$filename = "avatar.jpg";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
echo $contents;
fclose($handle);





    include "./footer.php";
?>