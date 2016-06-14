<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameBrand']) and !empty($_POST['genderBrand']))
	{
    	include "functions.php";
        $nameBrand = $_POST['nameBrand'];
        $genderBrand = $_POST['genderBrand'];

        function clean($value = "") 
        {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);    
            return $value;
        };

        $nameBrand = clean($nameBrand);
        $genderBrand = clean($genderBrand);

    	addNewBrand($nameBrand, $genderBrand);
	};
?>

<script>
	document.location.href = "../index.php?panel=4";
</script>