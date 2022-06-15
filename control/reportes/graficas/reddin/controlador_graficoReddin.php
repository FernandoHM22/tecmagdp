<?php 
	require 'modelo_graficoReddin.php';
	
	$MG = new Modelo_Grafico();
	$consulta = $MG -> TraerDatosGraficoReddin();
	echo json_encode($consulta);
?>