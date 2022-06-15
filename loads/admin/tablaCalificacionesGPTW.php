<?php
include("../../conexion/conexion.php");
?>
<div class="table-responsive">
  <table id="tablaCalificacionGPTW" style="width:100%" class="table table-sm">
    <thead>
      <tr>
        <th># Reloj</th>
        <th>Nombres</th>
        <th>Resultado Liderazgo</th>
        <th>Resultado Compañerismo</th>
        <th>Mes</th>
        <th>Año</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_usuarios = mysqli_query($conn, 'SELECT * FROM registrogdp r INNER JOIN t_calificaciones_gptw c ON r.no_reloj = c.no_reloj AND c.estatus="1"');
      if (mysqli_num_rows($sql_usuarios) > 0) {
        while ($r = mysqli_fetch_assoc($sql_usuarios)) {
      ?>
          <tr>
            <td><?php echo $r['no_reloj']; ?></td>
            <td><?php echo $r['nombres'] . ' ' . $r['apellidos']; ?></td>
            <td><?php echo $r['resultado_liderazgo']; ?></td>
            <td><?php echo $r['resultado_companerismo']; ?></td>
            <td><?php echo $r['mes_reg']; ?></td>
            <td><?php echo $r['anio_reg']; ?></td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  $('#tablaCalificacionGPTW').DataTable({
    "order": [
      [0, "asc"]
    ]
  });

  $('#tablaCalificacionGPTW').on('change', '.privilegiosUsuario', function() {
    var $tr = $(this).closest('tr').addClass('Prueba');
    $('.privilegiosUsuario', $tr).each(function() {
      $('.btnActualizarPrivilegioUsuario', $tr).removeAttr('hidden');
    });
  }).trigger('.privilegiosUsuario'); // trigger input to set initial value in column

  $('#tablaCalificacionGPTW').on('click', '.btnActualizarPrivilegioUsuario', function(event) {
    event.preventDefault();
    var no_reloj = $(this).data('id');
    var privilegio = $(".privilegiosUsuario option:selected").val();
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
        if (data == 0) {
          alert('Error al actualizar');
        } else if (data == 1) {
          $('.tablaCalificacionesGPTW').load('../../loads/admin/tablaEmpleadosPrivilegios.php');
        }
      }
    });
  });
</script>