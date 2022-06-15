$(document).ready(function () {
  var meses = new Array(
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  );
  var f = new Date();
  var año = f.getFullYear();
  var mes = meses[f.getMonth()];
  var dia = f.getDate();
  var fecha =
    f.getDate() + " de " + meses[f.getMonth()] + " del " + f.getFullYear();

  $('[data-toggle="tooltip"]').tooltip();
  var actions = $(".tablaPlaneacion td:nth-last-child(2)").html();
 
  $(".add-newPlaneacion").click(function () {
    $(this).attr("disabled", "disabled");
    $(".btnCancel").removeAttr("hidden");
    var index = $(".tablaPlaneacion tbody tr:last-child").index();
    $(".tablaPlaneacion thead tr th:nth-child(3)").html(
      'Notas para el dialogo<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Notas para el dialogo con nuestro colaborador a la hora de revisar sus planes de desarrollo/oportunidades de crecimiento"></i>'
    );

    var row =
      '<tr id="inputs">' +
      "<td></td>" +
      '<td><select class="custom-select" name="oportunidad" id="txtoportunidad"><option value="Relación Con Superior">Relación Con Superior</option><option value="Relación Con Colegas">Relación Con Colegas</option><option value="Relación Con Subordinados">Relación Con Subordinados</option><option value="Relación Con Asesores">Relación Con Asesores</option><option value="Relación con Grupos de Trabajo">Relación con Grupos de Trabajo</option><option value="Relación Con Clientes">Relación Con Clientes</option><option value="Trato Con Público En General">Trato Con Público En General</option><option value="Creatividad">Creatividad</option><option value="Fijación De Objetivos">Fijación De Objetivos</option><option value="Planeación">Planeación</option><option value="Manejo Del Cambio">Manejo Del Cambio</option><option value="Implementación">Implementación</option><option value="Controles">Controles</option><option value="Evaluación">Evaluación</option><option value="Productividad">Productividad</option><option value="Comunicación">Comunicación</option><option value="Manejo De Conflictos">Manejo De Conflictos</option><option value="Manejo De Errores">Manejo De Errores</option><option value="Conducción De Juntas">Conducción De Juntas</option><option value="Trabajo En Equipo">Trabajo En Equipo</option><option value="Ingles">Ingles</option></select></td>' +
      '<td><input type="text" class="form-control" name="notas" id="txtnotas"></td>' +
      '<td><input type="text" class="form-control form-control-sm" name="fechacompromiso" id="txtfechacompromiso" readonly value="Revisión mensual"></td>' +
      '<td><input  class="form-control form-control-sm" type="text" id="indicador" value="Reddin" readonly><input type="text" class="form-control" name="reloj" id="txtreloj" value="' +
      noReloj +
      '" hidden><input type="text" class="form-control" name="tipo_plan" id="tipo_plan" hidden value="Reddin"><input type="text" class="form-control" name="fecha_regA" id="fecha_regA" value="' +
      fecha +
      '" hidden><input type="text" name="mes_regA" id="mes_regA" hidden value="' +
      mes +
      '"><input type="text" name="year_regA" id="year_regA" hidden value="' +
      año +
      '"></td>' +
      "<td></td>" +
      '<td><a class="agregar" title="Agregar" data-toggle="tooltip"><i class="fas fa-plus"></i></a></td>' +
      "<td></td>" +
      "</tr>";
    $(".tablaPlaneacion").append(row);
    $(".tablaPlaneacion tbody tr")
      .eq(index + 1)
      .find(".agregar, .borrar")
      .toggle();
    $('[data-toggle="tooltip"]').tooltip();
    $("html, body").animate(
      {
        scrollTop: $("#inputs").offset().top,
      },
      500
    );
  });

  $(document).on("click", ".agregar", function () {
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"], select');
    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });

    var oportunidad = $("#txtoportunidad option:selected").val();
    var notas = $("#txtnotas").val();
    var fechaCompromiso = $("#txtfechacompromiso").val();
    var indicador = $("#indicador").val();
    var no_reloj = $("#txtreloj").val();
    var fecha_reg = $("#fecha_regA").val();
    var tipo_plan = $("#tipo_plan").val();
    var mes = $("#mes_regA").val();
    var anio = $("#year_regA").val();

    $.ajax({
      url: "../ajax/reddin/ajax_add.php",
      processing: true,
      serverSide: true,
      method: "POST",
      data: {
        oportunidad: oportunidad,
        notas: notas,
        fechaCompromiso: fechaCompromiso,
        indicador: indicador,
        no_reloj: no_reloj,
        fecha_reg: fecha_reg,
        tipo_plan: tipo_plan,
        mes: mes,
        anio: anio,
      },
      success: function (data) {
        // location.reload();
        $("#divTablaReddin").load("../loads/planes/planActual.php", {
          no_reloj: no_reloj,
          rol: "admin",
        });
      },
    });
    $(this).parents("tr").find(".error").first().focus();
    if (!empty) {
      input.each(function () {
        $(this).parent("td").html($(this).val());
      });
      $(this).parents("tr").find(".agregar, .borrar").toggle();
      $(".add-new").removeAttr("disabled");
    }
  });

  $(document).on("click", ".btnCancel", function () {
    $(this).attr("hidden", true);
    $(".add-newPlaneacion").removeAttr("disabled");
    $(".tablaPlaneacion tbody tr:last-child").remove();
  });

  $(document).on("click", ".delete", function () {
    $(this).parents("tr").remove();
    $(".add-newPlaneacion").removeAttr("disabled");
    var id = $(this).attr("id");
    var string = id;
    $.post(
      "../ajax/planeacion/ajax_eliminarPlan.php",
      {
        string: string,
      },
      function (data) {
        location.reload();
      }
    );
  });

  $(document).on("click", ".borrar", function () {
    $(this).parents("tr").remove();
    $(".add-newPlaneacion").removeAttr("disabled");
    var id = $(this).attr("id");
    var string = id;
    $.post(
      "../ajax/planeacion/ajax_eliminarPlanReddin.php",
      {
        string: string,
      },
      function (data) {
        location.reload();
      }
    );
  });

  $("#modalHistoricoPlanesReddin").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var no_reloj = button.data("whatever");
    var modal = $(this);
    var load = $(".divPlanesCumplidosReddin").load(
      "../loads/planes/planesCumplidos.php",
      {
        no_reloj: no_reloj,
      }
    );
    modal.find(".modal-body-histoticoPlanes").html(load);
    modal.modal("show");
  });

  $(document).on("click", ".input_plan", function () {
    $(".input_plan").not(this).css("pointer-events", "none");
    $(".btnCargarEvidencia").addClass("disabled");
    var id_reddin = $(this).data("id");
    var num_td = $(this).data("num");

    var tdval,
      inputval,
      editdiv = "";
    if (num_td == 2) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_accion" class="input form-control form-control-sm" data-id="' +
          id_reddin +
          '" style="height: 70px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-reddin"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 3) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_fechaCompromiso" class="input form-control form-control-sm" data-id="' +
          id_reddin +
          '" style="height: 70px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-reddin"><i class="fas fa-check"></i></button></div>'
      );
    }
    $(".input").css("pointer-events", "auto");
    $(".btn-update-reddin").css("pointer-events", "auto");
    $(".btn-cancel-reddin").css("pointer-events", "auto");
    if (!$(this).find(".input").length) {
      tdval = $(this).text();
      $(this).html(editdiv);
      $(".input", $(this)).val($.trim(tdval));
      $(".input", $(this)).focus();
      $(document).on("click", ".btn-update-reddin", function (event) {
        var id = $(".input").data("id");
        var input_accion = $("#input_accion").val();
        var input_fechaCompromiso = $("#input_fechaCompromiso").val();
        $.ajax({
          url: "../ajax/planeacion/ajax_actualizarPlanReddin.php",
          type: "POST",
          data: {
            id_reddin: id,
            input_accion: input_accion,
            input_fechaCompromiso: input_fechaCompromiso,
          },
          success: function (data) {
            data = data.trim();
            if (data == 1) {
              var no_reloj = window.noReloj;
              $("#divPlanActual").load("../loads/planes/planActual.php", {
                no_reloj: no_reloj,
                rol: "usuario",
              });
              swal.fire({
                icon: "success",
                text: "Actualizado con éxito",
                timer: 800,
              });
              $(".input_plan").css("pointer-events", "auto");
              inputval = $(
                ".input",
                $(".btn-update-reddin").closest(".editdiv")
              ).val();
              $(".btn-update-reddin")
                .closest(".editdiv")
                .parent("td")
                .html(inputval);
            } else {
              swal.fire({
                icon: "error",
                text: "Error al actualizar",
                timer: 800,
              });
            }
          },
        });
      });
    }
  });

  $(document).on("click", ".btnCargarEvidencia", function (e) {
    e.preventDefault();
    $("#evidenciaAccionInput").click();
  });

  $(document).on("change", "#evidenciaAccionInput", function (e) {
    var fileName = e.target.files[0].name;
    $("#labelEvidenciaFile").text(fileName);
    $("#btnGuardarEvidenciaPlan").removeAttr("hidden");
  });

  $(document).on("click", "#btnGuardarEvidenciaPlan", function () {
    var id_reddin = $(this).data("id");
    var files = $("#evidenciaAccionInput")[0].files;
    var formDataFile = new FormData();
    formDataFile.append("id_reddin", id_reddin);
    formDataFile.append("evidenciaAccionInput", files[0]);

    $.ajax({
      url: "../ajax/planeacion/ajax_agregarEvidenciaAccion.php",
      type: "POST",
      data: formDataFile,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        var no_reloj = window.noReloj;
        var data = data.trim();
        if (data == 0) {
          Swal.fire({
            icon: "error",
            text: "Ocurrió un error al agregar acción",
            timer: 1000,
          });
        } else if (data == 1) {
          $("#divPlanActual").load("../loads/planes/planActual.php", {
            no_reloj: no_reloj,
            rol: "usuario",
          });
          Swal.fire({
            icon: "success",
            text: "Acción agregada con éxito",
            timer: 1000,
          });
        } else if (data == 2) {
          Swal.fire({
            icon: "warning",
            text: "No se ha podido cargar la evidencia",
            timer: 1000,
          });
        } else if (data == 3) {
          Swal.fire({
            icon: "warning",
            text: "Revise su archivo, no tiene la extensión correcta",
            timer: 1000,
          });
        }
      },
    });
  });

  $(".checkboxPlanCumplido").on("change", function () {
    var numberOfChecked = $(".checkboxPlanCumplido:checked").length;
    $(".btnCerrarPlan")
      .attr("hidden", false)
      .html("Cerrar Plan (" + numberOfChecked + ")");
    if (numberOfChecked == 0) {
      $(".btnCerrarPlan").attr("hidden", true).html("Cerrar Plan");
    }
  });

  $(".btnCerrarPlan").on("click", function (e) {
    e.preventDefault();
    var arrayPlanesCumplidos = [];
    $("input:checkbox[name*=checkboxCumplidos]:checked").each(function () {
      arrayPlanesCumplidos.push($(this).val());
    });
    $.ajax({
      url: "../ajax/reddin/ajax_planesCumplidos.php",
      method: "POST",
      data: { checkboxCumplidos: arrayPlanesCumplidos },
      success: function (data) {
        var data = data.trim();
        if (data == 1) {
          Swal.fire({
            icon: "success",
            text: "Plan(es) cerrado(s) con éxito!",
          });
          var no_reloj = window.no_reloj;
          $("#divPlanActual").load("../loads/planes/planActual.php", {
            no_reloj: no_reloj,
            rol: "admin",
          });
          $("#divTablaReddin").load("../loads/planes/planActual.php", {
            no_reloj: no_reloj,
            rol: "admin",
          });
        } else {
        }
      },
    });
  });

  $(document).on("click", "#btnAgregarAccion", function(event) {
    event.preventDefault();
    var id_accion = $('#id_accion').val();
    var estatus_accion = $('#estatus_accion').val();
    var reloj_accion = $('#reloj_accion').val();
    var fecha_accion = $('#fecha_accion').val();
    var mes_reg_accion = $('#mes_reg_accion').val();
    var year_reg_accion = $('#year_reg_accion').val();
    var textarea_accion = $('#textarea_accion').val();
    var evidencia_accion = $('#evidencia_accion')[0].files;

    var formData = new FormData();

    formData.append('id', id_accion);
    formData.append('estatus', estatus_accion);
    formData.append('reloj', reloj_accion);
    formData.append('fecha', fecha_accion);
    formData.append('mes_reg', mes_reg_accion);
    formData.append('year_reg', year_reg_accion);
    formData.append('accion', textarea_accion);
    formData.append('file', evidencia_accion[0]);

    $.ajax({
      url: '../ajax/reddin/ajax_agregarAccion.php',
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data) {
        var data = data.trim();
        if (data == 0) {
          Swal.fire({
            icon: 'error',
            text: 'Ocurrió un error al agregar acción',
            timer: 800
          });
        } else if (data == 1) {
          $('#tablaAccionesReddin').load('../../loads/planes/tabla_acciones_reddin.php', {
            id: id_accion
          });
          Swal.fire({
            icon: 'success',
            text: 'Acción agregada con éxito',
            timer: 800
          });
        } else if (data == 2) {
          Swal.fire({
            icon: 'warning',
            text: 'No se ha podido cargar la evidencia',
            timer: 800
          });
        } else if (data == 3) {
          Swal.fire({
            icon: 'warning',
            text: 'Revise su archivo, no tiene la extensión correcta',
            timer: 800
          });
        }
      }
    });
  });
});
