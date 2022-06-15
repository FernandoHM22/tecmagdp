<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GDP - Restablecer Contraseña</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Restablecer Contraseña</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>¿Olvidaste tu Contraseña?</h4>
            <p>Ingresa tu correo electrónico y recibirás un correo con las instrucciones.</p>
          </div>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputCorreo" class="form-control" placeholder="Ingresa Correo Electrónic" required autofocus="autofocus" name="email">
                <label for="inputCorreo">Ingresa Correo Electrónico</label>
              </div>
            </div>
            <a class="btn btn-primary btn-block" href="#">Restablecer contraseña</a>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="../vista/register-vista.php">Registrarse</a>
            <a class="d-block small" href="../vista/login-vista.php">Iniciar Sesión</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
