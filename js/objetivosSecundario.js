
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
var f = new Date();
var año = f.getFullYear();
var year = año;
var mes = meses[f.getMonth()];
var dia = f.getDate();
var fecha = f.getDate() + " de " + meses[f.getMonth()] + " del " + f.getFullYear();

$('#buscarObjetivos').attr('disabled','disabled');
$('[data-toggle="tooltip"]').tooltip();

$('#periodo').change(function(){
 if ( $(this).hasClass('require_one') ){
  $('#buscarObjetivos').removeAttr('disabled');
}
});

$(document).ready(function(){
    $('#modalObjetivosPendientes').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this);
    var dataString = 'no_reloj=' + recipient;
    $.ajax({
        type: "POST",
        url: "../ajax/objetivos/ajax_objetivosPendientes.php",
        data: dataString,
        cache: false,
        success: function(data) {
            console.log(data);
            modal.find('.dash').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
});
});

$(document).ready(function() {
    $("#formObjetivosSup").submit(function(event) {
        event.preventDefault();
        var periodo = $("#periodoLider").val();
        var no_reloj = $("#relojCLider").val();
        $.ajax({
            url: '../ajax/objetivos/ajax_oportunidadesLider.php',
            method: 'POST',
            data: {
                periodo: periodo,
                no_reloj: no_reloj
            },
            success: function(data) {
                $("#displayDiv").html(data);
            }
        });
    });
});

$(document).ready(function() {
    $("#formObjetivosPersonal").submit(function(event) {
        event.preventDefault();
        var periodo = $("#periodo").val();
        var no_reloj = $("#relojColaborador").val();
        $.ajax({
            url: '../ajax/objetivos/ajax_oportunidadesPersonal.php',
            method: 'POST',
            data: {
                periodo: periodo,
                no_reloj: no_reloj
            },
            success: function(data) {
                $("#displayDivObjetivosPersonal").html(data);
                $("#imgBuscar").hide();
            }
        });
    });
});

$(document).ready(function(){
    var actions = $(".tablaObjetivos td:last-child").html();
    $(".add-newObjetivo").click(function() {
        $(this).attr("disabled", "disabled");
        $(".btnCancel").removeAttr("hidden");
        var index = $(".tablaObjetivos tbody tr:last-child").index();
        var row = '<tr id="inputs">' +
        '<td><select name="txtcategoria" id="txtcategoria" class="custom-select"><option value="Cultura Tecma">Cultura Tecma</option><option value="Estrategia">Estrategia</option><option value="GPTW">GPTW</option><option value="Liderazgo">Liderazgo</option><option value="Servicio al Cliente">Servicio al Cliente</option></select></td></td>' +
        '<td><textarea class="form-control" name="txtobjetivo" required id="txtobjetivo" style="font-size:13px; margin:0; padding:0;height: 215px;"></textarea></td>' +
        '<td><textarea class="form-control" name="txtimpacto" required id="txtimpacto" style="font-size:13px; margin:0; padding:0;height: 215px;"></textarea></td> ' +
        '<td><textarea class="form-control" name="txtacciones" required id="txtacciones" style="font-size:13px; margin:0; padding:0;height: 215px;"></textarea></td>' +
        '<td><textarea class="form-control" name="txtmetricos" required id="txtmetricos" style="font-size:13px; margin:0; padding:0;height: 215px;"></textarea></td>' +
        '<td><input type="number" class="form-control" pattern="^[0-9]+" name="txtponderacion" required id="txtponderacion" placeholder="% Peso del Objetivo" min="0" max="20" ></td>' +
        '<td><input type="number" class="form-control" pattern="^[0-9]+"  name="txtmeta" required id="txtmeta"><input type="text" class="form-control" name="reloj" id="txtreloj" value="' + noReloj + '" hidden> <input type="text" name="fecha_regA" hidden value="' + fecha + '" id="txtfechaReg"><input type="text" name="txtaño" hidden value="' + year + '" id="txtaño"><input type="text" name="txtestatus" hidden value="0" id="txtestatus"></td>' +
        '<td>' + actions + '</td>' + '</tr>';
        $(".tablaObjetivos").append(row);
        $(".tablaObjetivos tbody tr").eq(index + 1).find(".agregarObjetivo, .editarObjetivo").toggle();
        $('[data-toggle="tooltip"]').tooltip();
        $('html, body').animate({
            scrollTop: $("#inputs").offset().top
        }, 500);
    });  
});

