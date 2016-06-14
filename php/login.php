<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
if(!empty($_POST['email']) and !empty($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);    
        return $value;
    };

    $email = clean($email);
    $password = clean($password);

    include 'functions.php';
    Login();

} else {
  echo 'Данные не приняты';
}; 

?>
