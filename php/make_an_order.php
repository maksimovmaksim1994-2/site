<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	if(!empty($_POST['id_user']) and !empty($_POST['email']))
	{
		session_start();

		if($_SESSION['email'] != $_POST['email']) {
			echo 'abort';
			exit();
		};
		
		$id_user = $_POST['id_user'];
		if(isset($_POST['comment'])) $comment = $_POST['comment'];
		else $comment = "";
		
		make_an_order($id_user, $comment);

	} else {
		echo 'Данные не приняты';
	}; 

?>

