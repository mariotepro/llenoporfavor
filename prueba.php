<?php
include 'php/connection.php';

$sql4     = "SELECT * FROM expenses WHERE id_veh = 10 ORDER BY date DESC";
$result4  = $con->query($sql4);
while ($row4  = mysqli_fetch_array($result4))     $expenses[] = $row4;                  //Almacenamos todas las filas en un array auxiliar.

for ($i=0; $i < count($expenses); $i++) {                                              //Sacamos el consumo a los 100
  
  echo "</br></br>Gasto ".$i;
  echo "</br>------------";
  $c = false;
  echo "</br>AQUI1: ".$c;
  if ($expenses[$i]['type'] == "fueling") {
    for ($j = $i+1; $j < count($expenses); $j++) {
    	echo "</br>AQUI2: ".$c;
      if ($expenses[$j]['type'] == "fueling" && $c == false) {
        $km     = $expenses[$i]['km'] - $expenses[$j]['km'];
        echo "</br>KM de i: ".$expenses[$i]['km'];
        echo "</br>KM de j: ".$expenses[$j]['km'];
        echo "</br>KM: ".$km;
        $litres = $expenses[$i]['fuel_quantity'];
        $expenses[$i]['c'] = ($litres/$km)*100;
        echo "</br>Consumo de ".$i.": ".$expenses[$i]['c'];
        echo "</br>Consumo de ".$i." almacenado: ".$expenses[$i]['c'];
        $c = true;
      }
    }
  }
}
?>