<?php 
include("../../conexion/conexion.php");

$sql = "TRUNCATE TABLE t_oportunidades";
if ($conn->query($sql) === TRUE) {
	$sql2 = "TRUNCATE TABLE t_fortalezas";
	if ($conn->query($sql2) === TRUE) {
		echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
		<strong>Eliminado Correctamente!</strong>.
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
		</button>
		</div>";
	}
} else {
	echo "Error al borrar: " . $conn->error;
} 
?>