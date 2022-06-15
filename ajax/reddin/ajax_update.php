<?php
include("../../conexion/conexion.php");
$string  = $_POST['string'];
$oportunidad = $_POST['oportunidad'];
$notas  = $_POST['nota'];

$sql_objetivo = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_reddin = '$string'");
if (mysqli_num_rows($sql_objetivo) > 0) {
  while ($r = mysqli_fetch_assoc($sql_objetivo)) {
    if ($oportunidad == '') {
      $oportunidad = $r['oportunidadConsenso'];
    }

    if ($notas == '') {
      $notas = $r['notas'];
    }
  }
  mysqli_free_result($sql_objetivo);
}

$sql = "UPDATE t_reddin SET oportunidadConsenso='$oportunidad', notas='$notas' WHERE id_reddin = '$string'";
if ($conn->query($sql) === TRUE) {
  echo 1;
} else {
  echo 0;
}
