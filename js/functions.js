function pickoutGender() {
	var mainGender = document.getElementById('main-dender');
	$(mainGender).css({'font-weight':'bold'});
};

var degradationTime = 50;
function showOrHidePanel() {
	var intervalOpenPanel;
	$('#main-menu a').on('mouseenter', function(e) {
		clearTimeout(intervalOpenPanel);
		$('.degradation').show();
		$('.degradation').fadeTo(300, .6);
		intervalOpenPanel = setTimeout(function() {
			$('.degradation').stop();
			$('.degradation').show();
			$('.degradation').fadeTo(degradationTime, .6);
			var target = e.target;
			var value = $(target).html();
			var description = $(target).attr('data-description');
			var productPanel = document.getElementById('product-panel');
			var mainGender = document.getElementById('main-dender').innerHTML;
			var gender = 'men';
			if(mainGender == 'Женщинам') gender = 'women';
			if(mainGender == 'Мужчинам') gender = 'men';

			var str = "item="+value+"&gender="+gender;
			$.ajax({
				type: "POST",
				url: "php/get_menu_items.php",
				data: str,
				success: function (data) {
					$(productPanel).html('');
					$(productPanel).hide();
					$(productPanel).show();

					var answer = data;
					productArr = JSON.parse(answer);
					var div = document.createElement('div');
					div.className = "row";
					var h2 = document.createElement('h2');
					h2.innerHTML = description;
					div.appendChild(h2);

					var i = 1;
					out: for(var j = 0; j < productArr.length/6; j++) {
						var ul = document.createElement('ul');
						ul.className = "menu vertical";
						div.appendChild(ul);
						var gender = getLinkGender();
						for(i; i < productArr.length + 1; i++) {	
							var li = document.createElement('li');
							var a = document.createElement('a');
							$(a).attr('data-group', '');
							if(value == "Бренды") var str = 'index.php?'+gender+"&brand="+productArr[i - 1];
							else var str = 'index.php?'+gender+"&item="+value+"&group="+productArr[i - 1];
							$(a).attr('href', str);
							$(a).html(productArr[i - 1]);
							li.appendChild(a);
							ul.appendChild(li);
							if(i % 6 == 0) {
								i++;
								continue out;
							};
						};
					};

					productPanel.appendChild(div);
				}
			});
		}, 300);
	});

	$('#main-menu').on('mouseleave', function(e) {
		var target = e.relatedTarget;
		var elem = $(target).attr('id');
			clearTimeout(intervalOpenPanel);
		if ($(target).hasClass('degradation')) {
			$('.degradation').stop();
			$('.degradation').fadeTo(degradationTime, 0);
			setTimeout(function() { $('.degradation').hide(); }, degradationTime);
			var productPanel = $('#product-panel');
			$(productPanel).hide();
			$(productPanel).html('');
		};
	});

	$('#product-panel').on('mouseleave', function(e) {
		var target = e.relatedTarget;
		if ($(target).hasClass('degradation')) { 
			$('.degradation').stop();
			$('.degradation').fadeTo(degradationTime, 0);
			setTimeout(function() { $('.degradation').hide(); }, degradationTime);
			var productPanel = $('#product-panel');
			$(productPanel).hide();
			$(productPanel).html('');
		};
	});
};


function showOrHideProfilePanel() {
$('.profile').mouseover(function() { $('.user-menu').show() });
$('#header .menu').on("mouseleave", function(e) { $('.user-menu').hide(); });
};


function addOntionsDays() {
	var options = "<option>День</option>";
	
	for(var i = 1; i < 32; i++) {
	var opt = "<option>" + i + "</option>";
	options += opt;
	};

	$("select[name='day']").html(options);
};

function addOntionsYears() {
	var options = "";
	var date = new Date();

	for(var i = 1900; i < date.getFullYear(); i++) {
	var opt = "<option>" + i + "</option>";
	options = opt + options;
	};

	options = "<option>Год</option>" + options;

	$("select[name='year']").html(options);
};

function setGender() {
	$('.gender').click(function() {
		var val = this.innerHTML;
		$('button.men').css({'background-color': ''});
		$('button.women').css({'background-color': ''});
		$('input[name="gender"]').attr('value', val);
	});
};

function encodeDate() {
	$('form').submit(function() {
		var date = [];
		date[0] = $("select[name='day']").val();
		date[1] = $("select[name='month']").val();
		date[2] = $("select[name='year']").val();

		var setDate = date.join('::');

		$("input[name='date']").attr('value', setDate);
	})
};


function decodeDate() {
		var value = $("input[name='date']").val();
		if(value == "") return;

		var date = [];
		date = value.split('::');
		
		var optDay = $("select[name='day'] option");
		for(var i = 0; i < optDay.length; i++) {
			if($(optDay[i]).html() == date[0]) $(optDay[i]).attr('selected', true);
		}
		var optMonth = $("select[name='month'] option");
		for(var i = 0; i < optMonth.length; i++) {
			if($(optMonth[i]).html() == date[1]) $(optMonth[i]).attr('selected', true);
		}
		var optyear = $("select[name='year'] option");
		for(var i = 0; i < optyear.length; i++) {
			if($(optyear[i]).html() == date[2]) $(optyear[i]).attr('selected', true);
		}
};


function showGender() {
	var value = $("input[name='gender']").val();
	if(value == "") return;
	if(value == 'Мужской') $('button.men').css({'background-color': 'rgb(95,95,95)'});
	if(value == 'Женский') $('button.women').css({'background-color': 'rgb(95,95,95)'});
};



function Login() {
	$("#login form").submit(function() {
		var email = $("#login input[name='email']").val();
		var password = $("#login input[name='password']").val();
		var str = "email="+email+"&password="+password;

		var error = $('#login form .error');
		$(error).hide();	

		$.ajax({
			type: "POST",
			url: "php/login.php",
			data: str,
			success: function (data) {
				var answer = data;
				if(answer == 3) {
					var ErEmail = $('#login form .ErEmail');
					ErEmail.show();
				} else if(answer == 2) {
					var ErPwrd = $('#login form .ErPwrd');
					ErPwrd.show();
				} else if(answer == 1) {
					document.location.href = "";
				};
			}
		});
		return false;
	});
};




