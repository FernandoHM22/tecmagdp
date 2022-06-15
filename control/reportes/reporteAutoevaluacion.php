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
	<title>GDP - Reporte Evaluaciones</title>
	<link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../../img/favicon.png" type="image/x-icon">
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" rel="stylesheet">
	<link href="../../css/sb-admin.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
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
												echo '../admin/myinfoSup';
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
						<a class="dropdown-item" href="reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
						<a class="dropdown-item active" href="reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
						<a class="dropdown-item" href="reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
						<a class="dropdown-item" href="reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
						<a class="dropdown-item" href="reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
						<a class="dropdown-item" href="reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
					</div>
				</li>
			<?php } ?>
		</ul>
		<div id="content-wrapper">
			<div class="table table-responsive  table-sm col-md-12">
				<table id="t_reporteFichaTalento" class="table-compact table-bordered" style="width:100%">
					<thead>
						<tr class="text-center">
							<th width="10%">Reloj</th>
							<th width="20%">Nombre Colaborador</th>
							<th width="15%">Correo</th>
							<th width="10%">Departamento</th>
							<th width="17%">Líder</th>
							<th width="13%">Oportunidad</th>
							<th width="13%">Oportunidad Lider</th>
							<th width="15%">Fecha Actualización</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sqlQuery = "SELECT r.no_reloj, r.nombres, r.apellidos, r.correo, r.depto, r.no_reloj_supervisor, r.region, o.no_reloj, o.fecha_reg, o.oportunidad, o.reloj_lider FROM registrogdp r  INNER JOIN t_oportunidades o ON o.no_reloj = r.no_reloj" or die(mysqli_error());
						$resultado = mysqli_query($conn, $sqlQuery);
						if (mysqli_num_rows($resultado) > 0) {
							while ($datos = mysqli_fetch_array($resultado)) {
						?>
								<tr>
									<td style="font-weight: 600;"><?= $datos['no_reloj'] ?></td>
									<td><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?></td>
									<td><a href="mailto:<?php echo $datos['correo'] ?>"><?= $datos['correo'] ?></a></td>
									<td><?= $datos['depto'] ?></td>
									<td>
										<?php
										$no_reloj_lider = $datos['no_reloj_supervisor'];
										$sql = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj_lider'");
										$mostrarR = $sql->fetch_assoc();
										echo $mostrarR['nombres'];
										echo " ";
										echo $mostrarR['apellidos'];
										?>
									</td>
									<td><?php echo $datos['oportunidad']; ?></td>
									<td><?php echo $datos['reloj_lider']; ?></td>
									<td><?php echo $datos['fecha_reg']; ?></td>
								</tr>
						<?php
							}
							mysqli_free_result($resultado);
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-sm btn-primary" onClick="CargarDatosGraficosBar()">Generar Graficos</button>
					<canvas id="myChart" width="400" height="400"></canvas>
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
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		// Setup - add a text input to each footer cell
		$('#t_reporteFichaTalento thead tr').clone(true).appendTo('#t_reporteFichaTalento thead');
		$('#t_reporteFichaTalento thead tr:eq(1) th').each(function(i) {
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

		var table = $('#t_reporteFichaTalento').DataTable({

			responsive: true,
			orderCellsTop: true,
			fixedHeader: true,
			dom: 'lBfrtip',
			buttons: [{
					extend: 'copyHtml5',
					text: '<i class="fas fa-copy"></i>',
					titleAttr: 'Copy'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fas fa-file-excel"></i>',
					titleAttr: 'Excel'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="far fa-file-alt"></i>',
					titleAttr: 'CSV'
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fas fa-file-pdf"></i>',
					titleAttr: 'PDF'
				}
			],
			language: {
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontraron resultados",
				"info": "_START_ al _END_ de un total de _TOTAL_ registros",
				"infoEmpty": " 0 al 0 de un total de 0 registros",
				"infoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sSearch": "Buscar:",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"sProcessing": "Procesando...",
			}
		});
	});
</script>