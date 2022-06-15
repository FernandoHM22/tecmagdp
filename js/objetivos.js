$(document).ready(function () {
  $(".select_colaboradores").selectpicker();

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
  var año = "2022";
  var year = año;
  var mes = meses[f.getMonth()];
  var dia = f.getDate();
  var fecha =
    f.getDate() + " de " + meses[f.getMonth()] + " del " + f.getFullYear();

  $("#buscarObjetivos").attr("disabled", "disabled");

  $("#periodo").change(function () {
    if ($(this).hasClass("require_one")) {
      $("#buscarObjetivos").removeAttr("disabled");
    }
  });

  $("#modalObjetivosPendientes").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("whatever"); // Extract info from data-* attributes
    var modal = $(this);
    var dataString = "no_reloj=" + recipient;
    $.ajax({
      type: "POST",
      url: "../ajax/objetivos/ajax_objetivosPendientes.php",
      data: dataString,
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

  $("#formObjetivosPersonal").submit(function (event) {
    event.preventDefault();
    var periodo = $("#periodo").val();
    var no_reloj = $("#relojColaborador").val();
    $.ajax({
      url: "../ajax/objetivos/ajax_oportunidadesPersonal.php",
      method: "POST",
      data: {
        periodo: periodo,
        no_reloj: no_reloj,
      },
      success: function (data) {
        $("#displayDivObjetivosPersonal").html(data);
        $("#imgBuscar").hide();
      },
    });
  });

  $(document).on("change", ".fileUploadWrap input[type='file']", function () {
    if ($(this).val()) {
      var filename = $(this).val().split("\\");

      filename = filename[filename.length - 1];

      $(".fileName").text(filename);
    }
  });

  $('[data-toggle="tooltip"]').tooltip({
    trigger: "hover",
  });

  $(document).on("click", ".add-newObjetivo", function () {
    var actions = $(".tablaObjetivos td:last-child").html();
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "post",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $(".select_colaboradores").empty();
        $(".select_colaboradores").append(
          "<option selected value='" + relojSup + "'></option>"
        );
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".select_colaboradores").append(
            "<option value='" +
              no_reloj +
              "'>" +
              nombres +
              " " +
              apellidos +
              "</option>"
          );
        }
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("refresh");
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("render");
      },
    });

    $(this).attr("disabled", "disabled");
    $(".btnCancel").removeAttr("hidden");
    $("#btnBorrador").addClass("disabled");
    var index = $(".tablaObjetivos tbody tr:last-child").index();
    var rowspan =
      '<tr id="inputs">' +
      '<td rowspan="2"></td>' +
      '<td rowspan="2"><select name="txtcategoria" id="txtcategoria" class="custom-select"><option value="Customer Success">Customer Success</option><option value="Cultura Tecma">Cultura Tecma</option><option value="Costo Operativo">Costo Operativo</option></select></td>' +
      "<td rowspan='2'><textarea class='form-control' name='txtobjetivo' required id='txtobjetivo' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Objetivo'></textarea></td>" +
      "<td rowspan='2'><textarea class='form-control' name='txtdescripcion_meta' required id='txtdescripcion_meta' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida de la meta'></textarea></td>" +
      "<td rowspan='2'><input type='number' class='form-control form-control-sm' name='txtmeta' required id='txtmeta' placeholder='#'></td>" +
      '<td rowspan="2" style="justify-content: center; text-align:center;vertical-align:middle;"><a href="#" title="Agregar Estrategia" data-toggle="tooltip" class="addEstrategia m-0 p-0"><i class="fas fa-plus-circle"></i></a><a href="#" title="Eliminar Estrategia" data-toggle="tooltip" class="deleteRowEstrategia m-0 p-0"><i class="fas fa-minus-circle"></i></a></td>' +
      "<td><textarea class='form-control' name='txtestrategia[]' required id='txtestrategia' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control' name='txtdescripcion[]' required id='txtdescripcion' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida del metrico'></textarea></td></td>" +
      "<td><input type='number' id='txtmedida' name='txtmedida[]' class='form-control form-control-sm' placeholder='#'></td>" +
      "<td><input type='number' id='txtponderacion' name='txtponderacion[]' class='form-control form-control-sm sum_ponderacion' placeholder='%'></td>" +
      "<td><select class='selectpicker select_colaboradores' data-width='100px' multiple name='responsable[]' id='responsable'></select></td>" +
      "<td rowspan='2' style='justify-content: center; text-align:center;vertical-align:middle;' >" +
      actions +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td><textarea class='form-control' name='txtestrategia[]' required id='txtestrategia' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control' name='txtdescripcion[]' required id='txtdescripcion' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida de la meta'></textarea></td></td>" +
      "<td><input type='number' id='txtmedida' name='txtmedida[]' class='form-control form-control-sm' placeholder='#'></td>" +
      "<td><input type='number' id='txtponderacion' name='txtponderacion[]' class='form-control form-control-sm sum_ponderacion' placeholder='%'></td>" +
      "<td><select class='selectpicker select_colaboradores' data-width='100px' multiple name='responsable[]' id='responsable'></select><input type='text' class='form-control' name='reloj' id='txtreloj' value='" +
      noReloj +
      "' hidden> <input type='text' name='fecha_regA' hidden value='" +
      fecha +
      "' id='txtfechaReg'><input type='text' name='txtaño' hidden value='" +
      year +
      "' id='txtaño'><input type='text' name='txtestatus' hidden value='0' id='txtestatus'><input type='text' name='txtborrador' hidden value='0' id='txtborrador'></td>" +
      "</tr>";
    $(".tablaObjetivos").append(rowspan);
    $(".tablaObjetivos tbody tr")
      .eq(index + 1)
      .find(".add")
      .toggle();

    $(".tablaObjetivos tbody tr")
      .find(".borrarObjetivo, .agregarRenglonEstrategia, .deleteEstrategia")
      .toggle();
    $(".inputs_objetivo").css("pointer-events", "none");
    $(".inputs_estrategias").css("pointer-events", "none");

    $('[data-toggle="tooltip"]').tooltip({
      trigger: "hover",
    });
    $("html, body").animate(
      {
        scrollTop: $("#inputs").offset().top,
      },
      500
    );
  });

  $(document).on("click", ".add-newEstrategia", function (e) {
    var actionsEstrategias = $("#tabla_estrategias td:last-child").html();
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "post",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $(".select_colaboradores").empty();
        $(".select_colaboradores").append(
          "<option selected value='" + relojSup + "'></option>"
        );
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".select_colaboradores").append(
            "<option value='" +
              no_reloj +
              "'>" +
              nombres +
              " " +
              apellidos +
              "</option>"
          );
        }
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("refresh");
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("render");
      },
    });

    $(this).attr("disabled", "disabled");
    // $(".btnCancel").removeAttr("hidden");
    // $("#btnBorrador").addClass("disabled");
    var index = $("#tabla_estrategias tbody tr:last-child").index();
    var row =
      "<tr><td><textarea class='form-control' required id='estrategia_input' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control' required id='descripcion_input' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida de métrico'></textarea></td>" +
      "<td><input type='number' id='medida_input' class='form-control form-control-sm' placeholder='#'></td>" +
      "<td><input type='number' id='ponderacion_input' class='form-control form-control-sm sum_ponderacion' placeholder='%'></td>" +
      "<td><select class='selectpicker select_colaboradores' name='responsable[]' multiple id='responsable_input'></select><input type='text' class='form-control' id='no_reloj_input' value='" +
      noReloj +
      "' hidden> <input type='text' hidden value='" +
      fecha +
      "' id='fecha_registro_input'><input type='text'  hidden value='" +
      year +
      "' id='anio_input'><input type='text' hidden value='0' id='estatus_objetivo_input'><input type='text' hidden value='0' id='borrador_input'></td>" +
      "<td style='justify-content: center; text-align:center;vertical-align:middle;' >" +
      actionsEstrategias +
      "</td></tr>";
    $("#tabla_estrategias").append(row);

    $("#tabla_estrategias tbody tr")
      .eq(index + 1)
      .find(".agregarEstrategia")
      .toggle();
    $('[data-toggle="tooltip"]').tooltip({
      trigger: "hover",
    });
  });

  $(document).on("click", ".addEstrategia", function (e) {
    e.preventDefault();
    var tr_padre = $(this).closest("tr");
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "post",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $(".tablaObjetivos tbody tr:last-child")
          .find(".select_colaboradores")
          .empty();
        $(".tablaObjetivos tbody tr:last-child")
          .find(".select_colaboradores")
          .append("<option selected value='" + relojSup + "'></option>");
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".tablaObjetivos tbody tr:last-child")
            .find(".select_colaboradores")
            .append(
              "<option value='" +
                no_reloj +
                "'>" +
                nombres +
                " " +
                apellidos +
                "</option>"
            );
        }
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("refresh");
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("render");
      },
    });

    var rowspan =
      parseInt(
        tr_padre
          .find(
            "td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4), td:eq(5), td:eq(11)"
          )
          .attr("rowspan")
      ) + 1;
    if (rowspan > 1) {
      $(".deleteRowEstrategia").css("display", "block");
    }
    tr_padre
      .find(
        "td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4), td:eq(5), td:eq(11)"
      )
      .attr("rowspan", rowspan);
    var row =
      "<tr><td><textarea class='form-control' name='txtestrategia[]' required id='txtestrategia' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control' name='txtdescripcion[]' required id='txtdescripcion' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida de métrico'></textarea></td></td>" +
      "<td><input type='number' id='txtmedida' name='txtmedida[]' class='form-control form-control-sm' placeholder='#'></td>" +
      "<td><input type='number' id='txtponderacion' name='txtponderacion[]' class='form-control form-control-sm sum_ponderacion' placeholder='%'></td>" +
      "<td><select class='selectpicker select_colaboradores' data-width='50%' multiple name='responsable[]' id='responsable'></select><input type='text' class='form-control' name='reloj' id='txtreloj' value='" +
      noReloj +
      "' hidden> <input type='text' name='fecha_regA' hidden value='" +
      fecha +
      "' id='txtfechaReg'><input type='text' name='txtaño' hidden value='" +
      year +
      "' id='txtaño'><input type='text' name='txtestatus' hidden value='0' id='txtestatus'><input type='text' name='txtborrador' hidden value='0' id='txtborrador'></td></tr>";
    $(".tablaObjetivos").append(row);
  });

  $(document).on("click", ".agregarRenglonEstrategia", function (e) {
    e.preventDefault();
    var tr_padre = $(this).closest("tr");
    var actions = tr_padre.find("td:last-child").html();

    tr_padre
      .find(".agregarRenglonEstrategia, .eliminarRenglonEstrategia ")
      .toggle();
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "POST",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $(".tablaObjetivos tbody").find(".select_colaboradores").empty();
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .append("<option selected value='" + relojSup + "'></option>");
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".tablaObjetivos tbody")
            .find(".select_colaboradores")
            .append(
              "<option value='" +
                no_reloj +
                "'>" +
                nombres +
                " " +
                apellidos +
                "</option>"
            );
        }
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("refresh");
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("render");
      },
    });

    var rowspan =
      parseInt(
        tr_padre
          .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
          .attr("rowspan")
      ) + 1;
    // if (rowspan > 1) {
    //   $(".deleteRowEstrategia").css("display", "block");
    // }
    tr_padre
      .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
      .attr("rowspan", rowspan);
    var row =
      "<tr><td><textarea class='form-control' required id='estrategia_input' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control'  required id='descripcion_input' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida de métrico'></textarea></td></td>" +
      "<td><input type='number' id='medida_input'  class='form-control form-control-sm' placeholder='#'></td>" +
      "<td><input type='number' id='ponderacion_input' class='form-control form-control-sm sum_ponderacion' placeholder='%'></td>" +
      "<td><select class='selectpicker select_colaboradores' multiple name='responsable[]' id='responsable_input'></select><input type='text' class='form-control' id='no_reloj_input' value='" +
      noReloj +
      "' hidden> <input type='text' hidden value='" +
      fecha +
      "' id='fecha_registro_input'><input type='text' hidden value='" +
      year +
      "' id='anio_input'><input type='text' hidden value='0' id='estatus_objetivo_input'><input type='text'  hidden value='0' id='borrador_input'></td>" +
      "<td>" +
      actions +
      "</td></tr>";
    $(row).insertAfter(tr_padre);

    var $td = $(this).closest("td");
    var $row = $td.closest("tr");
    var $tds = $row.find("td");

    $tds.each(function () {
      var rowspan = ~~$(this).attr("rowspan");
      while (--rowspan > 0) {
        $row = $row.add($row.next());
      }
    });

    $($row).eq(1).find(".agregarNuevaEstrategia").toggle();
  });

  $(document).on("click", ".agregarNuevaEstrategia", function (e) {
    var id_objetivo = $(this).attr("id");
    var empty = false;
    var input = $(this)
      .parents("tr")
      .find("textarea, input[type='number'], select");
    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });
    var estrategia_input = $("#estrategia_input").val();
    var descripcion_input = $("#descripcion_input").val();
    var medida_input = $("#medida_input").val();
    var ponderacion_input = $("#ponderacion_input").val();
    var responsable_input = $("#responsable_input").val();
    var no_reloj_input = $("#no_reloj_input").val();
    var fecha_registro_input = $("#fecha_registro_input").val();
    var anio_input = $("#anio_input").val();
    var estatus_objetivo_input = $("#estatus_objetivo_input").val();
    var borrador_input = $("#borrador_input").val();

    if (estrategia_input == "" || descripcion_input == "") {
      Swal.fire({
        icon: "error",
        title: "Error al actualizar!",
        text: "Campos vacios",
      });
    } else {
      Swal.fire({
        title: "¿Está seguro que desea agregar estrategia?",
        text: "Al confirmar, validas que la información es correcta.",
        icon: "warning",
        cancelButtonColor: "#DD6B55",
        buttons: ["No", "Confirmar"],
        successMode: true,
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "../ajax/objetivos/ajax_agregarEstrategias.php",
            method: "POST",
            data: {
              id_objetivo: id_objetivo,
              estrategia_input: estrategia_input,
              descripcion_input: descripcion_input,
              medida_input: medida_input,
              ponderacion_input: ponderacion_input,
              responsable_input: responsable_input,
              no_reloj_input: no_reloj_input,
              fecha_registro_input: fecha_registro_input,
              anio_input: anio_input,
              estatus_objetivo_input: estatus_objetivo_input,
              borrador_input: borrador_input,
            },
            success: function (data) {
              data = data.trim();
              if (data == 1) {
                $(".agregarEstrategia")
                  .parents("tr")
                  .find(".agregarEstrategia")
                  .toggle();
                $(".add-newEstrategia").removeAttr("disabled");
                $("#divTablaObjetivos").load(
                  "../loads/objetivos/tablaObjetivosNew",
                  {
                    no_reloj: no_reloj_input,
                  }
                );
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error al registrar!",
                });
              }
            },
          });
          $(this).parents("tr").find(".error").first().focus();
          if (!empty) {
            input.each(function () {
              $(this).parent("td").html($(this).val());
            });
            $(this).parents("tr").find(".agregarEstrategia").toggle();
            $(".add-newEstrategia").removeAttr("disabled");
          }
        }
      });
    }
  });

  $(document).on("click", ".addEstrategiaUser", function (e) {
    e.preventDefault();
    var tr_padre = $(this).closest("tr");
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "post",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $(".tablaObjetivos tbody tr:last-child")
          .find(".select_colaboradores")
          .empty();
        $(".tablaObjetivos tbody tr:last-child")
          .find(".select_colaboradores")
          .append("<option selected value='" + relojSup + "'></option>");
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".tablaObjetivos tbody tr:last-child")
            .find(".select_colaboradores")
            .append(
              "<option value='" +
                no_reloj +
                "'>" +
                nombres +
                " " +
                apellidos +
                "</option>"
            );
        }
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("refresh");
        $(".tablaObjetivos tbody")
          .find(".select_colaboradores")
          .selectpicker("render");
      },
    });

    var rowspan =
      parseInt(
        tr_padre
          .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(10)")
          .attr("rowspan")
      ) + 1;
    if (rowspan > 1) {
      $(".deleteRowEstrategia").css("display", "block");
    }
    tr_padre
      .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(10)")
      .attr("rowspan", rowspan);
    var row =
      "<tr><td><textarea class='form-control' required id='txtestrategia' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar Estrategia'></textarea></td>" +
      "<td><textarea class='form-control' required id='txtdescripcion' style='font-size:13px; margin:0; padding:0;height: 100px;' placeholder='Agregar descripción y unidad de medida del métrico'></textarea></td></td>" +
      "<td><input type='number' id='txtmedida' class='form-control form-control-sm' ></td>" +
      "<td><input type='number' id='txtponderacion' class='form-control form-control-sm sum_ponderacion' ></td>" +
      "<td><select class='selectpicker select_colaboradores' name='responsable[]' multiple id='responsable'></select><input type='text' class='form-control' name='reloj' id='txtreloj' value='" +
      noReloj +
      "' hidden> <input type='text' name='fecha_regA' hidden value='" +
      fecha +
      "' id='txtfechaReg'><input type='text' name='txtaño' hidden value='" +
      year +
      "' id='txtaño'><input type='text' name='txtestatus' hidden value='0' id='txtestatus'><input type='text' name='txtborrador' hidden value='0' id='txtborrador'></td></tr>";
    $(row).insertAfter(tr_padre);
  });

  $(document).on("click", ".deleteRowEstrategia", function (e) {
    e.preventDefault();
    var tr_padre = $(this).closest("tr");
    var rowspan =
      parseInt(
        tr_padre
          .find(
            "td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5),td:eq(11)"
          )
          .attr("rowspan")
      ) - 1;
    if (rowspan == 1) {
      $(".deleteRowEstrategia").css("display", "none");
    }
    tr_padre
      .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5),td:eq(11)")
      .attr("rowspan", rowspan);
    $(".tablaObjetivos tbody tr:last-child").remove();
  });

  $(document).on("click", ".eliminarRenglonEstrategia", function (e) {
    e.preventDefault();
    var tr_padre = $(this).closest("tr");
    var rowspan = $(tr_padre).find("td:first").attr("rowspan");
    if (rowspan > 2) {
      tr_padre
        .find(".agregarRenglonEstrategia, .eliminarRenglonEstrategia ")
        .toggle();
      var rowspan =
        parseInt(
          tr_padre
            .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
            .attr("rowspan")
        ) - 1;
      tr_padre
        .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
        .attr("rowspan", rowspan);
      var $td = $(this).closest("td");
      var $row = $td.closest("tr");
      var $tds = $row.find("td");
      $tds.each(function () {
        var rowspan = ~~$(this).attr("rowspan");
        while (--rowspan > 0) {
          $row = $row.add($row.next());
        }
      });
      $($row).eq(1).remove();
    } else {
      tr_padre
        .find(".agregarRenglonEstrategia, .eliminarRenglonEstrategia ")
        .toggle();
      var rowspan =
        parseInt(
          tr_padre
            .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
            .attr("rowspan")
        ) - 1;
      tr_padre
        .find("td:eq(0),td:eq(1),td:eq(2),td:eq(3), td:eq(4),td:eq(5)")
        .attr("rowspan", rowspan);
      var $td = $(this).closest("td");
      var $row = $td.closest("tr");
      var $tds = $row.find("td");
      $tds.each(function () {
        var rowspan = ~~$(this).attr("rowspan");
        while (--rowspan > 0) {
          $row = $row.add($row.next());
        }
      });
      $($row).eq(1).remove();
    }
  });

  $(document).on("click", ".add", function () {
    var empty = false;
    var $td = $(this).closest("td");
    var $row = $td.closest("tr");
    var $tds = $row.find("td");

    $tds.each(function () {
      var rowspan = ~~$(this).attr("rowspan");
      while (--rowspan > 0) {
        $row = $row.add($row.next());
        input = $row.find('input[type="number"], textarea, select');
      }
      input = $row.find('input[type="number"], textarea, select');
    });

    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });

    var txtcategoria = $("#txtcategoria").val();
    var txtobjetivo = $("#txtobjetivo").val();
    var txtdescripcion_meta = $("#txtdescripcion_meta").val();
    var txtmeta = $("#txtmeta").val();

    var array_estrategia = $("textarea[name='txtestrategia\\[\\]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    var array_descripcion = $("textarea[name='txtdescripcion\\[\\]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    var array_medida = $("input[name='txtmedida\\[\\]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    var array_ponderacion = $("input[name='txtponderacion\\[\\]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    var selectedValues = {};
    $("select[name='responsable\\[\\]']").each(function () {
      var text = $(this).children("option").filter(":selected").text();
      var value = $(this).val();
      selectedValues[text] = value;
    });

    var txtreloj = $("#txtreloj").val();
    var txtfechaReg = $("#txtfechaReg").val();
    var txtaño = $("#txtaño").val();
    var txtestatus = $("#txtestatus").val();
    var txtborrador = $("#txtborrador").val();

    if (txtcategoria == "" || txtobjetivo == "") {
      Swal.fire({
        icon: "error",
        title: "Error al actualizar!",
        text: "Campos vacios",
      });
    } else {
      Swal.fire({
        title: "¿Está seguro que desea agregar objetivo?",
        text: "Al confirmar, validas que la información es correcta.",
        icon: "warning",
        cancelButtonColor: "#DD6B55",
        buttons: ["No", "Confirmar"],
        successMode: true,
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "../ajax/objetivos/ajax_agregarObjetivo.php",
            method: "POST",
            data: {
              txtcategoria: txtcategoria,
              txtobjetivo: txtobjetivo,
              txtdescripcion_meta: txtdescripcion_meta,
              txtmeta: txtmeta,
              array_estrategia: array_estrategia,
              array_descripcion: array_descripcion,
              array_medida: array_medida,
              array_ponderacion: array_ponderacion,
              // sel_colaboradores: sel_colaboradores,
              txtreloj: txtreloj,
              txtfechaReg: txtfechaReg,
              txtaño: txtaño,
              txtestatus: txtestatus,
              txtborrador: txtborrador,
              selectedValues: selectedValues,
            },
            success: function (data) {
              data = data.trim();
              if (data == 1) {
                location.reload();
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error al registrar!",
                });
              }
            },
          });
          $(this).parents("tr").find(".error").first().focus();
          if (!empty) {
            input.each(function () {
              $(this).parent("td").html($(this).val());
            });
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-newObjetivo").removeAttr("disabled");
          }
        }
      });
    }
  });

  $(document).on("click", ".btnCancel", function () {
    $(".btnCancel").attr("hidden", true);
    $(".add-newObjetivo").removeAttr("disabled");
    $(".tablaObjetivos tbody tr:nth-last-child(-n+2)").remove();
  });

  $(document).on("click", ".deleteEstrategia", function () {
    var id = $(this).attr("id");
    var string = id;

    Swal.fire({
      title: "¿Está seguro que desea eliminar su estrategia?",
      text: "No se podra recuperar.",
      icon: "warning",
      cancelButtonColor: "#DD6B55",
      buttons: ["No", "Confirmar"],
      successMode: true,
    }).then(function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: "POST",
          data: {
            string: string,
          },
          url: "../ajax/objetivos/ajax_eliminarEstrategia.php",
          success: function (data) {
            var relojSup = window.no_reloj;
            data = data.trim();
            if (data == 1) {
              Swal.fire({
                icon: "success",
                title: "Estrategia eliminada con éxito!",
              });
              $("#divTablaObjetivos").load(
                "../loads/objetivos/tablaObjetivosNew",
                {
                  no_reloj: relojSup,
                }
              );
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al eliminar!",
              });
            }
          },
        });
      }
    });
  });

  function campoVaciosUpdate() {
    var empty = false;
    var input = $(".update").parents("tr").find("textarea");
    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        $(this).attr("placeholder", "Campo vacio");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });
  }

  $(document).on("click", ".update", function () {
    var id = $(this).attr("id");
    var string = id;
    var txtcategoria = $("#txtcategoria").val();
    var txtobjetivo = $("#txtobjetivo").val();
    var txtimpacto = $("#txtimpacto").val();
    var txtacciones = $("#txtacciones").val();
    var txtmetricos = $("#txtmetricos").val();
    var txtponderacion = $("#txtponderacion").val();
    var txtmeta = $("#txtmeta").val();

    if (
      txtcategoria == "" ||
      txtobjetivo == "" ||
      txtimpacto == "" ||
      txtacciones == "" ||
      txtmetricos == "" ||
      txtponderacion == "" ||
      txtmeta == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Error al actualizar!",
        text: "Campos vacios",
      });
      campoVaciosUpdate();
    } else if (txtponderacion > 20) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser mayor a 20%",
      });
      $("#txtponderacion").addClass("error");
    } else if (txtponderacion <= 0) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser 0%",
      });
      $("#txtponderacion").addClass("error");
    } else {
      Swal.fire({
        title: "¿Está seguro que desea actualizar su objetivo?",
        text: "Al confirmar, validas que la información es correcta.",
        icon: "warning",
        cancelButtonColor: "#DD6B55",
        buttons: ["No", "Confirmar"],
        successMode: true,
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            data: {
              string: string,
              txtcategoria: txtcategoria,
              txtobjetivo: txtobjetivo,
              txtimpacto: txtimpacto,
              txtacciones: txtacciones,
              txtmetricos: txtmetricos,
              txtponderacion: txtponderacion,
              txtmeta: txtmeta,
            },
            url: "../ajax/objetivos/ajax_actualizarObjetivo.php",
            success: function (data) {
              data = data.trim();
              if (data == 1) {
                location.reload();
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error al actualizar!",
                });
              }
            },
          });
        }
      });
    }
  });

  $(document).on("click", ".updateEstrategia", function () {
    var id = $(this).attr("id");
    var string = id;
    var txtestrategia = $("#txtestrategia").val();
    var txtdescripcion = $("#txtdescripcion").val();
    var txtmedida = $("#txtmedida").val();
    var txtponderacion = $("#txtponderacion").val();
    var responsable = $("#responsable").val();

    if (
      txtestrategia == "" ||
      txtdescripcion == "" ||
      txtmedida == "" ||
      txtponderacion == "" ||
      responsable == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Error al actualizar!",
        text: "Campos vacios",
      });
      campoVaciosUpdate();
    } else if (txtponderacion > 20) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser mayor a 20%",
      });
      $("#txtponderacion").addClass("error");
    } else if (txtponderacion <= 0) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser 0%",
      });
      $("#txtponderacion").addClass("error");
    } else {
      Swal.fire({
        title: "¿Está seguro que desea actualizar su objetivo?",
        text: "Al confirmar, validas que la información es correcta.",
        icon: "warning",
        cancelButtonColor: "#DD6B55",
        buttons: ["No", "Confirmar"],
        successMode: true,
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            data: {
              string: string,
              txtestrategia: txtestrategia,
              txtdescripcion: txtdescripcion,
              txtmedida: txtmedida,
              txtponderacion: txtponderacion,
              responsable: responsable,
            },
            url: "../ajax/objetivos/ajax_actualizarEstrategia.php",
            success: function (data) {
              data = data.trim();
              if (data == 1) {
                location.reload();
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error al actualizar!",
                });
              }
            },
          });
        }
      });
    }
  });

  $(document).on("click", ".edit", function () {
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function (i) {
        if (i == "0") {
          var idname = "txtcategoria";
        } else if (i == "1") {
          var idname = "txtobjetivo";
        } else if (i == "2") {
          var idname = "txtimpacto";
        } else if (i == "3") {
          var idname = "txtacciones";
        } else if (i == "4") {
          var idname = "txtmetricos";
        } else if (i == "5") {
          var idname = "txtponderacion";
        } else if (i == "6") {
          var idname = "txtmeta";
        } else if (i == "7") {
          var idname = "txtlogro";
        } else if (i == "8") {
          var idname = "txtresultado";
        } else if (i == "9") {
          var idname = "evidenciaObjetivos";
        }
        if (idname == "txtcategoria") {
          $(this).html(
            '<select name="txtcategoria" id="' +
              idname +
              '" class="custom-select"><option selected hidden value="' +
              $(this).text() +
              '">' +
              $(this).text() +
              '</option><option value="Customer Success">Customer Success</option><option value="Cultura Tecma">Cultura Tecma</option><option value="Costo Operativo">Costo Operativo</option></select>'
          );
        } else {
          $(this).html(
            '<textarea class="form-control" name="updaterec" id="' +
              idname +
              '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
              $.trim($(this).text()) +
              "</textarea>"
          );
        }
      });
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".update").show();
    $(".evaluation").hide();
    $("#txtlogro").hide();
    $("#evidenciaObjetivos").hide();
    $("#txtresultado").attr("disabled", "disabled");
    $("#evidenciaObjetivos").hide();
    $(".add-newObjetivo").attr("disabled", "disabled");
    $(this).parents("tr").find(".add").removeClass("add").addClass("update");
  });

  $(document).on("click", ".inputs_objetivo", function () {
    $(".inputs_objetivo").not(this).css("pointer-events", "none");
    $(".inputs_estrategias").css("pointer-events", "none");

    var id_objetivo = $(this).data("id");
    var num_td = $(this).data("num");

    var tdval,
      inputval,
      editdiv = "";
    if (num_td == 1) {
      editdiv = $(
        '<div class="editdiv"><select  id="input_categoria" class="input custom-select"><option value="Customer Success">Customer Success</option><option value="Cultura Tecma">Cultura Tecma</option><option value="Costo Operativo">Costo Operativo</option></select><button type="submit" class="btn btn-sm btn-success btn-update-objetivo"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 2) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_objetivo" class="input form-control form-control-sm" style="height: 150px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-objetivo"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 3) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_descripcion" class="input form-control form-control-sm" style="height: 150px;"></textarea><button type="submit" class="btn btn-sm btn-success btn-update-objetivo"><i class="fas fa-check"></i></button></div>'
      );
    } else if (num_td == 4) {
      editdiv = $(
        '<div class="editdiv"><input id="input_meta" type="number" class="input form-control form-control-sm"></input><button type="submit" class="btn btn-sm btn-success btn-update-objetivo"><i class="fas fa-check"></i></button></div>'
      );
    }
    $(".input").css("pointer-events", "auto");
    $(".btn-update-objetivo").css("pointer-events", "auto");
    $(".btn-cancel-objetivo").css("pointer-events", "auto");
    if (!$(this).find(".input").length) {
      tdval = $(this).text();
      $(this).html(editdiv);
      $(".input", $(this)).val($.trim(tdval));
      $(".input", $(this)).focus();
      $(document).on("click", ".btn-update-objetivo", function (event) {
        var categoria = $("#input_categoria").val();
        var objetivo = $("#input_objetivo").val();
        var descripcion = $("#input_descripcion").val();
        var meta = $("#input_meta").val();
        $.ajax({
          url: "../ajax/objetivos/ajax_actualizarObjetivo.php",
          type: "POST",
          data: {
            id_objetivo: id_objetivo,
            categoria: categoria,
            objetivo: objetivo,
            descripcion: descripcion,
            meta: meta,
          },
          success: function (data) {
            data = data.trim();
            if (data == 1) {
              swal("Actualizado con éxito!", {
                icon: "success",
                timer: 800,
              });
              $(".inputs_objetivo").css("pointer-events", "auto");
              $(".inputs_estrategias").css("pointer-events", "auto");
              inputval = $(
                ".input",
                $(".btn-update-objetivo").closest(".editdiv")
              ).val();
              $(".btn-update-objetivo")
                .closest(".editdiv")
                .parent("td")
                .html(inputval);
            } else {
              swal("Error al actualizar!", {
                icon: "error",
              });
            }
          },
        });
      });
      $(document).on("click", ".btn-cancel-objetivo", function (event) {
        event.preventDefault();
        $(".inputs_objetivo").css("pointer-events", "auto");
        $(".inputs_estrategias").css("pointer-events", "auto");
        inputval = $(".input", $(this).closest(".editdiv")).val();
        $(this).closest(".editdiv").parent("td").html(inputval);
      });
    }
  });

  var count_click = 0;
  $(document).on("click", ".inputs_estrategias", function () {
    $(".inputs_estrategias").not(this).css("pointer-events", "none");
    $(".inputs_objetivo").css("pointer-events", "none");

    var id_objetivo = $(this).data("id");
    var num_td = $(this).data("num");

    var tdval,
      inputval,
      editdiv = "";
    if (num_td == 1) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_estrategia" class="input form-control form-control-sm" style="height: 100px;"></textarea><button type="submit" data-id="' +
          id_objetivo +
          '" class="btn btn-sm btn-success btn-update-estrategia"><i class="fas fa-check"></i></button><a href="#" class="btn btn-sm btn-danger btn-cancel-estrategia"><i class="fas fa-times"></i></a></div>'
      );
    } else if (num_td == 2) {
      editdiv = $(
        '<div class="editdiv"><textarea id="input_descripcion_metrico" class="input form-control form-control-sm" style="height: 100px;"></textarea><button type="submit" data-id="' +
          id_objetivo +
          '" class="btn btn-sm btn-success btn-update-estrategia"><i class="fas fa-check"></i></button><a href="#" class="btn btn-sm btn-danger btn-cancel-estrategia"><i class="fas fa-times"></i></a></div>'
      );
    } else if (num_td == 3) {
      editdiv = $(
        '<div class="editdiv"><input id="input_metrico" type="number" class="input form-control form-control-sm"></input><button type="submit" data-id="' +
          id_objetivo +
          '" class="btn btn-sm btn-success btn-update-estrategia"><i class="fas fa-check"></i></button><a href="#" class="btn btn-sm btn-danger btn-cancel-estrategia"><i class="fas fa-times"></i></a></div>'
      );
    } else if (num_td == 4) {
      editdiv = $(
        '<div class="editdiv"><input id="input_ponderacion" type="number" class="input form-control form-control-sm"></input><button type="submit" data-id="' +
          id_objetivo +
          '" class="btn btn-sm btn-success btn-update-estrategia"><i class="fas fa-check"></i></button><a href="#" class="btn btn-sm btn-danger btn-cancel-estrategia"><i class="fas fa-times"></i></a></div>'
      );
    } else if (num_td == 5) {
      count_click += 1;
      if (count_click == 1) {
        var relojSup = window.no_reloj;
        $.ajax({
          url: "../ajax/objetivos/ajax_colaboradores.php",
          type: "post",
          data: { no_reloj: relojSup },
          dataType: "json",
          success: function (response) {
            var len = response.length;
            $(".tablaObjetivos tbody").find("#input_responsable").empty();
            $(".tablaObjetivos tbody")
              .find("#input_responsable")
              .append(
                "<option selected value='" + relojSup + "'>Propio*</option>"
              );
            for (var i = 0; i < len; i++) {
              var no_reloj = response[i]["no_reloj"];
              var nombres = response[i]["nombres"];
              var apellidos = response[i]["apellidos"];
              $(".tablaObjetivos tbody")
                .find("#input_responsable")
                .append(
                  "<option value='" +
                    no_reloj +
                    "'>" +
                    nombres +
                    " " +
                    apellidos +
                    "</option>"
                );
            }
            $(".tablaObjetivos tbody")
              .find("#input_responsable")
              .selectpicker("refresh");
            $(".tablaObjetivos tbody")
              .find("#input_responsable")
              .selectpicker("render");
          },
        });
      }
      editdiv = $(
        '<div class="editdiv"><select class="input selectpicker" id="input_responsable" name="input_responsable[]"multiple></select><button type="submit" data-id="' +
          id_objetivo +
          '" class="btn btn-sm btn-success btn-update-estrategia"><i class="fas fa-check"></i></button><a href="#" class="btn btn-sm btn-danger btn-cancel-estrategia"><i class="fas fa-times"></i></a></div>'
      );
    }

    $(".input").css("pointer-events", "auto");
    $(".btn-update-estrategia").css("pointer-events", "auto");
    $(".btn-cancel-estrategia").css("pointer-events", "auto");

    if (!$(this).find(".input").length) {
      tdval = $(this).text();
      $(this).html(editdiv);
      $(".input", $(this)).val($.trim(tdval));
      $(".input", $(this)).focus();
      $(document).on("click", ".btn-update-estrategia", function (event) {
        var estrategia = $("#input_estrategia").val();
        var id = $(this).data("id");
        var descripcion_metrico = $("#input_descripcion_metrico").val();
        var metrico = $("#input_metrico").val();
        var ponderacion = $("#input_ponderacion").val();
        var responsable = $("#input_responsable").val();
        $.ajax({
          url: "../ajax/objetivos/ajax_actualizarEstrategia.php",
          type: "POST",
          data: {
            id_objetivo: id,
            estrategia: estrategia,
            descripcion_metrico: descripcion_metrico,
            metrico: metrico,
            ponderacion: ponderacion,
            responsable: responsable,
          },
          success: function (data) {
            count_click = 0;
            var relojSup = window.no_reloj;
            data = data.trim();
            if (data == 1) {
              if (num_td == 4 || num_td == 5) {
                $("#divTablaObjetivos").load(
                  "../loads/objetivos/tablaObjetivosNew",
                  {
                    no_reloj: relojSup,
                  }
                );
              }
              Swal.fire({
                icon: "success",
                title: "Actualizado con éxito!",
                timer: 800,
              });
              $(".inputs_estrategias").css("pointer-events", "auto");
              $(".inputs_objetivo").css("pointer-events", "auto");
              inputval = $(
                ".input",
                $(".btn-update-estrategia").closest(".editdiv")
              ).val();
              $(".btn-update-estrategia")
                .closest(".editdiv")
                .parent("td")
                .html(inputval);
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al actualizar!",
              });
            }
          },
        });
      });
      $(document).on("click", ".btn-cancel-estrategia", function (event) {
        event.preventDefault();
        $(".inputs_objetivo").css("pointer-events", "auto");
        $(".inputs_estrategias").css("pointer-events", "auto");
        inputval = $(".input", $(this).closest(".editdiv")).val();
        $(this).closest(".editdiv").parent("td").html(inputval);
      });
    }
  });

  $(document).on("click", ".editEstrategia", function (e) {
    e.preventDefault();
    var relojSup = window.no_reloj;
    $.ajax({
      url: "../ajax/objetivos/ajax_colaboradores.php",
      type: "post",
      data: { no_reloj: relojSup },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        for (var i = 0; i < len; i++) {
          var no_reloj = response[i]["no_reloj"];
          var nombres = response[i]["nombres"];
          var apellidos = response[i]["apellidos"];
          $(".select_colaboradores").append(
            "<option value='" +
              no_reloj +
              "'>" +
              nombres +
              " " +
              apellidos +
              "</option>"
          );
        }
      },
    });
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function (i) {
        if (i == "0") {
          var idname = "txtestrategia";
        } else if (i == "1") {
          var idname = "txtdescripcion";
        } else if (i == "2") {
          var idname = "txtmedida";
        } else if (i == "3") {
          var idname = "txtponderacion";
        } else if (i == "4") {
          var idname = "responsable";
        }
        if (idname == "responsable") {
          $(this).html(
            '<select name="responsable[]" id="' +
              idname +
              '" class="custom-select select_colaboradores" multiple><option selected hidden value="' +
              $(this).text() +
              '">' +
              $(this).text() +
              "</option></select>"
          );
        } else if (idname == "txtmedida" || idname == "txtponderacion") {
          $(this).html(
            '<input class="form-control form-control-sm" name="updaterec" id="' +
              idname +
              '" value="' +
              $.trim($(this).text()) +
              '">'
          );
        } else if (idname == "txtestrategia" || idname == "txtdescripcion") {
          $(this).html(
            '<textarea class="form-control" name="updaterec" id="' +
              idname +
              '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
              $.trim($(this).text()) +
              "</textarea>"
          );
        }
      });
    $(this).parents("tr").find(".add, .edit, .editEstrategia").toggle();
    $(".update").show();
    $(".evaluation").hide();
    $("#txtlogro").hide();
    $("#evidenciaObjetivos").hide();
    $("#txtresultado").attr("disabled", "disabled");
    $("#evidenciaObjetivos").hide();
    $(".add-newObjetivo").attr("disabled", "disabled");
    $(this)
      .parents("tr")
      .find(".add")
      .removeClass("add")
      .addClass("updateEstrategia");
    $(".updateEstrategia")
      .attr("data-original-title", "Actualizar Estrategia")
      .tooltip("show");
  });

  $(document).on("click", ".editObjetivoUser", function (e) {
    e.preventDefault();
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function (i) {
        if (i == "0") {
          var idname = "txtcategoria";
        } else if (i == "1") {
          var idname = "txtobjetivo";
        } else if (i == "2") {
          var idname = "txtdescripcion";
        } else if (i == "3") {
          var idname = "txtmeta";
        } else if (i == "4") {
          var idname = "opciones";
        } else if (i == "5") {
          var idname = "txtestrategia";
        } else if (i == "6") {
          var idname = "txtdescripcion_metrico";
        } else if (i == "7") {
          var idname = "txtmedida";
        } else if (i == "8") {
          var idname = "txtponderacion";
        } else if (i == "9") {
          var idname = "responsable";
        }
        if (idname == "txtcategoria") {
          $(this).html(
            '<select name="txtcategoria" id="' +
              idname +
              '" class="custom-select"><option selected hidden value="' +
              $(this).text() +
              '">' +
              $(this).text() +
              '</option><option value="Customer Success">Customer Success</option><option value="Cultura Tecma">Cultura Tecma</option><option value="Costo Operativo">Costo Operativo</option></select>'
          );
        } else if (
          idname == "txtmeta" ||
          idname == "txtponderacion" ||
          idname == "txtmedida"
        ) {
          $(this).html(
            '<input type="number" class="form-control form-control-sm" name="updaterec" id="' +
              idname +
              '" value="' +
              $.trim($(this).text()) +
              '">'
          );
        } else if (
          idname == "txtobjetivo" ||
          idname == "txtdescripcion" ||
          idname == "txtestrategia" ||
          idname == "txtdescripcion_metrico"
        ) {
          if (idname == "txtestrategia") {
            $(this).html(
              '<textarea placeholder="Agregar estrategia" class="form-control" name="updaterec" id="' +
                idname +
                '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
                $.trim($(this).text()) +
                "</textarea>"
            );
          } else if (idname == "txtdescripcion_metrico") {
            $(this).html(
              '<textarea placeholder="Agrega descripción" class="form-control" name="updaterec" id="' +
                idname +
                '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
                $.trim($(this).text()) +
                "</textarea>"
            );
          } else {
            $(this).html(
              '<textarea class="form-control" name="updaterec" id="' +
                idname +
                '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
                $.trim($(this).text()) +
                "</textarea>"
            );
          }
        } else if (idname == "opciones") {
          $(this).html(
            '<a href="#" title="Agregar Estrategia" data-toggle="tooltip" class="addEstrategiaUser m-0 p-0"><i class="fas fa-plus-circle"></i></a><a href="#" title="Eliminar Estrategia" data-toggle="tooltip" class="deleteRowEstrategiaUser m-0 p-0"><i class="fas fa-minus-circle"></i></a>'
          );
        }
      });
    $(this).parents("tr").find(".add,.editObjetivoUser").toggle();
    $(".add-newObjetivo").attr("disabled", "disabled");
    $(this)
      .parents("tr")
      .find(".add")
      .removeClass("add")
      .addClass("agregarEstrategiaUser");
    $(".agregarEstrategiaUser")
      .attr("data-original-title", "Actualizar Estrategias")
      .tooltip("show");
  });

  $(document).on("click", ".agregarEstrategiaUser", function (e) {
    e.preventDefault();
    var id = $(this).attr("id");
    var string = id;
    var txtestrategia = $("#txtestrategia").val();
    var txtdescripcion = $("#txtdescripcion").val();
    var txtmedida = $("#txtmedida").val();
    var txtponderacion = $("#txtponderacion").val();
    var responsable = $("#responsable").val();

    if (
      txtestrategia == "" ||
      txtdescripcion == "" ||
      txtmedida == "" ||
      txtponderacion == "" ||
      responsable == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Error al actualizar!",
        text: "Campos vacios",
      });
      campoVaciosUpdate();
    } else if (txtponderacion > 20) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser mayor a 20%",
      });
      $("#txtponderacion").addClass("error");
    } else if (txtponderacion <= 0) {
      Swal.fire({
        icon: "warning",
        title: "Ponderacion no puede ser 0%",
      });
      $("#txtponderacion").addClass("error");
    } else {
      Swal.fire({
        title: "¿Está seguro que desea actualizar su objetivo?",
        text: "Al confirmar, validas que la información es correcta.",
        icon: "warning",
        cancelButtonColor: "#DD6B55",
        buttons: ["No", "Confirmar"],
        successMode: true,
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            data: {
              string: string,
              txtestrategia: txtestrategia,
              txtdescripcion: txtdescripcion,
              txtmedida: txtmedida,
              txtponderacion: txtponderacion,
              responsable: responsable,
            },
            url: "../ajax/objetivos/ajax_actualizarEstrategia.php",
            success: function (data) {
              data = data.trim();
              if (data == 1) {
                location.reload();
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Error al actualizar!",
                });
              }
            },
          });
        }
      });
    }
  });

  $(document).on("click", ".evaluar", function () {
    var id = $(this).attr("id");
    var string = id;
    var txtlogro = $("#txtlogro").val();
    var data = new FormData();
    data.append("string", string);
    data.append("txtlogro", txtlogro);
    data.append("file", $("#evidenciaObjetivos")[0].files[0]);
    $.ajax({
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener(
          "progress",
          function (evt) {
            if (evt.lengthComputable) {
              var percentComplete = (evt.loaded / evt.total) * 100;
              $(".progress-bar").width(percentComplete + "%");
              $(".progress-bar").html(percentComplete + "%");
            }
          },
          false
        );
        return xhr;
      },
      url: "../ajax/objetivos/ajax_logroObjetivo.php",
      method: "POST",
      contentType: false,
      processData: false,
      beforeSend: function () {
        $(".progress-bar").width("0%");
      },
      data: data,
      success: function (data) {
        //location.reload();
        $("#divObjetivosEvaluar")
          .load("../loads/objetivos/tablaObjetivosPendientes.php", {
            no_reloj: noReloj,
          })
          .fadeIn("slow");
        $("#displaymessage").html(data);
      },
    });
  });

  $(document).on("click", ".evaluation", function () {
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function (i) {
        if (i == "0") {
          var idname = "txtcategoria";
        } else if (i == "1") {
          var idname = "txtobjetivo";
        } else if (i == "2") {
          var idname = "txtimpacto";
        } else if (i == "3") {
          var idname = "txtacciones";
        } else if (i == "4") {
          var idname = "txtmetricos";
        } else if (i == "5") {
          var idname = "txtponderacion";
        } else if (i == "6") {
          var idname = "txtmeta";
        } else if (i == "7") {
          var idname = "txtlogro";
        } else if (i == "8") {
          var idname = "txtresultado";
        } else if (i == "9") {
          var idname = "evidenciaObjetivos";
        }
        if (
          idname == "txtponderacion" ||
          idname == "txtmeta" ||
          idname == "txtlogro" ||
          idname == "txtresultado"
        ) {
          $(this).html(
            '<input type="number" name="updaterec" id="' +
              idname +
              '" class="form-control" value="' +
              $(this).text() +
              '" pattern="^[0-9]+" required>'
          );
        }
        if (idname == "evidenciaObjetivos") {
          $(this).html(
            '<div class="fileUploadWrap"><i data-toggle="tooltip" title="Adjuntar Archivo" class="fas fa-paperclip"></i><input type="file" class="form-control-file" id="' +
              idname +
              '"><p class="fileName">Adjuntar Archivo</p><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"></div></div></div>'
          );
        } else {
          $(this).html(
            '<textarea class="form-control" name="updaterec" id="' +
              idname +
              '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' +
              $(this).text() +
              "</textarea>"
          );
        }
      });
    $(this).parents("tr").find(".add, .edit").toggle();
    $("#txtcategoria").attr("disabled", "disabled");
    $("#txtobjetivo").attr("disabled", "disabled");
    $("#txtimpacto").attr("disabled", "disabled");
    $("#txtacciones").attr("disabled", "disabled");
    $("#txtmetricos").attr("disabled", "disabled");
    $("#txtponderacion").attr("disabled", "disabled");
    $("#txtmeta").attr("disabled", "disabled");
    $("#txtresultado").attr("disabled", "disabled");
    $(".evaluation").hide();
    $(this).parents("tr").find(".add").removeClass("add").addClass("evaluar");
  });

  $(document).on("click", "#btnEnviarObjetivos", function (e) {
    $(this).addClass("disabled").html("Enviando...");
    e.preventDefault();
    var id_objetivos = $("input[name='id_objetivos\\[\\]']")
      .map(function () {
        return $(this).val();
      })
      .get();

    var relojSup = window.no_reloj;
    Swal.fire({
      title: "¿Está seguro que desea enviar y guardar objetivos?",
      text: "Al confirmar, validas que la información es correcta.",
      icon: "warning",
      cancelButtonColor: "#DD6B55",
      buttons: ["No", "Confirmar"],
      successMode: true,
    }).then(function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          url: "../ajax/objetivos/ajax_enviar_objetivo.php",
          type: "POST",
          data: { id_objetivos: id_objetivos, reloj: relojSup },
          success: function (data) {
            var data = data.trim();
            if (data == 1) {
              Swal.fire({
                icon: "success",
                title: "Objetivos enviados y guardados correctamente",
              });
              $("#btnEnviarObjetivos").html("Enviado");
              $("#textEstatusObjetivos")
                .removeClass("alert-warning")
                .addClass("alert-success")
                .html(
                  "Objetivos <strong>guardados y enviados correctamente</strong>"
                );
            }
          },
        });
      } else {
        $("#btnEnviarObjetivos")
          .removeClass("disabled")
          .html("Guardar y enviar");
      }
    });
  });

  $(document).on("click", ".borrarObjetivo", function (e) {
    e.preventDefault();
    var id_objetivo = $(this).data("id");
    Swal.fire({
      title: "Esta seguro que desea eliminar su objetivo?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "../ajax/objetivos/ajax_eliminarObjetivo.php",
          type: "POST",
          data: { id_objetivo: id_objetivo },
          success: function (data) {
            var data = data.trim();
            if (data == 1) {
              location.reload();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al eliminar!",
              });
            }
          },
        });
      }
    });
  });
});
