<?php echo "<div class='tabs-panel ".$active3."' id='panel3'>"; ?>
						<div class="row">
						<div class="large-6 columns">
							<div class="large-12 hd columns">
								<h3>Добавить пункт меню</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="php/add_new_menu_item.php" name="addItem">
									<div class="row">

										<div class="large-6 columns">
										<p>Название пункта</p>
										<input type="text" name="nameItem" placeholder="Новинки" required/>
										</div>

										<div class="large-6 columns">
										<p>Описание</p>
										<input type="text" name="desciptionItem" placeholder="Последние новинки" required/>
										</div>


									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendItem" class="button secondary" value="Добавить пункт"/>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<div class="large-6 columns">
							<div class="large-12 hd columns">
								<h3>Удалить пункт меню</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" action="#" name="removeItem">
									<div class="row">

										<div class="large-6 columns">
											<p>Выберите пункт</p>
											<select name="nameItem" required/>
												<?php addItemsMenu() ?>
											</select>
										</div>	

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="removeItem" class="button secondary" value="Удалить пункт"/>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<hr/>


						<div class="large-12 columns">
							<div class="large-6 hd">
								<h3>Добавить группу в пункт меню</h3>
							</div>

							<div class="large-12" columns>
								<form method="post" name="addClass" action="php/add_new_class.php">
									<div class="row">

										<div class="large-3 columns">
										<p>Название класса</p>
										<input type="text" name="nameClass" placeholder="Куртки" required/>
										</div>

										<div class="large-3 columns">
										<p>Описание</p>
										<input type="text" name="desciptionClass" placeholder="Куртки мужские тёплые" required/>
										</div>

										<div class="large-3 columns">
										<p>Пункт меню</p>
										<select name="itemMenuClass" required/>
											<?php addItemsMenu() ?>
										</select>
										</div>

										<div class="large-3 columns">
										<p>Пол</p>
										<select name="genderClass" required/>
											<option>Выберите пол</option>
											<option>Мужской</option>
											<option>Женский</option>
										</select>
										</div>

									</div>
									<div class="row">
										<div class="large-3 columns">
											<input type="submit" name="sendClass" class="button secondary" value="Добавить группу"/>
										</div>
									</div>
								</form>
							</div>
						</div>


						<hr/>



						<div class="large-12 columns">
								<div class="large-6 hd">
									<h3>Удалить группу из пункта меню</h3>
								</div>

								<div class="large-12" columns>
									<form method="post" name="removeClass" action="php/remove_group.php">
										<div class="row">

											<div class="large-3 columns">
											<p>Пункт меню</p>
											<select name="removeClassItem" required/>
												<?php addItemsMenu() ?>
											</select>
											</div>

											<div class="large-3 columns">
											<p>Пол</p>
											<select name="removeClassGender" required/>
												<option>Выберите пол</option>
												<option>Мужской</option>
												<option>Женский</option>
											</select>
											</div>

											<div class="large-3 columns" hidden>
											<p>Выберите группу</p>
												<select name="removeClassName" />
													<option>Выберите группу</option>
												</select>
											</div>

											<div class="large-3 columns"></div>

										</div>
										<div class="row">
											<div class="large-3 columns">
												<input type="submit" name="removeClass" class="button secondary" value="Удалить группу"/>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>

					<script> validateClassForm(); </script>
					<script> checkItemToRemove(); </script> 
					<script> checkClassToRemove(); </script> 
