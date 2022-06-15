<?php
include("../../conexion/conexion.php");
 $id_fortaleza = $_POST['id_fortaleza'];
 $fortaleza = $_POST['fortaleza'];

$sql_actualizarFortaleza = "UPDATE t_fortalezas SET fortaleza = '$fortaleza' WHERE id_fortaleza = '$id_fortaleza'";

if (mysqli_query($conn, $sql_actualizarFortaleza) === TRUE) {
	echo 1;
} else {
	echo 0;
}