$(document).ready(function(){
    $(document).on("click", ".agregarObjetivo", function() {
        var empty = false;
        var input = $(this).parents("tr").find('input[type="number"],textarea');
        input.each(function() {
            if (!$(this).val()) {
                $(this).addClass("error");
                empty = true;
            } else {
                $(this).removeClass("error");
            }
        });
        var txtcategoria = $("#txtcategoria").val();
        var txtobjetivo = $("#txtobjetivo").val();
        var txtimpacto = $("#txtimpacto").val();
        var txtacciones = $("#txtacciones").val();
        var txtmetricos = $("#txtmetricos").val();
        var txtponderacion = $("#txtponderacion").val();
        var txtmeta = $("#txtmeta").val();
        var txtreloj = $("#txtreloj").val();
        var txtfechaReg = $("#txtfechaReg").val();
        var txtaño = $("#txtaño").val();
        var txtestatus = $("#txtestatus").val();
        var form_data = new FormData();
        form_data.append("txtcategoria", txtcategoria);
        form_data.append("txtobjetivo", txtobjetivo);
        form_data.append("txtimpacto", txtimpacto);
        form_data.append("txtacciones", txtacciones);
        form_data.append("txtmetricos", txtmetricos);
        form_data.append("txtponderacion", txtponderacion);
        form_data.append("txtmeta", txtmeta);
        form_data.append("txtreloj", txtreloj);
        form_data.append("txtfechaReg", txtfechaReg);
        form_data.append("txtaño", txtaño);
        form_data.append("txtestatus", txtestatus);

        if (txtcategoria == '' || txtobjetivo == '' || txtimpacto == '' || txtacciones == '' || txtmetricos == '' || txtponderacion == '' || txtmeta == ''){
            swal("Error al actualizar!", {
                icon: "error",
                text: "Campos vacios",
            });

        }else if(txtponderacion > 20){
            swal("Ponderacion no puede ser mayor a 20%", {
                icon: "warning",
            });
            $("#txtponderacion").addClass("error");
        }else if(txtponderacion <= 0){
            swal("Ponderacion no puede ser 0%", {
                icon: "warning",
            });
            $("#txtponderacion").addClass("error");
        }else{
            swal({
                title: "¿Está seguro que agregar objetivo?",
                text: "Al confirmar, validas que la información es correcta.",
                icon: "warning",
                cancelButtonColor: "#DD6B55",
                buttons: [
                'No',
                'Confirmar'
                ],
                successMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "../ajax/objetivos/ajax_agregarObjetivo.php",
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(data) {
                           data = data.trim();
                           if (data == 1) {
                            location.reload();
                            /*$('#alerta').css('display', 'none');
                            $('#notaPorcentaje').css('display', 'block');
                            $('select, textarea, input[type=number]').each(function(){
                                var content = $(this).val();
                                $(this).html(content);
                                $(this).contents().unwrap();    
                            });
                            $(".add-newObjetivo").removeAttr("disabled");
                            $(".btnCancel").attr("hidden",true);
                            swal("Registrado con éxito!", {
                                icon: "success",
                            });*/
                        }else{
                            swal("Error al registrar!", {
                                icon: "error",
                            });
                        }; 
                    }
                });
                    $(this).parents("tr").find(".error").first().focus();
                    if (!empty) {
                        input.each(function() {
                            $(this).parent("td").html($(this).val());
                        });
                        $(this).parents("tr").find(".agregarObjetivo, .editarObjetivo").toggle();
                        $(".add-newObjetivo").removeAttr("disabled");
                    }
                }
            });
        }
    });
});

