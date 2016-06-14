<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameSize']))
	{
	include "functions.php";
    $nameSize = $_POST['nameSize'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $nameSize = clean($nameSize);

	addNewSize($nameSize);
	};
?>

<script>
	document.location.href = "../index.php?panel=4";
</script>