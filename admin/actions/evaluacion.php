<?php 
include("../../conexion/conexion.php");
$relojColaborador = $_POST['no_reloj_col'];
$relojLider = $_POST['relojLider'];


?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<strong>INSTRUCCIONES:</strong>
	<hr>
	<br>
	<!--<span class="fas fa-info-circle"></span><strong><i>EVALUACION</i></strong>: Seleccione los criterios para evaluar las competencias del colaborador.
	<br>-->
	<span class="fas fa-info-circle"></span><strong><i>FORTALEZAS</i></strong>: Selecciona las 3 competencias más fuertes del colaborador del listado.
	<br>
	<span class="fas fa-info-circle"></span><strong><i>DEBILIDADES</i></strong>: Seleccione las 3 competencias más débiles del colaborador del listado.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="row mb-1">
	<div class="col-md-6">
		<label><strong>FORTALEZAS</strong></label><br>
		<fieldset>
			<legend>Evaluación</legend>
			<?php 
			$ckbx = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE reloj_lider = '$relojLider' AND no_reloj = '$relojColaborador'") or die(mysqli_error($conn));
			if (mysqli_num_rows($ckbx) > 0) $i=1; {
				while ($res = mysqli_fetch_array($ckbx)){ ?>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" checked="">
						<label class="custom-control-label"><?= $res['fortaleza'] ?></label>
					</div>
				<?php }
			} ?>
		</fieldset>
	</div>
	<div class="col-md-6">
		<label><strong>OPORTUNIDADES</strong></label><br>
		<fieldset>
			<legend>Evaluación</legend>
			<?php $ckbx = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE reloj_lider = '$relojLider' AND no_reloj = '$relojColaborador'") or die(mysqli_error($conn));
			if (mysqli_num_rows($ckbx) > 0) {
				while ($res = mysqli_fetch_array($ckbx)){  ?>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" checked="">
						<label class="custom-control-label"><?= $res['oportunidad'] ?></label>
					</div>
				<?php }
			} ?>
		</fieldset>	
	</div>
