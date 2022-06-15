<?php
require_once '../../conexion/conexion.php';
$reloj = $_POST['no_reloj'];
$no_reloj_sup = $_POST['no_reloj_sup'];
?>

<div class="col-md-3">
    <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Desempeño</label>
        <div class="col-sm-7">
            <select class="form-control form-control-sm selectMatriz" id="desempeno" name="desempeno">
                <option value="Excepcional" style="background:#000; color: #fff;">Excepcional</option>
                <option value="Excede Expectativas" style="background: #92d050;">Excede Expectativas</option>
                <option value="Cumple Expectativas" style="background:#00b0f0; ">Cumple Expectativas</option>
                <option value="Cumple Parcialmente Expectativas" style="background:#ffc000">Cumple Parcialmente Expectativas</option>
                <option value="Insatisfactorio" style="background: #ff0000; color:#fff;">Insatisfactorio</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Potencial</label>
        <div class="col-sm-7">
            <select class="form-control form-control-sm selectMatriz" id="potencial" name="potencial">
                <option value="Potencial Promovible" style="background: #92d050;">Potencial Promovible</option>
                <option value="Potencial Lateral" style="background:#00b0f0; ">Potencial Lateral</option>
                <option value="Potencial Topado" style="background:#ffc000">Potencial Topado</option>
                <option value="Sin elementos para evaluar" style="background: #ff0000; color:#fff;">Sin elementos para evaluar</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm"><a href="#" class="btnGenerarMatriz disabled" data-id="<?=$reloj?>">Generar Matriz</a></label>
        <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm"><a href="#" class="btnVerMatrizColaboradores" data-id="<?=$no_reloj_sup?>">Ver Matriz Colaboradores</a></label>
    </div>
</div>
<div class="col-md-9">
    <div class="table-responsive">
        <table id="matrizPotencial" class="table table-sm table-bordered">
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                            0
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excede Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Insatisfactorio'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excepcional'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excede Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Insatisfactorio'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excepcional'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excede Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Insatisfactorio'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excepcional'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excede Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                        $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Insatisfactorio'";
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
