
<?php
include("../../conexion/conexion.php"); 
$string  = $_POST['string'];
$txtcomentario = $_POST['txtcomentario'];

if ($txtcomentario == ''){
 echo "<p class='alert alert-warning'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Ingrese correcciones</p>";
}else{
 $sql = "UPDATE t_comentariosEspecialesReddin SET comentario = '$txtcomentario' WHERE id_comentario = '$string' ";
 if ($conn->query($sql) === TRUE) {
   echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Actualizado correctamente </p>";
 } else {
  echo "Error updating record: " . $conn->error;
 } 
}
?>