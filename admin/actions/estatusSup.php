<?php
require('../../conexion/conexion.php');
$no_reloj = $_GET["no_reloj_col"];

if (isset($_REQUEST['btnGuardarEstatus'])) {
	$id_Plan = $_POST['idPlan'];
	$check = $_POST['checkbox'];


	foreach($_POST['checkbox'] as $value) {
		$actualizarEstatus  = mysqli_query($conn, "UPDATE planeacion_gdp SET estatus_plan = '$value' WHERE id_plan= '$id_Plan'");
		header("Location:".$_SERVER['HTTP_REFERER']);
	}
}

$Search = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE plan_no_reloj = '$no_reloj'  AND mejora != 'null' AND estatus_plan = 'Actual'");
if (mysqli_num_rows($Search) > 0) { 
	?>
	<div class="container">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="row">
				<div class="col-sm-12 col-xs-12 pb-2">
					<table class="table table-resposive-md  mt-3">

						<thead>
							<tr>
								<th style="font-size: 14px; text-align: left;">Oportunidad de Mejora</th>
								<th style="font-size: 14px; text-align: center;">¿Porque es una mejora? </th>
								<th style="font-size: 14px; text-align: center;">Fecha Compromiso</th>
								<th style="font-size: 14px; text-align: center;">Cumplido</th>
							</tr> 
						</thead>
						<?php


						while ($datos = mysqli_fetch_array($Search)){ 
							?>
							<tbody>
								<tr>
									<td style="text-align: left; font-size: 13px;"><?=$datos["mejora"]?></td>
									<td style="text-align:justify; font-size: 13px;"><?=$datos["porque_mejora"]?></td>
									<td style="text-align: center; font-size: 13px;"><?=$datos["fecha"]?></td>
									<td style="text-align: center;"><input type="checkbox" name="checkbox[]" value="Cumplido">
										<input type="text" name="idPlan" hidden value="<?=$datos['id_plan']?>"></td>
									</tr>
								</tbody>

								<?php 
							} 
							mysqli_free_result($Search); 
						} else { 
							echo '<div class="alert alert-danger alert-dismissible fade show pt-5 pb-5 mt-5 mb-5" role="alert">
							<strong><i>NOTA:</i></strong><br>No se han marcado planes como cumplidos.
							<button type="button" class="close mt-5" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							</div>'; 
						} 
						?> 

					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-3 float-right">
					<input type="submit"  class="btn btn-block btn-success btn-sm " value="Actualizar Estatus" name="btnGuardarEstatus">
					<br>
				</div>
			</div>
		</form>
	</div>



</body>
</html>