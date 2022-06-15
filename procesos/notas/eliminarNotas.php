<?php
require_once "../../conexion/notas.php";
$Gestor = new notas();
$nota = $_POST['nota'];

echo $Gestor->eliminarNota($nota);

echo $Gestor->eliminarNotaReddin($nota);


?>