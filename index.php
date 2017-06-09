<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lleno Por Favor</title>
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
	<?php; 
		include 'common/header.php';
	?>
	<main>
		<div class="container">
			<div class="row center-align">
				<h1 class="header">Lleno, Por Favor</h1>
				<div class="col s12">
					<h5>Una plataforma web para controlar los gastos en tus vehículos.</h5>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m4 center-align">
					<p><i class='material-icons large'>account_circle</i></p>
					<h5>Tu propio Perfil...</h5>
					<p>Crea tu propio perfil donde podras ir añadiendo los vehículos que tienes y puedas así, ir controlando el dinero que te dejas en ellos</p>
				</div>
				<div class="col s12 m4 center-align">
					<p><i class='material-icons large'>directions_car</i></p>
					<h5>...y el de tu coche...</h5>
					<p>Añade un coche a tu perfil, dinos de qué color és. Así podrás mantener todos los gastos en un sólo sitio</p>
				</div>
				<div class="col s12 m4 center-align">
					<p><i class='material-icons large'>local_atm</i></p>
					<h5>...y a controlar los gastos!</h5>
					<p>Y vete añadiendo los gastos que vas haciendo en el vehículo. ¡Tenerlo todo controlado te puede ayudar a ahorrar!</p>
				</div>
			</div>
			<div class="row">
				<h2 class="header">¡Empieza ya!</h2>
				<div class="col s12 m6 center-align">
					<a href="login.php" class="waves-effect waves-light btn">Entrar</a>
				</div>
				<div class="col s12 m6 center-align">
					<a href="register.php" class="waves-effect waves-light btn">Registrarse</a>
				</div>
			</div>
		</div>
	</main>

	<?php include 'common/footer.php'; ?>
</body>
</html>