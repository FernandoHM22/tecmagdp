<?php
setlocale(LC_TIME, 'es_MX.UTF-8');
$page = "editInfo";
require('../conexion/conexion.php');
$reloj = $_GET["no_reloj"];
$modal = $_GET["dataModal"];
?>

<body>
	<!-- <?php
			$consultaedit  = mysqli_query($conn, "SELECT no_reloj, nombres, apellidos, puesto, correo,depto, img, no_reloj_supervisor, liderArea, region FROM registrogdp  WHERE no_reloj = '$reloj'");
			if (mysqli_num_rows($consultaedit) > 0) {
				while ($datos = mysqli_fetch_array($consultaedit)) {
					$relojSup = $datos['no_reloj_supervisor'];
					$liderArea = $datos['liderArea'];
			?>
			<form class="form-info" id="formInformacionPersonal" action="../actions/editarInfo.php" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<fieldset class="informacionPersonal-border">
						<div class="form-row col-md-12">
							<div class="form-group col-md-12">
								<div class="change-message"><i class="far fa-save"></i> Tienes cambios sin guardar.</div>
							</div>
						</div>
						<div id="exitoInfoPersonal" class="col-md-12 col-sm-12 mt-1 d-block text-center"></div>
					</fieldset>
					<?php
				}
				mysqli_free_result($consultaedit);
			} ?>
		</form> -->
	<?php

	$result = mysqli_query($conn, "SELECT * FROM registrogdp Reg LEFT JOIN t_fichatalento ficha ON Reg.no_reloj = ficha.reloj_colaborador WHERE Reg.no_reloj = '$reloj'") or die(mysqli_error($conn));
	$mostrar = $result->fetch_assoc();
	?>
	<form action="../actions/editarInfo.php" method="POST" id="formFichaTalento">
		<fieldset class="mt-4 fichaTalento-border">
			<legend class="informacionPersonal text-center">FICHA DE TALENTO <br></legend>

			<div>
				<p class="text-center notaFichaTalento"> <span class="fas fa-info-circle"></span> INSTRUCCIONES: <span id="text_instructions_edit_info"> Para capturar información debe dar clic en el botón: <button type="button" class="btn btn-sm" id="editarInformacion">Editar información</button>. </span> <span id="text_confirm_cancel_edit_info"> Para confirmar cambios clic aqui <button type="submit" class="btn btn-sm btn-success" id="guardarInfoPersonal" hidden disabled><i class="fas fa-check"></i></button>, para cancelar aqui <button type="button" class="btn btn-sm btn-danger " id="btnCancelar" hidden><i class="fas fa-times"></i></button> </span></p>
			</div>

			<section class="signup-step-container">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-12">
							<div class="wizard">
								<div class="wizard-inner">
									<div class="connecting-line"></div>
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Ficha Talento</i></a>
										</li>
										<?php
										if ($modal == '#modalActualizar') { ?>
											<li role="presentation" class="disabled">
												<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Auto-Evaluación</i></a>
											</li>
										<?php } ?>
									</ul>
								</div>
								<div class="tab-content" id="main_form">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<div class="form-row">
											<div class="col-md-12 mb-3">

											</div>
											<div class="col-md-12" id="labelNotaFicha" hidden><label style="color: darkred; font-weight: 600; font-size:13px; ">Nota: Se recomienda actualizar los campos resaltados en amarillo.</label>
											</div>
											<div class="form-group col-md-4">
												<div class="form-inline">
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Nombre(s):</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" disabled name="name" value="<?= $mostrar['nombres'] ?>">
														<input type="text" hidden class="form-control form-control-sm" disabled name="no_reloj" value="<?= $_GET["no_reloj"] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Apellido(s):</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" disabled name="lastname" value="<?= $mostrar['apellidos'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Correo:</label>
														<input type="email" class="form-control form-control-sm col-md-8 col-sm-4" disabled name="email" value="<?= $mostrar['correo'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Puesto:</label>
														<textarea readonly="" name="puesto" style="background: transparent;" class="form-control form-control-sm col-md-8 col-sm-4  textareaPuesto" disabled><?= $mostrar['puesto'] ?></textarea>
													</div>
													<?php if ($modal != '#modalActualizar') {	?>
														<div class="col-md-12 form-group mt-1">
															<label class="col-md-4 col-sm-4 col-form-label d-block">Personal a Cargo</label>
															<select class="custom-select col-md-8" name="personalCargo" id="personalCargo" disabled>
																<?php
																$cargoColab = $conn->query("SELECT * FROM login_gdp WHERE no_reloj = '$reloj'");
																$r = $cargoColab->fetch_assoc();
																?>
																<option selected hidden="" value="<?php echo $r['cargoColab']; ?>"><?php if ($r['cargoColab'] == '1') {
																																		echo "Si";
																																	} else {
																																		echo "No";
																																	} ?></option>
																<option value="<?php if ($r['cargoColab'] == '1') {
																					echo '0';
																				} else {
																					echo '1';
																				} ?>"><?php if ($r['cargoColab'] == '1') {
																							echo "No";
																						} else {
																							echo "Si";
																						} ?></option>
															</select>
														</div>
													<?php } ?>
												</div>
											</div>

											<div class="form-group col-md-4">
												<div class="form-inline">
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Departamento:</label>
														<select name="depto" id="depto" class="custom-select col-md-8 col-sm-4" disabled>
															<option selected hidden value="<?= $mostrar['depto'] ?>"><?= $mostrar['depto'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Compras">Compras</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovation">Culture Innovation</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Desarrollo de Negocios">Desarrollo de Negocios</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="TTS">TTS</option>
														</select>
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label d-block">Supervisor</label>
														<select class="custom-select col-md-8" name="supervisor" id="supervisor" disabled>
															<?php
															$sqlLider = $conn->query("SELECT nombres, apellidos FROM registrogdp WHERE no_reloj = '$relojSup'");
															$datosLider = $sqlLider->fetch_assoc();
															?>
															<option hidden value="<?php echo $relojSup; ?>" selected><?= $datosLider['nombres']; ?> <?= $datosLider['apellidos']; ?></option>
															<?php
															$sqlSupervisores = mysqli_query($conn, "SELECT * FROM registrogdp where cargoColab = '1' ORDER BY nombres");
															if (mysqli_num_rows($sqlSupervisores) > 0) {
																while ($dato = mysqli_fetch_array($sqlSupervisores)) {
															?>
																	<option value="<?= $dato['no_reloj'] ?>"><?= $dato['nombres'] ?> <?= $dato['apellidos'] ?></option>
															<?php }
															}
															?>
														</select>
													</div>
													<div class="col-md-12 form-group">
														<div class="custom-file mt-2">
															<input type="file" class="custom-file-input" id="customFile" disabled="" name="file" accept="image/*">
															<label class="custom-file-label" for="customFile">Cambiar Fotografia...</label>
														</div>
													</div>
													<?php if ($modal != '#modalActualizar') {	?>
														<div class="col-md-12 form-group mt-1">
															<label class="col-md-4 col-sm-4 col-form-label d-block">Gerente</label>
															<select class="custom-select col-md-8" name="gerente" id="gerente" disabled="">
																<option value="">Ninguno</option>
																<?php
																$sqlLiderArea = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$liderArea'");
																$datosLiderArea = $sqlLiderArea->fetch_assoc();
																?>
																<option selected hidden value="<?php echo $datosLiderArea['no_reloj']; ?>"><?php echo $datosLiderArea['nombres']; ?> <?php echo $datosLiderArea['apellidos']; ?></option>
																<?php
																$sqlSupervisores = mysqli_query($conn, "SELECT * FROM registrogdp where cargoColab = '1' ORDER BY nombres");
																if (mysqli_num_rows($sqlSupervisores) > 0) {
																	while ($dato = mysqli_fetch_array($sqlSupervisores)) {
																?>
																		<option value="<?= $dato['no_reloj'] ?>"><?= $dato['nombres'] ?> <?= $dato['apellidos'] ?></option>
																<?php }
																}
																?>
															</select>
														</div>
														<div class="col-md-12 form-group mt-1">
															<label class="col-md-4 col-sm-4 col-form-label d-block">Region</label>
															<select class="custom-select col-md-8" name="region" id="region" disabled="">
																<option hidden selected><?= $mostrar['region'] ?></option>
																<option value="Central">Central</option>
																<option value="West">West</option>
																<option value="East">East</option>
															</select>
														</div>
													<?php } ?>
												</div>
											</div>
											<div class="form-group col-md-4">
												<div class="form-inline">
													<div id="divImgPerfil" style="margin:auto;"><img src="<?= $mostrar['img'] ?>" class="rounded-image" style=" clip-path: circle(); width: 7em;"></div>
													<div id="upload-demo" hidden=""></div>
													<div id="preview-crop-image" hidden style="background:#9d9d9d;width:150px;height:150px; margin:auto;"></div>
												</div>
											</div>


											<div class="form-group col-md-4">
												<label>PERSONAL</label>
												<div class="form-inline">
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Fecha Nacimiento:</label>
														<input type="date" name="edadForm" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="dd-mm-yyyy" disabled value="<?= $mostrar['edad'] ?>" min="1950-01-01" max="2030-12-31">
														<input type="text" hidden class="form-control form-control-sm" name="no_reloj" value="<?= $_GET["no_reloj"] ?>">
														<?php
														$result = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$reloj'");
														$mostrarR = $result->fetch_assoc();
														?>
														<input type="text" hidden class="form-control form-control-sm" name="reloj_supervisor" value="<?= $mostrarR["no_reloj_supervisor"] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Estado Civil</label>
														<select name="estadoCivilForm" id="estadoCivilForm" disabled class="custom-select col-md-8 col-sm-4">
															<option selected hidden value="<?= $mostrar['estadoCivil'] ?>"><?= $mostrar['estadoCivil'] ?></option>
															<option value="Sin mencionar">Sin mencionar</option>
															<option value="Soltero/a">Soltero/a</option>
															<option value="Casado/a">Casado/a</option>
															<option value="Unión libre o unión de hecho">Unión libre o unión de hecho</option>
															<option value="Separado/a">Separado/a</option>
															<option value="Divorciado/a">Divorciado/a</option>
															<option value="Viudo/a.">Viudo/a.</option>
														</select>
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label"># Hijos</label>
														<input type="number" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="0, 1, 2" name="hijosForm" disabled value="<?= $mostrar['hijos'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Ciudad Residencia</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="Ej. Cd Juarez, El Paso, Tijuana, etc" name="residenciaForm" disabled value="<?= $mostrar['lugarResidencia'] ?>">
													</div>
												</div>
											</div>
											<div class="form-group col-md-4">
												<label>ESCOLAR</label>
												<div class="form-inline">
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Nivel Educativo</label>
														<select name="educacionForm" id="educacionForm" class="custom-select col-md-8 col-sm-4" disabled>
															<option selected hidden value="<?= $mostrar['nivelEducativo'] ?>"><?= $mostrar['nivelEducativo'] ?></option>
															<option value="Preescolar">Preescolar</option>
															<option value="Primaria">Primaria</option>
															<option value="Secundaria">Secundaria</option>
															<option value="Preparatoria/Nivel Media Superior">Preparatoria/Nivel Media Superior</option>
															<option value="Nivel superior/Universidad">Universidad</option>
															<option value="Licenciatura">Licenciatura</option>
															<option value="Maestría">Maestría</option>
															<option value="Doctorado ">Doctorado </option>
														</select>
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Carrera</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="Ej. derecho, Administración, Contabilidad" name="carreraForm" disabled value="<?= $mostrar['carreraProfesional'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Posgrados</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="Ej. adminisitración" name="postgradosForm" disabled value="<?= $mostrar['postgrados'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Nivel de Ingles</label>
														<select name="inglesForm" id="inglesForm" class="custom-select col-md-8 col-sm-4" disabled>
															<option selected hidden value="<?= $mostrar['nivelIngles'] ?>"><?= $mostrar['nivelIngles'] ?></option>
															<option value="Nulo">Nulo</option>
															<option value="Básico">Básico</option>
															<option value="Intermedio">Intermedio</option>
															<option value="Avanzado">Avanzado</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group col-md-4">
												<label>LABORAL</label>
												<div class="form-inline">
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Departamento</label>
														<input type="text" id="deptoForm" class="form-control form-control-sm col-md-8 col-sm-4" value="<?= $mostrar['depto'] ?>" disabled>
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Antigüedad Puesto Actual</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="Ej. 1 año 3 meses" name="antiguedadPuestoForm" disabled value="<?= $mostrar['antiguedadPuesto'] ?>">
													</div>
													<div class="col-md-12 form-group">
														<label class="col-md-4 col-sm-4 col-form-label">Antigüedad Empresa</label>
														<input type="text" class="form-control form-control-sm col-md-8 col-sm-4" placeholder="Ej. 6 años 5 meses" name="antiguedadEmpresaForm" disabled value="<?= $mostrar['antiguedadEmpresa'] ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label>AREAS DE EXPERIENCIA</label>
												<ol>
													<li>
														<select name="areaExperienciaUno" id="areaExperienciaUno" class="custom-select" disabled>
															<option value="<?= $mostrar['areaExperienciaUno'] ?>" selected hidden><?= $mostrar['areaExperienciaUno'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Almacén/Embarques">Almacén/Embarques</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Arquitectura">Arquitectura</option>
															<option value="Atracción de Talento">Atracción de Talento</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Calidad (Mejora continua)">Calidad (Mejora continua)</option>
															<option value="Compras">Compras</option>
															<option value="Construcción">Construcción</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad de operaciones">Contabilidad de operaciones</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Control interno">Control interno</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovación">Culture Innovación</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Desarrollo Organizacional">Desarrollo Organizacional</option>
															<option value="Diseño Gráfico">Diseño Gráfico</option>
															<option value="Docencia">Docencia</option>
															<option value="Ingeniería Civil">Ingeniería Civil</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Logística">Logística</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Materiales">Materiales</option>
															<option value="Mercadotecnia">Mercadotecnia</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Producción/Manufactura">Producción/Manufactura</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Programador (IT)">Programador (IT)</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Psicología">Psicología</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="Retail (tiendas departamentales, farmacias, Etc.)">"Retail (tiendas departamentales, farmacias, Etc.) </option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Salarios y compensaciones">Salarios y compensaciones</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="Trabajo Social">Trabajo Social</option>
															<option value="TTS">TTS</option>
															<option value="Ventas">Ventas</option>
														</select>
													</li>
													<li>
														<select name="areaExperienciaDos" id="areaExperienciaDos" class="custom-select" disabled>
															<option value="<?= $mostrar['areaExperienciaDos'] ?>" selected hidden><?= $mostrar['areaExperienciaDos'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Almacén/Embarques">Almacén/Embarques</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Arquitectura">Arquitectura</option>
															<option value="Atracción de Talento">Atracción de Talento</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Calidad (Mejora continua)">Calidad (Mejora continua)</option>
															<option value="Compras">Compras</option>
															<option value="Construcción">Construcción</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad de operaciones">Contabilidad de operaciones</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Control interno">Control interno</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovación">Culture Innovación</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Desarrollo Organizacional">Desarrollo Organizacional</option>
															<option value="Diseño Gráfico">Diseño Gráfico</option>
															<option value="Docencia">Docencia</option>
															<option value="Ingeniería Civil">Ingeniería Civil</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Logística">Logística</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Materiales">Materiales</option>
															<option value="Mercadotecnia">Mercadotecnia</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Producción/Manufactura">Producción/Manufactura</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Programador (IT)">Programador (IT)</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Psicología">Psicología</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="Retail (tiendas departamentales, farmacias, Etc.)">"Retail (tiendas departamentales, farmacias, Etc.) </option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Salarios y compensaciones">Salarios y compensaciones</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="Trabajo Social">Trabajo Social</option>
															<option value="TTS">TTS</option>
															<option value="Ventas">Ventas</option>
														</select>
													</li>
													<li>
														<select name="areaExperienciaTres" id="areaExperienciaTres" class="custom-select" disabled>
															<option value="<?= $mostrar['areaExperienciaTres'] ?>" selected hidden><?= $mostrar['areaExperienciaTres'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Almacén/Embarques">Almacén/Embarques</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Arquitectura">Arquitectura</option>
															<option value="Atracción de Talento">Atracción de Talento</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Calidad (Mejora continua)">Calidad (Mejora continua)</option>
															<option value="Compras">Compras</option>
															<option value="Construcción">Construcción</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad de operaciones">Contabilidad de operaciones</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Control interno">Control interno</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovación">Culture Innovación</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Desarrollo Organizacional">Desarrollo Organizacional</option>
															<option value="Diseño Gráfico">Diseño Gráfico</option>
															<option value="Docencia">Docencia</option>
															<option value="Ingeniería Civil">Ingeniería Civil</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Logística">Logística</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Materiales">Materiales</option>
															<option value="Mercadotecnia">Mercadotecnia</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Producción/Manufactura">Producción/Manufactura</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Programador (IT)">Programador (IT)</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Psicología">Psicología</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="Retail (tiendas departamentales, farmacias, Etc.)">"Retail (tiendas departamentales, farmacias, Etc.) </option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Salarios y compensaciones">Salarios y compensaciones</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="Trabajo Social">Trabajo Social</option>
															<option value="TTS">TTS</option>
															<option value="Ventas">Ventas</option>
														</select>
													</li>
												</ol>
											</div>
											<div class="form-group col-md-4">
												<label>
													AREAS DE INTERES <label style="color:darkred; font-size: 12px;">(<i>Ingresa tu área actual si te interesa</i>)</label>
												</label>
												<ol>
													<li>
														<select name="areaInteresUno" id="areaInteresUno" class="custom-select " disabled>
															<option value="<?= $mostrar['areaInteresUno'] ?>" selected><?= $mostrar['areaInteresUno'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Compras">Compras</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovation">Culture Innovation</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="TTS">TTS</option>
														</select>
													</li>
													<li>
														<select name="areaInteresDos" id="areaInteresDos" class="custom-select form-control-sm" disabled>
															<option value="<?= $mostrar['areaInteresDos'] ?>" selected><?= $mostrar['areaInteresDos'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Compras">Compras</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovation">Culture Innovation</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="TTS">TTS</option>
														</select>
													</li>
													<li>
														<select name="areaInteresTres" id="areaInteresTres" class="custom-select form-control-sm" disabled>
															<option value="<?= $mostrar['areaInteresTres'] ?>" selected><?= $mostrar['areaInteresTres'] ?></option>
															<option value="Aduanas">Aduanas</option>
															<option value="Análisis Financiero">Análisis Financiero</option>
															<option value="Cafetería">Cafetería</option>
															<option value="Compras">Compras</option>
															<option value="Contabilidad Corporativa">Contabilidad Corporativa</option>
															<option value="Contabilidad Fiscal">Contabilidad Fiscal</option>
															<option value="Contabilidad General">Contabilidad General</option>
															<option value="Contraloría">Contraloría</option>
															<option value="Cuentas X Cobrar">Cuentas X Cobrar</option>
															<option value="Cuentas X Pagar">Cuentas X Pagar</option>
															<option value="Culture Innovation">Culture Innovation</option>
															<option value="Desarrollo de Talento">Desarrollo de Talento</option>
															<option value="Ingeniería de Planta">Ingeniería de Planta</option>
															<option value="IT">IT</option>
															<option value="Mantenimiento">Mantenimiento</option>
															<option value="Nóminas">Nóminas</option>
															<option value="Operaciones">Operaciones</option>
															<option value="Program Manager">Program Manager</option>
															<option value="Proyectos Especiales">Proyectos Especiales</option>
															<option value="Reclutamiento">Reclutamiento</option>
															<option value="RH CSC">RH CSC</option>
															<option value="RH Operaciones">RH Operaciones</option>
															<option value="RH Servicios Administrativos">RH Servicios Administrativos</option>
															<option value="Seguridad Ambiental">Seguridad Ambiental</option>
															<option value="Seguridad Industrial">Seguridad Industrial</option>
															<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
															<option value="Servicio Médico">Servicio Médico</option>
															<option value="Tesorería">Tesorería</option>
															<option value="TTS">TTS</option>
														</select>
													</li>
												</ol>
											</div>

											<div class="form-group col-md-4 text-center">
												<label id="labelDatosExtras">DATOS EXTRAS</label>
												<div class="row">
													<div class="col-md-6">
														<label class="col-form-label list d-block labelExtras">Viajar:</label>
														<div class="custom02">
															<input type="radio" id="radioViajar1" name="viajar" disabled value="Si" <?php if ($mostrar['viaje'] == 'Si') {
																																		echo "checked";
																																	} ?> /><label for="radioViajar1">Si</label>
															<input type="radio" id="radioViajar2" name="viajar" disabled value="No" <?php if ($mostrar['viaje'] == 'No') {
																																		echo "checked";
																																	} ?> /><label for="radioViajar2">No</label>
														</div>
													</div>
													<div class="col-md-6">
														<label class="col-form-label list d-block labelExtras">Cambio Residencia:</label>
														<div class="custom02">
															<input type="radio" id="radioResidencia1" name="residencia" disabled value="Si" <?php if ($mostrar['residencia'] == 'Si') {
																																				echo "checked";
																																			} ?> /><label for="radioResidencia1">Si</label>
															<input type="radio" id="radioResidencia2" name="residencia" disabled value="No" <?php if ($mostrar['residencia'] == 'No') {
																																				echo "checked";
																																			} ?> /><label for="radioResidencia2">No</label>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-12">
												<label>TRAYECTORIA LABORAL</label>
												<label style="color:darkred; font-size: 13px;">(<i>Ingresa en este orden: EMPRESA/PUESTO/ANTIGUEDAD</i>)</label>
												<ol>
													<li>
														<input type="text" class="form-control form-control-sm col-md-11 col-sm-11" placeholder="Ej. Bosh/ Gerente/ 2 año 4 meses" name="trayectoriaLaboralUno" value="<?= $mostrar['trayectoriaLaboralUno'] ?>" disabled>
													</li>
													<li>
														<input type="text" class="form-control form-control-sm col-md-11 col-sm-11" placeholder="Ej. Electrolux/ Supervisor/3 año 6 meses" name="trayectoriaLaboralDos" value="<?= $mostrar['trayectoriaLaboralDos'] ?>" disabled>
													</li>
													<li>
														<input type="text" class="form-control form-control-sm col-md-11 col-sm-11" placeholder="Ej. Tecma/ Operador/ 1 año 3 meses" name="trayectoriaLaboralTres" value="<?= $mostrar['trayectoriaLaboralTres'] ?>" disabled>
													</li>
												</ol>
											</div>
											<div class="form-group col-md-12">
												<div class="cambios-ficha"><i class="far fa-save"></i> Tienes cambios sin guardar.</div>
												<div id="exitoFicha" class="col-md-12 col-sm-12 mt-1 d-block text-center"></div>
											</div>
										</div>
										<ul class="list-inline pull-right">
											<li>
												<input type="text" class="form-control form-control-sm" name="accionFicha" value="<?php if ($mostrar == 0) {
																																		echo "guardarFicha";
																																	} else {
																																		echo "actualizarFicha";
																																	} ?>" hidden disabled>
											</li>
										</ul>
									</div>
									<div class="tab-pane" role="tabpanel" id="step2">
										<h4 class="text-center">Auto-Evaluación</h4>
										<p class="text-center notaAutoEvaluacion"><span class="fas fa-info-circle"></span> (Para finalizar el proceso concluye el llenado de tu auto-evaluación)</p>
										<form action="">
											<div class="alert alert-info alert-dismissible fade show" role="alert">
												<strong>INSTRUCCIONES:</strong>
												<hr>
												<span class="fas fa-info-circle"></span><strong><i>FORTALEZAS</i></strong>: Selecciona tus 3 competencias más fuertes del listado.
												<br>
												<span class="fas fa-info-circle"></span><strong><i>DEBILIDADES</i></strong>: Selecciona tus 3 competencias más débiles del listado.
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label><strong>FORTALEZAS</strong></label><br>
													<fieldset>
														<legend>Evaluación</legend>
														<?php
														$ckbx = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider IS NULL") or die(mysqli_error($conn));
														if (mysqli_num_rows($ckbx) > 0) $i = 1; {
															while ($res = mysqli_fetch_array($ckbx)) { ?>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" checked="">
																	<label class="custom-control-label"><?= $res['fortaleza'] ?></label>
																</div>
														<?php }
														} ?>
													</fieldset>
												</div>
												<div class="col-md-6">
													<label><strong>OPORTUNIDADES</strong></label><br>
													<fieldset>
														<legend>Evaluación</legend>
														<?php $ckbx = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider IS NULL") or die(mysqli_error($conn));
														if (mysqli_num_rows($ckbx) > 0) {
															while ($res = mysqli_fetch_array($ckbx)) {  ?>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" checked="">
																	<label class="custom-control-label"><?= $res['oportunidad'] ?></label>
																</div>
														<?php }
														} ?>
													</fieldset>
												</div>
											</div>
											<div class="row mr-2 ml-2 mt-5">
												<div class="table table-responsive">
													<?php
													$sql = $conn->query("SELECT * FROM t_evaluacion WHERE no_relojC = '$reloj' AND reloj_lider = '$relojSup'");
													$datos = $sql->fetch_assoc();
													?>
													<table id="tablaEvaluacion">
														<thead>
															<tr>
																<th width="5%">CATEGORIA</th>
																<th width="20%">COMPETENCIAS</th>
																<th width="10%" class="text-center">FORTALEZAS</th>
																<th width="10%" class="text-center">DEBILIDADES</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td rowspan="7" id="titulo1">
																	<div class="titulo-rotate">MANEJO DEL AMBIENTE</div>
																</td>
																<td id="subtitulo1-1">RELACIÓN CON SUPERIOR <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con la persona a la que reporta, e influye en su líder para alcanzar las metas."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Superior">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Superior">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo1-2">RELACIÓN CON COLEGAS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con las personas del mismo nivel de autoridad con las que interactúa para lograr resultados."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Colegas">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Colegas">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo1-3">RELACIÓN CON SUBORDINADOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Se dirige con buen trato a aquellas personas que le reportan directamente, motiva y da coaching."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Subordinados">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Subordinados">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo1-4">RELACIÓN CON ASESORES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mantiene un trato cordial con las personas calificadas en puestos de apoyo sin autoridad ni poder, cuyo trabajo consiste en proveer información y asesoría."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Asesores">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Asesores">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo1-5">RELACIÓN CON GRUPOS DE TRABAJO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja un trato efectivo con los comités y grupos de trabajo para la mejora de la compañía."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Grupos de Trabajo">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Grupos de Trabajo">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo1-6">RELACIÓN CON CLIENTES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece planos de relación que le permiten conocer mejor las necesidades y las expectativas de sus clientes y lograr los objetivos de la empresa."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Clientes">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Clientes">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr id="row1">
																<td id="subtitulo1-7">TRATO CON PUBLICO EN GENERAL <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente relaciones con cualquier persona que no es empleado o cliente de la compañía."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trato con Publico en General">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trato con Publico en General">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td rowspan="8" id="titulo2">
																	<div class="titulo-rotate">EJECUCIÓN DE TAREAS</div>
																</td>
																<td id="subtitulo2-1">CREATIVIDAD <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Genera diversidad de ideas y propone iniciativas de mejora para resolver los retos."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Creatividad">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Creatividad">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-2">FIJACIÓN DE OBJETIVOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece estándares de logro de todo aquello que la dirección desea alcanzar, es objetivo y constante."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Fijación de Objetivos">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Fijación de Objetivos">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-3">PLANEACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Distribuye de manera adecuada y efectiva el tiempo para cada tarea que realiza y cuenta con un plan de seguimiento o estrategia para llevar a cabo cada actividad por prioridades."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Planeación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Planeación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-4">MANEJO DEL CAMBIO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Gestiona e impulsa efectivamente los cambios en la estructura de las tareas (métodos, procedimientos, políticas) y también influye en las relaciones para que los cambios sean aceptados."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo del Cambio">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo del Cambio">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-5">IMPLEMENTACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta acciones para realizar planes y tomar decisiones efectivas."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Implementación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Implementación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-6">CONTROLES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta métodos para monitorear el estado de los fenómenos y acciones de ajustes necesarios  para mantener dentro de la normalidad las variables críticas de los procesos productivos."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Controles">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Controles">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo2-7">EVALUACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mide la efectividad de su trabajo en acción y su impacto a través de revisiones periódicas e instrumentos de evaluación."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="evaluación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="evaluación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr id="row2">
																<td id="subtitulo2-8">PRODUCTIVIDAD <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Logra los resultados requeridos por el superior mediante un uso óptimo de recursos."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Productividad">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Productividad">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td rowspan="5" id="titulo3">
																	<div class="titulo-rotate">RELACIONES INTERPERSONALES</div>
																</td>
																<td id="subtitulo3-1">COMUNICACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo en la transmisión y recepción de información a todos lo niveles."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Comunicación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Comunicación">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo3-2">MANEJO DE CONFLICTOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo para manejar el desacuerdo, hace concurrir a las partes implicadas para una solución oportuna, escucha y comprende los puntos de vista de los demás."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo de Conflictos">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo de Conflictos">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo3-3">MANEJO DE ERRORES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Soluciona y evita errores en los procedimientos y reglas de la empresa, aprende y corrige para que no vuelvan a suceder."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo de Errores">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo de Errores">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td id="subtitulo3-4">CONDUCCIÓN DE JUNTAS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Guía y dirige efectivamente reuniones para discutir algo, asegura la coordinación, el enfoque y compromiso de los participantes."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Conducción de Juntas">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Conducción de Juntas">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
															<tr id="row3">
																<td id="subtitulo3-5">TRABAJO EN EQUIPO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Colabora efectivamente con otros miembros de la organización con énfasis en el resultado grupal, aporta, contribuye y coopera."></i></td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trabajo en Equipo">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
																<td id="checkboxes">
																	<div class="custom-control custom-checkbox">
																		<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trabajo en Equipo">
																			<div class="custom-control-label"></div>
																		</label>
																	</div>
																</td>
															</tr>
														</tbody>
														<tfoot>
															<tr>
																<td colspan="2"></td>
																<td class="text-center"><input type="button" class="btn btn-warning btn-sm" id="UncheckAll" value="Desmarcar todos" /></td>
																<td class="text-center">
																	<input type="text" hidden="" name="relojColaborador" id="relojColaboradorEvaluacion" value="<?php echo $reloj; ?>">
																	<input type="text" hidden="" id="rolPagina" value="colaborador">
																	<?php
																	$sql = $conn->query("SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider is NULL");
																	$row = $sql->fetch_assoc();
																	?>
																	<input type="submit" class="btn btn-success btn-sm" disabled id="<?php if ($row == NULL) {
																																			echo "guardarEvaluacion";
																																		} else {
																																			echo "actualizarEvaluacion";
																																		} ?>" value="<?php if ($row == NULL) {
																																								echo "Guardar";
																																							} else {
																																								echo "Actualizar";
																																							} ?>" />
																	<?php
																	$buscarOportunidad = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider IS NULL") or die(mysqli_error($conn));
																	if (mysqli_num_rows($buscarOportunidad) > 0) {
																		while ($result = mysqli_fetch_array($buscarOportunidad)) {  ?>
																			<input hidden type="text" name="id_oportunidad[]" value="<?= $result['id_oportunidad'] ?>">
																		<?php
																		}
																	}
																	$buscarFortaleza = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider is NULL") or die(mysqli_error($conn));
																	if (mysqli_num_rows($buscarFortaleza) > 0) {
																		while ($r = mysqli_fetch_array($buscarFortaleza)) {  ?>
																			<input hidden type="text" name="id_fortaleza[]" value="<?= $r['id_fortaleza'] ?>">
																	<?php
																		}
																	} ?>
																</td>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</fieldset>
	</form>
</body>

</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/editarInfo.js"></script>
<script src="../js/evaluacion.js"></script>
<script>
	window.Modal = "<?php echo $modal ?>";
</script>