<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
  header("location:../error.html");
  exit();
}
include("../conexion/conexion.php");
$año = 2020;
$relojLider = $_SESSION["no_reloj"];
$perfil = $_SESSION["perfil"];
$admin = $_SESSION['isAdmin'];
$no_reloj_col = $_GET["no_reloj_col"];
$displayCard = $_GET["displayCard"];
$eventCard = $_GET["eventCard"];
$result = $conn->query("SELECT perfil FROM login_gdp WHERE no_reloj = '$no_reloj_col'");
$sqlresult = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GDP - Mis Colaboradores</title>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/estilo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="../admin/myinfoSup.php">GDP</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="myinfoSup.php"><i class="fas fa-chalkboard-teacher"></i> <span>Mi Perfil</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="colaboradoresSup.php"><i class="fas fa-users"></i> <span>Mis Colaboradores</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="objetivosSup.php"><i class="fas fa-fw fa-bullseye"></i> <span>Mis Objetivos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="planeacionSup.php"><i class="fas fa-fw fa-chart-area"></i> <span>Plan de Desarrollo</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="inglesSup.php"><i class="fas fa-fw fa-flag"></i> <span>Ingles</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="biblioteca.php"><i class="fas fa-book"></i></i> <span>Biblioteca</span></a>
      </li>
      <hr>
      <br> <?php if ($admin == 1) { ?>
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
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span>
          </a>
          <div class="dropdown-menu" style="margin-right: 0px;">
            <a class="dropdown-item" href="../control/reportes/reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
            <a class="dropdown-item" href="../control/reportes/reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
            <a class="dropdown-item" href="../control/reportes/reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
            <a class="dropdown-item" href="../control/reportes/reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
            <a class="dropdown-item" href="../control/reportes/reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
            <a class="dropdown-item" href="../control/reportes/reclutamiento.php"><i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
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
        $Search = mysqli_query($conn, "SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj_col'");
        if (mysqli_num_rows($Search) > 0) {
          while ($datos = mysqli_fetch_array($Search)) { ?>
            <div>
              <h6>Colaborador: <?= $datos["nombres"] ?> <?= $datos["apellidos"] ?></h6>
            </div> <?php }
                  mysqli_free_result($Search);
                } else {
                  echo 'Error...';
                } ?>
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
                              <textarea class="form-control w-50 txtcomentario" id="txtcomentario" readonly rows="3"><?php echo $datos['comentario']; ?></textarea>
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
                        <form class="form-inline" id="formObjetivosPersonal" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                          <div class="form-group mt-4">
                            <select class="custom-select require_one" name="periodo" id="periodo">
                              <option hidden>Seleccione año:</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                            </select>
                            <input type="text" name="no_reloj" id="relojColaborador" hidden="" value="<?php echo $no_reloj_col; ?>">
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
          </div><!-- PRIMER ACORDION-->
          <div class="card <?php if ($displayCard == 'd-block') {
                              echo "d-block";
                            } else {
                              echo "d-none";
                            } ?>">
            <div class="card-header acordion" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><span class="far fa-clipboard"></span> Evaluación de Competencias</button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse <?php if ($eventCard == 'evaluacion') {
                                                      echo "show";
                                                    } ?>" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <nav id="tabsEvaluacion">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Evaluación Anual</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Matriz Potencial/Desempeño</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div id="divEvaluacion" class="col-md-12 mt-3"></div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="col-md-12 mt-5">
                      <form id="formMatrizMisColaboradores" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                          <strong>INSTRUCCIONES:</strong>
                          <hr>
                          <br>
                          <span class="fas fa-info-circle"></span>Seleccione los criterios de potencial y desempeño del colaborador, después clic en "Guardar".
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="table table-responsive">
                          <table>
                            <thead>
                              <tr>
                                <th>POTENCIAL</th>
                                <th>DESEMPEÑO</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <select class="form-control selectpicker selectMatriz require_one" id="potencial" name="potencial" title="<?php $sqlPotencial = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$no_reloj_col' ") or die(mysqli_error($conn));
                                                                                                                                            if (mysqli_num_rows($sqlPotencial) > 0) {
                                                                                                                                              while ($row = mysqli_fetch_assoc($sqlPotencial)) {
                                                                                                                                                echo $row['potencial'];
                                                                                                                                              }
                                                                                                                                              mysqli_free_result($sqlPotencial);
                                                                                                                                            } else {
                                                                                                                                              echo "Seleccione... ";
                                                                                                                                            } ?>">
                                    <option value="Potencial Promovible" style="background: #92d050;">Potencial Promovible</option>
                                    <option value="Potencial Lateral" style="background:#00b0f0; ">Potencial Lateral</option>
                                    <option value="Potencial Topado" style="background:#ffc000">Potencial Topado</option>
                                    <option value="Sin elementos para evaluar" style="background: #ff0000; color:#fff;">Sin elementos para evaluar</option>
                                  </select>
                                </td>
                                <td>
                                  <select class="form-control selectpicker selectMatriz require_one" id="desempeno" name="desempeno" title="<?php $sqlDesempeno = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$no_reloj_col' ") or die(mysqli_error($conn));
                                                                                                                                            if (mysqli_num_rows($sqlDesempeno) > 0) {
                                                                                                                                              while ($row = mysqli_fetch_assoc($sqlDesempeno)) {
                                                                                                                                                echo $row['desempeno'];
                                                                                                                                              }
                                                                                                                                              mysqli_free_result($sqlDesempeno);
                                                                                                                                            } else {
                                                                                                                                              echo "Seleccione... ";
                                                                                                                                            } ?>">
                                    <option value="Excepcional" style="background:#000; color: #fff;">Excepcional</option>
                                    <option value="Excede Expectativas" style="background: #92d050;">Excede Expectativas</option>
                                    <option value="Cumple Expectativas" style="background:#00b0f0; ">Cumple Expectativas</option>
                                    <option value="Cumple Parcialmente Expectativas" style="background:#ffc000">Cumple Parcialmente Expectativas</option>
                                    <option value="Insatisfactorio" style="background: #ff0000; color:#fff;">Insatisfactorio</option>
                                  </select>
                                </td>
                                <td>
                                  <input type="text" hidden="" id="txtrelojC" value="<?= $no_reloj_col; ?>" name="no_relojC">
                                  <input type="submit" disabled="" id="btnMatriz" class="btn btn-success btn-sm" value="Guardar">
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12" id="matrizDiv">
                      <div class="table table-responsive">
                        <table id="matrizPotencial" class="table-bordered">
                          <thead>
                            <tr>
                              <th style="background-color: #fff; border:none;"></th>
                              <th style="background-color: #fff; border:none;"></th>
                              <th id="tituloDesempeno" colspan="5">DESEMPEÑO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr id="titulosDesempeño">
                              <td style="background-color: #fff; border:none;"></td>
                              <td style="background-color: #fff; border:none;"></td>
                              <td style="background-color:#000000; color:#fff; width: 20%; text-align: center;">Excepcional</td>
                              <td style="background-color:#92d050; color:#000000; width: 20%; text-align: center;">Excede Expectativas</td>
                              <td style="background-color:#00b0f0; color:#000000; width: 20%; text-align: center;">Cumple Expectativas</td>
                              <td style="background-color:#ffc000; color:#000000; width: 20%; text-align: center;">Cumple Parcialmente Expectativas</td>
                              <td style="background-color:#ff0000; color:#fff; width: 20%; text-align: center;">Insatisfactorio</td>
                            </tr>
                            <tr>
                              <td id="tituloPotencial" rowspan="5">
                                <div>POTENCIAL</div>
                              </td>
                              <td style="background-color:#92d050; color:#000000;">Potencial Promovible</td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excepcional'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excede Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Insatisfactorio'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                            </tr>
                            <tr>
                              <td style="background-color: #00b0f0;color:#000000;">Potencial Lateral</td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excepcional'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excede Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Insatisfactorio'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                            </tr>
                            <tr>
                              <td style="background-color: #ffc000; color:#000000;">Potencial Topado</td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excepcional'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excede Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Insatisfactorio'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                            </tr>
                            <tr>
                              <td style="background-color:#ff0000;color:#fff;">Sin elementos para evaluar</td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excepcional'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excede Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                              <td>
                                <?php
                                $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$no_reloj_col' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Insatisfactorio'";
                                $sqlResult = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($sqlResult) > 0) {
                                ?>
                                  <ul>
                                    <?php while ($datos = mysqli_fetch_array($sqlResult)) {  ?>
                                      <li><?php echo $datos['nombres'];
                                          echo " ";
                                          echo $datos['apellidos']; ?></li>
                                    <?php } ?>
                                  </ul>
                                <?php } ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- SEGUNDO ACORDION -->
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
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Planes Cerrados</a>
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

    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © GDP | Tecma 2022</span>
        </div>
      </div>
    </footer>
  </div>
  <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
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

  <div class="modal fade" id="modalAddObj" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Objetivo</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
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

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/sb-admin.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../js/reddin.js"></script>
  <script type="text/javascript">
    window.noReloj = "<?php echo $no_reloj_col ?>";

    $('#divEvaluacion').load('actions/evaluacion.php', {
      'no_reloj_col': '<?php echo $no_reloj_col; ?>',
      'relojLider': '<?php echo $relojLider; ?>'
    });

    $('#divTablaObjetivos').load("../loads/objetivos/tablaObjetivosNew.php", {
      'no_reloj': '<?php echo $no_reloj_col ?>',
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

    $('.selectMatriz').change(function() {
      $('#btnMatriz').removeAttr("disabled");
    });

    $(document).ready(function() {
      $(window).on("load", function() {
        var eventCard = '<?php echo $eventCard; ?>';
        if (eventCard == 'show') {
          $('html, body').animate({
            scrollTop: $("#collapseFour").offset().top
          }, 2000);
        }
      });
    });


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

    $('#modalHistorico').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'no_reloj_col=' + recipient;
      $.ajax({
        type: "GET",
        url: "actions/historicoPlanes.php",
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
        url: "actions/addActionColaboradores.php",
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
    $('#modalAddActionReddin').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_reddin=' + recipient;
      $.ajax({
        type: "GET",
        url: "actions/addActionReddin.php",
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
        url: "actions/seeActions.php",
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

    $('#modalVerAccionesReddin').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_reddin=' + recipient;
      $.ajax({
        type: "POST",
        url: "../actions/verAccionesReddin.php",
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
    $('#modalAddNotas').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "actions/addNotas.php",
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
    });

    $('#modalVerNotas').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'id_plan=' + recipient;
      $.ajax({
        type: "GET",
        url: "actions/verNotas.php",
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

    /*$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
});

var activeTab = localStorage.getItem('activeTab');
if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
}*/
  </script>
</body>

</html>