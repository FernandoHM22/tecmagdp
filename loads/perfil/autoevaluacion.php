<?php
include('../../conexion/conexion.php');
$no_reloj = $_POST['no_reloj'];
// $colaboradores = "SELECT * FROM registrogdp WHERE no_reloj_supervisor = '$reloj_supervisor' ORDER BY nombres ASC";
// $resultado = mysqli_query($conn, $colaboradores) or die(mysqli_error($conn));
// if (mysqli_num_rows($resultado) > 0) {
//     while ($datos = mysqli_fetch_array($resultado)) {
//         $no_reloj_col = $datos['no_reloj'];
//         $nombres = $datos['nombres'];
//         $apellidos = $datos['apellidos'];
//     }
// }
?>
<div class="row">
    <div class="col-md-12 mt-1 colTituloAutoevaluacion">
        <div class="alert alert-warning alert-dismissible tituloAutoevaluacion fade show" role="alert">
            <strong>Autoevaluación</strong>
            <p>Instrucciones: seleccione 3 fortalezas y 3 oportunidades de las 20 categorias.</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-responsive mt-3">
            <table class="table table-sm tablaAutoEvaluacion">
                <thead>
                    <tr>
                        <th width="30%"></th>
                        <th width="35%">Fortaleza</th>
                        <th width="40%">Oportunidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. Relación Con Superior</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Con Superior">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Con Superior">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2. Relación Con Colegas</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Con Colegas">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Con Colegas">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3. Relación Con Subordinados</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Con Subordinados">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Con Subordinados">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4. Relación Con Asesores</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Con Asesores">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Con Asesores">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5. Relación Grupos De Trabajo</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Grupos De Trabajo">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Grupos De Trabajo">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>6. Relación Con Clientes</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación Con Clientes">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación Con Clientes">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>7. Trato Publico General</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trato Con Publico En General">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trato Con Publico En General">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>8. Creatividad</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Creatividad">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Creatividad">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>9. Fijación De Objetivos</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Fijación De Objetivos">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Fijación De Objetivos">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>10. Planeación</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Planeación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Planeación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>11. Manejo Del Cambio</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo Del Cambio">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo Del Cambio">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>12. Implementación</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Implementación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Implementación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>13. Controles</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Controles">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Controles">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>14. Evaluación</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Evaluación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Evaluación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>15. Productividad</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Productividad">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Productividad">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>16. Comunicación</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Comunicación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Comunicación">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>17. Manejo De Conflictos</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo De Conflictos">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo De Conflictos">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>18. Manejo De Errores</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo De Errores">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo De Errores">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>19. Conducción De Juntas</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Conducción De Juntas">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Conducción De Juntas">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>20. Trabajo En Equipo</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trabajo En Equipo">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trabajo En Equipo">
                                    <div class="custom-control-label"></div>
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card cardAutoevaluacion">
                    <div class="card-header">
                        <h5 class="card-title">Fortalezas</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <?php
                            $sql_fortalezas = mysqli_query($conn, "SELECT id_fortaleza, fortaleza FROM t_fortalezas WHERE no_reloj ='$no_reloj' AND reloj_lider IS NULL");
                            while ($data = mysqli_fetch_assoc($sql_fortalezas)) {
                                $fortaleza = 1;
                                echo '<li>
                                <div class="input-group"><select class="custom-select inputFortaleza">
                                <option  value="' . $data['fortaleza'] . '">' . $data['fortaleza'] . '</option>
                                <option value="Relación Con Superior">Relación Con Superior</option>
                                <option value="Relación Con Colegas">Relación Con Colegas</option>
                                <option value="Relación Con Subordinados">Relación Con Subordinados</option>
                                <option value="Relación Con Asesores">Relación Con Asesores</option>
                                <option value="Relación Grupos De Trabajo">Relación Grupos De Trabajo</option>
                                <option value="Relación Con Clientes">Relación Con Clientes</option>
                                <option value="Trato Publico General">Trato Publico General</option>
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
                            </select><span class="input-group-text"><a href="#" class="btnActualizarEvaluacion disabled" data-id="' . $data['id_fortaleza'] . '" data-name="fortaleza" ><i class="fas fa-check"></i></a></span></div></li>';
                            }
                            mysqli_free_result($sql_fortalezas);
                            ?>
                        </ul>
                        <span id="spanFortalezas"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card cardAutoevaluacion">
                    <div class="card-header">
                        <h5 class="card-title">Oportunidades</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <?php
                            $sql_oportunidades = mysqli_query($conn, "SELECT id_oportunidad, oportunidad FROM t_oportunidades WHERE no_reloj ='$no_reloj' AND reloj_lider IS NULL");
                            while ($data = mysqli_fetch_assoc($sql_oportunidades)) {
                                echo '<li>
                                <div class="input-group"><select class="custom-select inputOportunidad">
                                <option  value="' . $data['oportunidad'] . '">' . $data['oportunidad'] . '</option>
                                <option value="Relación Con Superior">Relación Con Superior</option>
                                <option value="Relación Con Colegas">Relación Con Colegas</option>
                                <option value="Relación Con Subordinados">Relación Con Subordinados</option>
                                <option value="Relación Con Asesores">Relación Con Asesores</option>
                                <option value="Relación Grupos De Trabajo">Relación Grupos De Trabajo</option>
                                <option value="Relación Con Clientes">Relación Con Clientes</option>
                                <option value="Trato Publico General">Trato Publico General</option>
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
                            </select><span class="input-group-text"><a href="#" class="btnActualizarEvaluacion disabled" data-id="' . $data['id_oportunidad'] . '" data-name="oportunidad"><i class="fas fa-check"></i></a></span></div></li>';
                            }
                            mysqli_free_result($sql_oportunidades);
                            ?>
                        </ul>
                        <span id="spanOportunidades"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <a href="#" class="float-right" id="btnGuardarAutoevaluacion"><i class="fas fa-plus-circle"></i> Guardar Auto-evaluación</a>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row pb-4">
    <div class="col-md-8">
        <a href="#" class="btnFichaTalento"> <i class="fas fa-angle-left"></i> Ficha Talento</a>
    </div>
