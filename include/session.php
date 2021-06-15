<?php

session_start();

if(!isset($_SESSION['userData']))
{
	header("location: index.php");
} 

	

?>