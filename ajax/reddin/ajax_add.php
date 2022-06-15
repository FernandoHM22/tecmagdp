<?php

include("../../conexion/conexion.php");
$oportunidad  = $_POST['oportunidad'];
$notas  = $_POST['notas'];
$relojC = $_POST['no_reloj'];
$fechacompromiso = $_POST['fechaCompromiso'];
$indicadores = $_POST['indicador'];
$fecha = $_POST['fecha_reg'];
$tipo_plan = $_POST['tipo_plan'];
$mes = $_POST['mes'];
$ano = $_POST['anio'];
$estatus  = "Actual";
if ($oportunidad == '' || $notas == '') {
	echo "<p class='alert alert-warning d-block'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Por favor revise su registro, no puede dejar campos vacios.</p>";
} else {
	if ($indicadores == '') {
		$sql = "INSERT INTO t_reddin (oportunidadConsenso,tipo_plan, fecha,  mes_reg, year_reg, date_reg_action, no_reloj, estatus)
	VALUES ('$oportunidad', '$tipo_plan','$fechacompromiso','$mes','$ano','$fecha','$relojC','$estatus')";
	} else {
		$sql = "INSERT INTO t_reddin (oportunidadConsenso,tipo_plan, indicadores, fecha,  mes_reg, year_reg, date_reg_action, no_reloj, estatus)
		VALUES ('$oportunidad', '$tipo_plan','$indicadores','$fechacompromiso','$mes','$ano','$fecha','$relojC','$estatus')";
	}
	if ($conn->query($sql) === TRUE) {
		$sql2 = "UPDATE t_reddin SET id_nota = LAST_INSERT_ID(), notas = '$notas' WHERE id_reddin = LAST_INSERT_ID()";
		if ($conn->query($sql2) === TRUE) {
			echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Agregado correctamente</p>";
		}
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error . "";
	}
	$conn->close();
}
