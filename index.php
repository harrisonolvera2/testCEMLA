<?php

// Definir los días de pago
$pay_days = [10, 25];

// Definir el número de días a buscar
$days_to_search = 7;

// Definir la matriz para almacenar las fechas de pago
$pay_dates = [];

// Recorrer los días de pago
foreach ($pay_days as $pay_day) {
  // Obtener la fecha de pago del mes actual
  $pay_date = date("Y-m-$pay_day");

  // Verificar si la fecha de pago cae en fin de semana
  $weekday = date("w", strtotime($pay_date));
  if ($weekday == 0) { // Domingo
    $pay_date = date("Y-m-d", strtotime("$pay_date -2 days")); // Pagar el viernes anterior
  } elseif ($weekday == 6) { // Sábado
    $pay_date = date("Y-m-d", strtotime("$pay_date -1 day")); // Pagar el viernes anterior
  }

  // Agregar la fecha de pago a la matriz
  $pay_dates[] = $pay_date;

  // Buscar los días hábiles siguientes
  $days_found = 0;
  $current_date = strtotime($pay_date);
  while ($days_found < $days_to_search) {
    $current_date = strtotime("+1 day", $current_date);
    $weekday = date("w", $current_date);
    if ($weekday != 0 && $weekday != 6) { // Día hábil
      $pay_dates[] = date("Y-m-d", $current_date);
      $days_found++;
    }
  }
}

// Imprimir la matriz de fechas de pago
print_r($pay_dates);

?>