</div> -->

<script>
    var existeFortaleza = '<?= $fortaleza ?>';
    if (existeFortaleza == 1) {
        $('.checkboxFortalezas').attr('disabled', true);
        $('.checkboxOportunidades').attr('disabled', true);
        $('#btnGuardarAutoevaluacion').css('display', 'none');
    }

    $(document).on('click', '.btnFichaTalento', function(e) {
        e.preventDefault();
        $(this).attr('hidden', true);
        $('.btnAutoevaluacion').attr('hidden', false);
        $('.container-perfil').attr('hidden', false);
        $('.container-autoevaluacion').attr('hidden', true);
    });
    var limit = 3;
    $("input.checkboxFortalezas").on('click', function(evt) {
        if ($('.checkboxFortalezas:checked').length > limit) {
            this.checked = false;
        }
        var fortalezas = "<ul>";
        $(".checkboxFortalezas:checked").each(function() {
            fortalezas += "<li><input type='text' disabled class='form-control form-control-sm' value='" + $(this).val() + "'></li>";
        });
        fortalezas += "</ul>";
        $("#spanFortalezas").html(fortalezas);
    });
    $("input.checkboxOportunidades").on('click', function(evt) {
        if ($('.checkboxOportunidades:checked').length > limit) {
            this.checked = false;
        }
        var oportunidades = "<ul>";
        $(".checkboxOportunidades:checked").each(function() {
            oportunidades += "<li><input type='text' disabled class='form-control form-control-sm' value='" + $(this).val() + "'></li>";
        });
        oportunidades += "</ul>";
        $("#spanOportunidades").html(oportunidades);
    });

    $('#btnGuardarAutoevaluacion').on('click', function(e) {
        e.preventDefault();
        var no_reloj = '<?php echo $no_reloj ?>';
        var arrayFortalezas = [];
        $("input:checkbox[name*=checkboxFortalezas]:checked").each(function() {
            arrayFortalezas.push($(this).val());
        });
        var arrayOportunidades = [];
        $("input:checkbox[name*=checkboxOportunidades]:checked").each(function() {
            arrayOportunidades.push($(this).val());
        });

        $.ajax({
            url: '../../ajax/evaluacion/ajax_autoevaluacion.php',
            method: 'POST',
            data: {
                checkboxFortalezas: arrayFortalezas,
                checkboxOportunidades: arrayOportunidades,
                no_reloj: no_reloj,
            },
            success: function(data) {
                var data = data.trim();
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado con éxito!',
                        text: 'Has completado el proceso ahora puede navegar en el contenido (Objetivos, Plan de Desarrollo e ingles)',
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al registrar autoevaluación!',
                        timer: 90
                    });
                }
            }
        });
    });

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

    $('.inputFortaleza').on('change', function() {
        $("select").not(this).css("pointer-events", "none");
        $(this).parent('.input-group').find('.input-group-text').css('background', 'green');
        var inputGroup = $(this).parent('.input-group').find('.btnActualizarEvaluacion');
        $(inputGroup).removeClass('disabled');
    });
    $('.inputOportunidad').on('change', function() {
        $("select").not(this).css("pointer-events", "none");
        $(this).parent('.input-group').find('.input-group-text').css('background', 'green');
        var inputGroup = $(this).parent('.input-group').find('.btnActualizarEvaluacion');
        $(inputGroup).removeClass('disabled');
    });

    $('.btnActualizarEvaluacion').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tipo = $(this).data('name');
        var inputValue = $(this).parents('.input-group').find('select option:selected').val();
        $.ajax({
            url: '../../ajax/evaluacion/ajax_ActualizarAutoEvaluacion.php',
            type: 'POST',
            data: {
                id: id,
                tipo: tipo,
                inputValue: inputValue
            },
            success: function(data) {
                var data = data.trim();
                if (data == 1) {
                    $("select").css("pointer-events", "cursor");
                    Swal.fire({
                        icon: 'success',
                        text: 'Actualizado con éxito!',
                        timer: 900
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Error al actualizar!',
                        timer: 900
                    });
                }
            }
        });
    });
</script>