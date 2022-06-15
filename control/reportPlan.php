<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
  header("location:../error.html");
  exit();
}
$cargoColab = $_SESSION['cargoColab'];
$admin = $_SESSION["isAdmin"];
include("../conexion/conexion.php");
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
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilo.css">
  <style>
    @supports(object-fit: cover) {
      .card img {
        height: 100%;
        object-fit: cover;
        object-position: center center;
      }
    }
  </style>
</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="myinfoSup.php">GDP</a>
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
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><span class="fas fa-sign-out-alt"></span> Cerrar Sesion</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <!-- Sidebar -->
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
      <?php
      if ($admin == 1) {
      ?>
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
      <?php } elseif ($admin == 2) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
        </li>
      <?php } ?>
    </ul>
    <div id="content-wrapper">
      <div class="container">

        <div class="row heading heading-icon">
          <h6 style="font-size:12px; text-transform: uppercase; letter-spacing: 1px;">Colaboradores</h6>
        </div>
        <?php
        if ($admin == 1 || $admin == 2) {

          $consulta = "SELECT COUNT(no_reloj) as usuariosTotales FROM registrogdp";
        } else {

          $consulta = "SELECT COUNT(no_reloj) as usuariosTotales FROM registrogdp WHERE depto != 'Culture Innovation' ORDER BY nombres ASC";
        }
        $resultado = $conn->query($consulta);
        $fila = $resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
        $colaboradoresTotal = $fila['usuariosTotales'];
        ?>
        <p style="font-size:12.5px;">Total de Colaboradores: <span class="badge badge-primary"><?php echo $colaboradoresTotal; ?></span> </p>
        <input type="text" id="myFilter" class="form-control mb-3" onkeyup="myFunction()" placeholder="Buscar por nombre">
        <div class="row" id="myItems">
          <?php
          $msgEmp = "";
          if ($admin == 1 || $admin == 2) {
            $Search = "SELECT * FROM registrogdp  ORDER BY nombres ASC";
          } else {
            $Search = "SELECT * FROM registrogdp WHERE depto != 'Culture Innovation' ORDER BY nombres ASC";
          }
          $resultado = mysqli_query($conn, $Search);
          if (mysqli_num_rows($resultado) > 0) {
          ?>
            <div class="card-columns">
              <?php
              while ($datos = mysqli_fetch_array($resultado)) {
                $no_reloj = $datos['no_reloj'];
                $nombres = $datos['nombres'];
                $apellidos = $datos['apellidos'];
                $nombrecompleto = $nombres . ' ' . $apellidos;
              ?>
                <div class="card shadow-sm" style="width: 14rem; height:auto;">
                  <div class="img">
                    <img class="card-img-top" src="<?= $datos['img'] ?>">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-center m-0" style="font-size:12px; text-decoration: none; color: #000;"><?= $nombrecompleto; ?></h5>
                    <div class="text-center">
                      <p style="text-decoration:none; font-size:12px;"><?= $no_reloj ?></p>
                      <p class="card-text text-center" style="font-size:11.5px;"><?= $datos['puesto']; ?></p>
                      <?php if ($admin == 1) { ?>
                        <a href="reportPersonal.php?no_reloj_col=<?= $no_reloj; ?>&displayCard=d-blockObjetivos&eventCard=objetivos" style="font-size:11px;"><i class="fas fa-fw fa-bullseye"></i> Objetivos</a> | <a href="reportPersonal.php?no_reloj_col=<?= $no_reloj; ?>&displayCard=d-blockPlanes&eventCard=planes" style="font-size:11px;"><i class="fas fa-fw fa-chart-area"></i> Plan de Desarrollo</a>
                        | <a style="text-decoration:none; font-size: 11px;" data-whatever="<?= $no_reloj; ?>" data-toggle="modal" data-target="#fichaTalento" href="#fichaTalento">Ficha talento <i class="fas fa-edit"></i></a> | <a style="text-decoration:none; font-size: 11px;" href="sesion_talento.php?relojColaborador=<?= $no_reloj; ?>">Sesion Talento <i class="fas fa-user-check"></i></a> | <a style="text-decoration:none; font-size: 11px;" href="gptw.php?relojColaborador=<?= $no_reloj; ?>">GPTW <i class="fas fa-award"></i></a> | <a class="btnModalCompetencias" data-id="<?= $no_reloj ?>" style="text-decoration:none; font-size: 11px;" href="#">Evaluación Lider <i class="fas fa-clipboard-check"></i></a>
                      <?php } else if ($admin == 2 || $admin == 4) { ?>
                        <a style="text-decoration:none; font-size: 11px;" href="gptw.php?relojColaborador=<?= $no_reloj; ?>">GPTW <i class="fas fa-award"></i></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              mysqli_free_result($resultado);
              ?>
            </div><?php
                } else {
                  $msgEmp .= '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:90%; margin-left:50px; margin-top:5px; padding:10px; font-size:15px;">
             <strong><i>Tus colaboradores aún no se han registrado, notificales</i></strong>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>';
                  echo $msgEmp;
                }
                  ?>
        </div>
        <!-- Sticky Footer -->
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

    <div class="modal fade" id="fichaTalento" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:0;">
          <div class="dash">
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

    <div class="modal fade" id="modalCompetencias" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body-gptw p-3"></div>
        </div>
      </div>
    </div>

    <script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="../vendor/bootstrap/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/sb-admin.min.js"></script>
</body>

</html>
<script type="text/javascript">
  $(document).on('click', '.btn-group-toggle .btn-switch', function(e) {
    var btn_switch = $(this).data('switch');
    $(this).parent().removeClass("switch-on switch-off").toggleClass('switch-' + btn_switch);
  });

  function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("card");
    for (i = 0; i < cards.length; i++) {
      title = cards[i].querySelector(".card-body h5.card-title");
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }

  $('#fichaTalento').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);
    var dataString = 'no_reloj=' + recipient;
    $.ajax({
      type: "POST",
      url: "ajaxTables/fichaTalento.php",
      data: dataString,
      cache: false,
      success: function(data) {
        modal.find('.dash').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  });

  $('#editarFicha').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever');
    var recipiente = button.data('target');
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
        modal.find('.dash').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  });

  $('.btnModalCompetencias').on('click', function(e) {
    e.preventDefault();
    var no_reloj = $(this).data('id');
    $.ajax({
      type: "POST",
      url: "../../ajax/supervisor/ajax_modalCompetencias.php",
      data: {
        no_reloj: no_reloj
      },
      cache: false,
      success: function(data) {
        $('#modalCompetencias').modal('show');
        $('#modalCompetencias').find('.modal-body-gptw').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
</script>