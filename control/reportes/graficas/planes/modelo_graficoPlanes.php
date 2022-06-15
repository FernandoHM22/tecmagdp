<?php
	class Modelo_Grafico{
		private $conexion;
		function __construct()
		{
			require_once('../conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
        }


		function TraerDatosGraficoBar(){
			$sql = "SELECT mejora, COUNT(mejora) AS totalOportunidades FROM planeacion_gdp WHERE estatus_plan = 'Actual' AND mejora != '' GROUP BY mejora ORDER BY totalOportunidades DESC";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
	}
?>