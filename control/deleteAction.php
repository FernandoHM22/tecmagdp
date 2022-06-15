<?php
require('../conexion/conexion.php');
$id = $_GET["id_plan"];


if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$id_plan = $_POST["id"];

	$deleteAction  = mysqli_query($conn, "DELETE FROM planeacion_gdp WHERE id_plan = $id_plan");
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
			<title>GDP | Borrar Elemento</title>
			<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
			<link rel="icon" href="../img/favicon.png" type="image/x-icon">
			<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link href="../css/sb-admin.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		</head>
		<body>
			<form id="form-info" action="deleteAction.php" method="POST">
				<div class="modal-body">
					<div class="form-row">
						<input type="text" hidden name="id" value="<?php echo $datos['id_plan'];?>" readonly="true"/>
					</div>
					<div class="form-group col-md-12"> 
						<label>¿Desea borrar este plan?</label>
					</div> 	
					<div class="form-group col-md-12 text-right"> 
						<input type="submit" name="update" id="update" value="Borrar" class="btn btn-danger">
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