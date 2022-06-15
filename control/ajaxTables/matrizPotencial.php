<?php
include("../../conexion/conexion.php");
$relojLider = $_POST['no_reloj'];
?>
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excepcional'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excede Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Insatisfactorio'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excepcional'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excede Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Insatisfactorio'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excepcional'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excede Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Insatisfactorio'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excepcional'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excede Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
               $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj_supervisor = '$relojLider' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Insatisfactorio'";
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