<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	session_start();
	if(empty($_SESSION['email'])) {
		echo 'nologin';
		exit();
	} else $email = $_SESSION['email'];

	get_my_basket($email, 'json');

?>