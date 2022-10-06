<?php 
$dbhost = "localhost";
$dbname = "sujonsof_nubbl";
$dbuser = "root";
$dbpassword = "";
date_default_timezone_set("Asia/Dhaka");
try{
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpassword);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}
catch(PDOException $e){
	echo "Connection Error ".$e->getMessage();
}