function Logout() {
	$('#logout').click(function() {
		$.ajax({
			url: "php/logout.php",
			success: function (data) {
			document.location.href = "";
			}
		});
	});
};



function Registration() {
	$("#registration form input[name='email']").blur(function() {
		var email = $("#registration input[name='email']").val();
		var str = "email="+email;

		var ErEmail = $('#registration form .ErEmail');
		ErEmail.hide();

		$.ajax({
			type: "POST",
			url: "php/check_email.php",
			data: str,
			success: function (data) {
				var answer = data.trim();
				if(answer == 1) {
					var ErEmail = $('#registration form .ErEmail');
					ErEmail.show();
					statusSend['email'] = false;
				} else if(answer == 3) {
					statusSend['email'] = true;
				};
			}
		});
	});

	$("#registration form input[name^='password']").blur(function() {
		var password1 = $("#registration input[name='password1']").val();
		var password2 = $("#registration input[name='password2']").val();

		var ErPwrd = $('#registration form .ErPwrd');
		ErPwrd.hide();

		if(password1 != "" && password2 != "") {
			if(password1 != password2) {
				ErPwrd.show();
				statusSend['password'] = false;
			} else {
				statusSend['password'] = true;
			};
		};	
		
	});

	$("#registration form input[name='username']").blur(function() {
		var username = $("#registration input[name='username']").val();

		var ErName = $('#registration form .ErName');
		ErName.hide();

		if(username.charAt(0).toUpperCase() != username.charAt(0)) {
			ErName.show();
			statusSend['username'] = false;
		} else {
			statusSend['username'] = true;
		};
	});

	$("#registration form").submit(function(e) {

		for(var key in statusSend) {
			if(statusSend[key] == false) {
				return false;
			};
		};
	});
};




function Losepswd() {
	$("#losepswd form").submit(function() {
		var email = $("#losepswd input[name='email']").val();
		var str = "email="+email;

		var error = $('#losepswd form .error');
		$(error).hide();	

		var waiting = $('#losepswd form .waiting');
		$(waiting).show();

		$.ajax({
			type: "POST",
			url: "php/losepwrd.php",
			data: str,
			success: function (data) {
				var password = data;
                password = password.trim();

            	if(password != "\$" && password != "") 
                {
	                str = "password="+password+"&email="+email;

	                $.ajax({
						type: "POST",
						url: "php/send_my_password.php",
						data: str,
						success: function (data) {
		                    var waiting = $('#losepswd form .waiting');
							$(waiting).hide();   
							
							$("#losepswd input[name='notice']").trigger('click');
						}
					});

                } else if(password == "\$") {
                	var waiting = $('#losepswd form .waiting');
					$(waiting).hide();
					var error = $('#losepswd form .error');
					$(error).show();
                };    
			}
		});
		return false;
	});
};


function toggleSideMenu() {
	$('.side-part .side-product .item a').click(function(e) {
		var target = e.target;
		var subMenu = target.parentNode.querySelector('.group');
		$(subMenu).slideToggle();
	});
	var getParams = parseGETParameters();
	if(getParams['item']) {
		var param = getParams['item'];
		param = decodeURIComponent(param);
		var item = $('.side-part .side-product .item a');
		for(var i = 0; i < item.length; i++) {
			if(item[i].innerHTML == param) {
				var subMenu = item[i].parentNode.querySelector('.group');
				$(subMenu).slideToggle(); 
				return;
			};
		};
	};
};


function addProductToFilter(product, gender) {
	var prodEl = document.createElement('div');
	prodEl.className = 'product columns';
	prodEl.setAttribute('data-product-id', product['id']);
	var wrap = document.createElement('div');
	wrap.className = 'wrap';
	var image = document.createElement('a');
	image.setAttribute('href', 'product.php?'+gender+'&id='+product['id']);
	image.className = 'image';
	var liked = document.createElement('div');
	var strClass = "liked";
	if(product['like'] == "yes") strClass += " hard-active";
	liked.className = strClass;
	var hard = document.createElement('div');
	hard.className = "hard";
	var img = document.createElement('img');
	img.setAttribute('alt', product['shot_description']);
	img.setAttribute('src', 'image/'+product['id']+'/'+product['photoMain']);
	var info = document.createElement('div');
	info.className = 'info';
	var name = document.createElement('p');
	name.className = 'name';
	name.innerHTML = product['name'];
	var desc = document.createElement('p');
	desc.className = 'desc';
	desc.innerHTML = product['shot_description'];
	var price = document.createElement('p');
	var strClPrice = 'price';
	if(+product['discount'] > 0) {
		strClPrice += ' line-through';
		var discount = document.createElement('p');
		discount.className = "discount";
		discount.innerHTML = product['discount'];
		var discountSpan = document.createElement('span');
		discountSpan.innerHTML = '€';
	};
	price.className = strClPrice;
	price.innerHTML = +product['price'] * 1;
	var span = document.createElement('span');
	span.innerHTML = '€';

	price.appendChild(span);

	info.appendChild(name);
	info.appendChild(desc);
	info.appendChild(price);
	if(+product['discount'] > 0) { discount.appendChild(discountSpan); info.appendChild(discount); };


	liked.appendChild(hard);
	image.appendChild(liked);
	var date = Date.parse(product['date']);
	var dateNow = new Date();
	if(!isNaN(date) && date != 0) var time_has_passed = +dateNow - +date;
	else var time_has_passed = 0;
	//сколько дней прошло с момента добавления этого товара
	time_has_passed = time_has_passed / 3600000 / 24;
	time_has_passed = time_has_passed.toFixed(1);
	//сколько дней с момента добавления тавора он будет считаться новым
	var TRUE_LABEL = 20; 
	if(product['discount'] > 0 || time_has_passed < TRUE_LABEL) {
		var label_group = document.createElement('div');
		label_group.className = "label-group";

		if(time_has_passed < TRUE_LABEL) {
			var new_label = document.createElement('div');
			new_label.className = "new-label";
			new_label.innerHTML = "new";
			label_group.appendChild(new_label);
		};

		if(product['discount'] > 0) {
			var discount_procent = 100 - (product['discount']/(+product['price']/100));
			var discount_label = document.createElement('div');
			discount_label.className = "discount-label";
			discount_label.innerHTML = "-"+Math.ceil(discount_procent)+"%";
			label_group.appendChild(discount_label);
		};

		image.appendChild(label_group);
	};
	image.appendChild(img);

	wrap.appendChild(image);
	wrap.appendChild(info);

	prodEl.appendChild(wrap);

	return prodEl;
};


