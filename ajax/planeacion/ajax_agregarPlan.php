<?php
include("../../conexion/conexion.php");
$oportunidad  = $_POST['txtoportunidad'];
$acciones  = $_POST['txtaccion'];
$fecha  = $_POST['txtfecha'];
$tipo_plan  = $_POST['tipo_plan'];
$indicadores  = $_POST['indicadores'];
$estatus  = $_POST['txtestatus'];
$reloj  = $_POST['txtreloj'];
$fechaReg  = $_POST['txtfechaReg'];
$mesReg  = $_POST['txtmesReg'];
$yearReg  = $_POST['txtyearReg'];

$sql = "INSERT INTO t_reddin (oportunidadConsenso, tipo_plan, acciones, indicadores, fecha, mes_reg, year_reg, date_reg_action, no_reloj, estatus) VALUES ('$oportunidad','$tipo_plan','$acciones', '$indicadores', '$fecha','$mesReg','$yearReg','$fechaReg', '$reloj','$estatus')";
if ($conn->query($sql) === TRUE) {
	echo 1;
} else {
	echo 0;
}
$conn->close();
