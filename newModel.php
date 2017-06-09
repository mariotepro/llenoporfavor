<!DOCTYPE html>
<html lang="en">
<head>
    <title>Añadir un nuevo modelo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/newModel.js"></script>
</head>

<body>
	<?php
    session_start();
    $pagename = "Añadir nuevo modelo";
    include 'common/header.php';
	?>

	<main>
    <div class="container">
      
      <div class="row section">
        <div class="col s12 center-align">
          <span class="flow-text">Si no encuentras tu coche, dinos cual és y lo incluiremos en nuestra base de datos, para que tu y otros compañeros podáis usarlo a partir de ahora.</span>
        </div>
      </div>

      <div class="row section">
        <h2 class="header">¿Qué coche es?</h2>
        <div class="col s12">
          
          <div class="input-field col s12 m6">
            <select id="manufacturer">
              <option value="" disabled>Escoge una marca</option>
            </select>
            <label>Marca</label>
          </div>

          <div class="input-field col s12 m6">
            <input id="omanufacturer" type="text" class="validate" length="20" disabled>
            <label for="omanufacturer">Introduce tu marca</label>
          </div>

          <div class="input-field col s12 m6">
            <select id="model" disabled>
              <option value="" disabled>Escoge un modelo</option>
            </select>
            <label>Modelo</label>
          </div>

          <div class="input-field col s12 m6">
            <input id="omodel" type="text" class="validate" length="20" disabled>
            <label for="omodel">Introduce tu modelo</label>
          </div>

          <div class="input-field col s12">
            <select id="fuel" disabled>
              <option value="" selected>Combustible de tu coche</option>
              <option value="Gasolina">Gasolina</option>
              <option value="Diesel">Diesel</option>
              <option value="Gas">Gas</option>
              <option value="Hibrido">Híbrido</option>
              <option value="Electrico">Eléctrico</option>
            </select>
            <label>Combustible</label>
          </div>

          <div class="input-field col s12 m6">
            <select id="year" disabled>
              <option value="" disabled>Año de tu coche</option>
            </select>
            <label>Año</label>
          </div>  

          <div class="input-field col s12 m6">
            <input id="oyear" type="text" class="validate" length="4" disabled>
            <label for="oyear">¿De qué año es tu coche?</label>
          </div>

          <div class="input-field col s12 m6">
            <select id="doors" disabled>
              <option value="" disabled>Puertas</option>
            </select>
            <label>Puertas</label>
          </div>

          <div class="input-field col s12 m6">
            <input id="odoors" type="text" class="validate" length="1" disabled>
            <label for="odoors">¿Cuántas puertas tiene?</label>
          </div>

          <div class="input-field col s12 m6">
            <select id="engine" disabled>
              <option value="" disabled>Motor del vehículo</option>
            </select>
            <label>Motor</label>
          </div>

          <div class="input-field col s12 m6">
            <input id="oengine" type="text" class="validate" length="4" disabled>
            <label for="oengine">Cilindrada de tu coche (en cc)</label>
          </div>

          <div class="input-field col s12 m6">
            <select id="hp" disabled>
              <option value="" disabled>Potencia del vehiculo</option>
            </select>
            <label>Potencia</label>
          </div>

          <div class="input-field col s12 m6">
            <input id="ohp" type="text" class="validate" length="3" disabled>
            <label for="ohp">Potencia que tiene</label>
          </div>


        </div><!--Col-->
      </div><!--Row2-->

      <div class="row">
        <div class="col s12">
          <div id="submit" class="btn waves-effect waves-light disabled col s12 m3 offset-m8">
              Guardar
              <i class="material-icons right">send</i>
          </div>
        </div><!--Col-->
      </div><!--Row3-->
      </div>
    </div>
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>