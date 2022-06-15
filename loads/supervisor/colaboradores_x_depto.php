<?php
include('../../conexion/conexion.php');
$region = $_POST['region'];
$depto = $_POST['depto'];
?>

<?php

$resultado = mysqli_query($conn, "SELECT * FROM registrogdp WHERE depto ='$depto' AND region = '$region'");
$filas = mysqli_num_rows($resultado);

?>

<h5 class="mt-2">Total Colaboradores: <span class="badge badge-secondary"><?= $filas ?></span></h5>
<div class="row row-cols-2 row-cols-3 rowCardColaboradoresDepto">
    <?php
    $sql_colaborador_depto = "SELECT * FROM registrogdp WHERE depto = '$depto' AND region = '$region' ORDER BY nombres ASC";
    $sql_run = mysqli_query($conn, $sql_colaborador_depto);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($datos = mysqli_fetch_assoc($sql_run)) {
    ?>
            <div class="col-1 mb-1 colCardColaboradoresDepto">
                <div class="card h-100 cardColaboradorDepto">
                    <div class="card-body text-center">
                        <img src="<?php echo '../' . $datos['img']; ?>" alt="">
                        <p><?php echo $datos['nombres'] . ' ' . $datos['apellidos']; ?></p>
                    </div>
                </div>
            </div>
    <?php
        }
        mysqli_free_result($sql_run);
    }
    ?>
</div>
