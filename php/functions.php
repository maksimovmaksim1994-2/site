<?php

    function Registration()
    {
        include 'connect_db.php';
        GLOBAL $email;
        GLOBAL $password;
        GLOBAL $username;
        GLOBAL $telephone;

        $str_sql_query = "INSERT INTO users (email, password, name, telephone) VALUES ('$email', '$password', '$username', '$telephone')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        }
        session_start();
        $_SESSION['email'] = $email;

        mysql_close($link);
    };



    function Login()
    {
        include 'connect_db.php';
        GLOBAL $email;
        GLOBAL $password;

        $str_sql_query = "SELECT password FROM users WHERE email = '$email'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        if($mas = mysql_fetch_row($result))
        {
            if($mas[0] == $password) 
            {
                $_SESSION['email'] = $email;
                $session['state'] = 1;
            } else $session['state'] = 2;//неверный пароль
        } else {
            $session['state'] = 3;//пользователь отсутствует
        };

        echo $session['state'];

        mysql_close($link);
    };


    function Lose($email)
    {
        include 'connect_db.php';

        $str_sql_query = "SELECT password FROM users WHERE email = '$email'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        }

        if($mas = mysql_fetch_row($result))
        {
            if($password = $mas[0]) 
            {
                echo $password;
            } else echo 'Ошибка поиска пароля';//неверный пароль
        } else {
            echo "\$";//пользователь отсутствует
        };
        mysql_close($link);
    };


    function checkEmail() {
        include 'connect_db.php';
        GLOBAL $email;
        GLOBAL $password;

        $str_sql_query = "SELECT * FROM users WHERE email = '$email'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        if($mas = mysql_fetch_row($result))
        {
            $session['state'] = 1;
        } else {
            $session['state'] = 3;//пользователь отсутствует
        };

        echo $session['state'];

    };




    function giveMyInfo() {
        if(!empty($_SESSION['email'])) {
            include 'connect_db.php';
            GLOBAL $email;
            GLOBAL $telephone;
            GLOBAL $username;
            GLOBAL $surname;
            GLOBAL $middlename;
            GLOBAL $birthday;
            GLOBAL $sex;

            $email =  $_SESSION['email'];

            $str_sql_query = "SELECT name FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $username = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT surname FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $surname = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT middlename FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $middlename = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT email FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $email = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT telephone FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $telephone = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT birthday FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $birthday = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };

            $str_sql_query = "SELECT sex FROM users WHERE email = '$email'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };

            if($mas = mysql_fetch_row($result)) {
                $sex = $mas[0];
            } else {
                echo 'Ошибка поиска информации';
            };
        };
    };


    function saveMyInfo()
    {
        include 'connect_db.php';
        GLOBAL $oldEmail;
        GLOBAL $email;
        GLOBAL $username;
        GLOBAL $surname;
        GLOBAL $middlename;
        GLOBAL $telephone;
        GLOBAL $gender;
        GLOBAL $date;

        $str_sql_query = "SELECT id FROM users WHERE email = '$oldEmail'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        if($mas = mysql_fetch_row($result)) {
                $id = $mas[0];
        } else {
                echo 'Ошибка поиска идентификатора';
        };

        $str_sql_query = "UPDATE users SET email='$email' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET name='$username' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET surname='$surname' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET middlename='$middlename' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET middlename='$middlename' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET telephone='$telephone' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET sex='$gender' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }

        $str_sql_query = "UPDATE users SET birthday='$date' WHERE id = '$id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        }
        
        mysql_close($link);
    };

    function getLinkGender() {
        if($_GET['gender'] == 'for_women') {
            $genger = "gender=for_women";
        } else if($_GET['gender'] == 'for_men') {
            $genger = "gender=for_men";
        } else {
            $genger = "gender=for_men";
        };
        $str = $genger;
        return $str;
    };

    function addMenu(){
        include 'connect_db.php';

        $str_sql_query = "SELECT item FROM menu";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        while($mas = mysql_fetch_row($result)){
          $item = $mas[0];
          $str_sql_query = "SELECT description FROM menu WHERE item = '$item'";
          if (!$result2 = mysql_query($str_sql_query, $link))
          {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
          };
          $mas2 = mysql_fetch_row($result2);
          $description = $mas2[0];
          $gender = getLinkGender();
          if($item == "Бренды") echo "<li><a data-description='".$description."'>".$item."</a></li>";
          else echo "<li><a href='../?".$gender."&item=".$item."' data-description='".$description."'>".$item."</a></li>";  
        };
    };


    function showMenuItems() {
        include 'connect_db.php';
        GLOBAL $gender;
        GLOBAL $item;

        $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $mas = mysql_fetch_row($result);
        $item_id = $mas[0];

        if($gender == "men") $table = 'id_menu_to_group_men';
        if($gender == "women") $table = 'id_menu_to_group_women';

        $str_sql_query = "SELECT id_group FROM $table WHERE id_menu = '$item_id'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        if($gender == "men") $table = 'menu_group_men';
        if($gender == "women") $table = 'menu_group_women';

        $productArr = array();
        while($mas = mysql_fetch_row($result)) {
            $group_id = $mas[0];

            $str_sql_query = "SELECT item FROM $table WHERE id = '$group_id'";
            if (!$result2 = mysql_query($str_sql_query, $link))
            {
              echo "He могу выполнить запрос";
              echo mysql_error();
              exit();
            };
            $mas2 = mysql_fetch_row($result2);
            $productArr[] = $mas2[0];
        };
        echo json_encode($productArr);
    };


    function showMenuItemsBrand() {
        include 'connect_db.php';
        GLOBAL $gender;

        if($gender == "men") $table = 'brand_men';
        if($gender == "women") $table = 'brand_women';

        $str_sql_query = "SELECT brand FROM $table";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        while($mas = mysql_fetch_row($result)) {
            $productArr[] = $mas[0];
        };

        echo json_encode($productArr);
    };



     function addSideMenu(){
        include 'connect_db.php';

        $str_sql_query = "SELECT id, item FROM menu";
        if (!$result3 = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        while($mas3 = mysql_fetch_row($result3)){
          $item = $mas3[1];
          $item_id = $mas3[0];
          $gender = getLinkGender();
          echo "<li><a>".$item."</a>
                    <ul class=\"menu vertical group\">";
                    if($item == "Бренды") {
                        
                        if(!empty($_GET['gender'])) {
                            $gender = $_GET['gender'];
                            if($gender == "for_men") $table = 'brand_men';
                            if($gender == "for_women") $table = 'brand_women';
                        };

                        $str_sql_query = "SELECT brand FROM $table";
                        if (!$result = mysql_query($str_sql_query, $link))
                        {
                          echo "He могу выполнить запрос";
                          echo mysql_error();
                          exit();
                        };

                        while($mas = mysql_fetch_row($result)) {
                            $brand = $mas[0];
                            echo "<li><a href='../?gender=".$gender."&brand=".$brand."'>".$brand."</a>";
                        };

                    } else {

                        if(!empty($_GET['gender'])) {
                            $gender = $_GET['gender'];
                            if($gender == "for_men") $table = 'id_menu_to_group_men';
                            if($gender == "for_women") $table = 'id_menu_to_group_women';
                        };

                        $str_sql_query = "SELECT id_group FROM $table WHERE id_menu = '$item_id'";
                        if (!$result = mysql_query($str_sql_query, $link))
                        {
                          echo "He могу выполнить запрос";
                          echo mysql_error();
                          exit();
                        };

                        if($gender == "for_men") $table = 'menu_group_men';
                        if($gender == "for_women") $table = 'menu_group_women';

                        while($mas = mysql_fetch_row($result)) {
                            $group_id = $mas[0];

                            $str_sql_query = "SELECT item FROM $table WHERE id = '$group_id'";
                            if (!$result2 = mysql_query($str_sql_query, $link))
                            {
                              echo "He могу выполнить запрос";
                              echo mysql_error();
                              exit();
                            };
                            $mas2 = mysql_fetch_row($result2);
                            echo "<li><a href='../?gender=".$gender."&item=".$item."&group=".$mas2[0]."'>".$mas2[0]."</a>";
                        };

                    };
                    if($item != "Бренды") echo "<li><a href='../?gender=".$gender."&item=".$item."'>Все категории</a>";
                echo "</ul>
                </li>";  
        };
    };





    function getGroupDescription($group, $gender) {
        include 'connect_db.php';
        if($gender == "for_men") {
            $table = 'menu_group_men';
        } else if($gender == "for_women") {
            $table = 'menu_group_women';
        } else {
            return;
        };

        $str_sql_query = "SELECT description FROM $table WHERE item = '$group'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $description = $mas[0];
        echo "<div class='main-group-description'>".$description."</div>";
    };

    function getItemDescription($item) {
        include 'connect_db.php';

        $str_sql_query = "SELECT description FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $description = $mas[0];
        echo "<div class='main-group-description'>".$description."</div>";
    };



    function getProductForFilter($number, $liked = "") {
        include 'connect_db.php';

        $str_sql_query = "SELECT name, shot_description, description, price, discount, date, visit FROM product WHERE id = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };
        $mas = mysql_fetch_row($result);
        $prod['id'] = $number;
        $prod['name'] = $mas[0];
        $prod['shot_description'] = $mas[1];
        $prod['price'] = $mas[3];
        $prod['discount'] = $mas[4];
        $prod['date'] = $mas[5];
        $prod['visit'] = $mas[6];

        $str_sql_query = "SELECT id_image, status FROM id_product_to_image WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        while($mas = mysql_fetch_row($result)) {
            if($mas[1] == 'main') {
                $id_image = $mas[0];
                $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                if (!$result2 = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas2 = mysql_fetch_row($result2);
                $prod['photoMain'] = $mas2[0];
            } else {
                $id_image = $mas[0];
                $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                if (!$result2 = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas2 = mysql_fetch_row($result2);
                $prod['photo'][] = $mas2[0];
            };
        };

        if($liked == "") {
            $prod['like'] = 'no';
        } else {
            $arr = explode(",", $liked);
            for($j = 0; $j < 1; $j++) {
                for($i = 0; $i < count($arr); $i++) {
                    if($arr[$i] == $prod['id']) {
                        $prod['like'] = 'yes';
                        break(2);
                    };
                };
                $prod['like'] = 'no';
            };
        };

        return $prod; 
    };




    function mainFilter_Item_and_Group($item, $group, $gender) {
        include 'connect_db.php';
        GLOBAL $allNumbers;

        $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_item = $mas[0];


        if($gender == 'for_men') $table = 'menu_group_men';
        if($gender == 'for_women') $table = 'menu_group_women';

        $str_sql_query = "SELECT id FROM $table WHERE item = '$group'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_group = $mas[0];


        if($gender == 'for_men') $table = 'id_product_to_item_group_men';
        if($gender == 'for_women') $table = 'id_product_to_item_group_women';

        $str_sql_query = "SELECT id_product FROM $table WHERE id_item = '$id_item' and id_group = '$id_group'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        while($mas = mysql_fetch_row($result)) {
            $allNumbers[] = $mas[0];
        };
    };





    function mainFilter_Brand($brand, $gender) {
        include 'connect_db.php';
        GLOBAL $allNumbers;

        if($gender == "for_men") $table = "brand_men";
        if($gender == "for_women") $table = "brand_women"; 

        for($i = 0; $i < count($brand); $i++) {
            $this_brand = $brand[$i];
            $str_sql_query = "SELECT id FROM $table WHERE brand = '$this_brand'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_brand_all[] = $mas[0];
        };

        if($gender == "for_men") $table = "id_product_to_brand_men";
        if($gender == "for_women") $table = "id_product_to_brand_women"; 


         for($i = 0; $i < count($id_brand_all); $i++) {
            $this_id_brand = $id_brand_all[$i];
            $str_sql_query = "SELECT id_product FROM $table WHERE id_brand = '$this_id_brand'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            while($mas = mysql_fetch_row($result)) {
                $id_product_this = $mas[0];
                
                for($j = 0; $j < count($allNumbers); $j++) {
                    if($allNumbers[$j] == $id_product_this) continue(2);
                };
                $allNumbers[] = $id_product_this;
            };

        };
    };





    function mainFilter_Item($item, $gender) {
        include 'connect_db.php';
        GLOBAL $allNumbers;

        $str_sql_query = "SELECT id FROM menu WHERE item = '$item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_item = $mas[0];

        if($gender == 'for_men') $table = 'id_product_to_item_group_men';
        if($gender == 'for_women') $table = 'id_product_to_item_group_women';

        $str_sql_query = "SELECT id_product FROM $table WHERE id_item = '$id_item'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };
        while($mas = mysql_fetch_row($result)) {
            $allNumbers[] = $mas[0];
        };
    };




