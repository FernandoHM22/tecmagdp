<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
   header("location:../error.html");
   exit();
}
$cargoColab = $_SESSION['cargoColab'];
$reloj_sup = $_SESSION['no_reloj'];
$reloj = $_GET['relojColaborador'];
include("../conexion/conexion.php");
$msg = "";
$anio_actual = date('Y');
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
   <style>
      #matrizPotencial {
         overflow-y: hidden;
         overflow-x: hidden;
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
         <div class="container">
            <div class="row">
               <!-- div colaborador/lider-->
               <div class="col-md-6">
                  <div class="card card-reddin cardColaborador">
                     <div class="card-header">
                        Colaborador
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-3 text-center">
                              <?php
                              $sqlColaborador = mysqli_query($conn, "SELECT nombres, apellidos, img, no_reloj_supervisor FROM registrogdp WHERE no_reloj ='$reloj'");
                              while ($dato = mysqli_fetch_assoc($sqlColaborador)) {
                                 $no_relojSupervisor = $dato['no_reloj_supervisor'];
                                 echo '<h5 class="card-title">' . $dato["nombres"] . '</h5>
                           <img src="' . $dato["img"] . '">';
                              }
                              mysqli_free_result($sqlColaborador);
                              ?>
                           </div>
                           <!-- div oportunidades/fortalezas colaborador-->
                           <div class="col-md-9">
                              <div class="row divOportunidFortaleza">
                                 <div class="col-md-6">
                                    <span class="tituloOportunidadFortaleza">Oportunidades</span>
                                    <ul>
                                       <?php
                                       $sqlOportunidadesColaborador = mysqli_query($conn, "SELECT oportunidad FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider IS NULL LIMIT 3");
                                       while ($datos = mysqli_fetch_assoc($sqlOportunidadesColaborador)) {
                                          echo '<li><i class="fas fa-circle-notch"></i> ' . $datos["oportunidad"] . '</li>';
                                       }
                                       mysqli_free_result($sqlOportunidadesColaborador);
                                       ?>
                                    </ul>
                                 </div>
                                 <div class="col-md-6">
                                    <span class="tituloOportunidadFortaleza">Fortalezas</span>
                                    <ul>
                                       <?php
                                       $sqlFortalezasColaborador = mysqli_query($conn, "SELECT fortaleza FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider IS NULL  LIMIT 3");
                                       while ($datos = mysqli_fetch_assoc($sqlFortalezasColaborador)) {
                                          echo '<li><i class="fas fa-circle-notch"></i> ' . $datos["fortaleza"] . '</li>';
                                       }
                                       mysqli_free_result($sqlFortalezasColaborador);
                                       ?>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- fin div oportunidades/fortalezas colaborador-->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card card-reddin cardLider">
                     <div class="card-header">
                        Lider
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-3 text-center">
                              <?php
                              $sqlLider = mysqli_query($conn, "SELECT nombres, apellidos, img FROM registrogdp WHERE no_reloj ='$no_relojSupervisor'");
                              while ($datos = mysqli_fetch_assoc($sqlLider)) {
                                 echo '<h5 class="card-title">' . $datos["nombres"] . '</h5>
                              <img src="' . $datos["img"] . '">';
                              }
                              mysqli_free_result($sqlLider);
                              ?>
                           </div>
                           <!-- div oportunidades/fortalezas colaborador-->
                           <div class="col-md-9">
                              <div class="row divOportunidFortaleza">
                                 <div class="col-md-6">
                                    <span class="tituloOportunidadFortaleza">Oportunidades</span>
                                    <ul>
                                       <?php
                                       $sqlOportunidadesLider = mysqli_query($conn, "SELECT oportunidad FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider = '$no_relojSupervisor'  LIMIT 3");
                                       while ($datos = mysqli_fetch_assoc($sqlOportunidadesLider)) {
                                          echo '<li><i class="fas fa-circle-notch"></i> ' . $datos["oportunidad"] . '</li>';
                                       }
                                       mysqli_free_result($sqlOportunidadesLider);
                                       ?>
                                    </ul>
                                 </div>
                                 <div class="col-md-6">
                                    <span class="tituloOportunidadFortaleza">Fortalezas</span>
                                    <ul>
                                       <?php
                                       $sqlFortalezasLider = mysqli_query($conn, "SELECT fortaleza FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider  = '$no_relojSupervisor'   LIMIT 3");
                                       while ($datos = mysqli_fetch_assoc($sqlFortalezasLider)) {
                                          echo '<li><i class="fas fa-circle-notch"></i> ' . $datos["fortaleza"] . '</li>';
                                       }
                                       mysqli_free_result($sqlFortalezasLider);
                                       ?>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- fin div oportunidades/fortalezas colaborador-->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- fin div colaborador/lider-->
            </div>
            <div class="row pt-2 pb-2">
               <div class="col-md-2">
                  <div class="divIndicadores"></div>
               </div>
               <div id="divTablaReddin" class="col-md-10"></div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-reddin">
                     <div class="card-header">
                        Matriz Potencial-Desempeño
                     </div>
                     <div class="card-body">
                        <div class="row p-3" id="divMatrizPotencialDesempeno"></div>
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
         <div class="copyright text-center my-auto"> <span>Copyright © GDP | Tecma 2022</span> </div>
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

   <div class="modal fade" id="modalVerAccionesReddin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Acciones Especificas</h4>
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modalAcciones"></div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalVerNotasReddin" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Notas para el diálogo</h4>
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modalBody p-3">
               <!-- Content goes in here -->
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalHistoricoPlanesReddin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Planes Cerrados</h4>
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body-histoticoPlanes">
               <div class="divPlanesCumplidosReddin"></div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="editarFicha" tabindex="-1" role="dialog">
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

   <script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
   <script src="../vendor/bootstrap/popper.min.js"></script>
   <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
   <script src="../js/sb-admin.min.js"></script>
   <script src="../js/reddin.js"></script>
   <script>
      $(document).ready(function() {
         window.noReloj = "<?php echo $reloj ?>";
         window.noRelojL = "<?php echo $no_relojSupervisor ?>";

         $('#divTablaReddin').load('../loads/planes/planActual.php', {
            no_reloj: '<?= $reloj ?>',
            no_reloj: '<?= $reloj ?>',
            rol: 'admin'
         });
         $('#divMatrizPotencialDesempeno').load('../loads/reddin/tablaMatriz.php', {
            no_reloj: '<?= $reloj ?>',
            no_reloj_sup: '<?= $_SESSION["no_reloj"] ?>',
         });
         $('.divIndicadores').load('../loads/reddin/indicadores.php', {
            no_reloj: '<?= $reloj ?>'
         });

         $('#graficaEfectividad').on('click', function() {
            CargarDatosGraficaPlanes();
         });

         function CargarDatosGraficaPlanes() {
            var noReloj = "<?php echo $reloj ?>";
            $.ajax({
               url: "../../control/reportes/graficas/efectividad/controlador_graficoEfectividad.php",
               type: "POST",
               data: {
                  noReloj: noReloj
               }

            }).done(function(resp) {
               if (resp.length > 0) {
                  var titulo = [];
                  var cantidad = [];
                  var data = JSON.parse(resp);
                  for (var i = 0; i < data.length; i++) {
                     titulo.push(data[i][3]);
                     cantidad.push(data[i][1]);
                  }
                  CrearGrafico(titulo, cantidad);
               }
            });
         };

         function CrearGrafico(titulo, cantidad) {
            new Chart(document.getElementById("myChart"), {
               type: 'line',
               data: {
                  labels: titulo,
                  datasets: [{
                     data: cantidad,
                     label: "Efectividad Gerencia x año",
                     backgroundColor: "#70d6db",
                     borderColor: ["#70d6db"],
                     borderWidth: 4,
                     pointBackgroundColor: "#fff",
                     pointRadius: [8, 8, 8, 8, 8, 8, 8],
                     pointHoverRadius: 8,
                     pointHoverBackgroundColor: "#0ba8b0",
                     pointHoverBorderColor: "#26c1c9",
                     pointBorderColor: "#26c1c9"
                  }]
               },
               options: {
                  title: {
                     display: true,
                     text: 'World population per region (in millions)'
                  },
                  scales: {
                     y: {
                        beginAtZero: true,
                        max: 5
                     }
                  },
               },
            });
         }

         $('#modalVerNotasReddin').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id_reddin=' + recipient;
            $.ajax({
               type: "GET",
               url: "../actions/verNotasReddin.php",
               data: dataString,
               cache: false,
               success: function(data) {
                  console.log(data);
                  modal.find('.modalBody').html(data);
               },
               error: function(err) {
                  console.log(err);
               }
            });
         })
      });
   </script>
</body>

</html>