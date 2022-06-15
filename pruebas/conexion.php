<?php 
class Conectar{
	public function Conexion(){
		$Conexion= new mysqli("mco26.prodns.mx","tecmadoc_admin","2X54,T&WFD,$","tecmadoc_gestor");
		if($Conexion->connect_error){
			echo "Falló al conectar : ". $Conexion->connect_error;
		}
		$Conexion->set_charset("utf8");
		return $Conexion;
	}
}

?>