<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameItem']) and !empty($_POST['desciptionItem']))
	{
	include "functions.php";
    $nameItem = $_POST['nameItem'];
    $desciptionItem = $_POST['desciptionItem'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $nameItem = clean($nameItem);
    $desciptionItem = clean($desciptionItem);

	addNewMenuItem();
	};
?>

<script>
	document.location.href = "../index.php?panel=3";
</script>