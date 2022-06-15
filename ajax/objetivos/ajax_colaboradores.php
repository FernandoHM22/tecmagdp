<?php
include("../../conexion/conexion.php");
$users_arr = array();
$reloj_sup = $_POST['no_reloj'];

$sql = "SELECT no_reloj, nombres, apellidos FROM registrogdp WHERE no_reloj_supervisor ='$reloj_sup'";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
  $no_reloj = $row['no_reloj'];
  $nombres = $row['nombres'];
  $apellidos = $row['apellidos'];

  $users_arr[] = array("no_reloj" => $no_reloj, "nombres" => $nombres, "apellidos" => $apellidos);
}


echo json_encode($users_arr);
