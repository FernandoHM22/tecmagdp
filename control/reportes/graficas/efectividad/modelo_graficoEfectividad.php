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


    function TraerDatosGraficoLine($no_reloj)
    {

        $sql = "SELECT * FROM t_efectividad_gerencial WHERE no_reloj = '$no_reloj' ORDER BY anio_reg ASC";

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
