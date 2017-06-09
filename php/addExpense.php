<?php
	include "connection.php";
	$id_veh 		= $_POST['id_veh'];
	$type 			= $_POST['type'];
	$date 			= $_POST['date'];
	$km 			= $_POST['km'];
	$price 			= $_POST['price'];
	$fuelq 			= $_POST['fuelq'];
	$fuelc 			= $_POST['fuelc'];
	$fuels			= $_POST['fuels'];
	$fuelkm			= $_POST['fuelkm'];
	$description 	= $_POST['description'];

	if($type == "fueling") {
		$fuelc			= !empty($fuelc) 		? "'".$fuelc."'" 					: "NULL";
		$fuels			= !empty($fuels) 		? "'".$fuels."'" 					: "NULL";
		$fuelkm			= !empty($fuelkm) 		? "'".$fuelkm."'" 					: "NULL";
		$description	= !empty($description) 	? "'".$description."'" 				: "NULL";

			$sql = 'INSERT INTO expenses VALUES (
				NULL,
				'.$id_veh.',
				"'.$type.'",
				STR_TO_DATE("'.$date.'", "%d/%m/%Y"),
				'.$km.',
				"'.$description.'",
				'.$fuelkm.',
				'.$fuelq.',
				'.$fuelc.',
				'.$fuels.',
				'.$price.')';
			$result = $con->query($sql);
	} else {
			$sql = 'INSERT INTO expenses VALUES (
				NULL,
				'.$id_veh.',
				"'.$type.'",
				STR_TO_DATE("'.$date.'", "%d/%m/%Y"),
				'.$km.',
				"'.$description.'",
				NULL,
				NULL,
				NULL,
				NULL,
				'.$price.')';
			$result = $con->query($sql);
	}
	//http://llenoporfavor.es/php/addExpense.php?id_veh=10&type=Mantenimiento&date=27/07/1990&price=70.12&km=113123&description=tengountractoramarillo
	//http://llenoporfavor.es/php/addExpense.php?id_veh=10&type=fueling&date=27/07/1990&price=70.12&km=113123&description=quesloquesellevahora&fuelq=70.12&fuelkm=912&fuelc=6.6&fuels=70
?>