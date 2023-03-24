<?php

// Fecha de inicio y fin del año en curso
$fecha_inicio = date("Y") . "-01-01";
$fecha_fin    = date("Y") . "-12-31";

// Arreglo de días de pago
$dias_pago = array(10, 25);

// Arreglo de días de fin de semana
$fin_de_semana = array("Sat", "Sun");

// Arreglo de pagos por mes
$pagos_mes = array();

// Arreglo de pagos por quincena
$pagos_quincena = array();

// Arreglo de pagos por bimestre
$pagos_bimestre = array();

// Variable para el conteo de quincenas
$contador_quincenas = 0;

// Variable para la fecha actual
$fecha_actual = $fecha_inicio;

// Ciclo para calcular los días de pago del año en curso
while ($fecha_actual <= $fecha_fin) {
    $dia_semana = date("D", strtotime($fecha_actual));
    $dia_mes    = date("j", strtotime($fecha_actual));

    if (in_array($dia_mes, $dias_pago)) {
        if (in_array($dia_semana, $fin_de_semana)) {
            $fecha_pago = date("Y-m-d", strtotime($fecha_actual . "last weekday"));
        } else {
            $fecha_pago = $fecha_actual;
        }

        $mes_pago      = date("m", strtotime($fecha_pago));
        $quincena_pago = ceil(date("j", strtotime($fecha_pago)) / 15);
        $bimestre_pago = ceil($mes_pago / 2);

        $pagos_mes[$mes_pago][]           = $fecha_pago;
        $pagos_quincena[$quincena_pago][] = $fecha_pago;
        $pagos_bimestre[$bimestre_pago][] = $fecha_pago;

        // Verificar si es la última quincena del bimestre
        if ($quincena_pago == 2 && $mes_pago % 2 == 0 && date("t", strtotime($fecha_pago)) - date("j", strtotime($fecha_pago)) < 15) {
            $ultima_quincena_bimestre = true;
        } else {
            $ultima_quincena_bimestre = false;
        }
    }

    
    $fecha_actual = date("Y-m-d", strtotime($fecha_actual . "+ 1 day"));
}

// Imprimir los pagos por mes
echo "Pagos por mes:<br>";
foreach ($pagos_mes as $mes => $pagos) {
    echo "Mes " . $mes . ":<br>";
    foreach ($pagos as $pago) {
        echo "- " . $pago . "<br>";
    }
    echo "<br>";
}

// Imprimir los pagos por quincena
echo "Pagos por quincena:<br>";
foreach ($pagos_quincena as $quincena => $pagos) {
    echo "Quincena " . $quincena . ":<br>";
    foreach ($pagos as $pago) {
        echo "- " . $pago . "<br>";
    }
    echo "<br>";
}

// Imprimir los pagos por bimestre
echo "Pagos por bimestre:<br>";
foreach ($pagos_bimestre as $bimestre => $pagos) {
    echo "Bimestre " . $bimestre . ":<br>";
    foreach ($pagos as $pago) {
        echo "- " . $pago . "<br>";
    }
    echo "<br>";
}

?>