<?php
require('../../conexion/conexion.php');
$id_objetivo = $_GET["id_num_objetives"];


if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$id_objetivo_num = $_POST["id_num"];
	$ImputLogro= $_POST["logro"];
	
	$addActions  = mysqli_query($conn, "UPDATE objetives_gdp SET logro = '$ImputLogro' WHERE id_num_objetives = '$id_objetivo_num'");
	header("Location:".$_SERVER['HTTP_REFERER']);
}


$consultaedit  = mysqli_query($conn, "SELECT * FROM objetives_gdp WHERE id_num_objetives= $id_objetivo");
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
			<title>GDP | Evaluar Objetivo</title>
			<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
			<link rel="icon" href="../img/favicon.png" type="image/x-icon">
			<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link href="../css/sb-admin.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		</head>
		<body>
			<form id="form-info"action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="modal-body">
					<div class="form-row">
						<input type="text" hidden name="id_num" value="<?php echo $datos['id_num_objetives'];?>" readonly="true"/>
						<label>Logro Obtenido:</label>
						<div class="form-group col-md-3 text-center">
							<input type="text" class="form-control" name="logro" style="text-align:center;" value="<?php echo $datos['logro'];?>" required>
						</div>
					</div>
					<div class="form-group col-md-12 text-right"> 
						<input type="submit" name="update" id="update" value="Evaluar" class="btn btn-success">
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