$(document).ready(function(){
    $(document).on("click", ".btnCancel", function() {
        $(this).attr("hidden", true);
        $(".add-newObjetivo").removeAttr("disabled");
        $(".tablaObjetivos tbody tr:last-child").remove();

    });
});

$(document).ready(function(){
    $(document).on("click", ".borrarObjetivo", function() {
        $(this).parents("tr").remove();
        var id = $(this).attr("id");
        var string = id;

        swal({
            title: "¿Está seguro que desea eliminar objetivo?",
            text: "No se podrá recuperar.",
            icon: "warning",
            cancelButtonColor: "#DD6B55",
            buttons: [
            'No',
            'Confirmar'
            ],
            successMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type:"POST",
                    data: {string: string},
                    url:"../ajax/objetivos/ajax_eliminarObjetivo.php",
                    success: function(data){
                        data = data.trim();
                        if (data == 1) {
                            //$(".add-newObjetivo").removeAttr("disabled");
                            //swal("Eliminado con éxito!", {icon: "success",});
                            location.reload();
                        }else{
                            swal("Error al eliminar!", {icon: "error",});
                        }
                    }
                });
            }
        });
    });
});

function campoVaciosUpdate(){
    var empty = false;
    var input = $(".update").parents("tr").find('textarea');
    input.each(function() {
        if(!$(this).val()) {
            $(this).addClass("error");
            $(this).attr("placeholder", "Campo vacio");
            empty = true;
        } else {
            $(this).removeClass("error");
        }
    });
}


$(document).ready(function(){
    $(document).on("click", ".updateObjetivos", function() {
        var id = $(this).attr("id");
        var string = id;
        var txtcategoria = $("#txtcategoria").val();
        var txtobjetivo = $("#txtobjetivo").val();
        var txtimpacto = $("#txtimpacto").val();
        var txtacciones = $("#txtacciones").val();
        var txtmetricos = $("#txtmetricos").val();
        var txtponderacion = $("#txtponderacion").val();
        var txtmeta = $("#txtmeta").val();

        if (txtcategoria == '' || txtobjetivo == '' || txtimpacto == '' || txtacciones == '' || txtmetricos == '' || txtponderacion == '' || txtmeta == ''){
            swal("Error al actualizar!", {
                icon: "error",
                text: "Campos vacios",
            });
            campoVaciosUpdate();
        }else if(txtponderacion > 20){
            swal("Ponderacion no puede ser mayor a 20%", {
                icon: "warning",
            });
            $("#txtponderacion").addClass("error");
        }else if(txtponderacion <= 0){
            swal("Ponderacion no puede ser 0%", {
                icon: "warning",
            });
            $("#txtponderacion").addClass("error");
        }else{
            swal({
                title: "¿Está seguro que desea actualizar su objetivo?",
                text: "Al confirmar, validas que la información es correcta.",
                icon: "warning",
                cancelButtonColor: "#DD6B55",
                buttons: [
                'No',
                'Confirmar'
                ],
                successMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type:"POST",
                        data: {    
                            string: string,
                            txtcategoria: txtcategoria,
                            txtobjetivo: txtobjetivo,
                            txtimpacto: txtimpacto,
                            txtacciones: txtacciones,
                            txtmetricos: txtmetricos,
                            txtponderacion: txtponderacion,
                            txtmeta: txtmeta
                        },
                        url:"../ajax/objetivos/ajax_actualizarObjetivo.php",
                        success: function(data){
                            data = data.trim();
                            if (data == 1) {
                                location.reload();
                             /* $('textarea, #txtcategoria').each(function() {
                                var content = $(this).val(); //.replace(/\n/g,"<br>");
                                $(this).html(content);
                                $(this).contents().unwrap();
                            });
                              $(".add-newObjetivo").removeAttr("disabled");
                              $('.update').hide();
                              $('.editarObjetivo').show();
                              $('.evaluation').show();
                              $('.update').attr("class", "agregarObjetivo");
                              $('.agregarObjetivo').hide();
                              swal("Actualizado con éxito!", {icon: "success",});*/
                          }else {
                            swal("Error al actualizar!", {
                                    icon: "error",
                                });
                          }
                      }
                  });

                }
            });
        }
    });
});

