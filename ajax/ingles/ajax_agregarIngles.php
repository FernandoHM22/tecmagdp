	<?php
include("../../conexion/conexion.php");
$txtnivelActual  = $_POST['txtnivelActual'];
$txtnivelRequerido  = $_POST['txtnivelRequerido'];
$txtestatus  = $_POST['txtestatus'];
$txtobservaciones  = $_POST['txtobservaciones'];
$txtreloj  = $_POST['txtreloj'];

if ($txtnivelActual == '' || $txtnivelRequerido == '' || $txtestatus == '' || $txtobservaciones == '' || $txtreloj == ''){
	echo "<p class='alert alert-warning d-block'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Por favor ingrese su objetivo</p>";
}else{
	$sql = "INSERT INTO ingles_esl (nivel_actual, nivel_requerido, estatus, observaciones, els_no_reloj) VALUES ('".$txtnivelActual."','".$txtnivelRequerido."','".$txtestatus."','".$txtobservaciones."','".$txtreloj."')";
	if ($conn->query($sql) === TRUE) {
		echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Agregado correctamente</p>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error."";
	}
	$conn->close();
}

	
?>