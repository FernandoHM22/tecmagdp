<?php
require('../../conexion/conexion.php');
$no_reloj = $_GET["no_reloj_col"];
$Search = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE plan_no_reloj = '$no_reloj' AND estatus_plan = 'Cumplido'");
if (mysqli_num_rows($Search) > 0) { 
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
			<?php
			while ($datos = mysqli_fetch_array($Search)){ 
				?>
				<tbody>
					<tr>
						<td style="text-align: left; font-size: 13px;"><?=$datos["mejora"]?></td>
						<td style="text-align:justify; font-size: 13px;"><?=$datos["porque_mejora"]?></td>
						<td style="text-align: center; font-size: 13px;"><?=$datos["fecha"]?></td>
					</tr>
				</tbody>
				<?php 
			} 
			mysqli_free_result($Search); 
		} else { 
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong><i>NOTA:</i></strong><br>No se han marcado planes como cumplidos.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>'; 
		} 
		?> 
	</table>
	</form>
</div>



</body>
</html>