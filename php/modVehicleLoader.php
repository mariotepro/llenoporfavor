<?php
	include 'connection.php';
	$id_veh = $_POST['id'];

	$sql 	= "SELECT * FROM vehicles WHERE id_veh=".$id_veh;
	$result = $con->query($sql);
	$row 	= mysqli_fetch_array($result);
	session_start();
	if ($_SESSION['ID'] != $row['id_user'])  	$returnStr .= "0;";
	else 										$returnStr .= "1;";
	$returnStr .= $row['id_model'].";";
	$returnStr .= $row['color'].";";
	$returnStr .= $row['description'].";";
	$returnStr .= substr($row['photo'], 6);
	echo $returnStr;
?>