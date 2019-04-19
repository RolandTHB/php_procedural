<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 12/04/2019
 * Time: 13:53
 */

    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";

    //  Definition des variables
    $db_config = array();
    $db_config['PDO_SGBD']      = 'mysql';
    $db_config['PDO_PORT']      = '3306';
    $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
    $db_config['PDO_DB_NAME']   = '';
    $db_config['PDO_USER']      = 'root';
    $db_config['PDO_PASSWORD']  = '';
    $db_config['PDO_OPTIONS']   = array(
        // Activation des exceptions PDO :
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );



    //1)Connexion to server

    try {
        // Connexion
        $db = new PDO(
            $db_config['PDO_SGBD'] . ':host=' .
            $db_config['PDO_HOST'] .
            ';dbname='. $db_config['PDO_DB_NAME'],
            $db_config['PDO_USER'],
            $db_config['PDO_PASSWORD'],
            $db_config['PDO_OPTIONS']
        );
        // Alerte
        print_alert("Connexion bdd réussie", "success");
        var_dump($db);
    } catch (PDOException $e) {
        // Alerte
        print_alert("Connexion bdd échoué" . $e->getMessage(), "danger");
    }


    //2)Create database

    $db_config['PDO_DB_NAME'] = 'roland_tabet';
    $bdd=$db_config['PDO_DB_NAME'];

    $sql = "
                    CREATE DATABASE IF NOT EXISTS $bdd
                    CHARACTER SET utf8 
                    COLLATE utf8_general_ci
                ";
    try {
        $request = $db->query($sql);
        // Alerte
        print_alert("Création bdd $bdd réussie", "success");
        var_dump ($request);
    } catch (PDOException $e) {
        print_alert("Création bdd $bdd  échoué" . $e->getMessage(), "danger");
    } finally {
        // On supprime cette variable par sécurité
//        unset($bdd);
    }

    //3 log out to database

    try {
        $db = null;
        // Alerte
        print_alert("Deconnection bdd  réussie", "success");
        var_dump($db);
    } catch (PDOException $e) {
        print_alert("Deconnection bdd  échoué" . $e->getMessage(), "danger");
    }
    //4) connect to database

    try {
        // Connexion
        $db = new PDO(
            $db_config['PDO_SGBD'] . ':host=' .
            $db_config['PDO_HOST'] .
            ';dbname='. $bdd,
            $db_config['PDO_USER'],
            $db_config['PDO_PASSWORD'],
            $db_config['PDO_OPTIONS']
        );
        // Alerte
         print_alert("Connexion bdd $bdd réussie", "success");
         var_dump($db);
    } catch (PDOException $e) {
        // Alerte
        print_alert("Connexion bdd $bdd échoué" . $e->getMessage(), "danger");
    } finally {
        // On supprime ce tableau par sécurité
        unset($db_config);
    }
    //5) create two table users and roles
    $TB_NAME = "users";
    $TB_NAME2 = "roles";

    $sql = "
                    CREATE TABLE IF NOT EXISTS $TB_NAME (
                        u_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        id_role INT(6) UNSIGNED NOT NULL,
                        u_name VARCHAR(30) NOT NULL ,
                        u_email VARCHAR(50) NOT NULL ,
                        u_password VARCHAR(255) NOT NULL ,
                        created_at TIMESTAMP DEFAULT  NOW(),
                        updated_at TIMESTAMP DEFAULT  NOW()
                    )
                ";
    try {
        $request = $db->query($sql);
        // Alerte
        print_alert("Creation table $TB_NAME reussie", "success");
        var_dump($request);
    } catch (PDOException $e) {
        print_alert("Creation table $TB_NAME échouée" . $e->getMessage(), "danger");
    }

    $sql2 = "
                        CREATE TABLE IF NOT EXISTS $TB_NAME2 (
                            r_id INT(6) UNSIGNED PRIMARY KEY,
                            r_name VARCHAR(30) NOT NULL,
                            created_at TIMESTAMP DEFAULT  NOW(),
                            updated_at TIMESTAMP DEFAULT  NOW()
                        )
                    ";
    try {
        $request = $db->query($sql2);
        // Alerte
        print_alert("Creation table $TB_NAME2 reussie", "success");
        var_dump($request);
    } catch (PDOException $e) {
        print_alert("Creation table $TB_NAME2 échouée" . $e->getMessage(), "danger");
    }

    //6) insert in table roles 3 lines

    $sql = "
                    INSERT INTO $TB_NAME2
                      (r_id, r_name) 
                    VALUES
                           (1, 'admin'), 
                          (2, 'operator'),
                           (3, 'client')
                ";
    try {
        $request = $db->query($sql);
        $roles_count = $request->rowCount();
        // Alerte
        print_alert("Insertion $roles_count lignes réussie", "success");
        var_dump($request);
    } catch (PDOException $e) {
        print_alert("Insertion ligne échouée" . $e->getMessage(), "danger");
    }

    // 6 bis) insert in table user

