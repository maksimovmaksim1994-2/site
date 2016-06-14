	
	<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/index.css" type="text/css"/>

	<div class="spacer"> 
		<div class="row">
			<div class="large-4 columns">
				<?php 
					if(!empty($_GET['group']) and !empty($_GET['gender'])) { 
						getGroupDescription($_GET['group'], $_GET['gender']); 
					} elseif(empty($_GET['group']) and !empty($_GET['item'])) {
						getItemDescription($_GET['item']);
					} elseif(empty($_GET['group']) and  empty($_GET['item']) and !empty($_GET['brand']) and !empty($_GET['gender'])) {
						echo "<div class='main-group-description'>Бренды</div>";
					} else {
						if($_GET['gender'] == "for_men") $gender = "Мужчинам";
						if($_GET['gender'] == "for_women") $gender = "Женщинам";
						echo "<div class='main-group-description'>".$gender."</div>";
					};
				?>
			</div>

			<div class="large-3 columns">
				<div class="sort">
					<p>Сортировать по:</p>
					<ul class="menu vertical">
						<li><a data-sort="price-up">возрастанию цены</a></li>
						<li><a data-sort="price-down">убыванию цены</a></li>
						<li><a data-sort="visit">популярности</a></li>
						<li><a data-sort="new">новинкам</a></li>
						<li><a data-sort="discount">скидкам</a></li>
					</ul>
				</div>
			</div>

			<div class="large-5 columns">
				<div hidden class="pagination">
						<!-- <div class="back-button"><a>Назад</a></div> -->			
						<!-- <div class="butt-group">
							<div class="active"><a></a></div>
							<div class="butt"><a></a></div>
							<div class="gap"><a>...</a></div>
						</div> -->
						<!-- <div class="next-button"><a>Дальше</a></div> -->
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="large-3 medium-4 columns side-part-spacer"></div>

		<div class="large-3 medium-4 columns side-part ">

			<div class="side-product">
				<div class="row">
					<ul class="menu vertical item">
					<!-- <ul class="menu vertical item">
						<li><a>Одежда</a>
							<ul class="menu vertical group">
								<li><a>Джинсы</a></li>
								<li><a>Брюки</a></li>
								<li><a>Куртки</a></li>
								<li><a>Польто</a></li>
							</ul>
						</li>
						<li><a>Обувь</a></li>
						<li><a>Аксессуары</a></li>
						<li><a>Бренды</a></li>
					</ul> -->
						<?php addSideMenu() ?>
					</ul>
				</div>
			</div>












			
			<div class='reset-filter'>
				<div>Очистить всё</div>
			</div>

			<div class='accord-block accord-size'>
				<div class='group-name'>Размер<span class="state"></span></div>
				<div class='check-group'>
					<hr/>	
					<?php addSizeToFilter() ?>
				</div>
			</div>

			<div class='accord-block accord-brand'>
				<div class='group-name'>Бренд<span class="state"></span></div>
				<div class='check-group'>
					<hr/>	
					<?php addBrandToFilter() ?>
				</div>
			</div>

			<div class='accord-block accord-material'>
				<div class='group-name'>Материал<span class="state"></span></div>
				<div class='check-group'>
					<hr/>	
					<?php addMaterialToFilter() ?>
				</div>
			</div>

			<div class='accord-block accord-color'>
				<div class='group-name'>Цвет<span class="state"></span></div>
				<div class='check-group'>
					<hr/>	
					<?php addColorToFilter() ?>
				</div>
			</div>

			<div class='accord-block accord-price'>
				<div class='group-name'>Цена<span class="state"></span></div>
				<div class='check-group'>
					<hr/>
					<div class="row">	
						<div class="large-6 columns">
							<span>€</span><input type='text' placeholder='Мин.' name='min-price'/>
						</div>
						<div class="large-6 columns">
							<span>€</span><input type='text' placeholder='Макс.' name='max-price'/>
						</div>
						<div class="large-12">
							<button type='button' class='button'>Применить</button>
						</div>
					</div>
				</div>
			</div>

			
		</div>


		<div class="large-9 medium-8 columns main-part">

			<!-- <div class="product columns">
				<div class="wrap">
					<div class='image'>
						<div class="liked"><div class="hard"></div></div>
						<div class="label-group">
							<div class="new-label">new</div>
							<div class="discount-label">50%</div>
						</div>
						<img src='image/31s6ec2tJx8.jpg' alt=''/>
					</div>
					<div class="info">
						<p class="name">Название</p>
						<p class="desc">Описание</p>
						<p class="price line-through">555<span>€</span></p>
						<p class="price">333<span>€</span></p>
					</div>
				</div>
			</div> -->





		</div>
	</div>
	<div class="row foot-pagination-row">
		<div class="large-7 columns"></div>
		<div class="large-5 columns">
			<div class="pagination"></div>
		</div>
	</div>

	







	<script> showAccordionToggle() </script>
	<script> showProductForGETparametrs() </script>
	<script> checkFilte() </script>
	<script> validPrice() </script>
	<script> resetFilter() </script>
	<script> toggleSideMenu() </script>
	<script> Pagination() </script>
	<script> sort_functions() </script>
	<script> resize() </script>

<!-- 	GET запрос
	alert(location.search); 
	history.pushState(arr, "Title", "?"+str+"&item="+item+"&group="+group);
	-->

	<?php include "php/footer.php" ?> 