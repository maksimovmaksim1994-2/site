<?php
	header("Content-Type: text/html; charset=utf-8");
	if(!empty($_POST['item']) and !empty($_POST['gender'])) {
		$item = $_POST['item'];
		$gender = $_POST['gender'];
	include "functions.php";

	showGroups();
	} else {
		echo "Данные не приняты";
	};
?>