function validateClassForm() {
	$("#panel3 form[name='addClass']").submit(function() {
		if($("#panel3 select[name='itemMenuClass']").val() == "Выберите пункт") {
			alert('Выберите пункт меню');
			return false;
		};
		if($("#panel3 select[name='genderClass']").val() == "Выберите пол") {
			alert('Выберите пол');
			return false;
		};

		var nameClass = $("#panel3 input[name='nameClass']").val();
		var genderClass = $("#panel3 select[name='genderClass']").val();
		var itemMenuClass = $("#panel3 select[name='itemMenuClass']").val();
		var desciptionClass = $("#panel3 input[name='desciptionClass']").val();
		var str = "nameClass="+nameClass+"&genderClass="+genderClass+"&itemMenuClass="+itemMenuClass;

		$.ajax({
			type: "POST",
			url: "php/check_group.php",
			data: str,
			success: function (data) {
				var answer = data.trim();
				if(answer == 'present') {
					alert('В этом пункте меню уже есть такая группа');
					return false;
				} else if (answer == "absent") {
					var str = "nameClass="+nameClass+"&genderClass="+genderClass+"&itemMenuClass="+itemMenuClass+"&desciptionClass="+desciptionClass;
					$.ajax({
						type: "POST",
						url: "php/add_new_class.php",
						data: str,
						success: function (data) {
							document.location.href = document.location.href;
						}
					});
				};
			}
		});
		return false;
	});
};


function checkItemToRemove() {
	$("#panel3 form[name='removeItem']").submit(function() {
		if($("#panel3 select[name='nameItem']").val() == "Выберите пункт") {
			alert('Выберите пункт меню');
			return false;
		};
		if($("#panel3 select[name='nameItem']").val() == "Бренды") {
			alert('Этот пункт нельзя удалить');
			return false;
		};

		var nameItem = $("#panel3 select[name='nameItem']").val();

		var str = "nameItem="+nameItem;

		$.ajax({
			type: "POST",
			url: "php/check_item_to_remove.php",
			data: str,
			success: function (data) {
				var answer = data.trim();
				if(answer == 'present') {
					if(confirm('В этом пункте меню есть привязанные группы, и ихняя привязанность к этому пункту будет безвозвранто.</br>Точно хотите удалить пункт меню?')) {
						var str = "nameItem="+nameItem;
						$.ajax({
							type: "POST",
							url: "php/remove_menu_item.php",
							data: str,
							success: function (data) {
								document.location.href = document.location.href;
							}
						});
					} else {
					return false;
					};
				} else if (answer == "absent") {
					var str = "nameItem="+nameItem;
					$.ajax({
						type: "POST",
						url: "php/remove_menu_item.php",
						data: str,
						success: function (data) {
							document.location.href = document.location.href;
						}
					});
				};
			}
		});
		return false;
	});
};



