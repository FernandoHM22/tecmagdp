<?php
setlocale(LC_TIME, "spanish");
$titulo = 'Colaboradores';
include('../includes/header.php');
?>
<div id="content-wrapper">
   <div class="container-fluid">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">COLABORADORES</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">SEGUIMIENTO PLANES</a>
         </li>
         <li class="nav-item">
            <?php
            $sql_empleado = "SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj'";
            $result = mysqli_query($conn, $sql_empleado);
            if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_array($result)) {
            ?>
                  <a class="nav-link <?php if ($row['habilitarEvaluacion'] == 0) {
                                          echo "disabled";
                                       } ?> " id="evaluacion-tab" data-toggle="tab" href="#evaluacion_masiva" role="tab" aria-controls="profile" aria-selected="true">EVALUACIÓN MASIVA</a>
            <?php
               }
            }
            mysqli_free_result($result);
            ?>

         </li>
      </ul>
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="colaboradores"></div>
         </div>
         <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div id="seguimientoPlanes"></div>
         </div>
         <div class="tab-pane fade" id="evaluacion_masiva" role="tabpanel" aria-labelledby="evaluacion-tab">
            <div id="evaluacionMasiva"></div>
         </div>
      </div>
   </div>
</div>
</div>

<?php
include('../includes/footer.php');
?>
<script>
   $('#colaboradores').load('../loads/supervisor/colaboradores.php', {
      'no_reloj': '<?php echo $no_reloj ?>'
   });
   $('#seguimientoPlanes').load('../loads/supervisor/seguimientoPlanes.php', {
      'reloj_supervisor': '<?php echo $no_reloj ?>'
   });
   $('#evaluacionMasiva').load('../loads/supervisor/evaluacion_masiva.php', {
      'reloj_supervisor': '<?php echo $no_reloj ?>'
   });
</script>
</body>

</html>