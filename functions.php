<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 09/04/2019
 * Time: 09:45
 */



function print_alert($message, $class = "danger") {
    echo "<div class=\"alert alert-$class alert-dismissible fade show\" role=\"alert\">";
    echo $message;
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
}


?>


