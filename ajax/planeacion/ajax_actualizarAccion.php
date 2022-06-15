<?php
include("../../conexion/conexion.php"); 
$id_plan = $_POST['string'];
$txtfecha = $_POST['txtfecha'];
$txtaccion = $_POST['txtaccion'];

$sql = "UPDATE planeacion_gdp SET more_actions = '$txtaccion', date_reg_action = '$txtfecha' WHERE id_plan = $id_plan";
if ($conn->query($sql) === TRUE) {
	echo 1;
} else {
	echo 0;
} 

?>