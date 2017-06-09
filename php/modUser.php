<?php
	include 'connection.php';
	$id_user	= $_POST['id_user'];
	$username 	= strtolower(strval($_POST['username']));
	$pass 		= strval($_POST['pass']);
	$md5pass 	= md5($pass);
	$email		= strval($_POST['email']);
	$bdate 		= str_replace("/", "-", strval($_POST['bdate']));
	$country	= strval($_POST['country']);
	$photo		= strval($_POST['photo']);

	$sql 	=	"SELECT * FROM users WHERE id_user = ".$id_user;
	$result = 	$con->query($sql);
	$row 	= 	mysqli_fetch_array($result);
	$sql2	 = "UPDATE users SET";
	if ($username != $row['username'] && strlen($username) != 0)  					$sql2 .= " username= '".$username."'";
	if ($md5pass != $row['pass'] && strlen($pass) != 0){
		if (strpos($sql2,'=') !== false)											$sql2 .= ", pass= '".$md5pass."'";
		else 																		$sql2 .= " pass= '".$md5pass."'";
	}  						
	if ($email != $row['mail'] && strlen($email) != 0) {
		if (strpos($sql2,'=') !== false)											$sql2 .= ", mail= '".$email."'";
		else 																		$sql2 .= " mail= '".$email."'";
	} 							
	if (strtotime($bdate) != strtotime($row['bdate']) && strlen($bdate) != 0) {
		if (strpos($sql2,'=') !== false)											$sql2 .= ", bdate= STR_TO_DATE('".$bdate."', '%d/%m/%Y')";
		else 																		$sql2 .= " bdate= STR_TO_DATE('".$bdate."', '%d/%m/%Y')";
	} 								
	if ($country != $row['country'] && strlen($country) != 0){
		if (strpos($sql2,'=') !== false)                         					$sql2 .= ", country= '".$country."'";
		else 																		$sql2 .= " country= '".$country."'";
	}
	if ("media/".$photo != $row['photo'] && strlen($photo) != 0){
		if (strpos($sql2,'=') !== false)											$sql2 .= ", photo= 'media/".$photo."'";
		else 																		$sql2 .= " photo= 'media/".$photo."'";
	} 							
	$sql2 .= " WHERE id_user = ".$id_user;
	$result2 = 	$con->query($sql2);
?>