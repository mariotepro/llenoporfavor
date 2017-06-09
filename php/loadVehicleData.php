<?php
include 'php/connection.php';
      
$sql      = "SELECT * FROM vehicles WHERE id_veh = ".$id_vehicle;
$result   = $con->query($sql);
$row      = mysqli_fetch_array($result);

$sql2     = "SELECT * FROM models     WHERE id_model = ".$row['id_model'];
$result2  = $con->query($sql2);
$row2     = mysqli_fetch_array($result2);
$pagename = $row2['manufacturer']." ".$row2['model'];

$sql3     = "SELECT * FROM users      WHERE id_user = ".$row['id_user'];
$result3  = $con->query($sql3);
$row3     = mysqli_fetch_array($result3);

$sql4     = "SELECT * FROM expenses   WHERE id_veh = ".$row['id_veh']." ORDER BY date DESC";
$result4  = $con->query($sql4);
$expenses;

$pagename = $row2['manufacturer']." ".$row2['model']." de ".$row3['username'];

session_start();
if      ($_SESSION['ID'] == $row['id_user'])                                             $isMyVehicle = true;


function printCarData() {
  global $row, $row2, $row3, $isMyVehicle;
    echo "<div class='card hoverable large profile'>";
          echo "<div class='card-image'>";
            echo "<img src='".$row['photo']."'>";
          echo "</div>";

          echo "<div class='card-content'>";
            echo "<div class='card-title'>".$row2['model']." de <a href='profile.php?id=".$row3['id_user']."'>".$row3['username']."</a></div>";
            echo "<p>".$row['description']."</p>";
            echo "<table class='card-table'>";
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

          if ($isMyVehicle) {
            echo "<div class='card-action'>";
              echo "<a href='modVehicle.php?id=".$row['id_veh']."'>Modificar Vehículo</a>";
            echo "</div>";
          }
        echo "</div> <!--Card Vehículo-->";
}

function printParallaxPhoto() {
  global $id_vehicle, $con;
  $sql    = "SELECT * FROM vehicles WHERE id_veh = ".$id_vehicle;
  $result = $con->query($sql);
  $row    = mysqli_fetch_array($result);
  echo "<div class='parallax'><img src='".$row['photo']."'></div>";
}

function printExpenses() {
  global $expenses;
  foreach ($expenses as $i => $expense) {
    echo "<li id='".$expense['id_exp']."'>";
    expenseHeader($expense);
    if (empty($expense['c']) && ($expense['type'] == "fueling"))        echo "<div class='collapsible-body'><p>Primer Repostaje</p></div>";
    else if (empty($expense['c']))                                      otherType($expense);
    else                                                                fuelingType($expense);
    echo "</li>";
  }
}

function calculateConsumption() {
  global $result4, $expenses;
  while ($row4  = mysqli_fetch_array($result4))     $expenses[] = $row4;                  //Almacenamos todas las filas en un array auxiliar.
  
  for ($i=0; $i < count($expenses); $i++) {                                              //Sacamos el consumo a los 100
    $c = false;
    if ($expenses[$i]['type'] == "fueling") {
      for ($j = $i+1; $j < count($expenses); $j++) {
        if ($expenses[$j]['type'] == "fueling" && $c == false) {
          $km     = $expenses[$i]['km'] - $expenses[$j]['km'];
          $litres = $expenses[$i]['fuel_quantity'];
          $expenses[$i]['c'] = ($litres/$km)*100;
          $c = true;
        }
      }
    }
  }
}

function fuelingType($expense) {
  echo "<div class='collapsible-body'>";
      echo "<p class='center-align'>Consumo: <b>".number_format($expense['c'], 2)." l/100km</b></p>";
      echo "<table class='card-table center-align'>";
          echo "<thead>";
            echo "<tr>";
              echo "<th data-field='km'>Kilometraje</th>";
              echo "<th data-field='fuel_km'>Kilómetros Parciales</th>";
              echo "<th data-field='fuel_quantity'> Litros </th>";
              echo "<th data-field='price'> Precio </th>";
              echo "<th data-field='fuel_cb_consumption'>Consumo (según ordenador)</th>";
              echo "<th data-field='fuel_cb_speed'>Velocidad Media (según ordenador)</th>";
            echo "</tr>";
          echo "</thead>";

          echo "<tbody>";
            echo "<tr>";
              echo "<td>".number_format($expense['km'], 0, ',', '.')." km</td>";
              echo "<td>".number_format($expense['fuel_km'], 1, ',', '.')." km</td>";
              echo "<td>".number_format($expense['fuel_quantity'], 2, ',', '.')." &#8467;</td>";
              echo "<td>".number_format($expense['price'], 2, ',', '.')." €</td>";
              if (!empty($expense['fuel_cb_consumption']))  echo "<td>".number_format($expense['fuel_cb_consumption'], 1, ',', '.')." l/100km</td>";
              else                                          echo "<td>N.D.</td>";
              if (!empty($expense['fuel_cb_speed']))        echo "<td>".$expense['fuel_cb_speed']." km/h</td>";
              else                                          echo "<td>N.D.</td>";
            echo "</tr>";
          echo "</tbody>";
        echo "</table>";
        echo "<p>";
          if (!empty($expense['description'])) echo $expense['description'];
        echo "</p>";
  echo "</div>";
}

function otherType($expense) {
  echo "<div class='collapsible-body'>";
    echo "<table class='card-table center-align'>";
      echo "<thead>";
        echo "<tr>";
          echo "<th data-field='km'>Kilometraje</th>";
          echo "<th data-field='price'>Precio</th>";
        echo "</tr>";
      echo "</thead>";

      echo "<tbody>";
        echo "<tr>";
          echo "<td>".number_format($expense['km'], 0, ',', '.')." km</td>";
          echo "<td>".number_format($expense['price'], 2, ',', '.')." €</td>";
        echo "</tr>";
      echo "</tbody>";
    echo "</table>";
    echo "<p>";
      if (!empty($expense['description'])) echo $expense['description'];
    echo "</p>";
  echo "</div>";
}

