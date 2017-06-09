<?php
	include "connection.php";

	$id_user 			= strval($_POST['id_user']);
	$manufacturer 		= strval($_POST['manufacturer']);
	$model 				= strval($_POST['model']);
	$fuel 				= strval($_POST['fuel']);
	$year				= strval($_POST['year']);
	$doors 				= strval($_POST['doors']);
	$engine				= strval($_POST['engine']);
	$hp					= strval($_POST['hp']);
	$color				= strval($_POST['color']);
	$description		= strval($_POST['description']);
	$photo				= strval($_POST['photo']);

	$color 			= !empty($color) 		? "'".$color."'" 					: "NULL";
	$description 	= !empty($description) 	? "'".$description."'" 				: "NULL";
	$photo 			= !empty($photo) 		? "'media/".$photo."'" 				: "'media/cardefault.jpg'";

	$sql = "SELECT * FROM models 	WHERE manufacturer = '".$manufacturer."' 
									AND model = '".$model."' 
									AND fuel = '".$fuel."' 
									AND year = ".$year." 
									AND door = ".$doors." 
									AND engine = ".$engine." 
									AND hp = ".$hp;
	$result = $con->query($sql);
	$row = mysqli_fetch_array($result);

	$sql2 = 'INSERT INTO vehicles VALUES (
				NULL,
				'.$id_user.',
				'.$row['id_model'].',
				'.$color.',
				'.$description.',
				'.$photo.')';
	$result2 = $con->query($sql2);

	//http://llenoporfavor.es/php/addVehicle.php?id_user=7&manufacturer=Volkswagen&model=Golf&fuel=Diesel&year=2011&engine=1600&hp=105&doors=5&color=Blanco&description=Maravilloso&photo=fotoguay
?>