$(document).ready(function(){
    $(document).on("click", ".editarObjetivo", function() {
        $(this).parents("tr").find("td:not(:last-child)").each(function(i) {
            if (i == '0') {
                var idname = 'txtcategoria';
            } else if (i == '1') {
                var idname = 'txtobjetivo';
            } else if (i == '2') {
                var idname = 'txtimpacto';
            } else if (i == '3') {
                var idname = 'txtacciones';
            } else if (i == '4') {
                var idname = 'txtmetricos';
            } else if (i == '5') {
                var idname = 'txtponderacion';
            } else if (i == '6') {
                var idname = 'txtmeta';
            } else if (i == '7') {
                var idname = 'txtlogro';
            } else if (i == '8') {
                var idname = 'txtresultado';
            } else if (i == '9') {
                var idname = 'evidenciaObjetivos';
            }
            if (idname == 'txtcategoria') {
                $(this).html('<select name="txtcategoria" id="'+ idname +'" class="custom-select"><option selected hidden value="'+ $(this).text() +'">'+ $(this).text() +'</option><option value="Cultura Tecma">Cultura Tecma</option><option value="Estrategia">Estrategia</option><option value="GPTW">GPTW</option><option value="Liderazgo">Liderazgo</option><option value="Servicio al Cliente">Servicio al Cliente</option></select>'); 
            }else{
                $(this).html('<textarea class="form-control" name="updaterec" id="' + idname + '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' + $(this).text() + '</textarea>');   
            }

        });
        $(this).parents("tr").find(".agregarObjetivo, .editarObjetivo").toggle();
        $('.update').show();
        $('.evaluation').hide();
        $('#txtlogro').hide();
        $('#evidenciaObjetivos').hide();
        $("#txtresultado").attr("disabled", "disabled");
        $("#evidenciaObjetivos").hide();
        $(".add-newObjetivo").attr("disabled", "disabled");
        $(this).parents("tr").find(".agregarObjetivo").removeClass("agregarObjetivo").addClass("updateObjetivos");
    });
});

$(document).ready(function(){
    $(document).on("click", ".evaluar", function() {
        var id = $(this).attr("id");
        var string = id;
        var txtlogro = $("#txtlogro").val();
        var data = new FormData();
        data.append("string", string);
        data.append("txtlogro", txtlogro);
        data.append('file', $('#evidenciaObjetivos')[0].files[0]);
        $.ajax({
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "../ajax/objetivos/ajax_logroObjetivo.php",
            method: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function() { $(".progress-bar").width('0%'); },
            data: data,
            success: function(data){
                $("#displaysuccess").html(data);
                $('textarea, input[type="number"]').each(function() {
            var content = $(this).val(); //.replace(/\n/g,"<br>");
            $(this).html(content);
            $(this).contents().unwrap();
        });
                $(".add-newObjetivo").removeAttr("disabled");
                $('.editarObjetivo').show();
                $('.evaluation').show();
                $('.evaluar').attr("class", "agregarObjetivo");
                $('.agregarObjetivo').hide();
            }
        });
    });
});

