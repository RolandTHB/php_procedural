<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 02/04/2019
 * Time: 13:45
 */
$page= __FILE__;
include "./header.php";
include "./navbar.php";


echo "<h3>simplexml_load_string</h3>";
$xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8" ?>
    
         <root>
             <artist lastname="John" firstname="Coltrane">Saxophone</artist>
             <artist lastname="Miles" firstname="Davis">Trumpet</artist>
         </root>
    ');

echo "<table class=\"table table-dark\">
    <thead> 
    <tr>
    <th scope=\"col\">Artist</th><th scope=\"col\">Instrument</th>
    </tr>
    </thead>
    <tbody>";
foreach ($xml->artist as $value){
    //var_dump($value);
    echo' <tr>
             <td scope="row">'.$value->attributes()->lastname."  ".$value->attributes()->firstname.'</td>
             <td>'.$value.'</td>
           </tr>';
}
    echo "</tbody>

    </table>";
?>




<table class="table">
                  <thead class="thead-dark">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">First name</th>
                          <th scope="col">Last name</th>
                          <th scope="col">Instrument</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                      foreach ($xml->artist as $value) {
                          echo "<tr>";
                              echo "<th scope=\"row\">" . $value->attributes()->id . "</th>";
                              echo "<td>" . $value->attributes()->lastname . "</td>";
                              echo "<td>" . $value->attributes()->firstname . "</td>";
                              echo "<td>" . $value . "</td>";
                          echo "</tr>";
                      }
                  ?>
                  </tbody>
              </table>;

<!-- lecture du fichier -->
<?php

    echo"<h3>simplexml_load_file</h3>";
    $filename = "./artist.xml";
if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
    foreach ($xml->artist as $value) {
        echo"<p> $value ". $value->attributes()->firstname. $value->attributes()->lastname. "</p>";
    }
} else
    exit("Echec lors de l'ouverture du fichier $filename");

include "./footer.php";
?>