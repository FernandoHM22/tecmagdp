<?php
include("../../conexion/conexion.php");
$arrayFortalezas = $_POST['checkboxFortalezas'];
$arrayOportunidades = $_POST['checkboxOportunidades'];
$relojColaborador = $_POST['relojColaborador'];
$arrayIDsFortalezas = $_POST['arrayIDsFortalezas'];
$arrayIDsOportunidades = $_POST['arrayIDsOportunidades'];
$totalFortalezas = count($arrayFortalezas);
$n = $totalFortalezas;
foreach (array_combine($arrayIDsFortalezas, $arrayFortalezas) as $id => $fortalezas) {
	$query = "UPDATE t_fortalezas SET fortaleza = '$fortalezas' WHERE id_fortaleza = $id";
	$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
	$n--;
}
$totalOportunidades = count($arrayOportunidades);
$i= $totalOportunidades;
foreach (array_combine($arrayIDsOportunidades, $arrayOportunidades) as $id => $oportunidades) {
	$query = "UPDATE t_oportunidades SET oportunidad = '$oportunidades' WHERE id_oportunidad = $id";
	$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
	$i--;
}
if ($i === 0 && $n === 0 ) {
	echo 1;
}
$conn->close();
?>
