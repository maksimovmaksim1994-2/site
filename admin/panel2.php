<?php echo "<div class='tabs-panel ".$active2."' id='panel2'>"; ?>

					<div class="row">	
						<div class="large-5 hd columns">
							<h3>Введите артикуль товара</h3>
							<a class="link-product"></a>
						</div>
						<div class="large-3 columns">
							<input type="text" name="articul" placeholder="Арт." pattern='\d?' required/>
						</div>
						<div class="large-3 columns">
							<button type="button" class="button secondary" name="setArticul"> Запомнить артикуль </button>
						</div>
					</div>

					<hr/>

					<div hidden class="main-wrapper">
						<div hidden class="waiting">Подождите, идёт передача данных...</div>
						<div class="row">	
							<div class="large-6 hd columns">
								<h3>Добавить скидку</h3>
							</div>
							<div class="large-6 hd columns"></div>
						</div>

						<div class="row">

							<div class="large-12 columns">
								<div class="large-3 columns">
									<form method="post" action="php/add_discount.php" name="addDiscount">
										<div class="row">
											<div class="large-12 columns">
												<p>Скидка (EUR)</p>
												<p>(укажите цену уже со скидкой)</p>
												<input type="text" name="discount" placeholder="EUR" pattern='\d+(\.\d{2})?' title='Формат: N или N.N' required/>
												<input type="hidden" name="id" required/>
												<input type="submit" name="sendDiscount" class="button secondary" value="Добавить скидку"/>
											</div>
										</div>
									</form>
								</div>

								<div class="large-3 columns">  </div>

							</div>


						</div>
						
						<hr/>

					</div>

					

				
</div>





<script> addArticul() </script> 

