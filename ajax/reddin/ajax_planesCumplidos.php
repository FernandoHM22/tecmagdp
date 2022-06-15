<?php
include("../../conexion/conexion.php");
$arrayCumplidos = $_POST['checkboxCumplidos'];

$totalCumplidos = count($arrayCumplidos);
	$i= $totalCumplidos;	
	foreach($arrayCumplidos as $id => $value){ 	
		$query = "UPDATE t_reddin SET estatus = 'Cumplido' WHERE id_reddin = $value";
		$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
		$i--;
	}
if ($i === 0 ) {
	echo 1;
}
$conn->close();

?>
