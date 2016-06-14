<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['item']) and !empty($_POST['gender']) and !empty($_POST['name']))
	{
	include "functions.php";

    $item = $_POST['item'];
    $gender = $_POST['gender'];
    $name = $_POST['name'];

	removeGroup();
	};
?>
