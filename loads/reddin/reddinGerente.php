<?php 
include('../../conexion/conexion.php');
$reloj = $_POST['relojColaborador'];
?>

<div class="col-md-4 divReddinGerente">
	<?php 
	$sql = $conn->query("SELECT * FROM registrogdp  WHERE no_reloj = '$reloj'");
	$row = $sql->fetch_assoc();
	$relojLider = $row['liderArea'];
	$fortalezas = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE no_reloj = '$reloj' AND reloj_lider = '$relojLider'");
	if (mysqli_num_rows($fortalezas) > 0) {$i=1;
		?>
		<table class="table table-sm">
			<thead>
				<tr>
					<td colspan="2">FORTALEZAS</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				while ($datos = mysqli_fetch_assoc($fortalezas)){
					?>
					<tr>
						<td>
							<?php echo $i++; ?>
						</td>
						<td>
							<?= $datos['fortaleza']; ?>
						</td>
					</tr>
					<?php 
				} 
				mysqli_free_result($fortalezas); 
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Líder aún no ha registrado sus Fortalezas.
				</button>
				</div>';
			}
			?>
		</tbody>
	</table>
</div>

<div class="col-sm-4 col-md-4 text-center divReddinGerente">
	<?php 
	$resultado = mysqli_query($conn,"SELECT * FROM registrogdp  WHERE no_reloj = '$relojLider'") or die(mysqli_error($conn));
	if (mysqli_num_rows($resultado) > 0) {
		while ($datos = mysqli_fetch_assoc($resultado)){ ?>
			<h4><?= $datos['nombres']?> <?= $datos['apellidos']?></h4> 
			<img src="<?= $datos['img']?>" width="100px;" height="auto" class="rounded m-0 p-0">
			<?php 
		}
		mysqli_free_result($resultado);
	}
	?>
</div>
<div class="col-md-4 divReddinGerente">
	<?php 
	$oportunidad = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE no_reloj = '$reloj' AND reloj_lider = '$relojLider'");
	if (mysqli_num_rows($oportunidad) > 0) {$i=1;
		?>
		<table class="table table-sm">
			<thead>
				<tr>
					<td colspan="2">OPORTUNIDADES</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				while ($datos = mysqli_fetch_assoc($oportunidad)){
					?>
					<tr>
						<td>
							<?php echo $i++; ?>
						</td>
						<td>
							<?= $datos['oportunidad']; ?>
						</td>
					</tr>
				</tbody>
				<?php 
			} 
			mysqli_free_result($oportunidad); 
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Líder aún no ha registrado sus Oportunidades.
			</button>
			</div>';
		}
		?>
	</table>
</div>
<div class="col-md-12 pt-3 text-center">
	<a class="cambiarReddinASupervisor" title="Cambiar a vista Supervisor" data-toggle="tooltip"><i class="fas fa-exchange-alt" style="color: #63abb8; cursor:pointer;"></i></a>
</div>

<script type="text/javascript">

  $('[data-toggle="tooltip"]').tooltip();

	$(document).ready(function() {
  var reloj = window.noReloj;
  $(document).on("click", ".cambiarReddinASupervisor", function() {
    $('.divReddinSupervisor').css("display", "block");
    $('.divReddinGerente').css("display", "none");
    $('.cambiarReddinAGerente').css("display", "block");
    $('.cambiarReddinASupervisor').css("display", "none");
  });
});
</script>