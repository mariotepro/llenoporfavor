<?php
include 'connection.php';

switch ($_POST['load']) {
	case 'manufacturer':
		loadManufacturers();
		break;
	case 'model':
		loadModels($_POST['manufacturer']);
		break;
	case 'year':
		loadYear($_POST['manufacturer'], $_POST['model'], $_POST['fuel']);
		break;
	case 'doors':
		loadDoors($_POST['manufacturer'], $_POST['model'], $_POST['fuel'], $_POST['year']);
		break;
	case 'engine':
		loadEngine($_POST['manufacturer'], $_POST['model'], $_POST['fuel'], $_POST['year'], $_POST['doors']);
		break;
	case 'hp':
		loadHp($_POST['manufacturer'], $_POST['model'], $_POST['fuel'], $_POST['year'], $_POST['doors'], $_POST['engine']);
		break;
	case 'id':
		loadID($_POST['id']);
		break;
}

function loadManufacturers() {
	global $con;
	$sql = "SELECT * FROM models GROUP BY manufacturer";
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['manufacturer'];
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadModels($sManufacturer) {
	global $con;
	$sql = "SELECT * FROM models WHERE manufacturer = '".$sManufacturer."'";
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['model'];
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadYear($sManufacturer, $sModel, $sFuel) {
	global $con;
	$sql = "SELECT * FROM models WHERE manufacturer = '".$sManufacturer."' AND model = '".$sModel."' AND fuel = '".$sFuel."'";
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['year'];
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadDoors($sManufacturer, $sModel, $sFuel, $sYear) {
	global $con;
	$sql = "SELECT * FROM models WHERE manufacturer = '".$sManufacturer."' AND model = '".$sModel."' AND fuel = '".$sFuel."' AND year = ".$sYear;
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['door'];
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadEngine($sManufacturer, $sModel, $sFuel, $sYear, $sDoors) {
	global $con;
	$sql = "SELECT * FROM models WHERE manufacturer = '".$sManufacturer."' AND model = '".$sModel."' AND fuel = '".$sFuel."' AND year = ".$sYear." AND door = ".$sDoors;
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['engine'];
		$returnString .= "cc ";
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadHp($sManufacturer, $sModel, $sFuel, $sYear, $sDoors, $sEngine) {
	global $con;
	$sql = "SELECT * FROM models WHERE manufacturer = '".$sManufacturer."' AND model = '".$sModel."' AND fuel = '".$sFuel."' AND year = ".$sYear." AND door = ".$sDoors." AND engine = ".$sEngine;
	$result = $con->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$returnString .= $row['hp'];
		$returnString .= "cv";
		$returnString .= ";";
	}
	echo $returnString;
	mysqli_close($con);
}

function loadID($id) {
	global $con;
	$sql = "SELECT * FROM models WHERE id_model = ".$id;
	$result = $con->query($sql);
	if (mysqli_num_rows($result) == 0) 			echo 0;
	else {
		$row = mysqli_fetch_array($result);
		$s = ";";
		echo $row['manufacturer'].$s.$row['model'].$s.$row['fuel'].$s.$row['year'].$s.$row['door'].$s.$row['engine']."cc ".$row['hp']."cv";
		mysqli_close($con);
	}
}

//http://www.llenoporfavor.es/php/newModelLoader.php?load=manufacturer
//http://www.llenoporfavor.es/php/newModelLoader.php?load=model&manufacturer=Renault
//http://www.llenoporfavor.es/php/newModelLoader.php?load=hp&manufacturer=Renault&model=Megane&fuel=Gasolina&year=1999&door=5&engine=1900
?>