//подходящие хоть под один парраметр
    function mainFilter_Parametr($parametr, $str, $gender) {
        include 'connect_db.php';
        GLOBAL $MainGroupNumbers;
        GLOBAL $allNumbers;


        if($str == "material") { $table = "material"; $where = "material"; };
        if($str == "color") { $table = "color"; $where = "color"; };
        if($str == "brand") {
            if($gender == "for_men") $table = "brand_men";
            if($gender == "for_women") $table = "brand_women"; 
            $where = "brand"; 
        };

        for($i = 0; $i < count($parametr); $i++) {
            $this_parametr = $parametr[$i];
            $str_sql_query = "SELECT id FROM $table WHERE $where = '$this_parametr'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_parametr_all[] = $mas[0];
        };

        if($str == "color") { $where = "id_color"; $table = "id_product_to_color"; };
        if($str == "material") { $where = "id_material"; $table = "id_product_to_material"; };
        if($str == "brand") {
            $where = "id_brand"; 
            if($gender == "for_men") $table = "id_product_to_brand_men";
            if($gender == "for_women") $table = "id_product_to_brand_women"; 
        };

        for($i = 0; $i < count($id_parametr_all); $i++) {
            $this_id_parametr = $id_parametr_all[$i];
            $str_sql_query = "SELECT id_product FROM $table WHERE $where = '$this_id_parametr'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            while($mas = mysql_fetch_row($result)) {
                $id_product_this = $mas[0];

                for($j = 0; $j < count($MainGroupNumbers); $j++) {
                    if($MainGroupNumbers[$j] == $id_product_this) {
                        for($j = 0; $j < count($allNumbers); $j++) {
                            if($allNumbers[$j] == $id_product_this) continue(3);
                        };
                        $allNumbers[] = $id_product_this;
                    };
                };

            };

        };

    };








