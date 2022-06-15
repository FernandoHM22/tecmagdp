<?php
include('../../conexion/conexion.php');
$reloj_supervisor = $_POST['reloj_supervisor'];
?>
<div class="table-responsive">
    <table class="table table-hover table-sm table-fit mt-3" id="seguimientoReddin">
        <thead>
            <tr>
                <th></th>
                <th>Oportunidad</th>
                <th>Notas para el Dialogo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlQuery = mysqli_query($conn, "SELECT r.no_reloj, r.nombres, r.apellidos, r.img, r.no_reloj_supervisor, r.region, p.no_reloj, p.oportunidadConsenso, p.notas, p.estatus FROM registrogdp r  INNER JOIN t_reddin p 
             ON p.no_reloj = r.no_reloj AND p.estatus = 'Actual' AND r.no_reloj_supervisor = $reloj_supervisor 
             ORDER BY r.region") or die(mysqli_error($conn));
            while ($row1 = mysqli_fetch_assoc($sqlQuery)) {
                $result[$row1['no_reloj']][$row1['oportunidadConsenso']][$row1['notas']][] = $row1;
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

                    echo '<ul><li>' . $oportunidades . '</li></ul>';
                }
                echo '</td>';
                echo '<td>';
                foreach ($grupoColaboradores as $oportunidades => $grupoOportunidades) {
                    foreach ($grupoOportunidades as $notas => $grupoNotas) {
                        echo '<ul><li>' . $notas . '</li></ul>';
                    }
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>