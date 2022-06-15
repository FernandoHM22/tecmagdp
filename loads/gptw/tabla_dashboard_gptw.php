<?php
require_once '../../conexion/conexion.php';
$regiones = " AND r.region IN ('";
$regiones .= implode("', '", $_POST['region']);
echo $regiones .= "')";
$mes = " AND mes_reg IN ('";
$mes .= implode("', '", $_POST['mes']);
echo $mes .= "')";
$depto = " AND r.depto IN ('";
$depto .= implode("', '", $_POST['depto']);
echo $depto .= "')";
?>

<div class="table-responsive">
    <table id="tabla_dashboard_gptw" class="table table-sm">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Oportunidad</th>
                <th>Region</th>
                <th>Acciones</th>
                <th>Mes</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_gptw = mysqli_query($conn, "SELECT g.no_reloj, g.seguimiento, r.nombres, r.apellidos, r.region, o.id_reddin, o.oportunidadConsenso, o.tipo_plan FROM
            t_calificaciones_gptw g INNER JOIN registrogdp r ON g.no_reloj = r.no_reloj INNER JOIN t_reddin o ON g.no_reloj = o.no_reloj AND g.seguimiento = '1' AND o.tipo_plan = 'GPTW'" . $regiones . " " . $depto . "") or die(mysqli_error($conn));
            $arrayRelojs = array();
            if (mysqli_num_rows($sql_gptw) > 0) {
                $t = 0;
                $f = 0;
                while ($datos = mysqli_fetch_assoc($sql_gptw)) {
                    $id_reddin = $datos['id_reddin'];
                    $arrayRelojs[] = $datos['no_reloj'];
            ?>
                    <tr>
                        <td><?= $datos['nombres'] ?></td>
                        <td><?= $datos['oportunidadConsenso'] ?></td>
                        <td><?= $datos['region'] ?></td>
                        <?php

                        $sql_acciones = mysqli_query($conn, "SELECT acciones_seguimiento, mes_reg FROM t_acciones_seguimiento WHERE id_reddin ='$id_reddin' " . $mes . " ORDER BY fecha_registro DESC") or die(mysqli_error($conn));
                        if (mysqli_num_rows($sql_acciones) > 0) {
                            while ($row = mysqli_fetch_assoc($sql_acciones)) {
                                $acciones[] = $row["acciones_seguimiento"];
                                $meses[] = $row["mes_reg"];
                            };
                        ?>
                            <td>
                                <ul>
                                    <?php
                                    foreach ($acciones as $key => $accion) {
                                        echo '<li>' . $accion . '</li>';
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <?php
                                    foreach ($meses as $key => $mes_reg) {
                                        echo '<li>' . $mes_reg . '</li>';
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td><?php
                                for ($i = 0; $i < count($acciones); $i++) {
                                    echo '<i class="fas fa-check"></i>';
                                }
                                ?>
                            </td>
                            <td></td>
                        <?php
                            unset($acciones);
                            unset($meses);
                        } else {
                            echo '<td><span>No hay seguimiento</span></td>
                            <td></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck' . $t++ . '" value="' . $datos['no_reloj'] . '">
                            <label class="custom-control-label" for="customCheck' . $f++ . '"></label>
                        </div></td>';
                        }
                        ?>
                    </tr>
                <?php
                }
                mysqli_free_result($sql_gptw);

                // $relojs = " AND r.no_reloj NOT IN ('";
                // $relojs .= implode("', '", $arrayRelojs);
                // $relojs .= "')";
                // $sql_faltantes_gptw = mysqli_query($conn, " SELECT  g.no_reloj, g.seguimiento, r.nombres, r.apellidos, r.depto, r.region FROM t_calificaciones_gptw g INNER JOIN registrogdp r ON g.no_reloj = r.no_reloj AND g.seguimiento = '1' " . $relojs . "") or die(mysqli_error($conn));
                // $i = 0;
                // $f = 0;
                // while ($row = mysqli_fetch_assoc($sql_faltantes_gptw)) {
                ?>
                <!-- <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck<?= $i++ ?>">
                                <label class="custom-control-label" for="customCheck<?= $f++ ?>"></label>
                            </div>
                        </td>
                        <td><?= $row['no_reloj'] ?></td>
                        <td><?= $row['nombres'] . " " . $row['apellidos'] ?></td>
                        <td></td>
                        <td><?= $row['region'] ?></td>
                        <td></td>
                        <td><?= $row['depto'] ?></td>
                        <td></td>
                        <td><i class="fas fa-times"></i></td>
                    </tr> -->
            <?
                // }
                // mysqli_free_result($sql_faltantes_gptw);
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $('#tabla_dashboard_gptw').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
        }
    });
</script>