<?php
	include 'connection.php';
	$id_exp = $_POST['id'];
	$sql	= "SELECT * FROM users WHERE id_user =
				(SELECT id_user FROM vehicles WHERE id_veh =
					(SELECT id_veh FROM expenses WHERE id_exp = ".$id_exp."))";
	$result = $con->query($sql);
	$row    = mysqli_fetch_array($result);
	session_start();
	if ($row['id_user'] != $_SESSION['ID']) 			echo 1;
	else 												echo 0;
?>

