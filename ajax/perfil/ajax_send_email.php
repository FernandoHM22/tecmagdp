<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "dbconfig.php";

// Get user enter email via $.ajax() method
if (isset($_POST['uemail'])) {
	$email = strip_tags($_POST["uemail"]);

	// Select email from the user table 
	$select_stmt = $db->prepare("SELECT * FROM registrogdp WHERE correo=:user_email");
	$select_stmt->execute(array(":user_email" => $email));
	$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

	if ($select_stmt->rowCount() > 0) {
		// If email present in the table, then sends email to user mailbox / junk box
		if ($email == $row["correo"]) {
			$dbusername = $row["nombres"];
			$dbtoken = $row["token"];

			// They can click on this link to reset the password with the token. 
			$reset_link = "			
			<html lang='es-MX'>
			<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>Reset Password Email Template</title>
    <meta name='description' content='Reset Password Email Template.'>
    <style type='text/css'>
		#btnReiniciar {
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
    <!--100% body table-->
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
                                        <h1 style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Hola $dbusername, ha solicitado restablecer su contraseña</h1>
                                        <span
                                            style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
                                        <p style='color:#455056; font-size:15px;line-height:24px; margin:0;'>
										No podemos simplemente enviarle su contraseña anterior. Se ha generado un enlace único para restablecer su contraseña. Para restablecer su contraseña, haga clic en el siguiente enlace y siga las instrucciones.
                                        </p>
                                        <a href='https://tecmagdp.com/ajax/perfil/reset_password.php?token=$dbtoken' id='btnReiniciar'>Reiniciar Contraseña</a>
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
    <!--/100% body table-->
</body>

</html>";



			// Send email code
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
			$mail->addAddress($email);
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = "Reestablecer Contraseña";
			$mail->Body = ($reset_link);
			$mail->SMTPOptions = array('ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => false
			));
			if ($mail->send()) {
				echo "<div class='alert alert-success' role='alert'>Correo enviado, por favor revise su bandeja de entrada con las indicaciones.</div>";
			} else {
				echo "Mailer Error: " . $mail->ErrorInfo;
			}
		} else {
			echo "<div class='alert alert-danger' role='alert'>Correo no registrado, intente nuevamente</div>";
		}
	} else {
		echo "<div class='alert alert-danger' role='alert'>Correo no registrado, intente nuevamente</div>";
	}
}
