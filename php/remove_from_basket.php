<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	if(!empty($_POST['id_product']) and !empty($_POST['size']))
	{
		session_start();
		if(empty($_SESSION['email'])) {
			echo 'nologin';
			exit();
		} else $email = $_SESSION['email'];

		$id_product = $_POST['id_product'];
		$size = $_POST['size'];
		remove_from_basket($id_product, $size, $email);

	} else {
		echo 'Данные не приняты';
	}; 

?>
