<?php
include('../../conexion/conexion.php');
setlocale(LC_ALL, "es_MX");
$reloj_supervisor = $_POST['reloj_supervisor'];
?>
<div class="table-responsive">
    <table class="table table-hover table-sm table-fit mt-3" id="seguimientoReddin">
        <thead>
            <tr>
                <th width="5%"></th>
                <th width="10%">Oportunidad</th>
                <th width="20%">Ultima Accion</th>
                <th width="10%">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlQuery = mysqli_query($conn, "SELECT r.no_reloj, r.nombres, r.apellidos, r.img, r.no_reloj_supervisor, r.region, p.id_reddin, p.no_reloj, p.oportunidadConsenso, p.notas, p.estatus FROM registrogdp r  INNER JOIN t_reddin p 
             ON p.no_reloj = r.no_reloj  AND p.oportunidadConsenso != ''  AND p.estatus = 'Actual' AND r.no_reloj_supervisor = $reloj_supervisor") or die(mysqli_error($conn));
            while ($row1 = mysqli_fetch_assoc($sqlQuery)) {
                $result[$row1['no_reloj']][$row1['oportunidadConsenso']][$row1['id_reddin']][] = $row1;
            }
            foreach ($result as $colaboradoresReddin => $grupoColaboradores) {
                echo '<tr>';
                $sql = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$colaboradoresReddin';");
                $row = $sql->fetch_assoc();
                echo '<td class="text-center">
                        <div><img width="80px" src="' . $row['img'] . '"></div>
                        <div>' . $row['nombres'] . '</div> 
                    </td>';
                echo '<td>';
                foreach ($grupoColaboradores as $oportunidades => $grupoOportunidades) {
                    echo '<ul><li>' . $oportunidades . '</li>   </ul>';
                }
                echo '</td>';
                echo '<td>';
                foreach ($grupoColaboradores as $oportunidades => $grupoOportunidades) {
                    foreach ($grupoOportunidades as $id_reddin => $grupoReddin) {
                        $sql = "SELECT * FROM t_reddin WHERE id_plan_rel = '$id_reddin' ORDER BY fecha_registro DESC LIMIT 1";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                            while ($datos = mysqli_fetch_array($sqlResult)) {
                                if ($datos['more_actions'] != '') {
                                    echo '<ul><li>' . $datos['more_actions'] . '</li></ul>';
                                }
                            }
                        } else {
                            $sql = "SELECT * FROM t_reddin WHERE id_reddin = '$id_reddin'";
                            $sqlResult = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($sqlResult) > 0) {
                                while ($datos = mysqli_fetch_array($sqlResult)) {

                                    if ($datos['acciones'] != '') {
                                        echo '<ul><li>' . $datos['acciones'] . '</li></ul>';
                                    }
                                }
                            }
                        }
                    }
                }
                echo '</td>';
                echo '<td>';
                foreach ($grupoColaboradores as $oportunidades => $grupoOportunidades) {
                    foreach ($grupoOportunidades as $id_reddin => $grupoReddin) {
                        $sql = "SELECT * FROM t_reddin WHERE id_plan_rel = '$id_reddin' ORDER BY fecha_registro DESC LIMIT 1";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                            while ($datos = mysqli_fetch_array($sqlResult)) {
                                echo '<ul><li>' . strftime("%d de %B de %Y", strtotime($datos['fecha_registro'])) . '</li></ul>';
                            }
                        } else {
                            $sql = "SELECT * FROM t_reddin WHERE id_reddin = '$id_reddin'";
                            $sqlResult = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($sqlResult) > 0) {
                                while ($datos = mysqli_fetch_array($sqlResult)) {
                                    if ($datos['acciones'] != '') {
                                        echo '<ul><li>' . $datos['fecha_registro'] . '</li></ul>';
                                    }
                                }
                            }
                        }
                    }
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>