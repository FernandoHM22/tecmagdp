<?php 
	require 'modelo_graficoReddinParametros.php';
	$region = $_POST['region'];
	$MG = new Modelo_Grafico();
	$consulta = $MG -> TraerDatosGraficoBar($region);
	echo json_encode($consulta);
?>