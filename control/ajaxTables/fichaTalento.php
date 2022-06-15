<?php
require('../../conexion/conexion.php');
$no_reloj = $_POST["no_reloj"];

$sql_ficha_talento = mysqli_query($conn, "SELECT * FROM t_fichatalento WHERE reloj_colaborador='$no_reloj'");
if (mysqli_fetch_row($sql_ficha_talento) > 0) {
    $buscar = mysqli_query($conn, "SELECT * FROM registrogdp Reg INNER JOIN t_fichatalento ficha INNER JOIN login_gdp l ON Reg.no_reloj = '$no_reloj' AND Reg.no_reloj = ficha.reloj_colaborador AND Reg.no_reloj = l.no_reloj") or die(mysqli_error($conn));
    $insertar = false;
} else {
    $buscar = mysqli_query($conn, "SELECT * FROM registrogdp  WHERE no_reloj = '$no_reloj'") or die(mysqli_error($conn));
    $insertar = true;
}
if (mysqli_num_rows($buscar) > 0) {
    while ($datos = mysqli_fetch_array($buscar)) {
        $formato_fecha = $datos['edad'];
        $cargoColab = $datos['cargoColab'];
        $nacimiento = new DateTime($formato_fecha);
        $hoy = new DateTime();
        $edad = $hoy->diff($nacimiento);
        $nombres = $datos['nombres'];
        $apellidos = $datos['apellidos'];
        $img = $datos['img'];
        $correo = $datos['correo'];
        $estadoCivil = $datos['estadoCivil'];
        $hijos = $datos['hijos'];
        $LugarResidencia = $datos['lugarResidencia'];
        $nivelEducativo = $datos['nivelEducativo'];
        $carrera = $datos['carreraProfesional'];
        $especialidad = $datos['especialidad'];
        $ingles = $datos['nivelIngles'];
        $imagenPerfil = $datos['img'];
        $puesto = $datos['puesto'];
        $depto = $datos['depto'];
        $no_reloj_supervisor = $datos['no_reloj_supervisor'];
        $antiguedadEmpresa = $datos['antiguedadEmpresa'];
        $fecha_antiguedadEmpresa = new DateTime($antiguedadEmpresa);
        $antiguedad = $hoy->diff($fecha_antiguedadEmpresa);
        $fecha_ingreso = $datos['fecha_ingreso'];
        $fecha_hoy = Date('Y-m-d');
        $dateDifference = abs(
            strtotime($fecha_ingreso) - strtotime($fecha_hoy)
        );
        $years = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(
            ($dateDifference - $years * 365 * 60 * 60 * 24) /
                (30 * 60 * 60 * 24)
        );
        $experienciaUno = $datos['areaExperienciaUno'];
        $experienciaDos = $datos['areaExperienciaDos'];
        $experienciaTres = $datos['areaExperienciaTres'];
        $interesUno = $datos['areaInteresUno'];
        $interesDos = $datos['areaInteresDos'];
        $interesTres = $datos['areaInteresTres'];
        $laboralUno = $datos['trayectoriaLaboralUno'];
        $laboralDos = $datos['trayectoriaLaboralDos'];
        $laboralTres = $datos['trayectoriaLaboralTres'];
        $viaje = $datos['viaje'];
        $residencia = $datos['residencia'];
    }
    mysqli_free_result($buscar);
}
$sql_supervisor = mysqli_query(
    $conn,
    "SELECT nombres, apellidos FROM registrogdp WHERE no_reloj ='$no_reloj_supervisor'"
) or die(mysqli_error($conn));
if (mysqli_num_rows($sql_supervisor) > 0) {
    while ($row = mysqli_fetch_assoc($sql_supervisor)) {
        $nombre_supervisor = $row['nombres'];
        $apellido_supervisor = $row['apellidos'];
    }
    mysqli_free_result($sql_supervisor);
}
?>

