<?php
include("../../conexion/conexion.php"); 
$id_ingles = $_POST['string'];
$txtnivelActual = $_POST['txtnivelActual'];
$txtnivelRequerido = $_POST['txtnivelRequerido'];
$txtestatus = $_POST['txtestatus'];
$txtobservaciones = $_POST['txtobservaciones'];


if ($txtnivelActual == '' || $txtnivelRequerido == '' || $txtestatus == '' || $txtobservaciones == ''){
 echo "<p class='alert alert-warning'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Ingrese correcciones</p>";
}else{
 $sql = "UPDATE ingles_esl SET nivel_actual = '$txtnivelActual', nivel_requerido = '$txtnivelRequerido', estatus ='$txtestatus', observaciones ='$txtobservaciones' WHERE id_ingles = $id_ingles";
 if ($conn->query($sql) === TRUE) {
   echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Actualizado correctamente </p>";
 } else {
  echo "Error updating record: " . $conn->error;
 } 
}
?>