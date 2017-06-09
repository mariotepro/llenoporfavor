<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modificar Vehículo</title>
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
    <script type="text/javascript" src="js/modVehicle.js"></script>
</head>

<body>
	<?php
    session_start();
    $pagename = "Añadir nuevo vehículo";
    include 'common/header.php';
	?>
  <script type="text/javascript"> var id_user = "<?php echo $_SESSION['ID']; ?>";</script>

	<main>
    <div class="container">
      
      <div class="row section">
        <div class="col s12 center-align">
          <span class="flow-text">Añade un nuevo vehículo a tu perfil para que poco a poco puedas ir añadiendo los gastos que vas teniendo y controlando el dinero que te dejas en él.</span>
        </div>
      </div>

      <div class="row section">
        <h2 class="header">¿Qué coche es?</h2>
        <div class="col s12">
          
          <div class="input-field col s12 m4">
            <select id="manufacturer">
              <option value="" disabled>Escoge una marca</option>
            </select>
            <label>Marca</label>
          </div>

          <div class="input-field col s12 m4">
            <select id="model" disabled>
              <option value="" disabled>Escoge un modelo</option>
            </select>
            <label>Modelo</label>
          </div>

          <div class="input-field col s12 m4">
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
            <select id="doors" disabled>
              <option value="" disabled>Puertas</option>
            </select>
            <label>Puertas</label>
          </div>

          <div class="input-field col s12">
            <select id="engine" disabled>
              <option value="" disabled>Motor del coche</option>
            </select>
            <label>Motor</label>
          </div>

          <div class="col s12 valign-wrapper">
              <p class="col s12 m9">¿No encuentras tu coche, modelo o motorización? Si quieres, <a href="newModel.php">añade uno</a></p>
          </div>
        </div><!--Col-->
      </div><!--Row2-->

      <div class="row section">
        <h2 class="header">Sube una foto</h2>
        <div class="col s12">
          <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
              <div class="file-field input-field">
                <input disabled id="filetext" class="file-path validate right-align" type="text"/>
                <div class="btn">
                  <span>Selec.</span>
                  <input id="file" name="file" type="file" />
                </div>
              </div>
            <input id="imgUp" type="submit" value="Subir" class="btn s12"/>
          </form>
        </div><!--Col-->
      </div><!--Row3-->

      <div class="row section">
        <h2 class="header">Describelo</h2>
        <div class="col s12">
          <p>Bueno, si quieres...</p>
          <div class="input-field col s12">
            <input id="color" type="text" class="validate" length="20">
            <label for="color">Color</label>
          </div>
          <div class="input-field col s12">
            <input id="description" type="text" class="validate" length="140">
            <label for="description">Descripción</label>
          </div>
        </div><!--Col-->
      </div><!--Row3-->  


      <div class="row">
        <div class="col s12">
          <div id="submit" class="btn waves-effect waves-light disabled col s12 m3">
              Guardar
              <i class="material-icons right">send</i>
          </div>
        </div><!--Col-->
      </div><!--Row5-->
      </div>
    </div>
	</main>
	
	<?php include 'common/footer.php'; ?>
</body>
</html>