function getProductForFilter(numbers) {
	var arrId = [];
	for(var i = 0; i < numbers.length; i++) {
		arrId.push(numbers[i]['id']);
	};
	var strNumbers = JSON.stringify(arrId);
	var str = "numbers="+strNumbers;
	$.ajax({
		type: "POST",
		url: "php/get_product_for_filter.php",
		data: str,
		success: function (data) {
			var allProduct = JSON.parse(data);
			if(allProduct == null) return;
			var gender = getLinkGender();
			var frag = document.createDocumentFragment();
			for(var i = 0; i < allProduct.length; i++) {
				var product = addProductToFilter(allProduct[i], gender);
				frag.appendChild(product);
			};
			document.querySelector('.main-part').appendChild(frag);
			productEvent();
		}
	});
};




function getLinkGender() {
	if($('#main-dender').html() == 'Женщинам') {
		var genger = "gender=for_women";
	} else if($('#main-dender').html() == 'Мужчинам') {
		var genger = "gender=for_men";
	} else {
		var genger = "gender=for_men";
	};
	var str = genger;
	return str;
};


function parseGETParameters() {
    var result = {};
    var gets = window.location.search.replace(/&amp;/g, '&').substring(1).split('&');
    for (var i = 0; i < gets.length; i++) {
        var get = gets[i].split('=');
        result[get[0]] = typeof(get[1]) == 'undefined' ? '' : get[1];
    }
    return result;
};


function showProductForGETparametrs() {
	var getParams = parseGETParameters();
	var mainPart = document.querySelector('.main-part');
	mainPart.innerHTML = ""; 
	for(var key in getParams) {
		getParams[key] = decodeURIComponent(getParams[key]);
	};
	if(!getParams['brand'] && !getParams['item'] && !getParams['group']) {
		mainPart.innerHTML = "<div class='select-category'>Выберите категорию</div>";
		return;
	};

	var checkCount = 0;
	if(getParams['size']) {
		$('.accord-block.accord-size .group-name').trigger('click');
		getParams['size'] = getParams['size'].split('+');
		for(var i = 0; i < getParams['size'].length; i++) {
			var str = ".accord-block.accord-size input[data-value='"+getParams['size'][i]+"']";
			$(str).trigger('click');
		};
		checkCount++;
	}

	if(getParams['brand']) {
		$('.accord-block.accord-brand .group-name').trigger('click');
		getParams['brand'] = getParams['brand'].split('+');
		for(var i = 0; i < getParams['brand'].length; i++) {
			var str = ".accord-block.accord-brand input[data-value='"+getParams['brand'][i]+"']";
			$(str).trigger('click');
		};
		checkCount++;
	}

	if(getParams['material']) {
		$('.accord-block.accord-material .group-name').trigger('click');
		getParams['material'] = getParams['material'].split('+');
		for(var i = 0; i < getParams['material'].length; i++) {
			var str = ".accord-block.accord-material input[data-value='"+getParams['material'][i]+"']";
			$(str).trigger('click');
		};
		checkCount++;
	}

	if(getParams['color']) {
		$('.accord-block.accord-color .group-name').trigger('click');
		getParams['color'] = getParams['color'].split('+');
		for(var i = 0; i < getParams['color'].length; i++) {
			var str = ".accord-block.accord-color input[data-value='"+getParams['color'][i]+"']";
			$(str).trigger('click');
		};
		checkCount++;
	}


	if(getParams['minPrice']) {
		$('input[name="min-price"]').val(getParams['minPrice']);
		checkCount++;
	}
	if(getParams['maxPrice']) {
		$('input[name="max-price"]').val(getParams['maxPrice']);
		checkCount++;
	}
	if(getParams['minPrice'] || getParams['maxPrice']) $('.accord-block.accord-price .group-name').trigger('click');

	if(checkCount > 0) {
		$('.reset-filter').animate({
			'height':'35px'
		});
	} else {
		$('.reset-filter').animate({
			'height':'0px'
		});
	};

	if(!getParams['sort']) {
		var sort_parametr = "visit";
	} else {
		var sort_parametr = getParams['sort'];
	};
		
	getParams = JSON.stringify(getParams);
	var str = "obj="+getParams;
	$.ajax({
		type: "POST",
		url: "php/get_numbers_prod_for_filter.php",
		data: str,
		success: function (data) {
			getNumbersFormMainAddFuncProd(data, sort_parametr);
		}
	});

};



	//организация пагинации
	//добавлять любой товар с помощью этой функции, которая сортирует, делит все принятые номера на страници и выводит товар.связывает со всеми функциями
var MAIN_COUNT_PAGE = [];
var howMuchProductInPage = 8;
function getNumbersFormMainAddFuncProd(data, sort_parametr) {
	document.querySelector('.main-part').innerHTML = "";
	if(data === null) return;
	var allNumbers = JSON.parse(data);
	var getParams = parseGETParameters();
	
	mainFilter_sort(sort_parametr, allNumbers);


	var count = 0;
	MAIN_COUNT_PAGE = [];
	for(var i = 1; i < allNumbers.length + 1; i++) {
		if(!Array.isArray(MAIN_COUNT_PAGE[count])) MAIN_COUNT_PAGE[count] = [];
		MAIN_COUNT_PAGE[count].push(allNumbers[i - 1]); 
		if(i % howMuchProductInPage == 0) count++;
	};
	var allPages = MAIN_COUNT_PAGE.length;

	if(getParams['page']) { 
		var page = getParams['page'];
	} else var page = 1;
	setPageInPagenation(page, allPages);
	getProductForFilter(MAIN_COUNT_PAGE[page - 1]);

	if(allPages == 0) $('.pagination').hide();
};



