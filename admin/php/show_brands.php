<?php
	header("Content-Type: text/html; charset=utf-8");
	if(!empty($_POST['gender'])) {
		
		$gender = $_POST['gender'];
		include "functions.php";

		showBrandsForAddProduct();
	} else {
		echo "Данные не приняты";
	};
?>