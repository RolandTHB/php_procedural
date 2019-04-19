<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 10/04/2019
 * Time: 11:50
 */
?>

<?php
    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";
    //1) specifiy your own databse credentials
    var_dump($_GET);
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_HOST = "localhost";
    $DB_NAME = "testdrive";
    $DB_PORT = 3306;
    $DSN = "mysql:dbname=$DB_NAME;$DB_HOST:$DB_PORT";

        //2) CONNEXION BDD  AVEC INVOCATION DE PILOTE
    try {
        $conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        print_alert("Connexion success", "success");
    } catch (PDOException $e) {
        print_alert("Connexion echouée :".$e ->getMessage(),"danger");
    } finally {
    }
    ?>
    <!--recuperer le nom d'une classe-->
    <div class="card">
        <div class="card-body">
            <?php
            echo "<br/>Retourne le nom d'une classe";
            echo"<br/>" .get_class($conn);
            ?>
        </div>
    </div>
    <!-- recuperer les methodes d'une classe -->
    <div class="card">
        <div class="card-body">
            <?php
            echo "<br/>Retourne les noms des methodes d'une classe";
            foreach (get_class_methods($conn) as $method_name) {
                echo "<br/>$method_name";
            }
            ?>
        </div>
    </div>



<?php

    // 5) DROP TABLE AVEC QUERY

    $table = "car";
    $query = sprintf("DROP TABLE IF EXISTS $DB_NAME.$table");
    try {
        /*   EXECUTE QUERY */
        $result = $conn->query($query);
        print_alert("Suppression de la table $table OK.", "success");
        //s'il y a une erreur, on tombe dans le catch
    } catch (PDOException $e){
        print_alert("Suppression de la table $table échouée" . $e->getMessage(), "danger");
    } finally {
    }


//6 CREATE TABLE CAR    $database = "testdrive";
    $table = "car";

    $query = sprintf(" CREATE TABLE IF NOT EXISTS $DB_NAME.$table (
                                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
                                        price DECIMAL(5,2) NOT NULL,
                                        title VARCHAR(30) NOT NULL,
                                        created_at TIMESTAMP DEFAULT NOW(),
                                        updates_at TIMESTAMP DEFAULT NOW()
                            )"
    );
    try {
        //execute query
        $result = $conn->query($query);
        print_alert("<br> Table $table created.", "success");
    } catch (Exception $e) {

        print_alert("<br>Exception received: ", $e->getMessage(), "danger");

    } finally {

    }


//7 INSERTION DE DONNEES DANS LA TABLE CAR
    //créer quatre voitures avec quatre prix sur une requete sql
    $sql = "INSERT INTO car
                    (price, title)
                VALUES
                    (20, 'Car 1'),
                    (40,'Car 2')
                ";
    try {
        $result = $conn->exec($sql);
        var_dump ($result);
        print_alert("Création ligne dans table car OK.", "success");
        $result = $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        echo "last id= $last_id";
    } catch (PDOException $e) {
        print_alert("Erreur création ligne dans table car" . $e->getMessage(), "danger");
    }

    // test et insertion de bp données

    $book_title = "Ruby";
    $book_price = '28,60';
    $sql = $conn->prepare('INSERT INTO books (title, price) VALUES (:book_title, :book_price)');
    $sql->bindParam('book_price', $book_price, PDO::PARAM_INT);
    $sql->bindParam('book_title', $book_title, PDO::PARAM_STR);
    try {
        $sql->execute();
        print_alert("Insert $book_title $book_price is OK ", "success");
    } catch(PDOException $e) {
        print_alert("Insert $book_title $book_price is KO ", "success");
    }

    for ($i=1; $i<10000; $i++) {
        $book_title = "book$i";
        $book_price = rand(10, 100);
        try {
            $sql->execute();
        } catch (PDOException $e) {
        }
    }




