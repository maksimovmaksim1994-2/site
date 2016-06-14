<?php echo "<div class='tabs-panel ".$active6."' id='panel6'>"; ?>
				<div class="row">
					<div class="large-12 columns time-interval">
						<div class="large-4 columns">
							<p>Статистика с </p> 
							<input type='date' name='time-begin'/> 
						</div>
						<div class="large-4 columns">
							<p> по </p> 
							<input type='date' name='time-end'/>
						</div>
						<div class="large-4 columns">
							<p></p>
							<button type='button' class='button secondary expanded'>Показать</button>
						</div>
					</div>

					<div class="large-12 columns">
						<table class='main-table'>
							<tr class='table-hd'>
								<th>id</th>
								<th>Имя</th>
								<th>Цена</th>
								<th>Скидка</th>
								<th>Пол</th>
								<th>Бренд</th>
								<th>Цвет</th>
								<th>Размер</th>
								<th>Колличество</th>
								<th>Дата</th>
							</tr>
						</table>
					</div>

					<div class="large-12 columns">
						<table class='table-message'>

						</table>
					</div>

				</div>
						
					
</div>

<script> show_statistic(); </script>