function mainFilter_sort(sort_parametr, allNumbers) {
	$('.spacer .sort ul li a').removeClass('active-sort-item');

	function compareVisit(a, b) {
  		return  b['visit'] - a['visit'];
	}
	if(sort_parametr == 'visit') {
		allNumbers.sort(compareVisit);
		$('.spacer .sort ul li a[data-sort="visit"]').addClass('active-sort-item');
	};

	function compareDiscount(a, b) {
  		return b['discount'] - a['discount'];
	}
	if(sort_parametr == 'discount') {
		allNumbers.sort(compareDiscount);
		$('.spacer .sort ul li a[data-sort="discount"]').addClass('active-sort-item');
	};	

	function comparePriceUp(a, b) {
  		return a['price'] - b['price'];
	}
	if(sort_parametr == 'price_up') {
		allNumbers.sort(comparePriceUp);
		$('.spacer .sort ul li a[data-sort="price-up"]').addClass('active-sort-item');
	};

	function comparePriceDown(a, b) {
  		return b['price'] - a['price'];
	}
	if(sort_parametr == 'price_down') {
		allNumbers.sort(comparePriceDown);
		$('.spacer .sort ul li a[data-sort="price-down"]').addClass('active-sort-item');
	};

	function compareNew(a, b) {
		var date_a = Date.parse(a['date']);
  		var date_b = Date.parse(b['date']);
  		if(isNaN(date_a)) date_a = new Date();
  		if(isNaN(date_b)) date_b = new Date();

		if (date_a > date_b) return -1;
  		if (date_a < date_b) return 1;
	}
	if(sort_parametr == 'new') {
		allNumbers.sort(compareNew);
		$('.spacer .sort ul li a[data-sort="new"]').addClass('active-sort-item');
	};

};






function showAccordionToggle() {
	$('.side-part .accord-block .group-name').click(function(e) {
		var target = e.target;
		var checkWrap = target.parentNode.querySelector('.check-group');
		if($(checkWrap).css('height') == "0px") {
			$(checkWrap).animate({
			'height':'180px'
			});
			target.parentNode.style.marginBottom = "10px";
			target.querySelector('.state').classList.add('plus');
		} else {
			$(checkWrap).animate({
			'height':'0px'
			});
			target.parentNode.style.marginBottom = "0px";
			target.querySelector('.state').classList.remove('plus');
		};
	});
};


function resetFilter() {
	$('.reset-filter').click(function(e) {
		$('.side-part input[type="checkbox"]').prop('checked', false);
		$('.side-part input[name="min-price"]').val('');
		$('.side-part input[name="max-price"]').val('');
		$('.side-part .accord-price button').trigger('click');
	});
};


function checkFilte() {
	function func(e) {
		var str = [];
		var getParams = {};
		var size = [];
		var brand = [];
		var material = [];
		var color = [];	
		var checkboxAll = $('.check-wrap input[type="checkbox"]');
		var minPrice = $('input[name="min-price"]').val();
		var maxPrice = $('input[name="max-price"]').val();

		var getLink = parseGETParameters();
		out: for(var key in getLink) {
			if(key == 'gender' || key == 'item' || key == 'group')
			strThis = key+"="+getLink[key];
			for(var j = 0; j < str.length; j++) {
				if(str[j] == strThis) continue out;
			};
			getParams[key] = getLink[key];
			str.push(strThis);
		};
		getParams['size'] = []; 
		getParams['brand'] = []; 
		getParams['material'] = []; 
		getParams['color'] = []; 
		var checkCount = 0;
		for(var i = 0; i < checkboxAll.length; i++) {
			if(checkboxAll[i].checked == true) {
				checkCount++;
				var parametr = checkboxAll[i].getAttribute('data-parametr');
				var value = checkboxAll[i].getAttribute('data-value');
				if(parametr == "size") {
					size.push(value); 
					getParams['size'].push(value);
				} else if(parametr == "brand") {
					brand.push(value); 
					getParams['brand'].push(value);
				} else if(parametr == "material") {
					material.push(value); 
					getParams['material'].push(value);
				} else if(parametr == "color") {
					color.push(value); 
					getParams['color'].push(value);
				};
			};
		};
		

		if(size.length > 0) {
			var strSize = "";
			strSize = size.join('+');
			strSize = "size="+strSize;
			str.push(strSize);
		};
		if(brand.length > 0) {
			var strBrand = "";
			strBrand = brand.join('+');
			strBrand = "brand="+strBrand;
			str.push(strBrand);
		};
		if(material.length > 0) {
			var strMaterial = "";
			strMaterial = material.join('+');
			strMaterial = "material="+strMaterial;
			str.push(strMaterial);
		};
		if(color.length > 0) {
			var strColor = "";
			strColor = color.join('+');
			strColor = "color="+strColor;
			str.push(strColor);
		};
		if(minPrice.length > 0) {
			var strminPrice = "";
			strminPrice = "minPrice="+minPrice;
			str.push(strminPrice);
			checkCount++;
		};
		if(maxPrice.length > 0) {
			var strmaxPrice = "";
			strmaxPrice = "maxPrice="+maxPrice;
			str.push(strmaxPrice);
			checkCount++;
		};

		if(maxPrice != "") getParams['maxPrice'] = maxPrice; 
		if(minPrice != "") getParams['minPrice'] = minPrice; 

		str = str.join('&');

		history.pushState("", "Title", "?"+str);

		if(checkCount > 0) {
			$('.reset-filter').animate({
			'height':'35px'
			});
		} else {
			$('.reset-filter').animate({
			'height':'0px'
			});
		};

		if(!getParams['sort']) {
			var sort_parametr = "visit";
		} else {
			var sort_parametr = getParams['sort'];
		};

		getParams = JSON.stringify(getParams);
		var str = "obj="+getParams;
		$.ajax({
			type: "POST",
			url: "php/get_numbers_prod_for_filter.php",
			data: str,
			success: function (data) {
				getNumbersFormMainAddFuncProd(data, sort_parametr);
			}
		});
	};
	$('.check-wrap input[type="checkbox"]').change(function(e){ func(e) });
	$('.side-part .accord-block.accord-price button[type="button"]').click(function(e){ func(e) });
};












function validPrice() {
	$('.side-part .accord-block.accord-price input[type="text"]').keypress(function(e) {
		var key = e.charCode;
		if(48 > key || key > 57) return false;
	});
};



