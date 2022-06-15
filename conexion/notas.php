<?php
require_once "Config.php";
class notas extends Conectar

{
	public function eliminarNota($nota){
		$Conexion = Conectar::Conexion();
		$sql = "DELETE FROM planeacion_gdp WHERE notas = ?";
		$query = $Conexion-> prepare($sql);
		$query->bind_param("s", $nota);
		$respuesta = $query->execute();
		$query->close();
		return $respuesta;
	}

	public function eliminarNotaReddin($nota){
		$Conexion = Conectar::Conexion();
		$sql = "UPDATE t_reddin SET id_nota = NULL, notas = NULL WHERE notas = ?";
		$query = $Conexion-> prepare($sql);
		$query->bind_param("s", $nota);
		$respuesta = $query->execute();
		$query->close();
		return $respuesta;
	}

}

?>