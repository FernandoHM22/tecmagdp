<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
   header("location:../error.html");
   exit();
}
$cargoColab = $_SESSION['cargoColab'];
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
         <div class="container-fluid">
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
               <div class="col-md-4">
                  <?php
                  $fortalezas = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider IS NULL");
                  if (mysqli_num_rows($fortalezas) > 0) {
                     $i = 1;
                  ?>
                     <table class="table table-sm">
                        <thead>
                           <tr>
                              <td colspan="2">FORTALEZAS</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($datos = mysqli_fetch_assoc($fortalezas)) {
                           ?>
                              <tr>
                                 <td>
                                    <?php echo $i++; ?>
                                 </td>
                                 <td>
                                    <?= $datos['fortaleza']; ?>
                                 </td>
                              </tr>
                        <?php
                           }
                           mysqli_free_result($fortalezas);
                        } else {
                           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong><i>NOTA:</i></strong><br>Colaborador aún no ha registrado sus Fortalezas.
                           </button>
                           </div>';
                        }
                        ?>
                        </tbody>
                     </table>
               </div>
               <?php
               $resultado = mysqli_query($conn, "SELECT * FROM registrogdp  WHERE no_reloj = '$reloj'") or die(mysqli_error($conn));
               if (mysqli_num_rows($resultado) > 0) {
               ?>
                  <div class="col-sm-4 col-md-4 text-center">
                     <?php while ($datos = mysqli_fetch_assoc($resultado)) { ?>
                        <h4><a href="#ModalEfectividadGerencial" id="graficaEfectividad"><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?> <i class="fas fa-chart-line"></i></a></h4> <img src="<?= $datos['img'] ?>" width="100px;" height="auto" class="rounded m-0 p-0">
                     <?php
                     }
                     mysqli_free_result($resultado);
                     ?>
                  </div>
               <?php  } ?>
               <div class="col-md-4">
                  <?php
                  $oportunidad = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider IS NULL");
                  if (mysqli_num_rows($oportunidad) > 0) {
                     $i = 1;
                  ?>
                     <table class="table table-sm">
                        <thead>
                           <tr>
                              <td colspan="2">OPORTUNIDADES</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($datos = mysqli_fetch_assoc($oportunidad)) {
                           ?>
                              <tr>
                                 <td>
                                    <?php echo $i++; ?>
                                 </td>
                                 <td>
                                    <?= $datos['oportunidad']; ?>
                                 </td>
                              </tr>
                        </tbody>
                  <?php
                           }
                           mysqli_free_result($oportunidad);
                        } else {
                           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i>NOTA:</i></strong><br>Colaborador aún no ha registrado sus Oportunidades.
                        </button>
                        </div>';
                        }
                  ?>
                     </table>
               </div>
            </div>
            <div class="row prueba">
               <div class="col-md-4 divReddinSupervisor">
                  <?php
                  $sql = $conn->query("SELECT * FROM registrogdp  WHERE no_reloj = '$reloj'");
                  $row = $sql->fetch_assoc();
                  $relojLider = $row['no_reloj_supervisor'];
                  $fortalezas = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider = '$relojLider'");
                  if (mysqli_num_rows($fortalezas) > 0) {
                     $i = 1;
                  ?>
                     <table class="table table-sm">
                        <thead>
                           <tr>
                              <td colspan="2">FORTALEZAS</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($datos = mysqli_fetch_assoc($fortalezas)) {
                           ?>
                              <tr>
                                 <td>
                                    <?php echo $i++; ?>
                                 </td>
                                 <td>
                                    <?= $datos['fortaleza']; ?>
                                 </td>
                              </tr>
                        <?php
                           }
                           mysqli_free_result($fortalezas);
                        } else {
                           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                           Líder aún no ha registrado sus Fortalezas.
                           </button>
                           </div>';
                        }
                        ?>
                        </tbody>
                     </table>
               </div>

               <?php
               $resultado = mysqli_query($conn, "SELECT * FROM registrogdp  WHERE no_reloj = '$relojLider'") or die(mysqli_error($conn));
               if (mysqli_num_rows($resultado) > 0) {
               ?>
                  <div class="col-sm-4 col-md-4 text-center divReddinSupervisor">
                     <?php while ($datos = mysqli_fetch_assoc($resultado)) { ?>
                        <h4><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?></h4>
                        <img src="<?= $datos['img'] ?>" width="100px;" height="auto" class="rounded m-0 p-0">
                     <?php
                     }
                     mysqli_free_result($resultado);
                     ?>
                  </div>
               <?php  } ?>
               <div class="col-md-4 divReddinSupervisor">
                  <?php
                  $oportunidad = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider = '$relojLider'");
                  if (mysqli_num_rows($oportunidad) > 0) {
                     $i = 1;
                  ?>
                     <table class="table table-sm">
                        <thead>
                           <tr>
                              <td colspan="2">OPORTUNIDADES</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($datos = mysqli_fetch_assoc($oportunidad)) {
                           ?>
                              <tr>
                                 <td>
                                    <?php echo $i++; ?>
                                 </td>
                                 <td>
                                    <?= $datos['oportunidad']; ?>
                                 </td>
                              </tr>
                        </tbody>
                  <?php
                           }
                           mysqli_free_result($oportunidad);
                        } else {
                           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Líder aún no ha registrado sus Oportunidades.
                        </button>
                        </div>';
                        }
                  ?>
                     </table>
               </div>
               <div class="col-md-12 pt-3 text-center">
                  <a class="cambiarReddinAGerente" title="Cambiar a vista Gerente" data-toggle="tooltip"><i class="fas fa-exchange-alt" style="color: #63abb8; cursor:pointer;"></i></a>
               </div>
            </div>

            <div id="divReddinGerente" class="row"></div>
            <div class="row">
               <div class="col-md-12">
                  <div id="accordion">
                     <div class="card">
                        <div class="card-header" style="padding:0; background:rgba(0,122,129,0.05);   text-align: center;" id="headingOne">
                           <h5 class="mb-0">
                              <button class="btn btn-link btn-block" style="text-decoration: none; color: #007a81; font-weight: 600;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus float-left"></i> Comentarios del lider
                              </button>
                           </h5>
                        </div>
                        <div id="collapseOne" class="collapse pb-2" aria-labelledby="headingOne" data-parent="#accordion" style="border: 0.5px solid rgba(0,122,129,0.05);">
                           <div class="card-body">
                              <?php
                              $comentarioAdicional = mysqli_query($conn, "SELECT * FROM t_evaluacion WHERE no_reloj = '$reloj' AND reloj_lider = '$relojLider'") or die(mysqli_error($conn));
                              if (mysqli_num_rows($comentarioAdicional) > 0) {
                                 while ($datos = mysqli_fetch_assoc($comentarioAdicional)) {
                              ?>
                                    <textarea name="comentarioLider" id="comentarioLider" rows="1" readonly=""><?php echo $datos['comentarioLider']; ?></textarea>
                              <?php }
                                 mysqli_free_result($comentarioAdicional);
                              } else {
                                 echo '<p style="color:darkred; font-size:14px; font-style:italic;"> No se ha registrado comentarios.</p>';
                              }
                              ?>
                              <button type="button" class="btn btn-info btnComentarioEspecial float-right" data-toggle="modal" data-target="#modalComentarioEspecial"><i class="fa fa-plus"></i> Agregar Comentario Especial</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4 mt-5">
                  <button type="button" class="btn btn-info btn-sm add-new"><i class="fa fa-plus"></i> Agregar nueva oportunidad</button>
                  <button class="btn btn-danger btn-sm btnCancel" hidden><i class="fas fa-times"></i> Cancelar</button>
               </div>
               <div id="displaymessage" class="col-md-12 col-sm-12 mt-1 d-block text-center"></div>
               <div class="table-responsive col-md-12" id="divTablaRedin">
                  <table id="tablaReddin" class="tablaOportunidades table table-sm">
                     <thead>
                        <tr>
                           <th width="25%">Área de Oportunidad (Consenso)</th>
                           <th width="65%">Notas para el dialogo</th>
                           <th width="10%">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $result_pag_data = mysqli_query($conn, "SELECT * FROM t_reddin WHERE no_reloj = '$reloj' AND oportunidadConsenso != 'null' AND estatus = 'Actual' ") or die(mysqli_error($conn));
                        if (mysqli_num_rows($result_pag_data) > 0) {
                           while ($row = mysqli_fetch_assoc($result_pag_data)) {
                              $id_reddin = $row['id_reddin'];
                              $oportunidades = $row['oportunidadConsenso'];
                              $notas = $row['notas'];
                        ?>
                              <tr>
                                 <td><input type="checkbox" name="checkboxCumplidos[]" class="form-check-input checkboxCumplidos" value="<?php echo $id_reddin; ?>"> <?php echo $oportunidades; ?></td>
                                 <td><?php echo $notas; ?></td>
                                 <td>
                                    <a class="addReddin" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-plus"></i></a> <a class="editReddin" title="Editar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-pencil-alt"></i></a> <a class="delete" title="Eliminar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-trash"></i></a>
                                 </td>
                              </tr>
                        <?php }
                           mysqli_free_result($result_pag_data);
                        } else {
                           echo '
               <tr>
               <td colspan="3" id="alerta">
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
               No se han registrado oportunidades.
               </button>
               </div>
               </td>
               <td style="display:none;">
               <a class="addReddin" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-plus"></i></a> <a class="editReddin" title="Editar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-pencil-alt"></i></a> <a class="delete" title="Eliminar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-trash"></i></a>
               </td>
               </tr>';
                        } ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <td><a class="btncumplidos" title="Marcar como cumplido" data-toggle="tooltip"><i class="far fa-check-square" style="font-size:11px;"></i> Cumplidos</a></td>
                        </tr>
                     </tfoot>
                  </table>
                  <div class="col-md-12" id="divReddin"></div>
                  <div class="col-md-12">
                     <div class="table table-responsive">
                        <form id="formMatriz" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Potencial</th>
                                    <th>Desempeño</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <select class="form-control selectpicker selectMatriz require_one" id="potencial" name="potencial" title="
                                       <?php
                                       $sqlPotencial = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$reloj'") or die(mysqli_error($conn));
                                       if (mysqli_num_rows($sqlPotencial) > 0) {
                                          while ($row = mysqli_fetch_assoc($sqlPotencial)) {
                                             echo $row['potencial'];
                                          }
                                          mysqli_free_result($sqlPotencial);
                                       } else {
                                          echo "Seleccione... ";
                                       }
                                       ?>">
                                          <option value="Potencial Promovible" style="background: #92d050;">Potencial Promovible</option>
                                          <option value="Potencial Lateral" style="background:#00b0f0; ">Potencial Lateral</option>
                                          <option value="Potencial Topado" style="background:#ffc000">Potencial Topado</option>
                                          <option value="Sin elementos para evaluar" style="background: #ff0000; color:#fff;">Sin elementos para evaluar</option>
                                       </select>
                                    </td>
                                    <td>
                                       <select class="form-control selectpicker selectMatriz require_one" id="desempeno" name="desempeno" title="
                                       <?php
                                       $sqlDesempeno = mysqli_query($conn, " SELECT * FROM t_matriz WHERE no_reloj='$reloj' ") or die(mysqli_error($conn));
                                       if (mysqli_num_rows($sqlDesempeno) > 0) {
                                          while ($row = mysqli_fetch_assoc($sqlDesempeno)) {
                                             echo $row['desempeno'];
                                          }
                                          mysqli_free_result($sqlDesempeno);
                                       } else {
                                          echo "Seleccione... ";
                                       }
                                       ?>">
                                          <option value="Excepcional" style="background:#000; color: #fff;">Excepcional</option>
                                          <option value="Excede Expectativas" style="background: #92d050;">Excede Expectativas</option>
                                          <option value="Cumple Expectativas" style="background:#00b0f0; ">Cumple Expectativas</option>
                                          <option value="Cumple Parcialmente Expectativas" style="background:#ffc000">Cumple Parcialmente Expectativas</option>
                                          <option value="Insatisfactorio" style="background: #ff0000; color:#fff;">Insatisfactorio</option>
                                       </select>
                                    </td>
                                    <td>
                                       <input type="text" hidden="" id="txtreloj" value="<?= $reloj; ?>" name="no_relojC">
                                       <input type="submit" id="btnMatriz" class="btn btn-success btn-sm" value="Guardar">
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-md-12" id="divMatrizPotencialDesempeno">
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excepcional'";
                                 $sqlResult = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($sqlResult) > 0) {
                                    0
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Excede Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Promovible' AND m.desempeno = 'Insatisfactorio'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excepcional'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Excede Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Lateral' AND m.desempeno = 'Insatisfactorio'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excepcional'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Excede Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Potencial Topado' AND m.desempeno = 'Insatisfactorio'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excepcional'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Excede Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Cumple Parcialmente Expectativas'";
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
                                 $sql = "SELECT r.no_reloj, r.nombres, r.apellidos, r.no_reloj_supervisor, m.no_reloj, m.potencial, m.desempeno FROM t_matriz m  INNER JOIN  registrogdp r ON r.no_reloj = '$reloj' AND r.no_reloj = m.no_reloj AND m.potencial = 'Sin elementos para evaluar' AND m.desempeno = 'Insatisfactorio'";
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
                  <button class="btn btn-sm btn-info verMatriz mb-5"><i class="fas fa-users"></i> Ver colaboradores</button>
               </div>
               <!-- Modal -->
               <div class="modal fade" id="modalComentarioEspecial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                     <div class="modal-content">
                        <div class="modal-body">
                           <button type="button" class="btn btn-info btn-sm add-comentarioEsp mb-1"><i class="fa fa-plus"></i>Nuevo comentario</button>
                           <table id="comentariosEspeciales" class="table tablaComentariosEspeciales">
                              <thead>
                                 <tr>
                                    <th width="80%">Comentario</th>
                                    <th width="20%">Acciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sqlComentarioEspecial = "SELECT * FROM t_comentariosEspecialesReddin WHERE no_relojC = '$reloj'";
                                 $comentarioEspecial = mysqli_query($conn, $sqlComentarioEspecial);
                                 if (mysqli_num_rows($comentarioEspecial) > 0) {
                                    while ($datos = mysqli_fetch_assoc($comentarioEspecial)) {
                                       $id_comentario = $datos['id_comentario'];
                                 ?>
                                       <tr>
                                          <td><?= $datos['comentario'] ?></td>
                                          <td>
                                             <a class="agregarComentarioEspecial" title="Agregar" data-toggle="tooltip" id="<?php echo $id_comentario; ?>"><i class="fas fa-plus"></i></a>
                                             <a class="editarComentarioEspecial" title="Editar" data-toggle="tooltip" id="<?php echo $id_comentario; ?>"><i class="fas fa-pencil-alt"></i></a>
                                             <a class="borrarComentarioEspecial" title="Eliminar" data-toggle="tooltip" id="<?php echo $id_comentario; ?>"><i class="fas fa-trash"></i></a>
                                          </td>
                                       </tr>
                                 <?php }
                                 } else {
                                    echo '
                                          <td>
                                          <a class="agregarComentarioEspecial" title="Agregar" data-toggle="tooltip" id="<?php echo $id_comentario; ?>"><i class="fas fa-plus"></i></a> 
                                          </td>
                                          ';
                                 }
                                 ?>
                              </tbody>
                           </table>
                           <div id="exitoregistro" class="col-md-12 col-sm-12 mt-1 d-block text-center"></div>
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
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
      <script src="../js/sb-admin.min.js"></script>
      <script src="../js/reddin.js"></script>
      <script>
         $(document).ready(function() {
            window.noReloj = "<?php echo $reloj ?>";
            window.noRelojL = "<?php echo $relojLider ?>";

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
         });
      </script>
</body>

</html>