<?php

include("../../conexion/conexion.php");

$txtcomentario  = $_POST['txtcomentario'];
$txtreloj  = $_POST['txtreloj'];
$txtrelojL  = $_POST['txtrelojL'];

if ($txtcomentario == ''){
 echo "<p class='alert alert-warning d-block'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Por favor revise su registro, no puede dejar campos vacios.</p>";
}else{ 
 $sql = "INSERT INTO t_comentariosEspecialesReddin (comentario, no_relojC, no_relojL)
 VALUES ('".$txtcomentario."','".$txtreloj."','".$txtrelojL."')";
 if ($conn->query($sql) === TRUE) {
		 echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Agregado correctamente</p>";
 } else {
 echo "Error: " . $sql . "<br>" . $conn->error."";
 }
 $conn->close();
} 
?>