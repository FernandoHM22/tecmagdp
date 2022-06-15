<?php
include("../../conexion/conexion.php");
$mes = $_POST['mes_input'];
$anio_actual = $_POST['anio_input'];
$estatus = '1';

if (isset($_FILES['file'])) {
  $sql_actualizar_estatus_gptw = "UPDATE t_calificaciones_gptw SET estatus ='0'";
  if ($conn->query($sql_actualizar_estatus_gptw) === TRUE) {
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file, "r");
    $rows = 0;
    while (($archivo_calificaciones_gptw = fgetcsv($file_open, 1000, ",")) !== false) {
      if ($archivo_calificaciones_gptw[0] != '') {
        $rows++;
      }
      $no_reloj = $archivo_calificaciones_gptw[0];
      $resultado_liderazgo = $archivo_calificaciones_gptw[1];
      $resultado_companerismo = $archivo_calificaciones_gptw[2];

      mysqli_query($conn, "INSERT INTO t_calificaciones_gptw (no_reloj ,resultado_liderazgo, resultado_companerismo, mes_reg, anio_reg, estatus) VALUES ('$no_reloj','$resultado_liderazgo','$resultado_companerismo', '$mes', '$anio_actual', '$estatus')");
    }
    echo $rows;
  }
  $conn->close();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              