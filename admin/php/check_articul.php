<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['id']))
	{
    	include "functions.php";
        $id = $_POST['id'];

    	checkArticul($id);
	};
?>