function resize() {
	function sidePosition() {
		var windWidth = document.documentElement.clientWidth;
		var sidePart = document.querySelector('.side-part');
		if(windWidth < 626) { 
			$(sidePart).addClass('side-small');
			sidePart.style.width = "auto";
		} else {
			$(sidePart).removeClass('side-small');
			var sideSpacer = document.querySelector('.side-part-spacer');
			var sideSpacerWidth = getComputedStyle(sideSpacer).width;
			sidePart.style.width = sideSpacerWidth;			
		};
		
	};
	sidePosition();
	window.onresize = function() {
		sidePosition();
	};
};



var ALL_PAGE = 1;
function setPageInPagenation(now, all) {
		if(all) ALL_PAGE = all;
		else all = ALL_PAGE;

		if(all > 0) $('.pagination').html('');
		if(all > 0) $('.pagination').show();
		var str = "";

		if(now != 1) str += "<div class='back-button'><a>Назад</a></div>";

		str += "<div class='butt-group'>";	
			
		for(var i = 1; i < all + 1; i++) {
			var count = i;

			if(now < 4) {
				if(i == 5) {
					if(i != all) {
						i = all - 1; 
						str += "<div class='gap'><a>...</a></div>";
						continue;
					};
				};
			} else {
				if(all > 5) {
					if(i == 2) {
						str += "<div class='gap'><a>...</a></div>";
						if(i != all) { 
							if(now + 2 < all) {
								i = now - 2;
							} else {
								i = all - 4;
							};
						};
						continue;
					};
				};
			};

					
			if(now > 3 ) {
				if(now + 2 < all) {
					if(i == now + 2) {
						str += "<div class='gap'><a>...</a></div>";
						i = all - 1;
						continue;
					};
				};
			};	

			if(i == now) str += "<div class='active'><a>"+count+"</a></div>";
			else str += "<div class='butt clickNum'><a>"+count+"</a></div>";
		};
			
		str += "</div>";
		
		if(now != all) str += "<div class='next-button'><a>Дальше</a></div>"; 

		$('.pagination').html(str);
	};






function Pagination() {

	$('.pagination').click(function(e) {
			var target = e.target;
			var value = target.innerHTML;

			if(target.parentNode.classList.contains('next-button')) {
				var activeNum = $('.pagination .active a').html();
				var setPage = +activeNum; 
				setPage++;
				setPageInPagenation(setPage);
			} else if(target.parentNode.classList.contains('back-button')) {
				var activeNum = $('.pagination .active a').html();
				var setPage = +activeNum;
				setPage--;
				setPageInPagenation(setPage);
			} else if(target.parentNode.classList.contains('clickNum')) {
				var value = target.innerHTML;
				var setPage = +value;
				setPageInPagenation(setPage);
			} else {
				return;
			};

			var getParams = parseGETParameters();
			getParams['page'] = setPage;
			var arr = [];
			for(var key in getParams) {
				arr.push(key+"="+getParams[key]); 
			};
			str = arr.join('&');
			history.pushState("", "Title", "?"+str);
			document.querySelector('.main-part').innerHTML = "";
			getProductForFilter(MAIN_COUNT_PAGE[setPage - 1]);

	});

};



function back_Up() {
	var where_back = 180;
	var back_up = $('.foot-panel .back-up');
	
	$(document).scroll(function(){
		var back_up = $('.foot-panel .back-up');
		if(pageYOffset > where_back) {
			$(back_up).addClass('back-up-active');
		} else {
			$(back_up).removeClass('back-up-active');
			$(back_up).unbind('click.up');
		};
		return false;
	});
	
	$(back_up).on('click.up', function() { 
		if(pageYOffset > where_back) {
			$('html, body').animate({scrollTop: 0}, 300);
		};
	});
};



function Like() {
	this.show_like = function(target) {
		var like = target.parentNode.querySelector('.liked');
		$(like).show();
	};
	this.hide_like = function(target) {
		var like = target.parentNode.querySelector('.liked');
		$(like).hide();
	};
	this.set_like = function(target) {
		if(target.className == "hard") target = target.parentNode;
		var id = target.parentNode.parentNode.parentNode.getAttribute("data-product-id");
		$.ajax({
			type: 'POST',
			data: 'id=' + id,
			url: "php/set_like.php",
			success: function(data) {
				data = data.trim();
				if(data == "nologin") {
					alert('Сперва зарегистрируйтесь');
					return;
				} else if(data == "absent") {
					$(target).addClass('hard-active');
				} else if(data == "present") {
					$(target).removeClass('hard-active');
				};
			}
		});

	};
};
var like = new Like();


function productEvent() {
	$('.product .image').mouseover(function(e) {
		var target = e.target;
		like.show_like(target);
	});
	$('.product .image').mouseleave(function(e) {
		var target = e.target;
		like.hide_like(target);
	});
	$('.product .image .liked').click(function(e) {
		var target = e.target;	
		like.set_like(target);
		return false;
	});
};





