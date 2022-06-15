<?php
require_once '../../conexion/conexion.php';
$arrayColaboradores = $_POST['arrayReloj'];
var_dump($arrayColaboradores);
$anio = Date('Y');
foreach ($arrayColaboradores as $key => $value) {
  $sql_objetivos = mysqli_query($conn, "SELECT AVG(logro) AS logro, obj_no_reloj FROM objetivos_gdp WHERE obj_no_reloj = '$value' AND año_reg = '$anio' GROUP BY obj_no_reloj") or die(mysqli_error($conn));
  $r = mysqli_fetch_assoc($sql_objetivos);
  if ($r['logro'] != '') {
    $arrayLogroObjetivos[] =  number_format(floor(($r['logro']) * 100) / 100, 2);
    $faltanteDataObjetivos[] = 100 - number_format(floor(($r['logro']) * 100) / 100, 2);
  } else {
    $arrayLogroObjetivos[] = 0;
    $faltanteDataObjetivos[] = 10 - 0;
  }

  $sql_planes = mysqli_query($conn, "SELECT COUNT(id_reddin) as planes FROM t_reddin WHERE no_reloj = '$value' AND oportunidadConsenso != '' AND estatus = 'Actual'") or die(mysqli_error($conn));
  $row = mysqli_fetch_assoc($sql_planes);
  if ($row['planes'] != '') {
    $arrayPlanesActuales[] = intval($row['planes']);
  } else {
    $arrayPlanesActuales[] = 0;
  }
}

$reloj = " WHERE no_reloj IN ('";
$reloj .= implode("', '", $arrayColaboradores);
$reloj .= "')";
$arrayTotal = array();
foreach ($arrayColaboradores as $key => $value) {
  $sql_evaluacion = mysqli_query($conn, "SELECT *  FROM t_evaluacion WHERE no_reloj = '$value'");
  if (mysqli_num_rows($sql_evaluacion) > 0) {
    $row = mysqli_fetch_assoc($sql_evaluacion);
    $sum =  (($row['competencia1'] + $row['competencia2'] + $row['competencia3'] + $row['competencia4'] + $row['competencia5'] + $row['competencia6'] + $row['competencia7'] + $row['competencia8'] + $row['competencia9'] + $row['competencia10'] + $row['competencia11'] + $row['competencia12'] + $row['competencia13'] + $row['competencia14'] + $row['competencia15'] + $row['competencia16'] + $row['competencia17'] + $row['competencia18'] + $row['competencia19'] + $row['competencia20']) / 20) . '<br>';

    $avgEvaluacion =  ($sum * 70) / 100;

    $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj = '$value'");
    if (mysqli_num_rows($sql_matriz) > 0) {
      $r = mysqli_fetch_assoc($sql_matriz);
      $desempeno = $r['desempeno'];
      if ($desempeno == 'Excepcional') {
        $calificacion = 10;
      } else if ($desempeno == 'Excede Expectativas') {
        $calificacion = 9.9;
      } else if ($desempeno == 'Cumple Expectativas') {
        $calificacion = 9.5;
      } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
        $calificacion = 8;
      } else if ($desempeno == 'Insatisfactorio') {
        $calificacion = 9.5;
      }
    } else {
      $calificacion = 0;
    }
    $avgDesempeno = ($calificacion * 30) / 100;
    $avgTotal[] =  number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
    $faltanteDataCompetencias[] = 10 - number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
  } else {
    $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj ='$value'");
    if (mysqli_num_rows($sql_matriz) > 0) {
      $r = mysqli_fetch_assoc($sql_matriz);
      $desempeno = $r['desempeno'];
      if ($desempeno == 'Excepcional') {
        $calificacion = 10;
      } else if ($desempeno == 'Excede Expectativas') {
        $calificacion = 9.9;
      } else if ($desempeno == 'Cumple Expectativas') {
        $calificacion = 9.5;
      } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
        $calificacion = 8;
      } else if ($desempeno == 'Insatisfactorio') {
        $calificacion = 9.5;
      }
    } else {
      $calificacion = 0;
    }
    $calificacion;
    $avgDesempeno = ($calificacion * 30) / 100;
    $avgTotal[] =  number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
    $faltanteDataCompetencias[] = 10 - number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
  }
}

mysqli_free_result($sql_evaluacion);
