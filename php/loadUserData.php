<?php
include 'php/connection.php';

$resultUser; 
$resultCars; 
$rowUser;

session_start();
if      (empty($id_user) && (!isset($_SESSION['ID']) || empty($_SESSION['ID'])))  echo "<script>window.location='login.php';</script>";
if      (empty($id_user) && (isset($_SESSION['ID']) && !empty($_SESSION['ID'])))  $id_user = $_SESSION['ID'];
if      (!isset($_SESSION['ID']) || empty($_SESSION['ID']))                       $isMyProfile = false; 
if      ($_SESSION['ID'] == $id_user)                                             $isMyProfile = true;

function noUserFound() {
	echo "<script>window.location='notFound.php';</script>";
}

function noVehicleFound() {
	session_start();
	global $isMyProfile, $id_user;
	echo "<div class='card blue-grey lighten-1'>";
        echo "<div class='card-content white-text'>";
        	echo "<span class='card-title'>No hay disponible ningún vehículo</span>";
              	echo "<p>No hay ningún vehículo asociado en el perfil.</p>";
              	if ($isMyProfile)	echo "Añade un vehículo nuevo a tu perfil haciendo click en el enlace naranja de debajo de éste texto. Para más adelante, podrás utilizar el botón rojo de la esquina inferior derecha de la pantalla. </p>";
        echo "</div>";
        	if ($isMyProfile) {
        		echo "<div class='card-action'>";
            		echo "<a href='newVehicle.php'>Añadir un Vehículo</a>";
        		echo "</div>";
        	}
    echo "</div>";
}


function getData() {
  session_start();
	global $pagename, $id_user, $resultUser, $rowUser, $con;
	$sqlUserData = "SELECT * FROM users WHERE id_user = ".$id_user;
	$resultUser = $con->query($sqlUserData);
	$rowUser = mysqli_fetch_array($resultUser);
  $pagename = $rowUser['username'];
	if 		(mysqli_num_rows($resultUser) == 0)     noUserFound();
	else 	getCarsData($resultUser);
}

function getCarsData($resultUser) {
	global $id_user, $resultCars, $con;
	$sqlCarsData = "SELECT * FROM vehicles WHERE id_user = ".$id_user;
	$resultCars = $con->query($sqlCarsData);
}

function showUserData() {
	global $isMyProfile, $id_user, $con, $rowUser, $resultCars;
  $sql = "SELECT * FROM expenses WHERE id_veh IN (SELECT id_veh FROM vehicles WHERE id_user = ".$rowUser['id_user'].")";
  $result = $con->query($sql);
  while ($row = mysqli_fetch_array($result)) {
    $moneytotal   +=  $row['price'];
    $litrestotal  +=  $row['fuel_quantity'];
  }
	echo "<div class='card hoverable large z-depth-2'>";
    	echo "<div class='card-image'>";
            echo "<img src='".$rowUser['photo']."'>"; //<!-- aquí irá una foto -->
        echo "</div>";
        echo "<div class='card-content'>";
          echo "<div class='card-title'>".$rowUser['username']."</div>";
        	if ($isMyProfile) {
            echo "<p> Aquí podrás ver un resumen de tus vehículos y sus consumos, además podrás hacer alguna operación habitual</p>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>directions_car</i></div>";
              echo "<div class='col s8'>Vehículos en total: </div>";
              echo "<div class='col s2 center-align orange-text'>".mysqli_num_rows($resultCars)."</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>local_atm</i></div>";
              echo "<div class='col s8'>Gastos añadidos: </div>";
              echo "<div class='col s2 center-align orange-text'>".mysqli_num_rows($result)."</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>attach_money</i></div>";
              echo "<div class='col s8'>Gasto total: </div>";
              echo "<div class='col s2 center-align orange-text'>".number_format($moneytotal, 2, ',', '.')."€</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>local_gas_station</i></div>";
              echo "<div class='col s8'>Litros consumidos: </div>";
              echo "<div class='col s2 center-align orange-text'>".number_format($litrestotal, 2, ',', '.')."&#8467;</div>";
            echo "</div>";
          } else {
            $daystobirthdate = time() - strtotime($rowUser['bdate']);
            $yearsold = floor((($daystobirthdate / 3600) / 24) / 360);
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>directions_car</i></div>";
              echo "<div class='col s8'>Vehículos de ".$rowUser['username'].": </div>";
              echo "<div class='col s2 center-align orange-text'>".mysqli_num_rows($resultCars)."</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>local_atm</i></div>";
              echo "<div class='col s8'>Gastos que ha añadido: </div>";
              echo "<div class='col s2 center-align orange-text'>".mysqli_num_rows($result)."</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>attach_money</i></div>";
              echo "<div class='col s8'>Gasto total: </div>";
              echo "<div class='col s2 center-align orange-text'>".number_format($moneytotal, 2, ',', '.')."€</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>local_gas_station</i></div>";
              echo "<div class='col s8'>Litros consumidos: </div>";
              echo "<div class='col s2 center-align orange-text'>".number_format($litrestotal, 2, ',', '.')."&#8467;</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>face</i></div>";
              echo "<div class='col s8'>Edad: </div>";
              echo "<div class='col s2 center-align orange-text'>".$yearsold."</div>";
            echo "</div>";
            echo "<div class='row valign-wrapper'>";
              echo "<div class='col s2'><i class='material-icons'>room</i></div>";
              echo "<div class='col s8'>Nacionalidad: </div>";
              echo "<div class='col s2 center-align'><img class='flag flag-".strtolower($rowUser['country'])."'/></div>";
            echo "</div>";
          }
        echo "</div>";
          if ($isMyProfile) {
            echo "<div class='card-action'>";
                echo "<a href='modProfile.php'>Modificar Perfil</a>";
            echo "</div>"; }
    echo "</div>";
    mysqli_close($con);
}

