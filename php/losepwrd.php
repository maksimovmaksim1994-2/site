<?php
    header("Content-Type: text/html; charset=utf-8");
    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];

        function clean($value = "") 
        {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);    
            return $value;
        };

        $email = clean($email);
        include 'functions.php';
        Lose($email);

    } else {
      echo 'Данные не приняты';
    }; 

?>