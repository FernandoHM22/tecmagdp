<?php
include("../../conexion/conexion.php");
$id_objetivo = $_POST['id_objetivo'];
$txtestrategia  = $_POST['estrategia'];
$txtdescripcion  = $_POST['descripcion_metrico'];
$txtmedida  = $_POST['metrico'];
$txtponderacion  = $_POST['ponderacion'];
$array_responsable  = $_POST['responsable'];
$responsable = implode("','", $array_responsable);
$sql_estrategia = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_objetivo'");
if (mysqli_num_rows($sql_estrategia) > 0) {
  while ($r = mysqli_fetch_assoc($sql_estrategia)) {
    if ($txtestrategia == '') {
      $txtestrategia = $r['estrategia'];
    }

    if ($txtdescripcion == '') {
      $txtdescripcion = $r['metricos_kpi'];
    }

    if ($txtmedida == '') {
      $txtmedida = $r['medida_estrategia'];
    }

    if ($txtponderacion == '') {
      $txtponderacion = $r['ponderacion_num'];
    }
    if ($responsable == '') {
       $responsable = $r['responsable'];
    }
  }
  mysqli_free_result($sql_estrategia);
}

$sql = 'UPDATE objetivos_gdp SET estrategia = "' . $txtestrategia . '", metricos_kpi = "' . $txtdescripcion . '", medida_estrategia = "' . $txtmedida . '", ponderacion_num = "' . $txtponderacion . '", responsable = "' . $responsable . '" WHERE id_num_objetives = "' . $id_objetivo . '"';

if ($conn->query($sql) === TRUE) {
  echo 1;
} else {
  echo 0;
}

$conn->close();
