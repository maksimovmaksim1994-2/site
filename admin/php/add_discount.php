<?php
	header("Content-Type: text/html; charset=utf-8");


	if(!empty($_POST['id']) and isset($_POST['discount']))
	{
    	include "functions.php";
        $id = $_POST['id'];
        $discount = $_POST['discount'];
    	addDiscount($id, $discount);
	};
?>
