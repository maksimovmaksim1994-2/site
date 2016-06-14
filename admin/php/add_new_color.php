<?php
	header("Content-Type: text/html; charset=utf-8");

	if(!empty($_POST['nameColor']) and !empty($_POST['codeColor']))
	{
    	include "functions.php";
        $nameColor = $_POST['nameColor'];
        $codeColor = $_POST['codeColor'];
        
        function clean($value = "") 
        {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);    
            return $value;
        };

        $nameColor = clean($nameColor);

    	addNewColor($nameColor, $codeColor);
	};
?>

<script>
	document.location.href = "../index.php?panel=4";
</script>