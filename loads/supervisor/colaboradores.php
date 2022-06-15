<?php
include('../../conexion/conexion.php');
$no_reloj = $_POST['no_reloj'];
$añoActual = date('Y');
?>
<div class="divOculto" id="div1">
    <?php
    $msgEmp = "";
    $Search = "SELECT * FROM registrogdp WHERE no_reloj_supervisor = '$no_reloj' ORDER BY nombres ASC";
    $resultado = mysqli_query($conn, $Search);
    if (mysqli_num_rows($resultado) > 0) {
        echo "<label id='lblAsistentes' style='font-weight:600;'>DIRECTOS</label>";
    ?>
        <div class="card-columns">
            <?php
            $o = 1;
            $p = 1;
            $c = 1;
            $g = 1;
            $arrayColaboradores = array();
            while ($datos = mysqli_fetch_assoc($resultado)) {
                $arrayColaboradores[] = $datos['no_reloj'];
                $no_reloj_col = $datos['no_reloj'];
                $personalCargo = $datos['cargoColab'];
            ?>
                <div class="card card_colaboradores h-100" style="width: 14rem; height:25rem; margin-top: 10px;">
                    <div class="img">
                        <img class="card-img-top" src="<?php if (empty($datos['img'])) {
                                                            echo '../../images/img_default.png';
                                                        }else{ echo $datos['img'];} ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center m-0"><?= $datos['nombres'] ?></h5>
                        <div class="text-center">
                            <p class="card-text card_reloj"><?= $datos['no_reloj'] ?></p>
                            <p class="card-text card_puesto"><?= $datos['puesto'] ?></p>
                            <div class="row">
                                <div class="col">
                                    <div class="chart-container">
                                        <a href="personal_info.php?no_reloj_col=<?= $datos['no_reloj']; ?>&displayCard=d-blockObjetivos&eventCard=objetivos">
                                            <canvas class="chartObjetivos" id="dougnutObjetivos<?= $o++; ?>"></canvas>
                                        </a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="chart-container">
                                        <a href="#" class="btnModalCompetencias" data-id="<?= $datos['no_reloj'] ?>">
                                            <canvas class="chartCompetencias" id="dougnutCompetencias<?= $c++; ?>"></canvas>
                                        </a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="chart-container">
                                        <a href="personal_info.php?no_reloj_col=<?= $datos['no_reloj']; ?>&displayCard=d-blockPlanes&eventCard=planes">
                                            <canvas class="chartGPTW" id="dougnutGPTW<?= $g++; ?>"></canvas>
                                        </a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="chart-container">
                                        <a href="personal_info.php?no_reloj_col=<?= $datos['no_reloj']; ?>&displayCard=d-blockPlanes&eventCard=planes">
                                            <canvas class="chartPlanes" id="dougnutPlanes<?= $p++; ?>"></canvas>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            mysqli_free_result($resultado);
            ?>
        </div>
    <?php
    } else {
        echo $msgEmp .= '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:90%; margin-left:50px; margin-top:5px; padding:10px; font-size:15px;">
                    <strong><i>Tus colaboradores aún no se han registrado, notificales</i></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
    }
    ?>
</div>

<div class="divOculto" id="div2">
    <?php
    $msgEmp = "";
    $Search = "SELECT no_reloj, no_reloj_supervisor, nombres, apellidos, puesto, img, liderArea FROM registrogdp WHERE liderArea = '$no_reloj' ORDER BY nombres ASC";
    $r = mysqli_query($conn, $Search);
    if (mysqli_num_rows($r) > 0) {
        echo "<label id='lblAsistentes' style='font-weight:600;'>INDIRECTOS</label>";
    ?>
        <div class="card-columns">
            <?php
            while ($datos = mysqli_fetch_assoc($r)) {
                $no_reloj_col = $datos['no_reloj'];
            ?>
                <div class="card card_colaboradores" style="width: 14rem; height:17em; margin-top: 10px;">
                    <div class="img">
                        <img class="card-img-top" src="<?php echo $datos['img']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center m-0"><a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>" style="font-size:14px; text-decoration: none; color: #000;"><?php echo $datos['nombres'] ?></a></h5>
                        <div class="text-center">
                            <p style="text-decoration:none"><?php echo $datos['no_reloj'] ?></p>
                            <p class="card-text text-center" style="font-size:13.5px;"><?php echo $datos['puesto'] ?></p>
                            <?php
                            $sql = $conn->query("SELECT * FROM t_evaluacion WHERE no_reloj = '$no_reloj_col' AND anio_reg = '$añoActual'");
                            $row = $sql->fetch_assoc();
                            ?>
                            <a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockObjetivos&eventCard=objetivos" style="font-size:12.5px;"><i class="fas fa-fw fa-bullseye"></i> Objetivos</a> | <a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockPlanes&eventCard=planes" style="font-size:12.5px;"><i class="fas fa-fw fa-chart-area"></i> Plan de Desarrollo</a>
                        </div>
                    </div>
                </div>
        </div>
<?php
            }
            mysqli_free_result($r);
        }
