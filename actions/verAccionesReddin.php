<?php
require('../conexion/conexion.php');
$id = $_POST["id_reddin"];
?>

<div class="row p-5">
    <div class="col-md-4">
        <?php
        $consultaedit  = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_reddin = $id") or die(mysqli_error($conn));
        if (mysqli_num_rows($consultaedit) > 0) {
            while ($datos = mysqli_fetch_array($consultaedit)) {
        ?>
                <form id="form-acciones" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <p style="font-weight:600;">Acciones especificas</p>
                    <div class="form-row">
                        <input type="text" hidden id="id_accion" value="<?php echo $datos['id_reddin']; ?>" readonly="true" />
                        <input type="text" hidden id="estatus_accion" value="Actual" />
                        <div class="form-group col-md-12 text-center">
                            <input type="text" id="reloj_accion" hidden value="<?php echo $datos['no_reloj']; ?>">
                            <input type="text" class="form-control" id="fecha_accion" style="text-align:center;" required="" readonly value="<?php setlocale(LC_TIME, "es_MX.UTF-8");
                                                                                                                                        echo strftime("%d de %B del %Y"); ?>">
                            <input type="text" id="mes_reg_accion" hidden value="<?php setlocale(LC_TIME, "es_MX.UTF-8");
                                                                            echo strftime("%B"); ?>">
                            <input type="text" id="year_reg_accion" hidden value="<?php setlocale(LC_TIME, "es_MX.UTF-8");
                                                                            echo strftime("%Y"); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" rows="3" id="textarea_accion" placeholder="Agregar acción" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="evidencia_accion" aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" id="labelInputFile" for="evidencia_accion">Seleccionar archivo...</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <a href="#" class="btn btn-sm btn-outline-primary" id="btnAgregarAccion"><i class="fas fa-save"></i> Guardar</a>
                    </div>
                </form>
        <?php
            }
            mysqli_free_result($consultaedit);
        } ?>
    </div>
    <div class="col-md-8">
        <div id="tablaAccionesReddin"></div>
    </div>
</div>
<script>
    (function() {
        var id_reddin = '<?php echo $id ?>';
        $('#tablaAccionesReddin').load('../../loads/planes/tabla_acciones_reddin.php', {
            id: id_reddin
        });

        $(document).on('change', '#estatus_accion', function(e) {
            var fileName = e.target.files[0].name;
            $('#labelInputFile').text(fileName);
        });
    }());
</script>