<?php

ob_start(); //Turns on output buffering 
if(!isset($_SESSION)) { 
	session_start(); 
} 

$timezone = date_default_timezone_set("Asia/Kuala_Lumpur");

function connection(){
	return mysqli_connect("localhost", "root", "123", "ghg"); 
}

$con = connection();//Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
?> 