<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameParametr']))
	{
	include "functions.php";
    $nameParametr = $_POST['nameParametr'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $nameParametr = clean($nameParametr);

	addNewParametr($nameParametr);
	};
?>

<script>
	document.location.href = "../index.php?panel=4";
</script>