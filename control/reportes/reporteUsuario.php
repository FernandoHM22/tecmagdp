<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
	header("location:../../error.html");
	exit();
}
include("../../conexion/conexion.php");
$cargoColab = $_SESSION['cargoColab'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>GDP - Reporte Usuarios</title>
	<link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../../img/favicon.png" type="image/x-icon">
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
	<style>
		.dt-button {
			padding: 2px 11px !important;
		}

		.dt-button span {
			font-size: 12px;
		}

		.dt-button span::after {
			display: inline-block;
			padding-left: 3px;
			vertical-align: middle;
		}
		.dt-button.buttons-copy span::after {
			font-family: "Font Awesome 5 Free";
			content: "\f0c5";
		}
		.dt-button.buttons-excel span::after {
			font-family: "Font Awesome 5 Free";
			content: "\f1c3";
			color: #00783b;
		}
		.dt-button.buttons-csv span::after {
			font-family: "Font Awesome 5 Free";
			content: "\f65b";
			color: #2773e9;
		}
		.dt-button.buttons-pdf span::after {
			font-family: "Font Awesome 5 Free";
			content: "\f1c1";
			color:#d10404;
		}
	</style>
</head>
<body id="page-top">
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top"> <a class="navbar-brand mr-1" href="../../admin/myinfoSup.php">GDP</a>
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
												echo '../../user/myinfo';
											} else {
												echo '../../admin/myinfoSup';
											} ?>">
					<i class="fas fa-chalkboard-teacher"></i>
					<span>Mi Perfil</span>
				</a>
			</li>
			<?php if ($cargoColab == 1) { ?>
				<li class="nav-item">
					<a class="nav-link" href="../../admin/colaboradoresSup.php">
						<i class="fas fa-users"></i>
						<span>Mis Colaboradores</span></a>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../../user/objetivos';
											} else {
												echo '../../admin/objetivosSup';
											} ?>">
					<i class="fas fa-fw fa-bullseye"></i>
					<span>Mis Objetivos</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../../user/planeacion';
											} else {
												echo '../../admin/planeacionSup';
											} ?>">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Plan de Desarrollo</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php if ($cargoColab == 0) {
												echo '../../user/biblioteca.php';
											} else {
												echo '../../admin/biblioteca.php';
											} ?>">
					<i class="fas fa-book"></i>
					<span>Biblioteca</span>
				</a>
			</li>
			<hr>
			<br>
			<?php if ($_SESSION['isAdmin'] == 1) { ?>
				<li class="nav-item">
					<a class="nav-link" href="../../control/administracion.php"> <i class="fas fa-toolbox"></i> <span> Administración</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
					<div class="dropdown-menu" style="margin-right: 0px;">
						<a class="dropdown-item active" href="reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
						<a class="dropdown-item" href="reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
						<a class="dropdown-item" href="reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
						<a class="dropdown-item" href="reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
						<a class="dropdown-item" href="reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
						<a class="dropdown-item" href="reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
					</div>
				</li>
			<?php } ?>
		</ul>
		<div id="content-wrapper">
			<div class="col-md-12">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuarios</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Colaboradores por Lider</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="colaboradoresxdepto-tab" data-toggle="tab" href="#colaboradoresxdepto" role="tab" aria-controls="colaboradoresxdepto" aria-selected="false">Colaboradores por Departamento</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="table table-responsive  table-sm col-md-12 mt-3">
							<table id="t_reporteUsuarios" class="table-compact table-bordered" style="width:100%">
								<thead>
									<tr class="text-center">
										<th width="10%">Reloj</th>
										<th>Nombre Colaborador</th>
										<th>Correo</th>
										<th>Puesto</th>
										<th>Depto.</th>
										<th>Área</th>
										<th width="5%">Opciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sqlQuery = "SELECT * from registrogdp" or die(mysqli_error($conn));
									$resultado = mysqli_query($conn, $sqlQuery);
									if (mysqli_num_rows($resultado) > 0) {
										while ($datos = mysqli_fetch_array($resultado)) {
									?>
											<tr>
												<td><?= $datos['no_reloj'] ?></td>
												<td><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?></td>
												<td><?= $datos['correo'] ?></td>
												<td><?= $datos['puesto']; ?></td>
												<td><?= $datos['depto'] ?></td>
												<td><?= $datos['area'] ?></td>
												<td class="text-center">
													<a class="delete" title="Eliminar" data-toggle="tooltip" id="<?= $datos['no_reloj']; ?>"><i class="fas fa-trash"></i></a>
												</td>
											</tr>
									<?php
										}
										mysqli_free_result($resultado);
									}	?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="card mt-2">
							<div class="card-header">

							</div>
							<div class="card-body">
								<select class="selectpicker show-tick" name="" id="selectColaboradoresporLider" data-width="100%" data-live-search="true" title="Buscar por lider">
									<?php
									$sql_colaborador_lider = "SELECT no_reloj, nombres, apellidos FROM registrogdp WHERE cargoColab = '1' ORDER BY nombres ASC";
									$sql_run = mysqli_query($conn, $sql_colaborador_lider);
									if (mysqli_num_rows($sql_run) > 0) {
										while ($row = mysqli_fetch_assoc($sql_run)) {
											echo '<option value="' . $row['no_reloj'] . '">' . $row['nombres'] . ' ' . $row['apellidos'] . '</option>';
										}
										mysqli_free_result($sql_run);
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-12" id="tabla_colaboradores_x_lider"></div>
					</div>
					<div class="tab-pane fade show active" id="colaboradoresxdepto" role="tabpanel" aria-labelledby="colaboradoresxdepto-tab">
						<div class="card mt-2">
							<div class="card-header">

							</div>
							<div class="card-body">
								<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
									<label class="btn btn-outline-success">
										<input type="radio" name="radiobutonRegion" id="option1" value="Central"> Central
									</label>
									<label class="btn btn-outline-success">
										<input type="radio" name="radiobutonRegion" id="option2" value="West"> West
									</label>
									<label class="btn btn-outline-success">
										<input type="radio" name="radiobutonRegion" id="option3" value="East"> East
									</label>
								</div>
								<select class="selectpicker show-tick" name="" id="selectColaboradoresporDepto" data-width="70%" data-live-search="true" title="Buscar por depto">
									<?php
									$sql_colaborador_lider = "SELECT depto FROM registrogdp  GROUP BY depto  ORDER BY depto ASC";
									$sql_run = mysqli_query($conn, $sql_colaborador_lider);
									if (mysqli_num_rows($sql_run) > 0) {
										while ($row = mysqli_fetch_assoc($sql_run)) {
											echo '<option value="' . $row['depto'] . '">' . $row['depto'] . '</option>';
										}
										mysqli_free_result($sql_run);
									}
									?>
								</select>
								<a href="#" class="btn btn-sm btn-primary" id="buscarColaboradoresDepto"><i class="fas fa-search"></i> Buscar</a>
							</div>
						</div>
						<div class="col-md-12" id="tabla_colaboradores_x_depto"></div>
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
						<a class="btn btn-danger btn-block" href="../../conexion/logout.php">Si</a>
					</div>
				</div>
			</div>
		</div>

		<script src="../../vendor/jquery/jquery-3.4.1.min.js"></script>
		<script src="../../vendor/bootstrap/popper.min.js"></script>
		<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../js/sb-admin.min.js"></script>
		<script src="../../js/usuarios.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#selectColaboradoresporLider').selectpicker();
		$('#selectColaboradoresporDepto').selectpicker();

		$('#buscarColaboradoresDepto').on('click', function(e) {
			e.preventDefault();
			var region = $("input[name='radiobutonRegion']:checked").val();
			var depto = $('#selectColaboradoresporDepto').val();
			$('#tabla_colaboradores_x_depto').load('../../loads/supervisor/colaboradores_x_depto.php', {
				'depto': depto,
				'region': region
			});
		});

		$('#t_reporteUsuarios thead tr').clone(true).appendTo('#t_reporteUsuarios thead');
		$('#t_reporteUsuarios thead tr:eq(1) th').each(function(i) {
			var title = $(this).text();
			$(this).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar ' + title + '" />');
			$('tr:nth-child(2)').addClass("encabezadoInputs");

			$('input', this).on('keyup change', function() {
				if (table.column(i).search() !== this.value) {
					table
						.column(i)
						.search(this.value)
						.draw();
				}
			});
		});

		var table = $('#t_reporteUsuarios').DataTable({
			responsive: true,
			orderCellsTop: true,
			fixedHeader: true,
			stateSave: true,
			columnDefs: [{
				targets: 1,
				className: 'noVis'
			}],
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			],
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
			}
		});
	});
</script>