function checkClassToRemove() {
	$("#panel3 form[name='removeClass']").submit(function() {
		var classItemVal = $("#panel3 select[name='removeClassItem']").val();
		var classGenderVal = $("#panel3 select[name='removeClassGender']").val();
		var classNameVal = $("#panel3 select[name='removeClassName']").val();
		if(classItemVal == "Выберите пункт") {
			alert('Выберите пункт меню');
			return false;
		};

		if(classGenderVal == "Выберите пол") {
			alert('Выберите пол');
			return false;
		};

		if(classNameVal == "Выберите группу") {
			alert('Выберите группу');
			return false;
		};

		if(confirm('Привязанность товара к группе будет удалена безвозвратно. Вы точно хотите удалить группу&')) {
			var str = "item="+classItemVal+"&gender="+classGenderVal+"&name="+classNameVal;
			$.ajax({
				type: "POST",
				data: str,
				url: "php/check_group_to_remove.php",
				success: function (data) {
					data = data.trim();
					if(data == 'present') {
						alert('Этой группе пренадлежит некий товар, точно удалить?');
					} else if(data == 'absent') {
						var str = "item="+classItemVal+"&gender="+classGenderVal+"&name="+classNameVal;
						$.ajax({
							type: "POST",
							data: str,
							url: "php/remove_group.php",
							success: function (data) {
							document.location.href = document.location.href;
								
							}
						});
					};			
				}
			});


		};



		return false;
	});


	function showGroup() {
		var itemVal = $("#panel3 select[name='removeClassItem']").val();
		var genderVal = $("#panel3 select[name='removeClassGender']").val();
		var selectName = $("#panel3 select[name='removeClassName']");
		if(itemVal != "Выберите пункт" && genderVal != "Выберите пол") {
			$(selectName).parent().show();
			var str = "item="+itemVal+"&gender="+genderVal;
			$.ajax({
				type: "POST",
				data: str,
				url: "php/show_groups.php",
				success: function (data) {
				$(selectName).html(data);
					
				}
			});
		} else {
			$(selectName).parent().hide();
			$(selectName).html('<option>Выберите группу</option>');
		};
	};

	$("#panel3 select[name='removeClassItem']").change(function() { showGroup() });
	$("#panel3 select[name='removeClassGender']").change(function() { showGroup() });
};


	function functionShowGroup() {
		var itemVal = $("#panel1 select[name='item']").val();
		var genderVal = $("#panel1 select[name='gender']").val();
		var selectName = $("#panel1 select[name='group']");
		if(itemVal != "Выберите пункт" && genderVal != "Выберите пол") {
			$(selectName).parent().show();
			var str = "item="+itemVal+"&gender="+genderVal;
			$.ajax({
				type: "POST",
				data: str,
				url: "php/show_groups.php",
				success: function (data) {
				$(selectName).html(data);
					
				}
			});
		} else {
			$(selectName).parent().hide();
			$(selectName).html('<option>Выберите группу</option>');
		};
	};

	function functionShowBrands() {
		var itemVal = $("#panel1 select[name='item']").val();
		var genderVal = $("#panel1 select[name='gender']").val();
		var brand = $("#panel1 select[name='brand']");
		if(itemVal != "Выберите пункт" && genderVal != "Выберите пол") {
			$(brand).parent().show();
			var str = "gender="+genderVal;
			$.ajax({
				type: "POST",
				data: str,
				url: "php/show_brands.php",
				success: function (data) {
				$(brand).html(data);
					
				}
			});
		} else {
			$(brand).parent().hide();
			$(brand).html('<option>Выберите бренд</option>');
		};
	};



	function showGroupForAddProduct() {
		$("#panel1 select[name='item']").change(function() { 
			functionShowGroup();
			functionShowBrands();

		});
		$("#panel1 select[name='gender']").change(function() { 
			functionShowGroup(); 
			functionShowBrands();
		});
	};





	function validateBrand() {
		$("#panel4 form[name='addNewBrand']").submit(function() {
			if($("#panel4 select[name='genderBrand']").val() == "Выберите пол") {
				alert('Выберите пол');
				return false;
			};
		});
	};


	//валидируем отправку и подготавливаем данные к отправке
	function validateSendProduct() {
		$("#panel1 form[name='addProduct']").submit(function() {
			if($("#panel1 select[name='item']").val() == "Выберите пункт") {
				alert('Выберите пункт меню');
				return false;
			};
			if($("#panel1 select[name='gender']").val() == "Выберите пол") {
				alert('Выберите пол');
				return false;
			};

			if($("#panel1 select[name='group']").val() == "Выберите группу") {
				alert('Выберите группу');
				return false;
			};

			if($("#panel1 select[name='brand']").val() == "Выберите бренд") {
				alert('Выберите бренд');
				return false;
			};

			out: for(var j = 0; j < 1; j++) {
				var materialAll = $("#panel1 input[name^='material']");
				for(var i = 0; i < materialAll.length; i++) {
					if(materialAll[i].checked == true) {
						break out;
					};
				};
				if(!confirm('Добавить без материала?')) return false;
			};

			out: for(var j = 0; j < 1; j++) {
				var colorAll = $("#panel1 input[name^='color']");
				for(var i = 0; i < colorAll.length; i++) {
					if(colorAll[i].checked == true) {
						break out;
					};
				};
				if(!confirm('Добавить без цвета?')) return false;
			};

			out: for(var j = 0; j < 1; j++) {
				var sizeAll = $("#panel1 input[name^='size']");
				for(var i = 0; i < sizeAll.length; i++) {
					if(sizeAll[i].checked == true) {
						break out;
					};
				};
				if(!confirm('Добавить без размера?')) return false;
			};

			out: for(var j = 0; j < 1; j++) {
				var parametrAll = $("#panel1 input[name^='parametr']");
				for(var i = 0; i < parametrAll.length; i++) {
					if(parametrAll[i].checked == true) {
						break out;
					};
				};
				if(!confirm('Добавить без параметров?')) return false;
			};
			
			/*if(!$("#panel1 input[name='photo']").val()) {
				if(!confirm('Добавить без дополнительных фото?')) return false;
			};*/

			//сохраняем материал
			var materialAll = $("#panel1 input[name^='material']");
			var arr = [];
			for(var i = 0; i < materialAll.length; i++) {
				if($(materialAll[i])) {
					if(materialAll[i].checked == true) {
						var value = $(materialAll[i]).attr('data-value');
						arr.push(value);
					};
				};
			};
			var str = JSON.stringify(arr);
			$("#panel1 input[name='materialAll']").val(str);


			//сохраняем цвет
			var colorAll = $("#panel1 input[name^='color']");
			var arr = [];
			for(var i = 0; i < colorAll.length; i++) {
				if($(colorAll[i])) {
					if(colorAll[i].checked == true) {
						var value = $(colorAll[i]).attr('data-value');
						arr.push(value);
					};
				};
			};
			var str = JSON.stringify(arr);
			$("#panel1 input[name='colorAll']").val(str);
			

			//сохраняем размер и колличество
			var sizeAll = $("#panel1 input[name^='size']");
			var arr = [];
			for(var i = 0; i < sizeAll.length; i++) {
				if($(sizeAll[i])) {
					if(sizeAll[i].checked == true) {
						var value = $(sizeAll[i]).attr('data-value');
						var sum = $(sizeAll[i].parentNode.querySelector('input[data-sum]')).val();
						var obj = {'size':value, 'sum': sum};
						arr.push(obj);
					};
				};
			};
			var str = JSON.stringify(arr);
			$("#panel1 input[name='sizeAll']").val(str);


			//сохраняем значение параметра и параметр
			var parametrAll = $("#panel1 input[name^='parametr']");
			var arr = [];
			for(var i = 0; i < parametrAll.length; i++) {
				if($(parametrAll[i])) {
					if(parametrAll[i].checked == true) {
						var parametr = $(parametrAll[i]).attr('data-value');
						var value = $(parametrAll[i].parentNode.querySelector('input[data-parametr]')).val();
						var obj = {'parametr':parametr, 'value': value};
						arr.push(obj);
					};
				};
			};
			var str = JSON.stringify(arr);
			$("#panel1 input[name='parametrAll']").val(str);

		});

	};




	function showSizeSum() {
        $("input[name^='size']").change(function(e) {
        	var target = e.target;
        	if(!target.hasAttribute('data-check')) {
        		target.setAttribute('data-check', '');
        		target.parentNode.querySelector('input[type="hidden"]').setAttribute('type', 'number');
        		target.parentNode.querySelector('.check-sum').removeAttribute('hidden');
        	} else {
        		target.removeAttribute('data-check');
        		target.parentNode.querySelector('input[type="number"]').setAttribute('type', 'hidden');
        		target.parentNode.querySelector('.check-sum').setAttribute('hidden', true);
        	};
        });
    };


    function showParametrInput() {
        $("input[name^='parametr']").change(function(e) {
        	var target = e.target;
        	if(!target.hasAttribute('data-check')) {
        		target.setAttribute('data-check', '');
        		target.parentNode.querySelector('input[type="hidden"]').setAttribute('required', '');
        		target.parentNode.querySelector('input[type="hidden"]').setAttribute('type', 'text');
        	} else {
        		target.removeAttribute('data-check');
        		target.parentNode.querySelector('input[type="text"]').removeAttribute('required');
        		target.parentNode.querySelector('input[type="text"]').setAttribute('type', 'hidden');
        	};
        });
    };



    function addArticul() {
    	$('input[name="articul"]').keypress(function(e) {
			var key = e.charCode;
			if(48 > key || key > 57) return false;
		});

    	$('button[name="setArticul"]').click(function() {
    		var articul = $('input[name="articul"]').val();
    		if(articul == "" || articul == 0 || isNaN(+articul)) { alert('Введите артикуль'); return; };

    		var str = "id="+articul;
    		$.ajax({
    			data: str,
    			type: "POST",
    			url: "php/check_articul.php",
    			success: function(data) {
    				data = data.trim();
    				if(data == "present") {
    					$('input[name="id"]').val(articul);
    					$('.link-product').html("http://aleksa/?gender=for_men&id="+articul);
    					$('.link-product').attr("href", "http://aleksa/product.php?gender=for_men&id="+articul);
    					$('.main-wrapper').show();
    				} else if(data == "absent") {
    					alert('Товар за данным артикулем не найдет')
    				};
    			}
    		});
    	});

		$('input[name="discount"]').keypress(function(e) {
			var key = e.charCode;
			if(key != 46 && 48 > key || key > 57) return false;
		});

		$('form[name="addDiscount"]').submit(function() {
			var discount = $('input[name="discount"]').val();
			var id = $('input[name="id"]').val();
			if(discount == "") { alert('Введите скидку'); return false };

			var str = "id="+id+"&discount="+discount;
			$('#panel2 .waiting').show();
			$.ajax({
				data: str,
				type: "POST",
				url: "php/add_discount.php",
				success: function(data) {
					data = data.trim();
					$('#panel2 .waiting').hide();
					if(data == "added") { alert('Скидка успешно добавлена'); return false; }
					else alert('Ошибка! Скидка не добавлена');
				},
				error: function() {
					alert('Ошибка передачи данных');
					data = data.trim();
				}
			});

			return false;
		});
    };



    function show_More_Info_Message() {

    	$('.open').click(function() {
    		$('.open').parent().css({'height':'50px', 'min-height':'0'});
    		$('.open').parent().removeClass('active-message');

    		if(!$(this.parentNode).hasClass('active-message')) {
	    		$(this.parentNode).css({'height':'auto'});
	    		$(this.parentNode).addClass('active-message');
    		} else {
    			$(this.parentNode).css({'height':'50px'});
	    		$(this.parentNode).removeClass('active-message');
    		};
    	});

    };

    


    function handle_Message() {
    	$("form[name='handle_message']").submit(function(e) {
    		return false;
    	});

    	$("input[name='send_Answer']").click(function(e) {
    		var target = e.target;
    		var answer = target.parentNode.querySelector("textarea[name='answer']").value;
    		var id_message = target.parentNode.querySelector("input[name='id_message']").value;
    		str = "id_message="+id_message+"&answer="+answer;
    		$.ajax({
    				type: 'POST',
    				data: str,
    				url: 'php/answer_for_question.php',
    				success: function(data) {
    					data = data.trim();
    					if(data == 'true') {
    						var str = 'whot=question&status=waiting';
    						send_and_show(str, 'question', 'Не обработанные');
    					} else {
    						alert('Ошибка отправки данных');
    					};
    				}
    		});
    	});

    	function handle_comment(status, id_message) {
    		str = "id_message="+id_message+"&status="+status;
    		$.ajax({
    				type: 'POST',
    				data: str,
    				url: 'php/answer_for_comment.php',
    				success: function(data) {
    					data = data.trim();
    					if(data == 'true') {
    						var str = 'whot=comment&status=waiting';
    						send_and_show(str, 'comment', 'Не обработанные');
    					} else {
    						alert('Ошибка отправки данных');
    					};
    				}
    		});
    	};

    	$("input[name='send_Comment_Ok']").click(function(e) {
    		var target = e.target;
    		var id_message = target.parentNode.querySelector("input[name='id_message']").value;
    		handle_comment('ok', id_message);
    	});

    	$("input[name='send_Comment_No']").click(function(e) {
    		var target = e.target;
    		var id_message = target.parentNode.querySelector("input[name='id_message']").value;
    		handle_comment('no', id_message);
    	});

    };




    function send_and_show(str, message_type, sort) {
    	$.ajax({
    		type: 'POST',
    		data: str,
    		url: 'php/get_message.php',
    		success: function(data) {
    			$('.mess-wrapp').remove();
    			var message = JSON.parse(data);

    			function compareNew(a, b) {
					var date_a = Date.parse(a['date']);
					  var date_b = Date.parse(b['date']);
					  if(isNaN(date_a)) date_a = new Date();
					  if(isNaN(date_b)) date_b = new Date();

					if (date_a > date_b) return -1;
					if (date_a < date_b) return 1;
				}
				message.sort(compareNew);

    			var str = "";

    			for(i = 0; i < message.length; i++) {
					if(message[i]['status'] == 'waiting') {
						if(sort == "Обработанные") continue;
						var status = "Не обработан";
						var statusClass = " state-waiting";
					} else {
						if(sort == "Не обработанные") continue;
						var status = "Обработан";
						var statusClass = "";
					};
						if(message_type == 'question') {
						str += "<div class='mess-wrapp"+statusClass+"'>\
								<div class='date large-2 columns'>"+message[i]['date']+"</div>\
								<div class='name large-4 columns'>"+message[i]['name']+"</div>\
								<div class='state large-4 columns'>"+status+"</div>\
								<div class='open large-2 columns'><a>Открыть</a></div>\
								<div class='message large-12 columns'>"+message[i]['message']+"</div>\
								<form name='handle_message'>\
									<p class='product-link'><a href='http://aleksa/product.php?gender=for_women&id="+message[i]['id_product']+"'>Открыть товар #"+message[i]['id_product']+"</a></p>\
									<textarea name='answer' required></textarea>\
									<input type='hidden' name='id_message' value='"+message[i]['id_message']+"'/>\
									<input type='submit' class='button secondary' name='send_Answer' value='Ответить'/>\
								</form>\
							</div>";
						} else if (message_type == 'comment') {
							str += "<div class='mess-wrapp"+statusClass+"'>\
								<div class='date large-2 columns'>"+message[i]['date']+"</div>\
								<div class='name large-4 columns'>"+message[i]['name']+"</div>\
								<div class='state large-4 columns'>"+status+"</div>\
								<div class='open large-2 columns'><a>Открыть</a></div>\
								<div class='message large-12 columns'>"+message[i]['message']+"</div>\
								<form name='handle_message'>\
									<input type='hidden' name='id_message' value='"+message[i]['id_message']+"'/>\
									<p class='product-link'><a href='http://aleksa/product.php?gender=for_women&id="+message[i]['id_product']+"'>Открыть товар #"+message[i]['id_product']+"</a></p>\
									<input type='submit' class='button secondary' name='send_Comment_Ok' value='Подтвердить публикацию'/>\
									<input type='submit' class='button secondary' name='send_Comment_No' value='Запретить публикацию'/>\
								</form>\
							</div>";
						};
				};
				document.querySelector('.mess-head').insertAdjacentHTML("afterEnd", str);
    			show_More_Info_Message();
    			handle_Message();
    		}
    	});
    };



    

    function add_Message() {
    	$('#panel5 .message-ul ul li a').click(function() {
    		
    		if($(this.parentNode.parentNode).hasClass('comment-ul')) {
    			var sort = this.innerHTML;
    			var str = 'whot=comment&status=waiting';
    			send_and_show(str, 'comment', sort);
    		} else if($(this.parentNode.parentNode).hasClass('question-ul')) {
    			var sort = this.innerHTML;
    			var str = 'whot=question&status=waiting';
    			send_and_show(str, 'question', sort);
    		};
    	});
    };
 



 	function show_statistic() {
 		$('#panel6 .time-interval button').click(function() {
 			var time_begin = $('#panel6 .time-interval input[name="time-begin"]').val();
 			var time_end = $('#panel6 .time-interval input[name="time-end"]').val();
 			if(time_begin === "" || time_end === "") {
 				alert('Выберите интервал времени');
 				return;
 			};
 			time_begin = Date.parse(time_begin)/1000 - 24*60*60;
 			time_end = Date.parse(time_end)/1000; 

 			var str = "begin=" + time_begin + "&end=" + time_end;
 			$.ajax({
 				type: 'POST',
 				data: str,
 				url: 'php/get_statistic.php',
 				success: function(data) {
 					var statistic = JSON.parse(data);
 					var str = "";

 					for(var i = 0; i < statistic.length; i++) {
 						statistic[i]['price'] += " €";

 						if(statistic[i]['discount'] == 0) statistic[i]['discount'] = "-"; 
 						else statistic[i]['discount'] += " €";

 						if(statistic[i]['gender'] == 'men') statistic[i]['gender'] = 'мужской';
 						else if(statistic[i]['gender'] == 'women') statistic[i]['gender'] = 'женский';
 						
 						str += "<tr>\
								<td>"+statistic[i]['id']+"</td>\
								<td>"+statistic[i]['name']+"</td>\
								<td>"+statistic[i]['price']+"</td>\
								<td>"+statistic[i]['discount']+"</td>\
								<td>"+statistic[i]['gender']+"</td>\
								<td>"+statistic[i]['brand']+"</td>\
								<td>"+statistic[i]['color']+"</td>\
								<td>"+statistic[i]['size']+"</td>\
								<td>"+statistic[i]['sum']+"</td>\
								<td>"+statistic[i]['date']+"</td>\
							</tr>";
 					};
 					if(statistic.length < 1) {
 						$('.main-table td').parent().remove();
 						str = "<tr><td>В данном интервале временни не зафикстрованно покупок</tr></td>";
 						$('#panel6 .table-message').html(str);
 					} else {
 						$('.main-table td').parent().remove();
 						$('#panel6 .table-message').html('');
 						document.querySelector('#panel6 .table-hd').insertAdjacentHTML('afterEnd', str);
 					};
 				}
 			});
 		});
 	};




