<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameClass']) and !empty($_POST['itemMenuClass']) and !empty($_POST['genderClass']))
	{
	include "functions.php";
    $nameClass = $_POST['nameClass'];
    $itemMenuClass = $_POST['itemMenuClass'];
    $genderClass = $_POST['genderClass'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $nameClass = clean($nameClass);

    checkGropu();

	};

?>