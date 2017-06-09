<?php
	$id_user 	= $_POST['id'];
    $username 	= strtolower(strval($_POST['username']));
	include 'connection.php';
	$sql = 'SELECT * FROM users WHERE username = "'.$username.'"';
	$result = $con->query($sql);
	if (empty($id_user)) {
		if (mysqli_num_rows($result) > 0) 							echo 1;
	} else {
		$row = mysqli_fetch_array($result);
		if ($id_user == $row['id_user'])							echo 0;
		else {
			if (mysqli_num_rows($result) > 0) 						echo 1;
		}						
	}
	mysqli_close($con);
?> 