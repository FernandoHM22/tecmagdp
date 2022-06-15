<?php
include("../../conexion/conexion.php");
$año = $_POST['año'];
?>
<div class="table-responsive">
  <table id="tablaEmpleadosPrivilegio" style="width:100%" class="table table-sm">
    <thead>
      <tr>
        <th># Reloj</th>
        <th>Nombres</th>
        <th>Depto</th>
        <th>Tipo Usuario</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_usuarios = mysqli_query($conn, 'SELECT r.no_reloj, r.nombres, r.apellidos, r.puesto, r.depto, l.no_reloj, l.isAdmin, l.perfil FROM registrogdp r INNER JOIN login_gdp l ON r.no_reloj = l.no_reloj ORDER BY l.isAdmin DESC');
      if (mysqli_num_rows($sql_usuarios) > 0) {
        while ($r = mysqli_fetch_assoc($sql_usuarios)) {
      ?>
          <tr>
            <td><?php echo $r['no_reloj']; ?></td>
            <td><?php echo $r['nombres'] . ' ' . $r['apellidos']; ?></td>
            <td><?php echo $r['depto']; ?></td>
            <td>
              <?php
              if ($r['isAdmin'] == 0) {
                echo '<span class="badge badge-primary">Usuario</span>';
              } else  if ($r['isAdmin'] == 1) {
                echo '<span class="badge badge-success">Administrador</span>';
              } else if ($r['isAdmin'] == 2) {
                echo '<span class="badge badge-warning">Admin Cult. E&O</span>';
              } else if ($r['isAdmin'] == 3) {
                echo '<span class="badge badge-info">Admin. Reclutamiento</span>';
              } else if ($r['isAdmin'] == 4) {
                echo '<span class="badge badge-danger">Admin. Cult. GPTW</span>';
              }

              ?>
            </td>
            <td>
              <select class="custom-select custom-select-sm privilegiosUsuario">
                <option hidden>Seleccionar</option>
                <option value="0">Usuario</option>
                <option value="1">Administrador</option>
                <option value="2">Admin Cult. E&O</option>
                <option value="3">Admin. Reclutamiento</option>
                <option value="4">Admin. Cult. GPTW</option>
              </select>

            </td>
            <td><a href="#" data-id="<?php echo $r['no_reloj']; ?>" class="btnActualizarPrivilegioUsuario" hidden><i class="fas fa-save"></i></a></td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  $('#tablaEmpleadosPrivilegio').DataTable({
    "order": [
      [4, "desc"]
    ]
  });

  $('#tablaEmpleadosPrivilegio').on('change', '.privilegiosUsuario', function() {
    var $tr = $(this).closest('tr');
    $('.privilegiosUsuario', $tr).each(function() {
      $('.btnActualizarPrivilegioUsuario', $tr).removeAttr('hidden');
    });
  }).trigger('.privilegiosUsuario'); // trigger input to set initial value in column

  $('#tablaEmpleadosPrivilegio').on('click', '.btnActualizarPrivilegioUsuario', function(event) {
    event.preventDefault();
    var $tr = $(this).closest('tr');
    var no_reloj = $(this).data('id');
    var privilegio = $(".privilegiosUsuario option:selected", $tr).val();
    $.ajax({
      url: '../../ajax/perfil/ajax_editar_privilegios.php',
      cache: false,
      type: 'POST',
      data: {
        no_reloj: no_reloj,
        privilegio: privilegio
      },
      success: function(data) {
        var data = data.trim();
        if (data == 1) {
          Swal.fire({
            icon: 'success',
            text: 'Privilegio actualizado éxitosamente!'
          });
          $('.TablaEmpleadosPrivilegios').load('../../loads/admin/tablaEmpleadosPrivilegios.php');

        } else {
          Swal.fire({
            icon: 'error',
            text: 'Error al actualizar privilegio!'
          });
        }
      }
    });
  });
</script>