//8 QUERY TO GET DATA FROM THE TABLE
    $table = "books";
    $table2 = "car";
    $query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 50";
    $delete = "DELETE FROM $table WHERE id=";

    try {
        //execute query
        $result = $conn->query($query);

        $books_count = $result->rowCount();
        echo"<br/>book_count = $books_count";
        // loop through the  returned data with assoc
        ?>
        <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Delete Get</th>
            <th scope="col">Delete Post</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch()) {
            echo' <tr>
                        <th scope=\"row">'.$row["id"].'</th>
                        <td>'.$row["title"].'</td>
                         <td>'.$row["price"].'</td>
                         <td><a class="btn btn-outline-danger btn-sm" href="book_pdo.php?id_delete='.$row["id"].'">Delete</a></td>
                         <td>
                         <form method="post" action="book_pdo.php">
                            <input  type="hidden" value="' . $row['id'] . '" name="id_delete" class="form-control" id="id_delete" aria-describedby="brandcar">
                            <button type="submit" value="add" class="btn btn-outline-success btn-sm">delete Post</button>
                            </form>
                            </td>
                   </tr>';
            $books_id[] = $row["id"];
            $books_title[] = $row["price"];
            $books_price[] = $row["title"];
        }
        print_alert("<br> Tableau create", "success");
    } catch (PDOException $e) {
        echo '<br>Exception received: ', $e->getMessage(), "\n";
    } finally {

    }

        // 7) Essai de supprimer une ligne grace au get
        if(isset($_GET['id_delete']) && $_GET['id_delete'] !== "" ){ //si get est trouvé et pas vide
            //echo $_GET['id_delete'];
            try{
                $sql = "DELETE FROM $table WHERE  id = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $_GET['id_delete'], PDO::PARAM_INT);
                $res = $stmt->execute();
                print_alert("suppression de ma ligne dans ma table $table OK.", "success");
            }catch (PDOException $e) {
                print_alert("Erreur suppression de ma ligne dans ma table $table" . $e->getMessage(), "danger");
            }
        }
        // 7) Essai de supprimer une ligne grace au formulaire POST
        if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){ //si get est trouvé et pas vide
            //echo $_POST['id_delete'];
            try{
                $sql = "DELETE FROM $table WHERE  id = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
                $res = $stmt->execute();
                print_alert("suppression de ma ligne dans ma table $table OK.", "success");
            }catch (PDOException $e) {
                print_alert("Erreur suppression de ma ligne dans ma table $table" . $e->getMessage(), "danger");
            }
        }
//    // 8) Afficher les colonnes avec un fetchColumn
//    $query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 5";
//    try {
//        //execute query
//        $result = $conn->query($query);
//        // $count = $result->rowCount();
//        while($col = $result->fetchColumn(1)) {
//            // withassociative or numeric
//            var_dump ($col);
//        }
//    } catch (PDOException $e) {
//        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
//        print_alert("Query $query not executed." . $e->getMessage(), "danger");
//    } finally {
//    }

// 8) Afficher les données avec fetchAll
$query = "SELECT title FROM $table2 ORDER BY id LIMIT 10";
try {
    //execute query
    $result = $conn->query($query);
    $car_title = $result->fetchAll(PDO::FETCH_COLUMN, 0);
} catch (PDOException $e) {
    print_alert("Query $query not executed." . $e->getMessage(), "danger");
} finally {
}
var_dump (json_encode($car_title) );

// 8) Afficher les données avec fetchAll
$query = "SELECT price FROM $table2 ORDER BY id LIMIT 10";
try {
    //execute query
    $result = $conn->query($query);
    $car_price = $result->fetchAll(PDO::FETCH_COLUMN, 0);
} catch (PDOException $e) {
    print_alert("Query $query not executed." . $e->getMessage(), "danger");
} finally {
}
var_dump (json_encode($car_price) );
        ?>
    </tbody>
    </table>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        //Insertion des données dans le graphique en récupérant les deux tableaux.
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                //Récupération du tableau 1
                labels: <?=json_encode($car_title)?>,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: [
                        <?php
                        $avg = get_average($car_price);
                        for ($i=0; $i<count($car_price); $i++) {
                            if ($car_price[$i] > $avg) {
                                echo "'rgba(254, 62, 35, 0.3)',";
                            } else {
                                echo "'rgba(54, 162, 235, 0.3)',";
                            }
                        }
                        ?>
                    ],
                    borderColor: 'rgb(2, 99, 12)',
                    //Récupération du tableau 2
                    data: <?php echo json_encode($car_price); ?>
                }]
            },            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <?php

    function get_average( array $array_arg) :float {
        $average = 0;
        $sum = 0;
        foreach ($array_arg as $value) {
            $sum += $value;
        }
        return $sum/count($array_arg);
    }
    ?>

<?php

