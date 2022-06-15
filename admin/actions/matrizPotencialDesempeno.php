           <div class="col-md-12 mt-5">
            <form id="formMatriz" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               <div class="table table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th>POTENCIAL</th>
                           <th>DESEMPEÑO</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>
                              <select class="form-control selectpicker selectMatriz" id="potencial" name="potencial" title="<?php 
                              $sqlPotencial = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$reloj' ") or die(mysqli_error($conn));
                              if (mysqli_num_rows($sqlPotencial) > 0){
                                 while($row = mysqli_fetch_assoc($sqlPotencial)) 
                                 {

                                  echo $row['potencial'];
                               }
                               mysqli_free_result($sqlPotencial); 
                               }else{ echo "Seleccione... ";}
                               ?>">
                               <option value="Potencial Promovible" style="background: #92d050;">Potencial Promovible</option>
                               <option value="Potencial Lateral" style="background:#00b0f0; ">Potencial Lateral</option>
                               <option value="Potencial Topado" style="background:#ffc000">Potencial Topado</option>
                               <option value="Sin elementos para evaluar" style="background: #ff0000; color:#fff;">Sin elementos para evaluar</option>
                            </select>
                         </td>
                         <td>
                           <select class="form-control selectpicker selectMatriz" id="desempeno" name="desempeno" title="<?php 
                           $sqlDesempeno = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$reloj' ") or die(mysqli_error($conn));
                           if (mysqli_num_rows($sqlDesempeno) > 0){
                              while($row = mysqli_fetch_assoc($sqlDesempeno)) 
                              {

                               echo $row['desempeno'];
                            }
                            mysqli_free_result($sqlDesempeno); 
                            }else{ echo "Seleccione... ";}
                            ?>">
                            <option value="Excepcional" style="background:#000; color: #fff;">Excepcional</option>
                            <option value="Excede Expectativas" style="background: #92d050;">Excede Expectativas</option>
                            <option value="Cumple Expectativas" style="background:#00b0f0; ">Cumple Expectativas</option>
                            <option value="Cumple Parcialmente Expectativas" style="background:#ffc000">Cumple Parcialmente Expectativas</option>
                            <option value="Insatisfactorio" style="background: #ff0000; color:#fff;">Insatisfactorio</option>
                         </select>
                      </td>
                      <td>
                        <input type="text" hidden="" id="txtreloj" value="<?= $reloj; ?>" name="no_relojC">
                        <?php 
                        $sqlCol = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$reloj'");
                        $mostrarR = $sqlCol->fetch_assoc();
                        ?>
                        <input type="text" hidden="" id="txtnombres" value="<?= $mostrarR['nombres']; ?>">
                        <input type="text" hidden="" id="txtapellidos" value="<?= $mostrarR['apellidos']; ?>">
                        <input type="text" hidden="" id="txtrelojSupervisor" value="<?= $mostrarR['no_reloj_supervisor']; ?>">
                        <input type="submit"  id="btnMatriz" class="btn btn-success btn-sm" value="Guardar"> </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </form>
      </div>         
      <div class="col-md-12" id="matrizDiv">
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
                        $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Promovible' AND desempeno='Excepcional'";
                        $sqlResult = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($sqlResult) > 0) {
                          ?>
                          <ul>
                           <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                              <li>
                                 <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                              </li>
                           <?php } ?>
                        </ul>
                     <?php } ?>
                  </td>
                  <td>
                     <?php
                     $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Promovible' AND desempeno='Excede Expectativas'";
                     $sqlResult = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                        <ul>
                           <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                              <li>
                                 <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                              </li>
                           <?php } ?>
                        </ul>
                     <?php } ?>
                  </td>
                  <td>
                     <?php
                     $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Promovible' AND desempeno='Cumple Expectativas'";
                     $sqlResult = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                        <ul>
                           <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                              <li>
                                 <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                              </li>
                           <?php } ?>
                        </ul>
                     <?php } ?>
                  </td>
                  <td>
                     <?php
                     $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Promovible' AND desempeno='Cumple Parcialmente Expectativas'";
                     $sqlResult = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                        <ul>
                           <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                              <li>
                                 <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                              </li>
                           <?php } ?>
                        </ul>
                     <?php } ?>
                  </td>
                  <td>
                     <?php
                     $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Promovible' AND desempeno='Insatisfactorio'";
                     $sqlResult = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($sqlResult) > 0) {
                        ?>
                        <ul>
                           <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                              <li>
                                 <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                              </li>
                           <?php } ?>
                        </ul>
                     <?php } ?>
                  </td>
               </tr>
               <tr>
                  <td style="background-color: #00b0f0;color:#000000;">Potencial Lateral</td>
                  <td>
                     <?php
                     $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Lateral' AND desempeno='Excepcional'";
                     $sqlResult = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($sqlResult) > 0) {
                       ?>
                       <ul>
                        <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                           <li>
                              <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </td>
               <td>
                  <?php
                  $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Lateral' AND desempeno='Excede Expectativas'";
                  $sqlResult = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sqlResult) > 0) {
                     ?>
                     <ul>
                        <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                           <li>
                              <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </td>
               <td>
                  <?php
                  $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Lateral' AND desempeno='Cumple Expectativas'";
                  $sqlResult = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sqlResult) > 0) {
                     ?>
                     <ul>
                        <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                           <li>
                              <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </td>
               <td>
                  <?php
                  $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Lateral' AND desempeno='Cumple Parcialmente Expectativas'";
                  $sqlResult = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sqlResult) > 0) {
                     ?>
                     <ul>
                        <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                           <li>
                              <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </td>
               <td>
                  <?php
                  $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Lateral' AND desempeno='Insatisfactorio'";
                  $sqlResult = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sqlResult) > 0) {
                     ?>
                     <ul>
                        <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                           <li>
                              <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                           </li>
                        <?php } ?>
                     </ul>
                  <?php } ?>
               </td>
            </tr>
            <tr>
               <td style="background-color: #ffc000; color:#000000;">Potencial Topado</td>
               <td>
                  <?php
                  $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Topado' AND desempeno='Excepcional'";
                  $sqlResult = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sqlResult) > 0) {
                    ?>
                    <ul>
                     <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                        <li>
                           <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                        </li>
                     <?php } ?>
                  </ul>
               <?php } ?>
            </td>
            <td>
               <?php
               $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Topado' AND desempeno='Excede Expectativas'";
               $sqlResult = mysqli_query($conn, $sql);
               if (mysqli_num_rows($sqlResult) > 0) {
                  ?>
                  <ul>
                     <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                        <li>
                           <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                        </li>
                     <?php } ?>
                  </ul>
               <?php } ?>
            </td>
            <td>
               <?php
               $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Topado' AND desempeno='Cumple Expectativas'";
               $sqlResult = mysqli_query($conn, $sql);
               if (mysqli_num_rows($sqlResult) > 0) {
                  ?>
                  <ul>
                     <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                        <li>
                           <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                        </li>
                     <?php } ?>
                  </ul>
               <?php } ?>
            </td>
            <td>
               <?php
               $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Topado' AND desempeno='Cumple Parcialmente Expectativas'";
               $sqlResult = mysqli_query($conn, $sql);
               if (mysqli_num_rows($sqlResult) > 0) {
                  ?>
                  <ul>
                     <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                        <li>
                           <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                        </li>
                     <?php } ?>
                  </ul>
               <?php } ?>
            </td>
            <td>
               <?php
               $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Potencial Topado' AND desempeno='Insatisfactorio'";
               $sqlResult = mysqli_query($conn, $sql);
               if (mysqli_num_rows($sqlResult) > 0) {
                  ?>
                  <ul>
                     <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                        <li>
                           <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                        </li>
                     <?php } ?>
                  </ul>
               <?php } ?>
            </td>
         </tr>
         <tr>
            <td style="background-color:#ff0000;color:#fff;">Sin elementos para evaluar</td>
            <td>
               <?php
               $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Sin elementos para evaluar' AND desempeno='Excepcional'";
               $sqlResult = mysqli_query($conn, $sql);
               if (mysqli_num_rows($sqlResult) > 0) {
                 ?>
                 <ul>
                  <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                     <li>
                        <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
         </td>
         <td>
            <?php
            $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Sin elementos para evaluar' AND desempeno='Excede Expectativas'";
            $sqlResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($sqlResult) > 0) {
               ?>
               <ul>
                  <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                     <li>
                        <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
         </td>
         <td>
            <?php
            $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Sin elementos para evaluar' AND desempeno='Cumple Expectativas'";
            $sqlResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($sqlResult) > 0) {
               ?>
               <ul>
                  <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                     <li>
                        <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
         </td>
         <td>
            <?php
            $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Sin elementos para evaluar' AND desempeno='Cumple Parcialmente Expectativas'";
            $sqlResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($sqlResult) > 0) {
               ?>
               <ul>
                  <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                     <li>
                        <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
         </td>
         <td>
            <?php
            $sql = "SELECT * FROM t_matriz WHERE no_reloj = '$reloj' AND potencial ='Sin elementos para evaluar' AND desempeno='Insatisfactorio'";
            $sqlResult = mysqli_query($conn, $sql);
            if (mysqli_num_rows($sqlResult) > 0) {
               ?>
               <ul>
                  <?php  while ($datos = mysqli_fetch_assoc($sqlResult)){  ?>
                     <li>
                        <?php echo $datos['nombres']; echo " ";  echo $datos['apellidos'];?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
         </td>
      </tr>
   </tbody>
</table>
</div>
<button class="btn btn-sm btn-info verMatriz mb-5"><i class="fas fa-users"></i> Ver colaboradores</button>
</div>