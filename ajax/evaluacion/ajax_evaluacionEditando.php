<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
$array_evaluacionMasiva = $_POST['array_evaluacionMasiva'];
$array_oportunidades = $_POST['array_oportunidades'];
$array_fortaleza = $_POST['array_fortaleza'];
$totalEvaluacion = count($array_evaluacionMasiva);
$sql_evaluacion = mysqli_query($conn, "SELECT * FROM t_evaluacion WHERE reloj_lider = '$no_reloj'");
if (mysqli_num_rows($sql_evaluacion) > 0) {

	foreach ($array_evaluacionMasiva as $key => $value) {
		$totalEvaluacion--;
		$sql_actualizar_evaluacion = mysqli_query($conn, "UPDATE t_evaluacion
		SET
		competencia1 = '$value[3]',
		competencia2 = '$value[4]',
		competencia3 = '$value[5]',
		competencia4 = '$value[6]',
		competencia5 = '$value[7]',
		competencia6 = '$value[8]',
		competencia7 = '$value[9]',
		competencia8 = '$value[10]',
		competencia9 = '$value[11]',
		competencia10 = '$value[12]',
		competencia11 = '$value[13]',
		competencia12 = '$value[14]',
		competencia13 = '$value[15]',
		competencia14 = '$value[16]',
		competencia15 = '$value[17]',
		competencia16 = '$value[18]',
		competencia17 = '$value[19]',
		competencia18 = '$value[20]',
		competencia19 = '$value[21]',
		competencia20 = '$value[22]',
		estatusEvaluacion = '$value[23]'
		WHERE no_reloj = '$value[0]' AND anio_reg ='$value[2]'");
	}
} else {
	// $all_values_evaluacion = [];
	// $sql_evaluacion = "INSERT INTO t_evaluacion (no_reloj, reloj_lider,anio_reg, competencia1, competencia2, competencia3, competencia4, competencia5, competencia6, competencia7, competencia8, competencia9, competencia10, competencia11, competencia12, competencia13, competencia14, competencia15, competencia16, competencia17, competencia18, competencia19, competencia20, estatusEvaluacion) VALUES ";

	// foreach ($array_evaluacionMasiva as $key) {
	// 	$row_values = [];
	// 	foreach ($key as $skey => $s_value) {
	// 		$row_values[] = '"' . $s_value . '"';
	// 	}
	// 	$all_values_evaluacion[] = '(' . implode(',', $row_values) . ')';
	// }
	// $sql_evaluacion .= implode(',', $all_values_evaluacion);
	// if (mysqli_query($conn, $sql_evaluacion) or die(mysqli_error($conn))) {
	// 	foreach ($array_oportunidades as $key_oportunidad) {
	// 		foreach ($key_oportunidad[3] as $skey_oportunidad => $s_value_oportunidad) {
	// 			$sql_oportunidades = "INSERT INTO t_oportunidades(oportunidad, no_reloj, reloj_lider) VALUES ('$s_value_oportunidad','$key_oportunidad[0]','$key_oportunidad[1]')";
	// 			$run_sql_oportunidades = mysqli_query($conn, $sql_oportunidades);
	// 		}
	// 	}
	// 	foreach ($array_fortaleza as $key_fortalezas) {
	// 		foreach ($key_fortalezas[3] as $skey => $s_value_fortalezas) {
	// 			$sql_fortalezas = "INSERT INTO t_fortalezas(fortaleza, no_reloj, reloj_lider) VALUES ('$s_value_fortalezas','$key_fortalezas[0]','$key_fortalezas[1]')";
	// 			$run_sql_fortalezas = mysqli_query($conn, $sql_fortalezas);
	// 		}
	// 	}
	// 	echo 1;
	// } else {
	// 	echo 0;
	// }
}



mysqli_close($conn);
