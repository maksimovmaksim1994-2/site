<?php
	header("Content-Type: text/html; charset=utf-8");
	include "connect_db.php";
	include "functions.php";

	if(!empty($_POST['email']) and !empty($_POST['password1']) and !empty($_POST['username']) and !empty($_POST['telephone']))
	{
		$email = $_POST['email'];
		$password = $_POST['password1'];
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];

		function clean($value = "") 
		{
	    	$value = trim($value);
	    	$value = stripslashes($value);
	   		$value = strip_tags($value);
	    	$value = htmlspecialchars($value);    
	   		return $value;
		};

		$username = clean($username);
		$email = clean($email);
		$telephone = clean($telephone);
		$password = clean($password);

		Registration();

	} else {
		echo 'Данные не приняты';
	}; 

?>

<script>
	window.location.href = "../index.php"; 
</script>

