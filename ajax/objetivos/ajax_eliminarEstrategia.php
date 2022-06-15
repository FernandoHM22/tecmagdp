<?php
include("../../conexion/conexion.php"); 
 $id=$_POST['string'];
 $sql = "DELETE FROM objetivos_gdp WHERE id_num_objetives = '$id'";

 if ($conn->query($sql) === TRUE) {
  echo 1;
 } else {
  echo 0;
 } 
 
?>