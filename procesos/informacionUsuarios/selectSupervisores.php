<?php
require('../../conexion/conexion.php');


$consultaSup  = mysqli_query($conn, "SELECT * FROM registrogdp WHERE cargoColab = '1' ORDER BY nombres ASC ");
?>

<select class="form-control selectpicker show-tick" id="supervisor" title="Seleccionar supervisor" name="supervisor" data-live-search="true">
    <?php
    if (mysqli_num_rows($consultaSup) > 0) {
        $relojSupervisor = $_POST["sup"];
    while ($datos = mysqli_fetch_array($consultaSup)){
        $no_reloj_sup = $datos['no_reloj'];
        $nombre = $datos['nombres'];
        $apellidos = $datos['apellidos'];
        ?> 
        <option value="<?php echo $no_reloj_sup ?>"><?php echo $nombre; echo " "; echo $apellidos ?></option>
        <?php
    } 
    mysqli_free_result($consultaSup); 
}
    ?>
</select>

    <script type="text/javascript">
            $('select').selectpicker();
        </script>
