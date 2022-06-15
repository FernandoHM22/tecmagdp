<?php
include('../conexion/conexion.php');
$regiones = " AND r.region IN ('";
$regiones .= implode("', '", $_POST['region']);
$regiones .= "')";
$mes = " AND o.mes_reg IN ('";
$mes .= implode("', '", $_POST['mes']);
$mes .= "')";
$depto = " AND r.depto IN ('";
$depto .= implode("', '", $_POST['depto']);
$depto .= "')";

$sql_gptw = mysqli_query($conn, "SELECT g.no_reloj, g.seguimiento, r.nombres, r.apellidos, r.depto, r.region, o.oportunidadConsenso, o.mes_reg, o.tipo_plan, o.no_reloj FROM t_calificaciones_gptw g INNER JOIN registrogdp r ON g.no_reloj = r.no_reloj INNER JOIN t_reddin o ON g.no_reloj = o.no_reloj AND g.seguimiento = '1' AND o.tipo_plan = 'GPTW' " . $regiones . " " . $mes . " " . $depto . "");

if (!$sql_gptw) {
    die('Error');
} else {
    while ($data = mysqli_fetch_assoc($sql_gptw)) {

        $no_reloj = $data['no_reloj'];
        $nombre = $data['nombres']  . " " . $data['apellidos'];
        $region = $data['region'];
        $mes = $data['mes_reg'];
        $depto = $data['depto'];
        $oportunidad = $data['oportunidadConsenso'];

        $arreglo[] = array("no_reloj" => $no_reloj, "nombres" => $nombre, "region" => $region, "mes" => $mes, "depto" => $depto, "oportunidad" => $oportunidad);
    }
    echo json_encode($arreglo);
}
mysqli_free_result($query);
mysqli_close($conexion);
