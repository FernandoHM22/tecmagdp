<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
$año = 2022;
?>
<div id="añoObjetivos" class="col-md-12 col-sm-12 d-block text-center">
  <h5>Año: <strong> <?php
                    $añoQuery = mysqli_query($conn, "SELECT año_reg FROM objetives_gdp WHERE  estatus_objetivos = 2 GROUP BY año_reg LIMIT 1");
                    if (mysqli_num_rows($añoQuery) > 0) {
                      while ($datos = mysqli_fetch_array($añoQuery)) {
                    ?>
          <?php echo $datos['año_reg']; ?></strong></h5>
<?php }
                      mysqli_free_result($añoQuery);
                    }
?>
</div>
<div class="col-md-12">
  <table id="tablaObjetivos" class="table table-responsive-md table-bordered tablaObjetivosPendientes">
    <thead>
      <tr>
        <th rowspan="2"></th>
        <th width="15%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Categoría <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Utilizar todas las categorías (mínimo un objetivo por categoría) "></i></th>
        <th width="20%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivo <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe tu objetivo"></i></th>
        <th width="15%" colspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Meta <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe la meta, dato numérico relacionado al métrico"></i></th>
        <th rowspan="2"></th>
        <th width="15%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Estrategias<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>
        <th width="15%" colspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Métrico (KPI) <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Menciona la forma mediante el cual, medirás el objetivo (indicador)"></i></th>
        <th width="10%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Ponderación <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Asigna el porcentaje del peso que tendrá el objetivo, (dato numérico sin símbolo de porcentaje) al final deberán sumar 100% el total de tus objetivos"></i></th>
        <th width="10%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Responsable <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>
        <th width="5%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;"></th>
      </tr>
      <tr>
        <th>Descripción</th>
        <th>Meta</th>
        <th>Descripción</th>
        <th>Métrico</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $buscarInfo = mysqli_query($conn, "SELECT * FROM objetivos_gdp where obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año' AND categoria != '' ORDER BY categoria ASC");
      if (mysqli_num_rows($buscarInfo) > 0) {
        $sumaResultado = 0;

        while ($datos = mysqli_fetch_assoc($buscarInfo)) {
          $idObj = $datos["id_num_objetives"];
          $num_td = 1;
          $totalEstrategias = "SELECT COUNT(id_rel_estrategia) as totalEstrategias FROM objetivos_gdp WHERE id_rel_estrategia =  '$idObj'";
          $resultado = $conn->query($totalEstrategias);
          $total = $resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
          $count_estrategias = $total['totalEstrategias'] + 1;
      ?>
          <tr>
            <td rowspan="<?php echo $count_estrategias; ?>" style="vertical-align: middle;text-align:justify;text-align:center;border-top: 2px solid #7e817e;">
              <!--<a href="#" data-id="<?= $datos["id_num_objetives"] ?>" class="opciones_objetivos"><i class="fas fa-cog"></i></a>-->
              <button class="btn btn-sm btn-outline-danger borrarObjetivo" data-id="<?php echo $idObj; ?>" type="button"><span class="fas fa-trash-alt"></span></button>
            </td>
            <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;" rowspan="<?php echo $count_estrategias; ?>" style="text-align:justify; font-weight: 600;"><?= $datos["categoria"] ?></td>
            <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["objetivo"] ?>
            </td>
            <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["descripcion_meta"] ?></td>
            <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["meta_num"] ?>
              <input type="text" hidden name="id_objetivos[]" value="<?= $datos["id_num_objetives"] ?>" class="form-control form-control-sm">
            </td>
            <td style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
              <a href="#" title="Agregar Estrategia" data-toggle="tooltip" class="agregarRenglonEstrategia m-0 p-0"><i class="fas fa-plus-circle"></i></a><a href="#" title="Eliminar Estrategia" data-toggle="tooltip" style="display:none;" class="eliminarRenglonEstrategia m-0 p-0"><i class="fas fa-minus-circle"></i></a>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">
              <?php
              $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
              $row = mysqli_fetch_assoc($query);
              $estadoBtn = $row['estadoBtn'];
              if ($estadoBtn == 1) {
              ?>
                <a class="add" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-save"></i></a>
                <a class="agregarNuevaEstrategia" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-plus"></i></a>
                <!--<a class="edit<?php if ($datos["estatus_objetivos"] == 1) {
                                    echo " disabled";
                                  } ?>" title="Editar Estrategia" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a>
             <a class="evaluation <?php if ($datos["estatus_objetivos"] == 1) {
                                    echo "disabled";
                                  } ?>" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-check-circle"></i></a> -->
              <?php } ?>
            </td>
          </tr>
          <?php
          $sql_estrategias = mysqli_query($conn, "SELECT * FROM objetivos_gdp where id_rel_estrategia = '$idObj' AND año_reg LIKE '$año'");
          if (mysqli_num_rows($sql_estrategias) > 0) {
            while ($r = mysqli_fetch_assoc($sql_estrategias)) {
              $i = 1;
              $no_reloj_responsable = $r['responsable'];
          ?>
              <tr>
                <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['estrategia'] ?></td>
                <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['metricos_kpi'] ?></td>
                <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['medida_estrategia'] ?></td>
                <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['ponderacion_num'] ?></td>
                <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias">
                  <?php
                  $sql_responsable = mysqli_query($conn, "SELECT CONCAT(nombres,' ', apellidos) as nombre FROM registrogdp WHERE no_reloj IN ('$no_reloj_responsable')");
                  while ($d = mysqli_fetch_assoc($sql_responsable)) {
                    echo $d['nombre'] . '<br>';
                  }
                  mysqli_free_result($sql_responsable); ?>
                </td>
                <td> <?php
                      $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
                      $row = mysqli_fetch_assoc($query);
                      $estadoBtn = $row['estadoBtn'];
                      if ($estadoBtn == 1) {
                      ?>

                    <!-- <a class="editEstrategia<?php if ($r["estatus_objetivos"] == 1) {
                                                    echo " disabled";
                                                  } ?>" title="Editar Estrategia" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a> -->
                    <a class="deleteEstrategia" title="Agregar" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-trash"></i></a>
                    <!--<a class="evaluation <?php if ($datos["estatus_objetivos"] == 1) {
                                                echo "disabled";
                                              } ?>" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-check-circle"></i></a> -->
                  <?php } ?>
                </td>
              </tr>
            <?php
            }
            mysqli_free_result($sql_estrategias);
          }
        }
        $num_td++;
        mysqli_free_result($buscarInfo);
      } else {
        echo '<tr><td id="alerta" colspan="11"><div class="alert alert-danger" role="alert">
      No se han registrado objetivos.
      </div></td>
      <td>
      <a class="add" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-save"></i></a></td><tr>';
      }


      $sql_estrategia_a_objetivos = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE responsable LIKE '%$no_reloj%' AND año_reg LIKE '$año' ORDER BY categoria ASC");
      if (mysqli_num_rows($sql_estrategia_a_objetivos) > 0) {
        $sumaResultado = 0;

        while ($datos = mysqli_fetch_assoc($sql_estrategia_a_objetivos)) {
          if ($no_reloj != $datos["obj_no_reloj"]) {
            $idObj = $datos["id_num_objetives"];
            $num_td = 1;
            $totalEstrategias = "SELECT COUNT(id_rel_estrategia) as totalEstrategias FROM objetivos_gdp WHERE id_rel_estrategia =  '$idObj'";
            $resultado = $conn->query($totalEstrategias);
            $total = $resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
            $count_estrategias = $total['totalEstrategias'] + 1;
            ?>
            <tr>
              <td rowspan="<?php echo $count_estrategias; ?>" style="vertical-align: middle;text-align:justify;text-align:center;border-top: 2px solid #7e817e;">
                <!--<a href="#" data-id="<?= $datos["id_num_objetives"] ?>" class="opciones_objetivos"><i class="fas fa-cog"></i></a>
            <button class="btn btn-sm btn-outline-danger borrarObjetivo" data-id="<?php echo $idObj; ?>" type="button"><span class="fas fa-trash-alt"></span></button>-->
              </td>
              <td data-num="<?php echo $num_td++; ?>" style="vertical-align: middle;" rowspan="<?php echo $count_estrategias; ?>" style="text-align:justify; font-weight: 600;">
                <?php
                $id_rel = $datos["id_rel_estrategia"];
                $buscarEstrategia = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_rel'");
                if (mysqli_num_rows($buscarEstrategia) > 0) {
                  while ($row = mysqli_fetch_assoc($buscarEstrategia)) {
                    $id_relacion_padre = $row["id_rel_estrategia"];
                    if ($row['categoria'] == '') {
                      $sql_estrategia_padre = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_relacion_padre'");
                      if (mysqli_num_rows($sql_estrategia_padre) > 0) {
                        while ($r = mysqli_fetch_assoc($sql_estrategia_padre)) {
                          $id_relacion_padre_ultimo = $r["id_rel_estrategia"];
                          if ($r['categoria'] == '') {
                            $sql_estrategia_padre_ultimo = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_relacion_padre_ultimo'");
                            if (mysqli_num_rows($sql_estrategia_padre_ultimo) > 0) {
                              while ($data = mysqli_fetch_assoc($sql_estrategia_padre_ultimo)) {
                                echo $data["categoria"];
                              }
                            }
                          } else {
                            echo $r["categoria"];
                          }
                        }
                      }
                    } else {
                      echo $row["categoria"];
                    }
                  }
                  mysqli_free_result($buscarEstrategia);
                }
                ?>
              </td>
              <td data-num="<?php echo $num_td++; ?>" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["estrategia"] ?>
              </td>
              <td data-num="<?php echo $num_td++; ?>" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["metricos_kpi"] ?></td>
              <td data-num="<?php echo $num_td++; ?>" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>"><?= $datos["medida_estrategia"] ?>
                <input type="text" hidden name="id_objetivos[]" value="<?= $datos["id_num_objetives"] ?>" class="form-control form-control-sm">
              </td>
              <td style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
                <a href="#" title="Agregar Estrategia" data-toggle="tooltip" class="agregarRenglonEstrategia m-0 p-0"><i class="fas fa-plus-circle"></i></a><a href="#" title="Eliminar Estrategia" data-toggle="tooltip" style="display:none;" class="eliminarRenglonEstrategia m-0 p-0"><i class="fas fa-minus-circle"></i></a>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-center">
                <?php
                $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
                $row = mysqli_fetch_assoc($query);
                $estadoBtn = $row['estadoBtn'];
                if ($estadoBtn == 1) {
                ?>
                  <a class="add" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-save"></i></a>
                  <a class="agregarNuevaEstrategia" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-plus"></i></a>
                  <!--<a class="edit<?php if ($datos["estatus_objetivos"] == 1) {
                                      echo " disabled";
                                    } ?>" title="Editar Estrategia" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a>
             <a class="evaluation <?php if ($datos["estatus_objetivos"] == 1) {
                                    echo "disabled";
                                  } ?>" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-check-circle"></i></a> -->
                <?php } ?>
              </td>
            </tr>
            <?php
            $sql_estrategias = mysqli_query($conn, "SELECT * FROM objetivos_gdp where id_rel_estrategia = '$idObj' AND obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año'");
            if (mysqli_num_rows($sql_estrategias) > 0) {
              while ($r = mysqli_fetch_assoc($sql_estrategias)) {
                $i = 1;
                $no_reloj_responsable = $r['responsable'];
            ?>
                <tr>
                  <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['estrategia'] ?></td>
                  <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['metricos_kpi'] ?></td>
                  <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['medida_estrategia'] ?></td>
                  <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"><?= $r['ponderacion_num'] ?></td>
                  <td data-id="<?= $r["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias">
                    <?php
                    $sql_responsable = mysqli_query($conn, "SELECT CONCAT(nombres,' ', apellidos) as nombre FROM registrogdp WHERE no_reloj IN ('$no_reloj_responsable')");
                    while ($d = mysqli_fetch_assoc($sql_responsable)) {
                      echo $d['nombre'] . '<br>';
                    }
                    mysqli_free_result($sql_responsable); ?>
                  </td>
                  <td> <?php
                        $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
                        $row = mysqli_fetch_assoc($query);
                        $estadoBtn = $row['estadoBtn'];
                        if ($estadoBtn == 1) {
                        ?>

                      <!-- <a class="editEstrategia<?php if ($r["estatus_objetivos"] == 1) {
                                                      echo " disabled";
                                                    } ?>" title="Editar Estrategia" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a> -->
                      <a class="deleteEstrategia" title="Agregar" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-trash"></i></a>
                      <!--<a class="evaluation <?php if ($datos["estatus_objetivos"] == 1) {
                                                  echo "disabled";
                                                } ?>" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-check-circle"></i></a> -->
                    <?php } ?>
                  </td>
                </tr>
      <?php
              }
              mysqli_free_result($sql_estrategias);
            }
          }
        }
        $num_td++;
        mysqli_free_result($sql_estrategia_a_objetivos);
      }
      ?>
    </tbody>
    <tfoot style="background-color:#c8c8c8; color:#000;">
      <tr>
        <td colspan="9" style="text-align: right; color: #000; font-weight: 500; font-size: 15px;">Total:</td>
        <td> <?php
              $consulta = "SELECT SUM(ponderacion_num) as TotalPond FROM objetivos_gdp WHERE obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año'";
              $resultado = $conn->query($consulta);
              $fila = $resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
              $TotalPorcentaje = $fila['TotalPond'];
              echo '<p style="font-size:14px; color:green; font-weight:600; text-align:center; margin-bottom:-10px;">' . $TotalPorcentaje . '%</p>';
              ?></td>
        <td>
        </td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</div>