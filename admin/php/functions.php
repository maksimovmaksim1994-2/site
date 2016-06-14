<?php
	function addItemsMenu() {
		include '../php/connect_db.php';

        $str_sql_query = "SELECT item FROM menu";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        	echo "<option>Выберите пункт</option>";
        while($mas = mysql_fetch_row($result)){
            echo "<option>".$mas[0]."</option>";  
        };
	};

    function showGroups() {
        include '../../php/connect_db.php';
        GLOBAL $item;
        GLOBAL $gender;


        $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        $mas = mysql_fetch_row($result);
        $id_item = $mas[0];

        if($gender == "Мужской") $table = "id_menu_to_group_men";
        if($gender == "Женский") $table = "id_menu_to_group_women";

        $str_sql_query = "SELECT id_group FROM $table WHERE id_menu = '$id_item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        echo "<option>Выберите группу</option>";
        while($mas = mysql_fetch_row($result)) {
            $id_group = $mas[0];

            if($gender == "Мужской") $table = "menu_group_men";
            if($gender == "Женский") $table = "menu_group_women";

            $str_sql_query = "SELECT item FROM $table WHERE id = '$id_group'";
            if (!$result2 = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas2 = mysql_fetch_row($result2);
            echo "<option>".$mas2[0]."</option>";  
        };
    };

    function removeGroupIfdontNeed($id_group, $gender, $link) {

        if($gender == "Мужской") $table = "id_menu_to_group_men";
        if($gender == "Женский") $table = "id_menu_to_group_women";

        $str_sql_query = "SELECT * FROM $table WHERE id_group = '$id_group'";

        if (!$result1 = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas1 = mysql_fetch_row($result1);
        if(empty($mas1)) {

            if($gender == "Мужской") $table = "menu_group_men";
            if($gender == "Женский") $table = "menu_group_women";

            $str_sql_query = "DELETE FROM $table WHERE id = '$id_group'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "‹br›He могу выполнить запрос‹br›";
              echo mysql_error();
              exit();
            };
        };
    };

    function removeGroup() { 
        include '../../php/connect_db.php';
        GLOBAL $item;
        GLOBAL $gender;
        GLOBAL $name;

        if($gender == "Мужской") $table = "menu_group_men";
        if($gender == "Женский") $table = "menu_group_women";

        $str_sql_query = "SELECT id FROM $table WHERE item = '$name'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_group = $mas[0];

        $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_item = $mas[0];

        if($gender == "Мужской") $table = "id_menu_to_group_men";
        if($gender == "Женский") $table = "id_menu_to_group_women";

        $str_sql_query = "DELETE FROM $table WHERE id_menu = '$id_item' and id_group = '$id_group'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };   

        removeGroupIfdontNeed($id_group, $gender, $link);

        mysql_close($link);
    };


     function checkGroupToRemoveGroup() { 
        include '../../php/connect_db.php';
        GLOBAL $item;
        GLOBAL $gender;
        GLOBAL $name;

        if($gender == "Мужской") $table = "menu_group_men";
        if($gender == "Женский") $table = "menu_group_women";

        //проверка сделать потом перед удалением, на присутствие у товаров этой группы
        echo "absent";
        /*echo "present";*/
        mysql_close($link);
    };




    function addNewMenuItem() { 
        include '../../php/connect_db.php';
        GLOBAL $nameItem;
        GLOBAL $desciptionItem;

        $str_sql_query = "INSERT INTO menu (item, description) VALUES ('$nameItem', '$desciptionItem')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };

        mysql_close($link);
    };


    function removeNewMenuItem() { 
        include '../../php/connect_db.php';
        GLOBAL $nameItem;

        //находим id пункта меню
        $str_sql_query = "SELECT id FROM menu WHERE item = '$nameItem'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $item_id = $mas[0];


        //выбираем группы привязанные к этому меню
        $str_sql_query = "SELECT id_group FROM id_menu_to_group_women WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };
        $groups_id_women = array();
        while($mas = mysql_fetch_row($result)) {
            $groups_id_women[] = $mas[0];
        };


        $str_sql_query = "SELECT id_group FROM id_menu_to_group_men WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };
        $groups_id_men = array();
        while($mas = mysql_fetch_row($result)) {
            $groups_id_men[] = $mas[0];
        };


        
        //удаляем привязанности групп к меню
        $str_sql_query = "DELETE FROM id_menu_to_group_men WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };

        $str_sql_query = "DELETE FROM id_menu_to_group_women WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };

    
    
        //удаляем группы, которые больше нигде не используются
        $gender = "Женский";
        for($i = 0; $i < count($groups_id_women); $i++) {
            $id_group = $groups_id_women[$i];
            removeGroupIfdontNeed($id_group, $gender, $link);
        };

        $gender = "Мужской";
        for($i = 0; $i < count($groups_id_men); $i++) {
            $id_group = $groups_id_men[$i];
            removeGroupIfdontNeed($id_group, $gender, $link);
        };



        //удаляем пункт меню
        $str_sql_query = "DELETE FROM menu WHERE item = '$nameItem'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };

        mysql_close($link);
    };


    function checkItemToRemove() {
        include '../../php/connect_db.php';
        GLOBAL $nameItem;

        $str_sql_query = "SELECT id FROM menu WHERE item = '$nameItem'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $item_id = $mas[0];

        $str_sql_query = "SELECT * FROM id_menu_to_group_men WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);

        if(!empty($mas)) {
            echo 'present';
            return;
        };

        $str_sql_query = "SELECT * FROM id_menu_to_group_women WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);

        if(!empty($mas)) {
            echo 'present';
            return;
        };

        echo "absent";
    };



	function addNewGroup() { 
		include '../../php/connect_db.php';
        GLOBAL $nameClass;
        GLOBAL $desciptionClass;
        GLOBAL $itemMenuClass;
        GLOBAL $genderClass;

        if($genderClass == "Мужской") $table = 'menu_group_men';
        if($genderClass == "Женский") $table = 'menu_group_women';

        $str_sql_query = "SELECT id FROM $table WHERE item = '$nameClass'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        if(!empty($mas)) {
        $group_id = $mas[0];
        } else {
            $str_sql_query = "INSERT INTO $table (item, description) VALUES ('$nameClass', '$desciptionClass')";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "‹br›He могу выполнить запрос‹br›";
              echo mysql_error();
              exit();
            };
            $group_id = mysql_insert_id();
        };

        $str_sql_query = "SELECT id FROM menu WHERE item = '$itemMenuClass'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $item_id = $mas[0]; 

        if($genderClass == "Мужской") $table = 'id_menu_to_group_men';
        if($genderClass == "Женский") $table = 'id_menu_to_group_women';

        $str_sql_query = "INSERT INTO $table (id_menu, id_group) VALUES ('$item_id', '$group_id')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };

        mysql_close($link);
	};


	function checkGropu() {
		include '../../php/connect_db.php';
		GLOBAL $nameClass;
        GLOBAL $itemMenuClass;
        GLOBAL $genderClass;

        if($genderClass == "Мужской") $table = 'menu_group_men';
        if($genderClass == "Женский") $table = 'menu_group_women';

		$str_sql_query = "SELECT id FROM $table WHERE item = '$nameClass'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $group_id = $mas[0];
        if(empty($group_id)) {
        	echo "absent";
        	return false;
        }; 

        $str_sql_query = "SELECT id FROM menu WHERE item = '$itemMenuClass'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $item_id = $mas[0]; 

        if($genderClass == "Мужской") $table = 'id_menu_to_group_men';
        if($genderClass == "Женский") $table = 'id_menu_to_group_women';

        $str_sql_query = "SELECT id_menu FROM $table WHERE id_group = '$group_id'";
      
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };


        while($mas = mysql_fetch_row($result)) {
        	foreach($mas as $value) {
        		if($value == $item_id) {
	        		echo "present";
        			return false;
        		};
        	};
    	};

    	echo "absent";

	};


    function addNewMaterial($nameMaterial) {
        include '../../php/connect_db.php';

        $str_sql_query = "INSERT INTO material (material) VALUES ('$nameMaterial')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };
    };


    function addNewBrand($nameBrand, $genderBrand) {
        include '../../php/connect_db.php';

        if($genderBrand == "Мужской") $table = "brand_men";
        if($genderBrand == "Женский") $table = "brand_women";

        $str_sql_query = "INSERT INTO $table (brand) VALUES ('$nameBrand')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };
    };


    function addNewColor($nameColor, $codeColor) {
        include '../../php/connect_db.php';

        $str_sql_query = "INSERT INTO color (color, code) VALUES ('$nameColor', '$codeColor')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };
    };

    function addNewParametr($nameParametr) {
        include '../../php/connect_db.php';

        $str_sql_query = "INSERT INTO parametr (parametr) VALUES ('$nameParametr')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };
    };

    function addNewSize($nameSize) {
        include '../../php/connect_db.php';

        $str_sql_query = "INSERT INTO size (size) VALUES ('$nameSize')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        };
    };


    function showBrandsForAddProduct() {
        include '../../php/connect_db.php';
        GLOBAL $gender;

        if($gender == "Мужской") $table = "brand_men";
        if($gender == "Женский") $table = "brand_women";

        $str_sql_query = "SELECT brand FROM $table";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        echo "<option>Выберите бренд</option>";
        while($mas = mysql_fetch_row($result)) {
            $brand = $mas[0];
            echo "<option>".$brand."</option>";  
        };
    };

    function showMaterial() {
        include '../php/connect_db.php';

        $str_sql_query = "SELECT material FROM material";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $coint = 1;
        while($mas = mysql_fetch_row($result)) {
            $material = $mas[0];
            echo "<div class='checkbox'> 
                <input type='checkbox' data-value='".$material."' name='material".$coint."'/>
                <div class='check-name'>".$material."</div>
            </div>";
            $coint++;
        };
    };

    function showColor() {
        include '../php/connect_db.php';

        $str_sql_query = "SELECT * FROM color";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $coint = 1;
        while($mas = mysql_fetch_row($result)) {
            $color = $mas[1];
            $code = $mas[2];
            echo "<div class='checkbox'> 
                <input type='checkbox' data-value='".$color."' name='color".$coint."'/>
                <div class='check-name'>".$color."</div>
                <div class='check-color' style='background-color: ".$code.";'></div>
            </div>";
            $coint++;
        };
    };


    function showSize() {
        include '../php/connect_db.php';

        $str_sql_query = "SELECT size FROM size";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        $coint = 1;
        while($mas = mysql_fetch_row($result)) {
            $size = $mas[0];
            echo "<div class='checkbox'> 
                        <input type='checkbox' data-value='".$size."' name='size".$coint."'/>
                        <div class='check-name'>".$size."</div>
                        <input type='hidden' data-sum min='1' value='1'/>
                        <div class='check-sum' hidden>Кол-во</div>
                    </div>";
            $coint++;
        };
    };


    function showPerametr() {
        include '../php/connect_db.php';

        $str_sql_query = "SELECT parametr FROM parametr";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };

        $coint = 1;
        while($mas = mysql_fetch_row($result)) {
            $parametr = $mas[0];
            echo "<div class='checkbox'> 
                        <input type='checkbox' data-value='".$parametr."' name='parametr".$coint."'/>
                        <div class='check-name'>".$parametr."</div>
                        <input type='hidden' data-parametr  class='check-parametr'/>
                    </div>";
            $coint++;
        };
    };



    function addNewProduct($name, $shot_description, $description, $price) {
        include '../../php/connect_db.php';
        GLOBAL $id_product;

        $today = date('c');

        $str_sql_query = "INSERT INTO product (name, shot_description, description, price, date) VALUES ('$name', '$shot_description', '$description', '$price', '$today')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "‹br›He могу выполнить запрос‹br›";
            echo mysql_error();
            exit();
        };
        $id_product = mysql_insert_id();
    };

    function addMaterialToNewProduct($material, $id_product) {
        include '../../php/connect_db.php';
        $str_sql_query = "SELECT id FROM material WHERE material = '$material'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_material = $mas[0];

        $str_sql_query = "INSERT INTO id_product_to_material (id_product, id_material) VALUES ('$id_product', '$id_material')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "‹br›He могу выполнить запрос‹br›";
            echo mysql_error();
            exit();
        };
    };

    function addColorToNewProduct($color, $id_product) {
        include '../../php/connect_db.php';

        $str_sql_query = "SELECT id FROM color WHERE color = '$color'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_color = $mas[0];

        $str_sql_query = "INSERT INTO id_product_to_color (id_product, id_color) VALUES ('$id_product', '$id_color')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "‹br›He могу выполнить запрос‹br›";
            echo mysql_error();
            exit();
        };
    };


    function addSizeToNewProduct($size, $sum, $id_product) {
        include '../../php/connect_db.php';

        $str_sql_query = "SELECT id FROM size WHERE size = '$size'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_size = $mas[0];

        $str_sql_query = "INSERT INTO id_product_to_size (id_product, id_size, sum) VALUES ('$id_product', '$id_size', '$sum')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "‹br›He могу выполнить запрос‹br›";
            echo mysql_error();
            exit();
        };
    };


    function addParametrToNewProduct($parametr, $value, $id_product) {
        include '../../php/connect_db.php';

        $str_sql_query = "SELECT id FROM parametr WHERE parametr = '$parametr'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_parametr = $mas[0];

        $str_sql_query = "INSERT INTO id_product_to_parametr (id_product, id_parametr, value) VALUES ('$id_product', '$id_parametr', '$value')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "‹br›He могу выполнить запрос‹br›";
            echo mysql_error();
            exit();
        };
    };


        function addPhotoToNewProduct($photo, $status, $id_product) {
            include '../../php/connect_db.php';

            $str_sql_query = "INSERT INTO image (src) VALUES ('$photo')";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $id_photo = mysql_insert_id();

            $str_sql_query = "INSERT INTO id_product_to_image (id_product, id_image, status) VALUES ('$id_product', '$id_photo', '$status')";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
        };


        function addBrandToNewProduct($brand, $gender, $id_product) {
            include '../../php/connect_db.php';

            if($gender == "Мужской") $table = 'brand_men';
            if($gender == "Женский") $table = 'brand_women';

            $str_sql_query = "SELECT id FROM $table WHERE brand = '$brand'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_brand = $mas[0];
            if($gender == "Мужской") $table = 'id_product_to_brand_men';
            if($gender == "Женский") $table = 'id_product_to_brand_women';

            $str_sql_query = "INSERT INTO $table (id_product, id_brand) VALUES ('$id_product', '$id_brand')";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
        };


        function addNewProductToItemGroup($id_product, $item, $group, $gender) {
            include '../../php/connect_db.php';

            $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_item = $mas[0];

            if($gender == "Мужской") $table = 'menu_group_men';
            if($gender == "Женский") $table = 'menu_group_women';
            $str_sql_query = "SELECT id FROM $table WHERE item = '$group'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_group = $mas[0];
        
            if($gender == "Мужской") $table = 'id_product_to_item_group_men';
            if($gender == "Женский") $table = 'id_product_to_item_group_women';   

            $str_sql_query = "INSERT INTO $table (id_product, id_item, id_group) VALUES ('$id_product', '$id_item', '$id_group')";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
        };



        function checkArticul($id) {
            include '../../php/connect_db.php';

            $str_sql_query = "SELECT id FROM product WHERE id = '$id'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id = $mas[0];
            if(!empty($id)) echo "present";
            else echo "absent";
        };



        function addDiscount($id, $discount) {
            include '../../php/connect_db.php';

            $str_sql_query = "UPDATE product SET discount = $discount WHERE id = '$id'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            } else echo "added"; 
        };


        function getQuestion($status) {
            include '../../php/connect_db.php';

            $str_sql_query = "SELECT id_message, id_product, message, name, date, status, answer  FROM question";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $i = 0;
            while($mas = mysql_fetch_row($result)) {
                $question[$i]['id_message'] = $mas[0];
                $question[$i]['id_product'] = $mas[1];
                $question[$i]['message'] = $mas[2];
                $question[$i]['name'] = $mas[3];
                $question[$i]['date'] = $mas[4];
                $question[$i]['status'] = $mas[5];
                $question[$i]['answer'] = $mas[6];
                $i++;
            };
            return $question;
        };


        function getComment($status) {
            include '../../php/connect_db.php';

            $str_sql_query = "SELECT id_message, id_product, message, name, date, status  FROM comment";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $i = 0;
            while($mas = mysql_fetch_row($result)) {
                $comment[$i]['id_message'] = $mas[0];
                $comment[$i]['id_product'] = $mas[1];
                $comment[$i]['message'] = $mas[2];
                $comment[$i]['name'] = $mas[3];
                $comment[$i]['date'] = $mas[4];
                $comment[$i]['status'] = $mas[5];
                $i++;
            };
            return $comment;
        };



        function add_Answer($id_message, $answer) {
            include '../../php/connect_db.php';

            $str_sql_query = "UPDATE question SET answer = '$answer', status = 'treat' WHERE id_message = '$id_message'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            } else {
                echo 'true';

                $str_sql_query = "SELECT id_product, email FROM question WHERE id_message = '$id_message'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "‹br›He могу выполнить запрос‹br›";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $id_product = $mas[0];
                $email = $mas[1];

                $to  =  $email; 

                $subject = "Aleksa shop"; 

                $link = "http://aleksa/product.php?gender=for_women&id=".$id_product;

                $message = "
                <html> 
                    <head> 
                        <title>Aleksa shop</title> 
                    </head> 
                    <body> 
                        <p>Мы ответили на Ваш вопрос по данному товару <a href='".$link."'>".$link."</a></p>
                        <p>Спасибо, оставайтесь с Нами</p>
                    </body> 
                </html>"; 

                $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 

                    if(!mail($to, $subject, $message, $headers))
                    {
                        echo 'Ошибка отправки!';
                    };
            };
        };



        function add_Comment_Status($id_message, $status) {
            include '../../php/connect_db.php';

            if($status == "ok") {
                $str_sql_query = "UPDATE comment SET status = 'treat' WHERE id_message = '$id_message'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "‹br›He могу выполнить запрос‹br›";
                    echo mysql_error();
                    exit();
                } else {
                    echo 'true';
                };
            } elseif($status == "no") {
                $str_sql_query = "DELETE FROM comment WHERE id_message = '$id_message'";
                 if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "‹br›He могу выполнить запрос‹br›";
                    echo mysql_error();
                    exit();
                } else {
                    echo 'true';
                };
            };
        };




        function get_statistic($begin, $end) {
            include '../../php/connect_db.php';

            $str_sql_query = "SELECT id, UNIX_TIMESTAMP(date) FROM sales_statistic";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "‹br›He могу выполнить запрос‹br›";
                echo mysql_error();
                exit();
            };
            $i = 0;
            while($mas = mysql_fetch_row($result)) {
                $st_id_date[$i]['id'] = $mas[0];
                $st_id_date[$i]['date'] = $mas[1];
                $i++;
            };

            $statistic_id = array();
            for($i = 0; $i < count($st_id_date); $i++) {
                $this_date = $st_id_date[$i]['date'];
                if($this_date >= $begin && $this_date <= $end) $statistic_id[] = $st_id_date[$i]['id'];
            };


            $statistic = array();
            for($i = 0; $i < count($statistic_id); $i++) {
                $this_id = $statistic_id[$i];
                $str_sql_query = "SELECT name, price, discount, gender, brand, color, size, sum, date FROM sales_statistic WHERE id = '$this_id'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "‹br›He могу выполнить запрос‹br›";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $statistic[$i]['id'] = $this_id;
                $statistic[$i]['name'] = $mas[0];
                $statistic[$i]['price'] = $mas[1];
                $statistic[$i]['discount'] = $mas[2];
                $statistic[$i]['gender'] = $mas[3];
                $statistic[$i]['brand'] = $mas[4];
                $statistic[$i]['color'] = $mas[5];
                $statistic[$i]['size'] = $mas[6];
                $statistic[$i]['sum'] = $mas[7];
                $statistic[$i]['date'] = $mas[8];
            };

            echo json_encode($statistic);
        };







?>