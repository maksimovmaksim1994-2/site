<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameItem']))
	{
	include "functions.php";
    $nameItem = $_POST['nameItem'];

	checkItemToRemove();
	};
?>