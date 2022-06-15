<?php 
include("../../conexion/conexion.php"); 
$año = $_POST['año']; 
?>
<label class="switch">
  <input type="checkbox" id="chbxEvaluar"
  <?php 
  $query = mysqli_query($conn, "SELECT estatus_objetivos FROM objetives_gdp WHERE año_reg = '$año' AND estatus_objetivos != 1 AND estatus_objetivos != 0 GROUP BY estatus_objetivos");
  while ($row = mysqli_fetch_assoc($query)) {
   $estatus_objetivos = $row['estatus_objetivos'];
   echo "checked";
 } ?>>
 <span class="slider round"></span>
</label>
<script src="../../js/administracion.js"></script>