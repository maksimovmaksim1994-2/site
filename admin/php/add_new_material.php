<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameMaterial']))
	{
	include "functions.php";
    $nameMaterial = $_POST['nameMaterial'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $nameMaterial = clean($nameMaterial);

	addNewMaterial($nameMaterial);
	};
?>

<script>
	document.location.href = "../index.php?panel=4";
</script>