// 9) créer une requête préparée
if( isset($_GET['fprice']) && isset($_GET['ftitle']) ){
    try{
        $sql = "INSERT INTO $table2 (price, title) VALUES (:price, :title)";
        $result = $conn->prepare($sql);
        $result->bindValue(':price', $_GET['fprice']);
        $result->bindValue(':title', $_GET['ftitle']);
        $res = $result->execute();
        var_dump($res);
        print_alert("Ajout ligne dans table $table2 OK.", "success");
    } catch (Exception $e) {
        print_alert("Erreur ajout ligne dans table $table2" . $e->getMessage(), "danger");
    }
}

?>

<!-- formulaire -->
<div class="container">
        <form method="post">
            <div class="form-group">
                <label for=exampletitle">Title</label>
                <input type="text" class="form-control" name="title" id="titleId" aria-describedby="titleHelp" placeholder="Enter title">
                <small id="titleHelp" class="form-text text-muted">We'll never share your title with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleprice">Price</label>
                <input type="number" class="form-control" name="price" id="priceId" placeholder="Price">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

    <?php
        var_dump($_POST);
        // 9) créer une requete post
        if( isset($_POST['title']) && isset($_POST['price']) ){
            try{
                $sql = "INSERT INTO $table2 (price, title) VALUES (:price, :title)";
                $result = $conn->prepare($sql);
                $result->bindParam(':price', $_POST['price']);
                $result->bindParam(':title', $_POST['title']);
                $res = $result->execute();
                var_dump($res);
                print_alert("Ajout ligne dans table $table2 OK.", "success");
            } catch (Exception $e) {
                print_alert("Erreur ajout ligne dans table $table2" . $e->getMessage(), "danger");
            }
        }
    ?>

<?php
//
////CREER REQUETE PREPAREE
//
//    $search_title = "o%";
//    $search_price = 20;
//
//if ($stmt = $mysqli->prepare("SELECT title, price FROM books WHERE title LIKE ? AND price < ? LIMIT 5")) {
//    /*lecture des marqueurs */
//    // float 'd'
//    // integer 'i'
//    //string 's'
//    //blob 'b'
//    $stmt->bind_param("sd", $search_title, $search_price);
//    /*execution de la requete*/
//    $stmt->execute();
//    /*lecture des variables resultantes*/
//    $stmt->bind_result($title,$price);
//    /*recuperation des valeurs*/
//    $stmt->fetch();
//    $message = sprintf("The book '%s' which cost %d is in my bookstore", $title, $price);
//    print_alert("$message", "info");
//    /*fermeture du traitement*/
//    $stmt->close();
//}
//
//
//
//
//
////CREATION CLASS BOOK MODELE POUR CREER LIVRE
//    class Book {
//        //member variables
//
//        var $price;
//        var $title;
//
//        /**
//         * Book constructor.
//         * @param $price
//         * @param $title
//         */
//        public function __construct($price=0, $title="")
//        {
//            $this->price = $price;
//            $this->title = $title;
//        }
//
//
//
//
//        // setter function
//        function setPrice($par) {
//            $this -> price = $par;
//        }
//        //getter function
//        function getPrice() {
//            echo $this->price. "</br>";
//        }
//        function setTitle ($par) {
//            $this -> title = $par;
//        }
//        function getTitle() {
//            echo $this->title. '</br>';
//        }
//
//        // fonction destructor
//        function __destruct ()
//        {
//            //your code
//            echo "Destruct Object haha ";
//
//        }
//    }
//        echo"<br/>";
//        echo"<br/>";
//        echo"<br/>";
//        //creation objet
//
//        $physics = new Book;
//        $maths = new Book;
//        $history = new Book(45, "Europe");
//
//
//    //    //set title & price
//    //
//    //    $physics->setTitle("Atoms");
//    //    $maths->setTitle("Algebra");
//    //
//    //    $physics->setPrice(10);
//    //    $maths->setPrice(7);
//    //
//    //
//    //
//    //        //get title & price
//    //
//    //    $physics->getTitle();
//    //    $maths->getTitle();
//    //    $physics->getPrice();
//    //    $maths->getPrice();
//
//        var_dump($maths);
//        var_dump($physics);
//        var_dump($history);
//
//
//
//
//
//        echo"<br/>";
//        echo"<br/>";
//        echo"<br/>";
//
//        $mysqli->close();

    include "./footer.php";
?>

