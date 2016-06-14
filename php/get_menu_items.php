<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	if(!empty($_POST['item']) and !empty($_POST['gender']))
	{
		$item = $_POST['item'];
		$gender = $_POST['gender'];
		
		if($item == 'Бренды') showMenuItemsBrand();
		else showMenuItems();
	} else {
	echo 'Данные не приняты';
	}; 

?>