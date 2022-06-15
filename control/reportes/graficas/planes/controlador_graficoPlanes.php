<?php 
	require 'modelo_graficoPlanes.php';
	
	$MG = new Modelo_Grafico();
	$consulta = $MG -> TraerDatosGraficoBar();
	echo json_encode($consulta);
?>