<?php
	header("Content-Type: text/html; charset=utf-8");
	if(empty($_GET['gender'])) {
		echo "<script>document.location.href = '?gender=for_men'</script>";
	} else {
		if($_GET['gender'] != 'for_men' and $_GET['gender'] != 'for_women') {
			echo "<script>document.location.href = '?gender=for_men'</script>";
		};
	};
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
		<link rel="stylesheet" href="zurb_foundation/css/foundation.css" type="text/css"/>
		<link rel="stylesheet" href="zurb_foundation/css/app.css" type="text/css"/>

		<!-- jQuery -->
		<script src="js/jquery-1.12.3.js" type="text/javascript"></script>
		<script src="js/jquery.smoothscroll.js" type="text/javascript"></script>

		<!-- head style -->
		<link rel="stylesheet" href="style/header.css" type="text/css"/>

		<script src="js/functions.js" type="text/javascript"></script>
	</head>
	<body>




		<div class="top-bar" id="header">
			<div class="row">
				<div class="large-4 menium-2 small-4 columns">
					<ul class="menu">
					<?php
					$path = $_SERVER[PHP_SELF];
					$file = basename ($path);
					if(!empty($_GET['gender'])) {
						$gender = $_GET['gender'];
						if($gender == 'for_women') {
							echo "<li><a href=\"".$file."?gender=for_women\" id='main-dender'>Женщинам</a></li>
							<li><a href=\"".$file."?gender=for_men\">Мужчинам</a></li>";
						} else {
							echo "<li><a href=\"".$file."?gender=for_women\">Женщинам</a></li>
							<li><a href=\"".$file."?gender=for_men\" id='main-dender'>Мужчинам</a></li>";
						};
					} else {
						echo "<li><a href=\"".$file."?gender=for_women\">Женщинам</a></li>
							<li><a href=\"".$file."?gender=for_men\" id='main-dender'>Мужчинам</a></li>";
					};
					?>

					
					</ul>
				</div>
				<script> pickoutGender() </script>

				<div class="large-4 medium-2 small-2 columns" id="main-logo">
						<?php
							/*if(!empty($_GET['gender'])) {
								$gender = $_GET['gender'];
								if($gender == 'for_women') {
									echo "<a href=\"index.php?gender=for_women\">Магазин</a>";
								} else {
									echo "<a href=\"index.php?gender=for_men\">Магазин</a>";
								};
							} else {
								echo "<a href=\"index.php?gender=for_men\">Магазин</a>";
							};*/
						?>
				</div>

				<div class="large-1 medium-2 small-4 columns"></div>

				<div class="large-3 columns">
					<ul class="menu align-right">
						<?php echo "<li><a href='basket.php?gender'".$_GET['gender']."'>Корзина</a></li>"; ?>
						<li><span class="basket">
								<span>
									<p class="bask-counter"><?php 
											if(!empty($_SESSION['email'])) {
												echo get_count_basket($_SESSION['email']);
											} else {
												echo "0";
											}
										?>
									</p>
								</span>
							</span>
						</li>
						<?php
						if(!empty($_SESSION['email'])) 
						{
							echo "
								<li><a href=\"#\" class=\"profile\">Профиль</a></li>
								<li class=\"user-menu\">
								  	<div>
								  		<ul class=\"menu vertical\">
								  			<li><a href=\"my_liked.php?gender=".$_GET['gender']."\">Избранные</a></li>
								  			<li><a href=\"orders.php?gender=".$_GET['gender']."\" >Мои заказы</a></li>
								  			<li><a href=\"my_info.php?gender=".$_GET['gender']."\">Мои данные</a></li>
								  			<li><a href=\"#\" id=\"logout\">Выйти</a></li>
								  		</ul>
								  	</div>
								  	<span></span>
								</li>
								";
						} else {
							echo "<li><a class='click-to-enter' href=\"#\" data-open=\"login\">Войти</a></li>";
						};
						?>
					</ul>
				</div>
			</div>
		</div>

	<div class="degradation degradation-top"></div>

		<div class="top-bar" id="main-menu">
			<div class="row">
				<div class="top-bar-left">
					<ul class="menu">
						<?php addMenu() ?>
					</ul>
				</div>
				<div class="top-bar-right">
					<ul class="menu">
						<li><input type="search" placeholder="Поиск"/></li>
						<li><button type="button" class="button"><span></span></button></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="top-bar" id="product-panel">
			<!-- <div class="row">
				<h2>Одежда</h2>
				<ul class="menu vertical">
					<li><a href="#">Ботинки</a></li>
					<li><a href="#">Джинсы</a></li>
					<li><a href="#">Кардикан</a></li>
					<li><a href="#">Кеды</a></li>
				</ul>
			</div> -->
		</div>

		<div class="main-spacer"></div>

	<div class="degradation degradation-bottom"></div>



		<!-- форма входа, регистрации, восстановления пароля -->
		<div class="row">
			<div class="reveal" id="login" data-reveal>
				<h4>Вход</h4>
				<form method="post" action="#" name="login">
					<input type="email" name="email" placeholder="E-mail" required/>
					<p hidden class="error ErEmail">Пользователь отсутствует</p>
					<input type="password" name="password" placeholder="Пароль" required/>
					<a href="#" class="losepwd" data-open="losepswd">Забыли пароль?</a>
					<p hidden class="error ErPwrd">Неверный пароль</p>
					<input type="submit" name="send" class="button success expanded" value="Войти"/>
				</form>
				<div class="new_user"><a href="#" data-open="registration">Регистрация нового пользователя</a></div>

				<button class="close-button" data-close type="button" aria-label="Close model">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>


		<div class="row">
			<div class="reveal" id="registration" data-reveal>
				<h4>Регистрация</h4>
				<form method="post" action="php/adduser.php" name="registration">
					<input type="email" name="email" placeholder="E-mail" required/>
					<p hidden class="error ErEmail">E-mail уже зарегистрирован</p>
					<input type="password" name="password1" placeholder="Пароль" pattern='(?=^.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[А-ЯA-Z])(?=.*[а-яa-z]).*' title='Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем. Отсутствует символ "$"' required/>
					<input type="password" name="password2" placeholder="Повторите пароль" pattern='(?=^.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[А-ЯA-Z])(?=.*[а-яa-z]).*' title='Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем. Отсутствует символ "$"' required/>
					<p hidden class="error ErPwrd">Пароли не совпадают</p>
					<input type="text" name="username" placeholder="Ваше имя" pattern='[A-Za-zА-Яа-яЁё\s]+$' title='Имя должно быть с большой буквы и не содержать в себе символом или цифр' required/>
					<p hidden class="error ErName">Имя с большой буквы</p>
					<input type="tel" name="telephone" pattern='^[ 0-9]+$' placeholder="Телефон" required/>
					<input type="submit" name="send" class="button success expanded" value="Зарегистрироваться"/>
				</form>

				<button class="close-button" data-close type="button" aria-label="Close model">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>


		<div class="row">
			<div class="reveal" id="losepswd" data-reveal>
				<h4>Восстановление пароля</h4>
				<form method="post" action="#" name="losepswd">
					<input type="email" name="email" placeholder="E-mail" required/>
					<p hidden class="error">Пользователь отсутствует</p>
					<p hidden class="waiting">Ожидание ответа</p>
					<input type="submit" name="send" class="button success expanded" value="Выслать пароль на E-mail"/>
					<input hidden type="button" name="notice" data-open="sendpswd"/>
				</form>

				<button class="close-button" data-close type="button" aria-label="Close model">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>


		<div class="row">
			<div class="reveal" id="sendpswd" data-reveal>
				<h4>Мы выслали Вам пароль на Эл.почту</h4>
				<button class="button success" data-close type="button" aria-label="Close model">
					Спасибо
				</button>

				<button class="close-button" data-close type="button" aria-label="Close model">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>













		<script src="js/header.js" type="text/javascript"></script>