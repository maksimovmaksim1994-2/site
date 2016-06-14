			<div class="row">
				<div class="large-3 columns list">
					<ul class="menu vertical" data-hide-for="medium">
						<li><b>ФИО</b></li>
						<li><b>Эл.почта</b></li>
						<li><b>Моб.телефон</b></li>
						<li>Дата рождения</li>
						<li>Пол</li>
					</ul>
				</div>

				<?php 
				$email;
				$telephone;
				$username;
				$surname;
				$middlename;
				$birthday;
				$sex;
				giveMyInfo(); 
				?>

				<div class="large-9 columns form">
					<form method="post" action="php/save_my_info.php">
						<ul class="menu vertical">
							<li>
							<?php
							echo "<input type='text' name='username' placeholder='Имя' value='".$username."' required/>
								<input type='text' name='surname' value='".$surname."' placeholder='Фамиллия'/>
								<input type='text' name='middlename' value='".$middlename."' placeholder='Отчество'/>
								";
							?>
							</li>
							<li>
							<?php
							echo "<input type='email' name='email' value='".$email."' placeholder='E-mail' required/>";
							echo "<input type='hidden' name='oldEmail' value='".$email."'/>";
							?>
							</li>
							<li>
							<?php
							echo "<input type='tel' name='telephone' value='".$telephone."' placeholder='+38' required/>";
							?>
							</li>
							<li>
								<select name="day">
								</select>

								<script> addOntionsDays();</script>

								<select name="month">
									<option>Месяц</option>
									<option>Января</option>
									<option>Февраля</option>
									<option>Марта</option>
									<option>Апреля</option>
									<option>Мая</option>
									<option>Июня</option>
									<option>Июля</option>
									<option>Августа</option>
									<option>Сентября</option>
									<option>Октября</option>
									<option>Ноября</option>
									<option>Декабря</option>
								</select>

								<select name="year">
								</select>
								<?php
								echo "<input type='hidden' name='date' value='".$birthday."'>";
								?>

								<script> addOntionsYears(); </script>

							</li>
							<li>
								<button type="button" class="button secondary gender men">Мужской</button>
								<button type="button" class="button secondary gender women">Женский</button>

								<?php
								echo "<input type='hidden' name='gender' value='".$sex."'>";
								?>

								<script> setGender(); </script>
								<script> showGender(); </script>

							</li>
							<li>
								<input type="submit" name="send" class="button success small" value="Сохранить">
							</li>
						</ul>
					</form>
				</div>
			</div>

		</div>
	</div>

<script>
	decodeDate();
	encodeDate();
</script>