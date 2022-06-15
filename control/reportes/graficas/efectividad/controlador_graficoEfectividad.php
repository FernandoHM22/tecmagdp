<?php 
	require 'modelo_graficoEfectividad.php';
	$no_reloj = $_POST['noReloj'];
	$MG = new Modelo_Grafico();
	$consulta = $MG -> TraerDatosGraficoLine($no_reloj);
	echo json_encode($consulta);
?>