<?php
$titulo = 'Objetivos';
include('../includes/header.php');
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <h6 class="mr-3 ml-3">OBJETIVOS CORPORATIVOS</h6>
    <div class="alert alert-info alert-dismissible fade show alertaObjetivos" role="alert">
      <div class="row">
        <div class="col-md-6">
          <span class="fas fa-circle"></span><strong> CRECIMIENTO</strong>: Crecer el HC al doble (de 13,500 a 24,000) en 3 años.
          <br>
          <span class="fas fa-circle"></span><strong> CUSTOMER SUCCESS</strong>: Enfoque en soluciones que contribuyan al éxito del cliente.
        </div>
        <div class="col-md-6">
          <span class="fas fa-circle"></span><strong> TECNOLOGÍA</strong>: Sistematizar y optimizar procesos a través de la tecnología.
          <br>
          <span class="fas fa-circle"></span><strong> GPTW</strong>: Fomentar la Cultura de Tecma para continuar siendo un gran lugar para trabajar.
        </div>
      </div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
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

      <div class="tab-pane fade show active" id="registro" role="tabpanel" aria-labelledby="registro-tab">.
        <div class=" col-sm-12 col-md-12 col-lg-12" id="divTablaObjetivos"></div>
        <div class="col-md-12 mt-4">
          <!-- <button type="button" class="btn btn-info btn-sm verObjetivosLider" data-toggle="modal" data-target="#modalVerObj"><i class="fas fa-eye"></i> Ver Objetivos de mi Líder</button> -->

          <div id="displaymessage" class="col-md-12 col-sm-12 d-block text-center"></div>
        </div>

      </div>
      <div class="tab-pane fade" id="evaluar" role="tabpanel" aria-labelledby="evaluar-tab">
        <div class="col-md-12" id="divObjetivosEvaluar"></div>
      </div>
      <div class="tab-pane fade" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
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
                                                                                        echo $_SESSION["no_reloj"];
                                                                                        ?>">
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

<?php
include('../includes/footer.php');
?>
<script>
  window.noReloj = "<?php echo $no_reloj;  ?>";
  $('#divTablaObjetivos').load("../loads/objetivos/tablaObjetivosNew.php", {
    'no_reloj': '<?php echo $no_reloj ?>',
    'cargoColab': '<?php echo $cargoColab ?>'
  });
  $('#divObjetivosEvaluar').load("../loads/objetivos/tablaObjetivosPendientes.php", {
    'no_reloj': '<?php echo $no_reloj ?>'
  });
  $(function() {
    $('textarea.txtcomentario').each(function() {
      $(this).height(1);
      $(this).height(10 + $(this).get(0).scrollHeight);
    });
  });
  $('#buscarObjetivos').attr('disabled', 'disabled');
</script>
</body>
</html>