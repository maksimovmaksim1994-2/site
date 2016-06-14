<?php
	header("Content-Type: text/html; charset=utf-8");


	if(!empty($_POST['id_message']) and !empty($_POST['status']))
	{
    	include "functions.php";
        $id_message = $_POST['id_message'];
        $status = $_POST['status'];
    	add_Comment_Status($id_message, $status);
	} else {
		echo "Данные не приняты";
	};
?>
