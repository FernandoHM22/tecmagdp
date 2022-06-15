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
      <div class="container-fluid">
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

              $sql_colaboradores = "SELECT r.no_reloj, r.nombres, r.apellidos, r.puesto, r.img, l.no_reloj, l.cargoColab FROM registrogdp r INNER JOIN login_gdp l ON r.no_reloj = l.no_reloj ORDER BY r.nombres ASC";
            } else {

              $sql_colaboradores = "SELECT * FROM registrogdp WHERE depto != 'Culture Innovation' ORDER BY nombres ASC";
            }
            $resultado = mysqli_query($conn, $sql_colaboradores);
            if (mysqli_num_rows($resultado) > 0) {
            ?>
              <div class="card-columns">
                <?php
                $o = 1;
                $p = 1;
                $c = 1;
                $g = 1;
                while ($datos = mysqli_fetch_array($resultado)) {
                  $arrayColaboradores[] = $datos['no_reloj'];
                  $nombres = $datos['nombres'];
                  $apellidos = $datos['apellidos'];
                  $nombrecompleto = $nombres . ' ' . $apellidos;
                ?>
                  <div class="card card_colaboradores shadow-sm" style="width: 14rem; height:auto;">
                    <div class="img">
                      <img class="card-img-top" src="<?= $datos['img'] ?>">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title text-center m-0"><?= $nombrecompleto ?></h5>
                      <div class="text-center">
                        <p class="card-text card_reloj"><?= $datos['no_reloj'] ?></p>
                        <p class="card-text card_puesto"><?= $datos['puesto']; ?></p>
                        <?php if ($admin == 1) { ?>
                          <a style="text-decoration:none; font-size: 11px;" data-whatever="<?php echo $datos['no_reloj']; ?>" data-toggle="modal" data-target="#fichaTalento" href="#fichaTalento">Ficha talento <i class="fas fa-edit"></i></a> | <a style="text-decoration:none; font-size: 11px;" href="sesion_talento.php?relojColaborador=<?php echo $datos['no_reloj']; ?>">Sesion Talento <i class="fas fa-user-check"></i></a>
                          <div class="row">
                            <div class="col">
                              <div class="chart-container">
                                <a href="reportPersonal.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockObjetivos&eventCard=objetivos">
                                  <canvas class="chartObjetivos" id="dougnutObjetivos<?= $o++; ?>"></canvas>
                                </a>
                              </div>
                            </div>
                            <div class="col">
                              <div class="chart-container">
                                <a href="#" class="btnModalCompetencias" data-id="<?= $datos['no_reloj'] ?>">
                                  <canvas class="chartCompetencias" id="dougnutCompetencias<?= $c++; ?>"></canvas>
                                </a>
                              </div>
                            </div>
                            <?php
                            if($datos['cargoColab'] == 1){
                            ?>
                            <div class="col">
                              <div class="chart-container">
                                <a href="gptw.php?relojColaborador=<?php echo $datos['no_reloj']; ?>">
                                  <canvas class="chartGPTW" id="dougnutGPTW<?= $g++; ?>"></canvas>
                                </a>
                              </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col">
                              <div class="chart-container">
                                <a href="reportPersonal.php?no_reloj_col=<?php echo $datos['no_reloj']; ?>&displayCard=d-blockPlanes&eventCard=planes">
                                  <canvas class="chartPlanes" id="dougnutPlanes<?= $p++; ?>"></canvas>
                                </a>
                              </div>
                            </div>
                          </div>
                        <?php } else if ($admin == 2 || $admin == 4) { ?>
                          <div class="row">
                            <div class="col">
                              <div class="chart-container">
                                <a href="gptw.php?relojColaborador=<?php echo $datos['no_reloj']; ?>">
                                  <canvas class="chartGPTW" id="dougnutGPTW<?= $g++; ?>"></canvas>
                                </a>
                              </div>
                            </div>
                          </div>
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
        <div class="modal-content">
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
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body-gptw p-3"></div>
        </div>
      </div>
    </div>

    <?php
    $anio = Date('Y');
    foreach ($arrayColaboradores as $key => $value) {
      $sql_objetivos = mysqli_query($conn, "SELECT AVG(logro) AS logro, obj_no_reloj FROM objetivos_gdp WHERE obj_no_reloj = '$value' AND año_reg = '$anio' GROUP BY obj_no_reloj") or die(mysqli_error($conn));
      $r = mysqli_fetch_assoc($sql_objetivos);
      if ($r['logro'] != '') {
        $arrayLogroObjetivos[] =  number_format(floor(($r['logro']) * 100) / 100, 2);
        $faltanteDataObjetivos[] = 100 - number_format(floor(($r['logro']) * 100) / 100, 2);
      } else {
        $arrayLogroObjetivos[] = 0;
        $faltanteDataObjetivos[] = 10 - 0;
      }

      $sql_planes = mysqli_query($conn, "SELECT COUNT(id_reddin) as planes FROM t_reddin WHERE no_reloj = '$value' AND oportunidadConsenso != '' AND estatus = 'Actual'") or die(mysqli_error($conn));
      $row = mysqli_fetch_assoc($sql_planes);
      if ($row['planes'] != '') {
        $arrayPlanesActuales[] = intval($row['planes']);
      } else {
        $arrayPlanesActuales[] = 0;
      }

      $sql_gptw = mysqli_query($conn, "SELECT r_liderazgo FROM t_calificaciones_gptw WHERE no_reloj = '$value' AND anio_reg = '2021' LIMIT 1");
      if (mysqli_num_rows($sql_gptw) > 0) {
        $data = mysqli_fetch_assoc($sql_gptw);
        $liderazgo[] = floatval($data['r_liderazgo']);
        $FaltanteLiderazgo[] = 10 - floatval($data['r_liderazgo']);
      } else {
        $liderazgo[] = 0;
        $FaltanteLiderazgo[] = 10 - 0;
      }
    }

    $arrayTotal = array();
    foreach ($arrayColaboradores as $key => $value) {
      $sql_evaluacion = mysqli_query($conn, "SELECT *  FROM t_evaluacion WHERE no_reloj = '$value'");
      if (mysqli_num_rows($sql_evaluacion) > 0) {
        $row = mysqli_fetch_assoc($sql_evaluacion);
        $sum =  (($row['competencia1'] + $row['competencia2'] + $row['competencia3'] + $row['competencia4'] + $row['competencia5'] + $row['competencia6'] + $row['competencia7'] + $row['competencia8'] + $row['competencia9'] + $row['competencia10'] + $row['competencia11'] + $row['competencia12'] + $row['competencia13'] + $row['competencia14'] + $row['competencia15'] + $row['competencia16'] + $row['competencia17'] + $row['competencia18'] + $row['competencia19'] + $row['competencia20']) / 20) . '<br>';

        $avgEvaluacion =  ($sum * 70) / 100;

        $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj = '$value'");
        if (mysqli_num_rows($sql_matriz) > 0) {
          $r = mysqli_fetch_assoc($sql_matriz);
          $desempeno = $r['desempeno'];
          if ($desempeno == 'Excepcional') {
            $calificacion = 10;
          } else if ($desempeno == 'Excede Expectativas') {
            $calificacion = 9.9;
          } else if ($desempeno == 'Cumple Expectativas') {
            $calificacion = 9.5;
          } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
            $calificacion = 8;
          } else if ($desempeno == 'Insatisfactorio') {
            $calificacion = 9.5;
          }
        } else {
          $calificacion = 0;
        }
        $avgDesempeno = ($calificacion * 30) / 100;
        $avgTotal[] =  number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
        $faltanteDataCompetencias[] = 10 - number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
      } else {
        $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj ='$value'");
        if (mysqli_num_rows($sql_matriz) > 0) {
          $r = mysqli_fetch_assoc($sql_matriz);
          $desempeno = $r['desempeno'];
          if ($desempeno == 'Excepcional') {
            $calificacion = 10;
          } else if ($desempeno == 'Excede Expectativas') {
            $calificacion = 9.9;
          } else if ($desempeno == 'Cumple Expectativas') {
            $calificacion = 9.5;
          } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
            $calificacion = 8;
          } else if ($desempeno == 'Insatisfactorio') {
            $calificacion = 9.5;
          }
        } else {
          $calificacion = 0;
        }
        $calificacion;
        $avgDesempeno = ($calificacion * 30) / 100;
        $avgTotal[] =  number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
        $faltanteDataCompetencias[] = 10 - number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
      }
    }
    mysqli_free_result($sql_evaluacion);
    ?>
    
    <script src="../vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="../vendor/bootstrap/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/sb-admin.min.js"></script>
</body>

</html>
<script type="text/javascript">
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
  $(document).ready(function() {
    $('.btnModalCompetencias').on('click', function(e) {
      e.preventDefault();
      var no_reloj = $(this).data('id');
      $.ajax({
        type: "POST",
        url: "../ajax/supervisor/ajax_modalCompetencias.php",
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

    $(document).on('click', '.btn-group-toggle .btn-switch', function(e) {
      var btn_switch = $(this).data('switch');
      $(this).parent().removeClass("switch-on switch-off").toggleClass('switch-' + btn_switch);
    });

    $('#fichaTalento').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      var modal = $(this);
      var dataString = 'no_reloj=' + recipient;
      $.ajax({
        type: "GET",
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
          modal.find('.dash').html(data);
        },
        error: function(err) {
          console.log(err);
        }
      });
    });

    //---------------CHART OBJETIVOS-----------------------//
    const datapointsObjetivos = <?php echo json_encode($arrayLogroObjetivos); ?>;
    const datapointsFaltanteObjetivos = <?php echo json_encode($faltanteDataObjetivos); ?>;
    $('.chartObjetivos').each(function(index) {
      var increment = index + 1;
      var chartDoughnutObjetivos = 'dougnutObjetivos' + increment;
      const chartObjetivos = document.getElementById(chartDoughnutObjetivos);
      const dataObjetivos = {
        labels: ['Cumplido', ''],
        datasets: [{
          data: [datapointsObjetivos[index], datapointsFaltanteObjetivos[index]],
          backgroundColor: ['#31b17e', '#B5EAD5'],
          borderWidth: 1,
          cutout: '70%'
        }],
      };
      const porcentajeObjetivos = {
        id: 'porcentajeObjetivos',
        beforeDraw(chart, args, options) {
          const {
            ctx,
            chartArea: {
              top,
              right,
              bottom,
              left,
              width,
              height
            }
          } = chart;
          ctx.save();
          ctx.font = options.fontSize + 'px ' + options.fontFamily;
          ctx.textAlign = 'center';
          ctx.fillStyle = options.fontColor;
          ctx.fillText(datapointsObjetivos[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
      }
      const doughnutObjetivos = new Chart(chartObjetivos, {
        type: 'doughnut',
        data: dataObjetivos,
        options: {
          events: [],
          animation: {
            duration: 0
          },
          responsive: true,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Objetivos'
            },
            porcentajeObjetivos: {
              fontColor: '#31b17e',
              fontSize: 13,
              fontFamily: 'sans-serif',
              fontStyle: "bold",
            }
          }
        },
        plugins: [porcentajeObjetivos]
      });

    });

    //---------------CHART EVALUACION COMPETENCIAS-----------------------//
    const datapointsCompetencias = <?php echo json_encode($avgTotal); ?>;
    const datapointsCompetenciasFaltante = <?php echo json_encode($faltanteDataCompetencias); ?>;
    $('.chartCompetencias').each(function(index) {
      var incrementCompetencias = index + 1;
      var chartDoughnutCompetencias = 'dougnutCompetencias' + incrementCompetencias;
      const chartCompetencias = document.getElementById(chartDoughnutCompetencias);
      const dataCompetencias = {
        labels: ['Cumplido', ''],
        datasets: [{
          data: [datapointsCompetencias[index], datapointsCompetenciasFaltante[index]],
          backgroundColor: ['#f37b2f', '#F6C2A2'],
          borderWidth: 1,
          cutout: '70%'
        }],
      };
      const porcentajeCompetencias = {
        id: 'porcentajeCompetencias',
        beforeDraw(chart, args, options) {
          const {
            ctx,
            chartArea: {
              top,
              right,
              bottom,
              left,
              width,
              height
            }
          } = chart;
          ctx.save();
          ctx.font = options.fontSize + 'px ' + options.fontFamily;
          ctx.textAlign = 'center';
          ctx.fillStyle = options.fontColor;
          ctx.fillText(datapointsCompetencias[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
      }
      const doughnutComperencias = new Chart(chartCompetencias, {
        type: 'doughnut',
        data: dataCompetencias,
        options: {
          events: [],
          animation: {
            duration: 0
          },
          responsive: true,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Competencias'
            },
            porcentajeCompetencias: {
              fontColor: '#f37b2f',
              fontSize: 13,
              fontFamily: 'sans-serif',
              fontWeight: "bold",
            }
          }
        },
        plugins: [porcentajeCompetencias]
      });

    });

    //---------------CHART GPTW-----------------------//
    const datapointsGPTW = <?php echo json_encode($liderazgo); ?>;
    const datapointsFaltanteGPTW = <?php echo json_encode($FaltanteLiderazgo); ?>;
    $('.chartGPTW').each(function(index) {
      var incrementGPTW = index + 1;
      var chartDoughnutGPTW = 'dougnutGPTW' + incrementGPTW;
      const chartGPTW = document.getElementById(chartDoughnutGPTW);
      const dataGPTW = {
        labels: ['Cumplido', ''],
        datasets: [{
          label: 'Dataset 1',
          data: [datapointsGPTW[index], datapointsFaltanteGPTW[index]],
          backgroundColor: ['#dc3545', '#EAB9BE'],
          borderWidth: 1,
          cutout: '70%'
        }],
      };
      const porcentajeGPTW = {
        id: 'porcentajeGPTW',
        beforeDraw(chart, args, options) {
          const {
            ctx,
            chartArea: {
              top,
              right,
              bottom,
              left,
              width,
              height
            }
          } = chart;
          ctx.save();
          ctx.font = options.fontSize + 'px ' + options.fontFamily;
          ctx.textAlign = 'center';
          ctx.fillStyle = options.fontColor;
          ctx.fillText(datapointsGPTW[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
      }
      const doughnutGPTW = new Chart(chartGPTW, {
        type: 'doughnut',
        data: dataGPTW,
        options: {
          events: [],
          animation: {
            duration: 0
          },
          responsive: true,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'GPTW'
            },
            porcentajeGPTW: {
              fontColor: '#dc3545',
              fontSize: 13,
              fontFamily: 'sans-serif',
              fontStyle: "bold",
            }
          }
        },
        plugins: [porcentajeGPTW]
      });
    });

    //---------------CHART PLANES-----------------------//
    const datapointsPlanes = <?php echo json_encode($arrayPlanesActuales) ?>;
    $('.chartPlanes').each(function(index) {
      var incrementPlanes = index + 1;
      var chartDoughnutPlanes = 'dougnutPlanes' + incrementPlanes;
      const chartPlanes = document.getElementById(chartDoughnutPlanes);
      const dataPlanes = {
        labels: ['Cumplido', 'Faltante'],
        datasets: [{
          label: 'Dataset 1',
          data: [100, 0],
          backgroundColor: ['#247ef2', 'transparent'],
          borderWidth: 1,
          cutout: '70%'
        }],
      };
      const porcentajePlanes = {
        id: 'porcentajePlanes',
        beforeDraw(chart, args, options) {
          const {
            ctx,
            chartArea: {
              top,
              right,
              bottom,
              left,
              width,
              height
            }
          } = chart;
          ctx.save();
          ctx.font = options.fontSize + 'px ' + options.fontFamily;
          ctx.textAlign = 'center';
          ctx.fillStyle = options.fontColor;
          ctx.fillText(datapointsPlanes[index], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
      }
      const doughnutPlanes = new Chart(chartPlanes, {
        type: 'doughnut',
        data: dataPlanes,
        options: {
          events: [],
          animation: {
            duration: 0
          },
          responsive: true,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Planes'
            },
            porcentajePlanes: {
              fontColor: '#247ef2',
              fontSize: 13,
              fontFamily: 'sans-serif',
              fontStyle: "bold",
            }
          }
        },
        plugins: [porcentajePlanes]
      });
    });
  });
</script>