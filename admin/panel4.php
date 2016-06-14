<?php echo "<div class='tabs-panel ".$active4."' id='panel4'>"; ?>
					<div class="row">
						<div class="large-4 columns">
							<div class="large-12 hd columns">
								<h3>Добавить бренд</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_brand.php" name="addNewBrand">
									<div class="row">

										<div class="large-6 columns">
											<p>Название бренда</p>
											<input type="text" name="nameBrand" placeholder="Prado" required/>
										</div>

										<div class="large-6 columns">
										<p>Пол</p>
										<select name="genderBrand" required/>
											<option>Выберите пол</option>
											<option>Мужской</option>
											<option>Женский</option>
										</select>
										</div>

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendBrand" class="button secondary" value="Добавить бренд"/>
										</div>
									</div>
								</form>
							</div>
						</div>


						
						<div class="large-4 columns">
							<div class="large-12 hd columns">
								<h3>Добавить цвет</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_color.php" name="addNewColor">
									<div class="row">

										<div class="large-8 columns">
											<p>Название цвета</p>
											<input type="text" name="nameColor" placeholder="Бирюзовый" required/>
										</div>

										<div class="large-4 columns">
											<p>Цвет</p>
											<input type="color" name="codeColor" required/>
										</div>

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendColor" class="button secondary" value="Добавить цвет"/>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="large-4 columns">
							<div class="large-12 hd columns">
								<h3>Добавить материал</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_material.php" name="addNewMaterial">
									<div class="row">

										<div class="large-12 columns">
											<p>Название материала</p>
											<input type="text" name="nameMaterial" placeholder="Трикотаж"required/>
										</div>	

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendMaterial" class="button secondary" value="Добавить материал"/>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>


					<hr/>


					<div class="row">
						<div class="large-4 columns">
							<div class="large-12 hd columns">
								<h3>Добавить параметр</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_parametr.php" name="addNewParametr">
									<div class="row">

										<div class="large-12 columns">
											<p>Название параметра</p>
											<input type="text" name="nameParametr" placeholder="Объём груди" required/>
										</div>	

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendParametr" class="button secondary" value="Добавить параметр"/>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="large-4 columns">
							<div class="large-12 hd columns">
								<h3>Добавить размер</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_size.php" name="addNewSize">
									<div class="row">

										<div class="large-12 columns">
											<p>Размер</p>
											<input type="text" name="nameSize" placeholder="42" required/>
										</div>	

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendSize" class="button secondary" value="Добавить размер"/>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="large-8 columns">
						</div>



					</div>
						
					
</div>

<script> validateBrand() </script>