function expenseHeader($expense) {
  $expenseDate = strtotime($expense['date']);
  if ($expense['type'] == "fueling") echo   "<div class='collapsible-header'>
                                              <i class='material-icons'>local_gas_station</i>
                                              Repostaje: el día ".date('d-m-Y', $expenseDate)." con ".number_format($expense['km'], 0, ',', '.')." km</div>";
  else                               echo   "<div class='collapsible-header'>
                                              <i class='material-icons'>local_atm</i>".
                                              $expense['type'].": el día ".date('d-m-Y', $expenseDate)." con ".number_format($expense['km'], 0, ',', '.')." km</div>";
}

function printFloatButton() {
  global $id_vehicle, $isMyVehicle, $row;
  if ($isMyVehicle) {
    echo "<div class='fixed-action-btn' style='bottom: 45px; right: 24px;'>";
      echo "<a href='newExpense.php?id=".$id_vehicle."' class='btn-floating btn-large red tooltipped' data-position='left' data-delay='50' data-tooltip='Añadir Gasto'><i class='large material-icons'>add</i></a>";
          echo "<ul>";
            echo "<li><a id='modBtn' class='btn-floating orange tooltipped' data-position='left' data-delay='50' data-tooltip='Modificar Gasto'><i class='material-icons'>mode_edit</i></a></li>";
          echo "</ul>";
    echo "</div>";
  }
}

function checkData() {
  $data = calculateAverages();
  global $expenses;
  if (count($expenses) == 0)  printAddExpense();
  else                        printSummary($data);
}

function printAddExpense() {
  global $isMyVehicle, $id_vehicle;
  echo "<div class='card blue-grey lighten-1'>";
        echo "<div class='card-content white-text'>";
          echo "<span class='card-title'>No hay ningún gasto asociado aún</span>";
                echo "<p>No hay ningún gasto asociado al vehículo aún.</p>";
                if ($isMyVehicle) echo "Añade el primer gasto a tu vehículo haciendo click en el enlace naranja de debajo de éste texto. Para más adelante, podrás utilizar el botón rojo de la esquina inferior derecha de la pantalla. </p>";
        echo "</div>";
          if ($isMyVehicle) {
            echo "<div class='card-action'>";
                echo "<a href='newExpense.php?id=".$id_vehicle."'>Añadir el primer gasto</a>";
            echo "</div>";
          }
    echo "</div>";
}

function printSummary($data) {
  echo "<div class='card-panel blue-grey darken-1'>";
    echo "<span class='orange-text'>Resumen</span>";
    echo "<div class='row white-text valign-wrapper'>";
      echo "<div class='col s2'><i class='material-icons'>local_gas_station</i> /100</div>";
      echo "<div class='col s5 '>Media de consumo: </div>";
      echo "<div class='col s5 center-align orange-text'>".number_format($data['cavg'], 2, ',', '.')." &#8467;/100km</div>";
    echo "</div>";
    echo "<div class='row white-text valign-wrapper'>";
      echo "<div class='col s2'><i class='material-icons'>local_gas_station</i> total</div>";
      echo "<div class='col s5 '>Litros totales gastados: </div>";
      echo "<div class='col s5 center-align orange-text'>".number_format($data['litres'], 2, ',', '.')." &#8467;</div>";
    echo "</div>";
    echo "<div class='row white-text valign-wrapper'>";
      echo "<div class='col s2'><i class='material-icons'>directions_car</i> total</div>";
      echo "<div class='col s5 '>Km Recorridos: </div>";
      echo "<div class='col s5 center-align orange-text'>".number_format($data['kmtotal'], 0, ',', '.')." km</div>";
    echo "</div>";
    echo "<div class='row white-text valign-wrapper'>";
      echo "<div class='col s2'><i class='material-icons'>attach_money</i> /100</div>";
      echo "<div class='col s5 '>Dinero cada 100 km: </div>";
      echo "<div class='col s5 center-align orange-text'>".number_format($data['moneyAvg'], 2, ',', '.')." €/100km</div>";
    echo "</div>";
    echo "<div class='row white-text valign-wrapper'>";
      echo "<div class='col s2'><i class='material-icons'>attach_money</i> total</div>";
      echo "<div class='col s5 '>Dinero total gastado: </div>";
      echo "<div class='col s5 center-align orange-text'>".number_format($data['moneytotal'], 2, ',', '.')." €</div>";
    echo "</div>";
  echo "</div>";
}

function calculateAverages() {
  global $expenses;
  calculateConsumption();
  foreach ($expenses as $i => $expense) {
    if (!empty($expense['c'])) {
      $cavg += $expense['c'];
      $aux++;
    }
  }
  $consumptionAvg = $cavg/$aux;
  foreach ($expenses as $i => $expense) {     if (!empty($expense['fuel_quantity'])) {  $litres += $expense['fuel_quantity'];}}
  foreach ($expenses as $i => $expense) {     $moneytotal += $expense['price']; }
  $kmtotal = $expenses[0]['km'] - $expenses[count($expenses)-1]['km'];
  $moneyAvg = $moneytotal / $kmtotal;
  $data = array('cavg' => $consumptionAvg, 'litres' => $litres,'kmtotal' => $kmtotal, 'moneytotal' => $moneytotal, 'moneyAvg' => $moneyAvg);
  return $data;
}
?>