<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST["no_reloj"];
$cargoColab = $_POST["cargoColab"];
$año = 2022;
?>
<style>
  .btnModalEstrategia,
  .btnModalEstrategia i {
    font-size: 12.5px !important;
    background-color: #007a81;
    color: #fff;
    border-radius: 50px;
    padding: 0;
    margin: 0;
  }

  tbody [rowspan]~td,
  tfoot {
    border-top: 2px solid #7e817e;
  }

  thead {
    border-bottom: 2.5px solid #7e817e !important;
  }
</style>
<div id="añoObjetivos" class="col-md-12 col-sm-12 d-block text-center">
  <h5>Año: <strong><?php echo $año; ?></strong></h5>
</div>
<table id="tablaObjetivos" class="table table-responsive-md table-bordered tablaObjetivos">
  <thead>
    <tr>
      <th rowspan="2"></th>
      <th width="15%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Categoría <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Utilizar todas las categorías (mínimo un objetivo por categoría) "></i></th>
      <th width="20%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivo <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe tu objetivo"></i></th>
      <th width="15%" colspan='2' style="text-align:center; vertical-align: middle;font-size:14px;">Meta <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe la meta, dato numérico relacionado al métrico"></i></th>
      <th></th>
      <th width="15%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Estrategias<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>

      <th width="15%" colspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Métrico (KPI) <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Menciona la forma mediante el cual, medirás el objetivo (indicador)"></i></th>
      <th width="10%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Ponderación <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Asigna el porcentaje del peso que tendrá el objetivo, (dato numérico sin símbolo de porcentaje) al final deberán sumar 100% el total de tus objetivos"></i></th>
      <th width="10%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;">Responsable <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title=""></i></th>
      <th width="5%" rowspan="2" style="text-align:center; vertical-align: middle;font-size:14px;"></th>
    </tr>
    <tr>
      <th>Descripción</th>
      <th>Meta</th>
      <th></th>
      <th>Descripción</th>
      <th>Métrico</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $buscarInfo = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año' ORDER BY categoria ASC");
    if (mysqli_num_rows($buscarInfo) > 0) {
      $sumaResultado = 0;
      while ($datos = mysqli_fetch_assoc($buscarInfo)) {
        $idObj = $datos["id_num_objetives"];
        $num_td = 1;
        $totalEstrategias = "SELECT COUNT(id_rel_estrategia) as totalEstrategias FROM objetivos_gdp WHERE id_rel_estrategia =  '$idObj'";
        $resultado = $conn->query($totalEstrategias);
        $total = $resultado->fetch_assoc();
        $count_estrategias = $total['totalEstrategias'] + 1;
    ?>
        <tr>
          <td rowspan="<?php echo $count_estrategias; ?>" style="vertical-align: middle;text-align:justify;text-align:center;border-top: 2px solid #7e817e;">
            <!--<a href="#" data-id="<?= $datos["id_num_objetives"] ?>" class="opciones_objetivos"><i class="fas fa-cog"></i></a>-->
            <button class="btn btn-sm btn-outline-danger borrarObjetivo" data-id="<?php echo $idObj; ?>" type="button"><span class="fas fa-trash-alt"></span></button>
          </td>
          <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;" rowspan="<?php echo $count_estrategias; ?>" style="text-align:justify; font-weight: 600;">
            <?php if ($datos["categoria"] == '') {
              $id_rel = $datos["id_rel_estrategia"];
              $buscarEstrategia = mysqli_query($conn, "SELECT categoria FROM objetivos_gdp WHERE id_num_objetives = '$id_rel'");
              if (mysqli_num_rows($buscarEstrategia) > 0) {
                $sumaResultado = 0;
                while ($row = mysqli_fetch_assoc($buscarEstrategia)) {
                  echo $row["categoria"];
                }
                mysqli_free_result($buscarEstrategia);
              }
            } else {
              echo  $datos["categoria"];
            }
            ?>
          </td>
          <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
            <?php if ($datos["objetivo"] == '') {
              echo $datos["estrategia"];
            } else {
              echo $datos["objetivo"];
            } ?>
          </td>
          <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
            <?php
            if ($datos["descripcion_meta"] == '') {
              echo $datos["metricos_kpi"];
            } else {
              echo $datos['descripcion_meta'];
            } ?>
          </td>
          <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $num_td++; ?>" class="inputs_objetivo" style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
            <?php if ($datos["meta_num"] == '') {
              $id_rel = $datos["id_rel_estrategia"];
              $sql_meta = mysqli_query($conn, "SELECT meta_num FROM objetivos_gdp WHERE id_num_objetives = '$id_rel'");
              if (mysqli_num_rows($sql_meta) > 0) {
                $sumaResultado = 0;
                while ($row = mysqli_fetch_assoc($sql_meta)) {
                  echo $row["meta_num"];
                }
                mysqli_free_result($sql_meta);
              }
            } else {
              echo  $datos["meta_num"];
            } ?></td>
          <td style="vertical-align: middle;text-align:justify;text-align:center;" rowspan="<?php echo $count_estrategias; ?>">
            <a href="#" title="Agregar Estrategia" data-toggle="tooltip" class="agregarRenglonEstrategia m-0 p-0"><i class="fas fa-plus-circle"></i></a><a href="#" title="Eliminar Estrategia" data-toggle="tooltip" style="display:none;" class="eliminarRenglonEstrategia m-0 p-0"><i class="fas fa-minus-circle"></i></a>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <?php
            $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
            $row = mysqli_fetch_assoc($query);
            $estadoBtn = $row['estadoBtn'];
            if ($estadoBtn == 1) {
            ?>
              <a class="add" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-save"></i></a>
              <a class="agregarNuevaEstrategia" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"]; ?>"><i class="fas fa-plus"></i></a>
              <!--<a class="editObjetivoUser<?php if ($datos["estatus_objetivos"] == 1) {
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
                $sql_responsable = mysqli_query($conn, "SELECT CONCAT(nombres,' ', apellidos) as nombre FROM registrogdp WHERE no_reloj =  '$no_reloj_responsable'");
                while ($d = mysqli_fetch_assoc($sql_responsable)) {
                  echo $d['nombre'];
                }
                mysqli_free_result($sql_responsable); ?>
              </td>
              <td> <?php
                    $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
                    $row = mysqli_fetch_assoc($query);
                    $estadoBtn = $row['estadoBtn'];
                    if ($estadoBtn == 1) {
                    ?>
                  <!-- <a class="add" title="Agregar" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-save"></i></i></a>
                  <a class="editEstrategia
                  <?php if ($r["estatus_objetivos"] == 1) {
                        echo " disabled";
                      } ?>" title="Editar Estrategia" data-toggle="tooltip" id="<?= $r["id_num_objetives"]; ?>"><i class="fas fa-pencil-alt"></i></a>-->
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
      //   } else {
      //     $i = 1;
      //     ?>
      <!-- //     <tr>
      //       <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"></td>
      //       <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"></td>
      //       <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"></td>
      //       <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"></td>
      //       <td data-id="<?= $datos["id_num_objetives"] ?>" data-num="<?php echo $i++ ?>" class="inputs_estrategias"></td>
      //       <td></td>
      //     </tr> -->
       <?php
        }
      }
      mysqli_free_result($buscarInfo);
      ?>
  </tbody>
  <tfoot style="background-color:#c8c8c8; color:#000;">
    <tr>
      <td colspan="8" style="text-align: right; color: #000; font-weight: 500; font-size: 15px;">Total:</td>
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
      <td></td>
    </tr>
  </tfoot>
<?php
    } else {
      echo '<tr><td id="alerta" colspan="11"><div class="alert alert-danger" role="alert">
      No se han registrado objetivos.
      </div></td>
      <td>
      <a class="add" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-save"></i></a></td><tr>';
    }
?>
</table>
<!-- Modal -->
<div class="modal fade" id="modal_agregar_objetivo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir estrategia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<div class="col-md-12" id="notaPorcentaje" style="display: none;">
  <p style="font-weight: 600; color: darkred; font-size: 13px;"><i class="fas fa-info-circle"></i> Nota: La suma de los porcentajes de tus objetivos debe ser de <strong>100%</strong>, en caso de que sea menor o superior, favor de ajustar valores.</p>
</div>

<script src="../js/objetivos.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function() {
    window.no_reloj = '<?php echo $no_reloj; ?>';
    $('.tablaObjetivos').DataTable();

    $('.btnModalEstrategia').on('click', function(e) {
      e.preventDefault();
      let id_objetivo = $(this).data('id');
      let no_reloj = <?php echo $no_reloj; ?>;
      $.ajax({
        url: '../../ajax/objetivos/modal/modal_agregar_estrategia.php',
        method: 'POST',
        data: {
          id_objetivo: id_objetivo,
          no_reloj: no_reloj
        },
        success: function(data) {
          $('#modal_agregar_objetivo .modal-body').html(data);
          $("#modal_agregar_objetivo").modal("toggle");
        }
      });
    });
  });
</script>