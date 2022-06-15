<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
  header("location:../error.html");
  exit();
}
$admin = $_SESSION['isAdmin'];
include("../conexion/conexion.php");
$no_reloj = $_SESSION["no_reloj"];
?>
<!DOCTYPE /html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GDP | Ingles (ESL)</title>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="myinfo.php">GDP</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-lg" style="font-size: 1.5rem;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesion</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="myinfo.php"><i class="fas fa-chalkboard-teacher"></i> <span>Mi Perfil</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="objetivos.php"><i class="fas fa-fw fa-bullseye"></i> <span>Mis Objetivos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="planeacion.php"><i class="fas fa-fw fa-chart-area"></i> <span>Plan de Desarrollo</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="ingles.php"><i class="fas fa-fw fa-flag"></i> <span>Ingles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="biblioteca.php"><i class="fas fa-book"></i></i> <span>Biblioteca</span></a>
      </li>
      <hr>
      <?php if ($admin == 1) {
      ?>
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

    <div class="container-fluid">
      <div class="alert alert-info alert-dismissible fade show ml-2 mr-2 mb-5 mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>INTRUCCIONES:</strong> Captura tu <strong>nivel de ingles</strong>, seleccionando correctamente lo que se te pide: <strong>(Añade una breve observación.)</strong>
      </div>
      <h6 class="mt-5 ml-3 mr-3">NIVELES DE INGLES</h6>
      <div id="displaymessage" class="col-md-12 col-sm-12 d-block text-center"></div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-info btn-sm add-newIngles"><i class="fa fa-plus"></i> Agregar nuevo nivel de ingles</button>
        <button class="btn btn-danger btn-sm btnCancel" hidden=""><i class="fas fa-times"></i> Cancelar</button>
      </div>
      <div class=" col-sm-12 col-md-12 col-lg-12 pt-3">
        <table class="table table-responsive-md tableIngles">
          <thead>
            <tr>
              <th>Nivel Actual</th>
              <th>Nivel Requerido</th>
              <th>Estatus</th>
              <th>Observaciones</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $Search  = mysqli_query($conn, "SELECT * FROM ingles_esl WHERE els_no_reloj = '$no_reloj'");
            if (mysqli_num_rows($Search) > 0) {
              while ($datos = mysqli_fetch_array($Search)) {
                $idIngles = $datos["id_ingles"];
            ?>
                <tr>
                  <td style="text-align:justify; font-size: 13.5px"><?= $datos["nivel_actual"] ?></td>
                  <td style="text-align:justify; font-size: 13.5px"><?= $datos["nivel_requerido"] ?></td>
                  <td style="text-align:justify; font-size: 13.5px"><?= $datos["estatus"] ?></td>
                  <td style="text-align:justify; font-size: 13.5px"><?= $datos["observaciones"] ?></td>
                  <td class="text-center">
                    <a class="add" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_ingles"] ?>"><i class="fas fa-plus"></i></a>
                    <a class="edit" title="Editar" data-toggle="tooltip" id="<?= $datos["id_ingles"] ?>"><i class="fas fa-pencil-alt"></i></a>
                    <a class="delete" title="Eliminar" data-toggle="tooltip" id="<?= $datos["id_ingles"] ?>"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
            <?php
              }
              mysqli_free_result($Search);
            } else {
              echo '<td style="display:none;">
             <a class="add" title="Agregar" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
             <a class="edit" title="Editar" data-toggle="tooltip" ><i class="fas fa-pencil-alt"></i></a>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
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
    <script src="../js/ingles.js"></script>
    <script>
      window.no_reloj = <?php echo $no_reloj ?>
    </script>
</body>

</html>