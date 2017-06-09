
var id_user, manufacturer, model, fuel, year, doors, engine, hp, color, description, photo;

$(document).ready(function() {
	vehicle_id = getQueryVariable("id");
	if (vehicle_id === undefined)			window.location="profile.php";
	else 									loadVehicle();
	$("#manufacturer").change(				function(){		manufacturerSelected();									});
	$("#model").change(						function(){		modelSelected();										});
	$("#fuel").change(						function(){		fuelSelected();											});
	$("#year").change(						function(){		yearSelected();											});
	$("#doors").change(						function(){		doorsSelected();										});
	$("#engine").change(					function(){		validate();												});
	$("#color, #description").on('input', 	function(){		validate();												});
	$("#filetext").change(					function(){		$('#submit').addClass('disabled');	setTimeout(function() {	validate();}, 1000	)});
	$("#submit").click(						function(){ 	if(!$(this).hasClass('disabled')) 		modify(); 	});
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
	var vehicleOk 		= 	($("#hp").val() != "" && (!$("#hp").is(':disabled')));
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
		$('select').material_select();
	}
}

function modelSelected() {
	if ($("#model").val() != "") 	{
		$('#fuel').prop('disabled', false);
		if ($("#fuel").val() != "") 					fuelSelected();
		if (!$('#year').is(':disabled')) 				$('#year, #doors, #engine').prop('disabled', true);
		validate();
		$('select').material_select();
	}
}

function fuelSelected() {
	if ($("#fuel").val() != "") 	{
		loadSelect("year", $("#manufacturer").val(), $("#model").val(), $("#fuel").val());
		$('#year').prop('disabled', false);
		if (!$('#year').is(':disabled')) 				$('#doors, #engine').prop('disabled', true);
		validate();
		$('select').material_select();
	}
}

function yearSelected() {
	if ($("#year").val() != "") 	{
		loadSelect("doors", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val());
		$('#doors').prop('disabled', false);
		if (!$('#engine').is(':disabled')) 				$('#engine').prop('disabled', true);
		validate();
		$('select').material_select();
	}
}

function doorsSelected() {
	if ($("#doors").val() != "") 	{
		$('#engine').prop('disabled', false);
		loadSelect("engine", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val(), $("#doors").val());
		validate();
		$('select').material_select();
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
			var res = xmlhttp.responseText.split(';');
			for (var i=0; i < res.length - 1; i++) {
				option = "<option value='" + res[i] + "'>" + res[i] + "</option>";
				$('#'+ what).append(option);
			};
			$('select').material_select();
		}
    }
    xmlhttp.open("POST", "php/newVehicleLoader.php", false);
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

function modify() {
	getValues();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() 	{ 
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 	window.location="profile.php";
	}
    xmlhttp.open("POST", "php/modUserVehicle.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="				+ vehicle_id
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

function loadModel (id_model) {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText;
			if (res == "0") 			window.location="profile.php";
			else {
				var res = xmlhttp.responseText.split(';');
				loadSelect('manufacturer');
				//option = "<option value='" + res[0] + "' selected>" + res[0] + "</option>";
				$('#manufacturer').val(res[0]);
				loadSelect('model', res[0]);
				//option = "<option value='" + res[1] + "' selected>" + res[1] + "</option>";
				$('#model').val(res[1]);
				//option = "<option value='" + res[2] + "' selected>" + res[2] + "</option>";
				$('#fuel').val(res[2]);
				loadSelect('year', res[0], res[1], res[2]);
				//option = "<option value='" + res[3] + "' selected>" + res[3] + "</option>";
				$('#year').val(res[3]);
				loadSelect('doors', res[0], res[1], res[2], res[3]);
				//option = "<option value='" + res[4] + "' selected>" + res[4] + "</option>";
				$('#doors').val(res[4]);
				loadSelect('engine', res[0], res[1], res[2], res[3], res[4]);
				//option = "<option value='" + res[5] + "' selected>" + res[5] + "</option>";
				$('#engine').val(res[5]);
				$('select').material_select();	
			}
		}
	}
	xmlhttp.open("POST", "php/newModelLoader.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("load=id&id=" + id_model);
	$('#manufacturer, #model, #fuel, #year, #doors, #engine').prop('disabled', false);
}

function loadVehicle() {
		if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText.split(";");
			if (res[0] != 1) window.location="profile.php";
			loadModel(res[1]);
			if (res[2].length != 0) 	$("label[for='color']").addClass('active');
			if (res[3].length != 0) 	$("label[for='description']").addClass('active');
			$("#color").val(res[2]);
			$("#description").val(res[3]);
			$("#filetext").val(res[4]);
		}
	}
	xmlhttp.open("POST", "php/modVehicleLoader.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + vehicle_id);
}