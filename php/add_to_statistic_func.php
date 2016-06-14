<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";

	if(!empty($_POST['name']) and isset($_POST['price']) and isset($_POST['discount']) and !empty($_POST['gender']) and !empty($_POST['brand']) and !empty($_POST['color']) and isset($_POST['count']) and !empty($_POST['size']) and !empty($_POST['date']))
	{

		$name = $_POST['name'];
		$price = $_POST['price'];
		$discount = $_POST['discount'];
		$gender = $_POST['gender'];
		$brand = $_POST['brand'];
		$color = $_POST['color'];
		$sum = $_POST['count'];
		$size = $_POST['size'];
		$date = $_POST['date'];

		include 'connect_db.php';

		$str_sql_query = "INSERT INTO sales_statistic (name, price, discount, gender, brand, color, size, sum, date) VALUES ('$name', '$price', '$discount', '$gender', '$brand', '$color', '$size', '$sum', '$date')";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };






	} else {
		echo 'Данные не приняты';
	}; 

?>

<script> document.location.href = '../add_to_statistic.php' </script>
