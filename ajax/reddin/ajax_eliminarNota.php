<?php
require_once '../../conexion/conexion.php';
$id_nota = $_POST['id_nota'];

$sql_borrar_nota = "UPDATE t_reddin SET notas = null, id_nota = null WHERE id_nota = '$id_nota'";
if (mysqli_query($conn, $sql_borrar_nota) === TRUE) {
    echo 1;
} else {
    echo 0;
}
