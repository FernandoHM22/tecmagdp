<?php 
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
?>

<div id="añoObjetivos" class="col-md-12 col-sm-12 d-block text-center"><h5>Año: <strong>
	<?php 
	$añoQuery = mysqli_query($conn, "SELECT año_reg FROM objetives_gdp WHERE estatus_objetivos = 2 GROUP BY año_reg LIMIT 1");
	if (mysqli_num_rows($añoQuery) > 0) {
		while ($datos = mysqli_fetch_array($añoQuery)){ 
			?>
			<?php echo $datos['año_reg']; ?></strong></h5>
		<?php } 
		mysqli_free_result($añoQuery);
	}
	?>
</div>
<div class="col-md-12">
	<table class="table table-responsive-md table-bordered tablaObjetivosPendientes">
		<thead>
			<tr>
				<th width="10%" style="text-align:center; vertical-align: middle; font-size:14px;">Categoría</th>
				<th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivos</th>
				<th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Impacto</th>
				<th width="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Acciones</th>
				<th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Métricos (KPI)</th>
				<th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Ponderación</th>
				<th width="5%" style="text-align:center; vertical-align: middle;font-size:14px;">Meta</th>
				<th width="5%" style="text-align:center; vertical-align: middle;font-size:14px;">Logro Obtenido</th>
				<th width="5%" style="text-align:center; vertical-align: middle;font-size:14px;">Resultado Final</th>
				<th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Evidencia</th>
				<th width="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Evaluar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$buscarInfo = mysqli_query($conn, "SELECT * FROM objetives_gdp WHERE obj_no_reloj = '$no_reloj' AND estatus_objetivos = 2 ORDER BY categoria ASC");
			if (mysqli_num_rows($buscarInfo) > 0) {
				$sumaResultado = 0; 
				while ($datos = mysqli_fetch_array($buscarInfo)){ 
					$idObj = $datos ["id_num_objetives"];
					?>
					<tr>
						<td style="text-align:justify; font-weight: 600; "><?=$datos["categoria"]?></td>
						<td style="text-align:justify; "><?=$datos["objetivo"]?></td>
						<td style="text-align:justify; "><?=$datos["impacto"]?></td>
						<td style="text-align:justify; "><?=$datos["acciones"]?></td>
						<td style="text-align:justify; "><?=$datos["metricos_kpi"]?></td>
						<td style="text-align:center; font-weight: 500;"><?=$datos["ponderacion_num"]?></td>
						<td style="text-align:center; "><?=$datos["meta_num"]?></td>
						<td style="text-align:center; "><?=$datos["logro"]?></td>
						<td style="text-align:center; "><?php  
						$ponderacion = $datos["ponderacion_num"];
						$divPond =$ponderacion/100;
						$meta=$datos["meta_num"];
						$logro=$datos["logro"];
						$calculoLogro =(($logro/$meta)*100)*$divPond;
						$sumaResultado += $calculoLogro;
						if ($calculoLogro > $ponderacion) {
							echo "$ponderacion";
						}
						else{
							echo number_format($calculoLogro, 2);
						}
						?>
					</td>
					<td><?php if($datos["archivoEvidencia"] != ""){?><a href="<?= $datos["archivoEvidencia"];?>" download><i class="fas fa-file-alt"></i>
					<?php 
						$archivo = mysqli_query($conn, "SELECT SUBSTRING_INDEX(archivoEvidencia, '/', -1) AS archivo FROM objetives_gdp WHERE id_num_objetives = $idObj;");
						if (mysqli_num_rows($archivo) > 0) {
							while ($result = mysqli_fetch_array($archivo)){
								echo $result['archivo'];
							} 
						}
						?></a>
						<?php } ?></td>
						<td class="text-center">
							<a class="add" title="Agregar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"];?>"><i class="fas fa-plus"></i></a>
							<!--<a class="edit" title="Editar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"];?>"><i class="fas fa-pencil-alt"></i></a>-->
							<a class="evaluation" title="Evaluar" data-toggle="tooltip" id="<?= $datos["id_num_objetives"];?>"><i class="fas fa-check-circle"></i></a>
						</td>
					</tr>
					<?php 
				} 
				mysqli_free_result($buscarInfo);
				?> 
			</tbody>
			<tfoot style="background-color:#c8c8c8; color:#000;">
				<tr>
					<td widtd="10%" style="text-align:center; vertical-align: middle; font-size:14px;">Categoría</td>
					<td widtd="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Objetivos</td>
					<td widtd="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Impacto</td>
					<td widtd="15%" style="text-align:center; vertical-align: middle;font-size:14px;">Acciones</td>
					<td widtd="10%" style="text-align:center; vertical-align: middle;font-size:14px;">Métricos (KPI)</td>
					<td>
						<?php
						$consulta="SELECT SUM(ponderacion_num) as TotalPond FROM objetives_gdp WHERE obj_no_reloj = '$no_reloj' AND año_reg LIKE '$año'";
						$resultado=$conn -> query($consulta);
                    $fila=$resultado->fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
                    $TotalPorcentaje=$fila['TotalPond'];
                    echo '<p style="font-size:14px; color:green; font-weight:600; text-align:center; margin-bottom:-10px;">'.$TotalPorcentaje.'%</p>';
                    ?>
                </td>
                <td></td>
                <td></td>
                <td style="font-weight: 600; text-align: center;">Resultado
                	<br>
                	<?php echo number_format($sumaResultado, 2); ?>
                </td>
            </tr>
        </tfoot>
        <?php
    } else{ 
    	echo '<tr><td id="alerta" colspan="11"><div class="alert alert-warning" role="alert">
    	No se ha habilidado la evaluación de objetivos.
    	</div></td>
    	<tr>';
    } 
    ?>
</table>
</div>