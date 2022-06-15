  <?php
  include("../../conexion/conexion.php");
  $id = $_POST["id"];
  $trAccionesVacio = "<tr><td colspan='3'><div class='alert alert-warning' role='alert'><i class='fas fa-exclamation-triangle'></i> No se han registrado acciones</div></td></tr>";
  ?>
  <div class="table-responsive">
    <p style="font-weight:600;"><i class="fas fa-history"></i> Historial</p>
    <table id="tablaAccionesPlanes" class="table table-sm">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Acción</th>
          <th>Evidencia</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_reddin  = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_plan_rel = $id");
        if (mysqli_num_rows($sql_reddin) > 0) {
          
          while ($datos = mysqli_fetch_array($sql_reddin)) {
            $num_td = 1;
        ?>
            <tr>
              <td data-id="<?= $datos["id_reddin"] ?>" class="input_acciones_gptw" data-num="<?php echo $num_td++; ?>"><?php echo $datos['date_reg_action']; ?></td>
              <td data-id="<?= $datos["id_reddin"] ?>" class="input_acciones_gptw" data-num="<?php echo $num_td++; ?>"> <?php echo $datos['more_actions']; ?></td>
              <td>
                <?php
                if ($datos['evidencias'] != ''){
                ?>
                  <a href="<?php echo $datos['evidencias']; ?>" download><span class="badge badge-info"><i class="fas fa-eye"></i> Descargar</span>
                  </a>
                <?php }
                ?>
              </td>
            </tr>
        <?php
          }
          mysqli_free_result($sql_reddin);
        } else {
          echo $trAccionesVacio;
        }
        ?>
      </tbody>
    </table>
  </div>