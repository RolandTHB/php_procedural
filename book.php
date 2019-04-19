<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 08/04/2019
 * Time: 09:35
 * PHP PROCEDURALE connexion bdd, creation bdd, table, insert et affichage des données
 */

    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";
    //1) specifiy your own databse credentials
    $DB_HOST = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "testdrive";
    $DB_PORT = 3306;

        //        2) CONNEXION BDD
    $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD,"", $DB_PORT );
    if(!$mysqli){
        die("Connection failed: ". $mysqli->error);
    }

    // 3)  CREATE DATABASE

$query = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
try {
    // 4)  EXECUTE QUERY
    $result = $mysqli->query($query);
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success_alert">
        <?php echo "Database $DB_NAME created."?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
} catch (Exception $e) {
    //echo '<br>Exception received: ',  $e->getMessage(), "\n";
    print_alert("Database $DB_NAME not created.", "danger");
}  finally {
}
$mysqli->close();


// 4) CONNEXION BDD
$mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD,$DB_NAME, $DB_PORT );
if(!$mysqli){
    die("Connection failed: ". $mysqli->error);
}else{
    print_alert("Connection Database $DB_NAME success.", "success");
}



/*Utiliser cette syntaxe de $connect_error si vous devez assurer
 la compatibilité avec les versions de PHP avant 5.2.9 et 5.3.0. */
    if (mysqli_connect_error()){
        die('Erreur de connexion('.mysqli_connect_errno().')'
            .mysqli_connect_error());
    }else {
        print_alert("'Succès...' .$mysqli->host_info","success");
    }

    ?>
    <br/>
    <?php
    //
// requete "SELECT retourne un jeu de resultats
    $sql = "SELECT title FROM books LIMIT 10";
    if($result = $mysqli->query($sql)){
        var_dump($result);

        printf("SELECT a retourné %d lignes \n", $result->num_rows);
        //liberation du jeu de resultats
        $result->close();
    }

//requete "SELECT retourne un jeu de resultats
$sql = "SELECT title,price FROM books LIMIT 10";
    if($result = $mysqli->query($sql)){
       // recupere un tableau associatif
        while ($row = $result->fetch_assoc()) {
            printf("%s (%.3f €)\n",$row["title"],$row["price"]);
           // printf("16 decimal = %b binaire\n",5);
        }


        // LIBERATION DU JEU DE RESULTATS

        $result->close();
    }
    echo "<br/>";
    printf("16 decimal = %b binaire\n",5);

    // 5 DROP TABLE
    $database = "testdrive";
    $table = "car";
    $query = sprintf("DROP TABLE IF EXISTS $database.$table");
    try {

        // EXECUTE QUERY
        $result = $mysqli->query($query);
        echo "<br>Table $database.$table bien effacée";
        var_dump($result);
        //s'il y a une erreur, on tombe dans le catch
    } catch (Exception $e){
        echo '<br>Exception received: ', $e->getMessage(), "\n";
    } finally {
        //echo "<br>Table $table delete.";
    }

//6 CREATE TABLE CAR   $database = "testdrive";
    $table = "car";
    $query = sprintf(" CREATE TABLE IF NOT EXISTS $database.$table (
                                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
                                        price DECIMAL(5,2) NOT NULL,
                                        title VARCHAR(30) NOT NULL,
                                        created_at TIMESTAMP DEFAULT NOW(),
                                        updates_at TIMESTAMP DEFAULT NOW()
                            )"
    );
    try {
        //execute query
        $result = $mysqli->query($query);
    } catch (Exception $e) {
        echo '<br>Exception received: ', $e->getMessage(), "\n";

    } finally {
        print_alert("<br> Table $table created.", "success");
    }


