<?php
include('../../conexion/conexion.php');
$checkboxRegion = $_POST['checkboxRegion'];
$checkboxDepto = $_POST['checkboxDepto'];
$region = "'" . implode("', '", $checkboxRegion) . "'";
$deptos = "'" . implode("', '", $checkboxDepto) . "'";
?>

<div class="table-responsive">
    <table id="tabla_cumplimiento_planes" class="table table-sm">
        <thead>
            <tr>
                <th>Departamento</th>
                <th># Total</th>
                <th>Cumplidos</th>
                <th>Faltan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT count(no_reloj) as total, depto FROM registrogdp WHERE depto IN($deptos) AND region IN($region) GROUP BY depto ORDER BY depto ASC";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_fetch_row($query_run) > 0) {
                foreach ($query_run as $r) {
                    $depto =  $r['depto'];
                    $total = $r['total'];
                    $arrayTotal[] = $total;
            ?>
                    <tr>
                        <td><?php echo $depto; ?> </td>
                        <td><?php echo $total; ?></td>
                        <td><?php $subquery = " SELECT SUM(sqr.totalXDepto) AS totalCumplidos FROM (SELECT t.id_reddin, t.id_plan_rel, t.no_reloj, r.depto, COUNT(DISTINCT t.no_reloj) AS totalXDepto FROM t_reddin t INNER JOIN registrogdp r ON r.no_reloj = t.no_reloj AND r.depto = '$depto' AND t.year_reg = 2021 AND t.estatus = 'Actual' AND t.id_plan_rel !='' AND t.mes_reg IN('Julio','Agosto') group by t.no_reloj) AS sqr;";
                            $r = mysqli_query($conn, $subquery);
                            $row = $r->fetch_assoc();
                            $totalCumplidos = $row['totalCumplidos'];
                            if($totalCumplidos !=''){
                                $arrayTotalCumplidos[] = $totalCumplidos;
                                echo $totalCumplidos;
                            }else{
                                echo '0';
                            }
                            ?></td>
                        <td><?php $totalFaltantes = $total - $totalCumplidos;
                        echo $totalFaltantes;
                        $arrayFaltantes[] = $totalFaltantes; ?></td>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
        <tfoot style="background-color: rgba(0, 122, 129 , 0.08);">
            <tr>
                <td style="font-weight:600;">Total</td>
                <td style="font-weight:600;"><?php echo $sumTotalColaboradores = array_sum($arrayTotal); ?></td>
                <td style="font-weight:600;"><?php echo $sumTotalCumplidos = array_sum($arrayTotalCumplidos); ?></td>
                <td style="font-weight:600;"><?php echo $sumTotalFaltantes = array_sum($arrayFaltantes); ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $('#tabla_cumplimiento_planes').dataTable({
        "searching": false,
        "paging": false,
        "info": false,
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
        }
    });
</script>