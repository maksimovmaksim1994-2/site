<?php echo "<div class='tabs-panel ".$active1."' id='panel1'>"; ?>
					<div class="row">	
						<div class="large-12 hd columns">
							<h3>Добавить новый товар</h3>
						</div>
					</div>

					<div class="row">

						<div class="large-3 columns">
							<div class="large-12" columns>
								<form method="post" enctype="multipart/form-data" action="php/add_new_product.php" name="addProduct">
									<div class="row">
										<div class="large-12 columns">
											<p>Название</p>
											<input type="text" name="name" placeholder="Куртка" required/>
										</div>
									</div>
							</div>
						</div>


						<div class="large-3 columns">
							<div class="large-12" columns>
								<div class="row">
									<div class="large-12 columns">
										<p>Краткое описание</p>
										<input type="text" name="shot_description" placeholder="Куртка летняя женская" required/>
									</div>
								</div>
							</div>
						</div>


						<div class="large-3 columns">
							<div class="large-12" columns>
								<div class="row">
									<div class="large-12 columns">
										<p>Описание</p>
										<textarea name="description" placeholder="Детальное описание..." required/></textarea>
									</div>
								</div>
							</div>
						</div>



						<div class="large-3 columns">
							<div class="large-12" columns>
								<div class="row">
									<div class="large-12 columns">
										<p>Цена (EUR)</p>
										<input type="text" name="price" placeholder="EUR" pattern='\d+(\.\d{2})?' title='Формат: N или N.N' required/>
									</div>
								</div>
							</div>
						</div>

					</div>

						<hr/>

					<div class="row">

						<div class="large-12 columns">
							<div class="large-12" columns>
								<div class="row">

									<div class="large-3 columns">
										<p>Пункт меню</p>
										<select name="item" required/>
											<?php addItemsMenu() ?>
										</select>
									</div>

									<div class="large-3 columns">
										<p>Пол</p>
										<select name="gender" required/>
											<option>Выберите пол</option>
											<option>Мужской</option>
											<option>Женский</option>
										</select>
									</div>

									<div class="large-3 columns" hidden>
										<p>Выберите группу</p>
										<select name="group" />
											<option>Выберите группу</option>
										</select>
									</div>

									<div class="large-3 columns" hidden>
										<p>Выберите бренд</p>
										<select name="brand" />
											<option>Выберите Бренд</option>
										</select>
									</div>

								</div>
							</div>
						</div>
					</div>

					
					<hr/>

					
					<div class="row">

						<div class="large-12 columns">
							<div class="large-12" columns>
								<div class="row">

									<div class="large-3 columns">
										<p>Материал</p>
										<div class="checkbox-wrapp">
											<?php showMaterial() ?>
										</div>
										<input type="hidden" name="materialAll"/>
									</div>

									<div class="large-3 columns">
										<p>Цвет</p>
										<div>
											<div class="checkbox-wrapp">
												<?php showColor() ?>
											</div>
										</div>
										<input type="hidden" name="colorAll"/>
									</div>

									<div class="large-3 columns">
										<p>Размер</p>
										<div>
											<div class="checkbox-wrapp">												
													<?php showSize() ?>
											</div>
										</div>
										<input type="hidden" name="sizeAll"/>
									</div>

									<div class="large-3 columns">
										<p>Параметры</p>
										<div>
											<div class="checkbox-wrapp">												
													<?php showPerametr() ?>
											</div>
										</div>
										<input type="hidden" name="parametrAll"/>
									</div>

								</div>
							</div>
						</div>
					</div>



					<hr/>

					

					<div class="row">

						<div class="large-12 columns">
							<div class="large-12" columns>
								<div class="row">

									<div class="large-12 columns">
										<p>Главное фото</p>
										<input type="file" accept="image/*,image/jpeg" name="photoMain" required/>
									</div>

									<div class="large-12 columns">
										<p>Остальные фото</p>
										<input type="file" multiple accept="image/*,image/jpeg" name="photo[]" required/>
									</div>

								</div>
							</div>
						</div>
					</div>



					<hr/>






						
					<div class="row">
						<div class="large-3 columns">
							<input type="submit" name="sendProduct" class="button secondary" value="Добавить товар"/>
						</div>
					</div>
				</form>
</div>





<script> showGroupForAddProduct(); </script> 
<script> validateSendProduct(); </script> 
<script> showSizeSum(); </script> 
<script> showParametrInput(); </script>
