<?php
include("../../conexion/conexion.php");

$chbxSwith = $_POST['chbxSwith'];

if ($chbxSwith == 1) {
	$sql = "UPDATE t_comportamientoObjetivos SET estadoBtn = '$chbxSwith' WHERE nombreBtn = 'agregarObjetivos'";
	if ($conn->query($sql) === TRUE) {
		echo "<label class='float-right' style=' color:#00b000'><i class='fas fa-check'></i> Habilitada correctamente</label>";
	}else { echo "Error updating record: " . $conn->error;}
}else{
	$sql = "UPDATE t_comportamientoObjetivos SET estadoBtn = '$chbxSwith' WHERE nombreBtn = 'agregarObjetivos'";
	if ($conn->query($sql) === TRUE) {
		echo "<label class='float-right' style=' color:#b00000'><i class='fas fa-times'></i> deshabilitado correctamente</label>";
	}else { echo "Error updating record: " . $conn->error;}
}

?>