function sort_functions() {
	var menuSort = $('.spacer .sort ul');
	var time = 300;

	$(menuSort).mouseenter(function() {
		var menuSort = document.querySelector('.spacer .sort ul');

		for(var i = 4; i > 0; i--) {
			if($(menuSort.children[i]).is(':animated') == true) {
				for(var j = 4; j > 0; j--) {
					$(menuSort.children[j]).stop();
					$(menuSort.children[j]).css({'margin-top':'0px'});
				};
			};
		};
		for(var i = 4; i > 0; i--) {
		var interval = -(i - 4) * (time/4);
				$(menuSort.children[i]).delay(interval).animate({ 
					'margin-top': 26 * i + "px" 
				}, { 
					duration: time - (time/4) * -(i - 4),
					easing: "linear"
				}); 
		};
		setTimeout(function() {
			$(menuSort.children).on('mouseenter.color', function(e) {
				var target = e.target;
				$(target).css({'color':'white', 'background':'rgb(46,46,46)'});
			});
			$(menuSort.children).on('mouseleave.color', function(e) {
				var target = e.target;
				$(target).css({'color':'', 'background':''});
			});
		}, time);
	});

	$(menuSort).mouseleave(function() {
		var menuSort = document.querySelector('.spacer .sort ul');

		$(menuSort.children).unbind('mouseenter.color');
		$(menuSort.children).unbind('mouseleave.color');

		for(var i = 4; i > 0; i--) {
			if($(menuSort.children[i]).is(':animated') == true) {
				for(var j = 4; j > 0; j--) {
					$(menuSort.children[j]).stop();
					$(menuSort.children[j]).css({'margin-top':'0px'});
				};
			};
		};

		for(var i = 4; i > 0; i--) {
		var interval = -(i - 4) * (time/4);
				$(menuSort.children[i]).delay(interval).animate({ 
					'margin-top': 0 + "px" 
				}, { 
					duration: time - (time/4) * -(i - 4),
					easing: "linear"
				}); 
		};
	});

	$('.spacer .sort ul li a').click(function(e) {
		var target = e.target;
		var value = target.innerHTML;
		var data = []
		for(var i = 0; i < MAIN_COUNT_PAGE.length; i++) {
			for(var j = 0; j < MAIN_COUNT_PAGE[i].length; j++) {
				data.push(MAIN_COUNT_PAGE[i][j]);
			};
		};
		if(value == 'возрастанию цены') var sort_parametr = "price_up";
		if(value == 'убыванию цены') var sort_parametr = "price_down";
		if(value == 'популярности') var sort_parametr = "visit";
		if(value == 'новинкам') var sort_parametr = "new";
		if(value == 'скидкам') var sort_parametr = "discount";

		var getParams = parseGETParameters();
		getParams['sort'] = sort_parametr;
		var arr = [];
		for(var key in getParams) {
			arr.push(key+"="+getParams[key]); 
		};
		str = arr.join('&');

		history.pushState("", "Title", "?"+str);
		
		data = JSON.stringify(data);
		getNumbersFormMainAddFuncProd(data, sort_parametr);
	});

};




function changePhoto() {
	$('.mini-photo').click(function(e) {
		var target = e.target;
		if($(target).hasClass('mini-photo')) target = target.children[0];
		var src = $(target).attr('src');
		$('.frame img').attr('src', src);
		$('.frame a').attr('href', src);
		$('.mini-photo').removeClass('active-mini');
		target.parentNode.classList.add('active-mini');
		return false;
	});

	$('.navigation').click(function(e) {
		var miniPhoto = $('.mini-photo');
		for(var i = 0; i < miniPhoto.length; i++) {
			if($(miniPhoto[i]).hasClass('active-mini')) {
				if($(this).hasClass('photo-next')) {
					var j = i + 1;
					if(i == miniPhoto.length - 1) j = 0;
					var src = $(miniPhoto[j].children[0]).attr('src');
					$('.mini-photo').removeClass('active-mini');
					$(miniPhoto[j]).addClass('active-mini');
					$('.frame img').attr('src', src);
					$('.frame a').attr('href', src);
					break;
				} else if($(this).hasClass('photo-back')) {
					var j = i - 1;
					if(i == 0) j = miniPhoto.length - 1;
					var src = $(miniPhoto[j].children[0]).attr('src');
					$('.mini-photo').removeClass('active-mini');
					$(miniPhoto[j]).addClass('active-mini');
					$('.frame img').attr('src', src);
					$('.frame a').attr('href', src);
					break;
				};
			};
		};
	});
};



function zoomPhoto() {
	$('.frame a').mouseenter(function(e) {
		var zoom = $('.frame .zoom');
		var zoomHeight = $(zoom).css('height');
		var h2 = parseInt(zoomHeight)/2;
		$(zoom).show();

		var miniPhoto = $('.mini-photo');
		for(var i = 0; i < miniPhoto.length; i++) {
			if($(miniPhoto[i]).hasClass('active-mini')) {
				var src = $(miniPhoto[i].children[0]).attr('src');
			};
		};
		src = "url('../"+src+"')";
		zoom.css({'background-image':src});

		//вычисляем коэфициент прокрутки 
		var imgWidth = $('.frame img').width();
		var imgHeight = $('.frame img').height();
		var deffer = imgWidth - imgHeight;
		var naturalHeight = imgHeight - (deffer + 169);
		
		var hLongScrollZOOM = $('.frame img').height() - $(zoom).height();
		var hLongScrollBG = naturalHeight - $(zoom).height();

		var coeff = hLongScrollBG / hLongScrollZOOM * 3.2;
		if(coeff < 0) coeff *= -1/3;
		$('.frame').on('mousemove.zoom', function(e) {
			var coordY = e.pageY;
			var elTop = this.getBoundingClientRect().top + pageYOffset;
			coordY -= elTop + h2;

			var topLimit = elTop + h2;
			var bottomLimit = this.getBoundingClientRect().bottom + pageYOffset - h2;
			if(e.pageY < topLimit) coordY = 0;
			else if(e.pageY > bottomLimit) coordY = this.clientHeight - h2*2;
			
			$(zoom).css({'top': coordY});

			var bgPos = "0 -"+coordY*coeff+"px ";
			$(zoom).css({'background-position': bgPos});
		});

	});

	$('.frame a').mouseleave(function(e) {
		var target = e.relatedTarget;
		if(!$(target).hasClass('zoom')) $('.frame .zoom').hide();
	});
};



function changeSize() {
	$('input[name="size"]').focus(function() { 
		$('.select-box').show(); 
		$('.select-arrow').addClass('arrow-active');
	});
	$('.size-block').click(function(e) {
		var value = this.children[0].children[0].innerHTML;
		$('input[name="size"]').val("Размер "+value+" выбран");
		$('input[name="size"]').attr('data-size', value);
	}); 
	$('input[name="size"]').blur(function() { 
		setTimeout(function() { 
		$('.select-box').hide();
		$('.select-arrow').removeClass('arrow-active');
		}, 100); 
	});
	$('.select-arrow').click(function() { 
		$('.select-box').toggle(); 
		$('.select-arrow').toggleClass('arrow-active');
	});
	$('input[name="size"]').keydown(function() { return false; });
};


