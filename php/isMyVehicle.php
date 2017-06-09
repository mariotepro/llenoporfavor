<?php
	include 'connection.php';
	$id_veh 	= $_POST['id_veh'];
	$id_user 	= $_POST['id_user'];
	$sql      = "SELECT * FROM vehicles     WHERE id_veh = ".$id_veh;
	$result   = $con->query($sql);
	$row      = mysqli_fetch_array($result);
	if ($row['id_user'] != $id_user) 	echo "1";
	else 								echo "0";
	//http://llenoporfavor.es/php/isMyVehicle.php?id_veh=10&id_user=7
?>