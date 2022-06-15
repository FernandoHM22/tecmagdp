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

  $(".collapse.show").each(function () {
    $(this)
      .prev(".card-header")
      .find(".fa")
      .addClass("fa-minus")
      .removeClass("fa-plus");
  });

  $(".collapse")
    .on("show.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".fa")
        .removeClass("fa-plus")
        .addClass("fa-minus");
    })
    .on("hide.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".fa")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    });

  $("#editarFicha").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data("whatever");
    var recipiente = button.data("target");
    var modal = $(this);

    $.ajax({
      type: "GET",
      url: "../actions/editarInfo.php",
      data: { no_reloj: recipient, dataModal: recipiente },
      cache: false,
      success: function (data) {
        console.log(data);
        modal.find(".dash").html(data);
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  $(document).on("change", ".selectMatriz", function () {
    $(".btnGenerarMatriz").removeClass("disabled");
  });

  $(document).on("click", ".btnGenerarMatriz", function (e) {
    e.preventDefault();
    var potencial = $("#potencial option:selected").val();
    var desempeno = $("#desempeno option:selected").val();
    var no_reloj = $(this).data("id");
    $.ajax({
      url: "../ajax/reddin/ajax_agregarMatriz.php",
      method: "POST",
      data: {
        potencial: potencial,
        desempeno: desempeno,
        no_reloj: no_reloj,
      },
      success: function (data) {
        var reloj = window.noReloj;
        var data = data.trim();
        if (data == 1) {
          Swal.fire({
            icon: "success",
            text: "Agregado con éxito!",
            timer: 800,
            timerProgressBar: true,
          });
          $("#divMatrizPotencialDesempeno").load(
            "../loads/reddin/tablaMatriz.php",
            {
              no_reloj: reloj,
            }
          );
        } else if (data == 2) {
          Swal.fire({
            icon: "success",
            text: "Actualizado con éxito!",
            timer: 800,
            timerProgressBar: true,
          });
          $("#divMatrizPotencialDesempeno").load(
            "../loads/reddin/tablaMatriz.php",
            {
              no_reloj: reloj,
            }
          );
        } else if (data == 0) {
          Swal.fire({
            icon: "error",
            text: "Error!",
            timer: 800,
            timerProgressBar: true,
          });
        }
      },
    });
  });

  $(document).on("click", ".btnVerMatrizColaboradores", function (e) {
    e.preventDefault();
    var no_reloj_sup = window.noRelojL;
    var no_reloj = $(this).data("id");
    $("#divMatrizPotencialDesempeno").load(
      "../loads/reddin/tablaMatrizGeneral.php",
      {
        no_reloj: no_reloj,
        no_reloj_sup: no_reloj_sup,
      }
    );
  });

  $("#buscarLider").attr("disabled", "disabled");

  $("#selectLider").change(function () {
    if ($(this).hasClass("require_one")) {
      $("#buscarLider").removeAttr("disabled");
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////COMENTARIOS ESPECIALES/////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////
  var actiones = $(".tablaComentariosEspeciales td:last-child").html();
  $(".add-comentarioEsp").click(function () {
    $(this).attr("disabled", "disabled");
    var index = $(".tablaComentariosEspeciales tbody tr:last-child").index();
    var row =
      "<tr>" +
      '<td><textarea class="form-control" name="txtcomentario" id="txtcomentario"></textarea><input type="text" class="form-control" name="reloj" id="txtreloj" value="' +
      noReloj +
      '" hidden><input type="text" class="form-control" name="relojL" id="txtrelojL" value="' +
      noRelojL +
      '" hidden></td>' +
      "<td>" +
      actiones +
      "</td>" +
      "</tr>";
    $(".tablaComentariosEspeciales").append(row);
    $(".tablaComentariosEspeciales tbody tr")
      .eq(index + 1)
      .find(".agregarComentarioEspecial, .editarComentarioEspecial")
      .toggle();
    $('[data-toggle="tooltip"]').tooltip();
    $(".borrarComentarioEspecial").hide();
  });

  $(document).on("click", ".agregarComentarioEspecial", function () {
    var empty = false;
    var input = $(this).parents("tr").find("textarea");
    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });
    var txtcomentario = $("#txtcomentario").val();
    var txtreloj = $("#txtreloj").val();
    var txtrelojL = $("#txtrelojL").val();
    $.ajax({
      url: "../ajax/reddin/ajax_agregarComentario.php",
      processing: true,
      serverSide: true,
      method: "POST",
      data: {
        txtcomentario: txtcomentario,
        txtreloj: txtreloj,
        txtrelojL: txtrelojL,
      },
      success: function (data) {
        $("#exitoregistro").html(data);
        $(".delete").show();
      },
    });
    $(this).parents("tr").find(".error").first().focus();
    if (!empty) {
      input.each(function () {
        $(this).parent("td").html($(this).val());
      });
      $(this)
        .parents("tr")
        .find(".agregarComentarioEspecial, .editarComentarioEspecial")
        .toggle();
      $(".add-comentarioEsp").removeAttr("disabled");
    }
  });

  $(document).on("click", ".borrarComentarioEspecial", function () {
    $(this).parents("tr").remove();
    $(".add-comentarioEsp").removeAttr("disabled");
    var id = $(this).attr("id");
    var string = id;
    $.post(
      "../ajax/reddin/ajax_borrarComentarios.php",
      {
        string: string,
      },
      function (data) {
        $("#exitoregistro").html(data);
      }
    );
  });

  $(document).on("click", ".editarComentarioEspecial", function () {
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function (i) {
        if (i == "0") {
          var idname = "txtcomentario";
        }
        $(this).html(
          '<textarea class="form-control" name="txtcomentario" id="' +
            idname +
            '" >' +
            $(this).text() +
            "</textarea>"
        );
      });
    $(this)
      .parents("tr")
      .find(".agregarComentarioEspecial, .editarComentarioEspecial")
      .toggle();
    $(".add-comentarioEsp").attr("disabled", "disabled");
    $(this)
      .parents("tr")
      .find(".agregarComentarioEspecial")
      .removeClass("agregarComentarioEspecial")
      .addClass("update");
  });

  $(document).on("click", ".update", function () {
    var id = $(this).attr("id");
    var string = id;
    var txtcomentario = $("#txtcomentario").val();
    $.post(
      "../ajax/reddin/ajax_actualizarComentario.php",
      {
        string: string,
        txtcomentario: txtcomentario,
      },
      function (data) {
        $("#exitoregistro").html(data);
        $("input").each(function () {
          var content = $(this).val();
          $(this).html(content);
          $(this).contents().unwrap();
        });
      }
    );
  });

  $("#btnFiltroPlanes").on("click", function () {
    var checked_region = [];
    $.each($("input[name='checkbox_region']:checked"), function () {
      checked_region.push($(this).val());
    });
    var checked_depto = [];
    $.each($("input[name='checkbox_depto']:checked"), function () {
      checked_depto.push($(this).val());
    });

    $.ajax({
      url: "../loads/reddin/tabla_cumplimiento_planes.php",
      method: "POST",
      data: { checkboxRegion: checked_region, checkboxDepto: checked_depto },
      success: function (data) {
        $("#div_tabla_cumplimiento").html(data);
        return false;
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

  // NOTAS DE DIALOGO REDDIN//
  // NOTAS DE DIALOGO REDDIN//
  // NOTAS DE DIALOGO REDDIN//
  $(document).on("click", ".input_notas", function () {
    $(".input_notas").not(this).css("pointer-events", "none");
    var id_nota = $(this).data("id");
    $('.btnBorrarNota').addClass('disabled');
    var tdval,
      inputval,
      editdiv = "";
    editdiv = $(
      '<div class="editdiv"><textarea class="input form-control form-control-sm" data-id="' +
        id_nota +
        '" style="height: 50px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-nota"><i class="fas fa-check"></i></button></div>'
    );
    $(".input").css("pointer-events", "auto");
    $(".btn-update-nota").css("pointer-events", "auto");
    $(".btn-cancel-reddin").css("pointer-events", "auto");
    if (!$(this).find(".input").length) {
      tdval = $(this).text();
      $(this).html(editdiv);
      $(".input", $(this)).val($.trim(tdval));
      $(".input", $(this)).focus();
      $(document).on("click", ".btn-update-nota", function (event) {
        var id = $(".input").data("id");
        var input_nota = $(".input").val();
        $.ajax({
          url: "../ajax/reddin/ajax_actualizarNotaDialogo.php",
          type: "POST",
          data: {
            id_nota: id,
            input_nota: input_nota,
          },
          success: function (data) {
            data = data.trim();
            if (data == 1) {
              swal.fire({
                icon: "success",
                text: "Actualizado con éxito",
                timer: 800,
              });

              $(".input_notas").css("pointer-events", "auto");
              inputval = $(
                ".input",
                $(".btn-update-nota").closest(".editdiv")
              ).val();
              $(".btn-update-nota")
                .closest(".editdiv")
                .parent("td")
                .html('<i class="fas fa-circle-notch"></i> ' + inputval.trim());
                $('.btnBorrarNota').removeClass('disabled');
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

  $(document).on("click", ".btnBorrarNota", function (e) {
    e.preventDefault();
    var id_nota = $(this).data("id");
    $.ajax({
      url: "../ajax/reddin/ajax_eliminarNota.php",
      type: "POST",
      data: {
        id_nota: id_nota,
      },
      success: function (data) {
        var data = data.trim();
        if(data == 1){
          $('.btnBorrarNota').parents("tr").remove();
          Swal.fire({
            icon: 'success',
            text: 'Nota eliminada con éxito!',
            timer: 800
          });
        }else{
          Swal.fire({
            icon: 'error',
            text: 'Error al eliminar nota!',
            timer: 800
          });
        }
      },
    });
  });
});
