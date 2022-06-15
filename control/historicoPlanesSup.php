<?php
require('../conexion/conexion.php');
$no_reloj = $_GET["no_reloj_col"];

if (isset($_REQUEST['btnActualizarEstatus'])) {
	$id_plan = $_POST['id'];
	$estatus = $_POST['estatus'];

	$sql = mysqli_query($conn, "UPDATE planeacion_gdp SET estatus_plan = '$estatus' WHERE id_plan = '$id_plan'");
	header("Location:".$_SERVER['HTTP_REFERER']);
}
if (isset($_REQUEST['btnActualizarEstatusReddin'])) {
	$id_plan = $_POST['id'];
	$estatus = $_POST['estatus'];

	$sql = mysqli_query($conn, "UPDATE t_reddin SET estatus = '$estatus' WHERE id_reddin = '$id_plan'");
	header("Location:".$_SERVER['HTTP_REFERER']);
}


?>
<div class="col-sm-12 col-xs-12 pb-2">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<table class="table table-resposive-md  mt-3">
			<thead>
				<tr>
					<th style="font-size: 14px; text-align: center;">Oportunidad de Mejora</th>
					<th style="font-size: 14px; text-align: center;">¿Porque es una mejora? </th>
					<th style="font-size: 14px; text-align: center;">Fecha Compromiso</th>
					<th></th>
				</tr> 
			</thead>
			<tbody>
				<?php
				$Search = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE plan_no_reloj = '$no_reloj' AND estatus_plan = 'Cumplido'");
				if (mysqli_num_rows($Search) > 0) { 
					while ($datos = mysqli_fetch_array($Search)){ 
						$idPlan = $datos['id_plan'];
						?>

						<tr>
							<td style="text-align: left; font-size: 13px;"><?=$datos["mejora"]?></td>
							<td style="text-align:justify; font-size: 13px;"><?=$datos["porque_mejora"]?></td>
							<td style="text-align: center; font-size: 13px;"><?=$datos["fecha"]?></td>
							<td>
								<input type="text" name="id" hidden value="<?php echo $idPlan ?>">
								<input type="text" name="estatus" value="Actual" hidden> 
								<input type="submit" class="btn btn-primary btn-sm" name="btnActualizarEstatus" value="Mover a Plan Actual">
							</td>
						</tr>
						<?php 
					} 
					mysqli_free_result($Search); 
				} 
				$SearchReddin = mysqli_query($conn, "SELECT * FROM t_reddin WHERE no_reloj = '$no_reloj' AND estatus = 'Cumplido'");
				if (mysqli_num_rows($SearchReddin) > 0) { 
					while ($datos = mysqli_fetch_array($SearchReddin)){
						$idPlan = $datos['id_reddin'];
						?>
						<tr>
							<td style="text-align: left; font-size: 13px;"><?=$datos["oportunidadConsenso"]?></td>
							<td style="text-align:justify; font-size: 13px;"><?=$datos["porque_mejora"]?></td>
							<td style="text-align: center; font-size: 13px;"><?=$datos["fecha"]?></td>
							<td>
								<input type="text" name="id" hidden value="<?php echo $idPlan ?>">
								<input type="text" name="estatus" value="Actual" hidden> 
								<input type="submit" class="btn btn-primary btn-sm" name="btnActualizarEstatusReddin" value="Mover a Plan Actual">
							</td>
						</tr>
						<?php 
							} 
					mysqli_free_result($SearchReddin); 
				}
						?>
					</tbody>

				</table>
			</form>
		</div>
	</body>
	</html>