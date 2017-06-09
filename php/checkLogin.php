<?php
$username 	= strtolower(strval($_POST['username']));
$pass 		= strval($_POST['pass']);
$md5pas 	= md5($pass);

include 'connection.php';

$sql = 'SELECT * FROM users WHERE username = "'.$username.'"';
$result = $con->query($sql);

if (mysqli_num_rows($result) == 0) 			echo 0;
else {
	$row = mysqli_fetch_array($result);
	if ($row['pass'] == $md5pas) {
		session_start();
		if (!isset($_SESSION['ID'])) 	$_SESSION['ID'] = $row['id_user'];
		echo 1;
	}
	else 									echo 0;
}

mysqli_close($con);

//www.llenoporfavor.es/php/checkLogin.php?username=m&pass=m
?>