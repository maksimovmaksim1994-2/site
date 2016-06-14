<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	include "connect_db.php";
	include "functions.php";

	if(!empty($_POST['email']) and !empty($_POST['telephone']) and !empty($_POST['username']))
	{
		$oldEmail = $_POST['oldEmail'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$telephone = $_POST['telephone'];

		if(!empty($_POST['surname'])) {
			$surname = $_POST['surname'];
		} else {
			$surname = "";
		};

		if(!empty($_POST['middlename'])) {
			$middlename = $_POST['middlename'];
		} else {
			$middlename = "";
		};

		if(!empty($_POST['gender'])) {
			$gender = $_POST['gender'];
		} else {
			$gender = "";
		};

		if(!empty($_POST['date'])) {
			$date = $_POST['date'];
		} else {
			$date = "";
		};

		function clean($value = "") 
		{
	    	$value = trim($value);
	    	$value = stripslashes($value);
	   		$value = strip_tags($value);
	    	$value = htmlspecialchars($value);    
	   		return $value;
		};

		$username = clean($username);
		$surname = clean($surname);
		$middlename = clean($middlename);
		$email = clean($email);
		$telephone = clean($telephone);
		$gender = clean($gender);
		$date = clean($date);

		saveMyInfo();

		$_SESSION['email'] = $email;

	} else {
		echo 'Данные не приняты';
	}; 

	?>

<script>
	window.location.href = "../my_info.php"; 
</script>
