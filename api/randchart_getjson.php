<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 03/04/2019
 * Time: 09:26
 */





	$data = [];

	for($i = 1; $i <= $_GET['nb_month']; $i++){
		$month = date('F', mktime(0, 0, 0, $i, 10));
		$temp = rand(-20,40);
		$array = array('month' => "$month", 'temp' => "$temp");
		array_push($data, $array);
	}
	//

	echo json_encode($data);



?>