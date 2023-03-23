<?php

// Definir los días de pago
$pay_days = [10, 25];

// Obtener el año actual
$current_year = date('Y');

// Definir la matriz para almacenar las fechas de pago
$pay_dates = [];

// Recorrer los meses del año
for ($month = 1; $month <= 12; $month++) {

    // Recorrer los días de pago
    foreach ($pay_days as $pay_day) {

        // Obtener la fecha de pago del mes actual
        $pay_date = date("$current_year-$month-$pay_day");

        // Verificar si la fecha de pago cae en fin de semana
        $weekday = date('w', strtotime($pay_date));
        if ($weekday == 0) { // Domingo
            $pay_date = date('Y-m-d', strtotime("$pay_date -2 days")); // Pagar el viernes anterior
        } elseif ($weekday == 6) { // Sábado
            $pay_date = date('Y-m-d', strtotime("$pay_date -1 day")); // Pagar el viernes anterior
        }

        // Agregar la fecha de pago a la matriz
        $pay_dates[] = $pay_date;
    }
}

// Ordenar las fechas de pago de forma ascendente
//sort($pay_dates);

// Imprimir las fechas de pago
echo "Fechas de pago para el año $current_year:\n";
foreach ($pay_dates as $pay_date) {
    echo $pay_date."<br>";
}
?>