<?php
include('../../conexion/conexion.php');
$reloj_supervisor = $_POST['reloj_supervisor'];
?>
<?php
$sql_evaluacion = mysqli_query($conn, "SELECT * FROM t_evaluacion WHERE reloj_lider = '$reloj_supervisor'");
if (mysqli_num_rows($sql_evaluacion) > 0) {
  $evaluacion = true;
} else {
  $evaluacion = false;
}
?>
<div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
  <strong>INSTRUCCIONES:</strong>
  <br>
  Califica del 1 al 10 cada competencia.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<div class="table-responsive">
  <table id="tablaEvaluacionMasiva" class="table table-sm">
    <thead>
      <tr>
        <th></th>
        <th class="rotate">
          <div><span>Relación Con Superior</span></div>
        </th>
        <th class="rotate">
          <div><span>Relación Con Colegas</span></div>
        </th>
        <th class="rotate">
          <div><span>Relación Con Subordinados</span></div>
        </th>
        <th class="rotate">
          <div><span>Relación Con Asesores</span></div>
        </th>
        <th class="rotate">
          <div><span>Relación Con Grupos De Trabajo</span></div>
        </th>
        <th class="rotate">
          <div><span>Relación Con Clientes</span></div>
        </th>
        <th class="rotate">
          <div><span>Trato Con Publico En General</span></div>
        </th>
        <th class="rotate">
          <div><span>Creatividad</span></div>
        </th>
        <th class="rotate">
          <div><span>Fijación De Objetivos</span></div>
        </th>
        <th class="rotate">
          <div><span>Planeación</span></div>
        </th>
        <th class="rotate">
          <div><span>Manejo Del Cambio</span></div>
        </th>
        <th class="rotate">
          <div><span>Implementación</span></div>
        </th>
        <th class="rotate">
          <div><span>Controles</span></div>
        </th>
        <th class="rotate">
          <div><span>Evaluación</span></div>
        </th>
        <th class="rotate">
          <div><span>Productividad</span></div>
        </th>
        <th class="rotate">
          <div><span>Comunicación</span></div>
        </th>
        <th class="rotate">
          <div><span>Manejo De Conflictos</span></div>
        </th>
        <th class="rotate">
          <div><span>Manejo De Errores</span></div>
        </th>
        <th class="rotate">
          <div><span>Conducción De Juntas</span></div>
        </th>
        <th class="rotate">
          <div><span>Trabajo En Equipo</span></div>
        </th>
        <?php
        if ($evaluacion == false) {
        ?>
          <th>
            <div><i class="fas fa-info-circle"></i> INSTRUCCIÓN: Seleccionar 3 oportunidades para trabajar en un plan de desarrollo</div>
          </th>
          <th>
            <div><i class="fas fa-info-circle"></i> INSTRUCCIÓN: Seleccionar 3 fortalezas para reconocer a tu colaborador</div>
          </th>
        <?php
        }
        ?>
      </tr>
      <tr>
        <td></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con la persona a la que reporta, e influye en su líder para alcanzar las metas."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con las personas del mismo nivel de autoridad con las que interactúa para lograr resultados."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Se dirige con buen trato a aquellas personas que le reportan directamente, motiva y da coaching."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mantiene un trato cordial con las personas calificadas en puestos de apoyo sin autoridad ni poder, cuyo trabajo consiste en proveer información y asesoría."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja un trato efectivo con los comités y grupos de trabajo para la mejora de la compañía."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece planos de relación que le permiten conocer mejor las necesidades y las expectativas de sus clientes y lograr los objetivos de la empresa."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente relaciones con cualquier persona que no es empleado o cliente de la compañía."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Genera diversidad de ideas y propone iniciativas de mejora para resolver los retos."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece estándares de logro de todo aquello que la dirección desea alcanzar, es objetivo y constante."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Distribuye de manera adecuada y efectiva el tiempo para cada tarea que realiza y cuenta con un plan de seguimiento o estrategia para llevar a cabo cada actividad por prioridades."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Gestiona e impulsa efectivamente los cambios en la estructura de las tareas (métodos, procedimientos, políticas) y también influye en las relaciones para que los cambios sean aceptados."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta acciones para realizar planes y tomar decisiones efectivas."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta métodos para monitorear el estado de los fenómenos y acciones de ajustes necesarios  para mantener dentro de la normalidad las variables críticas de los procesos productivos."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mide la efectividad de su trabajo en acción y su impacto a través de revisiones periódicas e instrumentos de evaluación."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Logra los resultados requeridos por el superior mediante un uso óptimo de recursos."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo en la transmisión y recepción de información a todos lo niveles."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo para manejar el desacuerdo, hace concurrir a las partes implicadas para una solución oportuna, escucha y comprende los puntos de vista de los demás."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Soluciona y evita errores en los procedimientos y reglas de la empresa, aprende y corrige para que no vuelvan a suceder."></i></td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Guía y dirige efectivamente reuniones para discutir algo, asegura la coordinación, el enfoque y compromiso de los participantes."></i< /td>
        <td><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Colabora efectivamente con otros miembros de la organización con énfasis en el resultado grupal, aporta, contribuye y coopera."></i></td>
        <?php
        if ($evaluacion == false) {
        ?>
          <td></td>
          <td></td>
        <?php
        }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $totalColaboradores = 0;
      $totalColaboradoresEvaluados = 0;
      $sql_colaboradores = mysqli_query($conn, "SELECT no_reloj, nombres, apellidos FROM registrogdp WHERE no_reloj_supervisor = '$reloj_supervisor' ORDER BY nombres ASC");
      while ($datos = mysqli_fetch_array($sql_colaboradores)) {
        $totalColaboradores++;
        $no_reloj = $datos['no_reloj'];
        $colaborador = $datos['nombres'] . ' ' . $datos['apellidos'];
        $sql_evaluacion = mysqli_query($conn, "SELECT * FROM t_evaluacion WHERE no_reloj = '$no_reloj' AND estatusEvaluacion = '1'");
        if (mysqli_num_rows($sql_evaluacion) > 0) {
          while ($row = mysqli_fetch_array($sql_evaluacion)) {
            $totalColaboradoresEvaluados++;
            echo '<tr> <td> ' . $colaborador . '</td>';
            $id_evaluacion = $row['id_evaluacion'];
            echo '<td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia1">' . $row['competencia1'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia2">' . $row['competencia2'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia3">' . $row['competencia3'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia4">' . $row['competencia4'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia5">' . $row['competencia5'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia6">' . $row['competencia6'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia7">' . $row['competencia7'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia8">' . $row['competencia8'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia9">' . $row['competencia9'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia10">' . $row['competencia10'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia11">' . $row['competencia11'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia12">' . $row['competencia12'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia13">' . $row['competencia13'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia14">' . $row['competencia14'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia15">' . $row['competencia15'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia16">' . $row['competencia16'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia17">' . $row['competencia17'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia18">' . $row['competencia18'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia19">' . $row['competencia19'] . '</td>
                    <td class="input_evaluacion" data-id="' . $id_evaluacion . '" data-name="competencia20">' . $row['competencia20'] . '</td>
                    </tr>';
          }
          mysqli_free_result($sql_evaluacion);
      ?>
        <?php
        } else { ?>
          <tr class="evaluacionPendiente">
            <td>
              <?= $colaborador; ?>
              <input type="text" hidden value="<?= $no_reloj ?>">
              <input type="text" hidden value="<?= $reloj_supervisor ?>">
              <input type="text" hidden value="<?php echo Date('Y'); ?>">
            </td>
            <?php
            for ($x = 0; $x <= 19; $x++) {
            ?>
              <td>
                <select class="custom-select selectCalificacion" name="calificacion">
                  <?php
                  for ($i = 0; $i <= 10; $i++) {
                    if ($i == 0) {
                      echo '<option  selected value=' . $i . '>' . $i . '</option>';
                    } else {
                      echo '<option value=' . $i . '>' . $i . '</option>';
                    }
                  }
                  ?>
                </select>
                <?php
                if ($x == 19) {
                  echo '<input type="text" class="estatusEvaluacion" hidden value="">';
                }
                ?>
              </td>
            <?php
            }
            ?>
            <td>
              <select class="selectpicker show-ticks selectOportunidades" data-max-options="3" name="selectOportunidades[]" data-width=" 150px" class="custom-select" title="Oportunidades" multiple data-live-search="true">
                <option value="Relación Con Superior">Relación Con Superior</option>
                <option value="Relación Con Colegas">Relación Con Colegas</option>
                <option value="Relación Con Subordinados">Relación Con Subordinados</option>
                <option value="Relación Con Asesores">Relación Con Asesores</option>
                <option value="Relación Con Grupos De Trabajo">Relación Con Grupos De Trabajo</option>
                <option value="Relación Con Clientes">Relación Con Clientes</option>
                <option value="Trato Con Publico En General">Trato Con Publico En General</option>
                <option value="Creatividad">Creatividad</option>
                <option value="Fijación De Objetivos">Fijación De Objetivos</option>
                <option value="Planeación">Planeación</option>
                <option value="Manejo Del Cambio">Manejo Del Cambio</option>
                <option value="Implementación">Implementación</option>
                <option value="Controles">Controles</option>
                <option value="Evaluación">Evaluación</option>
                <option value="Productividad">Productividad</option>
                <option value="Comunicación">Comunicación</option>
                <option value="Manejo De Conflictos">Manejo De Conflictos</option>
                <option value="Manejo De Errores">Manejo De Errores</option>
                <option value="Conducción De Juntas">Conducción De Juntas</option>
                <option value="Trabajo En Equipo">Trabajo En Equipo</option>
              </select>
            </td>
            <td>
              <select class="selectpicker show-ticks selectFortalezas" data-max-options="3" name="selectFortalezas[]" id="" data-width=" 150px" class="custom-select" title="Fortalezas" multiple data-live-search="true">
                <option value="Relación Con Superior">Relación Con Superior</option>
                <option value="Relación Con Colegas">Relación Con Colegas</option>
                <option value="Relación Con Subordinados">Relación Con Subordinados</option>
                <option value="Relación Con Asesores">Relación Con Asesores</option>
                <option value="Relación Con Grupos De Trabajo">Relación Con Grupos De Trabajo</option>
                <option value="Relación Con Clientes">Relación Con Clientes</option>
                <option value="Trato Con Publico En General">Trato Con Publico En General</option>
                <option value="Creatividad">Creatividad</option>
                <option value="Fijación De Objetivos">Fijación De Objetivos</option>
                <option value="Planeación">Planeación</option>
                <option value="Manejo Del Cambio">Manejo Del Cambio</option>
                <option value="Implementación">Implementación</option>
                <option value="Controles">Controles</option>
                <option value="Evaluación">Evaluación</option>
                <option value="Productividad">Productividad</option>
                <option value="Comunicación">Comunicación</option>
                <option value="Manejo De Conflictos">Manejo De Conflictos</option>
                <option value="Manejo De Errores">Manejo De Errores</option>
                <option value="Conducción De Juntas">Conducción De Juntas</option>
                <option value="Trabajo En Equipo">Trabajo En Equipo</option>
              </select>
            </td>
          </tr>
      <?php
        }
      }
      mysqli_free_result($sql_colaboradores);
      ?>
    </tbody>
  </table>
</div>
<div class="col-md-12 text-right">
  <a href="#" id="btnBorradorEvaluacion"><i class="fas fa-pen-square"></i> Guardar borrador</a>
  <a href="#" id="btnGuardarEvaluacionMasiva" class="<?php if ($totalColaboradores == $totalColaboradoresEvaluados) {
                                                        echo 'disabled';
                                                      } ?>">Guardar y enviar</a>
</div>
<div class="row pt-3 pb-5 pl-2 pr-2">
  <?php
  if ($evaluacion == true) {
  ?>
    <div class="col-md-6">
      <p id="indicacionesEvaluacion"><i class="fas fa-info-circle"></i> Para actualizar su evaluacion masiva debe dar clic sobre la calificación que desea modificar</p>
    </div>

    <div class="col-md-12">
      <div class="table-responsive">
        <table id="tablaOportunidadesFortalezasEvaluacion" class="table table-sm">
          <thead>
            <tr>
              <th></th>
              <th colspan="3" class="text-center">Fortalezas</th>
              <th colspan="3" class="text-center">Oportunidades</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql_colaboradores = mysqli_query($conn, "SELECT r.no_reloj,r.nombres, r.apellidos FROM t_oportunidades o INNER JOIN registrogdp r ON o.no_reloj = r.no_reloj AND o.reloj_lider = '$reloj_supervisor' GROUP BY o.no_reloj");
            while ($row = mysqli_fetch_assoc($sql_colaboradores)) {
              $no_reloj = $row['no_reloj'];
            ?>
              <tr>
                <td><?php echo $row['nombres'] . ' ' . $row['apellidos']; ?></td>
                <?php $sql_fortalezas = mysqli_query($conn, "SELECT id_fortaleza, fortaleza FROM t_fortalezas WHERE no_reloj = '$no_reloj' AND reloj_lider != ''");
                while ($d = mysqli_fetch_assoc($sql_fortalezas)) {
                  echo '<td class="input_fortaleza" data-id="' . $d["id_fortaleza"] . '">' . $d["fortaleza"] . '</td>';
                }
                mysqli_free_result($sql_fortalezas);

                $sql_oportunidades = mysqli_query($conn, "SELECT id_oportunidad, oportunidad FROM t_oportunidades WHERE no_reloj = '$no_reloj' AND reloj_lider != ''");
                while ($d = mysqli_fetch_assoc($sql_oportunidades)) {
                  echo '<td class="input_oportunidad" data-id="' . $d["id_oportunidad"] . '">' . $d["oportunidad"] . '</td>';
                }
                mysqli_free_result($sql_oportunidades); 
                ?>
              </tr>
            <?php }
            mysqli_free_result($sql_colaboradores);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>

</div>

<script>
  $(document).ready(function() {

    $('.selectCalificacion').each(function() {
      if ($('option:selected').val() == 0) {
        $(this).css('background', '#ffe4e4');
      }
    });

    $('.selectCalificacion').on('change', function() {
      let calificacion = $(this).find('option:selected').val();
      if (calificacion != 0) {
        $(this).css('background', '#fff');
      }
    });

    $('.selectpicker').selectpicker({
      style: "btn-default btn-sm"
    });

    $('[data-toggle="tooltip"]').tooltip();


    var last_valid_selection = null;
    $('.selectOportunidades').change(function(event) {
      if ($(this).val().length > 3) {
        $(this).val(last_valid_selection);
      } else {
        last_valid_selection = $(this).val();
      }
    });

    $('#btnGuardarEvaluacionMasiva').on('click', function(e) {
      e.preventDefault();
      var no_reloj = <?= $reloj_supervisor ?>;
      var array_evaluacionMasiva = [];
      $('.estatusEvaluacion').val('1');
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_evaluacionMasiva = [];
        $(this)
          .find("input[type='text'], select[name=calificacion]")
          .each(function() {
            arrayTemp_evaluacionMasiva.push(
              $(this).val()
            );
          });
        array_evaluacionMasiva.push(arrayTemp_evaluacionMasiva);
      });

      var array_oportunidades = [];
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_oportunidad = [];
        $(this)
          .find("input[type='text'], select[name='selectOportunidades\\[\\]']")
          .each(function() {
            arrayTemp_oportunidad.push(
              $(this).val()
            );
          });
        array_oportunidades.push(arrayTemp_oportunidad);
      });

      var array_fortaleza = [];
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_fortaleza = [];
        $(this)
          .find("input[type='text'], select[name='selectFortalezas\\[\\]']")
          .each(function() {
            arrayTemp_fortaleza.push(
              $(this).val()
            );
          });
        array_fortaleza.push(arrayTemp_fortaleza);
      });

      Swal.fire({
        title: "Desea guardar y enviar evaluación de sus colaboradores?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, guardar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../ajax/evaluacion/ajax_evaluacion.php",
            type: "POST",
            dataType: "JSON",
            data: {
              array_evaluacionMasiva: array_evaluacionMasiva,
              array_oportunidades: array_oportunidades,
              array_fortaleza: array_fortaleza,
              no_reloj: no_reloj
            },
            success: function(data) {
              var no_reloj_lider = '<?php echo $reloj_supervisor ?>';
              if (data == 1) {
                Swal.fire({
                  icon: "success",
                  title: "¡Evaluación enviada correctamente!",
                });
                $('#evaluacionMasiva').load('../../loads/supervisor/evaluacion_masiva.php', {
                  'reloj_supervisor': no_reloj_lider
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Error al enviar evaluación",
                });
              }
            },
          });
        }
      });
    });

    $('#btnBorradorEvaluacion').on('click', function(e) {
      e.preventDefault();
      var array_evaluacionMasiva = [];
      $('.estatusEvaluacion').val('0');
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_evaluacionMasiva = [];
        $(this)
          .find("input[type='text'], select[name=calificacion]")
          .each(function() {
            arrayTemp_evaluacionMasiva.push(
              $(this).val()
            );
          });
        array_evaluacionMasiva.push(arrayTemp_evaluacionMasiva);
      });

      var array_oportunidades = [];
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_oportunidad = [];
        $(this)
          .find("input[type='text'], select[name='selectOportunidades\\[\\]']")
          .each(function() {
            arrayTemp_oportunidad.push(
              $(this).val()
            );
          });
        array_oportunidades.push(arrayTemp_oportunidad);
      });

      var array_fortaleza = [];
      $("#tablaEvaluacionMasiva tbody tr.evaluacionPendiente").each(function() {
        var arrayTemp_fortaleza = [];
        $(this)
          .find("input[type='text'], select[name='selectFortalezas\\[\\]']")
          .each(function() {
            arrayTemp_fortaleza.push(
              $(this).val()
            );
          });
        array_fortaleza.push(arrayTemp_fortaleza);
      });

      Swal.fire({
        title: "¿Desea guardar borrador?",
        text: 'Este guardado solo es un borrador, para enviar su evaluación correctamente debe dar click en el botón de "Guardar y enviar", mientras tanto puede seguir evaluando.',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, guardar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../ajax/evaluacion/ajax_borradorEvaluacion.php",
            type: "POST",
            data: {
              array_evaluacionMasiva: array_evaluacionMasiva,
              array_oportunidades: array_oportunidades,
              array_fortaleza: array_fortaleza,
            },
            success: function(data) {
              var no_reloj_lider = '<?php echo $reloj_supervisor ?>';
              if (data == 1) {
                Swal.fire({
                  icon: "success",
                  title: "Borrador guardado correctamente!",
                });
                $('#evaluacionMasiva').load('../../loads/supervisor/evaluacion_masiva.php', {
                  'reloj_supervisor': no_reloj_lider
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Error al enviar evaluación",
                });
              }
            },
          });
        }
      });
    });

    $(document).on("click", ".input_evaluacion", function() {
      $(".input_evaluacion").not(this).css("pointer-events", "none");
      var id_evaluacion = $(this).data("id");
      var competencia = $(this).data("name");
      var tdval,
        inputval,
        editdiv = "";
      editdiv = $(
        '<div class="editdiv"><div class="row"><div class="col"><div class="input-group"><select class="input custom-select select_calificacion_idl" id="input_evaluacionMasiva" data-name="' + competencia + '"><option value="" selected="" hidden=""></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><div class="input-group-prepend"><a href="#" class="btn-actualizarEvaluacion input-group-text"><i class="fas fa-check"></i></a></div></div></div></div></div>'
      );

      $(".input").css("pointer-events", "auto");
      $(".btn-actualizarEvaluacion").css("pointer-events", "auto");
      if (!$(this).find(".input").length) {
        tdval = $(this).text();
        $(this).html(editdiv);
        $(".input", $(this)).val($.trim(tdval));
        $(".input", $(this)).focus();
        $(document).on("click", ".btn-actualizarEvaluacion", function(e) {
          e.preventDefault();
          var calificacion = $("#input_evaluacionMasiva").val();
          var competencia = $('.input').data("name");

          $.ajax({
            url: "../../ajax/evaluacion/ajax_Actualizarevaluacion.php",
            type: "POST",
            data: {
              id_evaluacion: id_evaluacion,
              competencia: competencia,
              calificacion: calificacion,
            },
            success: function(data) {
              data = data.trim();
              if (data == 1) {
                isLoading = false;
                Swal.fire({
                  icon: 'success',
                  title: 'Actualizado con éxito',
                  timer: 800
                });
                $(".input_evaluacion").css("pointer-events", "auto");

                inputval = $(
                  ".input",
                  $(".btn-actualizarEvaluacion").closest(".editdiv")
                ).val();
                $(".btn-actualizarEvaluacion")
                  .closest(".editdiv")
                  .parent("td")
                  .html(inputval);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error al actualizar'
                });
              }
            },
          });

        });
        $(document).on("click", ".btn-cancel-objetivo", function(event) {
          event.preventDefault();
          $(".input_evaluacion").css("pointer-events", "auto");
          inputval = $(".input", $(this).closest(".editdiv")).val();
          $(this).closest(".editdiv").parent("td").html(inputval);
        });
      }
    });

    $(document).on("click", ".input_fortaleza", function() {
      $(".input_fortaleza").not(this).css("pointer-events", "none");
      var id_fortaleza = $(this).data("id");
      var tdval,
        inputval,
        editdiv = "";
      editdiv = $(
        '<div class="editdiv"><div class="row"><div class="col"><div class="input-group"><select class="input custom-select" id="input_fortaleza" data-id="' + id_fortaleza + '"d> <option value="Relación Con Superior">Relación Con Superior</option><option value="Relación Con Colegas">Relación Con Colegas</option><option value="Relación Con Subordinados">Relación Con Subordinados</option><option value="Relación Con Asesores">Relación Con Asesores</option><option value="Relación Con Grupos De Trabajo">Relación Con Grupos De Trabajo</option><option value="Relación Con Clientes">Relación Con Clientes</option><option value="Trato Con Publico En General">Trato Con Publico En General</option><option value="Creatividad">Creatividad</option><option value="Fijación De Objetivos">Fijación De Objetivos</option><option value="Planeación">Planeación</option><option value="Manejo Del Cambio">Manejo Del Cambio</option><option value="Implementación">Implementación</option><option value="Controles">Controles</option><option value="Evaluación">Evaluación</option><option value="Productividad">Productividad</option><option value="Comunicación">Comunicación</option><option value="Manejo De Conflictos">Manejo De Conflictos</option><option value="Manejo De Errores">Manejo De Errores</option><option value="Conducción De Juntas">Conducción De Juntas</option><option value="Trabajo En Equipo">Trabajo En Equipo</option></select><div class="input-group-prepend"><a href="#" class="btn-actualizarFortaleza input-group-text"><i class="fas fa-check"></i></a></div></div></div></div></div>'
      );

      $(".input").css("pointer-events", "auto");
      $(".btn-actualizarFortaleza").css("pointer-events", "auto");
      if (!$(this).find(".input").length) {
        tdval = $(this).text();
        $(this).html(editdiv);
        $(".input", $(this)).val($.trim(tdval));
        $(".input", $(this)).focus();
        $(document).on("click", ".btn-actualizarFortaleza", function(e) {
          e.preventDefault();
          var fortaleza = $("#input_fortaleza").val();
          var id_fortaleza = $("#input_fortaleza").data('id');
          $.ajax({
            url: "../../ajax/evaluacion/ajax_actualizarFortaleza.php",
            type: "POST",
            data: {
              id_fortaleza: id_fortaleza,
              fortaleza: fortaleza,
            },
            success: function(data) {
              data = data.trim();
              if (data == 1) {
                isLoading = false;
                Swal.fire({
                  icon: 'success',
                  title: 'Actualizado con éxito',
                  timer: 800
                });
                $(".input_fortaleza").css("pointer-events", "auto");
                inputval = $(
                  ".input",
                  $(".btn-actualizarFortaleza").closest(".editdiv")
                ).val();
                $(".btn-actualizarFortaleza")
                  .closest(".editdiv")
                  .parent("td")
                  .html(inputval);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error al actualizar'
                });
              }
            },
          });

        });
        $(document).on("click", ".btn-cancel-objetivo", function(event) {
          event.preventDefault();
          $(".input_fortaleza").css("pointer-events", "auto");
          inputval = $(".input", $(this).closest(".editdiv")).val();
          $(this).closest(".editdiv").parent("td").html(inputval);
        });
      }
    });

    $(document).on("click", ".input_oportunidad", function() {
      $(".input_oportunidad").not(this).css("pointer-events", "none");
      var id_oportunidad = $(this).data("id");
      var tdval,
        inputval,
        editdiv = "";
      editdiv = $(
        '<div class="editdiv"><div class="row"><div class="col"><div class="input-group"><select class="input custom-select" id="input_oportunidad" data-id="' + id_oportunidad + '"d> <option value="Relación Con Superior">Relación Con Superior</option><option value="Relación Con Colegas">Relación Con Colegas</option><option value="Relación Con Subordinados">Relación Con Subordinados</option><option value="Relación Con Asesores">Relación Con Asesores</option><option value="Relación Con Grupos De Trabajo">Relación Con Grupos De Trabajo</option><option value="Relación Con Clientes">Relación Con Clientes</option><option value="Trato Con Publico En General">Trato Con Publico En General</option><option value="Creatividad">Creatividad</option><option value="Fijación De Objetivos">Fijación De Objetivos</option><option value="Planeación">Planeación</option><option value="Manejo Del Cambio">Manejo Del Cambio</option><option value="Implementación">Implementación</option><option value="Controles">Controles</option><option value="Evaluación">Evaluación</option><option value="Productividad">Productividad</option><option value="Comunicación">Comunicación</option><option value="Manejo De Conflictos">Manejo De Conflictos</option><option value="Manejo De Errores">Manejo De Errores</option><option value="Conducción De Juntas">Conducción De Juntas</option><option value="Trabajo En Equipo">Trabajo En Equipo</option></select><div class="input-group-prepend"><a href="#" class="btn-actualizarOportunidad input-group-text"><i class="fas fa-check"></i></a></div></div></div></div></div>'
      );

      $(".input").css("pointer-events", "auto");
      $(".btn-actualizarOportunidad").css("pointer-events", "auto");
      if (!$(this).find(".input").length) {
        tdval = $(this).text();
        $(this).html(editdiv);
        $(".input", $(this)).val($.trim(tdval));
        $(".input", $(this)).focus();
        $(document).on("click", ".btn-actualizarOportunidad", function(e) {
          e.preventDefault();
          var oportunidad = $("#input_oportunidad").val();
          var id_oportunidad = $("#input_oportunidad").data('id');
          $.ajax({
            url: "../../ajax/evaluacion/ajax_actualizarOportunidad.php",
            type: "POST",
            data: {
              id_oportunidad: id_oportunidad,
              oportunidad: oportunidad,
            },
            success: function(data) {
              data = data.trim();
              if (data == 1) {
                isLoading = false;
                Swal.fire({
                  icon: 'success',
                  title: 'Actualizado con éxito',
                  timer: 800
                });
                $(".input_oportunidad").css("pointer-events", "auto");
                inputval = $(
                  ".input",
                  $(".btn-actualizarOportunidad").closest(".editdiv")
                ).val();
                $(".btn-actualizarOportunidad")
                  .closest(".editdiv")
                  .parent("td")
                  .html(inputval);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error al actualizar'
                });
              }
            },
          });

        });
        $(document).on("click", ".btn-cancel-objetivo", function(event) {
          event.preventDefault();
          $(".input_oportunidad").css("pointer-events", "auto");
          inputval = $(".input", $(this).closest(".editdiv")).val();
          $(this).closest(".editdiv").parent("td").html(inputval);
        });
      }
    });

  });
</script>