?>
</div>

<div class="col-sm-12 col-md-12 mt-5 pt-5">
    <h6>MATRIZ POTENCIAL/DESEMPEÑO</h6>
    <div class="table table-responsive">
        <table id="matrizPotencial" class="table-bordered">
            <thead>
                <tr>
                    <th style="background-color: #fff; border:none;"></th>
                    <th style="background-color: #fff; border:none;"></th>
                    <th id="tituloDesempeno" colspan="5">DESEMPEÑO</th>
                </tr>
            </thead>
            <tbody>
                <tr id="titulosDesempeño">
                    <td style="background-color: #fff; border:none;"></td>
                    <td style="background-color: #fff; border:none;"></td>
                    <td style="background-color:#000000; color:#fff; width: 20%; text-align: center;">Excepcional (12)</td>
                    <td style="background-color:#92d050; color:#000000; width: 20%; text-align: center;">Excede Expectativas (11)</td>
                    <td style="background-color:#00b0f0; color:#000000; width: 20%; text-align: center;">Cumple Expectativas (10)</td>
                    <td style="background-color:#ffc000; color:#000000; width: 20%; text-align: center;">Cumple Parcialmente Expectativas (8)</td>
                    <td style="background-color:#ff0000; color:#fff; width: 20%; text-align: center;">Insatisfactorio (5)</td>
                </tr>
                <tr>
                    <td id="tituloPotencial" rowspan="5">
                        <div>POTENCIAL</div>
                    </td>
                    <td style="background-color:#92d050; color:#000000;">Potencial Promovible</td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excede Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Insatisfactorio'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #00b0f0;color:#000000;">Potencial Lateral</td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excede Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Insatisfactorio'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ffc000; color:#000000;">Potencial Topado</td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excede Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Insatisfactorio'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="background-color:#ff0000;color:#fff;">Sin elementos para evaluar</td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excede Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$no_reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Insatisfactorio'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                            <ul>
                                <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                    <li><?php echo $datos['nombres'];
                                        echo " ";
                                        echo $datos['apellidos']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalCompetencias" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-gptw p-3"></div>
        </div>
    </div>
</div>

<?php
$anio = Date('Y');
foreach ($arrayColaboradores as $key => $value) {
    $sql_objetivos = mysqli_query($conn, "SELECT AVG(logro) AS logro, obj_no_reloj FROM objetivos_gdp WHERE obj_no_reloj = '$value' AND anio_reg = '$anio' GROUP BY obj_no_reloj") or die(mysqli_error($conn));
    $r = mysqli_fetch_assoc($sql_objetivos);
    if ($r['logro'] != '') {
        $arrayLogroObjetivos[] =  number_format(floor(($r['logro']) * 100) / 100, 2);
        $faltanteDataObjetivos[] = 100 - number_format(floor(($r['logro']) * 100) / 100, 2);
    } else {
        $arrayLogroObjetivos[] = 0;
        $faltanteDataObjetivos[] = 10 - 0;
    }

    $sql_planes = mysqli_query($conn, "SELECT COUNT(id_reddin) as planes FROM t_reddin WHERE no_reloj = '$value' AND oportunidadConsenso != '' AND estatus = 'Actual'") or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($sql_planes);
    if ($row['planes'] != '') {
        $arrayPlanesActuales[] = intval($row['planes']);
    } else {
        $arrayPlanesActuales[] = 0;
    }
}

