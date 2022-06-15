<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
$arrayFortalezas = $_POST['checkboxFortalezas'];
$arrayOportunidades = $_POST['checkboxOportunidades'];

	$totalOportunidades = count($arrayOportunidades);
	$i= $totalOportunidades;
	foreach($arrayOportunidades as $key => $value){ 
		$no_reloj = $_POST['no_reloj'];
		$query = "INSERT INTO t_oportunidades (oportunidad, no_reloj) VALUES ('$value', '$no_reloj')";
		$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
		$i--;
	}

	$totalFortalezas = count($arrayFortalezas);
	$n = $totalFortalezas;
	foreach($arrayFortalezas as $value => $key){  
		$no_reloj = $_POST['no_reloj'];
		$query = "INSERT INTO t_fortalezas (fortaleza, no_reloj) VALUES ('$key', '$no_reloj')";
		$insert = mysqli_query($conn, $query)or die (mysqli_error($conn));
		$n--;
	}

	if ($i === 0 && $n === 0 ) {
		 echo 1;
	}
	$conn->close();
?>
