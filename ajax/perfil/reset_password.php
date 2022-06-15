<?php
if(empty($_GET)){
	header('Location: https://www.tecmagdp.com');
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
	<title>GDP | Crear nueva contraseña</title>
	<link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
	<link rel="icon" href="../../img/favicon.png" type="image/x-icon">
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
</head>

<body class="fondoLogin" oncontextmenu='return false;'>
	<div class="container login-container">
		<img class="rounded mx-auto d-block pt-3 pb-3" src="../../img/logo.png">
		<div class="row">
			<div class="col-md-12 login-form-1">
				<div class="card login-form">
					<div class="card-body">
						<h3 class="card-title text-center">Crear nueva contraseña</h3>
						<!--Password must contain one lowercase letter, one number, and be at least 7 characters long.-->
						<div class="card-text">
							<form method="post">
								<div id="msg"></div>
								<div class="form-group">
									<label for="exampleInputEmail1">Nueva Contraseña:</label>
									<input type="password" id="txt_password" class="form-control" placeholder="nueva contraseña" />
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Repetir Contraseña:</label>
									<input type="password" id="txt_cpassword" class="form-control" placeholder="confirmar nueva contraseña" />
								</div>
								<input type="button" id="btn_update" class="btn btn-primary btn-block submit-btn mt-5" value="Confirmar">
								<input type="text" value="<?php echo $_GET["token"]; ?>" hidden disabled id="txt_token" />
								<div class="form-group mt-5">
									<div>
										Ya tienes una cuenta?
										<a href="https://tecmagdp.com">Inicia Sesión</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../../vendor/jquery/jquery.min.js"></script>
	<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="http://sibeeshpassion.com/content/scripts/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(document).on("click", "#btn_update", function(e) {
				$('#btn_update').attr("disabled", true);
				var password = $("#txt_password").val();
				var cpassword = $("#txt_cpassword").val();
				var token = $("#txt_token").val();

				if (password == "") {
					alert("Ingrese una contraseña! ");
				} else if (password.length < 6) {
					alert("Ingrese una contraseña con al menos 6 caracteres! ");
				} else if (cpassword == "") {
					alert("Confirmar Contraseña !");
				} else if (password != cpassword) {
					alert("Las contraseñas no coinciden ! ");
				} else {
					$.ajax({
						url: "update_password.php",
						method: "post",
						data: {
							upassword: password,
							ucpassword: cpassword,
							utoken: token
						},
						success: function(response) {
							$("#msg").html(response);
							var n = 5;
							var l = document.getElementById("number");
							window.setInterval(function() {
								l.innerHTML = n;
								n--;
								if (n == 0) {
									window.location.replace('https://tecmagdp.com');
								}
							}, 500);
						}
					});
				}
			});
		});
	</script>
</body>

</html>