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
  var actions = $(".tabla_gptw td:last-child").html();

  $(document).on("click", ".input_gptw", function () {
    $(".input_gptw").not(this).css("pointer-events", "none");
    var id_reddin = $(this).data("id");
    var num_td = $(this).data("num");
    console.log(num_td);
    var tdval,
      inputval,
      editdiv = "";
    if (num_td == 1) {
      editdiv = $(
        '<div class="editdiv"><select id="input_oportunidad" class="input custom-select"><option value="Respeto">Respeto</option><option value="Confianza">Confianza</option><option value="Credibilidad">Credibilidad</option><option value="Cuidando">Cuidando</option><option value="Escuchando">Escuchando</option><option value="Comunicando">Comunicando</option><option value="Agradeciendo">Agradeciendo</option><option value="Imparcialidad">Imparcialidad</option><option value="Integración del equipo">Integración del equipo</option></select><button type="submit" class="btn btn-sm btn-success btn-update-gptw"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 2) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_notas" class="input form-control form-control-sm" style="height: 50px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-gptw"><i class="fas fa-check"></i></button></div>'
      );
    }

    $(".input").css("pointer-events", "auto");
    $(".btn-update-gptw").css("pointer-events", "auto");
    if (!$(this).find(".input").length) {
      tdval = $(this).text();
      $(this).html(editdiv);
      $(".input", $(this)).val($.trim(tdval));
      $(".input", $(this)).focus();
      $(document).on("click", ".btn-update-gptw", function (event) {
        var oportunidad = $("#input_oportunidad option:selected").val();
        alert(oportunidad);
        var nota = $("#input_notas").val();
        alert(nota);
        // $.ajax({
        //   url: "../ajax/reddin/ajax_update.php",
        //   type: "POST",
        //   data: {
        //     string: id_reddin,
        //     oportunidad: oportunidad,
        //     nota: nota,
        //   },
        //   success: function (data) {
        //     data = data.trim();
        //     if (data == 1) {
        //       Swal.fire({
        //         icon: "success",
        //         text: "Actualizado con éxito!",
        //         timer: 800,
        //       });
        //       $(".input_gptw").css("pointer-events", "auto");
        //       inputval = $(
        //         ".input",
        //         $(".btn-update-gptw").closest(".editdiv")
        //       ).val();
        //       $(".btn-update-gptw")
        //         .closest(".editdiv")
        //         .parent("td")
        //         .html(inputval);
        //     } else {
        //       swal("Error al actualizar!", {
        //         icon: "error",
        //       });
        //     }
        //   },
        // });
      });
    }
  });

  // $(document).on("click", ".guardar_gptw", function () {
  //   var empty = false;
  //   var input = $(this).parents("tr").find("textarea, select");
  //   input.each(function () {
  //     if (!$(this).val()) {
  //       $(this).addClass("error");
  //       empty = true;
  //     } else {
  //       $(this).removeClass("error");
  //     }
  //   });
  //   var txtoportunidad = $("#txtoportunidad").val();
  //   var txtnotas = $("#txtnotas").val();
  //   var txtfechacompromiso = $("#txtfechacompromiso").val();
  //   var indicador = $("#indicador").val();
  //   var txtreloj = $("#txtreloj").val();
  //   var txtfecha = $("#fecha_regA").val();
  //   var tipo_plan = $("#tipo_plan").val();
  //   var txtmes = $("#mes_regA").val();
  //   var txtano = $("#year_regA").val();

  //   $.ajax({
  //     url: "../ajax/reddin/ajax_add.php",
  //     processing: true,
  //     serverSide: true,
  //     method: "POST",
  //     data: {
  //       txtoportunidad: txtoportunidad,
  //       txtnotas: txtnotas,
  //       txtfechacompromiso: txtfechacompromiso,
  //       indicadores: indicador,
  //       txtreloj: txtreloj,
  //       txtfecha: txtfecha,
  //       tipo_plan: tipo_plan,
  //       txtmes: txtmes,
  //       txtano: txtano,
  //     },
  //     success: function (data) {
  //       // location.reload();
  //       /*$("#displaymessage").html(data);
  //                  $('.delete').show();
  //                  $(".btnCancel").attr("hidden", "hidden");*/
  //     },
  //   });
  //   $(this).parents("tr").find(".error").first().focus();
  //   if (!empty) {
  //     input.each(function () {
  //       $(this).parent("td").html($(this).val());
  //     });
  //     $(this).parents("tr").find(".addReddin, .editReddin").toggle();
  //     $(".add-new").removeAttr("disabled");
  //   }
  // });

  $(document).on("click", ".eliminar_gptw", function () {
    $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
    var id = $(this).attr("id");
    var string = id;
    $.ajax({
      url: "../ajax/reddin/ajax_delete.php",
      type: "POST",
      data: {
        string: string,
      },
      success: function (data) {
        location.reload();
      },
    });
  });

  $("#modalVerAccionesReddin").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("whatever");
    var modal = $(this);
    $.ajax({
      type: "POST",
      url: "../actions/verAccionesReddin.php",
      data: {
        id_reddin: id,
      },
      cache: false,
      success: function (data) {
        modal.find(".modalAcciones").html(data);
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  $("#modalHistoricoPlanesReddin").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var no_reloj = button.data("whatever");
    var modal = $(this);
    var load = $(".divPlanesCumplidosReddin").load(
      "../loads/planes/planesCumplidos.php",
      { no_reloj: no_reloj }
    );
    modal.find(".modal-body-histoticoPlanes").html(load);
    modal.modal("show");
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
            timer: 800,
          });
        } else if (data == 1) {
          location.reload();
          Swal.fire({
            icon: "success",
            text: "Acción agregada con éxito",
            timer: 800,
          });
        } else if (data == 2) {
          Swal.fire({
            icon: "warning",
            text: "No se ha podido cargar la evidencia",
            timer: 800,
          });
        } else if (data == 3) {
          Swal.fire({
            icon: "warning",
            text: "Revise su archivo, no tiene la extensión correcta",
            timer: 800,
          });
        }
      },
    });
  });

  $(document).on("click", "#agregar_gptw", function (e) {
    e.preventDefault();
    $("#form_agregar_gptw").removeAttr("hidden");
    $(this).addClass("disabled text-muted");
    $("#input_oportunidades_gptw").removeAttr("disabled");
    $("#input_notas").removeAttr("disabled");
    $(".cancelar_btn_gptw").removeAttr("hidden");
  });

  $(document).on("change", "#input_archivo_evidencia_gptw", function (e) {
    var fileName = e.target.files[0].name;
    $("#label_evidencia_gptw").text(fileName);
  });

  $(document).on("click", ".guardar_gptw", function (e) {
    e.preventDefault();
    var input_oportunidades = $(
      "#input_oportunidades_gptw option:selected"
    ).val();
    var input_notas = $("#input_notas").val();

    var no_reloj = $("#no_reloj").val();
    var fechaCompromiso = $("#fechacompromiso").val();
    var indicador = $("#indicador").val();
    var fecha_reg = $("#fecha_reg").val();
    var tipo_plan = $("#tipo_plan").val();
    var mes = $("#mes_reg").val();
    var anio = $("#year_reg").val();

    var formData = new FormData();
    formData.append("oportunidad", input_oportunidades);
    formData.append("notas", input_notas);
    formData.append("no_reloj", no_reloj);
    formData.append("fechaCompromiso", fechaCompromiso);
    formData.append("indicador", indicador);
    formData.append("fecha_reg", fecha_reg);
    formData.append("tipo_plan", tipo_plan);
    formData.append("mes", mes);
    formData.append("anio", anio);

    $.ajax({
      url: "../ajax/reddin/ajax_add.php",
      cache: false,
      processData: false,
      contentType: false,
      type: "POST",
      data: formData,
      success: function (data) {
        location.reload();
      },
    });
  });

  $(document).on("click", ".cancelar_btn_gptw", function (e) {
    e.preventDefault();
    $(this).attr("hidden", true);
    $("#form_agregar_gptw").attr("hidden", true);
    $("#agregar_gptw").removeClass("disabled text-muted");
    $("#input_oportunidades_gptw").attr("disabled", true);
    $("#input_notas").attr("disabled", true);
    $(".guardar_gptw").attr("disabled", true);
  });

  $(document).on("change", ".checkboxPlanCumplido", function () {
    var numberOfChecked = $(".checkboxPlanCumplido:checked").length;
    $(".btnCerrarPlan")
      .attr("hidden", false)
      .html("Cerrar Plan (" + numberOfChecked + ")");
    if (numberOfChecked == 0) {
      $(".btnCerrarPlan").attr("hidden", true).html("Cerrar Plan");
    }
  });

  $(document).on("click", ".btnCerrarPlan", function (e) {
    e.preventDefault();
    var arrayPlanesCumplidos = [];
    $("input:checkbox[name*=checkboxCumplidos]:checked").each(function () {
      arrayPlanesCumplidos.push($(this).val());
    });

    $.ajax({
      url: "../../ajax/reddin/ajax_planesCumplidos.php",
      method: "POST",
      data: { checkboxCumplidos: arrayPlanesCumplidos },
      success: function (data) {
        var data = data.trim();
        if (data == 1) {
          var no_reloj = window.noReloj;
          Swal.fire({
            icon: "success",
            text: "Plan(es) cerrado(s) con éxito!",
          });
          setTimeout(
            $(".divGPTW").load("../loads/gptw/tabla_gptw.php", {
              no_reloj: no_reloj,
            }),
            3000
          );
        } else {
        }
      },
    });
  });

  $(document).on("click", ".input_acciones_gptw", function () {
    $(".input_acciones_gptw").not(this).css("pointer-events", "none");
    $(".btnCargarEvidencia").addClass("disabled");
    var id_reddin = $(this).data("id");
    var num_td = $(this).data("num");

    var tdval,
      inputval,
      editdiv = "";
    if (num_td == 1) {
      editdiv = $(
        '<div class="editdiv"><input type="text" id="input_fecha" class="input form-control form-control-sm" data-id="' +
          id_reddin +
          '"><button type="submit" class="btn btn-sm btn-success btn-update-reddin"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 2) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_accion" class="input form-control form-control-sm" data-id="' +
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
        var input_fecha = $("#input_fecha").val();
        var input_accion = $("#input_accion").val();
        $.ajax({
          url: "../ajax/planeacion/ajax_actualizarPlanReddin.php",
          type: "POST",
          data: {
            id_reddin: id,
            input_fecha: input_fecha,
            input_accion: input_accion,
          },
          success: function (data) {
            data = data.trim();
            if (data == 1) {
              swal.fire({
                icon: "success",
                text: "Actualizado con éxito",
                timer: 800,
              });
              $(".input_acciones_gptw").css("pointer-events", "auto");
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
});
