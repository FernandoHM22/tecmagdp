<?php session_start();
if (empty($_SESSION['no_reloj'])) {
	header('location:../error.html');
	exit();
}
include '../conexion/conexion.php';
$no_reloj = $_SESSION['no_reloj'];
$cargoColab = $_SESSION['cargoColab'];
$admin = $_SESSION['isAdmin'];


$sql_autoevaluacion = mysqli_query($conn, "SELECT oportunidad COLLATE utf8_general_ci AS autoevaluacion  FROM t_oportunidades WHERE no_reloj = '$no_reloj' AND reloj_lider IS NULL
UNION ALL 
SELECT fortaleza AS autoevaluacion FROM t_fortalezas WHERE no_reloj = '$no_reloj' AND reloj_lider IS NULL");
if (mysqli_fetch_row($sql_autoevaluacion) > 0) {
	$autoevaluacionRegistrada = true;
}

$sql_ficha_talento = mysqli_query($conn, "SELECT * FROM t_fichatalento WHERE reloj_colaborador='$no_reloj'");
if (mysqli_fetch_row($sql_ficha_talento) > 0) {
	$buscar = mysqli_query($conn, "SELECT *, l.cargoColab as 'cargo' FROM registrogdp Reg INNER JOIN t_fichatalento ficha INNER JOIN login_gdp l  WHERE Reg.no_reloj = '$no_reloj' AND Reg.no_reloj = ficha.reloj_colaborador AND Reg.no_reloj = l.no_reloj") or die(mysqli_error($conn));
	$insertar = false;
	$autoevaluacionDesbloqueada = 'enabled';
	$fichaTalentoRegistrada = true;
} else {
	$buscar = mysqli_query($conn, "SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj'") or die(mysqli_error($conn));
	$insertar = true;
	$autoevaluacionDesbloqueada = 'disabled';
	$fichaTalentoRegistrada = false;
}

if (mysqli_num_rows($buscar) > 0) {
	while ($datos = mysqli_fetch_array($buscar)) {

		if ($datos['estadoCivil'] == '' || $datos['hijos'] == '' || $datos['lugarResidencia'] == '') {
			$nombres = $datos['nombres'];
			$apellidos = $datos['apellidos'];
			$img = $datos['img'];
			$correo = $datos['correo'];
			$formato_fecha = $datos['edad'];
			$nacimiento = new DateTime($formato_fecha);
			$hoy = new DateTime();
			$edad = $hoy->diff($nacimiento);
			$antiguedadEmpresa = $datos['antiguedadEmpresa'];
			$fecha_antiguedadEmpresa = new DateTime($antiguedadEmpresa);
			$antiguedad = $hoy->diff($fecha_antiguedadEmpresa);
			$insertar = false;
			$autoevaluacionDesbloqueada = 'disabled';
			$fichaTalentoRegistrada = false;
		} else {
			$formato_fecha = $datos['edad'];
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
			$puesto = $datos['puesto'];
			$depto = $datos['depto'];
			$no_reloj_supervisor = $datos['no_reloj_supervisor'];
			$antiguedadEmpresa = $datos['antiguedadEmpresa'];
			$fecha_antiguedadEmpresa = new DateTime($antiguedadEmpresa);
			$antiguedad = $hoy->diff($fecha_antiguedadEmpresa);

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
	}
	mysqli_free_result($buscar);
}

($sql_supervisor = mysqli_query(
	$conn,
	"SELECT nombres, apellidos FROM registrogdp WHERE no_reloj ='$no_reloj_supervisor'"
)) or die(mysqli_error($conn));
if (mysqli_num_rows($sql_supervisor) > 0) {
	while ($row = mysqli_fetch_assoc($sql_supervisor)) {
		$nombre_supervisor = $row['nombres'];
		$apellido_supervisor = $row['apellidos'];
	}
	mysqli_free_result($sql_supervisor);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description">
	<meta name="author" content="Fernando H">
	<title>GDP - Escritorio</title>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
	<style>
		body {
			background-color: #F0F0F0
		}
	</style>
</head>

<body id="page-top">
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top"> <a class="navbar-brand mr-1" href="myinfo.php">GDP</a>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#"> <i class="fas fa-bars"></i> </button>
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> </form>
		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-circle fa-lg" style="font-size: 1.5rem;"></i> </a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a> </div>
			</li>
		</ul>
	</nav>
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="sidebar navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="myinfo.php"><i class="fas fa-chalkboard-teacher"></i> <span>Mi Perfil</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if ($autoevaluacionRegistrada == '1' && $fichaTalentoRegistrada == '1') {
										echo "enable";
									} else {
										echo "disabled";
									} ?>" href="objetivos.php"><i class="fas fa-fw fa-bullseye"></i> <span>Mis Objetivos</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if ($autoevaluacionRegistrada == '1' && $fichaTalentoRegistrada == '1') {
										echo "enable";
									} else {
										echo "disabled";
									} ?>" href="planeacion.php"><i class="fas fa-fw fa-chart-area"></i> <span>Plan de Desarrollo</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if ($autoevaluacionRegistrada == '1' && $fichaTalentoRegistrada == '1') {
										echo "enable";
									} else {
										echo "disabled";
									} ?>" href="biblioteca.php"><i class="fas fa-book"></i></i> <span>Biblioteca</span></a>
			</li>
			<hr>
			<?php
			if ($admin == 1) { ?>
				<br>
				<li class="nav-item">
					<a class="nav-link" href="../control/administracion.php"> <i class="fas fa-toolbox"></i> <span> Administración</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../control/seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
					<div class="dropdown-menu" style="margin-right: 0px;">
						<a class="dropdown-item" href="../control/reportes/reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
						<a class="dropdown-item" href="../control/reportes/reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
						<a class="dropdown-item" href="../control/reportes/reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
						<a class="dropdown-item" href="../control/reportes/reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
						<a class="dropdown-item" href="../control/reportes/reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
						<a class="dropdown-item" href="../control/reportes/reclutamiento.php"><i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>

					</div>
				</li>
			<?php }
			if ($admin == 2 || $admin == 4) { ?>
				<li class="nav-item">
					<a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
				</li>
			<?php }
			if ($admin == 3) { ?>
				<li class="nav-item">
					<a class="nav-link" href="../control/reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
				</li>
			<?php }
			?>
		</ul>
		<div class="container-fluid">
			<section class="signup-step-container">
				<div class="row d-flex justify-content-center">
					<div class="col-md-12">
						<div class="wizard">
							<div class="wizard-inner">
								<div class="connecting-line"></div>
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Ficha Talento</i></a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step2" class="btnAutoevaluacion <?= $autoevaluacionDesbloqueada; ?>" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Auto-evaluación</i></a>
									</li>
								</ul>
							</div>
							<div class="tab-content" id="main_form">
								<div class="tab-pane active" role="tabpanel" id="step1">
									<div class="container-perfil">
										<div class="row p-2">
											<div class="col-md-4 text-center seccionImagenPerfil sombras pt-5">
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
												<div class="mt-4" id="divIndicadoresCharts"></div>
											</div>
											<div class="col-md-8">
												<div class="row pl-2 sombras">
													<div class="col-md-6 seccionInformacionPersonal pt-5 pb-3">
														<a href="#" class="btnEditarInfo"><i class="fas fa-edit "></i></a>
														<a href=""><span class="badge badge-info">INFORMACIÓN PERSONAL</span></a>
														<form>
															<div class="form-group row">
																<label for="input_edad" class="col-sm-5 col-form-label">Edad</label>
																<div class="col-sm-7">
																	<input type="text" disabled class="form-control form-control-sm " id="input_edad" value="<?= $edad->y .
																																									' años' ?>">
																	<input hidden type="date" class="form-control form-control-sm" id="input_fecha_nacimiento" placeholder="dd-mm-yyyy" disabled value="<?= $formato_fecha ?>" min="1950-01-01" max="2030-12-31">
																</div>

															</div>
															<div class="form-group row">
																<label for="input_estadoCivil" class="col-sm-5 col-form-label">Estado Civil</label>
																<div class="col-sm-7">
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
																<label for="input_hijos" class="col-sm-5 col-form-label"># Hijos</label>
																<div class="col-sm-7">
																	<input type="number" disabled class="form-control form-control-sm input_editar" id="input_hijos" value="<?= $hijos ?>">
																</div>
															</div>
															<div class="form-group row">
																<label for="input_lugarResidencia" class="col-sm-5 col-form-label">Residencia</label>
																<div class="col-sm-7">
																	<input type="text" disabled class="form-control form-control-sm input_editar" id="input_lugarResidencia" value="<?= $LugarResidencia ?>">
																</div>
															</div>
															<span class="badge badge-primary">Disponibilidad para:</span>
															<div class="form-group row">
																<label for="input_viajar" class="col-sm-5 col-form-label">Viajar</label>
																<div class="col-sm-7">
																	<select disabled class="custom-select custom-select-sm input_editar" id="input_viajar">
																		<option value="<?= $viaje ?>" hidden><?= $viaje ?></option>
																		<option value="Si">Si</option>
																		<option value="No">No</option>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label for="input_residencia" class="col-sm-5 col-form-label">Cambio Localidad</label>
																<div class="col-sm-7">
																	<select disabled class="custom-select custom-select-sm input_editar" id="input_residencia">
																		<option value="<?= $residencia ?>" hidden><?= $residencia ?></option>
																		<option value="Si">Si</option>
																		<option value="No">No</option>
																	</select>
																</div>
															</div>
														</form>
													</div>
													<div class="col-md-6 seccionLaboral pt-5 pb-3">
														<a href="#" hidden data-id="<?= $no_reloj; ?>" id="btnConfirmarInfo"><i class="fas fa-check"></i></a>
														<a href="#" hidden id="btnCancelar"><i class="fas fa-times"></i></a>
														<input type="text" hidden id="insertarInput" class="form-control" value="<?= $insertar ?>">
														<a href=""><span class="badge badge-info">LABORAL</span></a>
														<form>
															<div class="form-group row">
																<label for="input_correo" class="col-sm-3 col-form-label">Correo.</label>
																<div class="col-sm-9">
																	<input type="text" disabled id="input_correo" class="form-control form-control-sm" value="<?= $correo ?>">
																</div>
															</div>
															<div class="form-group row">
																<label hidden for="input_fechaIngreso" class="col-sm-4 col-form-label" id="label_inputFechaIngreso">Fecha Ingreso</label>
																<div id="div_inputFechaIngreso" hidden class="col-sm-8">
																	<input type="date" disabled class="form-control form-control-sm" id="input_fechaIngreso" value="<?= $antiguedadEmpresa ?>">
																</div>
																<label for="input_antiguedadEmpresa" class="col-sm-6 col-form-label" id="label_inputAntiguedadEmpresa">Antiguedad Empresa</label>
																<div id="div_inputAntiguedadEmpresa" class="col-sm-6">
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
																<label for="input_supervisor" class="col-sm-3 col-form-label">Puesto</label>
																<div class="col-sm-9">
																	<input type="text" disabled id="input_puesto" class="form-control form-control-sm campoDeshabilitado input_editar" value="<?= $puesto ?>">
																</div>
															</div>
															<div class="form-group row">
																<label for="input_cargoColab" class="col-sm-3 col-form-label">¿Es lider?</label>
																<div class="col-sm-9">
																	<select disabled class="custom-select custom-select-sm input_editar" id="input_cargoColab">
																		<option value="<?= $cargoColab ?>" hidden><?php if($cargoColab == 1){echo 'Si';}else{echo 'No';}?></option>
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
																		<label for="input_gradoEstudio" class="col-sm-7 col-form-label">Ultimo grado de estudios</label>
																		<div class="col-sm-5">
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
																		<label for="input_ingles" class="col-sm-4 col-form-label">Nivel Ingles</label>
																		<div class="col-sm-8">
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
																		<div class="col-sm-10">
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
																		<div class="col-sm-10">
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
																		<div class="col-sm-10">
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
								</div>
								<div class="tab-pane" role="tabpanel" id="step2">
									<div class="container-autoevaluacion">
										<div class="row">
											<div class="col-md-12 seccionAutoevaluacion">
												<div class="divAutoevaluacion"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 text-center">
					<span class="text-muted"> <i class="fa fa-copyright" aria-hidden="true"></i> TECMA 2022</span>
				</div>
			</div>
		</div>
	</footer>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="border-radius:0;">
				<div class="modal-header" style="background: #4CA1A6; color:#fff; border-radius: 0;">
					<h4 class="modal-title" style="font-weight: 600">Actualizar: Mi Información</h4>
					<button type="button" class="close btn-danger btn-sm" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
				<div class="dash">
				</div>
			</div>
		</div>
	</div>
	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-lock"></i> Salir Tecma GDP</h5>
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body text-center">¿Deseas cerrar sesión?</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-block" href="../conexion/logout.php">Si</a>
				</div>
			</div>
		</div>
	</div>
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="../js/sb-admin.min.js"></script>
	<script>
		$(document).ready(function() {
			var autoevaluacion = '<?= $autoevaluacionRegistrada ?>';
			var fichaTalento = '<?= $fichaTalentoRegistrada ?>';

			$('.nav-tabs > li a[title]').tooltip();
			//Wizard
			$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
				var target = $(e.target);
				if (target.parent().hasClass('disabled')) {
					return false;
				}
			});

			$(".next-step").click(function(e) {
				var active = $('.wizard .nav-tabs li.active');
				active.next().removeClass('disabled');
				nextTab(active);

			});

			$(".prev-step").click(function(e) {
				var active = $('.wizard .nav-tabs li.active');
				prevTab(active);

			});

			function nextTab(elem) {
				$(elem).next().find('a[data-toggle="tab"]').click();
			}

			function prevTab(elem) {
				$(elem).prev().find('a[data-toggle="tab"]').click();
			}

			$('.nav-tabs').on('click', 'li', function() {
				$('.nav-tabs li.active').removeClass('active');
				$(this).addClass('active');
			});


			$('#divIndicadoresCharts').load('../loads/perfil/indicadores.php', {
				no_reloj: <?= $no_reloj ?>,
				cargoColab: <?= $cargoColab ?>,
				perfil: '0'
			});

			if (autoevaluacion != '1' && fichaTalento != '1') {
				Swal.fire({
					icon: 'warning',
					title: 'Aviso',
					html: '<div class="alertaFichaTalentoSW">Menú GDP deshabilitado, para poder navegar debes actualizar tu ficha de talento y llenar autoevaluación <br> ' +
						'Para editar ficha de talento debes dar click en este icono <img src="../img/editarInfo.png"><br>' +
						'Para realizar Autoevaluación debes dar click en este icono <img class="imgAutoEvaluacion" src="../img/autoevaluacion.png"> después de actualizar tu ficha de talento</div>',
					confirmButtonText: '<i class="fa fa-thumbs-up"></i> De acuerdo!',
					confirmButtonColor: '#3085d6',
				});
			}
			document.onkeydown = function(e) {
				if (event.keyCode == 123) {
					return false;
				}
				if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
					return false;
				}
				if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
					return false;
				}
				if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
					return false;
				}
				if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
					return false;
				}
			}

			$(function() {
				$('textarea.textareaPosgrado').each(function() {
					$(this).height(1);
					$(this).height(10 + $(this).get(0).scrollHeight);
				});
			});

			var no_reloj = '<?php echo $no_reloj ?>';
			$('.divAutoevaluacion').load('../loads/perfil/autoevaluacion.php', {
				'no_reloj': no_reloj
			});

			$('#modalActualizar').on('hidden.bs.modal', function() {
				location.reload();
			});
			$('#modalActualizar').on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever');
				var recipiente = button.data('target'); // Extract info from data-* attributes
				var modal = $(this);

				$.ajax({
					type: "GET",
					url: "../actions/editarInfo.php",
					data: {
						no_reloj: recipient,
						dataModal: recipiente
					},
					cache: false,
					success: function(data) {
						console.log(data);
						modal.find('.dash').html(data);
					},
					error: function(err) {
						console.log(err);
					}
				});
			})

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
				$('#label_inputAntiguedadEmpresa, #div_inputAntiguedadEmpresa').attr('hidden', true);
				$('#input_antiguedadEmpresa').attr('disabled', true);
				$('#input_viajar').removeAttr('hidden');
				$('#input_residencia').removeAttr('hidden');
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
				$('#btnConfirmarInfo').attr('hidden', true);
				$('.btnEditarImagen').removeClass('disabled');
				$('.btnEditarInfo').attr('hidden', false);
				$('.input_editar').attr('disabled', true);
				$('#input_edad').attr('hidden', false);
				$('.nombreColaborador').attr('hidden', false);
				$('.rowNombre').attr('hidden', true);
				$('#input_fecha_nacimiento').attr('hidden', true);
				$('#label_inputFechaIngreso, #div_inputFechaIngreso').attr('hidden', true);
				$('#label_inputAntiguedadEmpresa, #div_inputAntiguedadEmpresa').removeAttr('hidden');
				$('#input_viajar').attr('hidden', true);
				$('#input_residencia').attr('hidden', true);
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
				var viajar = $('#input_viajar option:selected').val();
				var residencia = $("#input_residencia option:selected").val();
				var fechaNacimiento = $('#input_fecha_nacimiento').val();
				var estadoCivil = $('#input_estadoCivil option:selected').val();
				var hijos = $('#input_hijos').val();
				var lugarResidencia = $('#input_lugarResidencia').val();
				var fechaIngreso = $('#input_fechaIngreso').val();
				var depto = $('#input_depto option:selected').val();
				var supervisor = $('#input_supervisor option:selected').val();
				var cargoColab = $('#input_cargoColab').val();
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

				if (nombre == '' || apellidos == '' || correo == '' || puesto == '' || fechaNacimiento == '' || estadoCivil == '' || hijos == '' || lugarResidencia == '' || depto == '' || supervisor == '' || gradoEstudios == '' || especialidad == '' || ingles == '' || interesUno == '' || trayectoriaUno == '' || experienciaUno == '' || viajar == '' || residencia == '') {
					Swal.fire({
						icon: 'warning',
						title: 'Campos vacios!',
						text: 'Verifique que todos los campos estan correctamente llenados'
					});
				} else {
					$.ajax({
						url: '../ajax/perfil/ajax_editarPerfil.php',
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
									text: 'Ahora debes realizar su autoevaluación para desbloquear el contenido (Objetivo, Plan de Desarrollo, Ingles)'
								});
								setTimeout(function() {
									cancelar()
									$('.btnAutoevaluacion').removeClass('disabled').trigger('click');
								}, 800);
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error al actualizar!',
									timer: 900
								});
							}
						}
					});
				}
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
							url: "../ajax/perfil/ajax_editarFoto.php",
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
		});
	</script>
</body>

</html>