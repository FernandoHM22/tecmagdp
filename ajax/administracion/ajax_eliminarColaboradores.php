<?php
include("../../conexion/conexion.php");
$no_relojs = $_POST['no_relojColaboradores'];

$sql_eliminar_registro = "DELETE FROM registrogdp WHERE no_reloj IN (" . implode(',', $no_relojs) . ")";
if (mysqli_query($conn, $sql_eliminar_registro) === TRUE) {
    $sql_eliminar_login = "DELETE FROM login_gdp WHERE no_reloj IN (" . implode(',', $no_relojs) . ")";
    if (mysqli_query($conn, $sql_eliminar_login) === TRUE) {
        $sql_eliminar_ficha = "DELETE FROM t_fichatalento WHERE reloj_colaborador IN (" . implode(',', $no_relojs) . ")";
        if (mysqli_query($conn, $sql_eliminar_ficha) === TRUE) {
            echo 1;
        }
    }
}
