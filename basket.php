		<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/basket.css" type="text/css"/>
	<link rel="stylesheet" href="style/select.css" type="text/css"/>
	<script src="js/select.js" type="text/javascript"></script>



	<div hidden class="row notification-for-order">
		<div class="large-12">
			<p>Ваш заказ принят. Мы свяжемся с Вами в ближайшее время для уточнения деталей заказа.</p>
			<?php echo "<a href='orders.php?gender=".$_GET['gender']."' class='button'>Мои заказы</a>"; ?>
		</div>
	</div>


	<?php
	    $count = 0;
	    $all_price_in_basket = 0;
		if(!empty($_SESSION['email'])) {
			$email = $_SESSION['email'];
			$basket = get_my_basket($email, 'return');

	        for($i = 0; $i < count($basket); $i++) {
	            $count += $basket[$i]['count'];
	            	
	            if($basket[$i]['discount'] != 0 && $basket[$i]['discount'] != "") {
					$price = $basket[$i]['discount'];
				} else {
					$price = $basket[$i]['price'];
				};
				$all_price_in_basket += $price * $basket[$i]['count'];
	        };
		};
	?>

    <div class="row">
		<div class="large-8 columns" id="show_my_basket">
			<div class="row head-bask">
				<div class="large-6 columns">
					<p>Всего в корзину добавлено: <span class="all-add-to-basket"> <?php echo $count ?> <?php echo word_declination($count) ?></span></p>
				</div>
				<div class="large-6 columns">
					<p>Итого: <span class="all-price-in-basket"> <?php echo $all_price_in_basket ?> €</span></p>
				</div>
			</div>
			<div class="row bask-product-wrapp">

				<!-- <div class='large-12 block-bask-product'>
					<div class='large-2 columns'>
						<a href='' class='bask-photo'>
							<img src='' alt=''>
						</a>
					</div>

					<div class='large-6 columns'>
						<p class='bask-name'>Имя</p>
						<p class='bask-description'>Описание</p>
						<p class='bask-price line-through'>130 E</p>
						<p class='bask-discount'>100 E</p>
					</div>

					<div class='large-4 columns'>
						<p class='bask-size'>Размер: <span>XXL</span></p>
						<p class='bask-count'>Кол-во: 
							<span class='size-counter less'></span>
							<span>9 шт</span>
							<span class='size-counter more'></span>
						</p>
						<p class='bask-all-price'>Всего: <span>1300 Е</span></p>
					</div>
				</div> -->


				<?php
					for($i = count($basket) - 1; $i > -1 ; $i--) {
						$discountStr = "";
						if($basket[$i]['discount'] != 0 && $basket[$i]['discount'] != "") {
							$price = $basket[$i]['discount'];
							$priceClass = "bask-price line-through";
							$discountStr = "<p class='bask-discount'>".$basket[$i]['discount']." €</p>";
						} else {
							$price = $basket[$i]['price'];
							$priceClass = "bask-price";
						};
						$minLimiter = "";
						$maxLimiter = "";
						if($basket[$i]['count'] == 1) $minLimiter = "limit-on";
						if($basket[$i]['count'] >= $basket[$i]['maxCount']) $maxLimiter = "limit-on";

						echo   "<div class='large-12 block-bask-product' data-id-product='".$basket[$i]['id']."'>
									<div class='bask-delete'><span>+</span></div>
									<div class='large-2 medium-2 small-2 columns'>
										<a href='http://aleksa/product.php?gender=".$_GET['gender']."&id=".$basket[$i]['id']."' class='bask-photo'>
											<img src='image/".$basket[$i]['id']."/".$basket[$i]['photoMain']."' alt='".$basket[$i]['shot_description']."'>
										</a>
									</div>

									<div class='large-5 medium-5 small-4 columns'>
										<p class='bask-name'>".$basket[$i]['name']."</p>
										<p class='bask-description'>".$basket[$i]['shot_description']."</p>
										<p class='".$priceClass."' data-price='".$price."'>".$basket[$i]['price']." €</p>".$discountStr."
									</div>

									<div class='large-5 medium-5 small-6 columns'>
										<p class='bask-size'>Размер: <span>".$basket[$i]['size']."</span></p>
										<p class='bask-count' data-count='".$basket[$i]['count']."'>Кол-во: 
											<span class='size-counter less ".$minLimiter."'></span>
											<span>".$basket[$i]['count']." шт</span>
											<span class='size-counter more ".$maxLimiter."'></span>
										</p>
										<p class='bask-all-price'>Всего: <span>".$price*$basket[$i]['count']." €</span></p>
									</div>
								</div>";
					};
				?>

			</div>
		</div>

<?php $login = whoLogin(); ?>
<?php
	if(!empty($login['email'])) {
		if($count > 0) $submit = "<input type='submit' class='button expanded' value='Отправить заказ'/>";
		echo "
		<div class='large-4 columns main-form'>
			<h4>Оформление заказа</h4>
			<hr/>
			<form name='checkout'>
				<input type='hidden' name='id_user' value='".$login['id']."' required/>
				<p><b>Имя</b></p>
				<input type='text' name='name' value='".$login['name']." ".$login['surname']."' required/>
				<div class='both'></div>
				<p><b>Телефон</b></p>
				<input type='tel' name='tel' value='".$login['tel']."' required/>
				<div class='both'></div>
				<p><b>Электронная почта</b></p>
				<input type='email' name='email' value='".$login['email']."' required/>
				<div class='both'></div>
				<p>Комментарий</p>
				<textarea name='comment' placeholder='Здесь вы можете оставить совй комментарий к заказу или дополнительную информацию'></textarea>
				
				<div class='large-12 in-total'>
					<div class='large-12 columns'>
						<h4>Итого: <span class='checkout-str'>".$count." ".word_declination($count)." на сумму ".$all_price_in_basket." €<span></h4>
					</div>
					<div class='large-6 small-6 columns'>
						<p>Вариант оплаты</p>
						<select>
							<option>При получении</option>
						</select>
					</div>
					<div class='large-6 small-6 columns checkout-result'>
						<p>Доставка: <span>Бесплатно</span></p>
						<p><b>Итого: <span class='end-price'>".$all_price_in_basket." €</span></b></p>
					</div>
					<div class='large-12 columns'>
						".$submit."
					</div>
				</div>
			</form>

		</div>
		";
	};
?>

	</div>





	<script> option(); </script>
	<script> change_sum_product(); </script>
	<script> delete_product_from_bask(); </script>
	<script> read_only(); </script>
	<script> make_an_order(); </script>







	<?php include "php/footer.php" ?> 