$reloj = " WHERE no_reloj IN ('";
$reloj .= implode("', '", $arrayColaboradores);
$reloj .= "')";
$arrayTotal = array();
$sql_evaluacion = mysqli_query($conn, "SELECT *  FROM t_evaluacion " . $reloj . "");
if (mysqli_num_rows($sql_evaluacion) > 0) {
    while ($row = mysqli_fetch_assoc($sql_evaluacion)) {
        $sum =  (($row['competencia1'] + $row['competencia2'] + $row['competencia3'] + $row['competencia4'] + $row['competencia5'] + $row['competencia6'] + $row['competencia7'] + $row['competencia8'] + $row['competencia9'] + $row['competencia10'] + $row['competencia11'] + $row['competencia12'] + $row['competencia13'] + $row['competencia14'] + $row['competencia15'] + $row['competencia16'] + $row['competencia17'] + $row['competencia18'] + $row['competencia19'] + $row['competencia20']) / 20);
        $avgEvaluacion =  ($sum * 70) / 100;

        $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj =" . $row['no_reloj'] . "");
        if (mysqli_num_rows($sql_matriz) > 0) {
            $r = mysqli_fetch_assoc($sql_matriz);
            $desempeno = $r['desempeno'];
            if ($desempeno == 'Excepcional') {
                $calificacion = 12;
            } else if ($desempeno == 'Excede Expectativas') {
                $calificacion = 11;
            } else if ($desempeno == 'Cumple Expectativas') {
                $calificacion = 10;
            } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
                $calificacion = 8;
            } else if ($desempeno == 'Insatisfactorio') {
                $calificacion = 5;
            }
        } else {
            $calificacion = 0;
        }
        $avgDesempeno = ($calificacion * 30) / 100;
        $avgTotal[] =  number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
        $faltanteDataCompetencias[] = 10 - number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
    }
} else {
    foreach ($arrayColaboradores as $key => $value) {
        $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj ='$value'");
        if (mysqli_num_rows($sql_matriz) > 0) {
            $r = mysqli_fetch_assoc($sql_matriz);
            $desempeno = $r['desempeno'];
            if ($desempeno == 'Excepcional') {
                $calificacion = 12;
            } else if ($desempeno == 'Excede Expectativas') {
                $calificacion = 11;
            } else if ($desempeno == 'Cumple Expectativas') {
                $calificacion = 10;
            } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
                $calificacion = 8;
            } else if ($desempeno == 'Insatisfactorio') {
                $calificacion = 5;
            }
        } else {
            $calificacion = 0;
        }
        $avgDesempeno = ($calificacion * 30) / 100;
        $avgTotal[] =  number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
        $faltanteDataCompetencias[] = 10 - number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
    }
}
mysqli_free_result($sql_evaluacion);
?>
<script>
    window.onresize = function(event) {
        document.location.reload(true);
    }
    $('.btnModalCompetencias').on('click', function(e) {
        e.preventDefault();
        var no_reloj = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "../../ajax/supervisor/ajax_modalCompetencias.php",
            data: {
                no_reloj: no_reloj
            },
            cache: false,
            success: function(data) {
                $('#modalCompetencias').modal('show');
                $('#modalCompetencias').find('.modal-body-gptw').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    //---------------CHART OBJETIVOS-----------------------//
    const datapointsObjetivos = <?php echo json_encode($arrayLogroObjetivos); ?>;
    const datapointsFaltanteObjetivos = <?php echo json_encode($faltanteDataObjetivos); ?>;
    $('.chartObjetivos').each(function(index) {
        var increment = index + 1;
        var chartDoughnutObjetivos = 'dougnutObjetivos' + increment;
        const chartObjetivos = document.getElementById(chartDoughnutObjetivos);
        const dataObjetivos = {
            labels: ['Cumplido', ''],
            datasets: [{
                data: [datapointsObjetivos[index], datapointsFaltanteObjetivos[index]],
                backgroundColor: ['#31b17e', '#B5EAD5'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const porcentajeObjetivos = {
            id: 'porcentajeObjetivos',
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    }
                } = chart;
                ctx.save();
                ctx.font = options.fontSize + 'px ' + options.fontFamily;
                ctx.textAlign = 'center';
                ctx.fillStyle = options.fontColor;
                ctx.fillText(datapointsObjetivos[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutObjetivos = new Chart(chartObjetivos, {
            type: 'doughnut',
            data: dataObjetivos,
            options: {
                events: [],
                animation: {
                    duration: 0
                },
                responsive: true,
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'Objetivos'
                    },
                    porcentajeObjetivos: {
                        fontColor: '#31b17e',
                        fontSize: 13,
                        fontFamily: 'sans-serif',
                        fontStyle: "bold",
                    }
                }
            },
            plugins: [porcentajeObjetivos]
        });

    });

    //---------------CHART EVALUACION COMPETENCIAS-----------------------//
    const datapointsCompetencias = <?php echo json_encode($avgTotal); ?>;
    const datapointsCompetenciasFaltante = <?php echo json_encode($faltanteDataCompetencias); ?>;
    $('.chartCompetencias').each(function(index) {
        var incrementCompetencias = index + 1;
        var chartDoughnutCompetencias = 'dougnutCompetencias' + incrementCompetencias;
        const chartCompetencias = document.getElementById(chartDoughnutCompetencias);
        const dataCompetencias = {
            labels: ['Cumplido', ''],
            datasets: [{
                data: [datapointsCompetencias[index], datapointsCompetenciasFaltante[index]],
                backgroundColor: ['#f37b2f', '#F6C2A2'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const porcentajeCompetencias = {
            id: 'porcentajeCompetencias',
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    }
                } = chart;
                ctx.save();
                ctx.font = options.fontSize + 'px ' + options.fontFamily;
                ctx.textAlign = 'center';
                ctx.fillStyle = options.fontColor;
                ctx.fillText(datapointsCompetencias[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutComperencias = new Chart(chartCompetencias, {
            type: 'doughnut',
            data: dataCompetencias,
            options: {
                events: [],
                animation: {
                    duration: 0
                },
                responsive: true,
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'Competencias'
                    },
                    porcentajeCompetencias: {
                        fontColor: '#f37b2f',
                        fontSize: 13,
                        fontFamily: 'sans-serif',
                        fontWeight: "bold",
                    }
                }
            },
            plugins: [porcentajeCompetencias]
        });

    });

    $('.chartGPTW').each(function(index) {
        var incrementGPTW = index + 1;
        var chartDoughnutGPTW = 'dougnutGPTW' + incrementGPTW;
        const chartGPTW = document.getElementById(chartDoughnutGPTW);
        const dataGPTW = {
            labels: ['Cumplido', ''],
            datasets: [{
                label: 'Dataset 1',
                data: [90, 10],
                backgroundColor: ['#dc3545', '#EAB9BE'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const porcentajeGPTW = {
            id: 'porcentajeGPTW',
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    }
                } = chart;
                ctx.save();
                ctx.font = options.fontSize + 'px ' + options.fontFamily;
                ctx.textAlign = 'center';
                ctx.fillStyle = options.fontColor;
                ctx.fillText('?', width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutGPTW = new Chart(chartGPTW, {
            type: 'doughnut',
            data: dataGPTW,
            options: {
                events: [],
                animation: {
                    duration: 0
                },
                responsive: true,
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'GPTW'
                    },
                    porcentajeGPTW: {
                        fontColor: '#dc3545',
                        fontSize: 13,
                        fontFamily: 'sans-serif',
                        fontStyle: "bold",
                    }
                }
            },
            plugins: [porcentajeGPTW]
        });
    });

    //---------------CHART PLANES-----------------------//
    const datapointsPlanes = <?php echo json_encode($arrayPlanesActuales) ?>;
    $('.chartPlanes').each(function(index) {
        var incrementPlanes = index + 1;
        var chartDoughnutPlanes = 'dougnutPlanes' + incrementPlanes;
        const chartPlanes = document.getElementById(chartDoughnutPlanes);
        const dataPlanes = {
            labels: ['Cumplido', 'Faltante'],
            datasets: [{
                label: 'Dataset 1',
                data: [100, 0],
                backgroundColor: ['#247ef2', 'transparent'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const porcentajePlanes = {
            id: 'porcentajePlanes',
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    }
                } = chart;
                ctx.save();
                ctx.font = options.fontSize + 'px ' + options.fontFamily;
                ctx.textAlign = 'center';
                ctx.fillStyle = options.fontColor;
                ctx.fillText(datapointsPlanes[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutPlanes = new Chart(chartPlanes, {
            type: 'doughnut',
            data: dataPlanes,
            options: {
                events: [],
                animation: {
                    duration: 0
                },
                responsive: true,
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'Planes'
                    },
                    porcentajePlanes: {
                        fontColor: '#247ef2',
                        fontSize: 13,
                        fontFamily: 'sans-serif',
                        fontStyle: "bold",
                    }
                }
            },
            plugins: [porcentajePlanes]
        });

    });
</script>