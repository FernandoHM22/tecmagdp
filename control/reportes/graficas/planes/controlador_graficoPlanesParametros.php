<?php 
	require 'modelo_graficoPlanesParametros.php';
	$region = $_POST['region'];
	$MG = new Modelo_Grafico();
	$consulta = $MG -> TraerDatosGraficoBar($region);
	echo json_encode($consulta);
?>