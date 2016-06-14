<?php
	header("Content-Type: text/html; charset=utf-8");


	if(!empty($_POST['id_message']) and !empty($_POST['answer']))
	{
    	include "functions.php";
        $id_message = $_POST['id_message'];
        $answer = $_POST['answer'];
    	add_Answer($id_message, $answer);
	} else {
		echo "Данные не приняты";
	};
?>
