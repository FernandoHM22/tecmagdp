<?php 
class Conectar{
	public function Conexion(){
		$Conexion= new mysqli("mx60.hostgator.mx","tecmagdp_admin","15A8V19dgQe$","tecmagdp_gdp");
		if($Conexion->connect_error){
			echo "Falló al conectar :". $Conexion->connect_error;
		}

		$Conexion->set_charset("utf8");
		return $Conexion;
	}
}

?>