//подходящиетолько под все параметры
/*
    function mainFilter_Parametr($parametr, $str, $gender) {
        include 'connect_db.php';
        GLOBAL $allNumbers;


        if($str == "material") { $table = "material"; $where = "material"; };
        if($str == "color") { $table = "color"; $where = "color"; };
        if($str == "brand") {
            if($gender == "for_men") $table = "brand_men";
            if($gender == "for_women") $table = "brand_women"; 
            $where = "brand"; 
        };

        for($i = 0; $i < count($parametr); $i++) {
            $this_parametr = $parametr[$i];
            $str_sql_query = "SELECT id FROM $table WHERE $where = '$this_parametr'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_parametr_all[] = $mas[0];
        };

        if($str == "color") { $whot = "id_color"; $table = "id_product_to_color"; };
        if($str == "material") { $whot = "id_material"; $table = "id_product_to_material"; };
        if($str == "brand") {
            $whot = "id_brand"; 
            if($gender == "for_men") $table = "id_product_to_brand_men";
            if($gender == "for_women") $table = "id_product_to_brand_women"; 
        };
        $newArray = array();
        for($i = 0; $i < count($allNumbers); $i++) {
            $this_id_prod = $allNumbers[$i];
            $str_sql_query = "SELECT $whot FROM $table WHERE id_product = '$this_id_prod'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };

            $id_parametr_product_all = array();
            while($mas = mysql_fetch_row($result)) {
                $id_parametr_product_all[] = $mas[0];
            };
            for($h = 0; $h < 1; $h++) {
                for($j = 0; $j < count($id_parametr_all); $j++) {
                    if(in_array($id_parametr_all[$j], $id_parametr_product_all)) ;
                    else break(2);
                };
                $newArray[] = $this_id_prod;
            };
        };

        $allNumbers = $newArray;
    };
*/


    function mainFilter_Price($Price) {
        include 'connect_db.php';
        GLOBAL $allNumbers;
        if(!empty($Price['min'])) $min = $Price['min'];
        else $min = 0;
        if(!empty($Price['max'])) $max = $Price['max'];
        else $max = 9999999;
        $newArray = array();

        for($i = 0; $i < count($allNumbers); $i++) {
            $this_id_product = $allNumbers[$i];
            $str_sql_query = "SELECT price FROM product WHERE id = '$this_id_product'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $this_price = $mas[0];
            if($min - 1 < $this_price and $this_price < $max + 1) $newArray[] = $this_id_product;
        };
        $allNumbers = $newArray;
    };






    function getSortParametr() {
        include 'connect_db.php';
        GLOBAL $allNumbers;

        for($i = 0; $i < count($allNumbers); $i++) {
            $this_id = $allNumbers[$i];
            $str_sql_query = "SELECT price, discount, date, visit FROM product WHERE id = '$this_id'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $newArray[$i]['id'] = $this_id;
            $newArray[$i]['price'] = $mas[0];
            $newArray[$i]['discount'] = $mas[1];
            $all = 100;
            if($newArray[$i]['discount'] == 0 || $newArray[$i]['discount'] == "") $all = 0;
            $newArray[$i]['discount'] = $all - ($newArray[$i]['discount']/($newArray[$i]['price']/100));
            $newArray[$i]['date'] = $mas[2];
            $newArray[$i]['visit'] = $mas[3];
        };

        $allNumbers =  $newArray;
    };





    function addSizeToFilter() {
        include 'connect_db.php';
        
        $str_sql_query = "SELECT size FROM size";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $Num = 1;
        function addSize($value) {
            GLOBAL $Num;
            $id = "size".$Num;
            echo "<div class='check-wrap width-size'>
                        <input type='checkbox' data-parametr='size' data-value='".$value."' id='".$id."'/>
                        <label for='".$id."' class='box'></label>
                        <label for='".$id."' class='text'><span>".$value."</span></label>
                    </div> ";
            $Num++;
        };
        addSize("XXS");
        addSize("L");
        addSize("XS");
        addSize("XL");
        addSize("S");
        addSize("XXL");
        addSize("M");
        addSize("XXXL");
    };

    function addBrandToFilter() {
        include 'connect_db.php';

        if($_GET['gender'] == "for_men") $table = "brand_men";
        elseif($_GET['gender'] == "for_women") $table = "brand_women";
        else exit();

        
        $str_sql_query = "SELECT brand FROM $table";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $Num = 1;
        while($mas = mysql_fetch_row($result)) {
            $value = $mas[0];
            $id = "brand".$Num;
            echo "<div class='check-wrap'>
                        <input type='checkbox' data-parametr='brand' data-value='".$value."' id='".$id."'/>
                        <label for='".$id."' class='box'></label>
                        <label for='".$id."' class='text'><span>".$value."</span></label>
                    </div> ";
            $Num++;
        };
    };



    function addMaterialToFilter() {
        include 'connect_db.php';
        
        $str_sql_query = "SELECT material FROM material";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $Num = 1;
        while($mas = mysql_fetch_row($result)) {
            $value = $mas[0];
            $id = "material".$Num;
            echo "<div class='check-wrap'>
                        <input type='checkbox' data-parametr='material' data-value='".$value."' id='".$id."'/>
                        <label for='".$id."' class='box'></label>
                        <label for='".$id."' class='text'><span>".$value."</span></label>
                    </div> ";
            $Num++;
        };
    };


    function addColorToFilter() {
        include 'connect_db.php';
        
        $str_sql_query = "SELECT color, code FROM color";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $Num = 1;
        while($mas = mysql_fetch_row($result)) {
            $value = $mas[0];
            $code = $mas[1];
            $id = "color".$Num;
            echo "<div class='check-wrap'>
                        <input type='checkbox' data-parametr='color' data-value='".$value."' id='".$id."'/>
                        <label for='".$id."' class='box'></label>
                        <label for='".$id."' class='text'><span>".$value."</span></label>
                        <label for='".$id."' class='text-color' style='background-color:".$code.";'></label>
                    </div> ";
            $Num++;
        };
    };





    function set_like($id, $email) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT liked FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $liked = $mas[0];
        if($liked == "") {
            $arr[] = $id;
            $str = implode(",", $arr);
            $str_sql_query = "UPDATE users SET liked = '$str' WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            echo "absent";
        } else {
            $arr = explode(",", $liked);
            for($i = 0; $i < count($arr); $i++) {
                if($arr[$i] == $id) {
                    unset($arr[$i]);
                    $str = implode(",", $arr);
                    $str_sql_query = "UPDATE users SET liked = '$str' WHERE id = '$id_user'";
                    if(!$result = mysql_query($str_sql_query, $link)) {
                        echo mysql_error();
                        exit();
                    };
                    echo "present";
                    return;
                };
            };
            $arr[] = $id;
            $str = implode(",", $arr);
            $str_sql_query = "UPDATE users SET liked = '$str' WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            echo "absent";
        };

    };




    function get_liked() {
        session_start();
        include 'connect_db.php';

        if(!empty($_SESSION['email'])) {
            $email = $_SESSION['email'];
            
            $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_user = $mas[0];

            $str_sql_query = "SELECT liked FROM users WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            
            };
            $mas = mysql_fetch_row($result);
            $liked = $mas[0];
        } else {
            $liked = "nologin";
        };
        return $liked;
    };


    function get_count_basket($email) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT basket FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $basket = $mas[0];
        if($basket == "") {
            echo "0";
        } else {
            $arr = json_decode($basket);
            $count = 0;
            for($i = 0; $i < count($arr); $i++) {
                foreach($arr[$i] as $key => $value) {
                    if($key == 'count') $this_count = $value;
                };
                $count += $this_count;
            };
            return $count;
        };
    };




    function add_to_basket($id_product, $size, $email, $act) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT basket FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $basket = $mas[0];


        $str_sql_query = "SELECT id FROM size WHERE size = '$size'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_size = $mas[0];

        $str_sql_query = "SELECT sum FROM id_product_to_size WHERE id_product = '$id_product' and id_size = '$id_size'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $maxCount = $mas[0];
        $count;
        function return_func($email, $count, $maxCount, $this_count = "") {
            $count['count'] = get_count_basket($email);
            $count['countMax'] = $maxCount;
            $count['countThis'] = $this_count;

            echo json_encode($count);
        };
        if($basket == "") {
                if($maxCount < 1) {
                    echo 'full';
                    exit();
                };
                $arr[0]['id_product'] = $id_product;
                $arr[0]['size'] = $size;
                $arr[0]['count'] = 1;
                $str = json_encode($arr);
                $str_sql_query = "UPDATE users SET basket = '$str' WHERE id = '$id_user'";
                if(!$result = mysql_query($str_sql_query, $link)) {
                    echo mysql_error();
                    exit();
                };
                return_func($email, $count, $maxCount, 1);
        } else {
            $arr = json_decode($basket);

            for($i = 0; $i < count($arr); $i++) {
                foreach($arr[$i] as $key => $value) {
                    if($key == 'id_product') $this_id_product = $value;
                    if($key == 'size') $this_size = $value;
                    if($key == 'count') $this_count = $value;
                };
                if($this_id_product == $id_product && $this_size == $size) {
                    if($act == "add") {
                        if($maxCount < $this_count + 1) {
                            $count['full'] = 'full';
                            return_func($email, $count, $maxCount, $this_count);
                            exit();
                        };
                        $this_count++;
                    } elseif($act == "del") {
                         if($this_count - 1 <= 0) {
                            $count['full'] = 'full';
                            return_func($email, $count, $maxCount, $this_count);
                            exit();
                        };
                        $this_count--;
                    };

                    $arr[$i] = array('id_product' => $this_id_product, 'size' => $this_size, 'count' => $this_count);
                    $str = json_encode($arr);
                    $str_sql_query = "UPDATE users SET basket = '$str' WHERE id = '$id_user'";
                    if(!$result = mysql_query($str_sql_query, $link)) {
                        echo mysql_error();
                        exit();
                    };
                    return_func($email, $count, $maxCount, $this_count);
                    return;
                };
            };
            if($maxCount < 1) {
                echo 'full';
                return_func($email, $count, $maxCount, 0);
                exit();
            };
            $obj = array('id_product' => $id_product, 'size' => $size, 'count' => 1);
            $arr[] = $obj;
            $str = json_encode($arr);
            $str_sql_query = "UPDATE users SET basket = '$str' WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            return_func($email, $count, $maxCount, 1);
        };
    };




    function remove_from_basket($id_product, $size, $email) {
        include 'connect_db.php';
        
        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT basket FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $basket = $mas[0];

        $count;
        function return_func($email, $count) {
            $count['count'] = get_count_basket($email);

            echo json_encode($count);
        };
      
        $arr = json_decode($basket);

        for($i = 0; $i < count($arr); $i++) {
            foreach($arr[$i] as $key => $value) {
                if($key == 'id_product') $this_id_product = $value;
                if($key == 'size') $this_size = $value;
                if($key == 'count') $this_count = $value;
            };
            if($this_id_product == $id_product && $this_size == $size) {
                array_splice($arr, $i, 1);
                $str = json_encode($arr);
                 $str_sql_query = "UPDATE users SET basket = '$str' WHERE id = '$id_user'";
                if(!$result = mysql_query($str_sql_query, $link)) {
                    echo mysql_error();
                    exit();
                };
                return_func($email, $count);
                return;
            };
        };
    };




    function get_my_basket($email, $output) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT basket FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $basket = $mas[0];
        if($basket == "") {
            if($output == "json") echo json_encode(array());
            elseif($output == "return") return array();
        } else {
            $basket = json_decode($basket);
            for($i = 0; $i < count($basket); $i++) {
                foreach($basket[$i] as $key => $value) {
                    if($key == 'id_product') $this_id_product = $value;
                    if($key == 'size') $this_size = $value;
                    if($key == 'count') $this_count = $value;
                };

                $str_sql_query = "SELECT name, shot_description, price, discount FROM product WHERE id = '$this_id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $prod['id'] = $this_id_product;
                $prod['size'] = $this_size;
                $prod['count'] = $this_count;
                $prod['name'] = $mas[0];
                $prod['shot_description'] = $mas[1];
                $prod['price'] = $mas[2];
                $prod['discount'] = $mas[3];

                $str_sql_query = "SELECT id FROM size WHERE size = '$this_size'";
                if(!$result = mysql_query($str_sql_query, $link)) {
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $id_size = $mas[0];

                $str_sql_query = "SELECT sum FROM id_product_to_size WHERE id_product = '$this_id_product' and id_size = '$id_size'";
                if(!$result = mysql_query($str_sql_query, $link)) {
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $prod['maxCount'] = $mas[0];


                $str_sql_query = "SELECT id_image, status FROM id_product_to_image WHERE id_product = '$this_id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };

                while($mas = mysql_fetch_row($result)) {
                    if($mas[1] == 'main') {
                        $id_image = $mas[0];
                        $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                        if (!$result2 = mysql_query($str_sql_query, $link))
                        {
                            echo "He могу выполнить запрос";
                            echo mysql_error();
                            exit();
                        };
                        $mas2 = mysql_fetch_row($result2);
                        $prod['photoMain'] = $mas2[0];
                    };
                };

                $my_basket[] = $prod;

            };
            if($output == "json") echo json_encode($my_basket);
            elseif($output == "return") return $my_basket;
        };
    };



    function get_my_orders($email) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT orders FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $orders = $mas[0];

        if($orders == "") {
            return array();
        } else {
            $orders = json_decode($orders);
            for($i = 0; $i < count($orders); $i++) {
                foreach($orders[$i] as $key => $value) {
                    if($key == 'id_product') $this_id_product = $value;
                    if($key == 'size') $this_size = $value;
                    if($key == 'count') $this_count = $value;
                };

                $str_sql_query = "SELECT name, shot_description, price, discount FROM product WHERE id = '$this_id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $prod['id'] = $this_id_product;
                $prod['size'] = $this_size;
                $prod['count'] = $this_count;
                $prod['name'] = $mas[0];
                $prod['shot_description'] = $mas[1];
                $prod['price'] = $mas[2];
                $prod['discount'] = $mas[3];

                $str_sql_query = "SELECT id_image, status FROM id_product_to_image WHERE id_product = '$this_id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };

                while($mas = mysql_fetch_row($result)) {
                    if($mas[1] == 'main') {
                        $id_image = $mas[0];
                        $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                        if (!$result2 = mysql_query($str_sql_query, $link))
                        {
                            echo "He могу выполнить запрос";
                            echo mysql_error();
                            exit();
                        };
                        $mas2 = mysql_fetch_row($result2);
                        $prod['photoMain'] = $mas2[0];
                    };
                };

                $my_orders[] = $prod;

            };
            return $my_orders;
        };
    };




    function addVisit() {
        if($_GET['id']) {
            $id = $_GET['id'];
            include 'connect_db.php';

            $str_sql_query = "SELECT visit FROM product WHERE id = '$id'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $visit = $mas[0];

            if($visit == "") $visit = 0;
            $visit++;

            $str_sql_query = "UPDATE product SET visit = '$visit' WHERE id = '$id'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
        };
    };





    function getProductForPersonalPage($number, $gender) {
        include 'connect_db.php';

        if(!empty($_SESSION['email'])) {
            $email = $_SESSION['email'];
            
            $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $id_user = $mas[0];

            $str_sql_query = "SELECT liked FROM users WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            
            };
            $mas = mysql_fetch_row($result);
            $liked = $mas[0];
        } else {
            $liked = "nologin";
        };

        $str_sql_query = "SELECT name, shot_description, description, price, discount, date FROM product WHERE id = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };
        $mas = mysql_fetch_row($result);
        $prod['id'] = $number;
        $prod['name'] = $mas[0];
        $prod['shot_description'] = $mas[1];
        $prod['description'] = $mas[2];
        $prod['price'] = $mas[3];
        $prod['discount'] = $mas[4];
        $prod['date'] = $mas[5];

        $str_sql_query = "SELECT id_image, status FROM id_product_to_image WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        while($mas = mysql_fetch_row($result)) {
            if($mas[1] == 'main') {
                $id_image = $mas[0];
                $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                if (!$result2 = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas2 = mysql_fetch_row($result2);
                $prod['photoMain'] = $mas2[0];
            } else {
                $id_image = $mas[0];
                $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                if (!$result2 = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas2 = mysql_fetch_row($result2);
                $prod['photo'][] = $mas2[0];
            };
        };

        if($liked == "") {
            $prod['like'] = 'no';
        } else {
            $arr = explode(",", $liked);
            for($j = 0; $j < 1; $j++) {
                for($i = 0; $i < count($arr); $i++) {
                    if($arr[$i] == $prod['id']) {
                        $prod['like'] = 'yes';
                        break(2);
                    };
                };
                $prod['like'] = 'no';
            };
        };

        if($_GET['gender'] == "for_men") $table = "id_product_to_brand_men";
        elseif($_GET['gender'] == "for_women") $table = "id_product_to_brand_women";

        $str_sql_query = "SELECT id_brand FROM $table WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        $mas = mysql_fetch_row($result);
        $id_brand = $mas[0];  

        if($_GET['gender'] == "for_men") $table = "brand_men";
        elseif($_GET['gender'] == "for_women") $table = "brand_women";

        $str_sql_query = "SELECT brand FROM $table WHERE id = '$id_brand'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        $mas = mysql_fetch_row($result);
        $prod['brand'] = $mas[0];  

        $str_sql_query = "SELECT id_color FROM id_product_to_color WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        while($mas = mysql_fetch_row($result)) {
            $id_color[] = $mas[0];
        };

        for($i = 0; $i < count($id_color); $i++) {
            $this_id_color = $id_color[$i];
            $str_sql_query = "SELECT color FROM color WHERE id = '$this_id_color'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };    
            while($mas = mysql_fetch_row($result)) {
                $prod['color'][] = $mas[0];
            };
        };

        $str_sql_query = "SELECT id_material FROM id_product_to_material WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        while($mas = mysql_fetch_row($result)) {
            $id_material[] = $mas[0];
        };

        for($i = 0; $i < count($id_material); $i++) {
            $this_id_material = $id_material[$i];
            $str_sql_query = "SELECT material FROM material WHERE id = '$this_id_material'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };    
            while($mas = mysql_fetch_row($result)) {
                $prod['material'][] = $mas[0];
            };
        };

        $str_sql_query = "SELECT id_size, sum FROM id_product_to_size WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        while($mas = mysql_fetch_row($result)) {
            $id_size[] = array('size' => $mas[0], 'sum' => $mas[1]);
        };/**/

        for($i = 0; $i < count($id_size); $i++) {
            $this_size = $id_size[$i];
            $this_id_size = $this_size['size'];
            $this_sum = $this_size['sum'];
            $str_sql_query = "SELECT size FROM size WHERE id = '$this_id_size'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };    
            $mas = mysql_fetch_row($result);
            $prod['size'][$i] = array('size' => $mas[0], 'sum' => $this_sum);
        };


        $str_sql_query = "SELECT id_parametr, value FROM id_product_to_parametr WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        while($mas = mysql_fetch_row($result)) {
            $id_parametr[] = array('parametr' => $mas[0], 'value' => $mas[1]);
        };/**/

        for($i = 0; $i < count($id_parametr); $i++) {
            $this_parametr = $id_parametr[$i];
            $this_id_parametr = $this_parametr['parametr'];
            $this_value = $this_parametr['value'];
            $str_sql_query = "SELECT parametr FROM parametr WHERE id = '$this_id_parametr'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };    
            $mas = mysql_fetch_row($result);
            $prod['parametr'][$i] = array('parametr' => $mas[0], 'value' => $this_value);
        };

        return $prod; 
    };


    function whoLogin() {
        include 'connect_db.php';
        if(empty($_SESSION['email'])) return;
        $email = $_SESSION['email'];

        $str_sql_query = "SELECT id, name, surname, telephone FROM users WHERE email = '$email'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        if($mas = mysql_fetch_row($result))
        {
            $session['id'] = $mas[0];
            $session['name'] = $mas[1];
            $session['surname'] = $mas[2];
            $session['tel'] = $mas[3];
            $session['email'] = $email;
        };

        return $session;

        mysql_close($link);
    };

    function sendMessage($email, $name, $id_user, $id_product, $message, $section) {
        include 'connect_db.php';

        $table = $section;
        $date = date('c');

        $str_sql_query = "INSERT INTO $table (id_user, id_product, message, email, name, date, status) VALUES ('$id_user', '$id_product', '$message', '$email', '$name', '$date', 'waiting')";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "‹br›He могу выполнить запрос‹br›";
          echo mysql_error();
          exit();
        } else echo 'true';

    };



    function show_product_question($id_product) {
        include 'connect_db.php';

        $str_sql_query = "SELECT name, message, date, answer FROM question WHERE id_product = '$id_product' and status = 'treat'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $i = 0;
        while($mas = mysql_fetch_row($result))
        {
            $question[$i]['name'] = $mas[0];
            $question[$i]['message'] = $mas[1];
            $question[$i]['date'] = $mas[2];
            $question[$i]['answer'] = $mas[3];
            $i++;
        };
        
        for($i = 0; $i < count($question); $i++) {
            echo "
                <hr/>
                <div class='large-12 quest-block'>
                    <div class='row'>
                        <div class='large-6 columns quest-user-name'>".$question[$i]['name']."</div>
                        <div class='large-6 columns quest-date'><i>".$question[$i]['date']."</i></div>
                        <div class='large-12 columns quest-message'>".$question[$i]['message']."</div>
                        <div class='large-1 columns'></div>
                        <div class='large-11 columns quest-answer'><i>Ответ: </i>".$question[$i]['answer']."</div>
                    </div>
                </div>
            ";
        };

    };



    function show_product_comment($id_product) {
        include 'connect_db.php';

        $str_sql_query = "SELECT name, message, date FROM comment WHERE id_product = '$id_product' and status = 'treat'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        $i = 0;
        while($mas = mysql_fetch_row($result))
        {
            $comment[$i]['name'] = $mas[0];
            $comment[$i]['message'] = $mas[1];
            $comment[$i]['date'] = $mas[2];
            $i++;
        };
        
        for($i = 0; $i < count($comment); $i++) {
            echo "
                <hr/>
                <div class='large-12 quest-block'>
                    <div class='row'>
                        <div class='large-6 columns quest-user-name'>".$comment[$i]['name']."</div>
                        <div class='large-6 columns quest-date'><i>".$comment[$i]['date']."</i></div>
                        <div class='large-12 columns quest-message'>".$comment[$i]['message']."</div>
                    </div>
                </div>
            ";
        };

    };




    function word_declination($sum) {
        if($sum == 0 || $sum >= 5) return "товаров";
        elseif($sum == 1) return "товар";
        elseif($sum > 1 && $sum < 5) return "товара";
    };



    function make_an_order($id_user, $comment) {
        include 'connect_db.php';

        $str_sql_query = "SELECT basket FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };

        $mas = mysql_fetch_row($result);
        $basket = $mas[0];
        if($basket == "") {
            echo "abort";
        } else {
            $basket = json_decode($basket);
            $date = date('c');

            function get_gender($id_product, $link) {
                $str_sql_query = "SELECT * FROM id_product_to_item_group_men WHERE id_product = '$id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                if(!empty($mas)) return "men";

                $str_sql_query = "SELECT * FROM id_product_to_item_group_women WHERE id_product = '$id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                  };
                $mas = mysql_fetch_row($result);
                if(!empty($mas)) return "women";
            };

            function get_brand($id_product, $gender, $link) {
                if($gender == "men") $table = 'id_product_to_brand_men';
                elseif($gender == "women") $table = 'id_product_to_brand_women';
                $str_sql_query = "SELECT id_brand FROM $table WHERE id_product = '$id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                $id_brand = $mas[0];

                if($gender == "men") $table = 'brand_men';
                elseif($gender == "women") $table = 'brand_women';

                $str_sql_query = "SELECT brand FROM $table WHERE id = '$id_brand'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };
                $mas = mysql_fetch_row($result);
                return $mas[0];
            };

            function get_color($id_product, $link) {
                 $str_sql_query = "SELECT id_color FROM id_product_to_color WHERE id_product = '$id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                    echo "He могу выполнить запрос";
                    echo mysql_error();
                    exit();
                };    
                while($mas = mysql_fetch_row($result)) {
                    $id_color[] = $mas[0];
                };

                for($i = 0; $i < count($id_color); $i++) {
                    $this_id_color = $id_color[$i];
                    $str_sql_query = "SELECT color FROM color WHERE id = '$this_id_color'";
                    if (!$result = mysql_query($str_sql_query, $link))
                    {
                        echo "He могу выполнить запрос";
                        echo mysql_error();
                        exit();
                    };    
                    while($mas = mysql_fetch_row($result)) {
                        if($i == 0) $str .= $mas[0];
                        else  $str .= ", ".$mas[0];
                    };
                };
                return $str;
            };
            $json_basket = json_encode($basket);
            $str_sql_query = "INSERT INTO order_list (id_user, order_obj, comment, date) VALUES ('$id_user', '$json_basket', '$comment', '$date')";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };

            for($i = 0; $i < count($basket); $i++) {
                foreach($basket[$i] as $key => $value) {
                    if($key == 'id_product') $this_id_product = $value;
                    if($key == 'size') $this_size = $value;
                    if($key == 'count') $this_count = $value;
                };

                //добавляем в таблицу статистики продаж
                $str_sql_query = "SELECT name, price, discount FROM product WHERE id = '$this_id_product'";
                if (!$result = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas = mysql_fetch_row($result);

                $name = $mas[0];
                $price = $mas[1];
                $discount = $mas[2];
                $gender = get_gender($this_id_product, $link);
                $brand = get_brand($this_id_product, $gender, $link);
                $color = get_color($this_id_product, $link);
                $size = $this_size;
                $sum = $this_count;

                $str_sql_query = "INSERT INTO sales_statistic (name, price, discount, gender, brand, color, size, sum, date) VALUES ('$name', '$price', '$discount', '$gender', '$brand', '$color', '$size', '$sum', '$date')";
                if(!$result = mysql_query($str_sql_query, $link)) {
                    echo mysql_error();
                    exit();
                };

            };

            //перемещаем корзину в заказы
            $str_sql_query = "SELECT orders FROM users WHERE id = '$id_user'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };
            $mas = mysql_fetch_row($result);
            $order = $mas[0];

            if($order == "" || empty($order) || $order == "null") $arr = $basket;
            else { 
                $order = json_decode($order);
                $arr = array_merge($order, $basket);
            };

            $arr = json_encode($arr);

            $str_sql_query = "UPDATE users SET orders = '$arr' WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };

            $str_sql_query = "UPDATE users SET basket = '' WHERE id = '$id_user'";
            if(!$result = mysql_query($str_sql_query, $link)) {
                echo mysql_error();
                exit();
            };
            echo "true";
        };
    };



    function getProductForLiked($number) {
        include 'connect_db.php';

        $str_sql_query = "SELECT name, shot_description, price, discount FROM product WHERE id = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };
        $mas = mysql_fetch_row($result);
        $prod['id'] = $number;
        $prod['name'] = $mas[0];
        $prod['shot_description'] = $mas[1];
        $prod['price'] = $mas[2];
        $prod['discount'] = $mas[3];

        $str_sql_query = "SELECT id_image, status FROM id_product_to_image WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
          echo "He могу выполнить запрос";
          echo mysql_error();
          exit();
        };

        while($mas = mysql_fetch_row($result)) {
            if($mas[1] == 'main') {
                $id_image = $mas[0];
                $str_sql_query = "SELECT src FROM image WHERE id = '$id_image'";
                if (!$result2 = mysql_query($str_sql_query, $link))
                {
                  echo "He могу выполнить запрос";
                  echo mysql_error();
                  exit();
                };
                $mas2 = mysql_fetch_row($result2);
                $prod['photoMain'] = $mas2[0];
            };
        };

      
        $str_sql_query = "SELECT id_size FROM id_product_to_size WHERE id_product = '$number'";
        if (!$result = mysql_query($str_sql_query, $link))
        {
            echo "He могу выполнить запрос";
            echo mysql_error();
            exit();
        };    
        while($mas = mysql_fetch_row($result)) {
            $id_size[] = $mas[0];
        };/**/

        for($i = 0; $i < count($id_size); $i++) {
            $this_id_size = $id_size[$i];
            $str_sql_query = "SELECT size FROM size WHERE id = '$this_id_size'";
            if (!$result = mysql_query($str_sql_query, $link))
            {
                echo "He могу выполнить запрос";
                echo mysql_error();
                exit();
            };    
            $mas = mysql_fetch_row($result);
            $prod['size'][] = $mas[0];
        };

        return $prod; 
    };




    function get_my_liked($email) {
        include 'connect_db.php';

        $str_sql_query = "SELECT id FROM users WHERE email = '$email'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();
        };
        $mas = mysql_fetch_row($result);
        $id_user = $mas[0];

        $str_sql_query = "SELECT liked FROM users WHERE id = '$id_user'";
        if(!$result = mysql_query($str_sql_query, $link)) {
            echo mysql_error();
            exit();     
        };
        $mas = mysql_fetch_row($result);
        $liked = $mas[0];  

        if($liked == "") {
            return array();
        } else {
            $arr = explode(",", $liked);
            for($i = count($arr) - 1; $i > -1; $i--) {
                $prodArr[] = getProductForLiked($arr[$i]);
            };
            return $prodArr;
        };

    };
?>