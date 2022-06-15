<?php
$titulo = 'Planeacion';
include('../includes/header.php');
?>
<div id="content-wrapper content-wrapper-planeacion" class="container-fluid">
  <ul class="nav nav-tabs nav-justified mt-3" id="myTab" role="tablist">
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

<?php
include('../includes/footer.php');
?>

<script>
  window.noReloj = "<?php echo $no_reloj ?>";

  $('#divPlanActual').load("../loads/planes/planActual.php", {
    'no_reloj': '<?php echo $no_reloj ?>',
    'rol': 'usuario'
  });
  $('#divPlanesCumplidos').load("../loads/planes/planesCumplidos.php", {
    'no_reloj': '<?php echo $no_reloj ?>',
    'rol': 'usuario'
  });

  $('#modalVerAccionesReddin').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever');
    var modal = $(this);
    $.ajax({
      type: "POST",
      url: "../actions/verAccionesReddin.php",
      data: {
        id_reddin: id
      },
      cache: false,
      success: function(data) {
        modal.find('.modalAcciones').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
</script>

</html>
</body>