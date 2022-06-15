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
            while ($datos = mysqli_fetch_array($resultado)) {
                $no_reloj_col = $datos['no_reloj'];
                $personalCargo = $datos['cargoColab'];
            ?>
                <div class="card card_colaboradores" style="width: 14rem; height:17em; margin-top: 10px;">
                    <div class="img">
                        <img class="card-img-top" src="<?php echo $datos['img'] ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center m-0"><?php echo $datos['nombres'] ?></h5>
                        <div class="text-center">
                            <p><?php echo $datos['no_reloj'] ?></p>
                            <p class="card-text card_puesto text-center"><?php echo $datos['puesto'] ?></p>
                            <?php
                            $sql = $conn->query("SELECT * FROM t_evaluacion WHERE no_reloj = '$no_reloj_col' AND anio_reg = '$añoActual'");
                            $row = $sql->fetch_assoc();
                            ?>
                            <a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockObjetivos&eventCard=objetivos"><i class="fas fa-fw fa-bullseye"></i> Objetivos</a> | <a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockPlanes&eventCard=planes"><i class="fas fa-fw fa-chart-area"></i> Plan de Desarrollo</a>

                            <!-- <?php if ($datos['habilitarEvaluacion'] == 1) { ?>
                                <p>
                                    <a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-block&eventCard=evaluacion"><?php if ($personalCargo == 0) {
                                        echo "Evaluar Competencias:";
                                    } else {
                                        echo "Evaluar para sesión de talento:";
                                    } ?></a> <?php if ($row != NULL) {
                                                                                                                                                                                                    echo '<span class="fas fa-check-square" style="color:green;"></span>';
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo '<i class="fas fa-times" style="color:red;"></i>';
                                                                                                                                                                                                } ?>
                                </p>
                            <?php } ?> -->
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
        $msgEmp .= '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:90%; margin-left:50px; margin-top:5px; padding:10px; font-size:15px;">
                    <strong><i>Tus colaboradores aún no se han registrado, notificales</i></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
        echo $msgEmp;
    }
    ?>
</div>

<div class=" divOculto" id="div2">
    <?php
    $msgEmp = "";
    $Search = "SELECT no_reloj, no_reloj_supervisor, nombres, apellidos, puesto, img, liderArea FROM registrogdp WHERE liderArea = '$no_reloj' ORDER BY nombres ASC";
    $r = mysqli_query($conn, $Search);
    if (mysqli_num_rows($r) > 0) {
        echo "<label id='lblAsistentes' style='font-weight:600;'>INDIRECTOS</label>";
    ?>
        <div class="card-columns">
            <?php
            while ($datos = mysqli_fetch_array($r)) {
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
                            
                            <!-- <?php if ($datos['habilitarEvaluacion'] == 1) { ?>
                                <p hidden style="font-size:12.5px;"><a href="personal_info.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-block&eventCard=evaluacion"><?php if ($personalCargo == 0) {
                                                                                                                                                                                        echo "Evaluar Competencias:";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "Evaluar para sesión de talento:";
                                                                                                                                                                                    } ?></a> <?php if ($row != NULL) {
                                                                                                                                                                                                    echo '<span class="fas fa-check-square" style="color:green;"></span>';
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo '<i class="fas fa-times" style="color:red;"></i>';
                                                                                                                                                                                                } ?>
                                </p>
                            <?php } ?> -->
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
                            <td style="background-color:#000000; color:#fff; width: 20%; text-align: center;">Excepcional</td>
                            <td style="background-color:#92d050; color:#000000; width: 20%; text-align: center;">Excede Expectativas</td>
                            <td style="background-color:#00b0f0; color:#000000; width: 20%; text-align: center;">Cumple Expectativas</td>
                            <td style="background-color:#ffc000; color:#000000; width: 20%; text-align: center;">Cumple Parcialmente Expectativas</td>
                            <td style="background-color:#ff0000; color:#fff; width: 20%; text-align: center;">Insatisfactorio</td>
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