</div>
<div class="row mr-2 ml-2 mt-5">
	<div class="table table-responsive">
		<?php 
		$sql = $conn->query("SELECT * FROM t_evaluacion WHERE no_relojC = '$relojColaborador' AND reloj_lider = '$relojLider'");
		$datos = $sql->fetch_assoc();
		?>
		<table id="tablaEvaluacion" class="mb-0" >
			<thead>
				<tr>
					<th width="5%">CATEGORIA</th>
					<th width="20%">COMPETENCIAS</th>
					<!-- <th class="text-center">EVALUACIÓN</th> -->
					<th class="text-center" width="10%">FORTALEZAS</th>
					<th class="text-center" width="10%">DEBILIDADES</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="7" id="titulo1"><div class="titulo-rotate">MANEJO DEL AMBIENTE</div></td>
					<td id="subtitulo1-1">RELACIÓN CON SUPERIOR <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con la persona a la que reporta, e influye en su líder para alcanzar las metas."></i></td>
					<!-- <td id="evaluar">
						<select id="select1" class="custom-select">
							<option hidden selected><?php if($datos['competencia1'] == ''){ echo "Seleccione...";}else{echo $datos['competencia1'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Superior">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Superior">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo1-2">RELACIÓN CON COLEGAS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente el ambiente de trabajo con las personas del mismo nivel de autoridad con las que interactúa para lograr resultados."></i></td>
					<!-- <td>
						<select id="select2" class="custom-select">
							<option hidden selected><?php if($datos['competencia2'] == ''){ echo "Seleccione...";}else{echo $datos['competencia2'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Colegas">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Colegas">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>	
				<tr>
					<td id="subtitulo1-3">RELACIÓN CON SUBORDINADOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Se dirige con buen trato a aquellas personas que le reportan directamente, motiva y da coaching."></i></td>
					<!-- <td>
						<select id="select3" class="custom-select">
							<option hidden selected><?php if($datos['competencia3'] == ''){ echo "Seleccione...";}else{echo $datos['competencia3'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Subordinados">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Subordinados">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>	
				<tr>
					<td id="subtitulo1-4">RELACIÓN CON ASESORES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mantiene un trato cordial con las personas calificadas en puestos de apoyo sin autoridad ni poder, cuyo trabajo consiste en proveer información y asesoría."></i></td>
					<!-- <td>
						<select id="select4" class="custom-select">
							<option hidden selected><?php if($datos['competencia4'] == ''){ echo "Seleccione...";}else{echo $datos['competencia4'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Asesores">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Asesores">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo1-5">RELACIÓN CON GRUPOS DE TRABAJO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja un trato efectivo con los comités y grupos de trabajo para la mejora de la compañía."></i></td>
					<!-- <td>
						<select id="select5" class="custom-select">
							<option hidden selected><?php if($datos['competencia5'] == ''){ echo "Seleccione...";}else{echo $datos['competencia5'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Grupos de Trabajo">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Grupos de Trabajo">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>			
				<tr>
					<td id="subtitulo1-6">RELACIÓN CON CLIENTES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece planos de relación que le permiten conocer mejor las necesidades y las expectativas de sus clientes y lograr los objetivos de la empresa."></i></td>
					<!-- <td>
						<select id="select6" class="custom-select">
							<option hidden selected><?php if($datos['competencia6'] == ''){ echo "Seleccione...";}else{echo $datos['competencia6'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Relación con Clientes">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Relación con Clientes">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr id="row1">
					<td id="subtitulo1-7">TRATO CON PUBLICO EN GENERAL <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Maneja efectivamente relaciones con cualquier persona que no es empleado o cliente de la compañía."></i></td>
					<!-- <td>
						<select id="select7" class="custom-select">
							<option hidden selected><?php if($datos['competencia7'] == ''){ echo "Seleccione...";}else{echo $datos['competencia7'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trato con Publico en General">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trato con Publico en General">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td rowspan="8" id="titulo2"><div class="titulo-rotate">EJECUCIÓN DE TAREAS</div></td>
					<td id="subtitulo2-1">CREATIVIDAD <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Genera diversidad de ideas y propone iniciativas de mejora para resolver los retos."></i></td>
					<!-- <td>
						<select id="select8" class="custom-select">
							<option hidden selected><?php if($datos['competencia8'] == ''){ echo "Seleccione...";}else{echo $datos['competencia8'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Creatividad">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Creatividad">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo2-2">FIJACIÓN DE OBJETIVOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Establece estándares de logro de todo aquello que la dirección desea alcanzar, es objetivo y constante."></i></td>
					<!-- <td>
						<select id="select9" class="custom-select">
							<option hidden selected><?php if($datos['competencia9'] == ''){ echo "Seleccione...";}else{echo $datos['competencia9'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Fijación de Objetivos">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Fijación de Objetivos">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>		
				<tr>
					<td id="subtitulo2-3">PLANEACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Distribuye de manera adecuada y efectiva el tiempo para cada tarea que realiza y cuenta con un plan de seguimiento o estrategia para llevar a cabo cada actividad por prioridades."></i></td>
					<!-- <td>
						<select id="select10" class="custom-select">
							<option hidden selected><?php if($datos['competencia10'] == ''){ echo "Seleccione...";}else{echo $datos['competencia10'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Planeación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Planeación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>							
				<tr>
					<td id="subtitulo2-4">MANEJO DEL CAMBIO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Gestiona e impulsa efectivamente los cambios en la estructura de las tareas (métodos, procedimientos, políticas) y también influye en las relaciones para que los cambios sean aceptados."></i></td>
					<!-- <td>
						<select id="select11" class="custom-select">
							<option hidden selected><?php if($datos['competencia11'] == ''){ echo "Seleccione...";}else{echo $datos['competencia11'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo del Cambio">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo del Cambio">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>	
				<tr>
					<td id="subtitulo2-5">IMPLEMENTACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta acciones para realizar planes y tomar decisiones efectivas."></i></td>
					<!-- <td>
						<select id="select12" class="custom-select">
							<option hidden selected><?php if($datos['competencia12'] == ''){ echo "Seleccione...";}else{echo $datos['competencia12'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Implementación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Implementación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>							
				<tr>
					<td id="subtitulo2-6">CONTROLES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ejecuta métodos para monitorear el estado de los fenómenos y acciones de ajustes necesarios  para mantener dentro de la normalidad las variables críticas de los procesos productivos."></i></td>
					<!-- <td>
						<select id="select13" class="custom-select">
							<option hidden selected><?php if($datos['competencia13'] == ''){ echo "Seleccione...";}else{echo $datos['competencia13'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Controles">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Controles">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo2-7">EVALUACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Mide la efectividad de su trabajo en acción y su impacto a través de revisiones periódicas e instrumentos de evaluación."></i></td>
					<!-- <td>
						<select id="select14" class="custom-select">
							<option hidden selected><?php if($datos['competencia14'] == ''){ echo "Seleccione...";}else{echo $datos['competencia14'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="evaluación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="evaluación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr id="row2">
					<td id="subtitulo2-8">PRODUCTIVIDAD <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Logra los resultados requeridos por el superior mediante un uso óptimo de recursos."></i></td>
					<!-- <td>
						<select id="select15" class="custom-select">
							<option hidden selected><?php if($datos['competencia15'] == ''){ echo "Seleccione...";}else{echo $datos['competencia15'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Productividad">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Productividad">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td rowspan="5" id="titulo3"><div class="titulo-rotate">RELACIONES INTERPERSONALES</div></td>
					<td id="subtitulo3-1">COMUNICACIÓN <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo en la transmisión y recepción de información a todos lo niveles."></i></td>
					<!-- <td>
						<select id="select16" class="custom-select">
							<option hidden selected><?php if($datos['competencia16'] == ''){ echo "Seleccione...";}else{echo $datos['competencia16'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Comunicación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Comunicación">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo3-2">MANEJO DE CONFLICTOS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Es efectivo para manejar el desacuerdo, hace concurrir a las partes implicadas para una solución oportuna, escucha y comprende los puntos de vista de los demás."></i></td>
					<!-- <td>
						<select id="select17" class="custom-select">
							<option hidden selected><?php if($datos['competencia17'] == ''){ echo "Seleccione...";}else{echo $datos['competencia17'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo de Conflictos">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo de Conflictos">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo3-3">MANEJO DE ERRORES <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Soluciona y evita errores en los procedimientos y reglas de la empresa, aprende y corrige para que no vuelvan a suceder."></i></td>
					<!-- <td>
						<select id="select18" class="custom-select">
							<option hidden selected><?php if($datos['competencia18'] == ''){ echo "Seleccione...";}else{echo $datos['competencia18'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Manejo de Errores">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Manejo de Errores">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td id="subtitulo3-4">CONDUCCIÓN DE JUNTAS <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Guía y dirige efectivamente reuniones para discutir algo, asegura la coordinación, el enfoque y compromiso de los participantes."></i></td>
					<!-- <td>
						<select id="select19" class="custom-select">
							<option hidden selected><?php if($datos['competencia19'] == ''){ echo "Seleccione...";}else{echo $datos['competencia19'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Conducción de Juntas">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Conducción de Juntas">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
				<tr id="row3">
					<td id="subtitulo3-5">TRABAJO EN EQUIPO <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="Colabora efectivamente con otros miembros de la organización con énfasis en el resultado grupal, aporta, contribuye y coopera."></i></td>
					<!-- <td>
						<select id="select20" class="custom-select">
							<option hidden selected><?php if($datos['competencia20'] == ''){ echo "Seleccione...";}else{echo $datos['competencia20'];}?></option>
							<option value="Excede Expectativas" class="opcion1 custom-select">Excede Expectativas</option>
							<option value="Cumple Expectativas" class="opcion2 custom-select">Cumple Expectativas</option>
							<option value="Cumple Parcialmente" class="opcion3 custom-select">Cumple Parcialmente</option>
							<option value="Insatisfactorio" class="opcion4 custom-select">Insatisfactorio</option>
						</select>
					</td> -->
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxFortalezas[]" class="custom-control-input checkboxFortalezas" value="Trabajo en Equipo">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
					<td id="checkboxes">
						<div class="custom-control custom-checkbox">
							<label><input type="checkbox" name="checkboxOportunidades[]" class="custom-control-input checkboxOportunidades" value="Trabajo en Equipo">
								<div class="custom-control-label"></div>
							</label>
						</div>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"></td>
					<td class="text-center"><input type="button" class="btn btn-warning btn-sm" id="UncheckAll" value="Desmarcar todos"/></td>
					<td class="text-center">
						<input type="text" hidden="" name="relojColaborador" id="relojColaboradorEvaluacion" value="<?php echo $relojColaborador; ?>">
						<?php 
						$sql = $conn->query("SELECT * FROM t_fortalezas WHERE reloj_lider = '$relojLider' AND no_reloj = '$relojColaborador'");
						$row = $sql->fetch_assoc();	
						?>
						<button type="submit" class="btn btn-success btn-sm continue <?php if($row == NULL){ echo "guardarEvaluacion";}else{echo "actualizarEvaluacion";}?>" value="<?php if($row == NULL){ echo "guardarbtnEvaluacion";}else{echo "actualizarbtnEvaluacion";}?>" disabled><?php if($row == NULL){ echo "Guardar";}else{echo "Actualizar";}?> <i class="fas fa-angle-right"></i></button>

						<input type="text" id="relojLider" hidden value="<?= $relojLider ?>">
						<?php 
						$sql = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$relojColaborador'");
						$datos = $sql->fetch_assoc();
						?>
						<input type="text" hidden id="cargoColab" value="<?php echo $datos ['cargoColab']; ?>">

						<?php   
						$buscarOportunidad = mysqli_query($conn, "SELECT * FROM t_oportunidades WHERE reloj_lider = '$relojLider' AND no_reloj = '$relojColaborador'") or die(mysqli_error($conn));
						if (mysqli_num_rows($buscarOportunidad) > 0) {
							while ($result = mysqli_fetch_array($buscarOportunidad)){  ?>
								<input  hidden type="text" name="id_oportunidad[]" value="<?= $result['id_oportunidad'] ?>">
								<?php 
							}
						}
						$buscarFortaleza = mysqli_query($conn, "SELECT * FROM t_fortalezas WHERE reloj_lider = '$relojLider' AND no_reloj = '$relojColaborador'") or die(mysqli_error($conn));
						if (mysqli_num_rows($buscarFortaleza) > 0) {
							while ($r = mysqli_fetch_array($buscarFortaleza)){  ?>
								<input hidden type="text" name="id_fortaleza[]" value="<?= $r['id_fortaleza'] ?>">
								<?php 
							}
						}?>
					</td>
				</tr>
			</tfoot>
		</table>
		
	</div>
</div>

<script src="../../js/evaluacion.js"></script>
