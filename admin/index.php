	
	<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/index.css" type="text/css"/>


		<div class="row">
			<div class="large-12 columns">
				<ul class="tabs" id="example-tabs" data-tabs>
					<?php $panel = $_GET['panel']; ?>
					<?  if($panel == 1) $active1 = 'is-active';
						if($panel == 2) $active2 = 'is-active';
						if($panel == 3) $active3 = 'is-active';
						if($panel == 4) $active4 = 'is-active';
						if($panel == 5) $active5 = 'is-active';
						if($panel == 6) $active6 = 'is-active';
				echo "	<li class='tabs-title ".$active1."'><a href='#panel1' area-selected='true'>Добавить продукт</a></li>
						<li class='tabs-title ".$active2."'><a href='#panel2' area-selected='true'>Редактировать продукт</a></li>
						<li class='tabs-title ".$active3."'><a href='#panel3' area-selected='true'>Управление меню</a></li>
						<li class='tabs-title ".$active4."'><a href='#panel4' area-selected='true'>Пункты товаров</a></li>
						<li class='tabs-title ".$active5."'><a href='#panel5' area-selected='true'>Сообщения</a></li>
						<li class='tabs-title ".$active6."'><a href='#panel6' area-selected='true'>Статистика</a></li>
					";
					?>
				</ul>

				<div class="tabs-content" data-tabs-content="example-tabs">

					<?php include "panel1.php" ?>

					<?php include "panel2.php" ?>

					<?php include "panel3.php" ?>

					<?php include "panel4.php" ?>

					<?php include "panel5.php" ?>

					<?php include "panel6.php" ?>

				</div>
			</div>
		</div>









	<?php include "php/footer.php" ?> 