function buttons() {
	$('.to-liked').click(function() {
		getParams = parseGETParameters();
		var id = getParams['id'];
		var bind_this = this;
		$.ajax({
			type: 'POST',
			data: 'id=' + id,
			url: "php/set_like.php",
			success: function(data) {
				data = data.trim();
				if(data == 'absent') {
					var button = bind_this.children[0];
					$(button).attr('data-liked', 'true');
					$(button).animate({width: '100%'}, 300);
				} else if(data == 'present') {
					var button = bind_this.children[0];
					setTimeout(function() { $(button).attr('data-liked', 'false'); }, 200);
					$(button).animate({width: '40px'}, 200);
				} else if(data == 'nologin') {
					$('.click-to-enter').trigger('click');
				};
			}
		});

	});
	$('.to-liked').mouseenter(function() {
		var attr = $('.to-liked button[name="addToLiked"]').attr('data-liked');
		if(attr == 'false') {
			var button = this.children[0];
			$(button).stop();
			$(button).animate({width: '50px', background:'black'}, 200);
		};
	});
	$('.to-liked').mouseleave(function() {
		var attr = $('.to-liked button[name="addToLiked"]').attr('data-liked');
		if(attr == 'false') {
			var button = this.children[0];
			$(button).stop();
			$(button).animate({width: '40px'}, 200);
		};
	});
	$('button[name="addToBasket"]').click(function() {
		var size = $('input[name="size"]').val();
		if(size == "Выберите размер") {
			alert('Выберите размер');
			return;
		} else if(size == "Нет в наличии") {
			alert('Товара нет в наличии')
			return;
		};
		
		var id_product = this.getAttribute("data-id-product");
		var size = $('input[name="size"]').attr('data-size');
		var str = 'id_product=' + id_product + '&size=' + size + '&act=add';
		$.ajax({
			type: 'POST',
			data: str,
			url: "php/add_to_basket.php",
			success: function(data) {
				data = data.trim();
				if(data == "nologin") {
					$('.click-to-enter').trigger('click');
					return;
				};
				data = JSON.parse(data);
				if(data['full'] == "full") {
					$('.bask-head').html('Добавленно максимальное кол-во товара в наличии');
				} else {
					$('.bask-head').html('Товар добавлен в корзину');
				};
				$('#show_my_basket .all-add-to-basket').html(data['count'] + " " + word_declination(data['count']));
				$('.bask-counter').html(data['count']);
				$('input[name="open_my_basket"]').trigger('click');
				$.ajax({
					type: 'POST',
					data: str,
					url: "php/get_my_basket.php",
					success: function(data) {
						var obj = JSON.parse(data);
						var str = "";
						var gender = getLinkGender();

						function add(i) {
							var discountStr = "";
							if(obj[i]['discount'] != 0 && obj[i]['discount'] != "") {
								var priceClass = "bask-price line-through";
								discountStr = "<p class='bask-discount'>"+obj[i]['discount']+" €</p>";
							} else  var priceClass = "bask-price";

							str += "<div class='large-12 block-bask-product'>\
										<div class='large-2 medium-2 small-3 columns'>\
											<a href='http://aleksa/product.php?"+gender+"&id="+obj[i]['id']+"' class='bask-photo'>\
												<img src='image/"+obj[i]['id']+"/"+obj[i]['photoMain']+"' alt='"+obj[i]['shot_descriptio']+"'>\
											</a>\
										</div>\
										<div class='large-7 medium-7 small-4 columns'>\
											<p class='bask-name'>"+obj[i]['name']+"</p>\
											<p class='bask-description'>"+obj[i]['shot_description']+"</p>\
											<p class='"+priceClass+"'>"+obj[i]['price']+" €</p>"+discountStr+"\
										</div>\
										<div class='large-3 medium-3 small-5 columns'>\
											<p class='bask-size'>Размер: <span>"+obj[i]['size']+"</span></p>\
											<p class='bask-count'>Кол-во: <span>"+obj[i]['count']+" шт</span></p>\
										</div>\
									</div>";
						};

						for(var i = obj.length - 1; i > -1; i--) {
							if(id_product == obj[i]['id'] && size == obj[i]['size']) {
								add(i); 
								str += "<hr/>";
								break;
							};
						};
						for(var i = obj.length - 1; i > -1; i--) {
							if(id_product == obj[i]['id'] && size == obj[i]['size']) continue;
							add(i);
						};

						$('#show_my_basket .bask-product-wrapp .row').html(str);
					}
				});
			}
		});
	});
};




function reclickTabs() {
	$('.info-wrapp .tab').click(function() {
		var dataAttr = $(this).attr('data-tab');
		$('.info-wrapp .tab').removeClass('is-active-tab');
		$(this).addClass('is-active-tab');
		$('.info-wrapp .tab-panel').removeClass('is-active-tab');
		$('.info-wrapp .tab-panel').css({'right':'-450px'});
		var tabPanel = $('.info-wrapp .tab-panel');
		for(var i = 0; i < tabPanel.length; i++) {
			if($(tabPanel[i]).attr('data-panel') == dataAttr) { 
				$(tabPanel[i]).addClass('is-active-tab'); 
				$(tabPanel[i]).animate({'right':'0'}, 200);
				return; 
			};
		};
	});

	$('.message .tab').click(function() {
		var dataAttr = $(this).attr('data-tab');
		$('.message .tab').removeClass('is-active-tab');
		$(this).addClass('is-active-tab');
		$('.message .tab-panel').removeClass('is-active-tab');

		if($('.button-to-message').html() != "Закрыть панель") {
			if(dataAttr == "comment") $('.button-to-message').html('Оставить отзыв');
			else if(dataAttr == "question") $('.button-to-message').html('Задать вопрос');
		};

		var tabPanel = $('.message .tab-panel');
		for(var i = 0; i < tabPanel.length; i++) {
			if($(tabPanel[i]).attr('data-panel') == dataAttr) { 
				$(tabPanel[i]).addClass('is-active-tab'); 
				return; 
			};
		};
	});

};



