<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 03/04/2019
 * Time: 13:54
 */
$page = basename(__FILE__);
include "./header.php";
include "./navbar.php";
?>

    <script src="js/fake.js"></script>

    <!-- Example single danger button -->
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  onclick="fake_name();">
            Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="faker"></div>
    </div>
    <button type="button" class="btn btn-primary" onclick="fake_name();">Generate random name</button>
    <div class="container" style="padding-bottom: 45px;">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div id="randchart_container_id">
                    <!--<canvas id="randchart_canvas_id" ></canvas>-->
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>


    <!-- Formulaire -->
    <div class="container"><br/><br/>
        <!-- Important : Ne pas oublier le method="post" -->
        <form method="post">
            <div class="form-group">
                <label for="exampleInputNum">Combien de noms ?</label>
                <input type="number" name="num" class="form-control" id="num" aria-describedby="numHelp" placeholder="Nombre de noms" min="0" max="12">
            </div>
        </form>
        <!-- Le bouton exécute la fonction generate dans le javascript -->
        <button class="btn btn-primary" onclick="generate()">Envoyer</button>

        <br/><br/>

        <div class="dropdown">

            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false";>

                Dropdown button

            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="faker"></div>

        </div>



        <br/><br/>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


        <br/><br/>

<?php


include "./footer.php";
?>