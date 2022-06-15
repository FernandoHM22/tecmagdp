<?php
require_once "Config.php";
class Plan extends Conectar

{
	public function actualizarEstatusPlanesPorID($idPlan){
		$Conexion = Conectar::Conexion();
		$sql = "UPDATE planeacion_gdp SET estatus_plan = 'Actual' WHERE id_plan = ?";
		$query = $Conexion-> prepare($sql);
		$query->bind_param("i", $idPlan);
		$respuesta = $query->execute();
		$query->close();
		return $respuesta;
	}

}

?>