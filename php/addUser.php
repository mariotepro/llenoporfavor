<?php
$username 	= strtolower(strval($_POST['username']));

$pass 		= strval($_POST['pass']);
$md5pas 	= md5($pass);

$email		= strval($_POST['email']);
$bdate 		= strval($_POST['bdate']);
$country	= strval($_POST['country']);

$activation = md5(strval(rand()));

include 'connection.php';

$sql = 'INSERT INTO users VALUES (
			NULL,
 			"'.$username.'",
 			"'.$md5pas.'",
			"'.$email.'",
			STR_TO_DATE("'.$bdate.'", "%d/%m/%Y"),
			"'.$country.'",
			"media/defaultProfile.jpg")';
			
$result = $con->query($sql);

$sql = 'SELECT * FROM users WHERE username = "'.$username.'"';
$result = $con->query($sql);
$row = mysqli_fetch_array($result);
session_start();
if (!isset($_SESSION['ID'])) 	$_SESSION['ID'] = $row['id_user'];

mysqli_close($con);

//INSERT INTO useless_table (id, date_added) VALUES(
//          1, STR_TO_DATE('03/08/2009', '%m/%d/%Y'));
//www.llenoporfavor.es/php/addUser.php?username=mariote&pass=mortadelo&email=mariobastardo@gmail.com&bdate=27/07/1990&country=ES
?>