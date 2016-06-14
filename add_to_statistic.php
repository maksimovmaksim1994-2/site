		<?php include "php/header.php" ?> 
	<link rel="stylesheet" href="style/add_to_statistic.css" type="text/css"/>

	<div class="row">.</div>

	<div class="row main-row">
		<form method='post' action='php/add_to_statistic_func.php'>
		<div class="large-4 columns">
			<p>Имя</p>
			<select name='name' required>
				<option>Футболка</option>
				<option>Поло</option>
				<option>Куртка</option>
				<option>Жилет</option>
				<option>Пуховик</option>
				<option>Плащ</option>
				<option>Ветровка</option>
				<option>Кожанка</option>
				<option>Брюки</option>
				<option>Брюки спортивные</option>
				<option>Чиносы</option>
				<option>Джинсы</option>
				<option>Толстовка</option>
				<option>Свитшот</option>
				<option>Олимпийка</option>
				<option>Рубашка</option>
				<option>Пиджак</option>
				<option>Джемпер</option>
				<option>Кардиган</option>
				<option>Пуловер</option>
				<option>Спортивный костюм</option>
				<option>Шорты</option>
				<option>Майка</option>
				<option>Туфли</option>
				<option>Кросовки</option>
				<option>Кеды</option>
				<option>Бутсы</option>
				<option>Ботинки</option>
				<option>Слипоны</option>
				<option>Макасины</option>
				<option>Сумка</option>
				<option>Чехол</option>
				<option>Рюкзак</option>
				<option>Очки</option>
				<option>Ремень</option>
				<option>Платье</option>
				<option>Блузка</option>
				<option>Юбка</option>
				<option>Топ</option>
				<option>Купальник</option>
				<option>Лоферы</option>
				<option>Баллетки</option>
				<option>Кеды</option>
				<option>Боссоножки</option>
				<option>Рюкзак</option>
				<option>Кошелёк</option>
				<option>Зонт</option>
				<option>Платок</option>

		<!-- 		<option>____МУЖЧИНАМ</option>
				<option>____Одежда</option>
				<option>Футболка</option>
				<option>Поло</option>
				<option>Куртка</option>
				<option>Жилет</option>
				<option>Пуховик</option>
				<option>Плащ</option>
				<option>Ветровка</option>
				<option>Кожанка</option>
				<option>Брюки</option>
				<option>Брюки спортивные</option>
				<option>Чиносы</option>
				<option>Джинсы</option>
				<option>Толстовка</option>
				<option>Свитшот</option>
				<option>Олимпийка</option>
				<option>Рубашка</option>
				<option>Пиджак</option>
				<option>Джемпер</option>
				<option>Кардиган</option>
				<option>Пуловер</option>
				<option>Спортивный костюм</option>
				<option>Шорты</option>
				<option>Майка</option>
				<option>____Обувь</option>
				<option>Туфли</option>
				<option>Кросовки</option>
				<option>Кеды</option>
				<option>Бутсы</option>
				<option>Ботинки</option>
				<option>Слипоны</option>
				<option>Макасины</option>
				<option>____Аксессуары</option>
				<option>Сумка</option>
				<option>Чехол</option>
				<option>Рюкзак</option>
				<option>Очки</option>
				<option>Ремень</option>
				<option>____ЖЕНЩИНАМ</option>
				<option>Платье</option>
				<option>Блузка</option>
				<option>Юбка</option>
				<option>Топ</option>
				<option>Купальник</option>
				<option>____Обувь</option>
				<option>Лоферы</option>
				<option>Баллетки</option>
				<option>Кеды</option>
				<option>Боссоножки</option>
				<option>____Аксессуары</option>
				<option>Рюкзак</option>
				<option>Кошелёк</option>
				<option>Зонт</option>
				<option>Платок</option> -->

			</select>
		</div>

		<div class="large-4 columns">
			<p>Цена</p>
			<input type='number' name='price' required>
		</div>

		<div class="large-4 columns">
			<p>Скидка</p>
			<input type='number' name='discount' value='0' required>
		</div>

		<div class="large-4 columns">
			<p>Пол</p>
			<select name='gender' required>
				<option>Мужской</option>
				<option>Женский</option>
			</select>
		</div>

		<div class="large-4 columns">
			<p>Бренд</p>
			<select name='brand' required>
				<option>Prada</option>
				<option>Giorgio Armani</option>
				<option>Gucci</option>
				<option>Dolce & Gabbana</option>
				<option>Group of Benetton</option>
				<option>Diesel</option>
				<option>Versace</option>
				<option>Moshino</option>
				<option>Fendi</option>
				<option>Miu Miu</option>
				<option>Massimo Rebbecchi</option>
				<option>Laura Biagiotti</option>
				<option>Patrizia Pepe</option>
				<option>Gaudi</option>
				<option>Donatella de Pauli</option>
				<option>Francesca by Sottini</option>
				<option>Julia Garnett</option>
				<option>Bojji</option>
				<option>Brioni</option>
				<option>Camicissima</option>
				<option>Corneliani</option>
				<option>Del Siena</option>
				<option>Bagutta</option>
				<option>Kossa</option>
				<option>Paran</option>
				<option>Acquafredda</option>
				<option>Bagatelle</option> 
				<option>Enrico coveri</option>
				<option>Jonh Barritt</option>
				<option>Caporiccio</option>
				<option>Del mare</option>
				<option>Abital</option>
				<option>Bagatelle</option> 
			</select>
		</div>

		<div class="large-4 columns">
			<p>Цвет</p>
			<select name='color' required>
				<option>Бежевый</option>
				<option>Белый</option>
				<option>Берюзовый</option>
				<option>Бронзовый</option>
				<option>Бордовый</option>
				<option>Голубой</option>
				<option>Жёлтый</option>
				<option>Зелёный</option>
				<option>Золотой</option>
				<option>Коричневый</option>
				<option>Красный</option>
				<option>Молочный</option>
				<option>Мультиколор</option>
				<option>Оранжевый</option>
				<option>Прозрачный</option>
				<option>Розовый</option>
				<option>Серебряный</option>
				<option>Серый</option>
				<option>Синий</option>
				<option>Фиолетовый</option>
				<option>Хаки</option>
				<option>Чёрный</option>
			</select>
		</div>

		<div class="large-4 columns">
			<p>Кол-во</p>
			<input type='number' name='count' value='1' required>
		</div>

		<div class="large-4 columns">
			<p>Размер</p>
			<select name='size' required>
				<option>XXS</option>
				<option>XS</option>
				<option>S</option>
				<option>M</option>
				<option>L</option>
				<option>XL</option>
				<option>XXL</option>
				<option>XXXL</option>
				<option>35</option>
				<option>36</option>
				<option>37</option>
				<option>38</option>
				<option>39</option>
				<option>40</option>
				<option>41</option>
				<option>42</option>
				<option>43</option>
				<option>44</option>
				<option>45</option>

			</select>
		</div>

		<div class="large-4 columns">
			<p>Дата</p>
			<input type='date' name='date' required>
		</div>

		<div class="large-4 columns">
			<button class='button secondary' type='button' name='generate'>Сгенерировать</button>
		</div>

		<div class="large-4 columns">.</div>
		<div class="large-4 columns">
			<input class='button secondary' type='submit' value='Отправить'>
		</div>

		<div class="large-4 columns">
			<button class='button secondary' type='button' name='generateAll'>Сделать всё за меня</button>
		</div>
		<div class="large-4 columns"></div>
		<div class="large-4 columns"></div>


		</form>
	</div>



	<script> 

		function randomInteger(min, max) {
			var rand = min - 0.5 + Math.random() * (max - min + 1)
		    rand = Math.round(rand);
		    return rand;
		};
		function Generate() {

			var price = randomInteger(10, 2000);
			$('input[name="price"]').val(price);
			$('input[name="discount"]').val(0);
			var random = randomInteger(1, 3);
			if(random == 2) {
				var discount = randomInteger(Math.ceil(price - price/3), Math.ceil(price - 4));
				$('input[name="discount"]').val(discount);
			};

			function randomSelect(select) {
				var option = $(select).children();
				var random = randomInteger(1, option.length);
				select.children[random - 1].setAttribute('selected', true);
			};
			var select = document.querySelector('select[name="name"]');
			randomSelect(select);

			var select = document.querySelector('select[name="brand"]');
			randomSelect(select);

			var select = document.querySelector('select[name="color"]');
			randomSelect(select);

			var select = document.querySelector('select[name="size"]');
			randomSelect(select);

			var select = document.querySelector('select[name="gender"]');
			randomSelect(select);

			var count1 = randomInteger(1, 2);
			if(count1 == 2) {
				var count = randomInteger(1, 2);
			} else count = 1;
			$('input[name="count"]').val(count);
		};

		$('button[name="generate"]').click(function() {
			Generate();			
		});

		$('button[name="generateAll"]').click(function() { 
			var str = [];
			for(var j = 0; j < 2; j++) {
				if(j % 2 == 0) var i_max = 31;
				else var i_max = 30;
				var i_counter = 1;
				var i_counter_max = 20;
				var i_counter_min = 5;
				var numberMonth = 3;
				for(var i = 0; i < i_max; i++) {
					Generate();
					var name = document.querySelector('select[name="name"]').value;
					var price = document.querySelector('input[name="price"]').value;
					var discount = document.querySelector('input[name="discount"]').value;
					var gender = document.querySelector('select[name="gender"]').value;
					var brand = document.querySelector('select[name="brand"]').value;
					var color = document.querySelector('select[name="color"]').value;
					var size = document.querySelector('select[name="size"]').value;
					var count = document.querySelector('input[name="count"]').value;
					var day = i + 2;
					var month = j + numberMonth - 1;
					var year = "2016";
					var date = new Date(year, month, day);
					date = date.toISOString()
					
					var random = randomInteger(1, 1000);
					if(random < 800 && i_counter < i_counter_max ) {
						i--;
						i_counter++;
					} else {
						if(i_counter > i_counter_min) {
							i_counter = 1;
						} else {
							/*i--;*/
						};
					};
					if(i_counter > i_counter_max) i_counter = 1;

					str.push("name="+name+"&price="+price+"&discount="+discount+"&gender="+gender+"&brand="+brand+"&color="+color+"&size="+size+"&count="+count+"&date="+date);
					
				};
				
			};
			for(var i = 0; i < str.length; i++) {
				$.ajax({
						type: 'POST',
						data: str[i],
						url: 'php/add_to_statistic_func.php',
						success: function(data) {
							console.log(i);
						}
				});
			};

		});

	</script>	



	<?php include "php/footer.php" ?> 