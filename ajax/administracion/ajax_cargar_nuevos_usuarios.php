<?php
include("../../conexion/conexion.php");
$arrayIngresos = $_POST['rows'];
$totalRows = count($arrayIngresos);

$sql_nuevos_usuarios = "INSERT INTO registrogdp (no_reloj, nombres, apellidos, correo, region, no_reloj_supervisor) VALUES ";
$sql_ficha = "INSERT INTO t_fichatalento (reloj_colaborador,edad, antiguedadEmpresa ) VALUES";

foreach ($arrayIngresos as $key) {
    $row_values_reg = [];
    $row_values_ficha = [];
    $i = 0;
    foreach ($key as $skey => $s_value) {
        $i++;
        if ($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8) {
            if ($i == 1 || $i == 2 || $i == 3 || $i == 6 || $i == 7 || $i == 8) {
                $row_values_reg[] = '"' . $s_value . '"';
            }
            if ($i == 1 || $i == 4 || $i == 5) {
                $row_values_ficha[] = '"' . $s_value . '"';
            }
        }
    }
    $values_reg[] = '(' . implode(',', $row_values_reg) . ')';
    $values_ficha[] = '(' . implode(',', $row_values_ficha) . ')';
}
$sql_nuevos_usuarios .= implode(',', $values_reg);
$sql_ficha .= implode(',', $values_ficha);

if (mysqli_query($conn, $sql_nuevos_usuarios) == TRUE) {
    if (mysqli_query($conn, $sql_ficha) == TRUE) {

        foreach ($arrayIngresos as $key => $value) {
            $totalRows--;
            foreach ($value as $key_row => $value_row) {
                if ($key_row == 0) {
                    $no_reloj = $value_row;
                }
                if ($key_row == 1) {
                    $nombres = $value_row;
                }
                if ($key_row == 2) {
                    $apellidos = $value_row;
                }
                if ($key_row == 5) {
                    $correo = $value_row;
                }
            }

            $no_reloj_encode = base64_encode($no_reloj);
            $password1 = substr($nombres, 0, 1);
            $password2 = strtolower(strtok($apellidos, " "));
            $password = $password1 . $password2 . rand(1, 99);
            $password_encode = base64_encode($password);
            $pass = hash('sha512', $password);

            $sql_reg_login = "INSERT INTO login_gdp (no_reloj, pass, repass, isAdmin, perfil) VALUES('$no_reloj', '$pass', '$password', '0' , '0')";

            if (mysqli_query($conn, $sql_reg_login) === TRUE) {

                $body_email = "			
    <html lang='es-MX'>
        <head>
            <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
            <style type='text/css'>
                #btnIniciarSesion {
                    background:#20e277;
                text-decoration:none !important; 
                font-weight:500; 
                margin-top:35px; 
                color:#fff;
                text-transform:uppercase; 
                font-size:14px;
                padding:10px 24px;
                display:inline-block;
                border-radius:50px;
                }
                a:hover {text-decoration: underline !important;}

            </style>
        </head>
        <body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f2f3f8;' leftmargin='0'>
            <table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'
                style='@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;'>
                <tr>
                    <td>
                        <table style='background-color: #f2f3f8; max-width:670px;  margin:0 auto;' width='100%' border='0'
                            align='center' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='height:80px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='text-align:center;'>
                                <a href='https://tecmagdp.com' title='logo' target='_blank'>
                                    <img width='200' src='https://tecmagdp.com/img/logo.png' title='logo' alt='logo'>
                                </a>
                                </td>
                            </tr>
                            <tr>
                                <td style='height:20px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'
                                        style='max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
                                        <tr>
                                            <td style='height:40px;'>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:0 35px;'>
                                                <h1 style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Hola $nombres" . ' ' . "$apellidos, nueva cuenta creada.</h1>
                                                <span style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
                                                <p style='color:#455056; font-size:15px;line-height:24px; margin:0;'>
                                                Se ha creado una nueva cuenta en la plataforma. <br>
                                                <strong>Tus datos para ingresar:</strong> <br>
                                                Usuario: $no_reloj <br>
                                                Contraseña: $password <br>
                                                <br>
                                                </p>
                                                <a href='https://tecmagdp.com/?no_reloj=$no_reloj_encode&password=$password_encode' id='btnIniciarSesion'>Iniciar Sesión</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='height:40px;'>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style='height:20px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='text-align:center;'>
                                    <p style='font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>&copy; <strong>www.tecmagdp.com</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style='height:80px;'>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
    </html>";

                require_once('../../vendor/smtp/PHPMailerAutoload.php');
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = "smtp.office365.com";
                $mail->Port = 587;
                $mail->SMTPSecure = "tls";
                $mail->SMTPAuth = true;
                $mail->Username = "fernando.herrera@tecma.com"; //Enter your gmail id
                $mail->Password = "3#aMceT$42"; //Enter your gmail password
                $mail->SetFrom("fernando.herrera@tecma.com"); //Enter your gmail id
                $mail->addAddress($correo);
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "TECMA GDP | Nueva cuenta";
                $mail->Body = ($body_email);
                $mail->SMTPOptions = array('ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
                ));
                $mail->send();
            }
        }
        if ($totalRows == 0) {
            echo 1;
        }
    }
}else{
    echo 0;
}

mysqli_close($conn);
