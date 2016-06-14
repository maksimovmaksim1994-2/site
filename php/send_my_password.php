<?php
header("Content-Type: text/html; charset=utf-8");
if(isset($_POST['password']) && isset($_POST['email'])) 
{
	$password = $_POST['password'];
	$email = $_POST['email'];

	$to  = $email; 
	$subject = "Aleksa Восстановление пароля"; 
	$message = " 
		<html> 
    		<head> 
        		<title>Восстановление пароля</title> 
    		</head> 
    		<body> 
        		<p>Ваш пароль: ".$password."</p>
        		<p>Спасибо, оставайтесь с Нами!</p>
    		</body> 
		</html>"; 

	$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 

	if(!mail($to, $subject, $message, $headers)) echo 'Ошибка отправки письма!';

} else echo 'Данные не приняты';

?>