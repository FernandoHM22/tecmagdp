<?php $page = "register-vista";
$token = bin2hex(openssl_random_pseudo_bytes(16));
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=11, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>GDP - Registro</title>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<script src="../vendor/jquery/jquery.min.js"></script>
</head>

<body class="fondo" oncontextmenu='return false;'>
	<div class="container register">
		<form id="formRegistro" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" autocomplete="off">
			<div class="row">
				<div class="col-md-3 register-left">
					<a href="../vista/login-vista.php"><img src="../img/logo.png" alt="" /></a>
					<h3>Bienvenido(a)</h3>
					<p>GDP</p>
					<input type="button" onclick="location.href ='../vista/login-vista.php';" name="" value="Iniciar Sesión" /><br />
				</div>
				<div class="col-md-9 register-right">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<h3 class="register-heading">Registrarme</i></h3>
							<div id="displaymessage" class="col-md-12 col-sm-12 d-block text-center"></div>
							<div class="row register-form">
								<div class="col-md-4">
									<div class="form-group">
										<input type="number" min="1" class="form-control" placeholder="# Reloj *" id="usuario" name="no_reloj" required />
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Nombres *" id="nombres" name="nombres" required />
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Apellidos *" id="apellidos" name="apellidos" required />
									</div>
									<div class="form-group">
										<input type="password" class="form-control" placeholder="Contraseña *" id="pass" name="pass" required />
									</div>
									<div class="form-group">
										<input type="password" class="form-control" placeholder="Confirmar Contraseña *" id="repass" name="repass" required />
										<!-- <label style="font-size:12px; text-align: center;"><strong style="color:red;">*</strong>La contraseña debería tener al menos 8 carácter(es), al menos 1 dígito(s), al menos 1 minúscula(s), al menos 1 MAYÚSCULA(S)</label> -->
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<input type="email" class="form-control" placeholder="Correo(nombre.apellido@tecma.com) *" id="correo" name="correo" required value="@tecma.com">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Puesto *" id="puesto" name="puesto" required />
									</div>
									<div class="form-group">
										<select class="form-control selectpicker mb-2 mr-sm-2 mb-sm-0 show-tick" id="depto" name="depto" required title="Seleccionar departamento" data-live-search="true">
											<option value="Aduanas">Aduanas</option>
											<option value="Ambiental, Seguridad E Higiene">Ambiental, Seguridad E Higiene</option>
											<option value="Cafetería">Cafetería</option>
											<option value="Compras">Compras</option>
											<option value="Culture Innovation">Culture Innovation</option>
											<option value="Desarrollo de Talento">Desarrollo de Talento</option>
											<option value="Finanzas">Finanzas</option>
											<option value="Ingeniería De Planta">Ingeniería De Planta</option>
											<option value="Operaciones">Operaciones</option>
											<option value="Reclutamiento">Reclutamiento</option>
											<option value="Recursos Humanos">Recursos Humanos</option>
											<option value="Seguridad Patrimonial">Seguridad Patrimonial</option>
											<option value="Servicios Médicos">Servicios Médicos</option>
											<option value="Sistemas">Sistemas</option>
											<option value="Transportes">Transportes</option>
										</select>
									</div>
									<div class="form-group">
										<div id="supervisores"></div>
									</div>
									<label style="font-weight: 600;">¿Tiene personal a cargo?</label>
									<div class="input-group input-group-sm">
										<div class="btn-group btn-group-sm btn-group-toggle btn-group--switch w-100" data-toggle="buttons">
											<label class="btn btn-switch" data-switch="on"><input type="radio" name="radioSupervisor" value="1">Si</label>
											<label class="btn btn-switch" data-switch="off"><input type="radio" name="radioSupervisor" value="0">No</label>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div id="upload-demo"></div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="customFile" name="file" onchange="validarFile(this);" accept="image/*" required="">
											<label class="custom-file-label" for="customFile">Selecciona Imagen...</label>
										</div>
										<label style="font-size:12px; text-align: center;"><strong style="color:red;">*</strong>Foto de frente, solamente rostro (no cuerpo completo)</label>
									</div>

								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label style="font-weight: 600;">Región:</label>
										<div class="form-check">
											<button type="button" class="btn_choose_sent bg_btn_chose_1">
												<input type="radio" name="radioRegion" value="Central" />Juárez | El Paso.
											</button>
										</div>
										<div class="form-check">
											<button type="button" class="btn_choose_sent bg_btn_chose_2">
												<input type="radio" name="radioRegion" value="West" />Tijuana | San Diego
											</button>
										</div>
										<div class="form-check">
											<button type="button" class="btn_choose_sent bg_btn_chose_3">
												<input type="radio" name="radioRegion" value="East" />Torreón | Silaó
											</button>
										</div>
									</div>
									<input type="submit" class="btnRegister" value="Registrarme" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script src="../js/registro.js"></script>
	<script>
		window.tokenRegistro = "<?php echo $token ?>";
	</script>
</body>

</html>