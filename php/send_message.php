<?php
	header("Content-Type: text/html; charset=utf-8");
	include "connect_db.php";
	include "functions.php";

	if(!empty($_POST['email']) and !empty($_POST['name']) and !empty($_POST['id_user']) and !empty($_POST['id_product']) and !empty($_POST['message']) and !empty($_POST['section']))
	{
		$email = $_POST['email'];
		$name = $_POST['name'];
		$id_user = $_POST['id_user'];
		$id_product = $_POST['id_product'];
		$message = $_POST['message'];
		$section = $_POST['section'];

		function clean($value = "") 
		{
	    	$value = trim($value);
	    	$value = stripslashes($value);
	   		$value = strip_tags($value);
	    	$value = htmlspecialchars($value);    
	   		return $value;
		};

		$name = clean($name);
		$email = clean($email);
		$message = clean($message);

		sendMessage($email, $name, $id_user, $id_product, $message, $section);

	} else {
		echo 'Данные не приняты';
	}; 

?>