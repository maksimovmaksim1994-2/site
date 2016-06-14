<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameClass']) and !empty($_POST['desciptionClass']) and !empty($_POST['itemMenuClass']) and !empty($_POST['genderClass']))
	{
	include "functions.php";
    $nameClass = $_POST['nameClass'];
    $desciptionClass = $_POST['desciptionClass'];
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
    $desciptionClass = clean($desciptionClass);

	addNewGroup();
	};
?>

<script>
	document.location.href = "../index.php?panel=3";
</script>