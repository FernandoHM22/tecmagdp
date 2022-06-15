<?php
include('../../conexion/conexion.php');
$mes_inicial = $_POST['mes_inicial'];
$anio_inicial = $_POST['anio_inicial'];
$mes_final = $_POST['mes_final'];
$anio_final = $_POST['anio_final'];
?>


<table id="tabla_personal_pendiente_plan" class="table table-sm">
    <thead>
        <tr>
            <th>Colaborador</th>
            <th>Plan</th>
            <th>Acciones</th>
            <th>Cumplimiento: <?php echo $mes_anterior; ?></th>
            <th>Fecha actualización</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        function like_match($pattern, $subject)
        {
            $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
            return (bool) preg_match("/^{$pattern}$/i", $subject);
        }
        $sql_planes_pendientes = "SELECT reg.nombres, reg.apellidos, r.id_reddin, r.id_plan_rel, r.oportunidadConsenso, r.more_actions, r.date_reg_action FROM t_reddin r  INNER JOIN registrogdp  reg ON reg.no_reloj = r.no_reloj  WHERE mes_reg BETWEEN '$mes_inicial' AND '$mes_final' AND year_reg ='$anio_final'";
        $r = mysqli_query($conn, $sql_planes_pendientes)or die(mysqli_error($conn));
        if (mysqli_fetch_row($r)) {

            while ($data = mysqli_fetch_array($r)) { ?>
                <tr>
                    <td><?php echo $data['nombres'];
                        echo " ";
                        echo $data['apellidos'] ?></td>
                    <td><?php echo $data['oportunidadConsenso'] ?></td>
                    <td><?php echo $data['more_actions'] ?></td>
                    <td>
                        <?php
                        if (like_match('%septiembre%', '' . $data['date_reg_action'] . '') != 'TRUE') {
                            echo '<i class="fas fa-times"></i> Imcumplido';
                        } else {
                            echo '<i class="fas fa-check"></i> Cumplido';
                        }
                        ?>
                    </td>
                    <td><?php echo $data['date_reg_action']; ?></td>
                    <td><button class="btn btn-sm btn-outline-success"><i class="fas fa-envelope"></i> Enviar Correo</button></td>
                </tr>
        <?php
            }
            mysqli_free_result($r);
        } ?>
    </tbody>
</table>

<script>
    $('#tabla_personal_pendiente_plan').DataTable();
</script>