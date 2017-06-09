<?php
	include 'connection.php';
	$id_exp 	= $_POST['id'];
	$sql 		= "SELECT * FROM expenses WHERE id_exp = ".$id_exp;
	$result = $con->query($sql);
	$row    = mysqli_fetch_array($result);
	echo 	$row['type'].";".$row['date'].";".$row['km'].";".
			$row['description'].";".$row['fuel_km'].";".$row['fuel_quantity'].";".
			$row['fuel_cb_consumption'].";".$row['fuel_cb_speed'].";".$row['price'].";".$row['id_veh'];
?>