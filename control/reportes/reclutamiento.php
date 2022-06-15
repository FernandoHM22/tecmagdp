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
  <style>
    tfoot {
      display: table-header-group;
      background-color: rgba(0, 122, 129, 0.3);
    }
  </style>
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
          <a class="nav-link" href="../admin/colaboradoresSup.php">
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
            <a class="dropdown-item" href="reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
            <a class="dropdown-item" href="reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
            <a class="dropdown-item" href="reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
            <a class="dropdown-item" href="reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
            <a class="dropdown-item active" href="reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
          </div>
        </li>
      <?php } ?>
    </ul>
    <div id="content-wrapper">
      <div class="table table-responsive  table-sm table-compact col-md-12">
        <table id="t_reclutamiento" class="display" style="width:100%">
          <thead>
            <tr class="text-center">
              <th width="1%">#</th>
              <th>Nombre Colaborador</th>
              <th>Departamento Actual</th>
              <th>Potencial</th>
              <th>Desempeño</th>
              <th>Área de interes</th>
              <th>Área Experiencia</th>
              <th>Región</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="text-center">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $sqlQuery = "SELECT r.nombres, r.nombres, r.apellidos, r.depto, r.region, f.areaExperienciaUno, f.areaExperienciaDos, f.areaExperienciaTres,  f.areaInteresUno, f.areaInteresDos, f.areaInteresTres, m.potencial, m.desempeno  FROM registrogdp r INNER JOIN t_fichatalento f ON  f.reloj_colaborador = r.no_reloj INNER JOIN t_matriz m ON   m.no_reloj = f.reloj_colaborador" or die(mysqli_error($conn));
            $resultado = mysqli_query($conn, $sqlQuery);
            if (mysqli_num_rows($resultado) > 0) {
              $i = 1;
              while ($datos = mysqli_fetch_array($resultado)) {
            ?>
                <tr>
                  <td style="font-weight: 600;"><?php echo $i++; ?></td>
                  <td><?= $datos['nombres'] ?> <?= $datos['apellidos'] ?> </td>
                  <td><?= $datos['depto'] ?></td>
                  <td><?= $datos['potencial'] ?></td>
                  <td><?= $datos['desempeno'] ?></td>
                  <td>
                    <ol>
                      <li><?= $datos['areaInteresUno'] ?></li>
                      <li><?= $datos['areaInteresDos'] ?></li>
                      <li><?= $datos['areaInteresTres'] ?></li>
                    </ol>
                  </td>
                  <td>
                    <ol>
                      <li><?= $datos['areaExperienciaUno'] ?></li>
                      <li><?= $datos['areaExperienciaDos'] ?></li>
                      <li><?= $datos['areaExperienciaTres'] ?></li>
                    </ol>
                  </td>
                  <td><?= $datos['region'] ?></td>
                </tr>
            <?php
              }
              mysqli_free_result($resultado);
            }
            ?>
          </tbody>
        </table>
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
    <!-- Select2 plugin -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<!-- Select2 plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    /*  $('#t_reclutamiento thead tr').clone(true).appendTo('#t_reclutamiento thead');
      $('#t_reclutamiento thead tr:eq(1) th').each(function(i) {
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
      });*/

    var table = $('#t_reclutamiento').DataTable({
      initComplete: function() {
        count = 0;
        this.api().columns([2, 3, 4, 7]).every(function() {
          var title = this.header();
          //replace spaces with dashes
          title = $(title).html().replace(/[\W]/g, '-');
          var column = this;
          var select = $('<select id="' + title + '" class="select2" ></select>')
            .appendTo($(column.footer()).empty())
            .on('change', function() {
              //Get the "text" property from each selected data 
              //regex escape the value and store in array
              var data = $.map($(this).select2('data'), function(value, key) {
                return value.text ? '^' + $.fn.dataTable.util.escapeRegex(value.text) + '$' : null;
              });

              //if no data selected use ""
              if (data.length === 0) {
                data = [""];
              }

              //join array into string with regex or (|)
              var val = data.join('|');

              //search for the option(s) selected
              column
                .search(val ? val : '', true, false)
                .draw();
            });

          column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>');
          });

          //use column title as selector and placeholder
          $('#' + title).select2({
            multiple: true,
            closeOnSelect: false,
            placeholder: "Select a " + title
          });

          //initially clear select otherwise first option is selected
          $('.select2').val(null).trigger('change');
        });
      },
      responsive: true,
      orderCellsTop: true,
      fixedHeader: true,
      dom: 'lBfrtip',
      "columnDefs": [{
        "targets": [6],
        "visible": false,
        "searchable": true
      }],
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