<?php
include("../../conexion/conexion.php");

$año = $_POST['año'];
$chbxSwith = $_POST['chbxSwith'];
if ($chbxSwith == 2) {
	$sql = "UPDATE objetives_gdp SET estatus_objetivos = '$chbxSwith' WHERE año_reg = '$año'";
	if ($conn->query($sql) === TRUE) {
		echo "<label class='float-right' style=' color:#00b000'><i class='fas fa-check'></i> Habilitada correctamente</label>";
	} else {
		echo "Error updating record: " . $conn->error;
	}
}else{
	$sql = "UPDATE objetives_gdp SET estatus_objetivos = '$chbxSwith' WHERE año_reg = '$año'";
	if ($conn->query($sql) === TRUE) {
		echo "<label class='float-right' style='color:#B00000'><i class='fas fa-times'></i> Deshabilitado Correctamente</label>";
	} else {
		echo "Error updating record: " . $conn->error;
	}
}
?>