$sql = "
                    INSERT INTO $TB_NAME
                      (id_role, u_name, u_email, u_password) 
                    VALUES
                           (1, 'user1', 'user1@test.net', 'mdp1'), 
                          (2, 'user2', 'user2@test.net', 'mdp2'), 
                           (3, 'user3', 'user3@test.net', 'mdp3')
                ";
try {
    $request = $db->query($sql);
    $roles_count = $request->rowCount();
    // Alerte
    print_alert("Insertion $roles_count lignes réussie", "success");
    var_dump($request);
} catch (PDOException $e) {
    print_alert("Insertion ligne échouée" . $e->getMessage(), "danger");
}


    //7) create roles with for

    $id_role = '1';
    $u_name = "user";
    $u_email = "user@test.net";
    $u_password = "mdp";
    $sql = $db->prepare('INSERT INTO $TB_NAME (id_role, u_name, u_email, u_password) VALUES (:user_id_role, :user_u_name, :user_u_email, :user_u_password)');
    $sql->bindParam('user_id_role', $user_id_role, PDO::PARAM_INT);
    $sql->bindParam('user_u_name', $user_u_name, PDO::PARAM_STR);
$sql->bindParam('user_u_email', $user_u_email, PDO::PARAM_STR);
$sql->bindParam('user_u_password', $user_u_password, PDO::PARAM_STR);

try {
        $sql->execute();
        print_alert("Insert $id_role $u_name $u_email $u_password is OK ", "success");
    } catch(PDOException $e) {
        print_alert("Insert $id_role $u_name $u_email $u_password KO ", "danger");
    }

    for ($i=1; $i<6; $i++) {
        $u_name = "user$i";
        $u_email = "$u_name@test.net";
        $u_password = "Password";
        try {
            $sql->execute();
        } catch (PDOException $e) {
        }
    }


    //8) display board with users list and roles with buttons
    // +10) fonction delete a user

    $query = "SELECT u_id, id_role, u_name, u_email, u_password FROM $TB_NAME ORDER BY u_id LIMIT 10";
    $delete = "DELETE FROM $TB_NAME WHERE u_id=";

    try {
        //execute query
        $result = $db->query($query);

        $users_count = $result->rowCount();
        echo"<br/>users_count = $users_count";
        // loop through the  returned data with assoc
        ?>
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id_role</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
        <?php
        while ($row = $result->fetch()) {
            echo' <tr>
                            <th scope=\"row">'.$row["u_id"].'</th>
                            <td>'.$row["id_role"].'</td>
                             <td>'.$row["u_name"].'</td>
                              <td>'.$row["u_email"].'</td>
                             <td><a class="btn btn-outline-danger btn-sm" href="seed_pdo.php?id_delete='.$row["u_id"].'">Delete</a></td>
                             <td>
                                <form method="post" action="seed_pdo.php">
                                     <input  type="hidden" value="' . $row['u_id'] . '" name="id_delete" class="form-control" id="id_delete" aria-describedby="user">
                                <button type="submit" value="add" class="btn btn-outline-success btn-sm">Delete Post</button>
                                </form>
                               </td>
                               <td><a class="btn btn-outline-light btn-sm" href="seed_pdo.php?id_read='.$row["u_id"].'">Read</a></td>
                               <td><a class="btn btn-outline-warning btn-sm" href="seed_pdo.php?id_update='.$row["u_id"].'">Update</a></td>
                       </tr>';
            $users_id[] = $row["u_id"];
            $users_id_role[] = $row["id_role"];
            $users_name[] = $row["u_name"];
            $users_email[] = $row["u_email"];
            $users_password[] = $row["u_password"];
        }
        print_alert("<br> Tableau create", "success");
    } catch (PDOException $e) {
        echo '<br>Exception received: ', $e->getMessage(), "\n";
    } finally {

    }


    //9) function create a user with form
    ?>

