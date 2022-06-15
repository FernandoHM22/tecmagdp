<?php
session_start();
if (empty($_SESSION["no_reloj"])) {
    header("location:../error.html");
    exit();
}
include("../conexion/conexion.php");
$admin = $_SESSION['isAdmin'];
$cargoColab = $_SESSION["cargoColab"];
$no_reloj = $_SESSION["no_reloj"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GDP<?php echo ' | ' . $titulo; ?></title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top"><a class="navbar-brand mr-1" href="<?php if($cargoColab == 1){echo 'myinfoSup.php';}else{echo 'myinfo.php';}?>">GDP</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#"> <i class="fas fa-bars"></i> </button>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> </form>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-user-circle fa-lg" style="font-size: 1.5rem;"></i> </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a> </div>
            </li>
        </ul>
    </nav>
    <div id="wrapper">
        <ul class="sidebar navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="<?php if($cargoColab == 1){echo 'myinfoSup.php';}else{echo 'myinfo.php';}?>"> <i class="fas fa-chalkboard-teacher"></i> <span>Mi Perfil</span> </a>
            </li>
            <?php
                if($cargoColab == 1){
            ?>
                <li class="nav-item  <?php if($titulo == 'Colaboradores'){echo 'active';}?>">
                    <a class="nav-link" href="colaboradoresSup.php"> <i class="fas fa-users"></i> <span>Mis Colaboradores</span></a>
                </li>
            <?php
                }
            ?>
            <li class="nav-item <?php if($titulo == 'Objetivos'){echo 'active';}?>">
                <a class="nav-link" href="<?php if($cargoColab == 1){echo 'objetivosSup.php';}else{echo 'objetivos.php';}?>"> <i class="fas fa-fw fa-bullseye"></i> <span>Mis Objetivos</span></a>
            </li>
            <li class="nav-item <?php if($titulo == 'Planeacion'){echo 'active';}?>">
                <a class="nav-link " href="<?php if($cargoColab == 1){echo 'planeacionSup.php';}else{echo 'planeacion.php';}?>"> <i class="fas fa-fw fa-chart-area"></i> <span>Plan de Desarrollo</span></a>
            </li>
            <li class="nav-item <?php if($titulo == 'Biblioteca'){echo 'active';}?>">
                <a class="nav-link" href="biblioteca.php"><i class="fas fa-book"></i></i> <span>Biblioteca</span></a>
            </li>
            <hr>
            <?php
            if ($admin == 1) {
            ?>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="../control/administracion.php"> <i class="fas fa-toolbox"></i> <span> Administración</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../control/seguimientoReddin.php"><i class="fas fa-fw fa-bullseye"></i> <span>Seguimiento Reddin</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
                    <div class="dropdown-menu" style="margin-right: 0px;">
                        <a class="dropdown-item" href="../control/reportes/reporteUsuario.php"><i class="fas fa-users-cog"></i> <span>Reporte Usuarios</span></a>
                        <a class="dropdown-item" href="../control/reportes/reporteFichaTalento.php"><i class="fas fa-file-invoice"></i> <span>Reporte Ficha Talento</span></a>
                        <a class="dropdown-item" href="../control/reportes/reporteAutoevaluacion.php"><i class="fas fa-file-alt"></i> <span>Reporte Evaluaciones</span></a>
                        <a class="dropdown-item" href="../control/reportes/reportePlanes.php"><i class="fa fa-file"></i> <span>Reporte Planes</span></a>
                        <a class="dropdown-item" href="../control/reportes/reporteObjetivos.php"><i class="far fa-file-alt"></i> <span>Reporte Objetivos</span></a>
                        <a class="dropdown-item" href="../control/reportes/reclutamiento.php"><i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
                    </div>
                </li>
            <?php
            }
            if ($admin == 2 || $admin == 4) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../control/reportPlan"><i class="fas fa-users"></i> <span>Ver Talento</span></a>
                </li>
            <?php }
            if ($admin == 3) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../control/reclutamiento.php"> <i class="fas fa-user-tie"></i> <span>Potencial Promovible</span></a>
                </li>
            <?php } ?>
        </ul>