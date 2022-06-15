<?php
include("../../conexion/conexion.php");
$arrayDeptos = $_POST['arrayDeptos'];
$on = 1;
$off = 0;
$totalDeptos = count($arrayDeptos);
$n = $totalDeptos;
foreach($arrayDeptos as $value => $key){
	$query = "UPDATE registrogdp SET habilitarEvaluacion = '$on' WHERE depto = '$key'";
	$insert = mysqli_query($conn, $query)or die (mysqli_error($conn));
	$n--;
}
if ($n === 0) {
	echo "<label style=' color:#00b000'><i class='fas fa-check'></i> Habilitada correctamente</label>";
} else {
	echo "Error updating record: " . $conn->error;
}
?>