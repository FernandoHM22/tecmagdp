<?php
include("../../conexion/conexion.php");
$id_objetivo = $_POST['id_objetivo'];

$sql_estrategias = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_rel_estrategia = '$id_objetivo'");
if (mysqli_num_rows($sql_estrategias) > 0) {
    $sql_eliminar_estrategias = "DELETE FROM objetivos_gdp WHERE id_rel_estrategia = '$id_objetivo'";
    if ($conn->query($sql_eliminar_estrategias) === TRUE) {
        $sql_eliminar_objetivo = "DELETE FROM objetivos_gdp WHERE id_num_objetives = '$id_objetivo'";
        if ($conn->query($sql_eliminar_objetivo) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    $sql_eliminar_objetivo = "DELETE FROM objetivos_gdp WHERE id_num_objetives = '$id_objetivo'";

    if ($conn->query($sql_eliminar_objetivo) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}
