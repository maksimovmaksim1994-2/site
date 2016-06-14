<?php
	header("Content-Type: text/html; charset=utf-8");
	include "functions.php";
	if(!empty($_POST['obj']))
	{
		$obj = $_POST['obj'];
		$obj = json_decode($obj);
		
		foreach($obj as $key => $value) {
			if($key == "item") {
				$item = $value;
			};
			if($key == "group") {
				$group = $value;
			};
			if($key == "gender") {
				$gender = $value;
			};
			if($key == "size") {
				$size = $value;
			};
			if($key == "brand") {
				$brand = $value;
			};
			if($key == "material") {
				$material = $value;
			};
			if($key == "color") {
				$color = $value;
			};
			if($key == "maxPrice") {
				$Price['max'] = $value;
			};
			if($key == "minPrice") {
				$Price['min'] = $value;
			};

		};

		$allNumbers = array();
		if(!empty($item) and !empty($group) and !empty($gender)) mainFilter_Item_and_Group($item, $group, $gender);
		if(!empty($item) and empty($group) and !empty($gender)) mainFilter_Item($item, $gender);
		$MainGroupNumbers = $allNumbers;

		if(!empty($size) || !empty($brand) || !empty($material) || !empty($color)) $allNumbers = array();

		if(!empty($brand) and !empty($gender) and count($MainGroupNumbers) > 0) mainFilter_Parametr($brand, "brand", $gender);
		elseif(!empty($brand) and !empty($gender) and count($MainGroupNumbers) == 0) {
			mainFilter_Brand($brand, $gender);
			$MainGroupNumbers = $allNumbers;
			if(!empty($size) || !empty($material) || !empty($color)) $allNumbers = array();
		};
		if(!empty($size) and count($MainGroupNumbers) > 0) ;
		if(!empty($material) and count($MainGroupNumbers) > 0) mainFilter_Parametr($material, "material", "");
		if(!empty($color) and count($MainGroupNumbers) > 0) mainFilter_Parametr($color, "color", "");
		if(count($Price) > 0 and count($MainGroupNumbers) > 0) mainFilter_Price($Price);

		getSortParametr();

		echo json_encode($allNumbers);
	} else {
	echo 'Данные не приняты';
	}; 

?>