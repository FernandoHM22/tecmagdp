<?php
require('../../conexion/conexion.php');
$id = $_GET["id_ingles"];


if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$id = $_POST["id"];
	$nivelA = $_POST["nivela"];
	$nivelR = $_POST["nivelr"];
	$estatus= $_POST["status"];
	$observaciones = $_POST["observacion"];

	$actualizar  = mysqli_query($conn, "UPDATE ingles_esl SET nivel_actual = '$nivelA', nivel_requerido = '$nivelR', estatus ='$estatus', observaciones ='$observaciones' WHERE id_ingles= $id");
	header("location:../inglesSup.php");
}


$consultaedit  = mysqli_query($conn, "SELECT * FROM ingles_esl WHERE id_ingles = $id");
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
			<title>GDP | Ingles (ESL)</title>
			<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
			<link rel="icon" href="../img/favicon.png" type="image/x-icon">
			<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link href="../css/sb-admin.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/estilo.css">

			<!-- Bootstrap Core CSS -->

		</head>
		<body>
			<form class="form-inline" method="POST" action="actions/editarIngles.php">
				<div class="modal-body">
					<div class="row">
						<input type="text" hidden id="id" name="id" value="<?php echo $datos['id_ingles'];?>" readonly="true"/>
						<label class=" font-weight-bold ml-3 mb-2 mt-1">Nivel Actual:</label>
						<div class="col-12">
							<select class="custom-select" name="nivela" id="nivela">
								<option hidden><?php echo $datos['nivel_actual'];?></option>
								<option value="Sin Conocimiento">Sin Conocimiento</option>
								<option value="Básico 1">Básico 1</option>
								<option value="Básico 2">Básico 2</option> 
								<option value="Intermedio 1">Intermedio 1</option>
								<option value="Intermedio 2">Intermedio 2</option>
								<option value="Avanzado 1">Avanzado 1</option>
								<option value="Avanzado 2">Avanzado 2</option>
							</select>
						</div>
						<label class="font-weight-bold ml-3 mb-2 mt-1">Nivel Requerido (Puesto Trabajo):</label>
						<div class="col-12">
							<select class="custom-select" name="nivelr" id="nivelr">
								<option hidden><?php echo $datos['nivel_requerido'];?></option>
								<option value="Sin Conocimiento">Sin Conocimiento</option>
								<option value="Básico 1">Básico 1</option>
								<option value="Básico 2">Básico 2</option> 
								<option value="Intermedio 1">Intermedio 1</option>
								<option value="Intermedio 2">Intermedio 2</option>
								<option value="Avanzado 1">Avanzado 1</option>
								<option value="Avanzado 2">Avanzado 2</option>
							</select>
						</div>
						<label class="font-weight-bold ml-3 mb-2 mt-1">Estatus:</label>
						<div class="col-12">	
							<select class="custom-select" name="status" id="status" required>
								<option hidden><?php echo $datos['estatus'];?></option>
								<option value="No Cursando">No Cursando</option>
								<option value="Completado">Completado</option>
								<option value="Básico 1">Cursando Básico 1</option>
								<option value="Básico 2">Cursando Básico 2</option> 
								<option value="Intermedio 1">Cursando Intermedio 1</option>
								<option value="Intermedio 2">Cursando Intermedio 2</option>
								<option value="Avanzado 1">Cursando Avanzado 1</option>
								<option value="Avanzado 2">Cursando Avanzado 2</option>
							</select>
						</div>
						<label class=" font-weight-bold ml-3 mb-2 mt-1" >Observaciones:</label>
						<div class="col-12">
							<div class="input-group ">
								<textarea class="form-control custom-control" rows="2" name="observacion" required id="observacion"><?php echo $datos['observaciones'];?></textarea>
							</div>
						</div> 
					</div>
					<div class="modal-footer">
						<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-success" />

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
