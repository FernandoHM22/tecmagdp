<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
	header("location:../error.html");
	exit();
}
$cargoColab = $_SESSION['cargoColab'];
include("../conexion/conexion.php");
$msg = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>GDP - Administración</title>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<style>
		body {
			background-color: #F0F0F0
		}
	</style>
</head>

<body id="page-top">
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top"> <a class="navbar-brand mr-1" href="../admin/myinfoSup.php">GDP</a>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#"> <i class="fas fa-bars"></i> </button>
		<!-- Navbar Search -->
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> </form>
		<!-- Navbar -->
		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-circle fa-lg" style="font-size: 1.5rem;"></i> </a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><span class="fas fa-sign-out-alt"></span> Cerrar Sesion</a>
				</div>
			</li>
		</ul>
	</nav>
	<div id="wrapper">
		<ul class="sidebar navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../user/myinfo';
											} else {
												echo '../admin/myinfoSup';
											} ?>">
					<i class="fas fa-chalkboard-teacher"></i>
					<span>Escritorio</span>
				</a>
			</li>
			<?php if ($cargoColab == 1) { ?>
				<li class="nav-item">
					<a class="nav-link" href="../admin/colaboradoresSup.php">
						<i class="fas fa-users"></i>
						<span>Mis Colaboradores</span></a>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../user/objetivos';
											} else {
												echo '../admin/objetivosSup';
											} ?>">
					<i class="fas fa-fw fa-bullseye"></i>
					<span>Mis Objetivos</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../user/planeacion';
											} else {
												echo '../admin/planeacionSup';
											} ?>">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Plan de Desarrollo</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../user/biblioteca.php';
											} else {
												echo '../admin/biblioteca.php';
											} ?>">
					<i class="fas fa-book"></i>
					<span>Biblioteca</span>
				</a>
			</li>
			<hr>
			<br>
			<li class="nav-item">
				<a class="nav-link" href="../control/administracion.php"> <i class="fas fa-toolbox"></i> <span> Administración</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
				<div class="dropdown-menu" style="margin-right: 0px;">
					<a class="dropdown-item" href="reportes/reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
					<a class="dropdown-item" href="reportes/reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
					<a class="dropdown-item" href="reportes/reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
					<a class="dropdown-item" href="reportes/reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
					<a class="dropdown-item" href="reportes/reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
					<a class="dropdown-item" href="reportes/reclutamiento.php"><i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
				</div>
			</li>
		</ul>
		<div id="content-wrapper">
			<div class="container-fluid content-administracion">
				<div class="row">
					<div class="col-md-12 divContainerOpciones">
						<h7><strong><i class="fas fa-cog"></i> OPCIONES DE USUARIOS</strong></h7>
						<div class="row justify-content-md-center text-center">
							<div class="col-md-4 divOpcionesUsuarios" data-toggle="modal" data-target="#modal_empleados_baja"><a href="#"><i class="fas fa-user-minus"></i> Administrar empleados bajas</a></div>
							<div class="col-md-4 divOpcionesUsuarios" data-toggle="modal" data-target="#modal_empleados_alta"><a href="#"><i class="fas fa-user-plus"></i> Administrar empleados nuevos</a></div>
						</div>
						<div class="row justify-content-md-center text-center">
							<div class="col-md-4 divOpcionesUsuarios" data-toggle="modal" data-target="#modal_empleados_privilegios"><a href="#"><i class="fas fa-user-cog"></i> Administrar privilegios</a></div>
							<div class="col-md-4 divOpcionesUsuarios"><a href="#" class="modalNuevosEmpleados"></a></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 divContainerOpciones">
						<h7><strong><i class="fas fa-cog"></i> OPCIONES GPTW</strong></h7>
						<div class="row justify-content-md-center text-center">
							<div class="col-md-4 divOpcionesUsuarios" data-toggle="modal" data-target="#modal_calificacion_gptw"><a href="#"><i class="fas fa-user-check"></i> Calificaciones Colaboradores</a></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 divContainerOpciones">
						<h7><strong><i class="fas fa-cog"></i> OPCIONES OBJETIVOS</strong></h7>
						<form>
							<div class="form-row align-items-center pb-3" id="divEnableObjetivos">
								<div class="col-md-5"><label style="color: #686868;">Habilitar/deshabilitar la evaluación de objetivos</label>
									<label style="font-weight: 600; color:#707070; font-size: 12px; text-align: justify;">Permitir que los usuarios puedan evaluar sus objetivos según el año seleccionado.</label>
								</div>
								<div class="col-md-2">
									<select name="selectAño" class="form-control selectpicker enableObjetives" id="selectAño" required title="--Seleccionar año--">
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>
									<label style="font-weight: 600; color:#707070; font-size: 12px; text-align: justify;">Años Activos:</label>
									<div id="divObjetivosAñosActivosAdmin"></div>
								</div>
								<div class="col-md-4">
									<div id="successMsj"></div>
								</div>
								<div class="col-md-1">
									<div id="divloadswitch"></div>
								</div>
							</div>
							<div class="form-row align-items-center mt-3 pb-3" id="divEnableBtn">
								<div class="col-md-5">
									<label style="color: #686868;">Habilitar/deshabilitar botón "Agregar objetivos"</label>
									<label style="font-weight: 600; color:#707070; font-size: 12px; text-align: justify;">Al habilitar esta opción se permite agregar objetivos en todas las vistas, asi como las opciones para editar sus objetivos.</label>
								</div>
								<div class="col-md-6">
									<div id="successmsj"></div>
								</div>
								<div class="col-md-1">
									<label class="switch">
										<input type="checkbox" id="chbxActivarBtn" <?php $query = mysqli_query($conn, "SELECT estadoBtn FROM t_comportamientoObjetivos WHERE nombreBtn = 'agregarObjetivos'");
																					$row = mysqli_fetch_assoc($query);
																					$estadoBtn = $row['estadoBtn'];
																					if ($estadoBtn == 1) {
																						echo "checked";
																					}
																					?>>
										<span class="slider round"></span>
									</label>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12 divContainerOpciones" style="border-bottom: 1px solid #D9D9D9;">
						<h7><strong><i class="fas fa-cog"></i> OPCIONES DE FORTALEZAS/OPORTUNIDADES</strong></h7>
						<div id="deletesuccess" class="d-block col-md-12"></div>
						<div class="row">
							<div class="col-md-11">
								<label style="color: #686868;">Borrar Fortalezas/Oportunidades</label>
								<label style="font-weight: 600; color:#707070; font-size: 12px; text-align: justify;">Borrar todos los registros con las fortalezas y oportunidades de los colaboradores</label>
							</div>
							<div class="col-md-1">
								<button type="button" class="btn btn-danger btn-sm" id="borrarOportunidades" name="borrarOportunidades"><i class="fas fa-trash-alt"></i></button>
							</div>
						</div>
					</div>
					<div class="col-md-12 divContainerOpciones">
						<h7><strong><i class="fas fa-cog"></i> OPCIONES EVALUACIÓN</strong></h7>
						<div class="form-row align-items-center pb-3" id="divAdminEvaluacion">
							<div class="col-md-10"><label style="color: #686868;">Habilitar/deshabilitar la evaluación de competencias / Matriz Potencial-Desempeño</label>
								<br>
								<label style="font-weight: 600; color:#707070; font-size: 12px; text-align: justify;">Permitir que los supervisores puedan evaluar sus colaboradores según los departamentos.</label>

								<div class="row">
									<div class="col-md-4">
										<h6>Evaluación deshabilitada</h6>
										<?php
										$Search = mysqli_query($conn, "SELECT * FROM registrogdp WHERE cargoColab = 1 AND habilitarEvaluacion != 1  GROUP BY depto ORDER BY depto ASC ");
										if (mysqli_num_rows($Search) > 0) {
											while ($datos = mysqli_fetch_array($Search)) {
												echo
												'<div class="form-check">
															<input class="form-check-input" type="checkbox" value="' . $datos['depto'] . '" id="checkboxDeptos" name="checkboxDeptos[]">
															<label class="form-check-label">' . $datos['depto'] . '</label>
															</div>';
											}
											mysqli_free_result($Search);
										} else {
											echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">No existen departamentos con evaluación deshabilitada.
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
														</div>';
										}
										?>
										<button type="button" class="btn btn-sm btn-success" id="btnHabilitarEvaluacion">Habilitar</button>
										<div id="mensajeHabilitar"></div>
									</div>
									<div class="col-md-4">
										<h6>Evaluación habilitada</h6>
										<?php
										$Search = mysqli_query($conn, "SELECT * FROM registrogdp WHERE cargoColab = 1 AND habilitarEvaluacion != 0 GROUP BY depto ORDER BY depto ASC ");
										if (mysqli_num_rows($Search) > 0) {
											while ($datos = mysqli_fetch_array($Search)) {
												echo '<div class="form-check">
														<input class="form-check-input" type="checkbox" value="' . $datos['depto'] . '" id="checkboxDeptos" name="checkboxDeptos[]">
														<label class="form-check-label">' . $datos['depto'] . '</label>
														</div>';
											}
											mysqli_free_result($Search);
										} else {
											echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">No existen departamentos con evaluación deshabilitada.
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;</span>
												 </button>
												 </div>';
										}
										?>
										<button type="button" class="btn btn-sm btn-success" id="btnDeshabilitarEvaluacion">Deshabilitar</button>
										<div id="mensajeDeshabilitar"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /#wrapper -->
		<footer class="sticky-footer">
			<div class="container my-auto">
				<div class="copyright text-center my-auto"> <span>Copyright © GDP | Tecma 2021</span> </div>
			</div>
		</footer>

		<!-- Modal -->
		<div class="modal fade" id="modal_empleados_baja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Baja Usuarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body-empleados-baja">
						<div class="row p-4">
							<div class="col-md-12">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="inputFileBajas" aria-describedby="inputGroupFileAddon04" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
										<label class="custom-file-label" id="inputFileLabel" for="inputFile">Seleccione archivo...</label>
									</div>
									<div class="input-group-append">
										<button class="btn btn-outline-primary cargarArchivoBajas" type="button" id="inputGroupFileAddon04">Cargar <i class="fas fa-upload"></i></button>
									</div>
								</div>
								<small class="form-text text-muted">
									Descarga plantilla para realizar bajas <a href="../evidencias/empleados_activos_bajas.csv" download>click aquí.</a>
								</small>
							</div>

							<div class="col-md-12 mt-3">
								<div class="table-responsive">
									<table id="tablaEliminarColaboradores" style="width:100%" class="table table-sm">
										<thead>
											<tr>
												<th># Reloj</th>
												<th>Nombre</th>
												<th>Apellidos</th>
												<th>Puesto</th>
												<th>Depto.</th>
												<th></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
							<div class="col-md-12 mt-3">
								<a href="#" class="btn btn-sm btn-outline-danger float-right pl-2 pr-2 d-none" id="btnEliminarColaboradores">Eliminar Seleccionados <i class="fas fa-times"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modal_empleados_alta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alta Usuarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body-empleados-alta">
						<div class="row p-4">
							<div class="col-md-12">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="inputArchivoNuevosUsuarios" aria-describedby="inputGroupFileAddon04" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
										<label class="custom-file-label" id="inputFileLabelAltaUsuarios" for="inputFile">Seleccione archivo...</label>
									</div>
									<div class="input-group-append">
										<button class="btn btn-outline-primary cargarNuevosUsuarios" type="button" id="inputGroupFileAddon04">Cargar <i class="fas fa-upload"></i></button>
									</div>
								</div>
								<small class="form-text text-muted">
									Descarga plantilla para realizar alta masiva <a href="../evidencias/empleados_nuevos_alta.csv" download>click aquí.</a>
								</small>
							</div>
							<div class="col-md-12 pt-3">
								<div class="table-responsive">
									<table id="tablaNuevosUsuarios" class="table table-sm">
										<thead>
											<tr>
												<th># Reloj</th>
												<th>Nombres</th>
												<th>Apellidos</th>
												<th>Fecha Nacimiento</th>
												<th>Fecha Ingreso</th>
												<th>Correo</th>
												<th>Region</th>
												<th>Supervisor</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
								<a href="#" class=" btn btn-sm btn-secondary disabled btnEnviarNuevosUsuarios float-right mt-2 pl-3 pr-3">Dar Alta</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_calificacion_gptw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Calificaciones GPTW</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-gptw">
						<div class="row p-4">
							<div class="col-md-12">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="inputFileCalificacionesGPTW" aria-describedby="inputGroupFileAddon04" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
										<label class="custom-file-label" id="inputFileLabelGPTW" for="inputFile">Seleccione archivo...</label>
									</div>
									<div class="input-group-append">
										<select class="custom-select" id="input_mes" required>
											<option hidden>Seleccione mes...</option>
											<?php
											$Meses = array(
												'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
												'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
											);
											for ($i = 1; $i <= 12; $i++) {
												echo '<option value="'  . $Meses[($i) - 1] .  '">' . $Meses[($i) - 1] . '</option>';
											}
											?>
										</select>
									</div>
									<div class="input-group-append">
										<select class="custom-select" id="input_anio" required>
											<option hidden>Seleccione año...</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
										</select>
									</div>
									<div class="input-group-append">
										<button class="btn btn-outline-primary cargarArchivoGPTW" type="button" id="inputGroupFileAddon04">Cargar <i class="fas fa-upload"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-12 mt-3">
								<div class="tablaCalificacionesGPTW"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_empleados_privilegios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Usuarios: Privilegios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-md-12 TablaEmpleadosPrivilegios"></div>
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
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
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
	</div>
	<script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
	<script src="../vendor/bootstrap/popper.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../js/sb-admin.min.js"></script>
	<script src="../js/administracion.js"></script>
	<script>
		$(document).ready(function() {
			$('.TablaEmpleadosPrivilegios').load('../loads/admin/tablaEmpleadosPrivilegios.php');
			$('.tablaCalificacionesGPTW').load('../loads/admin/tablaCalificacionesGPTW.php');

			$('#selectAño').on('change', function() {
				var año = (this.value);
				$('#divloadswitch').load('../loads/admin/activarEvaluacion.php', {
					'año': año
				});
			});

			$('#selectDepto').on('change', function() {
				var año = (this.value);
				$('#divloadsEvaluacion_Matriz').load('../loads/admin/evaluacion_matriz.php', {
					'año': año
				});
			});
			$('#divObjetivosAñosActivosAdmin').load('../loads/admin/objetivosAñosActivos.php');

			$('#inputFileBajas').on('change', function(e) {
				e.preventDefault();
				var fileName = $(this).val();
				var cleanFileName = fileName.split('\\').pop();
				$('#inputFileLabel').text(cleanFileName);
				btnCargarArchivoBajas = document.getElementsByClassName('cargarArchivoBajas');
				$(btnCargarArchivoBajas).trigger('click').prop('disabled', true);
			});

			$('#inputFileCalificacionesGPTW').on('change', function(e) {
				e.preventDefault();
				var fileName = $(this).val();
				var cleanFileName = fileName.split('\\').pop(); // clean from C:\fakepath OR C:\fake_path 
				$('#inputFileLabelGPTW').text(cleanFileName);
			});

			$(document).on('click', '.cargarArchivoBajas', function() {
				$('#btnEliminarColaboradores').removeClass('d-none').addClass('d-block');
				var file_data = $('#inputFileBajas').prop('files')[0];
				if (file_data != undefined) {
					var form_data = new FormData();
					form_data.append('file', file_data);
					$.ajax({
						type: 'POST',
						url: '../ajax/administracion/ajax_cargarBajas.php',
						contentType: false,
						processData: false,
						data: form_data,
						dataType: 'json',
						success: function(response) {
							if (response == 0) {
								Swal.fire({
									icon: 'warning',
									text: 'Debe seleccionar un archivo, campo vacío.'
								});
							} else if (response == 1) {
								Swal.fire({
									icon: 'error',
									text: 'Error al cargar archivo, número de columnas menor/mayor al establecido'
								});
								$('.cargarArchivoBajas').prop('disabled', false);
							} else if (response != '') {
								$.each(response, function(i, r) {
									var $tr = '<tr>' +
										'<td>' + r.no_reloj + '</td>' +
										'<td>' + r.nombre + '</td>' +
										'<td>' + r.apellidos + '</td>' +
										'<td>' + r.puesto + '</td>' +
										'<td>' + r.depto + '</td>' +
										'<td><div class="form-check"><input class="form-check-input" type="checkbox" value="' + r.no_reloj + '" checked></div></td>' +
										'</tr>';
									$('#tablaEliminarColaboradores').find('tbody').append($tr);

								});
								$('#tablaEliminarColaboradores').DataTable();
							}
						}
					});
				}
				return false;
			});

			$(document).on('click', '#btnEliminarColaboradores', function(e) {
				e.preventDefault();
				var tablaEliminarColaboradores = $('#tablaEliminarColaboradores').dataTable();
				var arrayColaboradores = [];
				$(tablaEliminarColaboradores.fnGetNodes()).each(function(index, tr) {
					$(tr).find('input[type="checkbox"]:checked').each(function() {
						arrayColaboradores.push($(this).val());
					});
				});

				Swal.fire({
					title: '¿Está seguro que desea continuar?',
					text: 'Al hacer esto no podrá recuperar las cuentas.',
					showCancelButton: true,
					confirmButtonText: 'Si, eliminar.',
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: 'POST',
							url: '../ajax/administracion/ajax_eliminarColaboradores.php',
							data: {
								no_relojColaboradores: arrayColaboradores
							},
							success: function(response) {
								var response = response.trim();
								if (response == 0) {
									Swal.fire({
										icon: 'error',
										text: 'Error al eliminar, consulte con el administrador'
									});
								} else if (response == 1) {
									Swal.fire({
										icon: 'success',
										text: 'Colaboradores eliminados correctamente!'
									});
								}
							}
						});
					}
				})
			});

			$(document).on('click', '.cargarArchivoGPTW', function() {
				var file_data = $('#inputFileCalificacionesGPTW').prop('files')[0];
				var input_mes = $('#input_mes option:selected').val();
				var input_anio = $('#input_anio option:selected').val();

				if (file_data != undefined) {
					var form_data = new FormData();
					form_data.append('file', file_data);
					form_data.append('mes_input', input_mes);
					form_data.append('anio_input', input_anio);
					$.ajax({
						type: 'POST',
						url: '../ajax/administracion/ajax_agregar_calificaciones_gptw.php',
						contentType: false,
						processData: false,
						data: form_data,
						success: function(response) {
							if (response != '') {
								Swal.fire({
									icon: 'success',
									title: 'Éxito',
									text: 'Archivo exportado con éxito!',
									timer: 800
								});
								$('.tablaCalificacionesGPTW').load('../loads/admin/tablaCalificacionesGPTW.php');
								$('#inputFileCalificacionesGPTW').val('');
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: 'Error al actualizar listado!',
									timer: 800
								});
							}
						}
					});
				}
				return false;
			});

			$(document).on('change', '#inputArchivoNuevosUsuarios', function(e) {
				btnCargarUsuarios = document.getElementsByClassName('cargarNuevosUsuarios');
				$(btnCargarUsuarios).trigger('click').prop('disabled', true);
				var fileName = e.target.files[0].name;
				$('#inputFileLabelAltaUsuarios').html(fileName);
			});

			$(document).on('click', '.cargarNuevosUsuarios', function(e) {
				e.preventDefault();
				var archivoNuevosUsuarios = $('#inputArchivoNuevosUsuarios').prop('files')[0];
				if (archivoNuevosUsuarios != undefined) {
					var form_data = new FormData();
					form_data.append('file', archivoNuevosUsuarios);
					$.ajax({
						type: 'POST',
						url: '../ajax/administracion/ajax_nuevos_usuarios.php',
						contentType: false,
						processData: false,
						data: form_data,
						dataType: 'json',
						success: function(response) {
							if (response == 0) {
								Swal.fire({
									icon: 'warning',
									text: 'Debe seleccionar un archivo, campo vacío.'
								});
							} else if (response == 1) {
								Swal.fire({
									icon: 'error',
									text: 'Error al cargar archivo, número de columnas menor/mayor al establecido'
								});
								$('.cargarNuevosUsuarios').prop('disabled', false);
							} else if (response != '') {
								$.each(response, function(i, item) {
									var $tr = '<tr>' +
										'<td>' + item.no_reloj + '</td>' +
										'<td>' + item.nombre + '</td>' +
										'<td>' + item.apellidos + '</td>' +
										'<td>' + item.fecha_nacimiento + '</td>' +
										'<td>' + item.fecha_ingreso + '</td>' +
										'<td>' + item.correo + '</td>' +
										'<td>' + item.region + '</td>' +
										'<td>' + item.supervisor + '</td>' +
										'</tr>';
									$('#tablaNuevosUsuarios').find('tbody').append($tr);

								});
								$('#tablaNuevosUsuarios').DataTable();
								$('.btnEnviarNuevosUsuarios').removeClass('btn-secondary, disabled').addClass('btn-success');
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: 'Error al cargar listado!',
									timer: 800
								});
							}
						}
					});
				}
				return false;
			});

			$(document).on('click', '.btnEnviarNuevosUsuarios', function(e) {
				e.preventDefault();
				var arrayNuevosIngresos = [];
				var tablaNuevosIngresos = $('#tablaNuevosUsuarios').dataTable();
				$(tablaNuevosIngresos.fnGetNodes()).each(function(index, tr) {
					var tempArrayIngresos = [];
					$(tr).find('td').each(function() {
						tempArrayIngresos.push($(this).text());
					});
					arrayNuevosIngresos.push(tempArrayIngresos);
				});
				Swal.fire({
					icon: 'warning',
					title: 'Esta seguro que quiere dar de alta usuarios?',
					text: 'Se enviara correo de creación de cuenta a cada colaborador',
					footer: 'NOTA: Debe esperar a que le se muestre "Colaboradores dados de alta correctamente"',
					showCancelButton: true,
					confirmButtonText: 'Dar de Alta',
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: '../ajax/administracion/ajax_cargar_nuevos_usuarios.php',
							type: 'POST',
							data: {
								rows: arrayNuevosIngresos
							},
							success: function(data) {

								var data = data.trim();
								if (data == 1) {
									Swal.fire({
										icon: 'success',
										text: 'Colaboradores dados de alta correctamente!'
									});
								} else {
									Swal.fire({
										icon: 'error',
										text: 'Error al dar alta de usuarios',
										footer: 'NOTA: Revise que no haya colaboradores ya registrados.'
									});
								}
							}
						});
					}
				})
			});
		});
	</script>
</body>

</html>