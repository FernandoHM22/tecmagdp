<?php

$db_host="mx60.hostgator.mx"; 
$db_user="tecmagdp_admin";	
$db_password="15A8V19dgQe$";	
$db_name="tecmagdp_gdp";	

try
{
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>
