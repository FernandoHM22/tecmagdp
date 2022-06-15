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
			$sql = "SELECT r.oportunidadConsenso, COUNT(r.oportunidadConsenso) AS totalOportunidades FROM t_reddin r INNER JOIN registrogdp d ON r.no_reloj = d.no_reloj WHERE r.estatus = 'Actual' AND r.oportunidadConsenso != '' AND d.region = '$region' GROUP BY r.oportunidadConsenso ORDER BY totalOportunidades DESC";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		} else {
			$sql = "SELECT oportunidadConsenso, COUNT(oportunidadConsenso) AS totalOportunidades FROM t_reddin WHERE estatus = 'Actual' AND oportunidadConsenso != '' GROUP BY oportunidadConsenso ORDER BY totalOportunidades DESC";
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
