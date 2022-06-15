<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
   header("location:../error.html");
   exit();
}
$cargoColab = $_SESSION['cargoColab'];
$admin = $_SESSION["isAdmin"];
$reloj = $_GET['relojColaborador'];
include("../conexion/conexion.php");
$msg = "";
$anio_actual = date('Y');
setlocale(LC_ALL, "es_ES");

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
                                          echo '../user/ingles';
                                       } else {
                                          echo '../admin/inglesSup';
                                       } ?>">
               <i class="fas fa-fw fa-flag"></i>
               <span>Ingles</span>
            </a>
         </li>
         <hr>
         <br>
         <?php
         if ($admin == 1) {
         ?>
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
         <?php
         }
         if ($admin == 2 || $admin == 4) { ?>
            <li class="nav-item">
               <a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
            </li>
         <?php }
         if ($admin == 3) { ?>
            <li class="nav-item">
               <a class="nav-link" href="../control/reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
            </li>
         <?php } ?>
      </ul>
      <div id="content-wrapper">
         <div class="container-fluid">

            <?php
            if ($admin == 1) {
            ?>
               <div class="row">
                  <div class="col-md-12 text-right">
                     <ul class="list-inline menuAdministrador">
                        <a title="Objetivos" data-toggle="tooltip" href="reportPersonal.php?no_reloj_col=<?php echo $reloj; ?>&displayCard=d-blockObjetivos&eventCard=objetivos">
                           <li class="list-inline-item"><i class="fas fa-fw fa-bullseye"></i></li>
                        </a>
                        <a title="Plan Desarrollo" data-toggle="tooltip" href="reportPersonal.php?no_reloj_col=<?php echo $reloj; ?>&displayCard=d-blockPlanes&eventCard=planes">
                           <li class="list-inline-item"><i class="fas fa-fw fa-chart-area"></i></li>
                        </a>
                        <a title="Sesión de Talento" data-toggle="tooltip" href="reddin.php?relojColaborador=<?php echo $reloj; ?>">
                           <li class="list-inline-item"><i class="fas fa-user-check"></i></li>
                        </a>
                        <a href="" data-toggle="modal" data-target="#editarFicha" data-whatever="<?php echo $reloj; ?>">
                           <li class="list-inline-item"><i class="fas fa-edit"></i></li>
                        </a>
                     </ul>
                  </div>
               </div>
            <?php } ?>

            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link  " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">REGISTRO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false">DASHBOARD</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row mt-4">
                     <div class="col-md-10">

                        <div class="row justify-content-between">
                           <div class="col-4">
                              <a href="#" id="agregar_gptw"><i class="fa fa-plus"></i> Nueva oportunidad</a>

                              <a href="#" class="cancelar_btn_gptw" hidden><i class="fas fa-times"></i> Cancelar</a>
                           </div>
                           <div class="col-4 text-right">
                              <a href="#" data-toggle="modal" data-target="#modalHistoricoPlanesReddin" data-whatever="<?= $reloj ?>" id="historico_gptw"><i class="fas fa-history"></i> Histórico</a>
                           </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-md-12">
                              <form id="form_agregar_gptw" hidden>
                                 <div class="row mb-5 align-items-center">
                                    <div class="col-3">
                                       <select class="custom-select custom-select-sm" disabled id="input_oportunidades_gptw" required>
                                          <option hidden>Seleccionar oportunidad...</option>
                                          <option value="Respeto">Respeto</option>
                                          <option value="Confianza">Confianza</option>
                                          <option value="Credibilidad">Credibilidad</option>
                                          <option value="Cuidando">Cuidando</option>
                                          <option value="Escuchando">Escuchando</option>
                                          <option value="Comunicando">Comunicando</option>
                                          <option value="Agradeciendo">Agradeciendo</option>
                                          <option value="Imparcialidad">Imparcialidad</option>
                                          <option value="Integración del equipo">Integración del equipo</option>
                                       </select>
                                    </div>
                                    <div class="col-8">
                                       <textarea class="form-control form-control-sm" disabled id="input_notas" cols="30" placeholder="Notas para el dialogo" rows="1"></textarea>
                                    </div>
                                    <div class="col-1 mx-auto">
                                       <input type="text" class="form-control" name="reloj" id="no_reloj" value="<?php echo $reloj; ?>" hidden>
                                       <input type="text" class="form-control" name="fechacompromiso" id="fechacompromiso" value="Revisión Mensual" hidden>
                                       <input type="text" class="form-control" name="indicador" id="indicador" value="GPTW" hidden>
                                       <input type="text" class="form-control" name="fecha_regA" id="fecha_reg" hidden value="<?php echo strftime("%d de %B del %Y"); ?>">
                                       <input type="text" class="form-control" name="tipo_plan" id="tipo_plan" hidden value="GPTW">
                                       <input type="text" name="mes_reg" id="mes_reg" hidden value="<?php echo strftime("%B"); ?>">
                                       <input type="text" name="year_reg" id="year_reg" hidden value="<?php echo $anio_actual; ?>">
                                       <a href="#" class="guardar_gptw"><i class="far fa-save"></i></a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 divGPTW"></div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="row card_gptw">
                           <div class="col text-center">
                              <div class="card" style="max-width: 18rem;">
                                 <div class="card-header border-left">Colaborador</div>
                                 <div class="card-body">

                                    <?php
                                    $resultado = mysqli_query($conn, "SELECT * FROM registrogdp  WHERE no_reloj = '$reloj'") or die(mysqli_error($conn));
                                    if (mysqli_num_rows($resultado) > 0) {
                                       while ($datos = mysqli_fetch_assoc($resultado)) { ?>
                                          <p style="font-size: 12.5px;"><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?></p>
                                          <img src="<?= $datos['img'] ?>" width="80px;" height="auto" class="rounded m-0 p-0">
                                    <?php
                                       }
                                       mysqli_free_result($resultado);
                                    } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row card_gptw">
                           <div class="col text-center">
                              <div class="card" style="max-width: 18rem;">
                                 <div class="card-body text-info">
                                    <img src="../img/logo_gptw.png" width="80px" height="auto" alt="">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                  <div class="row mt-4">
                     <div class="col-md-3">
                        <div class="card">
                           <div class="card-header">
                              <div class="row clearfix">
                                 <div class="col-md-7 colTitulo float-left">
                                    Región
                                 </div>
                                 <div class="col-md-5 colBotones">
                                    <button class="btn btn-sm btn-outline-success float-right selectAllRegion"><i class="fa fa-list"></i></button>
                                    <button class="btn btn-sm btn-outline-danger float-right uncheckAllRegion" style="display:none;"><i class="fa fa-filter"></i></button>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body slicer_region text-center">
                              <div class="btn-group" role="group" aria-label="Basic example">
                                 <div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
                                    <label class="btn checkbox_region">
                                       <input type="checkbox" name="region" value="Central" id="region1"> Central
                                    </label>
                                    <label class="btn checkbox_region">
                                       <input type="checkbox" name="region" value="West" id="region2"> West
                                    </label>
                                    <label class="btn checkbox_region">
                                       <input type="checkbox" name="region" value="East" id="region3"> East
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <div class="card cardMesesGPTW">
                           <div class="card-header">
                              <div class="row clearfix">
                                 <div class="col-md-7 colTitulo float-left">
                                    Mes
                                 </div>
                                 <div class="col-md-5 colBotones">
                                    <button class="btn btn-sm btn-outline-success float-right selectAllMeses"><i class="fa fa-list"></i></button>
                                    <button class="btn btn-sm btn-outline-danger float-right uncheckAllMeses" style="display:none;"><i class="fa fa-filter"></i></button>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body slicer_meses text-center">
                              <div class="btn-group" role="group" aria-label="Basic example">
                                 <?php
                                 $Meses = array(
                                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                                 );
                                 for ($i = 1; $i <= 12; $i++) {
                                    echo '<div class="btn-group-toggle" data-toggle="buttons">
                                             <label class="btn btn-sm labels_meses">    
                                             <input type="checkbox" name="mes" class="checkbox_meses" id="mes' . $i . '" value="' . $Meses[($i) - 1] . '"> ' . $Meses[($i) - 1] . '
                                             </label>
                                             </div>';
                                 }
                                 ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-9">
                        <a href="#" class="btn btn-sm btnFiltrarGPTW disabled"><i class="fas fa-filter"></i> Filtrar</a>
                        <div class="dashboardChartsGPTW"></div>
                        <div class="mt-4 dashboardTablaGPTW"></div>
                        <a href="#" class="btn btn-sm btn-outline-primary float-right mt-2 disabled"> <i class="fas fa-envelope"></i> Enviar Recordatorio</a>
                     </div>
                     <div class="col-md-3">
                        <div class="card card-gptw">
                           <div class="card-header">
                              <div class="row clearfix">
                                 <div class="col-md-7 colTitulo float-left">
                                    DEPARTAMENTOS
                                 </div>
                                 <div class="col-md-5 colBotones">
                                    <button class="btn btn-sm btn-outline-success float-right selectAllDeptos"><i class="fa fa-list"></i></button>
                                    <button class="btn btn-sm btn-outline-danger float-right uncheckAllDeptos" style="display:none;"><i class="fa fa-filter"></i></button>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body slicer_deptos text-center">
                              <div class="btn-group" role="group" aria-label="...">
                                 <div class="btn-group-vertical btn-group-sm btn-group-toggle" data-toggle="buttons">
                                    <?php
                                    $sql_deptos = mysqli_query($conn, "SELECT g.no_reloj, g.seguimiento, r.no_reloj, r.depto FROM t_calificaciones_gptw g INNER JOIN registrogdp r ON seguimiento = '1' AND g.no_reloj = r.no_reloj GROUP BY r.depto ASC;") or mysqli_error($conn);
                                    if (mysqli_num_rows($sql_deptos) > 0) {
                                       while ($row = mysqli_fetch_assoc($sql_deptos)) {
                                    ?>
                                          <label class="btn btn-sm labels_checkbox_deptos">
                                             <input type="checkbox" name="depto" class="checkbox_deptos" id="depto1" value="<?= $row['depto'] ?>"> <?= $row['depto'] ?>
                                          </label>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </div>
                              </div>
                           </div>
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

   <div id="Modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md" role="document">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Efectividad Gerencial</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <canvas id="myChart" width="200" height="100"></canvas>
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
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="../js/sb-admin.min.js"></script>
   <script src="../js/main.js"></script>
   <script>
      $('.divGPTW').load('../loads/gptw/tabla_gptw.php', {
         'no_reloj': '<?php echo $reloj ?>'
      });
      $('.dashboardTablaGPTW').load('../loads/gptw/tabla_dashboard_gptw.php');
      $('.dashboardChartsGPTW').load('../loads/gptw/charts_dashboard_gptw.php');
      window.noReloj = "<?php echo $reloj ?>";
      window.noRelojL = "<?php echo $relojLider ?>";


      $(".btnFiltrarGPTW").on('click', function(e) {
         e.preventDefault();
         var selectedRegion = new Array();
         $("input[name=region]:checked").each(function() {
            selectedRegion.push(this.value);
         });
         var selectedMes = new Array();
         $("input[name=mes]:checked").each(function() {
            selectedMes.push(this.value);
         });
         var selectedDepto = new Array();
         $("input[name=depto]:checked").each(function() {
            selectedDepto.push(this.value);
         });
         // $('.dashboardChartsGPTW').load('../loads/gptw/charts_dashboard_gptw.php');

         // $('.dashboardTablaGPTW').load('../loads/gptw/tabla_dashboard_gptw.php', {
         //    region: selectedRegion,
         //    mes: selectedMes,
         //    depto: selectedDepto
         // });
         if (selectedRegion == '' && selectedMes == '') {
            $('.dashboardTablaGPTW').load('../loads/gptw/tabla_avance_deptos_gptw.php', {
               depto: selectedDepto
            });
         } else {
            $('.dashboardTablaGPTW').load('../loads/gptw/tabla_dashboard_gptw.php', {
               region: selectedRegion,
               mes: selectedMes,
               depto: selectedDepto
            });
         }
      });



      $('.checkbox_meses').on('click', function() {
         $('.btnFiltrarGPTW').removeClass('disabled');
      });

      $("input[type=checkbox]").on('change', function() {
         $('.btnFiltrarGPTW').removeClass('disabled');
      });

      $(".selectAllRegion").on('click', function() {
         $(".checkbox_region").addClass("active");
         $("input[name='region']").prop("checked", true);
         $($(this)).css('display', 'none');
         $('.uncheckAllRegion').css('display', 'block');
         $('.btnFiltrarGPTW').removeClass('disabled');
      });

      $(".uncheckAllRegion").on('click', function() {
         $(".checkbox_region").removeClass("active");
         $("input[name='region']").prop("checked", false);
         $($(this)).css('display', 'none');
         $('.selectAllRegion').css('display', 'block');
      });
      $(".selectAllDeptos").on('click', function() {
         $(".labels_checkbox_deptos").addClass("active");
         $("input[name='depto']").prop("checked", true);
         $($(this)).css('display', 'none');
         $('.uncheckAllDeptos').css('display', 'block');
         $('.btnFiltrarGPTW').removeClass('disabled');
      });

      $(".uncheckAllDeptos").on('click', function() {
         $(".labels_checkbox_deptos").removeClass("active");
         $(".checkbox_deptos").prop("checked", false);
         $($(this)).css('display', 'none');
         $('.selectAllDeptos').css('display', 'block');
      });

      $(".selectAllMeses").on('click', function() {
         $(".labels_meses").addClass("active");
         $(".checkbox_meses").prop("checked", true);
         $($(this)).css('display', 'none');
         $('.uncheckAllMeses').css('display', 'block');
         $('.btnFiltrarGPTW').removeClass('disabled');
      });

      $(".uncheckAllMeses").on('click', function() {
         $(".labels_meses").removeClass("active");
         $(".checkbox_meses").prop("checked", false);
         $($(this)).css('display', 'none');
         $('.selectAllMeses').css('display', 'block');
      });
   </script>
</body>

</html>