$(document).ready(function(){
    $(document).on("click", ".evaluation", function() {
        $(this).parents("tr").find("td:not(:last-child)").each(function(i) {
            if (i == '0') {
                var idname = 'txtcategoria';
            } else if (i == '1') {
                var idname = 'txtobjetivo';
            } else if (i == '2') {
                var idname = 'txtimpacto';
            } else if (i == '3') {
                var idname = 'txtacciones';
            } else if (i == '4') {
                var idname = 'txtmetricos';
            } else if (i == '5') {
                var idname = 'txtponderacion';
            } else if (i == '6') {
                var idname = 'txtmeta';
            } else if (i == '7') {
                var idname = 'txtlogro';
            } else if (i == '8') {
                var idname = 'txtresultado';
            } else if (i == '9') {
                var idname = 'evidenciaObjetivos';
            }
            if (idname == 'txtponderacion' || idname == 'txtmeta' || idname == 'txtlogro' || idname == 'txtresultado') {
                $(this).html('<input type="number" name="updaterec" id="' + idname + '" class="form-control" value="' + $(this).text() + '" pattern="^[0-9]+" required>');
            }
            else{
                $(this).html('<textarea class="form-control" name="updaterec" id="' + idname + '" rows="6" style="font-size:13px; margin:0; padding:0;height: 150px;">' + $(this).text() + '</textarea>');
            } 
            if (idname == 'evidenciaObjetivos') {
                $(this).html('<div class="image-upload text-center"><label for="evidenciaObjetivos"><img style="width:50px; height:auto;" src="../img/fileUpload.png"/></label> <input type="file" class="form-control-file" id="'+ idname +'"></div> <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"></div></div>');
            }

        });
        $(this).parents("tr").find(".agregarObjetivo, .editarObjetivo").toggle();
        $("#txtcategoria").attr("disabled", "disabled");
        $("#txtobjetivo").attr("disabled", "disabled");
        $("#txtimpacto").attr("disabled", "disabled");
        $("#txtacciones").attr("disabled", "disabled");
        $("#txtmetricos").attr("disabled", "disabled");
        $("#txtponderacion").attr("disabled", "disabled");
        $("#txtmeta").attr("disabled", "disabled");
        $("#txtresultado").attr("disabled", "disabled");
        $('.evaluation').hide();
        $(this).parents("tr").find(".agregarObjetivo").removeClass("agregarObjetivo").addClass("evaluar");
    });
});

$(document).ready(function(){
    $(document).on("click", "#btnObjetivosCompletos", function() {
        swal({
            title: "¿Está seguro que desea validar resultados finales de los objetivos?",
            text: "Al confirmar, validas que los logros obtenidos son correctos, y estas consciente que ya no se podrán realizar cambios.",
            icon: "warning",
            cancelButtonColor: "#DD6B55",
            content: {
                element: "textarea",
                attributes: {
                  placeholder: "Agregar comentario a tu colaborador acerca de su cumplimiento",
                  className: "txtcomentario",
                  id: "txtcomentario",
              },
          },
          buttons: [
          'No',
          'Confirmar'
          ],
          successMode: true,
      }).then(function(isConfirm) {
          if (isConfirm) {
            var estatus = $("#estatusObjetivos").val();
            var relojC = $("#relojC").val();
            var relojL = $("#relojL").val();
            var año = $("#añoObjetivos").val();
            var comentarioLider = document.getElementById('txtcomentario').value;
            var arrayIDsObjetivos=[];
            $("input[name='id_objetivos[]']").each(function () {
                arrayIDsObjetivos.push($(this).val());
            }).get();

            $.ajax({
                type:"POST",
                data: { estatus: estatus,
                    arrayIDsObjetivos: arrayIDsObjetivos,
                    relojC: relojC,
                    relojL: relojL,
                    comentarioLider: comentarioLider,
                    año: año
                },
                url:"../ajax/objetivos/ajax_objetivoCompleto.php",
                success: function(respuesta){
                    respuesta = respuesta.trim();
                    if (respuesta == 1) {
                        swal("Enviado con éxito!", {icon: "success",});
                    } else{
                        swal("Error al enviar!", {icon: "error",});
                    }
                }
            });
        }
    });
  });
});

