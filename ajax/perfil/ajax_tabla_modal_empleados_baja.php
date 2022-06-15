<?php
include("../../conexion/conexion.php");
?>
<div class="table-responsive">
  <table id="tabla_empleados_baja" class="table table-sm table-hover">
    <thead>
      <tr>
        <th></th>
        <th># Reloj</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Puesto</th>
        <th>Depto</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_run = mysqli_query($conn, 'SELECT * FROM t_tmp_registro ORDER BY no_reloj ASC');
      if (mysqli_num_rows($sql_run) > 0) {
        $numCheckboxInput = 0;
        $numCheckboxLabel = 0;
        while ($datos = mysqli_fetch_assoc($sql_run)) {
          $no_reloj_temp = $datos['no_reloj'];
      ?>
          <tr>
            <td>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="<?php echo $no_reloj_temp; ?>" class="custom-control-input" name="no_reloj[]" id="customCheck<?php echo $numCheckboxInput++ ?>">
                <label class="custom-control-label" for="customCheck<?php echo $numCheckboxLabel++ ?>"></label>
              </div>
            </td>
            <td><?php echo $datos['no_reloj']; ?></td>
            <td><?php echo $datos['nombres']; ?></td>
            <td><?php echo $datos['apellidos']; ?></td>
            <td><?php echo $datos['correo']; ?></td>
            <td><?php echo $datos['puesto']; ?></td>
            <td><?php echo $datos['depto']; ?></td>
            <td>
              <?php
              $res = mysqli_query($conn, "SELECT no_reloj FROM registrogdp  WHERE no_reloj = '$no_reloj_temp'");
              $row = mysqli_fetch_row($res);
              if ($row != '') {
                echo "<i class='fas fa-check'></i>";
              } else {
                echo "<i class='fas fa-times'></i>";
              }

              ?>
            </td>
            <td class="text-center"></td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    var tabla_bajas = $('#tabla_empleados_baja').DataTable();

    $("#tabla_empleados_baja").on('click', 'td', function() {
      $('.delete').css('display', 'none');
      $('#btnEliminarUsuarios').removeAttr('hidden');
      var $tr = $(this).closest('tr');
      $("td", $tr).each(function() { // iterate over inputs except last
        $("input[type='checkbox']", $tr).attr('checked', !$("input[type='checkbox']", $tr).attr('checked'));
      });
    });

    $(document).on("click", "#btnEliminarUsuarios", function(event) {
      var arr = tabla_bajas.$('input[name="no_reloj[]"]:checked').map(function() {
        return $(this).val();
      }).get();


      Swal.fire({
        title: "Desea eliminar usuarios?",
        icon: "warning",
        text:"Una vez eliminados no se podran recuperar",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, guardar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../ajax/perfil/ajax_eliminarUsuarios.php",
            method: 'POST',
            dataType: "JSON",
            data: {
              no_reloj_dl: no_reloj_dl,
            },
            success: function(data) {
              data = data.trim();
              if (data == 1) {

                swal("Eliminado con éxito!", {
                  icon: "success",
                });
              } else {
                swal("Error al registrar!", {
                  icon: "error",
                });
              }
            }
          });
        }
      });

    });
  });
</script>