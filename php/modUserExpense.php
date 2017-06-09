<?php
	include "connection.php";
	$id_exp 		= $_POST['id'];
	$type 			= $_POST['type'];
	$date 			= $_POST['date'];
	$km 			= $_POST['km'];
	$price 			= $_POST['price'];
	$fuelq 			= $_POST['fuelq'];
	$fuelc 			= $_POST['fuelc'];
	$fuels			= $_POST['fuels'];
	$fuelkm			= $_POST['fuelkm'];
	$description 	= $_POST['description'];

	$sql 	= "SELECT * FROM expenses WHERE id_exp= ".$id_exp;
	$result = $con->query($sql);
	$row 	= mysqli_fetch_array($result);


	if($type == "fueling") {
		$fuelc			= !empty($fuelc) 		? $fuelc						: "NULL";
		$fuels			= !empty($fuels) 		? $fuels 						: "NULL";
		$fuelkm			= !empty($fuelkm) 		? $fuelkm						: "NULL";
		$description	= !empty($description) 	? $description					: "NULL";

		$sql2	 = "UPDATE expenses SET";
		if ($type != $row['type'] && strlen($type) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", type= '".$type."'";
			else 																		$sql2 .= " type= '".$type."'";
		}  						
		if (strtotime($date) != strtotime($row['date']) && strlen($date) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", bdate= STR_TO_DATE('".$date."', '%d/%m/%Y')";
			else 																		$sql2 .= " bdate= STR_TO_DATE('".$date."', '%d/%m/%Y')";
		}  						
		if ($km != $row['km'] && strlen($km) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", km= '".$km."'";
			else 																		$sql2 .= " km= '".$km."'";
		}		
		if ($price != $row['price'] && strlen($price) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", price= '".$price."'";
			else 																		$sql2 .= " price= '".$price."'";
		}
		if ($description != $row['description'] && strlen($description) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", description= '".$description."'";
			else 																		$sql2 .= " description= '".$description."'";
		}	 
		if ($fuelq != $row['fuel_quantity'] && strlen($fuelq) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", fuel_quantity= '".$fuelq."'";
			else 																		$sql2 .= " fuel_quantity= '".$fuelq."'";
		}  						
		if ($fuelc != $row['fuel_cb_consumption'] && strlen($fuelc) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", fuel_cb_consumption= '".$fuelc."'";
			else 																		$sql2 .= " fuel_cb_consumption= '".$fuelc."'";
		}	
		if ($fuels != $row['fuel_cb_speed'] && strlen($fuels) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", fuel_cb_speed= '".$fuels."'";
			else 																		$sql2 .= " fuel_cb_speed= '".$fuels."'";
		}  						
		if ($fuelkm != $row['fuel_km'] && strlen($fuelkm) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", fuel_km= '".$fuelkm."'";
			else 																		$sql2 .= " fuel_km= '".$fuelkm."'";
		}
		$sql2 .= " WHERE id_exp = ".$id_exp;
		$result2 = $con->query($sql2);
	} else {
		$sql2	 = "UPDATE expenses SET";
		if ($type != $row['type'] && strlen($type) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", type= '".$type."'";
			else 																		$sql2 .= " type= '".$type."'";
		}  						
		if (strtotime($date) != strtotime($row['date']) && strlen($date) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", bdate= STR_TO_DATE('".$date."', '%d/%m/%Y')";
			else 																		$sql2 .= " bdate= STR_TO_DATE('".$date."', '%d/%m/%Y')";
		}  						
		if ($km != $row['km'] && strlen($km) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", km= '".$km."'";
			else 																		$sql2 .= " km= '".$km."'";
		}		
		if ($price != $row['price'] && strlen($price) != 0){
			if (strpos($sql2,'=') !== false)											$sql2 .= ", price= '".$price."'";
			else 																		$sql2 .= " price= '".$price."'";
		}
		if ($description != $row['description'] && strlen($description) != 0) {
			if (strpos($sql2,'=') !== false)											$sql2 .= ", description= '".$description."'";
			else 																		$sql2 .= " description= '".$description."'";
		}
		$sql2 .= " WHERE id_exp = ".$id_exp;
		$result2 = $con->query($sql2); 
	}
?>