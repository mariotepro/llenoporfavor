<?php
	session_start();
	echo "<h2>SESION ID: ".$_SESSION['ID']."</h2>";
	unset($_SESSION['ID']);
	if (!isset($_SESSION['ID'])) 	$_SESSION['ID'] = 8;
?>