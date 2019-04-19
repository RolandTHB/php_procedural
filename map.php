<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 04/04/2019
 * Time: 10:51
 */


       $page = basename(__FILE__);
       include "./header.php";
       include "./navbar.php";
   ?>
<script src="js/map.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <style type="text/css">
                #map {
                    /* Map must have a with and an height */
                    height: 500px;
                    width: 500px;
                }
            </style>
            <title>Carte</title>
            <div id="map">
                <!-- The map will be here -->
            </div>
            </div>


        <div class="col-md-6 ">
            <!-- creation formulaire -->
            <form method="post">
                <div class="form-group">
                    <label for="adress" class = "font-weight-bold">Adress</label>
                    <input type="string" name="adress" class="form-control" placeholder="Adress">
                </div>

                <button type="submit" class="btn btn-danger" onclick="">Envoyer</button>
            </form>
        </div>
</div>
    </div>
<?php
    include "./footer.php";
  ?>
