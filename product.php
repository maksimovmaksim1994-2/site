	<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/product.css" type="text/css"/>



	<?php addVisit() ?>
	<?php 
		if(!empty($_GET['id']) and !empty($_GET['gender'])) {
			$number = $_GET['id'];
			$gender = $_GET['gender'];
			$product = getProductForPersonalPage($number, $brand);
			/*print_r($product);*/
		};
	?>
	<div class="spacer"></div>
	<div class="row">
		<div class="large-7 columns photo-wrapp">
			<div class="frame">
				<div class="photo-back navigation"><span></span></div>
				<div class="photo-next navigation"><span></span></div>
				<?php
					$src = "image/".$_GET['id']."/".$product['photoMain'];
					echo   "<a href='".$src."'>";
					echo   "<div hidden class='zoom'></div>";
					echo   "<img src='".$src."' alt='".$product['name']."' />";
					echo   "</a>";
				?>
			</div>
			<div class="mini-ph-wrapp">
				<?php
					$src = "image/".$_GET['id']."/".$product['photoMain'];
					echo 	"<a href='".$src."' class='mini-photo active-mini'>
								<img src='".$src."' alt='".$product['name']."' />
							</a>";
					for($i = 0; $i < count($product['photo']); $i++) {
					$src = "image/".$_GET['id']."/".$product['photo'][$i];
					echo 	"<a href='".$src."' class='mini-photo'>
								<img src='".$src."' alt='".$product['name']."' />
							</a>";
					};
				?>
			</div>
		</div>

		<div class="large-5 columns info-wrapp">

			<div class="row">
				<div class="large-6 columns">
					<?php 
						$class = "";
						if($product['discount'] > 0) $class = " line-through";
						echo "<p class='name'>".$product['name']."</p>
							  <p class='shot_description'>".$product['shot_description']."</p>
							  <p class='price".$class."'>".$product['price']."<span>€</span></p>";
						if($product['discount'] > 0) echo  "<p class='discount'>".$product['discount']."<span>€</span></p>";;
					?>
				</div>
				<div class="large-6 columns">
				<?php
					echo "<a href='../?gender=".$_GET['gender']."&brand=".$product['brand']."' class='brand'>".$product['brand']."</a>";
				?>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<a class='size-link' href=''>Таблица размеров</a>
					<div class="size-wrapp">
				<?php  
					$sizeStr = "Выберите размер";
					if(count($product['size']) == 0) {
						$sizeStr = "Нет в наличии";
						$hide = "hidden";
					};
				  echo "<input type='text' data-size='' name='size' value='".$sizeStr."'/>
						<span class='select-arrow ".$hide."'></span>
						";
				?>
						<div hidden class="select-box">
							<?php
								for($i = 0; $i < count($product['size']); $i++) {
									if($product['size'][$i]['sum'] > 0) {
										if($product['size'][$i]['sum'] == 1) $sum = 'Только 1 в наличии';
										elseif($product['size'][$i]['sum'] > 1) $sum = 'Есть в наличии';
										echo "<div class='row size-block'>";
										echo "<div class='large-6 columns'><p>".$product['size'][$i]['size']."</p></div>";
										echo "<div class='large-6 columns sum'><p>".$sum."</p></div>";
										echo "</div>";
									};
								};
							?>
						</div>
					</div>
				</div>
			</div>

			<div class="row butt-group">
				<div class="large-6 columns">
					<div class="to-liked">Добавить в избранные
						<?php 
							$str = "";
							$attr = "false";
							$liked = get_liked();
							if($liked == "") {
					            $str = '';
					        } else {
					            $arr = explode(",", $liked);
					            for($j = 0; $j < 1; $j++) {
					                for($i = 0; $i < count($arr); $i++) {
					                    if($arr[$i] == $_GET['id']) {
					                        $str = ' active-liked';
					                        $attr = 'true';
					                        break(2);
					                    };
					                };
					                $str = '';
					            };
					        };
							echo "<button type='button' class='button".$str."' data-liked='".$attr."' name='addToLiked'>";					        
						?>
							<div class="hard"></div>
							<span>Убрать из избранных</span>
					</div>
				</div>
				<div class="large-6 columns">
				<?php
					echo "<button type='button' data-id-product='".$_GET['id']."' class='button' name='addToBasket'>";
							
				?>
						<span>Добавить в корзину</span>
					</button>
				</div>
			</div>

			<input type="hidden" name='open_my_basket' data-open="show_my_basket"/>
			<div class="row">
				<div class="reveal" id="show_my_basket" data-reveal>
					<h4 class="bask-head"></h4>
					<p>Всего в корзину добавлено: <span class="all-add-to-basket">10 товаров</span></p>
					<div class="row bask-product-wrapp">
						<div class="row">

							<!-- <div class='large-12 block-bask-product'>
								<div class='large-2 columns'>
									<a href='' class='bask-photo'>
										<img src='' alt=''>
									</a>
								</div>

								<div class='large-7 columns'>
									<p class='bask-name'>Имя</p>
									<p class='bask-description'>Описание</p>
									<p class='bask-price line-through'>130 E</p>
									<p class='bask-discount'>100 E</p>
								</div>

								<div class='large-3 columns'>
									<p class='bask-size'>Размер: <span>XXL</span></p>
									<p class='bask-count'>Кол-во: <span>9 шт</span></p>
								</div>
							</div> -->

						</div>
					</div>
					<div class="row button-panel">
						<div class="large-6 columns">
							<button class="button" data-close aria-label="Close model">Закрыть</button>
						</div>
						<div class="large-6 columns">
							<?php echo "<a href='basket.php?gender'".$_GET['gender']."' class='button'>Оформить заказ</a>"; ?>
						</div>
					</div>

					<button class="close-button" data-close type="button" aria-label="Close model">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>


			<div class="row">
				<div class="large-12">
					<div class="tabs">
						<div class="tab is-active-tab" data-tab="tab1">Размер и Крой</div>
						<div class="tab" data-tab="tab2">Состав и Цвет</div>
						<div class="tab" data-tab="tab3">Описание</div>
						<div class="tab" data-tab="tab4">Доставка</div>
						<div id="window">
							<div class="tab-panel is-active-tab" data-panel="tab1">
								<?php
									for($i = 0; $i < count($product['parametr']); $i++) {
										echo "<p>".$product['parametr'][$i]['parametr'].": <span class='value'>".$product['parametr'][$i]['value']."</span></p>";
									};
								?>
							</div>
							<div class="tab-panel" data-panel="tab2">
								<?php
									$str = "";
									for($i = 0; $i < count($product['material']); $i++) {
										if($i == 0) $str .= $product['material'][$i];
										else $str .= ", ".$product['material'][$i];
									};
									echo "<p>Материал: <span class='value'>".$str."</span></p>";

									$str = "";
									for($i = 0; $i < count($product['color']); $i++) {
										if($i == 0) $str .= $product['color'][$i];
										else $str .= ", ".$product['color'][$i];
									};
									echo "<p>Цвет: <span class='value'>".$str."</span></p>";

								?>
							</div>
							<div class="tab-panel" data-panel="tab3">
								<?php
									echo "<p><b>ID товара:</b> ".$product['id']."</p>";
									echo "<p><b>Описание:</b> ".$product['description']."</p>";
								?>
							</div>
							<div class="tab-panel" data-panel="tab4">
								<p>Ваш заказ будет доставлен напрямую из бутика.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="row">
		<div class="large-7 message columns">

			<div class="tabs">
				<div class="tab is-active-tab" data-tab="comment">Отзывы</div>
				<div class="tab" data-tab="question">Вопросы</div>
				<?php $login = whoLogin(); ?>
				<?php 
					$state = "false";
					if(!empty($login['email'])) $state = "true";
					echo "<div class='button-to-message button' state='".$state."'>Оставить отзыв</div>";
				?>
					
				<div id="window">
					<div class="write-message">
						<form name='sendMessage'>
							<div class="row">
								<div class="large-6 columns">
									<?php
									if(!empty($login['email'])) {
										echo "<input type='text' name='name' value='".$login['name']." ".$login['surname']."' required/>";
										echo "<input type='email' name='email' value='".$login['email']."' required/>";
										echo "<input type='hidden' name='id_user' value='".$login['id']."'/>";
										echo "<input type='hidden' name='id_product' value='".$_GET['id']."'/>";
									} else echo "<p>Сперва зарегистрируйтесь, или войдите в свой профиль</p>";
									?>
								</div>
								<div class="large-6 columns">
									<?php
									if(!empty($login['email'])) {
										echo "<input type='submit' class='button' value='Отправить'/>";
									};
									?>
								</div>
							</div>
								<?php
									if(!empty($login['email'])) {
									echo "<textarea name='text-message' required></textarea>";
								};
								?>
						</form>
					</div>
					<div class="tab-panel is-active-tab" data-panel="comment">
						<p><i>Здесь Вы можете оставить свой отзыв</i></p>

						<div class="row">
							<?php show_product_comment($_GET['id']) ?>	
						</div>	

					</div>
					<div class="tab-panel" data-panel="question">
						<p><i>Здесь Вы можете задать Нам вопрос, и администрация ответит Вам в ближайшее время</i></p>	

						<div class="row">
							<?php show_product_question($_GET['id']) ?>	
						</div>	

					</div>
				</div>
			</div>

		</div>
		
		<div class="large-5 columns"></div>

	</div>




	<script> changePhoto(); </script>
	<script> changeSize(); </script>
	<script> buttons(); </script>
	<script> reclickTabs(); </script>
	<script> zoomPhoto(); </script>
	<script> writeMessage(); </script>




	<?php include "php/footer.php" ?> 