function writeMessage() {
	$('.button-to-message').click(function () {
		if($(this).attr('state') != "true") {
			$('.click-to-enter').trigger('click');
			return;
		};
		$('.write-message').toggleClass('active-message');
		$('.write-message').stop();
		if($('.write-message').hasClass('active-message')) {
			$('.write-message').slideDown();
			$('.button-to-message').html('Закрыть панель');
		} else {
			$('.write-message').slideUp();
			var attr = $('.message .tab.is-active-tab').attr('data-tab');
			var str = "";
			if(attr == 'comment') str = "Оставить отзыв";
			else if(attr == 'question') str = "Задать вопрос";
			$('.button-to-message').html(str);
		};
	});

	$('form[name="sendMessage"]').submit(function() {
		var email = $('input[name="email"]').val();
		var name = $('input[name="name"]').val();
		var id_user = $('input[name="id_user"]').val();
		var id_product = $('input[name="id_product"]').val();
		var message = $('textarea[name="text-message"]').val();
		var section = $('.message .tab.is-active-tab').attr('data-tab');

		var str = "email="+email+"&name="+name+"&id_user="+id_user+"&id_product="+id_product+"&message="+message+"&section="+section;
		$.ajax({
			type: 'POST',
			data: str,
			url: "php/send_message.php",
			success: function(data) {
				data = data.trim();

				if(data == 'true') {
					if(section == 'comment') {
						var str = "<p>Спасибо за Ваш отзыв. Он будет добавлен как только пройдёт модерацию администрацией сайта.</p>";
					} else if(section == 'question') {
						var str = "<p>Мы приняли Ваш вопрос. В ближайшее время Мы пришлём Вам ответ на эл.почту, а так же в личный кабинет сайта.</p>";
					}; 
					
					$('.write-message').html(str)
				};
			}
		});
		return false;
	});
};


function word_declination(sum) {
    if(sum == 0 || sum >= 5) return "товаров";
    else if(sum == 1) return "товар";
    else if(sum > 1 && sum < 5) return "товара";
};


function change_sum_product() {
	$('.size-counter').click(function() {
		var target = this;
		if($(this).hasClass('limit-on')) return;
		if($(this).hasClass('less')) {
			var act = "del";
		} else if($(this).hasClass('more')) {
			var act = "add";
		};
		var id_product = this.parentNode.parentNode.parentNode.getAttribute("data-id-product");
		var size = this.parentNode.parentNode.querySelector('.bask-size').children[0].innerHTML;
		var str = 'id_product=' + id_product + '&size=' + size + '&act=' + act;
		
		$.ajax({
			type: 'POST',
			data: str,
			url: "php/add_to_basket.php",
			success: function(data) {
				data = JSON.parse(data);

				target.parentNode.children[1].innerHTML = data['countThis'] + " шт";
				target.parentNode.setAttribute('data-count', data['countThis']);

				$(target.parentNode.children).removeClass('limit-on');
				if(data['countThis'] == 1) $(target.parentNode.querySelector('.size-counter.less')).addClass('limit-on');
				if(data['countThis'] >= data['countMax']) $(target.parentNode.querySelector('.size-counter.more')).addClass('limit-on');
			
				var price = target.parentNode.parentNode.parentNode.querySelector('.bask-price').getAttribute('data-price');
				$(target.parentNode.parentNode.querySelector('.bask-all-price')).html("Всего: <span>" + price * data['countThis'] + " €</span>");

				$('.all-add-to-basket').html(data['count'] + " " + word_declination(data['count']));
				$('.bask-counter').html(data['count']);


				var block_bask = $('.block-bask-product');
				var allPrice = 0;
				for(var i = 0; i < block_bask.length; i++) {
					var block = block_bask[i];
					var this_price = block.querySelector('.bask-price').getAttribute('data-price');
					var this_count = block.querySelector('.bask-count').getAttribute('data-count');
					allPrice += this_price * this_count;
				};
				$('.all-price-in-basket').html(allPrice + " €");

				$('.checkout-result .end-price').html(allPrice + " €");
				$('.in-total .checkout-str').html(data['count'] + " " + word_declination(data['count']) + " на сумму " + allPrice + " €");
			}
		});
	});
};



function delete_product_from_bask() {
	$('.bask-delete').click(function() {
		var target = this;
		var id_product = $(this.parentNode).attr('data-id-product');
		var size = $(this.parentNode.querySelector('.bask-size').children[0]).html();
		var str = 'id_product=' + id_product + '&size=' + size;
		$.ajax({
			type: 'POST',
			data: str,
			url: "php/remove_from_basket.php",
			success: function(data) {
				data = JSON.parse(data);

				$(target.parentNode).remove();

				$('.all-add-to-basket').html(data['count'] + " " + word_declination(data['count']));
				$('.bask-counter').html(data['count']);

				var block_bask = $('.block-bask-product');
				var allPrice = 0;
				for(var i = 0; i < block_bask.length; i++) {
					var block = block_bask[i];
					var this_price = block.querySelector('.bask-price').getAttribute('data-price');
					var this_count = block.querySelector('.bask-count').getAttribute('data-count');
					allPrice += this_price * this_count;
				};
				$('.all-price-in-basket').html(allPrice + " €");

				$('.checkout-result .end-price').html(allPrice + " €");
				$('.in-total .checkout-str').html(data['count'] + " " + word_declination(data['count']) + " на сумму " + allPrice + " €");
				if(data['count'] < 1) $('input[type="submit"]').remove(); 
			}
		});

	});
};



function option() {
	$('.main-form .in-total select').selectbox();
};

function read_only() {
    $('form[name="checkout"] input[name="name"]').keydown(function() { return false; })
    $('form[name="checkout"] input[name="email"]').keydown(function() { return false; })
    $('form[name="checkout"] input[name="tel"]').keydown(function() { return false; })
};


function make_an_order() {
	$('form[name="checkout"]').submit(function() {
		var id_user = $('input[name="id_user"]').val();
		var email = $('input[name="email"]').val();
		var comment = $('textarea[name="comment"]').val();

		var str = "id_user=" + id_user + "&email=" + email + "&comment=" + comment;
		$.ajax({
			type: 'POST',
			data: str,
			url: "php/make_an_order.php",
			success: function(data) {
				data = data.trim();
				if(data == "abort" || data != "true") {
					alert('Ошибка! Обновите страницу и повторите попытку');
				} else {
					$('#show_my_basket').parent().remove();
					$('.notification-for-order').show();
				};
			}
		});


		return false;
	});
};












