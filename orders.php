		<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/orders.css" type="text/css"/>


	<?php
	    $count = 0;
		if(!empty($_SESSION['email'])) {
			$email = $_SESSION['email'];
			$orders = get_my_orders($email);

	        for($i = 0; $i < count($orders); $i++) {
	            $count += $orders[$i]['count'];
	        };
		};
	?>

    <div class="row main-wrapp">
    	<div class="large-2 columns"></div>
		<div class="large-8 columns" id="show_my_orders">
			<div class="row head-orders">
				<div class="large-6">
					<h4>Мои покупки</h4>
				</div>
				<div class="large-12">
					<p>Всего было заказанно:  <?php echo $count ?> <?php echo word_declination($count) ?></span></p>
				</div>
			</div>
			<div class="row orders-product-wrapp">

				<?php
					for($i = count($orders) - 1; $i > -1 ; $i--) {
						$discountStr = "";
						if($orders[$i]['discount'] != 0 && $orders[$i]['discount'] != "") {
							$price = $orders[$i]['discount'];
							$priceClass = "orders-price line-through";
							$discountStr = "<p class='orders-discount'>".$orders[$i]['discount']." €</p>";
						} else {
							$price = $orders[$i]['price'];
							$priceClass = "orders-price";
						};

						echo   "<div class='large-12 block-orders-product'>
									<div class='large-2 medium-2 small-2 columns'>
										<a href='http://aleksa/product.php?gender=".$_GET['gender']."&id=".$orders[$i]['id']."' class='orders-photo'>
											<img src='image/".$orders[$i]['id']."/".$orders[$i]['photoMain']."' alt='".$orders[$i]['shot_description']."'>
										</a>
									</div>

									<div class='large-6 medium-6 small-4 columns'>
										<p class='orders-name'>".$orders[$i]['name']."</p>
										<p class='orders-description'>".$orders[$i]['shot_description']."</p>
										<p class='".$priceClass."' >".$orders[$i]['price']." €</p>".$discountStr."
									</div>

									<div class='medium-4 small-6 columns'>
										<p class='orders-size'>Размер: <span>".$orders[$i]['size']."</span></p>
										<p class='orders-count'>Кол-во: 
											<span>".$orders[$i]['count']." шт</span>
										</p>
										<p class='orders-all-price'>Всего: <span>".$price*$orders[$i]['count']." €</span></p>
									</div>
								</div>";
					};
				?>

			</div>
		</div>

		<div class="large-2 columns"></div>


	</div>









	<?php include "php/footer.php" ?> 