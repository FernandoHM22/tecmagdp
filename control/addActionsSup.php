<?php
require('../conexion/conexion.php');
$id = $_GET["id_plan"];


if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$id_plan_rel = $_POST["id"];
	$fecha_reg = $_POST["fecha"];
	$accion= $_POST["accion"];
	$mes= $_POST["mes_reg"];
	$year= $_POST["year_reg"];
	$estatus= $_POST["estatus_plan"];
	$no_reloj= $_POST["reloj"];
	
	$addActions  = mysqli_query($conn, "INSERT INTO planeacion_gdp(id_plan_rel, more_actions, mes_reg, year_reg, date_reg_action, plan_no_reloj, estatus_plan ) VALUES('$id_plan_rel','$accion','$mes','$year','$fecha_reg','$no_reloj', '$estatus')");
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
			<title>GDP | Agregar Acciones</title>
			<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
			<link rel="icon" href="../img/favicon.png" type="image/x-icon">
			<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link href="../css/sb-admin.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/estilo.css">
		</head>
		<body>
			<form id="form-info" action="addActionsSup.php" method="POST">
				<div class="modal-body">
					<div class="form-row">
						<input type="text" hidden name="id" value="<?php echo $datos['id_plan'];?>" readonly="true"/>
						<div class="form-group col-md-12 text-center">
							<input type="text" name="reloj" hidden value="<?php echo $datos['plan_no_reloj'];?>">
							<input type="text" class="form-control" name="fecha" style="text-align:center;" required="" placeholder="07 de octubre del 2020" value="">
							<input type="text" name="mes_reg" hidden value="<?php setlocale(LC_TIME,"es_MX.UTF-8");  echo strftime("%B");?>">
							<input type="text" name="year_reg" hidden value="<?php setlocale(LC_TIME,"es_MX.UTF-8");  echo strftime("%Y");?>">
							<input type="text" name="estatus_plan" hidden value="Actual">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label style="font-weight:600;">Acciones especificas</label>
							<textarea class="form-control" rows="4" name="accion" required></textarea>

						</div>
					</div>
					<div class="form-group col-md-12 text-right"> 
						<input type="submit" name="update" id="update" value="Agregar" class="btn btn-primary">
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