<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
  header("location:../error.html");
  exit();
}
$año =  date("Y");
$cargoColab = $_SESSION['cargoColab'];
$no_reloj_col = $_GET["no_reloj_col"];
$displayCard = $_GET["displayCard"];
$eventCard = $_GET["eventCard"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GDP - Reporte Personal</title>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilo.css">
  <style>
    h6 {
      text-align: center;
      background-color: #007A81;
      border-radius: 5px;
      padding-top: 10px;
      padding-bottom: 10px;
      color: #fff;
      font-size: 17px;
      font-family: Raleway;
      font-weight: 600;
      margin-top: 10px;
      margin-bottom: 40px;
    }

    div.panel {
      max-height: 0;
      overflow: hidden;
      transition: 0.6s ease-in-out;
    }

    #btnEdit {
      border-radius: 10%;
      background: #F67575;
      color: #fff;
      border: none;
      cursor: pointer;
      margin-bottom: 5%;
      margin-right: 15px;
    }

    #btnAcept {
      border-radius: 10%;
      background: #96BFFF;
      color: #fff;
      border: none;
      cursor: pointer;
      margin-bottom: 5%;
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
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-circle fa-fw"></i> </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesion</a> </div>
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
      </li> <?php if ($cargoColab == 1) { ?> <li class="nav-item">
          <a class="nav-link" href="../admin/colaboradoresSup.php">
            <i class="fas fa-users"></i>
            <span>Mis Colaboradores</span></a>
        </li> <?php } ?> <li class="nav-item">
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
        <a class="nav-link active" href="reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
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
      <div class="container-fluid"> <?php
                                    include("../conexion/conexion.php");

                                    $Search = mysqli_query($conn, "SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj_col'");
                                    if (mysqli_num_rows($Search) > 0) {
                                      while ($datos = mysqli_fetch_array($Search)) {
                                    ?> <div>
              <h6>Colaborador: <?= $datos["nombres"] ?> <?= $datos["apellidos"] ?></h6>
            </div> <?php
                                      }
                                      mysqli_free_result($Search);
                                    } else {
                                      echo 'Error al encontrar colaborador';
                                    }
                    ?>
        <div class="row">
          <div class="col-md-12 text-right">
            <ul class="list-inline menuAdministrador">
              <a title="Objetivos" data-toggle="tooltip" href="reportPersonal.php?no_reloj_col=<?php echo $no_reloj_col; ?>&displayCard=d-blockObjetivos&eventCard=objetivos">
                <li class="list-inline-item"><i class="fas fa-fw fa-bullseye"></i></li>
              </a>
              <a title="Plan Desarrollo" data-toggle="tooltip" href="reportPersonal.php?no_reloj_col=<?php echo $no_reloj_col; ?>&displayCard=d-blockPlanes&eventCard=planes">
                <li class="list-inline-item"><i class="fas fa-fw fa-chart-area"></i></li>
              </a>
              <a title="Sesión de Talento" data-toggle="tooltip" href="reddin.php?relojColaborador=<?php echo $no_reloj_col; ?>">
                <li class="list-inline-item"><i class="fas fa-user-check"></i></li>
              </a>
              <a href="" data-toggle="modal" data-target="#editarFicha" data-whatever="<?php echo $no_reloj_col; ?>">
                <li class="list-inline-item"><i class="fas fa-edit"></i></li>
              </a>
            </ul>
          </div>
        </div>
        <div id="accordion">
          <div class="card <?php if ($displayCard == 'd-blockObjetivos') {
                              echo "d-block";
                            } else {
                              echo "d-none";
                            } ?>">
            <div class="card-header acordion" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="fas fa-bullseye"></span> Objetivos</button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse <?php if ($eventCard == 'objetivos') {
                                                    echo "show";
                                                  } ?>" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <div class=" col-sm-12 col-md-12 col-lg-12" id="divOportunidadActual">
                  <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" id="tabObjetivos" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="registro-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="registro" aria-selected="true"><i class="fas fa-plus"></i> REGISTRO</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="evaluar-tab" data-toggle="tab" href="#evaluar" role="tab" aria-controls="evaluar" aria-selected="false"><i class="fas fa-check-double"></i> EVALUAR</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="consulta-tab" data-toggle="tab" href="#consulta" role="tab" aria-controls="consulta" aria-selected="false"><i class="fas fa-search"></i> CONSULTAR</a>
                      </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="registro" role="tabpanel" aria-labelledby="registro-tab">
                        <div class=" col-sm-12 col-md-12 col-lg-12" id="divTablaObjetivos"></div>
                      </div>
                      <div class="tab-pane fade" id="evaluar" role="tabpanel" aria-labelledby="evaluar-tab">
                        <div class="col-md-12">
                          <div class="form-group">
                            <?php
                            $buscarInfo = mysqli_query($conn, "SELECT * FROM t_comentariosObjetivos WHERE no_relojC = '$no_reloj';");
                            if (mysqli_num_rows($buscarInfo) > 0) {
                              while ($datos = mysqli_fetch_assoc($buscarInfo)) {
                            ?>
                                <label for="txtcomentario" style="font-weight: 600;">Comentarios del Lider:</label>
                                <textarea class="form-control w-50 txtcomentario" id="txtcomentario" readonly rows="3"><?php
                                                                                                                        echo $datos['comentario'];
                                                                                                                        ?></textarea>
                            <?php
                              }
                            }
                            ?>
                          </div>
                        </div>
                        <div class="col-md-12" id="divObjetivosEvaluar"></div>
                      </div>
                      <div class="tab-pane fade " id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
                        <div class=" col-sm-12 col-md-12 col-lg-12">
                          <form class="form-inline" id="formObjetivosPersonal" method="POST" enctype="multipart/form-data" action="<?php
                                                                                                                                    echo $_SERVER['PHP_SELF'];
                                                                                                                                    ?>">
                            <div class="form-group mt-4">
                              <select class="custom-select require_one" name="periodo" id="periodo">
                                <option hidden>Seleccione año:</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                              </select>
                              <input type="text" name="no_reloj" id="relojColaborador" hidden="" value="<?php
                                                                                                        echo $no_reloj_col; ?>">
                              <button type="submit" name="objetivosSupervisor" id="buscarObjetivos" class="btn btn-primary form-control btn-sm"><i class="fas fa-search"></i></button>
                            </div>
                          </form>
                        </div>
                        <img src="../img/buscar.jpg" style="margin: auto; display: block;" id="imgBuscar" alt="buscar">
                        <div id="displayDivObjetivosPersonal"></div>
                      </div> <!-- FIN DE PRIMERA PESTAÑA CONSULTAR -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card <?php if ($displayCard == 'd-blockPlanes') {
                              echo "d-block";
                            } else {
                              echo "d-none";
                            } ?>">
            <div class="card-header acordion" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><span class="fas fa-binoculars"></span> Plan de Desarrollo</button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse <?php if ($eventCard == 'planes') {
                                                    echo "show";
                                                  } ?>" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <ul class="nav nav-tabs nav-justified mt-3" id="tabsPlaneacion" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Plan Actual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Planes Cumplidos</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div id="divPlanActual"></div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="divPlanesCumplidos"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto"> <span>Copyright © GDP | Tecma 2021</span> </div>
      </div>
    </footer>
  </div>
  <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>
  <div class="modal fade" id="modalAddNotas" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar notas para el diálogo</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
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

  <div class="modal fade" id="modalVerNotas" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notas para el diálogo</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
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
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHistorico" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Planes de Seguimiento Cumplidos</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>
  <!--Modal Editar-->
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="dash">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddActionReddin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Acciones</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
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
        <div class="modalAcciones">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddAction" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Acciones</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalBorrarAcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Borrar Elemento</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalBorrarObjetivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Borrar Elemento</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modalBody">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalVerAcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Acciones Especificas</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modalAcciones">
          <!-- Content goes in here -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalEditarPlan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="dash">
          <!-- Content goes in here -->
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
  <script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
  <script src="../vendor/bootstrap/popper.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/sweetalert/sweetalert.min.js"></script>
  <script src="../js/notas.js"></script>
  <script src="../js/objetivosSecundario.js"></script>
  <script src="../js/planDesarrollo.js"></script>
  <script src="../js/sb-admin.min.js"></script>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <script src="../js/sb-admin.min.js"></script>
  <script type="text/javascript">
    window.noReloj = "<?php echo $no_reloj_col ?>";

    $('#divTablaObjetivos').load("../loads/objetivos/tablaObjetivosPersonalInfo.php", {
      'no_reloj': '<?php echo $no_reloj_col ?>',
      'rol': 'administrador'
    });
    
    $('#divObjetivosEvaluar').load("../loads/objetivos/tablaObjetivosPendientesPersonalInfo.php", {
      'no_reloj': '<?php echo $no_reloj_col ?>'
    });

    $('#divPlanActual').load("../loads/planes/planActual.php", {
      'no_reloj': '<?php echo $no_reloj_col ?>',
      'rol': 'admin'
    });
    $('#divPlanesCumplidos').load("../loads/planes/planesCumplidos.php", {
      'no_reloj': '<?php echo $no_reloj_col ?>',
      'rol': 'admin'
    });

    $('#modalAddNotas').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "addNotasAdmin.php",
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

    $('#modalVerNotas').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "verNotasAdmin.php",
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

    $('#modalVerNotasReddin').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_reddin=' + recipient;
      $.ajax({
        type: "GET",
        url: "verNotasReddin.php",
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

    $('#modalAddAction').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "addActionsSup.php",
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

    $('#modalVerAcciones').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "seeActionsSup.php",
        data: dataString,
        cache: false,
        success: function(data) {
          console.log(data);
          modal.find('.modalAcciones').html(data);
        },
        error: function(err) {
          console.log(err);
        }
      });
    })


    $('#modalAddActionReddin').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_reddin=' + recipient;
      $.ajax({
        type: "GET",
        url: "addActionReddin.php",
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
    $('#modalVerAccionesReddin').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_reddin=' + recipient;
      $.ajax({
        type: "GET",
        url: "verAccionesReddin.php",
        data: dataString,
        cache: false,
        success: function(data) {
          console.log(data);
          modal.find('.modalAcciones').html(data);
        },
        error: function(err) {
          console.log(err);
        }
      });
    })

    $('#modalBorrarAcciones').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "deleteAction.php",
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

    $('#editarFicha').on('show.bs.modal', function(event) {
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
    });
  </script>
</body>

</html>