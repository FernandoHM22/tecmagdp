<?php
include("../../conexion/conexion.php");
$id = $_POST['id'];
$tipo = $_POST['tipo'];
$valor = $_POST['inputValue'];

if ($tipo == 'fortaleza') {
	$sql_actualizar_fortaleza = "UPDATE t_fortalezas SET fortaleza = '$valor' WHERE id_fortaleza = '$id'";
	if (mysqli_query($conn, $sql_actualizar_fortaleza) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	$sql_actualizar_oportunidad = "UPDATE t_oportunidades SET oportunidad = '$valor' WHERE id_oportunidad = '$id'";
	if (mysqli_query($conn, $sql_actualizar_oportunidad) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
}

mysqli_close($conn);
