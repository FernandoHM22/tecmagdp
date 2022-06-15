<?php include("../../conexion/conexion.php"); ?>
<ul id="objetivosAñosActivo">
    <?php $anioObjetivos = mysqli_query($conn, "SELECT * FROM objetives_gdp WHERE estatus_objetivos = 2   GROUP BY año_reg ORDER BY año_reg ASC ");
    if (mysqli_num_rows($anioObjetivos) > 0) {
        while ($datos = mysqli_fetch_array($anioObjetivos)) {
            echo '<li> <i class="fas fa-check"></i> ' . $datos['año_reg'] . '</li>';
        }
        mysqli_free_result($anioObjetivos);
    }
    ?>
</ul>