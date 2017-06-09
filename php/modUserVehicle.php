<?php
	include "connection.php";
	$id_veh 			= strval($_POST['id']);
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
	
	$sql 		= "SELECT * FROM vehicles WHERE id_veh =".$id_veh;
	$result 	= $con->query($sql);
	$row 		= mysqli_fetch_array($result);

	$sql2 		= "SELECT * FROM models WHERE manufacturer = '".$manufacturer."' 
													AND model = '".$model."' 
													AND fuel = '".$fuel."' 
													AND year = ".$year." 
													AND door = ".$doors." 
													AND engine = ".$engine." 
													AND hp = ".$hp;
	$result2 	= $con->query($sql2);
	$row2 		= mysqli_fetch_array($result2);

	echo "</br>".$row2['manufacturer'];
	echo "</br>".$row2['model'];
	echo "</br>".$row2['fuel'];
	echo "</br>".$row2['year'];
	echo "</br>".$row2['door'];
	echo "</br>".$row2['engine'];
	echo "</br>".$row2['hp'];
	echo "</br>".$sql2;


	echo "</br> MOD1:".$row2['id_model'];
	echo "</br> MOD2:".$row['id_model'];

	$sql3	 = "UPDATE vehicles SET";
	if ($row2['id_model'] != $row['id_model'])  									$sql3 .= " id_model= ".$row2['id_model'];
	if ($color != $row['color'] && strlen($color) != 0){
		if (strpos($sql3,'=') !== false)											$sql3 .= ", color= '".$color."'";
		else 																		$sql3 .= " color= '".$color."'";
	}  						
	if ($description != $row['description'] && strlen($description) != 0) {
		if (strpos($sql3,'=') !== false)											$sql3 .= ", description= '".$description."'";
		else 																		$sql3 .= " description= '".$description."'";
	}
	if ("media/".$photo != $row['photo'] && strlen($photo) != 0){
		if (strpos($sql3,'=') !== false)											$sql3 .= ", photo= 'media/".$photo."'";
		else 																		$sql3 .= " photo= 'media/".$photo."'";
	} 							
	$sql3 .= " WHERE id_veh = ".$id_veh;
	echo $sql3;
	$result3 = 	$con->query($sql3);
	//http://llenoporfavor.es/php/modUserVehicle.php?id_veh=11&manufacturer=Volkswagen&model=Golf&fuel=Diesel&year=2011&engine=1600&hp=105&doors=5&color=Blanco&description=Maravilloso&photo=fotoguay
?>