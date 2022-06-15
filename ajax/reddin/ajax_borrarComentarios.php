<?php
include("../../conexion/conexion.php"); 
 $id=$_POST['string'];
 $sql = "DELETE FROM t_comentariosEspecialesReddin WHERE id_comentario ='$id'";
 if ($conn->query($sql) === TRUE) {
  echo "<p class='alert alert-danger d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Eliminado correctamente </p>";
 } else {
  echo "Error deleting record: " . $conn->error;
 } 
 
?>