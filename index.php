<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	if ($_SESSION["cargoColab"] == 0) {
		header("location: user/myinfo");
		exit;
	} elseif ($_SESSION["cargoColab"] == 1) {
		header("location: admin/myinfoSup");
	} else {
		header("location: user/inicio");
	}
}
include "conexion/conexion.php";
$fechaActual = date("Y-m-d H:i:s");
$username = $password = "";
$username_err = $password_err = "";

if (isset($_REQUEST['btnIniciarSesion'])) {
	if (empty(trim($_POST["no_reloj"]))) {
		$username_err = "Por favor ingrese su usuario.";
	} else {
		$username = trim($_POST["no_reloj"]);
	}
	if (empty(trim($_POST["password"]))) {
		$password_err = "Por favor ingrese su contraseña.";
	} else {
		$password = trim($_POST["password"]);
	}
	if (empty($username_err) && empty($password_err)) {
		$sql = "SELECT no_reloj, pass, repass, cargoColab, isAdmin, perfil FROM login_gdp WHERE no_reloj = ?";
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = $username;
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1) {
					mysqli_stmt_bind_result($stmt, $no_reloj, $pass, $repass, $cargoColab, $isAdmin, $perfil);
					if (mysqli_stmt_fetch($stmt)) {
						if ($password == $repass) {
							if ($cargoColab == 0) {
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["no_reloj"] = $no_reloj;
								$_SESSION["cargoColab"] = $cargoColab;
								$_SESSION["isAdmin"] = $isAdmin;
								$_SESSION["perfil"] = $perfil;
								$sql = mysqli_query($conn, "UPDATE login_gdp SET loginDate = '$fechaActual' WHERE no_reloj = '$no_reloj'");
								header("location: user/myinfo.php");
							} else if ($cargoColab == 1) {
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["no_reloj"] = $no_reloj;
								$_SESSION["cargoColab"] = $cargoColab;
								$_SESSION["isAdmin"] = $isAdmin;
								$_SESSION["perfil"] = $perfil;
								$sql = mysqli_query($conn, "UPDATE login_gdp SET loginDate = '$fechaActual' WHERE no_reloj = '$no_reloj'");
								header("location:  admin/myinfoSup.php");
							}
						} else {
							$password_err = "La contraseña que has ingresado no es válida, por favor verifícala.";
						}
					}
				} else {
					$username_err = "No existe cuenta registrada con ese nombre de usuario.";
				}
			} else {
				echo "Algo salió mal, por favor vuelve a intentarlo.";
			}
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>GDP | Iniciar Sesión</title>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">

</head>

<body class="fondoLogin" oncontextmenu='return false;'>
	<div class="container login-container">
		<img class="rounded mx-auto d-block pt-3 pb-3" src="../img/logo.png">
		<div class="row">
			<div class="col-md-5 login-form-1">
				<h3>Iniciar Sesión</h3>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<input type="text" class="form-control" placeholder="# Reloj *" name="no_reloj" required value="<?php if(!empty($_GET['no_reloj'])){echo base64_decode($_GET['no_reloj']);}else{echo $username; }?>" />
						<span class="help-block"> <?php if ($username_err != null) {
														echo '<span class="fas fa-exclamation-circle" id="exclamation" style="font-size: 11px; color: darkred;"> </span> ' . $username_err;
													} ?></span>
					</div>
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<input type="password" class="form-control" placeholder="Contraseña *" name="password" required value="<?php if(!empty($_GET['password'])){echo base64_decode($_GET['password']);}?>"/>
						<span class="help-block"><?php if ($password_err != null) {
														echo '<span class="fas fa-exclamation-circle" id="exclamation" style="font-size: 11px; color: darkred;"> </span> ' . $password_err;
													} ?></span>
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btnSubmit" value="Entrar" name="btnIniciarSesion" />
					</div>
					<div class="form-group text-center">
						<a style="text-decoration:none; font-size: 14px; color:#007a81" data-toggle="modal" data-target="#forgotPassword" href="#forgotPassword">¿Has olvidado tu contraseña?</a>
					</div>
				</form>
			</div>
			<div class="col-md-7 login-form-2">
				<h3>¿Eres nuevo?</h3>
				<form>
					<div class="form-group">
						<i class="fas fa-bullseye" style="color:#fff; padding-right: 20px;"></i><label>Gestiona Objetivos de tus Colaboradores.</label>
					</div>
					<div class="form-group">
						<i class="fas fa-check-square" style="color:#fff; padding-right: 15px;"></i> <label>Elabora y da seguimiento a Planes de Desarrollo.</label>
					</div>
					<div class="form-group">
						<i class="fas fa-globe-americas" style="color:#fff; padding-right: 20px;"></i> <label>Gestiona Ingles como segunda lengua.</label>
					</div>

					<div class="form-group text-center">
						<input type="button" onclick="location.href = 'vista/register-vista.php';" class="btnReg" value="Registrarme" />
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Reestablecer Contraseña</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div id="msg"></div>
						<form method="post" class="form-horizontal">
							<div class="input-group mb-3">
								<label class="col-sm-12 control-label">Ingrese su Correo:</label>
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
								</div>
								<input type="text" id="txt_email" class="form-control" placeholder="@tecma.com" value="@tecma.com" aria-describedby="basic-addon1" />
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<input type="button" id="btn_send" class="btn btn-primary btn-sm btn-block" value="Enviar">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="http://sibeeshpassion.com/content/scripts/jquery-1.11.1.min.js"></script>
	<script>
		document.onkeypress = function(event) {
			event = (event || window.event);
			if (event.keyCode == 123) {
				return false;
			}
		}
		document.onmousedown = function(event) {
			event = (event || window.event);
			if (event.keyCode == 123) {
				return false;
			}
		}
		document.onkeydown = function(event) {
			event = (event || window.event);
			if (event.keyCode == 123) {
				return false;
			}
		}

		$(document).ready(function() {
			var no_reloj = '<?=base64_decode($_GET['no_reloj'])?>';
			var password = '<?=base64_decode($_GET['password'])?>';
			if(no_reloj != '' && password != ''){
				$('.btnSubmit').trigger('click');
			}

			$(document).on("click", "#btn_send", function(e) {

				var email = $("#txt_email").val();
				var atpos = email.indexOf("@");
				var dotpos = email.lastIndexOf(".com");

				if (email == "") {
					alert("Please Enter Email Address");
				} else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
					alert("Please Enter Valid Email Address !");
				} else {
					$.ajax({
						url: "ajax/perfil/ajax_send_email.php",
						method: "post",
						data: {
							uemail: email
						},
						success: function(response) {
							$("#msg").html(response);
							$('#txt_email').attr("disabled", true);
							$('#btn_send').attr("disabled", true);
						}
					});
				}
			});
		});
	</script>
</body>

</html>