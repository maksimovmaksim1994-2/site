<?php
	header("Content-Type: text/html; charset=utf-8");
	include "connect_db.php";
	include "functions.php";

	if(!empty($_POST['id']))
	{
		session_start();
		if(empty($_SESSION['email'])) {
			echo 'nologin';
			exit();
		} else $email = $_SESSION['email'];

		$id = $_POST['id'];
		set_like($id, $email);

	} else {
		echo 'Данные не приняты';
	}; 

?>
