<?php
class Modelo_Grafico
{
	private $conexion;
	function __construct()
	{
		require_once('../conexion.php');
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}


	function TraerDatosGraficoBar($region)
	{
		if ($region != 'all') {
			$sql = "SELECT p.mejora, COUNT(p.mejora) AS totalOportunidades FROM planeacion_gdp p INNER JOIN registrogdp d ON p.plan_no_reloj = d.no_reloj WHERE p.estatus_plan = 'Actual' AND p.mejora != '' AND d.region = '$region' GROUP BY p.mejora ORDER BY totalOportunidades DESC";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		} else {
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
}
