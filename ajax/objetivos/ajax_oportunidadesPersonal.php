<?php 
include("../../conexion/conexion.php");
$periodoObjetivos = $_POST['periodo'];
$no_reloj = $_POST['no_reloj'];
$buscarInfo = mysqli_query($conn, "SELECT * FROM objetives_gdp where obj_no_reloj = '$no_reloj' AND año_reg LIKE '%$periodoObjetivos%' ORDER BY categoria ASC");
if (mysqli_num_rows($buscarInfo) > 0) {
  ?>
  <div class="col-md-12 text-center"><h5>Año: <strong><?php echo $periodoObjetivos;?></strong></h5></div>
  <table id="tablaObjetivosConsulta" class="table table-responsive-md table-bordered ">
    <thead>
      <tr>
        <th style="text-align:center; font-size:14px;">Categoría</th>
        <th style="text-align:center; font-size:14px;">Objetivos</th>
        <th style="text-align:center; font-size:14px;">Impacto</th>
        <th style="text-align:center; font-size:14px;">Acciones</th>
        <th style="text-align:center; font-size:14px;">Métricos (KPI)</th>
        <th style="text-align:center; font-size:14px; word-wrap: break-word;">Ponderación (% Peso del Objetivo)</th>
        <th style="text-align:center; font-size:14px;">Meta</th>
        <th style="text-align:center; font-size:14px;">Logro Obtenido</th>
        <th style="text-align:center; font-size:14px;">Resultado Final</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sumaResultado = 0; 
    while ($datos = mysqli_fetch_array($buscarInfo)){ 
      $idObj = $datos ["id_num_objetives"];
      ?>
        <tr>
          <td style="text-align:justify; font-weight: 600; ">
            <?=$datos["categoria"]?>
          </td>
          <td style="text-align:justify; "><?=$datos["objetivo"]?></td>
          <td style="text-align:justify; "><?=$datos["impacto"]?></td>
          <td style="text-align:justify; "><?=$datos["acciones"]?></td>
          <td style="text-align:justify; "><?=$datos["metricos_kpi"]?></td>
          <td style="text-align:center; font-weight: 500;"><?=$datos["ponderacion_num"]?></td>
          <td style="text-align:center; "><?=$datos["meta_num"]?></td>
          <td style="text-align:center; "><?=$datos["logro"]?></td>
          <td style="text-align:center; "><?php  
          $ponderacion = $datos["ponderacion_num"];
          $divPond =$ponderacion/100;
          $meta=$datos["meta_num"];
          $logro=$datos["logro"];
          $calculoLogro =(($logro/$meta)*100)*$divPond;
          $sumaResultado += $calculoLogro;

          if ($calculoLogro > $ponderacion) {
            echo "$ponderacion";
          }
          else{
            echo number_format($calculoLogro, 2);
          }
          ?>
        </td>
      </tr>
  
    <?php 
  } 
  mysqli_free_result($buscarInfo);
  ?>  
</tbody>
  <tfoot style="background-color:#c8c8c8; color:#000;">
    <tr>
      <td colspan="5" style="text-align: right; color: #000; font-weight: 500; font-size: 15px;">Total:</td>
      <td>
        <?php  
        $consulta="SELECT SUM(ponderacion_num) as TotalPond FROM objetives_gdp WHERE obj_no_reloj = '$no_reloj' AND año_reg LIKE '%$periodoObjetivos%'";
        $resultado=$conn -> query($consulta);
      $fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
      $TotalPorcentaje=$fila['TotalPond'];
      echo '<p style="font-size:14px; color:green; font-weight:600; text-align:center; margin-bottom:-10px;">'.$TotalPorcentaje.'%</p>';
      ?>
    </td>
    <td></td>
    <td></td>
    <td style="font-weight: 600; text-align: center;">Resultado
      <br>
      <?php echo number_format($sumaResultado, 2); ?>
    </td>
  </tr>
</tfoot>
<?php
} else { 
 echo '<div class="alert alert-danger alert-dismissible fade show pt-2 pb-2 mt-" role="alert">
 <strong><i>NOTA:</i></strong><br>No se han registrado objetivos.
 <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
 <span aria-hidden="true">&times;</span>
 </button>
 </div>'; 
} 
?>
</table>


<?php
$result = $conn->query("SELECT * FROM t_comentariosObjetivos WHERE no_relojC = '$no_reloj' AND añoObjetivos = '$periodoObjetivos'");
$mostrar = $result->fetch_assoc();
?>
<label class="col-md-12 mt-5 text-center" style="font-weight: 600; font-size: 14px;">COMENTARIOS DE LIDER (RETROALIMENTACIÓN)</label>
<div class="col-md-12 text-center">
  <textarea class="col-md-6 text-center" name="" id="" disabled=""><?php echo $mostrar['comentario'];?></textarea>
</div>


<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tablaObjetivosConsulta thead tr').clone(true).appendTo( '#tablaObjetivosConsulta thead' );
    $('#tablaObjetivosConsulta thead tr:eq(1) th').each( function (i) {
      var title = $(this).text();
      $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="Buscar '+title+'" />' );
      $('tr:nth-child(2)').addClass( "encabezadoInputs" );

      $( 'input', this ).on( 'keyup change', function () {
        if ( table.column(i).search() !== this.value ) {
          table
          .column(i)
          .search( this.value )
          .draw();
        }
      } );
    } );

    var table = $('#tablaObjetivosConsulta').DataTable( {

    responsive: true,
    orderCellsTop: true,
    fixedHeader: true,
    dom: 'lBfrtip',
    buttons: [
    {
      extend:    'copyHtml5',
      text:      '<i class="fas fa-copy"></i>',
      titleAttr: 'Copy'
    },
    {
      extend:    'excelHtml5',
      text:      '<i class="fas fa-file-excel"></i>',
      titleAttr: 'Excel'
    },
    {
      extend:    'csvHtml5',
      text:      '<i class="far fa-file-alt"></i>',
      titleAttr: 'CSV'
    },
    {
      extend:    'pdfHtml5',
      text:      '<i class="fas fa-file-pdf"></i>',
      titleAttr: 'PDF'
    }
    ],
    language: {
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "info": "_START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": " 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast":"Último",
        "sNext":"Siguiente",
        "sPrevious": "Anterior"
      },
      "sProcessing":"Procesando...",
    }
});
});

</script>