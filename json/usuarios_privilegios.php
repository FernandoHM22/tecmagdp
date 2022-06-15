<?php 
include('../conexion/conexion.php');
$query = mysqli_query($conn, "SELECT r.no_reloj, r.nombres, r.apellidos, r.puesto, r.depto, l.no_reloj, l.isAdmin, l.perfil FROM registrogdp r INNER JOIN login_gdp l ON r.no_reloj = l.no_reloj ORDER BY l.isAdmin DESC") or die(mysqli_error($conn));

if(!$query){
die('Error');
}else{
    while ($data = mysqli_fetch_assoc($query)) {
        $arreglo["data"][] = array_map("utf8_encode", $data);
    }
    echo json_encode($arreglo);
}
mysqli_free_result($query);
mysqli_close($conexion);