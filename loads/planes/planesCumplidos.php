<?php
include('../../conexion/conexion.php');
$no_reloj = $_POST["no_reloj"];
$rol = $_POST["rol"];

if (isset($_REQUEST['btnActualizarEstatusReddin'])) {
	$id_plan = $_POST['id'];
	$estatus = $_POST['estatus'];

	$sql = "UPDATE t_reddin SET estatus = '$estatus' WHERE id_reddin = '$id_plan'";
	if (mysqli_query($conn, $sql) === TRUE) {
		$sqlQuery = "SELECT * FROM t_reddin";
		$resultado = mysqli_query($conn, $sqlQuery) or die(mysqli_error($conn));
		if (mysqli_num_rows($resultado) > 0) {
			$sqlEstatusAcciones = "UPDATE t_reddin SET estatus = '$estatus' WHERE id_plan_rel = '$id_plan'";
			if ($conn->query($sqlEstatusAcciones) === TRUE) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				echo 0;
			}
		} else {
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
}
?>
<div class=" table-responsive pt-3 col-md-12">
	<table class="table table-sm tablaPlanesCumplidos">
		<thead class="text-center">
			<tr>
				<th width="15%">Oportunidad de mejora<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingresar área de oportunidad que tu supervisor te haya mencionado"></i></th>
				<th width="30%">Acciones Especificas <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingresar acciones que ayuden a mejorar tu oportunidad"></i></th>
				<th width="15%">Fecha Compromiso <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Si no hay fecha exacta puedes ingresar recurrencia, semanal o mensual"></i></th>
				<th width="10%">Indicadores a Impactar <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Capturar a que indicador impacta las acciones que realizarás Ejemplo: GPTW , liderazgo, rotación, productividad, gastos fijos, etc."></i></th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$SearchReddin = mysqli_query($conn, "SELECT * FROM t_reddin WHERE no_reloj = '$no_reloj' AND estatus = 'Cumplido' AND oportunidadConsenso != 'null'");
			if (mysqli_num_rows($SearchReddin) > 0) {
				while ($datosReddin = mysqli_fetch_array($SearchReddin)) {
					$idPlan = $datosReddin['id_reddin'];
			?>
					<tr>
						<td><?= $datosReddin["oportunidadConsenso"] ?></td>
						<td><?= $datosReddin["acciones"] ?></td>
						<td><?= $datosReddin["fecha"] ?></td>
						<td><?= $datosReddin["evidencias"] ?></td>
						<td>
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type="text" name="id" hidden value="<?php echo $idPlan ?>">
								<input type="text" name="estatus" value="Actual" hidden>
								<?php if ($rol != "usuario") { ?>
									<button type="submit" class="btn btn-primary btn-sm" name="btnActualizarEstatusReddin">Mover a Plan Actual</button>
								<?php } ?>
							</form>
						</td>
					</tr>
					<tr class="botonesPlan">
						<td></td>
						<td>
							<a style="font-size: 11px;" href="#" data-toggle="modal" data-target="#modalVerAccionesReddin" data-whatever="<?= $dato["id_reddin"] ?>"><span class="fas fa-eye"></span> Acciones</a>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php
				}
				mysqli_free_result($SearchReddin);
			}
			?>
		</tbody>
	</table>
</div>
</body>

</html>