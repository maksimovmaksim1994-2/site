<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	$_SESSION['email'];
	include "functions.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Aleksa</title>
		<!-- zurb foundation  -->
		<link rel="stylesheet" href="../zurb_foundation/css/foundation.css" type="text/css"/>
		<link rel="stylesheet" href="../zurb_foundation/css/app.css" type="text/css"/>

		<!-- jQuery -->
		<script src="../js/jquery-1.12.3.js" type="text/javascript"></script>

		<!-- head style -->
		<link rel="stylesheet" href="style/header.css" type="text/css"/>

		<script src="js/functions.js" type="text/javascript"></script>
	</head>
	<body>


		<script src="js/header.js" type="text/javascript"></script>
