<?php
	session_start();
	unset($_SESSION['ID']);
	echo "<script>window.location='index.php';</script>";
?>