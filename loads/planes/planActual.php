  <?php
  include("../../conexion/conexion.php");
  $no_reloj = $_POST['no_reloj'];
  $rol = $_POST["rol"];
  ?>
  <div class="row">
    <div class="col-sm-6 mt-3">
      <button type="button" <?php if ($rol == 'usuario') {
                              echo "hidden ";
                              echo "disabled";
                            } ?> class="btn btn-info btn-sm add-newPlaneacion"><i class="fa fa-plus"></i>Nueva oportunidad</button>
      <button class="btn btn-danger btn-sm btnCancel" hidden=""><i class="fas fa-times"></i> Cancelar</button>
    </div>
    <div class="col-md-6 mt-3 text-right">
      <a href="#" data-toggle="modal" data-target="#modalHistoricoPlanesReddin" data-whatever="<?= $no_reloj ?>" id="historico_gptw"><i class="fas fa-history"></i> Histórico</a>
    </div>
  </div>
  <div class="table-responsive pt-2 col-md-12">
    <table class="table table-sm tablaPlaneacion">
      <thead>
        <tr>
          <th>Tipo</th>
          <th width="17%">Oportunidad de mejora <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingresar área de oportunidad que tu supervisor te haya mencionado"></i></th>
          <!-- <th width="20%">¿Porque es una oportunidad? <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describir por que es una área de oportunidad"></i></th> -->
          <th width="35%">Acciones Especificas <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingresar acciones que ayuden a mejorar tu oportunidad"></i></th>
          <th width="15%">Fecha Compromiso <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Si no hay fecha exacta puedes ingresar recurrencia, semanal o mensual"></i></th>
          <th width="15%">Indicadores a Impactar <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Capturar a que indicador impacta las acciones que realizarás Ejemplo: GPTW , liderazgo, rotación, productividad, gastos fijos, etc."></i></th>
          <th width="10%">Evidencia<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Evidencias en archivos para demostrar logro de oportunidad"></i></th>
          <th width="5%"></th>
          <?php if ($rol == 'admin') { ?>
            <th class="estatus">Estatus</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $sqlReddin = mysqli_query($conn, "SELECT * FROM t_reddin WHERE no_reloj = '$no_reloj' AND estatus = 'Actual' AND oportunidadConsenso != 'null' ORDER BY tipo_plan DESC");
        if (mysqli_num_rows($sqlReddin) > 0) {
          while ($dato = mysqli_fetch_array($sqlReddin)) {
            $num_td = 2;
        ?>
            <tr>
              <td>
                <?php
                if ($dato['tipo_plan'] == 'Reddin') {
                  echo '<span class="badge badge-danger">' . $dato['tipo_plan'] . '</span>';
                } else {
                  echo '<span class="badge badge-success">' . $dato['tipo_plan'] . '</span>';
                }
                ?>
              </td>
              <td><?= $dato["oportunidadConsenso"] ?></td>
              <!-- <td><?= $dato["porque_mejora"] ?></td> -->
              <td data-id="<?= $dato["id_reddin"] ?>" class="input_plan" data-num="<?php echo $num_td++; ?>">
                <i style="color:#b2b2b2" class="fas fa-calendar-alt" data-toggle="tooltip" data-placement="right" title="<?= $dato["date_reg_action"]; ?>"></i>
                <?= $dato["acciones"] ?>
              </td>
              <td data-id="<?= $dato["id_reddin"] ?>" class="input_plan" data-num="<?php echo $num_td++; ?>"><?= $dato["fecha"] ?></td>
              <td class=" text-center"><?= $dato["indicadores"] ?></td>
              <td class="text-center"> <?php
                                        if ($dato['evidencias'] == '') {
                                        ?>
                  <a href="#" data-id="<?= $dato["id_reddin"] ?>" class="btnCargarEvidencia" data-toggle="tooltip" data-placement="right" title="Subir Evidencia"><i class="fas fa-paperclip"></i></a>
                  <a href="#" data-id="<?= $dato["id_reddin"] ?>" id="btnGuardarEvidenciaPlan" class="btn btn-sm btn-outline-success" hidden><i class="fas fa-save"></i></a>
                  <input type="file" id="evidenciaAccionInput" hidden>
                  <div>
                    <span id="labelEvidenciaFile"></span>
                  </div>
                <?php } else {
                                          echo '<a href="' . $dato['evidencias'] . '" download><i class="fas fa-file-download"></i></a>';
                                        }
                ?>
              </td>
              <td class="text-center">
                <a class="agregar" title="Agregar" data-toggle="tooltip" id="<?= $dato["id_reddin"] ?>"><i class="fa fa-save"></i></a> <!-- <a class="editar" title="Editar" data-toggle="tooltip" id="<?= $dato["id_reddin"] ?>"><i class="fas fa-pencil-alt"></i></a> -->
                <?php if ($rol == 'admin') { ?>
                  <a class="borrar" title="Eliminar" data-toggle="tooltip" id="<?= $dato["id_reddin"] ?>"><i class="fas fa-trash"></i></a>
                <?php } ?>
              </td>
              <?php if ($rol == 'admin') { ?>
                <td class="estatusRow">
                  <div class="custom-control custom-checkbox">
                    <label><input type="checkbox" name="checkboxCumplidos[]" class="custom-control-input checkboxPlanCumplido" value="<?= $dato["id_reddin"] ?>">
                      <div class="custom-control-label"></div>
                    </label>
                  </div>
                </td>
              <?php } ?>
            </tr>
            <tr class="botonesPlan">
              <td></td>
              <td>
                <a style="font-size: 10px; text-decoration: none; font-weight: 600;" href="" data-toggle="modal" data-target="#modalAddNotas" data-id="<?= $dato["id_reddin"] ?>" class="btn btn-primary btn-sm disabled" hidden>Agregar Notas</a>
                <?php if ($rol == 'admin') { ?>
                  <a style="font-size: 10px; text-decoration: none; font-weight: 600;" href="" data-toggle="modal" data-target="#modalVerNotasReddin" data-whatever="<?= $dato["id_reddin"] ?>"><span class="fas fa-eye"></span> Notas diálogo</a><?php } ?>
              </td>
              <?php if ($dato["acciones"] != NULL && $dato["fecha"] != NULL && $dato["indicadores"] != NULL) { ?>
                <td data-toggle="modal" data-target="#modalVerAccionesReddin" data-whatever="<?= $dato["id_reddin"] ?>">
                  <!--<a style="font-size: 11px; background-color:#008B8B; color:#fff; text-decoration: none; font-weight: 600; border-radius: 50px;" href="" data-toggle="modal" data-target="#modalAddActionReddin" data-whatever="<?= $dato["id_reddin"] ?>" class="btn btn-primary btn-sm"><span class="fas fa-plus-square"></span> Agregar Acción</a> -->
                  <a style="font-size: 10px; text-decoration: none; font-weight: 600;" href="" data-toggle="modal" data-target="#modalVerAccionesReddin" data-whatever="<?= $dato["id_reddin"] ?>"><span class="fas fa-plus"></span> Acciones</a>
                </td> <?php } ?>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
        <?php }
          $num_td++;
          mysqli_free_result($sqlReddin);
        } else {
          echo '<tr><td colspan="6"></td><td><a class="agregar" title="Agregar" data-toggle="tooltip"><i class="fas fa-plus"></i></a></td></tr>';
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="8" class="text-right">
            <a href="#" class="btnCerrarPlan" hidden>Cerrar planes</a>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
  <script>
    window.no_reloj = '<?php echo $no_reloj ?>';
  </script>