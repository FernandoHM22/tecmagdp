<?php
require('../conexion/conexion.php');
$id = $_GET["id_reddin"];
?>
<div class="table-responsive">
	<table id="tablaNotasDialogo" class="table table-sm">
		<thead>
			<tr>
				<th>Nota</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql_notas  = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_nota = $id");
			if (mysqli_num_rows($sql_notas) > 0) {
				while ($row = mysqli_fetch_array($sql_notas)) {
			?>
					<tr>
						<td class="input_notas" data-id="<?= $row['id_nota'] ?>"><i class="fas fa-circle-notch"></i> <?= $row['notas'] ?></td>
						<td><a href="#" class="btnBorrarNota" data-id="<?= $id ?>"><i class="fas fa-trash"></i></a></td>
					</tr>
			<?php
				}
				mysqli_free_result($sql_notas);
			} else {
				echo '
				<tr>
					<td colspan="2">
						<div class="alert alert-danger" role="alert">
						No se registro nota de diálogo.
						</div>
					</td>
				</tr>';
			}
			?>
		</tbody>
	</table>
</div>