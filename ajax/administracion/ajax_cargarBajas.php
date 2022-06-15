<?php
require_once("../../conexion/conexion.php");

if (isset($_FILES['file'])) {
  $limiteColumnas = 1;
  $error = true;
  $arrayReloj = array();
  $file = $_FILES["file"]["tmp_name"];
  $archivo_bajas_abierto = fopen($file, "r");
  $skip_row_number = array("1");
  $i = 0;
  while (($archivo_empleados_tmp = fgetcsv($archivo_bajas_abierto, 1000, ",")) !== false) {
    $i++;
    if (in_array($archivo_empleados_tmp, $skip_row_number)) {
      continue;
    } else {
      if ($i == 2) {
        $columnas = count($archivo_empleados_tmp);
        if ($columnas < $limiteColumnas || $columnas > $limiteColumnas) {
          echo 1;
          $error = true;
        } else {
          $error = false;
        }
      }
      if ($error == false) {
        $arrayReloj[] = $archivo_empleados_tmp[0];
      }
    }
  }

  if ($error != true) {
    $arrayActivos = array();
    $sql_activos = mysqli_query($conn, "SELECT no_reloj FROM registrogdp ORDER BY no_reloj ASC");
    while ($datos = mysqli_fetch_array($sql_activos)) {
      $arrayActivos[] = $datos['0'];
    }

    $noActivos = array_diff($arrayActivos, $arrayReloj);
    foreach ($noActivos as $key => $value) {
      $no_relojs[] = $value;
    }

    $sql_colaboradores_bajas = mysqli_query($conn, "SELECT no_reloj, nombres, apellidos, puesto, depto FROM registrogdp WHERE no_reloj IN(" . implode(',', $no_relojs) . ")");
    if (mysqli_num_rows($sql_colaboradores_bajas) > 0) {
      while ($row = mysqli_fetch_assoc($sql_colaboradores_bajas)) {
        $no_reloj = $row['no_reloj'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $puesto = $row['puesto'];
        $depto = $row['depto'];
        $array_bajas[] = array("no_reloj" => $no_reloj, "nombre" => $nombres, "apellidos" => $apellidos, "puesto" => $puesto, "depto" => $depto);
      }
      mysqli_free_result($sql_colaboradores_bajas);
    }

    header('Content-type: application/json');
    echo json_encode($array_bajas);

    fclose($archivo_bajas_abierto);
    mysqli_close($conn);
  }
} else {
  echo 0;
}
