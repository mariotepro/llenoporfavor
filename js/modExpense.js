var type, date, km, fuelkm, fuelq, price, fuelc, fuels, description, vehicle_id;

$(document).ready(function() {
	id_exp = getQueryVariable("id");
	isMyExpense();
	loadExpense();
	$('#type').change(												function(){		showForm();		 	});
	$("#km, #fuel_km, #fuel_quantity").on('input', 					function(){		validate();			});
	$("#price, #fuel_consumption, #fuel_speed").on('input', 		function(){		validate();			});
	$("#kmo, #priceo").on('input', 									function(){		validate();			});
	$("#description, #descriptiono").on('input', 					function(){		validate();			});
	$("#date, #dateo").change(										function(){		validate();			});
	$("#submit").click(												function(){ 	if(!$(this).hasClass('disabled')) 		modify(); 	});
	$(window).keypress(												function(e){	if (e.which == 13  && !$("#submit").hasClass('disabled')) { 
																															modify()	
																															return false;}	});
	preventingAlphabet();
});

function isMyExpense() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			if ($.trim(xmlhttp.responseText) != "0") window.location="profile.php";
    }
    xmlhttp.open("POST", "php/isMyExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="			+ id_exp);
}

function showForm() {
		type = $('#type').val();
		$("#submit").show();
		if (type == "fueling") {
			$('#fuelingType').show(); 	
			$('#otherType').hide();
		} else {
			$('#otherType').show();		
			$('#fuelingType').hide();
		}							
}

function validate() {
	if (type == "fueling")  	validateFueling();
	else 						validateOther();
}

function getFueling() {
	date 			=   $("input[name='_submit']").val();
	km 				=	$('#km').val();
	fuelq			=	$('#fuel_quantity').val();
	price			=	$('#price').val();
	fuelkm			=	$('#fuel_km').val();
	fuelc			=	$('#fuel_consumption').val();
	fuels			=	$('#fuel_speed').val();
	description 	=	$('#description').val();
}

function validateFueling() {
	getFueling();
	var kmOk		=	((parseFloat(km).countDecimals() <= 1) 		&& !$("#km").hasClass("invalid")			&& km.length != 0);
	var fuelqOk		=	((parseFloat(fuelq).countDecimals() <= 2) 	&& !$("#fuel_quantity").hasClass("invalid")	&& fuelq.length != 0);
	var priceOk		=	((parseFloat(price).countDecimals() <= 2) 	&& !$("#price").hasClass("invalid")			&& price.length != 0);
	var fuelkmOk	=	((parseFloat(fuelkm).countDecimals() <= 1) 	&& !$("#fuel_km").hasClass("invalid"));
	var fuelcOk		=	((parseFloat(fuelc).countDecimals() <= 2) 	&& !$("#fuel_consumption").hasClass("invalid"));
	var fuelsOk		=	((parseFloat(fuels).countDecimals() <= 0) 	&& !$("#fuel_speed").hasClass("invalid"));
	var descOk    	=	!$("#description").hasClass("invalid");	
	//var usernameOk 	= 	(!$("#username").hasClass("invalid") 	&&	(username.length != 0));

	if (date && kmOk && fuelqOk && priceOk 
		&& fuelkmOk && fuelsOk && fuelcOk && descOk)		 				$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))							$("#submit").addClass('disabled');  	
}

function getOther() {
	date 			=   $("#otherType input[name='_submit']").val();
	km 				=	$('#kmo').val();
	price			=	$('#priceo').val();
	description 	=	$('#descriptiono').val();
}

function validateOther() {
	getOther();
	var kmOk		=	((parseFloat(km).countDecimals() <= 1) 		&& !$("#kmo").hasClass("invalid")		&& km.length != 0);
	var priceOk		=	((parseFloat(price).countDecimals() <= 2) 	&& !$("#priceo").hasClass("invalid")	&& price.length != 0);
	var descOk    	=	(!$("#descriptiono").hasClass("invalid") 											&& description.length != 0);	

	if (date && kmOk && priceOk && descOk)		 				$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))				$("#submit").addClass('disabled');  
}

function preventingAlphabet() {
    $('#km, #kmo, #price, #priceo, #fuel_km, #fuel_quantity, #fuel_consumption, #fuel_speed').keypress(function(key) {
    	if(key.charCode >= 48 && key.charCode <= 57) 	return true;
    	else if (key.charCode == 46)					return true;
    	else 											return false;
	});
}

function modify() {
	if (type == "fueling")  	addFueling();
	else 						addOther();
}

function addFueling() {
	getFueling();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) window.location="vehicle.php?id=" + vehicle_id;
    }
    xmlhttp.open("POST", "php/modUserExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="				+ id_exp
				+ "&type=" 			+ type
				+ "&date=" 			+ date
				+ "&km=" 			+ km 
				+ "&price=" 		+ price 
				+ "&fuelq=" 		+ fuelq 
				+ "&fuelc=" 		+ fuelc 
				+ "&fuels=" 		+ fuels 
				+ "&fuelkm=" 		+ fuelkm 
				+ "&description=" 	+ description);
}

function addOther() {
	getOther();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) window.location="vehicle.php?id=" + vehicle_id;
    }
    xmlhttp.open("POST", "php/modUserExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="				+ id_exp
				+ "&type=" 			+ type		
				+ "&date=" 			+ date
				+ "&km=" 			+ km 
				+ "&price=" 		+ price 
				+ "&description=" 	+ description);
}

function loadExpense() {
		if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText.split(";");
			$('#type').val(res[0]);
			$('select').material_select();
			showForm();
			var monthNames = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];
		    var date = new Date(res[1]);
		    var day = date.getDate();
		    var monthIndex = date.getMonth();
		    var year = date.getFullYear();
		    vehicle_id = res[9];
			if (res[0] == "fueling") {
				$("input[name='_submit']").val(res[1]);
				$('#date').val(day + " " + monthNames[monthIndex] + ", " + year);
				$('#km').val(res[2]);
				$('#description').val(res[3]);
				$('#fuel_km').val(res[4]);
				$('#fuel_quantity').val(res[5]);
				$('#fuel_consumption').val(res[6]);
				$('#fuel_speed').val(res[7]);
				$('#price').val(res[8]);
				$("label[for='date']").addClass('active');
				$("label[for='km']").addClass('active');
				$("label[for='fuel_quantity']").addClass('active');
				$("label[for='price']").addClass('active');
				if (res[3].length != 0) 	$("label[for='description']").addClass('active');
				if (res[4].length != 0) 	$("label[for='fuel_km']").addClass('active');
				if (res[6].length != 0) 	$("label[for='fuel_consumption']").addClass('active');
				if (res[7].length != 0) 	$("label[for='fuel_speed']").addClass('active');
			} else {
				$("#otherType input[name='_submit']").val(res[1]);
				$('#dateo').val(day + " " + monthNames[monthIndex] + ", " + year);
				$('#kmo').val(res[2]);
				$('#priceo').val(res[8]);
				$('#descriptiono').val(res[3]);
				$("label[for='dateo']").addClass('active');
				$("label[for='kmo']").addClass('active');
				$("label[for='priceo']").addClass('active');
				$("label[for='descriptiono']").addClass('active');
			}
		}
    }
    xmlhttp.open("POST", "php/loadExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="			+ id_exp);
}