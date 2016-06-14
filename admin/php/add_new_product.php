<?php
	header("Content-Type: text/html; charset=utf-8");
    if(!empty($_POST['name']) and !empty($_POST['shot_description']) and !empty($_POST['description']) and !empty($_POST['price']) and !empty($_POST['item']) and !empty($_POST['gender']) and !empty($_POST['group']) and !empty($_POST['brand']) and !empty($_FILES['photoMain']))
    {
        include "functions.php";

        $name = $_POST['name'];
        $shot_description = $_POST['shot_description'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $item = $_POST['item'];
        $gender = $_POST['gender'];
        $group = $_POST['group'];
        $brand = $_POST['brand'];
        $photoMain = $_FILES['photoMain'];
        $photo = $_FILES['photo'];


        //добавляем данные в основную таблицу продукта
        $id_product;
        addNewProduct($name, $shot_description, $description, $price);

        //добавляем главное фото в папку
        if(!is_uploaded_file($photoMain['tmp_name'])) {
             echo 'Файл не загружен';
             exit();
        } else {
            function fileFilterAndAdd($file, $id_product)
            {
                @mkdir("../../image/".$id_product, 0777);
                if($file["size"] > 1024*5*1024) {
                    echo ("Размер файла превышает пять мегабайт");
                    exit;
                };
                move_uploaded_file($file["tmp_name"],"../../image/".$id_product."/".$file["name"]);
            };
            fileFilterAndAdd($photoMain, $id_product);
        };


        //добавляем остальные фото в папку
        function fileFilterAndAddMultiple($file, $id_product, $i)
        {
            GLOBAL $arrNamePhoto;
            if($file["size"][$i] > 1024*5*1024) {
                echo ("Размер файла превышает пять мегабайт");
                exit;
            };
            $filename = $file["name"][$i];
            //проверяем наличие такого же имени в папке и меняем его если нужно
            $dir = scandir("../../image/".$id_product);
            for($j = 0; $j < count($dir); $j++) {
                if($filename == $dir[$j]) {
                    for($h = strlen($filename) - 1; $h > 0; $h--) {
                        if($filename[$h] == ".") break;
                        $info = $filename[$h].$info;
                    };

                    for($h = 0; $h < strlen($filename); $h++) {
                        if($filename[$h] == ".") break;
                        $name = $name.$filename[$h];
                    };
                    $random = rand();
                    $name .= $random;
                    $filename = $name.".".$info;
                };
            };
            $arrNamePhoto[] = $filename;
            move_uploaded_file($file["tmp_name"][$i],"../../image/".$id_product."/".$filename);
        };
        $arrNamePhoto;
        for($i = 0; $i < count($photo['name']); $i++) {
            if(!is_uploaded_file($photo['tmp_name'][$i])) {
            } else {
                fileFilterAndAddMultiple($photo, $id_product, $i);
            };
        };

        //имя главной фото
        $mainNamePhoto = $photoMain['name'];
        //массим с именами всех фото кроме главной
        $arrNamePhoto;

        for($i = 0; $i < count($arrNamePhoto); $i++) {
            $photo = $arrNamePhoto[$i];
            $status = '';
            addPhotoToNewProduct($photo, $status, $id_product);
        };

            $status = 'main';
            addPhotoToNewProduct($mainNamePhoto, $status, $id_product);


        function clean($value = "") 
        {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);    
            return $value;
        };

        $name = clean($name);
        $shot_description = clean($shot_description);
        $description = clean($description);
        $price = clean($price);

        addBrandToNewProduct($brand, $gender, $id_product);

        addNewProductToItemGroup($id_product, $item, $group, $gender);

        if(!empty($_POST['materialAll'])) {
            $materialAll = $_POST['materialAll'];
            $materialArr = json_decode($materialAll);
            for($i = 0; $i < count($materialArr); $i++) {
                $material = $materialArr[$i];
                if($material) {
                    addMaterialToNewProduct($material, $id_product);
                };
            };
        };

        if(!empty($_POST['colorAll'])) {
            $colorAll = $_POST['colorAll'];
            $colorArr = json_decode($colorAll);
            for($i = 0; $i < count($colorArr); $i++) {
                $color = $colorArr[$i];
                addColorToNewProduct($color, $id_product);
            };
        };

        if(!empty($_POST['sizeAll'])) {
            $sizeAll = $_POST['sizeAll'];
            $sizeArr = json_decode($sizeAll);
            for($i = 0; $i < count($sizeArr); $i++) {
                foreach($sizeArr[$i] as $key => $value) {
                    if($key == 'size') $size = $value;
                    if($key == 'sum') $sum = $value;
                };
                $size;
                $sum;
                addSizeToNewProduct($size, $sum, $id_product);
            };
        };

        if(!empty($_POST['parametrAll'])) {
            $parametrAll = $_POST['parametrAll'];
            $parametrArr = json_decode($parametrAll);
            for($i = 0; $i < count($parametrArr); $i++) {
                foreach($parametrArr[$i] as $key => $value) {
                    if($key == 'parametr') $parametr = $value;
                    if($key == 'value') $value = $value;
                };
                $parametr;
                $value;
                $value = clean($value);
                addParametrToNewProduct($parametr, $value, $id_product);
            };
        };
    };


    
?>

<script>
	document.location.href = "../index.php?panel=1";
</script>