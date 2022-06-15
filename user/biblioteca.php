<?php
$titulo = 'Biblioteca';
include('../includes/header.php');
?>

<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="jumbotron jumbotron-biblioteca">
        <h6 class="display-4"><i class="fas fa-book-reader"></i> Biblioteca</h6>
        <p class="lead">En esta sección encontraras material para el desarrollo de competencias, que puede enriquecer las acciones a realizar dentro de tu plan de desarrollo laboral.</p>

        <a href="planeacion.php"><i class="fas fa-fw fa-chart-area"></i> Consultar Plan de desarrollo</a>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-3">
      <div class="list-group listaMaterialCompetencias">
        <a href="#" class="list-group-item list-group-item-action disabled" aria-current="true" ;>
          Material Competencias
        </a>
        <a href="#" data-id="1" class="list-group-item list-group-item-action btnMaterialCompetencias">Confianza en sí mismo</a>
        <a href="#" data-id="2" class="list-group-item list-group-item-action btnMaterialCompetencias">Autocontrol</a>
        <a href="#" data-id="3" class="list-group-item list-group-item-action btnMaterialCompetencias">Visión Positiva</a>
        <a href="#" data-id="4" class="list-group-item list-group-item-action btnMaterialCompetencias">Gestión de estrés</a>
        <a href="#" data-id="5" class="list-group-item list-group-item-action btnMaterialCompetencias">Asertividad</a>
        <a href="#" data-id="6" class="list-group-item list-group-item-action btnMaterialCompetencias">Orientación a Resultados</a>
        <a href="#" data-id="7" class="list-group-item list-group-item-action btnMaterialCompetencias">Iniciativa</a>
        <a href="#" data-id="8" class="list-group-item list-group-item-action btnMaterialCompetencias">Responsabilidad</a>
        <a href="#" data-id="9" class="list-group-item list-group-item-action btnMaterialCompetencias">Resolución de Problemas</a>
        <a href="#" data-id="10" class="list-group-item list-group-item-action btnMaterialCompetencias">Planificación y organización</a>
        <a href="#" data-id="11" class="list-group-item list-group-item-action btnMaterialCompetencias">Empatía</a>
        <a href="#" data-id="12" class="list-group-item list-group-item-action btnMaterialCompetencias">Trabajo en Equipo</a>
        <a href="#" data-id="13" class="list-group-item list-group-item-action btnMaterialCompetencias">Flexibilidad</a>
        <a href="#" data-id="14" class="list-group-item list-group-item-action btnMaterialCompetencias">Liderazgo</a>
        <a href="#" data-id="15" class="list-group-item list-group-item-action btnMaterialCompetencias">Influencia</a>
        <a href="#" data-id="16" class="list-group-item list-group-item-action btnMaterialCompetencias">Comunicación</a>
        <a href="#" data-id="17" class="list-group-item list-group-item-action btnMaterialCompetencias">Orientación al Servicio al Cliente</a>
        <a href="#" data-id="18" class="list-group-item list-group-item-action btnMaterialCompetencias">Resolución de Conflictos</a>
        <a href="#" data-id="19" class="list-group-item list-group-item-action btnMaterialCompetencias">Desarrollo de Otros</a>
      </div>
    </div>
    <div class="col-md-9">
      <img src="../img/portadaMaterialCompetencias.jpg" class="portadaMaterial" height="100%" width="85%" alt="">
      <iframe class='frame_material' hidden src="" height="100%" width="100%"></iframe>
    </div>
  </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ;>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-lock"></i> Salir Tecma GDP</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" ;>×</span>
        </button>
      </div>
      <div class="modal-body text-center">¿Deseas cerrar sesión?</div>
      <div class="modal-footer">
        <a class="btn btn-danger btn-block" href="../conexion/logout.php">Si</a>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include('../includes/footer.php');
?>

<script>
  $(document).ready(function() {
    $('.btnMaterialCompetencias').on('click', function(e) {
      e.preventDefault();
      var valor = $(this).data('id');
      $('.btnMaterialCompetencias').not(this).removeClass('active');
      $(this).addClass('active');
      switch (valor) {
        case 1:
          $('.frame_material').attr('src', '../archivosCompetencias/1.- Confianza en si mismo.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 2:
          $('.frame_material').attr('src', '../archivosCompetencias/2.- Autocontrol.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 3:
          $('.frame_material').attr('src', '../archivosCompetencias/3.- Vision Positiva.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 4:
          $('.frame_material').attr('src', '../archivosCompetencias/4.- Gestión de estres.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 5:
          $('.frame_material').attr('src', '../archivosCompetencias/5.- Asertividad.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 6:
          $('.frame_material').attr('src', '../archivosCompetencias/6.- Orientacion a Resultados.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 7:
          $('.frame_material').attr('src', '../archivosCompetencias/7.- Iniciativa.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 8:
          $('.frame_material').attr('src', '../archivosCompetencias/8.- Responsabilidad.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 9:
          $('.frame_material').attr('src', '../archivosCompetencias/9.- Resolucion de Problemas.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 10:
          $('.frame_material').attr('src', '../archivosCompetencias/10.- Planificacion y Organizacion.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 11:
          $('.frame_material').attr('src', '../archivosCompetencias/11.- Empatia.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 12:
          $('.frame_material').attr('src', '../archivosCompetencias/12.- Trabajo en Equipo.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 13:
          $('.frame_material').attr('src', '../archivosCompetencias/13.- Flexibilidad.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 14:
          $('.frame_material').attr('src', '../archivosCompetencias/14.- Liderazgo.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 15:
          $('.frame_material').attr('src', '../archivosCompetencias/15.- Influencia.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 16:
          $('.frame_material').attr('src', '../archivosCompetencias/16.- Comunicacion.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 17:
          $('.frame_material').attr('src', '../archivosCompetencias/17.- Orientacion al Servicio al Cliente.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 18:
          $('.frame_material').attr('src', '../archivosCompetencias/18.- Resolucion de conflictos.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
        case 19:
          $('.frame_material').attr('src', '../archivosCompetencias/19.- Desarrollo de Otros.pdf').prop('hidden', false);
          $('.portadaMaterial').prop('hidden', true);
          break;
      }
    });
  });
</script>
</body>

</html>