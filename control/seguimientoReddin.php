<?php
session_start();
setlocale(LC_ALL, "es_MX.UTF-8");
if (empty($_SESSION["no_reloj"])) {
	header("location:../error.html");
	exit();
}
$cargoColab = $_SESSION['cargoColab'];
$reloj = $_GET['relojColaborador'];
include("../conexion/conexion.php");
$msg = "";
$mes_actual = Date('F');
$mes_anterior = date('F', strtotime('-1 month'));


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>GDP - Reddin Personal</title>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
					<span>Mi Perfil</span>
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
				<a class="nav-link active" href="seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
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
			<div class="container-fluid">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><span class="fas fa-user-check"></span> Cumplimiento Planes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><span class="fas fa-users"></span>Seguimiento Planes x Lider</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> <span class="fas fa-user-clock"></span> Personal Pendiente</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="row mt-3">
							<div class="col-md-9">

							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-12">
										<div class="card slicer_region_reddin">
											<h5 class="card-header">REGION</h5>
											<div class="card-body text-center">
												<div class="btn-group btn-group-sm" role="group" aria-label="First group">
													<?php
													$sql_region =  mysqli_query($conn, "SELECT region FROM registrogdp GROUP BY region ORDER BY region ASC");
													while ($r = mysqli_fetch_array($sql_region)) {
													?>
														<button type="button" class="btn btn-outline-secondary" value="<?= $r['region'] ?>"><?= $r['region'] ?></button>
													<?php
													}
													mysqli_free_result($sql_region);
													?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card slicer_deptos_reddin">
											<div class="card-header">
												<div class="row clearfix">
													<div class="col-md-6 colTitulo float-left">
														DEPARTAMENTOS
													</div>
													<div class="col-md-6 colBotones">
														<button class="btn btn-sm btn-outline-success float-right selectAllDeptos">Seleccionar todo</button>
														<button class="btn btn-sm btn-outline-danger float-right uncheckAllDeptos" style="display:none;">Deseleccionar todo</button>
													</div>
												</div>
											</div>
											<div class="card-body text-center">
												<div class="btn-group" role="group" aria-label="First group">
													<div class="btn-group-vertical btn-group-sm btn-group-toggle" data-toggle="buttons">
														<?php $sql_deptos = mysqli_query($conn, "SELECT depto FROM registrogdp GROUP BY depto ORDER BY depto ASC");
														while ($d = mysqli_fetch_array($sql_deptos)) {
														?>
															<label class="btn btn-sm btn-outline-secondary">
																<input type="checkbox" name="depto" value="<?= $d['depto'] ?>"><?= $d['depto'] ?>
															</label>

														<?php
														}
														mysqli_free_result($sql_deptos);
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="button" class="btn btn-sm btn-primary float-right mt-1" id="btnFiltroPlanes"> Aplicar Filtro <i class="fas fa-filter"></i></button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" id="div_tabla_cumplimiento"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="row">
							<div class="col-md-12">
								<div class="card slicer_lider_planes mt-3">
									<h5 class="card-header">LIDER</h5>
									<div class="card-body">
										<form action="">
											<select class="form-control selectpicker show-tick" data-style="btn-info" name="" id="supervisor" title="Buscar Lider" data-live-search="true">
												<?php
												$Search = mysqli_query($conn, "SELECT * FROM registrogdp reg INNER JOIN t_reddin red ON reg.no_reloj = red.no_reloj GROUP BY reg.no_reloj_supervisor ORDER BY nombres ASC;");
												if (mysqli_num_rows($Search) > 0) {
													while ($datos = mysqli_fetch_array($Search)) {
														$reloj_lider = $datos["no_reloj_supervisor"];
														$result = mysqli_query($conn, "SELECT * FROM registrogdp WHERE no_reloj = '$reloj_lider'  ORDER BY nombres ASC");
														if (mysqli_num_rows($result) > 0) {
															while ($datos = mysqli_fetch_array($result)) {
																$nombres = $datos["nombres"];
																$apellidos = $datos["apellidos"];
																echo '<option selected hidden >Seleccione supervisor</option>';
																echo '<option value="' . $datos["no_reloj"] . '">' . $datos["nombres"] . " " . $datos['apellidos'] . '</option>';
															}
															mysqli_free_result($result);
														} else {
															echo 'Error al encontrar colaborador';
														}
													}
													mysqli_free_result($Search);
												} else {
													echo 'Error al encontrar colaborador';
												}
												?>
											</select>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-12" id="reddin_supervisor"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<div class="row mt-3 h-100 p-5 bg-light border rounded-3">
							<div class="col-md-12">
								<form>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-2 col-form-label">Fecha inicial</label>
										<div class="col-sm-2">
											<select class="custom-select custom-select-sm" id="input_fecha_inicial_mes">
												<?php
												$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
												$array = $meses;
												for ($m = 0; $m < sizeof($array); $m++) {
													echo '<option value="' . $array[$m] . '">' . $array[$m] . '</option>';
												}
												?>
											</select>
										</div>
										<div class="col-sm-2">
											<select class="custom-select custom-select-sm" id="input_fecha_inicial_anio">
												<?php
												$año_actual = Date('Y');
												for ($i = 2018; $i <= $año_actual; $i++) {
													echo '<option value="' . $i . '">' . $i . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPassword3" class="col-sm-2 col-form-label">Fecha Final</label>
										<div class="col-sm-2">
											<select class="custom-select custom-select-sm" id="input_fecha_final_mes">
												<?php
												$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
												$array = $meses;
												for ($m = 0; $m < sizeof($array); $m++) {
													echo '<option value="' . $array[$m] . '">' . $array[$m] . '</option>';
												}
												?>
											</select>
										</div>
										<div class="col-sm-2">
											<select class="custom-select custom-select-sm" id="input_fecha_final_anio">
												<?php
												$año_actual = Date('Y');
												for ($i = 2018; $i <= $año_actual; $i++) {
													echo '<option value="' . $i . '">' . $i . '</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-10">
											<button type="button" id="btn_filter_planes_pendientes" class="btn btn-primary btn-sm">Filtrar</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-12 table-responsive">
								<div id="tabla_planes_pendientes"></div>
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

		<script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
		<script src="../vendor/bootstrap/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<script src="../js/sb-admin.min.js"></script>
		<script src="../js/reddin.js"></script>
		<script>
			$(document).ready(function() {
				$('.checkbox_region_label').on('click', function() {
					$($(this)).find('input[type=checkbox]').addClass('checked');

				});
				$('#supervisor').on('change', function() {
					var supervisor = $(this).val();
					if (supervisor != '') {
						$('#reddin_supervisor').load('../loads/reddin/seguimientoReddin.php', {
							'reloj_supervisor': supervisor
						});
					}
				});
				$('#tabla_planes_pendientes').load('../../loads/reddin/tabla_planes_pendientes.php');

				$('#btn_filter_planes_pendientes').on('click', function() {
					//Fecha inicial
					var mes_inicial = $('#input_fecha_inicial_mes').val();
					var anio_inicial = $('#input_fecha_inicial_anio').val();
					var mes_final = $('#input_fecha_final_mes').val();
					var anio_final = $('#input_fecha_final_anio').val();
					$.ajax({
						url: '../../loads/reddin/tabla_planes_pendientes.php',
						method: "POST",
						data: {
							mes_inicial: mes_inicial,
							anio_inicial: anio_inicial,
							mes_final: mes_final,
							anio_final: anio_final
						},
						success: function(data) {
							$('#tabla_planes_pendientes').load('../../loads/reddin/tabla_planes_pendientes.php');
						}
					});
				});

				$(".selectAllDeptos").on('click', function() {
					$(".checkbox_deptos").addClass("active");
					$(".checkbox_depto").prop("checked", true);
					$($(this)).css('display', 'none');
					$('.uncheckAllDeptos').css('display', 'block');
				});

				$(".uncheckAllDeptos").on('click', function() {
					$(".checkbox_deptos").removeClass("active");
					$(".checkbox_depto").prop("checked", false);
					$($(this)).css('display', 'none');
					$('.selectAllDeptos').css('display', 'block');
				});
			});
		</script>
</body>

</html>