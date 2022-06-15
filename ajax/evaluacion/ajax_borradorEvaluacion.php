<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
$array_evaluacionMasiva = $_POST['array_evaluacionMasiva'];
$array_oportunidades = $_POST['array_oportunidades'];
$array_fortaleza = $_POST['array_fortaleza'];

$all_values_evaluacion = [];
$sql_evaluacion = "INSERT INTO t_evaluacion (no_reloj, reloj_lider,anio_reg, competencia1, competencia2, competencia3, competencia4, competencia5, competencia6, competencia7, competencia8, competencia9, competencia10, competencia11, competencia12, competencia13, competencia14, competencia15, competencia16, competencia17, competencia18, competencia19, competencia20, estatusEvaluacion) VALUES ";

foreach ($array_evaluacionMasiva as $key) {
	$row_values = [];
	foreach ($key as $skey => $s_value) {
		$row_values[] = '"' . $s_value . '"';
	}
	$all_values_evaluacion[] = '(' . implode(',', $row_values) . ')';
}
$sql_evaluacion .= implode(',', $all_values_evaluacion);
if (mysqli_query($conn, $sql_evaluacion) or die(mysqli_error($conn))) {
	foreach ($array_oportunidades as $key_oportunidad) {
		$o = count($key_oportunidad[4]);
		foreach ($key_oportunidad[4] as $skey_oportunidad => $s_value_oportunidad) {
			$o--;
			$sql_oportunidades = "INSERT INTO t_oportunidades(oportunidad, no_reloj, reloj_lider) VALUES ('$s_value_oportunidad','$key_oportunidad[0]','$key_oportunidad[1]')";
			$run_sql_oportunidades = mysqli_query($conn, $sql_oportunidades);
		}
	}
	foreach ($array_fortaleza as $key_fortalezas) {
		$f = count($key_fortalezas[4]);
		foreach ($key_fortalezas[4] as $skey => $s_value_fortalezas) {
			$f--;
			$sql_fortalezas = "INSERT INTO t_fortalezas(fortaleza, no_reloj, reloj_lider) VALUES ('$s_value_fortalezas','$key_fortalezas[0]','$key_fortalezas[1]')";
			$run_sql_fortalezas = mysqli_query($conn, $sql_fortalezas);
		}
	}
	if($o == 0 && $f == 0){
		echo 1;
	}
} else {
	echo 0;
}

mysqli_close($conn);
