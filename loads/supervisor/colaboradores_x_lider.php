<?php
include('../../conexion/conexion.php');
$no_reloj_supervisor = $_POST['no_reloj_supervisor'];
?>

<?php

$resultado = mysqli_query($conn, "SELECT * FROM registrogdp WHERE no_reloj_supervisor ='$no_reloj_supervisor' ");
$filas = mysqli_num_rows($resultado);

?>

<h5 class="mt-2">Total Colaboradores: <span class="badge badge-secondary"><?= $filas ?></span></h5>
<div class="table-responsive">
    <table id="tabla_colaboradores" class="table table-sm">
        <thead>
            <tr>
                <th></th>
                <th># Reloj</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Puesto</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_colaborador_lider = "SELECT * FROM registrogdp WHERE no_reloj_supervisor = '$no_reloj_supervisor' ORDER BY nombres ASC";
            $sql_run = mysqli_query($conn, $sql_colaborador_lider);
            if (mysqli_num_rows($sql_run) > 0) {
                while ($datos = mysqli_fetch_assoc($sql_run)) {
            ?>
                    <tr>
                        <td><img src="<?php echo '../' . $datos['img']; ?>" alt="" height="70" width="70"></td>
                        <td><?= $datos['no_reloj'] ?></td>
                        <td><?php echo $datos['nombres'] . ' ' . $datos['apellidos']; ?></td>
                        <td><?= $datos['correo'] ?></td>
                        <td><?= $datos['puesto'] ?></td>
                        <td><?= $datos['depto'] ?></td>
                    </tr>
            <?php
                }
                mysqli_free_result($sql_run);
            }
            ?>
        </tbody>
    </table>
</div>