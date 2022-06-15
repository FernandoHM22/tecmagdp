<?php
require('../../conexion/conexion.php');
$id = $_GET["id_plan"];


$consultaedit  = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE id_nota = $id");
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
			<title>GDP | Ver Notas para el diálogo</title>
			<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
			<link rel="icon" href="../img/favicon.png" type="image/x-icon">
			<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link href="../css/sb-admin.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		</head>
		<body>
			<form id="form-info"  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="modal-body">
					<div class="form-row">
							<label><span class="fas fa-caret-right"></span> <?php echo $datos['notas'];?></label>
					</div>					
				</div>
			</form>
			<?php 
		} 
		mysqli_free_result($consultaedit); 
	} else{
		echo "No hay notas registradas";
	}
	?>	
</body>
</html>