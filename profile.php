<!DOCTYPE html>
<html lang="en">
<head>
	<title>Perfil</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
</head>

<body>
	<?php
    $id_user = $_GET['id'];
    include 'php/loadUserData.php';
    getData();
    printFloatButton();
    include 'common/header.php';
	?>
	
	<main>
  	<div class="row">	
      <div class="col s12 m8">     
        <?php showCarsData(); ?>
      </div>  <!--Col1--> 

      <div class="col s12 m4">
        <?php showUserData(); ?>
      </div> <!--Col2-->
    </div> <!--Row-->
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>