<?php
	include "connection.php";
	$manufacturer 		= strval($_POST['manufacturer']);
	$model 				= strval($_POST['model']);
	$fuel 				= strval($_POST['fuel']);
	$year				= strval($_POST['year']);
	$doors 				= strval($_POST['doors']);
	$engine				= strval($_POST['engine']);
	$hp					= strval($_POST['hp']);
	
	$sql = 'INSERT INTO models VALUES (
				NULL,
				"'.$manufacturer.'",
				"'.$model.'",
				'.$year.',
				"'.$fuel.'",
				'.$engine.',
				'.$hp.',
				'.$doors.')';
	$result = $con->query($sql);

	$sql = "SELECT * FROM models 	WHERE manufacturer = '".$manufacturer."' 
									AND model = '".$model."' 
									AND fuel = '".$fuel."' 
									AND year = ".$year." 
									AND door = ".$doors." 
									AND engine = ".$engine." 
									AND hp = ".$hp;
	$result = $con->query($sql);
	$row = mysqli_fetch_array($result);
	echo $row['id_model'];

	//http://llenoporfavor.es/php/addModel.php?manufacturer=Jaguar&model=XE&fuel=Diesel&year=2015&engine=2000&hp=180&doors=4
?>