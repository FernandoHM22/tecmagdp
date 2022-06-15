<?php
include("../../conexion/conexion.php");
 $id_oportunidad = $_POST['id_oportunidad'];
 $oportunidad = $_POST['oportunidad'];

$sql_actualizaroportunidad = "UPDATE t_oportunidades SET oportunidad = '$oportunidad' WHERE id_oportunidad = '$id_oportunidad'";

if (mysqli_query($conn, $sql_actualizaroportunidad) === TRUE) {
	echo 1;
} else {
	echo 0;
}