<div class="container-perfil">

    <div class="row p-2">
        <div class="col-md-4 text-center seccionImagenPerfil sombras pt-1">

            <input type="file" id="input_imagenPerfil" hidden>
            <a href="#" hidden data-id="<?= $no_reloj; ?>" id="btnConfirmarImagen"><i class="fas fa-check"></i></a>
            <a href="#" hidden id="btnCancelarImagen"><i class="fas fa-times"></i></a>
            <img id="imagenPerfil" src="<?php if (empty($img)) {
                                            echo  '../images/img_default.png';
                                        } else {
                                            echo $img;
                                        } ?>" alt="">
            <div class="DivIEditarImagen">
                <a href="#" data-id="<?= $no_reloj ?>" class="btnEditarImagen"><i class="fas fa-camera"></i></a>
            </div>

            <div style="display:none;" id="upload_imagenPerfil"></div>
            <p class="nombreColaborador"><?= $nombres . ' ' . $apellidos ?></p>
            <div hidden class="row rowNombre">
                <div class="col">
                    <input type="text" disabled id="input_nombre" class="form-control form-control-sm campoDeshabilitado input_editar" value="<?= $nombres ?>">
                </div>
                <div class="col">
                    <input type="text" disabled id="input_apellido" class="form-control form-control-sm campoDeshabilitado input_editar" value="<?= $apellidos ?>">
                </div>
            </div>
            <p class="puesto"> <input type="text" disabled id="input_puesto" class="form-control form-control-sm campoDeshabilitado input_editar" value="<?= $puesto ?>"></p>
            <div class="row seccionDatosExtra justify-content-center">
                <div class="col-md-9">
                    <p><span class="badge badge-primary">Disponibilidad para:</span></p>
                    <form>
                        <div class="form-group row">
                            <label for="input_viajar" class="col-sm-6 col-form-label">Viajar</label>
                            <div class="col">
                                <input type="text" disabled class="form-control form-control-sm campoDeshabilitado input_editar" id="input_viajar_deshabilitado" value="<?= $viaje ?>">
                                <div id="checboxes_viajar" hidden class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-success <?php if ($viaje == 'Si') {
                                                                                echo 'active';
                                                                            } ?>">
                                        <input type="radio" name="input_viajar" id="viajar1" autocomplete="off" value="Si" <?php if ($viaje == 'Si') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>> Si
                                    </label>
                                    <label class="btn btn-outline-danger <?php if ($viaje == 'No') {
                                                                                echo 'active';
                                                                            } ?>">
                                        <input type="radio" name="input_viajar" id="viajar2" autocomplete="off" value="No" <?php if ($viaje == 'No') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_residencia" class="col-sm-6 col-form-label">Cambio Localidad</label>
                            <div class="col">
                                <input type="text" disabled class="form-control form-control-sm campoDeshabilitado input_editar" id="input_residencia_deshabilitado" value="<?= $residencia ?>">
                                <div hidden id="checkboxes_residencia" class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-success <?php if ($residencia == 'Si') {
                                                                                echo 'active';
                                                                            } ?>">
                                        <input type="radio" name="input_residencia" id="residencia1" autocomplete="off" value="Si" <?php if ($residencia == 'Si') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>> Si
                                    </label>
                                    <label class="btn btn-outline-danger <?php if ($residencia == 'No') {
                                                                                echo 'active';
                                                                            } ?>">
                                        <input type="radio" name="input_residencia" id="residencia2" autocomplete="off" value="No" <?php if ($residencia == 'No') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>> No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row pl-2 sombras">
                <div class="col-md-6 seccionInformacionPersonal pt-5 pb-3">
                    <a href="#" class="btnEditarInfo"><i class="fas fa-edit "></i></a>
                    <a href=""><span class="badge badge-info">INFORMACIÓN PERSONAL</span></a>
                    <form>
                        <div class="form-group row">
                            <label for="input_edad" class="col-sm-3 col-form-label">Edad</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control form-control-sm " id="input_edad" value="<?= $edad->y .
                                                                                                                                ' años' ?>">
                                <input hidden type="date" class="form-control form-control-sm input_editar" id="input_fecha_nacimiento" placeholder="dd-mm-yyyy" disabled value="<?= $formato_fecha ?>" min="1950-01-01" max="2030-12-31">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="input_estadoCivil" class="col-sm-3 col-form-label">Estado Civil</label>
                            <div class="col-sm-9">
                                <select disabled class="custom-select custom-select-sm input_editar" id="input_estadoCivil">
                                    <option value="<?= $estadoCivil ?>" hidden><?= $estadoCivil ?></option>
                                    <option value="Sin mencionar">Sin mencionar</option>
                                    <option value="Soltero/a">Soltero/a</option>
                                    <option value="Casado/a">Casado/a</option>
                                    <option value="Union libre o union de hecho">Union libre o union de hecho</option>
                                    <option value="Divorciado/a">Divorciado/a</option>
                                    <option value="Viudo/a">Viudo/a</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_hijos" class="col-sm-3 col-form-label"># Hijos</label>
                            <div class="col-sm-9">
                                <input type="number" disabled class="form-control form-control-sm input_editar" id="input_hijos" value="<?= $hijos ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_lugarResidencia" class="col-sm-3 col-form-label">Residencia</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control form-control-sm input_editar" id="input_lugarResidencia" value="<?= $LugarResidencia ?>">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 seccionLaboral pt-5 pb-3">
                    <a href="#" hidden class="disabled" data-id="<?= $no_reloj; ?>" id="btnConfirmarInfo"><i class="fas fa-check"></i></a>
                    <a href="#" hidden id="btnCancelar"><i class="fas fa-times"></i></a>
                    <input type="text" hidden id="insertarInput" class="form-control" value="<?= $insertar ?>">
                    <a href=""><span class="badge badge-info">LABORAL</span></a>
                    <form>
                        <div class="form-group row">
                            <label for="input_correo" class="col-sm-3 col-form-label">Correo.</label>
                            <div class="col-sm-9">
                                <input type="text" disabled id="input_correo" class="form-control form-control-sm campoDeshabilitado input_editar" value="<?= $correo ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label hidden for="input_fechaIngreso" class="col-sm-4 col-form-label" id="label_inputFechaIngreso">Fecha Ingreso</label>
                            <div id="div_inputFechaIngreso" hidden class="col-sm-8">
                                <input type="date" disabled class="form-control form-control-sm" id="input_fechaIngreso" value="<?= $antiguedadEmpresa ?>">
                            </div>
                            <label for="input_antiguedadEmpresa" class="col-sm-5 col-form-label" id="label_inputAntiguedadEmpresa">Antiguedad Empresa</label>
                            <div id="div_inputAntiguedadEmpresa" class="col-sm-7">
                                <input type="text" disabled class="form-control form-control-sm" value="<?= $antiguedad->y . ' años ' . $antiguedad->m . ' meses' ?>" id="input_antiguedadEmpresa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_depto" class="col-sm-3 col-form-label">Depto.</label>
                            <div class="col-sm-9">
                                <select disabled class="custom-select custom-select-sm input_editar" id="input_depto">
                                    <option value="<?= $depto ?>" hidden><?= $depto ?></option>
                                    <?php
                                    $sql_deptos = mysqli_query(
                                        $conn,
                                        'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                    );
                                    if (mysqli_num_rows($sql_deptos) > 0) {
                                        while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                            echo '<option value="' .
                                                $r['depto'] .
                                                '">' .
                                                $r['depto'] .
                                                '</option>';
                                        }
                                        mysqli_free_result($sql_deptos);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_supervisor" class="col-sm-3 col-form-label">Supervisor</label>
                            <div class="col-sm-9">
                                <select disabled class="custom-select custom-select-sm input_editar" id="input_supervisor">
                                    <option value="<?= $no_reloj_supervisor ?>" hidden><?= $nombre_supervisor . ' ' . $apellido_supervisor ?></option>
                                    <?php
                                    $sql_deptos = mysqli_query(
                                        $conn,
                                        'SELECT l.no_reloj,l.cargoColab,r.no_reloj, r.nombres, r.apellidos FROM login_gdp l INNER JOIN registrogdp r WHERE l.cargoColab ="1" AND l.no_reloj = r.no_reloj ORDER BY r.nombres'
                                    );
                                    if (mysqli_num_rows($sql_deptos) > 0) {
                                        while ($d = mysqli_fetch_assoc($sql_deptos)) {
                                            echo '<option value="' .
                                                $d['no_reloj'] .
                                                '">' .
                                                $d['nombres'] .
                                                ' ' .
                                                $d['apellidos'] .
                                                '</option>';
                                        }
                                        mysqli_free_result($sql_deptos);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input_esLider" class="col-sm-3 col-form-label">¿Es lider?</label>
                            <div class="col-sm-9">
                                <select disabled class="custom-select custom-select-sm input_editar" id="input_esLider">
                                    <option value="<?= $cargoColab ?>" hidden><?php if ($cargoColab == 1) {
                                                                                    echo 'Si';
                                                                                } else {
                                                                                    echo 'No';
                                                                                } ?></option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row row pl-2 pt-2 sombras">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 seccionEducacion pt-1 pb-3">
                            <a href=""><span class="badge badge-info">ESTUDIOS</span></a>
                            <form>
                                <div class="form-group row">
                                    <label for="input_gradoEstudio" class="col-sm-6 col-form-label">Ultimo grado de estudios</label>
                                    <div class="col-sm-6">
                                        <select disabled class="custom-select custom-select-sm input_editar" id="input_gradoEstudio">
                                            <option hidden value="<?= $nivelEducativo ?>"><?= $nivelEducativo ?></option>
                                            <option value="Preescolar">Preescolar</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Preparatoria/Nivel Media Superior">Preparatoria/Nivel Media Superior</option>
                                            <option value="Nivel superior/Universidad"> Nivel superior/Universidad</option>
                                            <option value="Licenciatura">Licenciatura
                                            <option>
                                            <option value="Maestría">Maestría</option>
                                            <option value="Doctorado ">Doctorado </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input_especialidad" class="col-sm-3 col-form-label">Especialidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" disabled class="form-control form-control-sm input_editar" id="input_especialidad" value="<?= $especialidad ?>" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input_ingles" class="col-sm-3 col-form-label">Nivel Ingles</label>
                                    <div class="col-sm-9">
                                        <select disabled class="custom-select custom-select-sm input_editar" id="input_ingles">
                                            <option hidden value="<?= $ingles ?>"><?= $ingles ?></option>
                                            <option value="Nulo">Nulo</option>
                                            <option value="Básico">Básico</option>
                                            <option value="Intermedio">Intermedio</option>
                                            <option value="Avanzado">Avanzado</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 seccionIntereses pt-1 pb-3">
                            <a href="#"><span class="badge badge-info">ÁREA DE INTERES</span></a>
                            <form>
                                <div class="form-group row">
                                    <label for="input_interesUno" class="col-sm-1 col-form-label col-form-label-sm">1. </label>
                                    <div class="col-sm-11">
                                        <select disabled class="custom-select custom-select-sm input_editar" id="input_interesUno">
                                            <option value="<?= $interesUno ?>"><?= $interesUno ?></option>
                                            <?php
                                            $sql_deptos = mysqli_query(
                                                $conn,
                                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                            );
                                            if (mysqli_num_rows($sql_deptos) > 0) {
                                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                    echo '<option value="' .
                                                        $r['depto'] .
                                                        '">' .
                                                        $r['depto'] .
                                                        '</option>';
                                                }
                                                mysqli_free_result($sql_deptos);
                                            }
                                            ?><?php
                                                $sql_deptos = mysqli_query(
                                                    $conn,
                                                    'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                                );
                                                if (mysqli_num_rows($sql_deptos) > 0) {
                                                    while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                        echo '<option value="' .
                                                            $r['depto'] .
                                                            '">' .
                                                            $r['depto'] .
                                                            '</option>';
                                                    }
                                                    mysqli_free_result($sql_deptos);
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input_interesDos" class="col-sm-1 col-form-label col-form-label-sm">2. </label>
                                    <div class="col-sm-11">
                                        <select disabled class="custom-select custom-select-sm input_editar" id="input_interesDos">
                                            <option value="<?= $interesDos ?>"><?= $interesDos ?></option>
                                            <?php
                                            $sql_deptos = mysqli_query(
                                                $conn,
                                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                            );
                                            if (mysqli_num_rows($sql_deptos) > 0) {
                                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                    echo '<option value="' .
                                                        $r['depto'] .
                                                        '">' .
                                                        $r['depto'] .
                                                        '</option>';
                                                }
                                                mysqli_free_result($sql_deptos);
                                            }
                                            ?><?php
                                                $sql_deptos = mysqli_query(
                                                    $conn,
                                                    'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                                );
                                                if (mysqli_num_rows($sql_deptos) > 0) {
                                                    while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                        echo '<option value="' .
                                                            $r['depto'] .
                                                            '">' .
                                                            $r['depto'] .
                                                            '</option>';
                                                    }
                                                    mysqli_free_result($sql_deptos);
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input_interesTres" class="col-sm-1 col-form-label col-form-label-sm">3. </label>
                                    <div class="col-sm-11">
                                        <select disabled class="custom-select custom-select-sm input_editar" id="input_interesTres">
                                            <option value="<?= $interesTres ?>"><?= $interesTres ?></option>
                                            <?php
                                            $sql_deptos = mysqli_query(
                                                $conn,
                                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                            );
                                            if (mysqli_num_rows($sql_deptos) > 0) {
                                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                    echo '<option value="' .
                                                        $r['depto'] .
                                                        '">' .
                                                        $r['depto'] .
                                                        '</option>';
                                                }
                                                mysqli_free_result($sql_deptos);
                                            }
                                            ?><?php
                                                $sql_deptos = mysqli_query(
                                                    $conn,
                                                    'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                                                );
                                                if (mysqli_num_rows($sql_deptos) > 0) {
                                                    while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                                        echo '<option value="' .
                                                            $r['depto'] .
                                                            '">' .
                                                            $r['depto'] .
                                                            '</option>';
                                                    }
                                                    mysqli_free_result($sql_deptos);
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pl-2 pr-2 pt-1 sombras">
        <div class="col-md-8 seccionTrayectoria pt-2 pb-3">
            <a href="#"><span class="badge badge-info">TRAYECTORIA LABORAL</span></a>
            <form>
                <div class="form-group row">
                    <label for="input_trayectoriaUno" class="col-sm-1 col-form-label col-form-label-sm">1. </label>
                    <div class="col-sm-11">
                        <input type="text" disabled class="form-control form-control-sm input_editar" id="input_trayectoriaUno" value="<?= $laboralUno ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_trayectoriaDos" class="col-sm-1 col-form-label col-form-label-sm">2. </label>
                    <div class="col-sm-11">
                        <input type="text" disabled class="form-control form-control-sm input_editar" id="input_trayectoriaDos" value="<?= $laboralDos ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_trayectoriaTres" class="col-sm-1 col-form-label col-form-label-sm">3. </label>
                    <div class="col-sm-11">
                        <input type="text" disabled class="form-control form-control-sm input_editar" id="input_trayectoriaTres" value="<?= $laboralTres ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 ml-auto seccionExperiencia pt-2 pb-3">
            <a href="#"><span class="badge badge-info">ÁREA DE EXPERIENCIA</span></a>
            <form>
                <div class="form-group row">
                    <label for="input_experienciaUno" class="col-sm-1 col-form-label col-form-label-sm">1. </label>
                    <div class="col-sm-11">
                        <select disabled class="custom-select custom-select-sm input_editar" id="input_experienciaUno">
                            <option value="<?= $experienciaUno ?>"><?= $experienciaUno ?></option>
                            <?php
                            $sql_deptos = mysqli_query(
                                $conn,
                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                            );
                            if (mysqli_num_rows($sql_deptos) > 0) {
                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                    echo '<option value="' .
                                        $r['depto'] .
                                        '">' .
                                        $r['depto'] .
                                        '</option>';
                                }
                                mysqli_free_result($sql_deptos);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_experienciaDos" class="col-sm-1 col-form-label col-form-label-sm">2. </label>
                    <div class="col-sm-11">
                        <select disabled class="custom-select custom-select-sm input_editar" id="input_experienciaDos">
                            <option value="<?= $experienciaDos ?>"><?= $experienciaDos ?></option>
                            <?php
                            $sql_deptos = mysqli_query(
                                $conn,
                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                            );
                            if (mysqli_num_rows($sql_deptos) > 0) {
                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                    echo '<option value="' .
                                        $r['depto'] .
                                        '">' .
                                        $r['depto'] .
                                        '</option>';
                                }
                                mysqli_free_result($sql_deptos);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_experienciaTres" class="col-sm-1 col-form-label col-form-label-sm">3. </label>
                    <div class="col-sm-11">
                        <select disabled class="custom-select custom-select-sm input_editar" id="input_experienciaTres">
                            <option value="<?= $experienciaTres ?>"><?= $experienciaTres ?></option>
                            <?php
                            $sql_deptos = mysqli_query(
                                $conn,
                                'SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC'
                            );
                            if (mysqli_num_rows($sql_deptos) > 0) {
                                while ($r = mysqli_fetch_assoc($sql_deptos)) {
                                    echo '<option value="' .
                                        $r['depto'] .
                                        '">' .
                                        $r['depto'] .
                                        '</option>';
                                }
                                mysqli_free_result($sql_deptos);
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("form :input").on("change input", function() {
        $("#btnConfirmarInfo").removeClass("disabled");
    });

    $('.btnEditarInfo').on('click', function(e) {
        e.preventDefault();
        $(this).attr('hidden', true);
        $('#btnConfirmarInfo, #btnCancelar').attr('hidden', false);
        $('.btnEditarImagen').addClass('disabled');
        $('.input_editar').removeAttr('disabled');
        $('#input_edad').attr('hidden', true);
        $('.nombreColaborador').attr('hidden', true);
        $('.rowNombre').attr('hidden', false);
        $('#input_fecha_nacimiento').attr('hidden', false);
        $('#label_inputFechaIngreso, #div_inputFechaIngreso').attr('hidden', false);
        $('#input_fechaIngreso').attr('disabled', false);
        $('#label_inputAntiguedadEmpresa, #div_inputAntiguedadEmpresa').attr('hidden', true);
        $('#input_antiguedadEmpresa').attr('disabled', true);
        $('#input_viajar_deshabilitado').attr('hidden', true);
        $('#checboxes_viajar').removeAttr('hidden');
        $('#input_residencia_deshabilitado').attr('hidden', true);
        $('#checkboxes_residencia').removeAttr('hidden');
    });

    $('#btnCancelar').on('click', function(e) {
        e.preventDefault();
        $(this).attr('hidden', true);
        cancelar();
    });

    $('#btnCancelarImagen').on('click', function(e) {
        e.preventDefault();
        $('#btnConfirmarImagen, #btnCancelarImagen').attr('hidden', true);
        $('.btnEditarImagen, .btnEditarInfo').attr('hidden', false);
        $('#imagenPerfil').attr('hidden', false);
        $('#upload_imagenPerfil').css('display', 'none');
        cancelar();
    });

    function cancelar() {
        $('#btnConfirmarInfo').attr('hidden', true).addClass('disabled');
        $('.btnEditarImagen').removeClass('disabled');
        $('.btnEditarInfo').attr('hidden', false);
        $('.input_editar').attr('disabled', true);
        $('#input_edad').attr('hidden', false);
        $('.nombreColaborador').attr('hidden', false);
        $('.rowNombre').attr('hidden', true);
        $('#input_fecha_nacimiento').attr('hidden', true);
        $('#label_inputFechaIngreso, #div_inputFechaIngreso').attr('hidden', true);
        $('#input_fechaIngreso').attr('disabled', true);
        $('#label_inputAntiguedadEmpresa, #div_inputAntiguedadEmpresa').removeAttr('hidden');
        $('#input_viajar_deshabilitado').removeAttr('hidden');
        $('#checboxes_viajar').attr('hidden', true);
        $('#input_residencia_deshabilitado').removeAttr('hidden');
        $('#checkboxes_residencia').attr('hidden', true);
    }

    $(document).on("click", ".btnEditarImagen", function(e) {
        e.preventDefault();
        $('#btnConfirmarImagen, #btnCancelarImagen').attr('hidden', false);
        $('.btnEditarInfo').attr('hidden', true);
        $(this).attr('hidden', true);
        $("#input_imagenPerfil").click();
        $('#imagenPerfil').attr('hidden', true);
        $('#upload_imagenPerfil').css('display', 'block');
    });

    var resize = $("#upload_imagenPerfil").croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: {
            // Default { width: 100, height: 100, type: 'square' }
            width: 130,
            height: 130,
            type: "circle", //square
        },
        boundary: {
            width: 150,
            height: 150,
        },
    });

    $("#input_imagenPerfil").on("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            resize
                .croppie("bind", {
                    url: e.target.result,
                })
                .then(function() {
                    console.log("jQuery bind complete");
                });
        };
        reader.readAsDataURL(this.files[0]);
    });

    $('#btnConfirmarInfo').on('click', function(e) {
        e.preventDefault();
        var no_reloj = $(this).data('id');
        var insertar = $('#insertarInput').val();
        var nombre = $('#input_nombre').val();
        var apellidos = $('#input_apellido').val();
        var correo = $('#input_correo').val();
        var puesto = $('#input_puesto').val();
        var viajar = $("input[name='input_viajar']:checked").val();
        var residencia = $("input[name='input_residencia']:checked").val();
        var fechaNacimiento = $('#input_fecha_nacimiento').val();
        var estadoCivil = $('#input_estadoCivil option:selected').val();
        var hijos = $('#input_hijos').val();
        var lugarResidencia = $('#input_lugarResidencia').val();
        var fechaIngreso = $('#input_fechaIngreso').val();
        var depto = $('#input_depto option:selected').val();
        var supervisor = $('#input_supervisor option:selected').val();
        var cargoColab = $('#input_esLider option:selected').val();
        var gradoEstudios = $('#input_gradoEstudio option:selected').val();
        var especialidad = $('#input_especialidad').val();
        var ingles = $('#input_ingles option:selected').val();
        var interesUno = $('#input_interesUno option:selected').val();
        var interesDos = $('#input_interesDos option:selected').val();
        var interesTres = $('#input_interesTres option:selected').val();
        var trayectoriaUno = $('#input_trayectoriaUno').val();
        var trayectoriaDos = $('#input_trayectoriaDos').val();
        var trayectoriaTres = $('#input_trayectoriaTres').val();
        var experienciaUno = $('#input_experienciaUno option:selected').val();
        var experienciaDos = $('#input_experienciaDos option:selected').val();
        var experienciaTres = $('#input_experienciaTres option:selected').val();

        var datosPerfil = new FormData();
        datosPerfil.append("insertar", insertar);
        datosPerfil.append("no_reloj", no_reloj);
        datosPerfil.append("nombre", nombre);
        datosPerfil.append("apellidos", apellidos);
        datosPerfil.append("correo", correo);
        datosPerfil.append("puesto", puesto);
        datosPerfil.append("viajar", viajar);
        datosPerfil.append("residencia", residencia);
        datosPerfil.append("fechaNacimiento", fechaNacimiento);
        datosPerfil.append("estadoCivil", estadoCivil);
        datosPerfil.append("hijos", hijos);
        datosPerfil.append("lugarResidencia", lugarResidencia);
        datosPerfil.append("fechaIngreso", fechaIngreso);
        datosPerfil.append("depto", depto);
        datosPerfil.append("supervisor", supervisor);
        datosPerfil.append("cargoColab", cargoColab);
        datosPerfil.append("gradoEstudios", gradoEstudios);
        datosPerfil.append("especialidad", especialidad);
        datosPerfil.append("ingles", ingles);
        datosPerfil.append("interesUno", interesUno);
        datosPerfil.append("interesDos", interesDos);
        datosPerfil.append("interesTres", interesTres);
        datosPerfil.append("trayectoriaUno", trayectoriaUno);
        datosPerfil.append("trayectoriaDos", trayectoriaDos);
        datosPerfil.append("trayectoriaTres", trayectoriaTres);
        datosPerfil.append("experienciaUno", experienciaUno);
        datosPerfil.append("experienciaDos", experienciaDos);
        datosPerfil.append("experienciaTres", experienciaTres);


        $.ajax({
            url: '../../ajax/perfil/ajax_editarPerfil.php',
            type: 'POST',
            processData: false,
            cache: false,
            contentType: false,
            data: datosPerfil,
            success: function(data) {
                var data = data.trim();
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado con éxito!',
                        timer: 800
                    });
                    $('#btnCancelar').attr('hidden', true);
                    cancelar();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar!',
                        timer: 800
                    });
                }
            }
        });

    });

    $('#btnConfirmarImagen').on('click', function(e) {
        e.preventDefault();
        var no_reloj = $(this).data('id');
        resize
            .croppie("result", {
                type: "canvas",
                size: "viewport",
            })
            .then(function(img) {
                $.ajax({
                    url: "../../ajax/perfil/ajax_editarFoto.php",
                    type: "POST",
                    data: {
                        imagenPerfil: img,
                        no_reloj: no_reloj,
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
            });
    });
</script>