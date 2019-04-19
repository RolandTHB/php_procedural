    <?php
    /**
     * Created by PhpStorm.
     * User: HB
     * Date: 01/04/2019
     * Time: 10:50
     */

    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
//    $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
//    $data = [0, 10, 5, 2, 20, 30, 45];
    $labels = [];
    $data = [];


    for ($i=0; $i < 12 ; $i++){
        array_push($labels, date('F', mktime(0, 0, 0, $i, 10)));
        array_push($data, rand(-45, 45));
    }
    var_dump($labels);
    var_dump($data);

// mois actuel en premier

    $numMois = date("n");
    var_dump($numMois);

    for($i=0; $i< $numMois; $i++){
        //Première méthode en deux lignes.
        //$month = array_shift($labels);
        //array_push($labels,$month);
        //$dataa = array_shift($data);
        //array_push($data,$dataa);

        //Deuxième méthode en deux lignes et mise à jour des datas.
        array_push($labels,array_shift($labels));
        array_push($data,array_shift($data));

    }

    ?>

    <!-- Formulaire avec méthode post -->
    <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputAge">Mois à afficher</label>
            <input type="number" name="mois" class="form-control" id="mois" aria-describedby="ageHelp" placeholder="Entrez votre nombre ">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
       <!-- // affiche le nombre de mois de l'user -->
            <?php
    $nbPop = intval(count($labels) - $_POST['mois']);

            for ($i = 0; $i < $nbPop; $i++) {
                array_pop($labels);
                array_pop($data);
            }


?>

    <canvas id="myChart"></canvas>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels:
                <?php echo json_encode($labels) ?>,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(0, 44, 91)',
                    borderColor: 'rgb(251, 0, 0)',
                    data:
                    <?php echo json_encode($data) ?>
                }]
            },

            // Configuration options go here
            options: {}
        });

    </script>

    <?php
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    include "./footer.php";
    ?>