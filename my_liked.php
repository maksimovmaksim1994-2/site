	<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/my_liked.css" type="text/css"/>

	<?php
	    $count = 0;
		if(!empty($_SESSION['email'])) {
			$email = $_SESSION['email'];
			$liked = get_my_liked($email);

	        for($i = 0; $i < count($liked); $i++) {
	            $count = count($liked);
	        };
		};
	?>

    <div class="row main-wrapp">
    	<div class="large-2 columns"></div>
		<div class="large-8 columns" id="show_my_liked">
			<div class="row head-liked">
				<div class="large-6">
					<h4>Избранные</h4>
				</div>
				<div class="large-12">
					<p>Всего было добавленно:  <?php echo $count ?> <?php echo word_declination($count) ?></span></p>
				</div>
			</div>
			<div class="row liked-product-wrapp">

				<?php
					for($i = count($liked) - 1; $i > -1 ; $i--) {
						$discountStr = "";
						if($liked[$i]['discount'] != 0 && $liked[$i]['discount'] != "") {
							$price = $liked[$i]['discount'];
							$priceClass = "liked-price line-through";
							$discountStr = "<p class='liked-discount'>".$liked[$i]['discount']." €</p>";
						} else {
							$price = $liked[$i]['price'];
							$priceClass = "liked-price";
						};

						$allSize = "";
						for($j = 0; $j < count($liked[$i]['size']); $j++) {
							if($j == 0) $allSize .= $liked[$i]['size'][$j];
							else $allSize .= ", ".$liked[$i]['size'][$j];
						};
						if(count($liked[$i]['size']) == 0) $allSize = "Нет в наличии";

						echo   "<div class='large-12 block-liked-product'>
									<div class='large-2 medium-2 small-3 columns'>
										<a href='http://aleksa/product.php?gender=".$_GET['gender']."&id=".$liked[$i]['id']."' class='liked-photo'>
											<img src='image/".$liked[$i]['id']."/".$liked[$i]['photoMain']."' alt='".$liked[$i]['shot_description']."'>
										</a>
									</div>

									<div class='large-6 medium-6 small-3 columns'>
										<p class='liked-name'>".$liked[$i]['name']."</p>
										<p class='liked-description'>".$liked[$i]['shot_description']."</p>
										<p class='".$priceClass."' >".$liked[$i]['price']." €</p>".$discountStr."
									</div>

									<div class='medium-4 small-6 columns'>
										<p class='liked-size'>Размер: <span>".$allSize."</span></p>
									</div>
								</div>";
					};
				?>

			</div>
		</div>

		<div class="large-2 columns"></div>


	</div>







	<?php include "php/footer.php" ?> 