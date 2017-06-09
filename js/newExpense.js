var type, date, km, fuelkm, fuelq, price, fuelc, fuels, description, vehicle_id;

$(document).ready(function() {
	vehicle_id = getQueryVariable("id");
	getUserID();
	$('#date, #dateo').val(new Date().toDateInputValue());
	$('#type').change(												function(){		showForm();		 	});
	$("#km, #fuel_km, #fuel_quantity").on('input', 					function(){		validate();			});
	$("#price, #fuel_consumption, #fuel_speed").on('input', 		function(){		validate();			});
	$("#kmo, #priceo").on('input', 									function(){		validate();			});
	$("#description, #descriptiono").on('input', 					function(){		validate();			});
	$("#date, #dateo").change(										function(){		validate();			});
	$("#submit").click(												function(){ 	if(!$(this).hasClass('disabled')) 		addExpense(); 	});
	$(window).keypress(												function(e){	if (e.which == 13  && !$("#submit").hasClass('disabled')) { 
																															addExpense()	
																															return false;}	});
	preventingAlphabet();
});

function isMyVehicle(id_user) {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			if (xmlhttp.responseText != "0") window.location="profile.php";
    }
    xmlhttp.open("POST", "php/isMyVehicle.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id_veh="			+ vehicle_id
				+ "&id_user=" 		+ id_user);
}

function getUserID() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)		isMyVehicle(xmlhttp.responseText);
	}
	xmlhttp.open("POST", "php/getSessionID.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("");
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

function addExpense() {
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
    xmlhttp.open("POST", "php/addExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id_veh="			+ vehicle_id
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
    xmlhttp.open("POST", "php/addExpense.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id_veh="			+ vehicle_id
				+ "&type=" 			+ type		
				+ "&date=" 			+ date
				+ "&km=" 			+ km 
				+ "&price=" 		+ price 
				+ "&description=" 	+ description);
}