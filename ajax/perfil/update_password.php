<?php
session_start();
require_once "dbconfig.php";

// Get user enter a new password, confirm password and a token value via $.ajax() method
if(isset($_POST["upassword"]) && isset($_POST["ucpassword"]) && isset($_POST["utoken"]))	
{
	$password 	= strip_tags($_POST["upassword"]);	
	$cpassword 	= strip_tags($_POST["ucpassword"]);
	$token 		= strip_tags($_POST["utoken"]);

			
	// New password and confirm password value encrypting using password_hash() function
	//$new_password	= password_hash($password, PASSWORD_DEFAULT);
	//$new_cpassword	= password_hash($cpassword, PASSWORD_DEFAULT);
	$new_password = hash('sha512', $password);  
	// Apply SQL update query and updating new password 
	$update_stmt=$db->prepare("UPDATE login_gdp SET pass=:pwd, repass=:cpwd WHERE token=:token"); 
			
	// If query properly executed, then password updated successfully in the table  
	if($update_stmt->execute(array(	":pwd"	=>$new_password, 
									":cpwd"	=>$cpassword, 
									":token"=>$token))){
													
		// Using session method send password updated successfully message to reset_password.php page  
		echo "<div class='alert alert-success' role='alert'><strong>Contraseña actualizada Correctamene, ya puede iniciar sesión Seras rediridio en ...<span id='number'></span></strong></div>";
		
	}else{
		echo "<div class='alert alert-danger' role='alert'><strong>Error al cambiar su contraseña</strong></div>";
	}			
}
?>