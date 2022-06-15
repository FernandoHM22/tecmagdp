<?php
require('../conexion/conexion.php');
$id = $_GET["id_plan"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$idNota = $_POST["id"];
	$nota = $_POST["nota"];
	$addActions  = mysqli_query($conn, "INSERT INTO planeacion_gdp(id_nota, notas) VALUES('$idNota','$nota')");
	header("Location:".$_SERVER['HTTP_REFERER']);
}
$sql  = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE id_plan = $id");
if (mysqli_num_rows($sql) > 0) {
	while ($datos = mysqli_fetch_array($sql))  {
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="">
			<title>GDP | Agregar Notas para el diálogo</title>
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
						<input type="text" hidden name="id" value="<?php echo $datos['id_plan'];?>">
						<div class="form-group col-md-12 text-center">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label style="font-weight:600;">Notas:</label>
							<textarea class="form-control" rows="4" name="nota" required></textarea>

						</div>
					</div>
					<div class="form-group col-md-12 text-right"> 
						<input type="submit" name="update" id="update" value="Agregar Nota" class="btn btn-primary">
					</div> 	
					
				</div>
			</form>
			<?php 
		} 
		mysqli_free_result($sql); 
	} 
	?>	
</body>
</html>