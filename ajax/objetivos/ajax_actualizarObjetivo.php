<?php
include("../../conexion/conexion.php");
$id_objetivo = $_POST['id_objetivo'];
$categoria  = $_POST['categoria'];
$objetivo  = $_POST['objetivo'];
$descripcion  = $_POST['descripcion'];
$meta  = $_POST['meta'];


$sql_objetivo = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_objetivo'");
if (mysqli_num_rows($sql_objetivo) > 0) {
  while ($r = mysqli_fetch_assoc($sql_objetivo)) {
    if ($categoria == '') {
      $categoria = $r['categoria'];
    }

    if ($objetivo == '') {
      $objetivo = $r['objetivo'];
    }

    if ($descripcion == '') {
      $descripcion = $r['descripcion_meta'];
    }

    if ($meta == '') {
      $meta = $r['meta_num'];
    }
  }
  mysqli_free_result($sql_objetivo);
}

$sql = "UPDATE objetivos_gdp SET  categoria = '$categoria', objetivo = '$objetivo', descripcion_meta = '$descripcion', meta_num = '$meta' WHERE id_num_objetives = $id_objetivo";
if ($conn->query($sql) === TRUE) {
  echo 1;
} else {
  echo 0;
}
