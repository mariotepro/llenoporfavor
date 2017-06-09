<?php
	include 'connection.php';
	session_start();
	$id_user = $_SESSION['ID'];

	$sql 	= "SELECT * FROM users WHERE id_user =".$id_user;
	$result = $con->query($sql);
	$row 	= mysqli_fetch_array($result);

	echo $id_user.";".$row['username'].";".$row['mail'].";".$row['bdate'].";".$row['country'].";".$row['photo'];
?>