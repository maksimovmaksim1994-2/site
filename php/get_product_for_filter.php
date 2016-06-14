<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	if(!empty($_POST['numbers']))
	{
		$numbers = $_POST['numbers'];
		$numbers = json_decode($numbers);
		$liked = get_liked();
		if($liked == "nologin") $liked = "";
		
		for($i = 0; $i < count($numbers); $i++) {
			$product = getProductForFilter($numbers[$i], $liked);
			$allProduct[] = $product;
		};

		echo json_encode($allProduct);
	} else {
	echo 'Данные не приняты';
	}; 

?>