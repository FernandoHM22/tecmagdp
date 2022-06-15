<?php
include("../../conexion/conexion.php");
$reloj = $_POST['no_reloj'];
?>
<div class="table-responsive">
    <table id="tabla_gptw" class="table table-sm tabla_gptw">
        <thead>
            <tr>
                <th></th>
                <th width="20%">Oportunidad</th>
                <th width="30%">Acciones</th>
                <th width="20%">Notas para el dialogo</th>
                <th width="20%">Evidencia</th>
                <th width="10%"></th>
                <th class="estatus">Estatus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result_pag_data = mysqli_query($conn, "SELECT * FROM t_reddin WHERE no_reloj = '$reloj' AND oportunidadConsenso != 'null' AND estatus = 'Actual' ORDER BY tipo_plan DESC") or die(mysqli_error($conn));

            if (mysqli_num_rows($result_pag_data) > 0) {
                while ($row = mysqli_fetch_assoc($result_pag_data)) {
                    $id_reddin = $row['id_reddin'];
                    $oportunidades = $row['oportunidadConsenso'];
                    $acciones = $row['acciones'];
                    $notas = $row['notas'];
            ?>
                    <tr>
                        <td>
                            <?php
                            if ($row['tipo_plan'] == 'Reddin') {
                                echo '<span class="badge badge-danger">' . $row['tipo_plan'] . '</span>';
                            } else {
                                echo '<span class="badge badge-success">' . $row['tipo_plan'] . '</span>';
                            }
                            ?>
                        </td>
                        <td class="input_gptw" data-id="<?php echo $id_reddin; ?>" data-num="1"><?= $oportunidades; ?></td>
                        <td><?= $acciones ?></td>
                        <td class="input_gptw" data-id="<?php echo $id_reddin; ?>" data-num="2"><?= $notas; ?></td>
                        <td class="text-center">
                            <?php
                            if ($row['evidencias'] == '') {
                            ?>
                                <a href="#" data-id="<?= $row["id_reddin"] ?>" class="btnCargarEvidencia" data-toggle="tooltip" data-placement="right" title="Subir Evidencia"><i class="fas fa-paperclip"></i></a>
                                <a href="#" data-id="<?= $row["id_reddin"] ?>" id="btnGuardarEvidenciaPlan" class="btn btn-sm btn-outline-success" hidden><i class="fas fa-save"></i></a>
                                <input type="file" id="evidenciaAccionInput" hidden>
                                <div>
                                    <span id="labelEvidenciaFile"></span>
                                </div>
                            <?php } else {
                                echo '<a href="' . $row['evidencias'] . '" download><i class="fas fa-file-download"></i></a>';
                            }
                            ?>
                        </td>
                        <td>
                            <a class="eliminar_gptw" title="Eliminar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                        <td class="estatusRow">
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxCumplidos[]" class="custom-control-input checkboxPlanCumplido" value="<?php echo $id_reddin; ?>">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="botonesPlan">
                        <td></td>
                        <td data-toggle="modal" data-target="#modalVerAccionesReddin" data-whatever="<?= $row["id_reddin"] ?>">
                            <a style="font-size: 10px; text-decoration: none; font-weight: 600; border-radius: 50px;" href="" data-toggle="modal" data-target="#modalVerAccionesReddin" data-whatever="<?= $row["id_reddin"] ?>"><span class="fas fa-plus"></span> Acciones</a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            <?php }
                mysqli_free_result($result_pag_data);
            } else {
                echo '<tr>
                        <td colspan="4" id="alerta">
                        <div class="alert alert-warning alert-dismissible show" role="alert">
                         No se han registrado oportunidades.
                         </button>
                         </div>
                         </td>
                         <td style="display:none;">
                         <a class="guardar_gptw" title="Guardata-toggle="tooltip" id="<?php echo $id_plan; ?>class="fas fa-save"></i></a> <a clastitle="Eliminar" data-toggle="tooltip" id="<?php $id_plan; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>';
            } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right">
                    <a href="#" class="btnCerrarPlan" hidden>Cerrar planes</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>