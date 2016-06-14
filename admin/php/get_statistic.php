<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['begin']) and !empty($_POST['end']))
	{
    	include "functions.php";
        $begin = $_POST['begin'];
        $end = $_POST['end'];

    	get_statistic($begin, $end);
	} else {
        exit('Данные не приняты');
    };
?>