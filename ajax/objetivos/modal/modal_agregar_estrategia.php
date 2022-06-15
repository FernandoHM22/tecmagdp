<?php
include('../../../conexion/conexion.php');
setlocale(LC_ALL, "es_MX");
$fecha_reg = strftime("%d de %B de %Y");
$anio_reg = strftime("%Y");
$id_objetivo = $_POST['id_objetivo'];
$no_reloj = $_POST['no_reloj'];
$sql_estrategia = mysqli_query($conn, "SELECT * FROM objetivos_gdp where id_num_objetives = '$id_objetivo'");
if (mysqli_num_rows($sql_estrategia) > 0) {
    while ($row = mysqli_fetch_assoc($sql_estrategia)) {
        echo '<div class="alert alert-info" role="alert">
        <p style="text_align:justify;"><strong>Objetivo: </strong>' . $row['objetivo'] . '</p>
      </div>';
    }
    mysqli_free_result($sql_estrategia);
}
?>
<form id="agregarEstrategia">
    <div class="form-row">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="meta" id="meta" placeholder="Meta" required>
        </div>
        <div class="form-group col-md-4">
            <textarea class="form-control" name="metricos" id="metricos" placeholder="Métrico (KPI)" required></textarea>
        </div>
        <div class="form-group col-md-4">
            <textarea class="form-control" name="estrategia" id="estrategia" placeholder="Estrategia" required></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <select name="responsable" id="responsable" class="custom-select" required>
                <option selected hidden>Seleccionar Responsable</option>
                <?php
                $sql_colaboradores = mysqli_query($conn, "SELECT no_reloj, nombres, apellidos FROM registrogdp where no_reloj_supervisor = '$no_reloj'");
                if (mysqli_num_rows($sql_colaboradores) > 0) {
                    while ($r = mysqli_fetch_assoc($sql_colaboradores)) {

                        echo '<option value="' . $r['no_reloj'] . '">' . $r['nombres'] . ' ' . $r['apellidos'] . '</option>';
                    }
                    mysqli_free_result($sql_colaboradores);
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="onderacion" id="ponderacion" placeholder="Ponderación">
        </div>
    </div>
    <div class="form-group col-md-12">
        <input type="text" name="id_objetivo" hidden value="<?php echo $id_objetivo; ?>" id="id_objetivo">
        <input type="text" name="fecha_reg" hidden value="<?php echo $fecha_reg; ?>" id="fecha_reg">
        <input type="text" name="anio_reg" hidden value="<?php echo $anio_reg; ?>" id="anio_reg">
        <input type="text" name="estatus_objetivos" hidden value="0" id="estatus_objetivos">
        <input type="submit" class="btn btn-success btn-sm" id="submit" value="Guardar">
        <button type="button" class="btn btn-outline-danger btn-sm float-right" data-dismiss="modal">Close</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#agregarEstrategia").submit(function(event) {
            event.preventDefault();
            submitForm();
            return false;
        });

        function submitForm() {
            $.ajax({
                type: "POST",
                url: "../../ajax/objetivos/ajax_agregar_estrategia.php",
                data: $("form#agregarEstrategia").serialize(),
                success: function(data) {
                    data = data.trim();
                    if (data == 1) {
                        location.reload();
                    }
                }
            });
        };
    });
</script>