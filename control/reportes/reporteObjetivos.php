<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
   header("location:../../error.html");
   exit();
}
include("../../conexion/conexion.php");
$cargoColab = $_SESSION['cargoColab'];
$año = '2022';
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
   <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
   <link rel="icon" href="../../img/favicon.png" type="image/x-icon">
   <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
   <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
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
               <a class="nav-link" href="../reportPlan.php"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
               <div class="dropdown-menu" style="margin-right: 0px;">
                  <a class="dropdown-item" href="reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
                  <a class="dropdown-item" href="reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
                  <a class="dropdown-item" href="reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
                  <a class="dropdown-item" href="reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
                  <a class="dropdown-item active" href="reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
                  <a class="dropdown-item" href="reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
               </div>
            </li>
         <?php } ?>
      </ul>
      <div id="content-wrapper">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Reporte</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cumplimiento</a>
            </li>
         </ul>
         <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <h6>REPORTE DE OBJETIVOS</h6>
               <div class="table table-responsive   col-md-12">
                  <table id="t_reporteObjetivos" class="table  table-sm table-responsive-md table-bordered tablaObjetivos">
                     <thead>
                        <tr>
                           <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;"># Reloj</th>
                           <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Categoría <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Utilizar todas las categorías (mínimo un objetivo por categoría) "></i></th>
                           <th width="20%" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivo <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Describe tu objetivo"></i></th>
                           <th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Descripcion</th>
                           <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Meta</th>
                           <th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Año</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $buscarInfo = mysqli_query($conn, "SELECT * FROM objetivos_gdp where año_reg LIKE '$año' AND categoria != '' ORDER BY categoria ASC");
                        if (mysqli_num_rows($buscarInfo) > 0) {
                           $sumaResultado = 0;
                           while ($datos = mysqli_fetch_assoc($buscarInfo)) {
                              $idObj = $datos["id_num_objetives"];
                              $num_td = 1;
                        ?>
                              <tr>
                                 <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["obj_no_reloj"] ?></td>
                                 <td style="vertical-align: middle;text-align:justify;"><?= $datos["categoria"] ?></td>
                                 <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["objetivo"] ?>
                                 </td>
                                 <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["descripcion_meta"] ?></td>
                                 <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["meta_num"] ?>
                                    <input type="text" hidden name="id_objetivos[]" value="<?= $datos["id_num_objetives"] ?>" class="form-control form-control-sm">
                                 </td>
                                 <td><?= $datos["año_reg"] ?></td>
                              </tr>
                              <?php
                           }
                           mysqli_free_result($buscarInfo);
                        } else {
                           echo '
                     <tr>
                        <td id="alerta" colspan="11"><div class="alert alert-danger" role="alert">
                           No se han registrado objetivos.
                           </div></td>
                           <td>
                           <a class="add" title="Agregar" data-toggle="tooltip" id="<?php echo $id_reddin; ?>"><i class="fas fa-save"></i></a>
                        </td>
                     <tr>';
                        }
                        $sql_estrategia_a_objetivos = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE responsable LIKE '%$no_reloj%' AND año_reg LIKE '$año' ORDER BY categoria ASC");
                        if (mysqli_num_rows($sql_estrategia_a_objetivos) > 0) {
                           $sumaResultado = 0;
                           while ($datos = mysqli_fetch_assoc($sql_estrategia_a_objetivos)) {
                              if ($no_reloj != $datos["obj_no_reloj"]) {
                                 $idObj = $datos["id_num_objetives"];
                              ?>
                                 <tr>
                                    <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["obj_no_reloj"] ?></td>
                                    <td style="vertical-align: middle;" style="text-align:justify; font-weight: 600;">
                                       <?php
                                       $id_rel = $datos["id_rel_estrategia"];
                                       $buscarEstrategia = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_rel'");
                                       if (mysqli_num_rows($buscarEstrategia) > 0) {
                                          while ($row = mysqli_fetch_assoc($buscarEstrategia)) {
                                             $id_relacion_padre = $row["id_rel_estrategia"];
                                             if ($row['categoria'] == '') {
                                                $sql_estrategia_padre = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_relacion_padre'");
                                                if (mysqli_num_rows($sql_estrategia_padre) > 0) {
                                                   while ($r = mysqli_fetch_assoc($sql_estrategia_padre)) {
                                                      $id_relacion_padre_ultimo = $r["id_rel_estrategia"];
                                                      if ($r['categoria'] == '') {
                                                         $sql_estrategia_padre_ultimo = mysqli_query($conn, "SELECT * FROM objetivos_gdp WHERE id_num_objetives = '$id_relacion_padre_ultimo'");
                                                         if (mysqli_num_rows($sql_estrategia_padre_ultimo) > 0) {
                                                            while ($data = mysqli_fetch_assoc($sql_estrategia_padre_ultimo)) {
                                                               echo $data["categoria"];
                                                            }
                                                         }
                                                      } else {
                                                         echo $r["categoria"];
                                                      }
                                                   }
                                                }
                                             } else {
                                                echo $row["categoria"];
                                             }
                                          }
                                          mysqli_free_result($buscarEstrategia);
                                       }
                                       ?>
                                    </td>
                                    <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["estrategia"] ?>
                                    </td>
                                    <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["metricos_kpi"] ?></td>
                                    <td style="vertical-align: middle;text-align:justify;text-align:center;"><?= $datos["medida_estrategia"] ?>
                                       <input type="text" hidden name="id_objetivos[]" value="<?= $datos["id_num_objetives"] ?>" class="form-control form-control-sm">
                                    </td>
                                    <td><?= $datos["año_reg"] ?></td>
                                 </tr>
                        <?php
                              }
                           }
                           mysqli_free_result($sql_estrategia_a_objetivos);
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h6>CUMPLIMIENTOS DE OBJETIVOS: <?php echo $año; ?></h6>
               <div class="table-responsive col-md-12">
                  <table id="tabla_cumplimiento_objetivos"  style="width:100%" class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th width="25%">Nombre</th>
                           <th width="15%">Puesto</th>
                           <th width="15%">Depto</th>
                           <th width="10%">Cumplimiento</th>
                           <th width="5%">Ponderación</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $sql_objetivos = "SELECT  no_reloj, nombres, apellidos, puesto, depto FROM registrogdp ORDER BY nombres ASC";
                        $sql_run = mysqli_query($conn, $sql_objetivos);
                        if (mysqli_num_rows($sql_run) > 0) {
                           while ($r = mysqli_fetch_assoc($sql_run)) {
                              $no_reloj_col = $r['no_reloj'];
                        ?>
                              <tr>
                                 <td> <?php echo $r['nombres'] . ' ' . $r['apellidos']; ?></td>
                                 <td> <?php echo $r['puesto']; ?></td>
                                 <td> <?php echo $r['depto']; ?></td>
                                 <td>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT SUM(ponderacion_num) As sumaPonderacion FROM objetivos_gdp  WHERE obj_no_reloj = '$no_reloj_col' AND año_reg = '2022'");
                                    $row = mysqli_fetch_row($res);
                                    $sum = $row[0];
                                    if ($sum < 100) {
                                       echo "No <i style='color:darkred;' class='fas fa-times'></i>";
                                    } else if ($sum = 100) {
                                       echo "Si <i style='color:green;' class='fas fa-check'></i>";
                                    }
                                    ?>

                                 </td>
                                 <td>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT SUM(ponderacion_num) As sumaPonderacion FROM objetivos_gdp  WHERE obj_no_reloj = '$no_reloj_col' AND año_reg = '2022'");
                                    $row = mysqli_fetch_row($res);
                                    if ($sum == 0) {
                                       echo "0";
                                    } else{
                                       echo $sum = $row[0];
                                    }
                                    
                                    ?>

                                 </td>
                              </tr>
                        <?php
                           }
                           mysqli_free_result($sql_run);
                        }
                        ?>
                     </tbody>
                  </table>
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
</body>

</html>
<script type="text/javascript">
   $(document).ready(function() {
      // // Setup - add a text input to each footer cell
      // $('#t_reporteObjetivos thead tr').clone(true).appendTo('#t_reporteObjetivos thead');
      // $('#t_reporteObjetivos thead tr:eq(3) th').each(function(i) {
      //    var title = $(this).text();
      //    $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar ' + title + '" />');
      //    $('tr:nth-child(2)').addClass("encabezadoInputs");

      //    $('input', this).on('keyup change', function() {
      //       if (table.column(i).search() !== this.value) {
      //          table
      //             .column(i)
      //             .search(this.value)
      //             .draw();
      //       }
      //    });
      // });
      var table = $('#t_reporteObjetivos').DataTable({
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
            "infoEmpty": "0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
         },
      });


      $('#tabla_cumplimiento_objetivos thead tr').clone(true).appendTo('#tabla_cumplimiento_objetivos thead');
      $('#tabla_cumplimiento_objetivos thead tr:eq(1) th').each(function(i) {
         var title = $(this).text();
         $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar ' + title + '" />');
         $('tr:nth-child(2)').addClass("encabezadoInputs");

         $('input', this).on('keyup change', function() {
            if (datatable.column(i).search() !== this.value) {
               datatable
                  .column(i)
                  .search(this.value)
                  .draw();
            }
         });
      });
      var datatable = $('#tabla_cumplimiento_objetivos').DataTable({
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
            "infoEmpty": "0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
         },
      });
   });
</script>