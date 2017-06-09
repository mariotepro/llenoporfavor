<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modificar Gasto</title>
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
    <script type="text/javascript" src="js/modExpense.js"></script>
</head>

<body>
	<?php
    session_start();
    $pagename = "Modificar Gasto";
    include 'common/header.php';
	?>

	<main>
    <div class="container">
      
      <div class="row section">
        <div class="col s12 center-align">
          <span class="flow-text">Modifica el gasto de tu vehículo</span>
        </div>
      </div>

      <div class="row section">
        <div class="col s12">
              <div class="input-field col s12 m6 offset-m3">
              <select id="type">
                <option value="" disabled>Escoge un tipo de gasto</option>
                <option value="fueling">Repostaje</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Reparación">Reparación</option>
                <option value="Revisión">Revisión</option>
                <option value="Parking">Parking</option>
                <option value="Multa">Multa</option>
                <option value="Compra del Vehículo">Compra del Vehículo</option>
                <option value="Cambio de Neumáticos">Cambio de Neumáticos</option>
                <option value="Otro">Otro</option>
            </select>
              <label>Tipo de Gasto</label>
        </div>
      </div>

    <div id="fuelingType" class="row section" style="display: none;">
      <form class="col s12">
        <div class="input-field col s12 m6 offset-m3">
          <input id="date" type="date" class="datepicker">
          <label for="date">Fecha del Repostaje</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="km" type="text" class="validate" length="8">
          <label for="km">Kilómetros del coche</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="fuel_km" type="text" class="validate" length="6">
          <label for="fuel_km">Kilómetros Parciales (opc)</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="fuel_quantity" type="text" class="validate" length="6">
          <label for="fuel_quantity">Cantidad de combustible (en litros)</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="price" type="text" class="validate" length="6">
          <label for="price">Precio</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="fuel_consumption" type="text" class="validate" length="5">
          <label for="fuel_consumption">Consumo según ordenador (opc)</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="fuel_speed" type="text" class="validate" length="3">
          <label for="fuel_speed">Velocidad según ordenador (opc)</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="description" type="text" class="validate" length="140">
          <label for="description">Descripción (opc)</label>
        </div>
      </form>
    </div>

    <div id="otherType" class="row section" style="display: none;">
      <form class="col s12">
        <div class="input-field col s12 m6 offset-m3">
          <input id="dateo" type="date" class="datepicker">
          <label for="dateo">Fecha del Gasto</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="kmo" type="text" class="validate" length="8">
          <label for="kmo">Kilómetros del coche</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="priceo" type="text" class="validate" length="8">
          <label for="priceo">Precio</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <input id="descriptiono" type="text" class="validate" length="140">
          <label for="descriptiono">Descripción</label>
        </div>
      </form>
    </div>

    <div class="row section">
      <div id="submit" class="btn waves-effect waves-light disabled col s12 m4 offset-m4" style="display: none;">
         Guardar
          <i class="material-icons right">send</i>
      </div>
    </div>
      </div> <!--Container-->
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>