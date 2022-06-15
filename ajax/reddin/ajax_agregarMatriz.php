<?php
include("../../conexion/conexion.php");

$potencial = $_POST['potencial'];
$desempeno = $_POST['desempeno'];
$relojC = $_POST['no_reloj'];
$anio_actual = date('Y');

$sqlSearch = mysqli_query($conn, "SELECT * FROM t_matriz WHERE no_reloj = '$relojC'");
if (mysqli_num_rows($sqlSearch) > 0) {
	while ($datos = mysqli_fetch_array($sqlSearch)) {
		$sql = "UPDATE t_matriz SET potencial = '$potencial', desempeno = '$desempeno' WHERE no_reloj= '$relojC'";
		if ($conn->query($sql) === TRUE) {
			echo 2;
		} else {
			echo 0;
		}
	}
} else {
	$sql = "INSERT INTO t_matriz (no_reloj, potencial, desempeno) VALUES ('$relojC','$potencial', '$desempeno')";
	if ($conn->query($sql) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
	
}

$conn->close();
