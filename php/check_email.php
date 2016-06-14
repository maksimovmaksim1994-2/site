<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
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
    checkEmail();

} else {
  echo 'Данные не приняты';
}; 

?>