// 7 INSERTION DE DONNEES DANS LA TABLE CAR
    //créer quatre voitures avec quatre prix sur une requete sql
    $sql = "INSERT INTO car
                    (price, title)
                VALUES
                    (10, 'Car 1'),
                    (15,'Car 2')
                ";

    if ($mysqli->query($sql) === TRUE) {
        print_alert("Création ligne dans table $table OK.", "success");
    } else {
        print_alert("Erreur création ligne dans table $table " . $mysqli->error, "danger");
    }

    // requete "SELECT retourne un jeu de resultats
    $sql = "SELECT title,price 
                  FROM car LIMIT 10";
    if($result = $mysqli->query($sql)){
        // recupere un tableau associatif
        while ($row = $result->fetch_assoc()) {
            printf("<br/>%s (%.3f €)\n",$row["title"],$row["price"]);
        }
        //liberation du jeu de resultats
        $result->close();
    }



// 8 QUERY TO GET DATA FROM THE TABLE
    $table = "books";
    $query = sprintf("SELECT id, title, price FROM $table ORDER BY id LIMIT 50");

    try {
        //execute query
        $result = $mysqli->query($query);

        $books_count = $result->num_rows;
        $books_id = array();
        $books_title = array();
        $books_price = array();
        // loop through the  returned data with assoc
        ?>


    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
                echo' <tr>
                          <th scope=\"row">'.$row["id"].'</th>
                          <td>'.$row["title"].'</td>
                          <td>'.$row["price"].'</td>
                      </tr>';

                $books_id[] = $row["id"];
                $books_title[] = $row["price"];
                $books_price[] = $row["title"];
            }
        } catch (Exception $e) {
            echo '<br>Exception received: ', $e->getMessage(), "\n";
        } finally {
            print_alert("<br> Success", "success");
        }
        ?>
      </tbody>
    </table>

<?php

/* ================================================================ CREER REQUETE PREPAREE ========================================================================================
===========================================================================================================================================================================*/

    $search_title = "o%";
    $search_price = 20;

if ($stmt = $mysqli->prepare("SELECT title, price FROM books WHERE title LIKE ? AND price < ? LIMIT 5")) {
    /*lecture des marqueurs */
    // float 'd'
    // integer 'i'
    //string 's'
    //blob 'b'
    $stmt->bind_param("sd", $search_title, $search_price);
    /*execution de la requete*/
    $stmt->execute();
    /*lecture des variables resultantes*/
    $stmt->bind_result($title,$price);
    /*recuperation des valeurs*/
    $stmt->fetch();
    $message = sprintf("The book '%s' which cost %d is in my bookstore", $title, $price);
    print_alert("$message", "info");
    /*fermeture du traitement*/
    $stmt->close();
}





// CREATION CLASS BOOK MODELE POUR CREER LIVRE
    class Book {
            //member variables

            var $price;
            var $title;

            /**
             * Book constructor.
             * @param $price
             * @param $title
             */
            public function __construct($price=0, $title="")
            {
                $this->price = $price;
                $this->title = $title;
            }




            // setter function
            function setPrice($par) {
                $this -> price = $par;
            }
            //getter function
            function getPrice() {
                echo $this->price. "</br>";
            }
            function setTitle ($par) {
                $this -> title = $par;
            }
            function getTitle() {
                echo $this->title. '</br>';
            }

            // fonction destructor
            function __destruct ()
            {
                //your code
                echo "Destruct Object haha ";

            }
        }
        echo"<br/>";
        echo"<br/>";
        echo"<br/>";
        //creation objet

        $physics = new Book;
        $maths = new Book;
        $history = new Book(45, "Europe");

        //recuperer le nom d'une classe
        echo "<br/>Retourne le nom d'une classe";
        echo"<br/>" .get_class($physics);

    //recuperer les methodes d'une classe

    echo "<br/>Retourne les noms des methodes d'une classe";
            foreach (get_class_methods($physics) as $method_name){
                echo "<br/>$method_name";

}


        //set title & price

        $physics->setTitle("Atoms");
        $maths->setTitle("Algebra");

        $physics->setPrice(10);
        $maths->setPrice(7);



            //get title & price

        $physics->getTitle();
        $maths->getTitle();
        $physics->getPrice();
        $maths->getPrice();

        var_dump($maths);
        var_dump($physics);
        var_dump($history);





        echo"<br/>";
        echo"<br/>";
        echo"<br/>";

        $mysqli->close();

    include "./footer.php";
?>