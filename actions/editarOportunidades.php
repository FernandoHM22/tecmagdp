<?php
   require('../conexion/conexion.php');
   $id = $_GET["id_plan"];
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
   	$id_plan = $_POST['id'];
   	$id_nota = $_POST['id_nota'];
   	$consenso = $_POST['consenso'];
   	$notas = $_POST['notas'];
   
   	$actualizar  = mysqli_query($conn, "UPDATE planeacion_gdp SET oportunidadConsenso = '$consenso', id_nota = '$id_nota', notas = '$notas' WHERE id_plan= $id_plan")or die(mysqli_error($conn));
   	header("Location:".$_SERVER['HTTP_REFERER']);
   	
   }
   $consultaedit  = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE id_plan = $id");
   if (mysqli_num_rows($consultaedit) > 0) {
   	while ($datos = mysqli_fetch_array($consultaedit))  {
   		?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
      <link rel="icon" href="../img/favicon.png" type="image/x-icon">
      <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="../css/sb-admin.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../css/estilo.css">
   </head>
   <body>
      <form id="form-info" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
         <div class="modal-body">
            <div class="form-row">
               <input type="text" hidden id="id" name="id" value="<?php echo $datos['id_plan'];?>"/>
               <input type="text" hidden id="id" name="id_nota" value="<?php echo $datos['id_plan'];?>"/>
               <div class="form-group col-md-12" >
                  <label style="font-weight:600;">Oportunidad de Mejora (Consenso):</label>
                  <textarea class="form-control" rows="3" name="consenso" required><?php echo $datos['oportunidadConsenso'];?></textarea>	
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label style="font-weight:600;" class="col-form-label ">Notas para el Dialogo:</label>
                  <textarea class="form-control" rows="3" name="notas" required><?php echo $datos['notas'];?></textarea>
               </div>
            </div>
            <div class=" form-row">
               <div class="form-group col-md-3"> 
                  <input type="submit" name="update" id="update" value="Actualizar" class="btn btn-success">
               </div>
            </div>
         </div>
      </form>
      <?php 
         } 
         mysqli_free_result($consultaedit); 
         } 
         ?>	
   </body>
</html>