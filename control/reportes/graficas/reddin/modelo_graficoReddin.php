<?php
	class Modelo_Grafico{
		private $conexion;
		function __construct()
		{
			require_once('../conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
        }


		function TraerDatosGraficoReddin(){
			$sql = "SELECT oportunidadConsenso, COUNT(oportunidadConsenso) AS totalOportunidades FROM t_reddin WHERE estatus = 'Actual' AND oportunidadConsenso != '' GROUP BY oportunidadConsenso ORDER BY totalOportunidades DESC;";	
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