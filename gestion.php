<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 01/04/2019
 * Time: 09:24
 */


$page = __FILE__;
include "./header.php";
include "./navbar.php";
echo"test";
echo"<br>";

// function die tue tout ce qu'il y a aprés la function
if (!file_exists("/tmp/test.txt")){
   // die("File not found");
    echo"File not found";
}else{
    $file=fopen("/tmp/test.txt","r");
    print"Open filed succesfully";
}
//test of the code here
echo"<br>";
echo"test 2";

//function try
echo"<br>";
echo"<h5>function try</h5>";
try {
    $filename = "/tmp/test.txt";
    if (!file_exists("/tmp/test.txt")) ;
    throw new Exception("File not found");
    echo"<br>";
} catch (Exception $e) {
    // send error message if you can
    var_dump($e);
    echo "Exception line :", $e->getLine() ," on File : ", $e->getFile() ," Error : ", $e->getMessage() ;
    echo"<br>";
} finally {
    echo "test finally";
    echo"<br>";

}

// function diviser
function inverse($x) {
    // le if (!$x) est équivalent à if ($x == 0)
    if (!$x) {
        throw new Exception('Division par zéro.');
    }
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
} finally {
    echo "Première fin.\n";
}

try {
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
} finally {
    echo "Seconde fin.\n";
}

// On continue l'exécution
echo "Bonjour le monde !\n";


include "./footer.php";
?>