function showCarsData() {
	global $resultCars;
	if 		(mysqli_num_rows($resultCars) == 0) 			noVehicleFound();
	else 	printCarsData();
}

function printCarsData() {
	global $resultCars, $con;
	while($row = mysqli_fetch_array($resultCars)) {
		$sql2 = "SELECT * FROM models WHERE id_model =".$row['id_model'];
		$result2 = $con->query($sql2);
		$row2 = mysqli_fetch_array($result2);

		echo "<div class='card hoverable large profile'>";

          echo "<div class='card-image'>";
            echo "<img src='".$row['photo']."'>";
          echo "</div>";

          echo "<div class='card-content'>";
            echo "<div class='card-title'>".$row2['model']."</div>";
            echo "<p>".$row['description']."</p>";
            echo "<table class='responsive-table'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th data-field='manufacturer'>Fabricante</th>";
                  echo "<th data-field='model'>Modelo</th>";
                  echo "<th data-field='year'>Año</th>";
                  echo "<th data-field='fuel'>Combustible</th>";
                  echo "<th data-field='engine'>Cilindrada</th>";
                  echo "<th data-field='hp'>Potencia</th>";
                  echo "<th data-field='doors'>Puertas</th>";
                  echo "<th data-field='color'>Color</th>";
                echo "</tr>";
              echo "</thead>";

              echo "<tbody>";
                echo "<tr>";
                  echo "<td>".$row2['manufacturer']."</td>";
                  echo "<td>".$row2['model']."</td>";
                  echo "<td>".$row2['year']."</td>";
                  echo "<td>".$row2['fuel']."</td>";
                  echo "<td>".$row2['engine']."cc</td>";
                  echo "<td>".$row2['hp']."cv</td>";
                  echo "<td>".$row2['door']."</td>";
                  echo "<td>".$row['color']."</td>";
                echo "</tr>";
              echo "</tbody>";
            echo "</table>";
          echo "</div>";

          echo "<div class='card-action'>";
            echo "<a href='vehicle.php?id=".$row['id_veh']."'>Mostrar Gastos</a>";
          echo "</div>";
        echo "</div> <!--Card Vehículo-->";
	}
}


function printFloatButton() {
  global $id_user, $isMyProfile;
  if ($isMyProfile) {
    echo "<div class='fixed-action-btn' style='bottom: 45px; right: 24px;'>";
      echo "<a href='newVehicle.php'class='btn-floating btn-large red tooltipped' data-position='left' data-delay='50' data-tooltip='Añadir Vehículo'><i class='large material-icons'>add</i></a>";
    echo "</div>";
  }
}
?>