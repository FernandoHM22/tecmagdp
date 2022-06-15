    $('[data-toggle="tooltip"]').tooltip();

    $("#UncheckAll").click(function() {
        $("input[type='checkbox']").prop('checked', false);
    });

    $('.checkboxFortalezas').on('change', function() {
        if ($('.checkboxFortalezas:checked').length > 3) {
            this.checked = false;
        }
    });
    $('.checkboxOportunidades').on('change', function() {
        if ($('.checkboxOportunidades:checked').length > 3) {
            this.checked = false;
        }
    });

    $(".checkboxOportunidades").on("click", function() {
        if ($(".checkboxOportunidades:checked").length > 2 && $(".checkboxFortalezas:checked").length > 2) {
            $('.guardarEvaluacion').prop('disabled', false);
            $('#guardarEvaluacion').prop('disabled', false);
        } else {
            $('.guardarEvaluacion').prop('disabled', true);
            $('#guardarEvaluacion').prop('disabled', true);
        }
    });
    $(".checkboxFortalezas").on("click", function() {
        if ($(".checkboxOportunidades:checked").length > 2 && $(".checkboxFortalezas:checked").length > 2) {
            $('.guardarEvaluacion').prop('disabled', false);
            $('#guardarEvaluacion').prop('disabled', false);
        } else {
            $('.guardarEvaluacion').prop('disabled', true);
            $('#guardarEvaluacion').prop('disabled', true);
        }
    });

    $(".checkboxOportunidades").on("click", function() {
        if ($(".checkboxOportunidades:checked").length > 2 && $(".checkboxFortalezas:checked").length > 2) {
            $('.actualizarEvaluacion').prop('disabled', false);
            $('#actualizarEvaluacion').prop('disabled', false);
        } else {
            $('.actualizarEvaluacion').prop('disabled', true);
            $('#actualizarEvaluacion').prop('disabled', true);
        }
    });
    $(".checkboxFortalezas").on("click", function() {
        if ($(".checkboxOportunidades:checked").length > 2 && $(".checkboxFortalezas:checked").length > 2) {
            $('.actualizarEvaluacion').prop('disabled', false);
            $('#actualizarEvaluacion').prop('disabled', false);
        } else {
            $('.actualizarEvaluacion').prop('disabled', true);
            $('#actualizarEvaluacion').prop('disabled', true);
        }
    });


    $(document).ready(function() {
        $('.continue').on('click', function(e) {
            e.preventDefault();
            var btnID = $(".guardarEvaluacion").val();
            if (btnID == "guardarbtnEvaluacion") {
                swal({
                    title: "¿Está seguro que desea guardar su evaluación?",
                    text: "Al confirmar estarás validando que las 3 debilidades seleccionadas son prioridad para resolver con un plan de desarrollo. ",
                    icon: "warning",
                    cancelButtonColor: "#DD6B55",
                    content: {
                        element: "textarea",
                        attributes: {
                            placeholder: "Agregar comentario a tu colaborador acerca de su evaluación",
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
                        var relojColaborador = $("#relojColaboradorEvaluacion").val();
                        var relojLider = $("#relojLider").val();
                        var arrayFortalezas = [];
                        $("input:checkbox[name*=checkboxFortalezas]:checked").each(function() {
                            arrayFortalezas.push($(this).val());
                        });
                        var arrayOportunidades = [];
                        $("input:checkbox[name*=checkboxOportunidades]:checked").each(function() {
                            arrayOportunidades.push($(this).val());
                        });
                        var personalCargo = $('#cargoColab').val();
                        /* var select1 = $('#select1').val();
                         var select2 = $('#select2').val();
                         var select3 = $('#select3').val();
                         var select4 = $('#select4').val();
                         var select5 = $('#select5').val();
                         var select6 = $('#select6').val();
                         var select7 = $('#select7').val();
                         var select8 = $('#select8').val();
                         var select9 = $('#select9').val();
                         var select10 = $('#select10').val();
                         var select11 = $('#select11').val();
                         var select12 = $('#select12').val();
                         var select13 = $('#select13').val();
                         var select14 = $('#select14').val();
                         var select15 = $('#select15').val();
                         var select16 = $('#select16').val();
                         var select17 = $('#select17').val();
                         var select18 = $('#select18').val();
                         var select19 = $('#select19').val();
                         var select20 = $('#select20').val();*/
                        var comentarioLider = $('#txtcomentario').val();

                        $.ajax({
                            url: '../ajax/evaluacion/ajax_evaluacion.php',
                            method: 'POST',
                            data: {
                                checkboxFortalezas: arrayFortalezas,
                                checkboxOportunidades: arrayOportunidades,
                                relojColaborador: relojColaborador,
                                relojLider: relojLider,
                                personalCargo: personalCargo,
                                // select1: select1,
                                // select2: select2,
                                // select3: select3,
                                // select4: select4,
                                // select5: select5,
                                // select6: select6,
                                // select7: select7,
                                // select8: select8,
                                // select9: select9,
                                // select10: select10,
                                // select11: select11,
                                // select12: select12,
                                // select13: select13,
                                // select14: select14,
                                // select15: select15,
                                // select16: select16,
                                // select17: select17,
                                // select18: select18,
                                // select19: select19,
                                // select20: select20,
                                comentarioLider: comentarioLider
                            },
                            success: function(data) {
                                data = data.trim();
                                if (data == 1) {
                                    $(".continue").attr('disabled', 'disabled');
                                    $("#UncheckAll").hide();
                                    $('[href="#nav-profile"]').trigger('click');
                                    swal({
                                        title: "Colaborador evaluado con éxito!",
                                        text: "Para finalizar el proceso debe llenar la Matriz Potencial/Desempeño",
                                        icon: "success",
                                        timer: 10000
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
            }
        });
    });

    $(document).ready(function() {
        $(".actualizarEvaluacion").on('click', function(e) {
            e.preventDefault();
            swal({
                title: "¿Está seguro que desea actualizar su evaluación?",
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

                    var arrayFortalezas = [];
                    $("input:checkbox[name*=checkboxFortalezas]:checked").each(function() {
                        arrayFortalezas.push($(this).val());
                    });
                    var arrayOportunidades = [];
                    $("input:checkbox[name*=checkboxOportunidades]:checked").each(function() {
                        arrayOportunidades.push($(this).val());
                    });
                    var arrayIDsFortalezas = [];
                    $("input[name='id_fortaleza[]']").each(function() {
                        arrayIDsFortalezas.push($(this).val());
                    }).get();
                    var arrayIDsOportunidades = [];
                    $("input[name='id_oportunidad[]']").each(function() {
                        arrayIDsOportunidades.push($(this).val());
                    }).get();

                    var relojColaborador = $("#relojColaboradorEvaluacion").val();
                    var relojLider = $("#relojLider").val();
                    // var select1 = $('#select1').val();
                    // var select2 = $('#select2').val();
                    // var select3 = $('#select3').val();
                    // var select4 = $('#select4').val();
                    // var select5 = $('#select5').val();
                    // var select6 = $('#select6').val();
                    // var select7 = $('#select7').val();
                    // var select8 = $('#select8').val();
                    // var select9 = $('#select9').val();
                    // var select10 = $('#select10').val();
                    // var select11 = $('#select11').val();
                    // var select12 = $('#select12').val();
                    // var select13 = $('#select13').val();
                    // var select14 = $('#select14').val();
                    // var select15 = $('#select15').val();
                    // var select16 = $('#select16').val();
                    // var select17 = $('#select17').val();
                    // var select18 = $('#select18').val();
                    // var select19 = $('#select19').val();
                    // var select20 = $('#select20').val();

                    $.ajax({
                        url: "../ajax/evaluacion/ajax_Actualizarevaluacion.php",
                        method: 'POST',
                        data: {
                            checkboxFortalezas: arrayFortalezas,
                            checkboxOportunidades: arrayOportunidades,
                            relojColaborador: relojColaborador,
                            relojLider: relojLider,
                            arrayIDsFortalezas: arrayIDsFortalezas,
                            arrayIDsOportunidades: arrayIDsOportunidades
                                // select1: select1,
                                // select2: select2,
                                // select3: select3,
                                // select4: select4,
                                // select5: select5,
                                // select6: select6,
                                // select7: select7,
                                // select8: select8,
                                // select9: select9,
                                // select10: select10,
                                // select11: select11,
                                // select12: select12,
                                // select13: select13,
                                // select14: select14,
                                // select15: select15,
                                // select16: select16,
                                // select17: select17,
                                // select18: select18,
                                // select19: select19,
                                // select20: select20
                        },
                        success: function(data) {
                            data = data.trim();
                            if (data == 1) {
                                $("#actualizarEvaluacion").attr('disabled', 'disabled');
                                $("#UncheckAll").hide();
                                swal("Registrado con éxito!", {
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


    $(document).ready(function() {
        $("#guardarEvaluacion").on('click', function(event) {
            event.preventDefault();
            var pagina = $('#rolPagina').val();
            if (pagina == 'colaborador') {
                var relojColaborador = $("#relojColaboradorEvaluacion").val();
                var arrayFortalezas = [];
                $("input:checkbox[name*=checkboxFortalezas]:checked").each(function() {
                    arrayFortalezas.push($(this).val());
                });
                var arrayOportunidades = [];
                $("input:checkbox[name*=checkboxOportunidades]:checked").each(function() {
                    arrayOportunidades.push($(this).val());
                });

                swal({
                    title: "¿Está seguro que desea guardar su evaluación?",
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
                            url: "../ajax/evaluacion/ajax_autoevaluacion.php",
                            method: 'POST',
                            data: {
                                checkboxFortalezas: arrayFortalezas,
                                checkboxOportunidades: arrayOportunidades,
                                relojColaborador: relojColaborador
                            },
                            success: function(data) {
                                data = data.trim();
                                if (data == 1) {
                                    $("#guardarEvaluacion").attr('disabled', 'disabled');
                                    $("#UncheckAll").hide();
                                    swal("Registrado con éxito!", {
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
            }
        });
    });




    $(document).ready(function() {
        $("#actualizarEvaluacion").on('click', function(event) {
            event.preventDefault();
            var relojColaborador = $("#relojColaboradorEvaluacion").val();
            var relojLider = $("#relojLider").val();
            var pagina = $('#rolPagina').val();
            if (pagina == 'colaborador') {
                var arrayFortalezas = [];
                $("input:checkbox[name*=checkboxFortalezas]:checked").each(function() {
                    arrayFortalezas.push($(this).val());
                });
                var arrayOportunidades = [];
                $("input:checkbox[name*=checkboxOportunidades]:checked").each(function() {
                    arrayOportunidades.push($(this).val());
                });
                var arrayIDsFortalezas = [];
                $("input[name='id_fortaleza[]']").each(function() {
                    arrayIDsFortalezas.push($(this).val());
                }).get();
                var arrayIDsOportunidades = [];
                $("input[name='id_oportunidad[]']").each(function() {
                    arrayIDsOportunidades.push($(this).val());
                }).get();

                swal({
                    title: "¿Está seguro que desea actualizar su evaluación?",
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
                            url: "../ajax/evaluacion/ajax_update_autoevaluacion.php",
                            method: 'POST',
                            data: {
                                checkboxFortalezas: arrayFortalezas,
                                checkboxOportunidades: arrayOportunidades,
                                relojColaborador: relojColaborador,
                                arrayIDsFortalezas: arrayIDsFortalezas,
                                arrayIDsOportunidades: arrayIDsOportunidades
                            },
                            success: function(data) {
                                data = data.trim();
                                if (data == 1) {
                                    $("#actualizarEvaluacion").attr('disabled', 'disabled');
                                    $("#UncheckAll").hide();
                                    swal("Registrado con éxito!", {
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
            }
        });
    });


    // $(document).ready(function() {
    //     $("#select1").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select1").attr("class", color);
    //     });
    //     $("#select2").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select2").attr("class", color);
    //     });
    //     $("#select3").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select3").attr("class", color);
    //     });
    //     $("#select4").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select4").attr("class", color);
    //     });
    //     $("#select5").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select5").attr("class", color);
    //     });
    //     $("#select6").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select6").attr("class", color);
    //     });
    //     $("#select7").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select7").attr("class", color);
    //     });
    //     $("#select8").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select8").attr("class", color);
    //     });
    //     $("#select9").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select9").attr("class", color);
    //     });
    //     $("#select10").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select10").attr("class", color);
    //     });
    //     $("#select11").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select11").attr("class", color);
    //     });
    //     $("#select12").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select12").attr("class", color);
    //     });
    //     $("#select13").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select13").attr("class", color);
    //     });
    //     $("#select14").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select14").attr("class", color);
    //     });
    //     $("#select15").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select15").attr("class", color);
    //     });
    //     $("#select16").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select16").attr("class", color);
    //     });
    //     $("#select17").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select17").attr("class", color);
    //     });
    //     $("#select18").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select18").attr("class", color);
    //     });
    //     $("#select19").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select19").attr("class", color);
    //     });
    //     $("#select20").change(function() {
    //         var color = $("option:selected", this).attr("class");
    //         $("#select20").attr("class", color);
    //     });
    // });