<!-- formulaire -->
<div class="container">
        <form method="post">
            <div class="form-group">
                <label for=exampletitle">id_role</label>
                <input type="number" class="form-control" name="id_role" id="id_roleId" aria-describedby="titleHelp" placeholder="Enter id_role">

            </div>
            <div class="form-group">
                <label for="exampleprice">Name</label>
                <input type="text" class="form-control" name="u_name" id="nameId" placeholder="name">
            </div>
            <div class="form-group">
                <label for="exampleprice">Email</label>
                <input type="email" class="form-control" name="u_email" id="emailId" placeholder="email">
            </div>
            <div class="form-group">
                <label for="exampleprice">Password</label>
                <input type="text" class="form-control" name="u_password" id="passwordId" placeholder="password">
                <small id="titleHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

    <?php
        var_dump($_POST);
        // 9) créer une requete post
        if( isset($_POST['id_role']) && isset($_POST['u_name']) && isset($_POST['u_email']) && isset($_POST['u_password']) ){
            try{
                $sql = "INSERT INTO $TB_NAME (id_role, u_name, u_email, u_password) VALUES (:id_role, :u_name, :u_email, :u_password)";
                $result = $db->prepare($sql);
                $result->bindParam(':id_role', $_POST['id_role']);
                $result->bindParam(':u_name', $_POST['u_name']);
                $result->bindParam(':u_email', $_POST['u_email']);
                $result->bindParam(':u_password', $_POST['u_password']);
                $res = $result->execute();
                var_dump($res);
                print_alert("Ajout ligne dans table $TB_NAME OK.", "success");
            } catch (Exception $e) {
                print_alert("Erreur ajout ligne dans table $TB_NAME" . $e->getMessage(), "danger");
            }
        }

    //10) function delete a user see 8)

    // Essai de supprimer une ligne grace au get
    if(isset($_GET['id_delete']) && $_GET['id_delete'] !== "" ){ //si get est trouvé et pas vide
        //echo $_GET['id_delete'];
        try{
            $sql = "DELETE FROM $TB_NAME WHERE  u_id = ? ";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, $_GET['id_delete'], PDO::PARAM_INT);
            $res = $stmt->execute();
            print_alert("suppression de ma ligne dans ma table $TB_NAME OK.", "success");
        }catch (PDOException $e) {
            print_alert("Erreur suppression de ma ligne dans ma table $TB_NAME" . $e->getMessage(), "danger");
        }
    }

    // Essai de supprimer une ligne grace au formulaire POST
    if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){ //si get est trouvé et pas vide
        //echo $_POST['id_delete'];
        try{
            $sql = "DELETE FROM $TB_NAME WHERE  u_id = ? ";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
            $res = $stmt->execute();
            print_alert("suppression de ma ligne dans ma table $TB_NAME OK.", "success");
        }catch (PDOException $e) {
            print_alert("Erreur suppression de ma ligne dans ma table $TB_NAME" . $e->getMessage(), "danger");
        }
    }

    //11 read a user

//if(isset($_GET['id_read']) && $_GET['id_read'] !== "" ){ //si get est trouvé et pas vide
//    //echo $_GET['id_read'];
//    try{
//        $sql = "SELECT * FROM $TB_NAME WHERE  u_id = ? ";
//        $stmt = $db->prepare($sql);
//        $stmt->bindValue(1, $_GET['id_read'], PDO::PARAM_INT);
//        $res = $stmt->execute();
//        print_alert("Lecture de ma ligne dans ma table $TB_NAME OK.", "success");
//    }catch (PDOException $e) {
//        print_alert("Erreur de lecture de ma ligne dans ma table $TB_NAME" . $e->getMessage(), "danger");
//    }
//}

if(isset($_GET['id_read']) && $_GET['id_read'] !== "" ) {
    // Selection de la ligne
    try {
        $select_user = $db->prepare("SELECT * FROM $TB_NAME WHERE u_id = ?");
        $select_user->execute(array($_GET['id_read']));
        $user = $select_user->fetch();
    } catch(PDOException $e) {
        print_alert("Erreur de lecture de ma ligne dans ma table $TB_NAME" . $e->getMessage(), "danger");
    }

    if($user) {?>
        <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Id_role</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
            </tr>
            </thead>
            <tbody><?php echo'
							<tr>
								<th scope="row">' . $user['u_id'] . '</th>
								<td>' . $user['u_name'] . '</td>
								<td>' . $user['u_email'] . '</td>
								<td>' . $user['u_password'] . '</td>
								<td>' . $user['u_password'] . '</td>
								<td>
									<a href="./index.php" class="btn btn-primary">Retour à la liste</a>
								</td>
							</tr>
						';?>
            </tbody>
        </table>
        </div>
   <?php }
    }

     else {

    }
    //12 update a user




include "./footer.php";
?>