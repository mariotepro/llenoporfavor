<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
    <script type="text/javascript" src="js/login.js"></script>
</head>

<body>
	<?php
		$pagename = "Login"; 
		include 'common/header.php';
	?>
	
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12 center-align"><span class="flow-text">Bienvenido de nuevo. Si ya tienes una cuenta, entra. Si no, ¡Registrate!</span></div>
			</div>
			<div class="row">
				<form class="col s12">
					<div class="input-field col s12 m6 offset-m3">
						<input id="username" type="text" class="validate" length="20">
						<label for="username">Nombre de Usuario</label>
					</div>
					<div class="input-field col s12 m6 offset-m3">
						<input id="pass" type="password" class="validate" length="20">
						<label for="pass">Contraseña</label>
					</div>
					<div id="submit" class="btn waves-effect waves-light disabled col s6 offset-s3 m3 offset-m6">
				  		Entrar
	    				<i class="material-icons right">send</i>
				  	</div>
				</form>
			</div>
		</div>
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>