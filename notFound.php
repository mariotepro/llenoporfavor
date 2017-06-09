<!DOCTYPE html>
<html lang="en">
<head>
	<title>No encontrado</title>
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
		$pagename = "¡EEEEEEEEERRROOOOORR!"; 
		include 'common/header.php';
	?>
	
	<main>
		<div class="container">
			<div class="row">
				<h2 class="header">Ups..!</h2>
				<div class="col s12 center-align">
					<p class="flow-text">Los monos esclavos del sótano que llevan la contabilidad en ésta página no han encontrado nada por donde estabas buscando.</p>
					<p class="flow-text">Pero tranquilo, no es culpa tuya. Es que son monos. Éste mes tampoco comerán. Mientras, si quieres, puedes volver a donde empezaste:</p>
				</div>
				<div class="col s12 m4 offset-m4 center-align">
					<a href="index.php" class="flow-text">Volver al principio</a>
				</div>
			</div>
			<div class="row">
			</div>
		</div>
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>