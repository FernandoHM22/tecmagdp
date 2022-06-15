<?php
include("../../conexion/conexion.php");
$id_evaluacion = $_POST['id_evaluacion'];
$competencia = $_POST['competencia'];
$calificacion = $_POST['calificacion'];

$sql_actualizarEvaluacion = "UPDATE t_evaluacion SET $competencia = '$calificacion' WHERE id_evaluacion = '$id_evaluacion'";
if (mysqli_query($conn, $sql_actualizarEvaluacion) === TRUE) {
	echo 1;
} else {
	echo 0;
}

mysqli_close($conn);
