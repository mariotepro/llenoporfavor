
var id_user, manufacturer, model, fuel, year, doors, engine, hp, color, description, photo;

$(document).ready(function() {
	vehicle_id = getQueryVariable("id");
	getUserID();
	if (vehicle_id === undefined)			loadSelect("manufacturer");
	else 									loadModel(vehicle_id);
	$("#manufacturer").change(				function(){		manufacturerSelected();									});
	$("#model").change(						function(){		modelSelected();										});
	$("#fuel").change(						function(){		fuelSelected();											});
	$("#year").change(						function(){		yearSelected();											});
	$("#doors").change(						function(){		doorsSelected();										});
	$("#engine").change(					function(){		validate();												});
	$("#color, #description").on('input', 	function(){		validate();												});
	$("#filetext").change(					function(){		$('#submit').addClass('disabled');	setTimeout(function() {	validate();}, 1000	)});
	$("#submit").click(						function(){ 	if(!$(this).hasClass('disabled')) 		addVehicle(); 	});
	$("#file").change(function() {
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))	{
			return false;
		} else {
			var reader = new FileReader();
			reader.readAsDataURL(this.files[0]);
		}
	});

	$("#uploadimage").on('submit',(function(e) {
		e.preventDefault();
		Materialize.toast('Espera a que se termine de subir la imagen, por favor. Tardará unos segundos', 4000, 'rounded');
		$.ajax({
			url: "ajax_php_file.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)	{
				$('#filetext').removeClass('invalid');
				$('#filetext').addClass('valid'); 
				$('#file, #imgUp').prop('disabled', true);
				$('#file, #imgUp').addClass('disabled');
				validate();
				Materialize.toast('Ya hemos subido tu foto', 4000, 'rounded');
			}
		});
	}));
});

function getUserID() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)		{
			if (xmlhttp.responseText  != "") 	id_user = xmlhttp.responseText;
		} 
	}
	xmlhttp.open("POST", "php/getSessionID.php", false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("");
}


function getValues() { 
	manufacturer 	= 	$("#manufacturer").val();
	model 			=	$("#model").val();
	fuel 			=	$("#fuel").val();
	year 			=	$("#year").val();
	doors 			=	$("#doors").val();
	var engineField = 	$("#engine").val();
	var cc 			=   engineField.indexOf("cc");
	var cv 			=   engineField.indexOf("cv");
	engine			=	engineField.slice(0, cc);
	hp				=	engineField.slice(cc+2, cv);
	color			=	$("#color").val();
	description		=	$("#description").val();
	photo			= 	$("#filetext").val();
}

function validate() {
	getValues();
	var vehicleOk 		= 	($("#hp").val() != "");
	var photoOk			= 	!$('#filetext').hasClass('invalid');
	var descriptionOk 	=	!$("#description").hasClass('invalid');
	var colorOk 		=	!$("#color").hasClass('invalid');

	if (vehicleOk && photoOk && descriptionOk && colorOk) 			$('#submit').removeClass('disabled');
	else															$('#submit').addClass('disabled');	
}

function manufacturerSelected() {
	if ($("#manufacturer").val() != "") 	{
		loadSelect("model", $("#manufacturer").val());
		$('#model').prop('disabled', false);
		if (!$('#model').is(':disabled'))  				$('#fuel, #year, #doors, #engine').prop('disabled', true);
		validate();
	}
}

function modelSelected() {
	if ($("#model").val() != "") 	{
		$('#fuel').prop('disabled', false);
		$('select').material_select();
		if (!$('#fuel').is(':disabled')) 				$('#year, #doors, #engine').prop('disabled', true);
		validate();
	}
}

function fuelSelected() {
	if ($("#fuel").val() != "") 	{
		loadSelect("year", $("#manufacturer").val(), $("#model").val(), $("#fuel").val());
		$('#year').prop('disabled', false);
		if (!$('#year').is(':disabled')) 				$('#doors, #engine').prop('disabled', true);
		validate();
	}
}

function yearSelected() {
	if ($("#year").val() != "") 	{
		loadSelect("doors", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val());
		$('#doors').prop('disabled', false);
		if (!$('#engine').is(':disabled')) 				$('#engine').prop('disabled', true);
		validate();
	}
}

function doorsSelected() {
	if ($("#doors").val() != "") 	{
		loadSelect("engine", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val(), $("#doors").val());
		$('#engine').prop('disabled', false);
		validate();
	}
}

function loadSelect(what) {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var selectBox = document.getElementById(what);
			for (var i = selectBox.length - 1; i >= 1; --i) {
      			selectBox.remove(i);
  			}
			res = xmlhttp.responseText.split(';');
			for (var i=0; i < res.length - 1; i++) {
				option = "<option value='" + res[i] + "'>" + res[i] + "</option>";
				$('#'+ what).append(option);
			};
			$('select').material_select();
		}
    }
    xmlhttp.open("POST", "php/newVehicleLoader.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	switch (arguments.length) {
		case 1:
			xmlhttp.send("load=" + what);
			break;
		case 2:
			xmlhttp.send("load=" + what + "&manufacturer=" + arguments[1]);
			break;
		case 4:
			xmlhttp.send("load=" + what + "&manufacturer=" + arguments[1]+ "&model=" + arguments[2]+ "&fuel=" + arguments[3]);
			break;
		case 5:
			xmlhttp.send("load=" + what + "&manufacturer=" + arguments[1]+ "&model=" + arguments[2]+ "&fuel=" + arguments[3]+ "&year=" + arguments[4]);
			break;
		case 6:
			xmlhttp.send("load=" + what + "&manufacturer=" + arguments[1]+ "&model=" + arguments[2]+ "&fuel=" + arguments[3]+ "&year=" + arguments[4]+ "&doors=" + arguments[5]);
			break;
	}
}

function addVehicle() {
	getValues();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() 	{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 	window.location="profile.php";
	}
    xmlhttp.open("POST", "php/addVehicle.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id_user="			+ id_user
				+ "&manufacturer=" 	+ manufacturer 
				+ "&model=" 		+ model 
				+ "&fuel=" 			+ fuel 
				+ "&year=" 			+ year 
				+ "&doors=" 		+ doors
				+ "&engine=" 		+ engine
				+ "&hp=" 			+ hp
				+ "&color=" 		+ color
				+ "&description=" 	+ description
				+ "&photo=" 		+ photo);
}

function loadModel () {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText;
			if (res == "0") 			window.location="profile.php";
			else {
				var res = xmlhttp.responseText.split(';');
				option = "<option value='" + res[0] + "' selected>" + res[0] + "</option>";
				$('#manufacturer').append(option);
				option = "<option value='" + res[1] + "' selected>" + res[1] + "</option>";
				$('#model').append(option);
				option = "<option value='" + res[2] + "' selected>" + res[2] + "</option>";
				$('#fuel').append(option);
				option = "<option value='" + res[3] + "' selected>" + res[3] + "</option>";
				$('#year').append(option);
				option = "<option value='" + res[4] + "' selected>" + res[4] + "</option>";
				$('#doors').append(option);
				option = "<option value='" + res[5] + "' selected>" + res[5] + "</option>";
				$('#engine').append(option);
				$('select').material_select();	
			}
		}
	}
	xmlhttp.open("POST", "php/newModelLoader.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("load=id&id=" + vehicle_id);
	$('#manufacturer, #model, #fuel, #year, #doors, #engine').prop('disabled', true);
}