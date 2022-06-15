<?php 
include("../../conexion/conexion.php");
$no_reloj = $_POST["no_reloj"];
$año = 2021;
?>
<div id="añoObjetivos" class="col-md-12 col-sm-12 d-block text-center"><h5>Año: <strong><?php echo $año; ?></strong></h5>
</div>
<table class="table table-responsive-md table-bordered tablaObjetivos">
  <thead>
    <tr>
      <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Categoría <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Utilizar todas las categorías (mínimo un objetivo por categoría) "></i></th>
      <th width="20%" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivos <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe tu objetivo"></i></th>
      <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Meta <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe la meta, dato numérico relacionado al métrico"></i></th>
      <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Métrico (KPI) <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Menciona la forma mediante el cual, medirás el objetivo (indicador)"></i></th>
      <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Estrategia <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>      
      <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Responsable <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>
      <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Ponderación <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Asigna el porcentaje del peso que tendrá el objetivo, (dato numérico sin símbolo de porcentaje) al final deberán sumar 100% el total de tus objetivos"></i></th>
      <th style="display:none;" width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Logro Obtenido <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Este campo se evalúa al final del año, de acuerdo con los resultados obtenidos"></i></th>
      <th width="5%" style="text-align:center; vertical-align: middle;font-size:14px; display:none;">Resultado Final</th>
      <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px; display:none;">Evidencia</th>
      <th width="5%" style="text-align:center; vertical-align: middle;font-size:14px;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $buscarInfo = mysqli_query($conn, "SELECT * FROM objetives_gdp where obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año' ORDER BY categoria ASC");
    if (mysqli_num_rows($buscarInfo) > 0) {
      $sumaResultado = 0;
      while ($datos = mysqli_fetch_assoc($buscarInfo)) {
        $idObj = $datos["id_num_objetives"];
        ?>
        <tr>
          <td style="text-align:justify; font-weight: 600;"><?= $datos["categoria"] ?></td>
          <td style="text-align:justify; "><?= $datos["objetivo"] ?></td>
          <td style="text-align:justify; "><?= $datos["impacto"] ?></td>
          <td style="text-align:justify; "><?= $datos["acciones"] ?></td>
          <td style="text-align:justify; "><?= $datos["metricos_kpi"] ?></td>
          <td style="text-align:center; font-weight: 500;"><?= $datos["ponderacion_num"] ?></td>
          <td style="text-align:center; "><?= $datos["meta_num"] ?></td>
          <td style="text-align:center; display: none; "><?= $datos["logro"] ?></td>
          <td style="text-align:center; display: none;"><?php
          $ponderacion = $datos["ponderacion_num"];
          $divPond = $ponderacion / 100;
          $meta = $datos["meta_num"];
          $logro = $datos["logro"];
          $calculoLogro = (($logro / $meta) * 100) * $divPond;
          $sumaResultado += $calculoLogro;
          if ($calculoLogro > $ponderacion) {
            echo "$ponderacion";
          } else {
            echo number_format($calculoLogro, 2);
          }
          ?>
        </td>
        <td style="display: none;"><?php
        if ($datos["archivoEvidencia"] != "") {
          ?><a href="<?= $datos["archivoEvidencia"]; ?>" download><i class="fas fa-file-alt"></i></a><?php
        }
        ?></td>
        <td class="text-center">
          <?php 
          $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
          $row = mysqli_fetch_assoc($query);
          $estadoBtn = $row['estadoBtn'];
          if ($estadoBtn == 1) {
            ?>
            <a class="add" title="Agregar"  data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-plus"></i></a>
            <a class="edit<?php if ($datos["estatus_objetivos"] == 1) {echo " disabled";}?>" title="Editar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a>
            <!--<a class="evaluation <?php if ($datos["estatus_objetivos"] == 1) {echo "disabled";}?>" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-check-circle"></i></a> -->
          <?php } ?>
        </td>
      </tr>
      <?php
    }
    mysqli_free_result($buscarInfo);
    ?>
  </tbody>
  <tfoot style="background-color:#c8c8c8; color:#000;">
    <tr>
      <td colspan="5" style="text-align: right; color: #000; font-weight: 500; font-size: 15px;">Total:</td>
      <td>
        <?php
        $consulta = "SELECT SUM(ponderacion_num) as TotalPond FROM objetives_gdp WHERE obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año'";
        $resultado = $conn->query($consulta);
            $fila = $resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
            $TotalPorcentaje = $fila['TotalPond'];
            echo '<p style="font-size:14px; color:green; font-weight:600; text-align:center; margin-bottom:-10px;">' . $TotalPorcentaje . '%</p>';
            ?>
          </td>
          <td></td>
          <td style="font-weight: 600; text-align: center;">Resultado
            <br>
            <?php
            echo number_format($sumaResultado, 2);
            ?>
          </td>
        </tr>
      </tfoot>
      <?php

    } else {
      echo '<tr><td id="alerta" colspan="11"><div class="alert alert-danger" role="alert">
      No se han registrado objetivos.
      </div></td>
      <td style="display:none;">
      <a class="add" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-plus"></i></a> <a class="edit" title="Editar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-pencil-alt"></i></a></td><tr>';
    }
    ?>
  </table>
  <div class="col-md-12" id="notaPorcentaje" style="display: none;">
    <p style="font-weight: 600; color: darkred; font-size: 13px;"><i class="fas fa-info-circle"></i> Nota: La suma de los porcentajes de tus objetivos debe ser de <strong>100%</strong>, en caso de que sea menor o superior, favor de ajustar valores.</p>
  </div>
  <script src="../js/objetivos.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>