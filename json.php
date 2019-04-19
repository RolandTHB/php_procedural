<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 02/04/2019
 * Time: 16:03
 */

$page= __FILE__;
include "./header.php";
include "./navbar.php";

$json = '{
    "root": {
    "artist": [
      {
          "id": "1",
        "lastname": "John",
        "firstname": "Coltrane",
        "instrument": "Saxophone"
      },
      {
          "id": "2",
        "lastname": "Miles",
        "firstname": "Davis",
        "instrument": "Trumpet"
      },
      {
          "id": "3",
        "lastname": "Blood",
        "firstname": "Hound",
        "instrument": "Piano"
      }
    ]
  }
}';

var_dump($json);

$parsed_json = json_decode($json);

    echo"<h3>Parse Json</h3>";
//    echo"<p>". $parsed_json->{'root'}->{'artist'}[0]->{'instrument'}. "</p>";
//    echo"<p>". $parsed_json->{'root'}->{'artist'}[1]->{'instrument'}. "</p>";

foreach ($parsed_json->{'root'}->{'artist'} as $value) {
    echo "<p>". $value->{'id'}. "&ocirc,". "é" . $value->{'instrument'}. "</p>";
}

include "./footer.php";
?>