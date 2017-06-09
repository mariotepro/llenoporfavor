
var manufacturer, model, fuel, year, doors, engine, hp;

$(document).ready(function() {
	loadSelect("manufacturer");
	$("#manufacturer").change(				function(){		manufacturerSelected();									});
	$("#model").change(						function(){		modelSelected();										});
	$("#fuel").change(						function(){		fuelSelected();											});
	$("#year").change(						function(){		yearSelected();											});
	$("#doors").change(						function(){		doorsSelected();										});
	$("#engine").change(					function(){		engineSelected();										});
	$("#ohp").on('input', 					function(){		validate();												});
	$("#submit").click(						function(){ 	if(!$(this).hasClass('disabled')) 		addModel(); 	});
	preventingAlphabet();
});

function manufacturerSelected() {
	if ($("#manufacturer").val() != "") 	{
		loadSelect("model", $("#manufacturer").val());
		$('#model').prop('disabled', false);
		if (!$('#model').is(':disabled'))  				$('#fuel, #year, #doors, #engine, #hp, #omodel, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
		if ($("#manufacturer").val() == "other") {
			$('#model, #year, #doors, #engine, #hp').prop('disabled', true);
			$('#omanufacturer, #omodel, #oyear, #odoors, #oengine, #ohp, #fuel').prop('disabled', false);
		} else 											$('#omanufacturer, #omodel, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
	}
}

function modelSelected() {
	if ($("#model").val() != "") 	{
		$('#fuel').prop('disabled', false);
		$('select').material_select();
		if (!$('#fuel').is(':disabled')) 				$('#year, #doors, #engine, #hp, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
		if ($("#model").val() == "other") {
			$('#year, #doors, #engine, #hp').prop('disabled', true);
			$('#omodel, #oyear, #odoors, #oengine, #ohp, #fuel').prop('disabled', false);
		} else 											$('#omodel, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
	}
}

function fuelSelected() {
	if ($("#fuel").val() != "") 	{
		loadSelect("year", $("#manufacturer").val(), $("#model").val(), $("#fuel").val());
		if (!$("#model").is(':disabled'))				$('#year').prop('disabled', false);
		if (!$('#year').is(':disabled')) 				$('#doors, #engine, #hp, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
	}
}

function yearSelected() {
	if ($("#year").val() != "") 	{
		loadSelect("doors", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val());
		$('#doors').prop('disabled', false);
		if (!$('#doors').is(':disabled')) 				$('#engine, #hp, #oyear, #odoors, #oengine, #ohp').prop('disabled', true);
		if ($("#year").val() == "other") {
			$('#doors, #engine, #hp').prop('disabled', true);
			$('#oyear, #odoors, #oengine, #ohp').prop('disabled', false);
		} else											$('#oyear, #odoors, #oengine, #ohp').prop('disabled', true);
	}
}

function doorsSelected() {
	if ($("#doors").val() != "") 	{
		loadSelect("engine", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val(), $("#doors").val());
		$('#engine').prop('disabled', false);
		if (!$('#engine').is(':disabled'))				$('#hp, #odoors, #oengine, #ohp').prop('disabled', true);
		if ($("#doors").val() == "other") {
			$('#engine, #hp').prop('disabled', true);
			$('#odoors, #oengine, #ohp').prop('disabled', false);
		} else											$('#odoors, #oengine, #ohp').prop('disabled', true);
	}
}

function engineSelected() {
	if ($("#engine").val() != "") 	{
		var cc 			=   $("#engine").val().indexOf("cc");
		engine			=	$("#engine").val().slice(0, cc);
		loadSelect("hp", $("#manufacturer").val(), $("#model").val(), $("#fuel").val(), $("#year").val(), $("#doors").val(), engine);
		$('#hp').prop('disabled', false);
		if (!$('#hp').is(':disabled'))					$('#oengine, #ohp').prop('disabled', true);
		if ($("#engine").val() == "other") {
			$('#hp').prop('disabled', true);
			$('#oengine, #ohp').prop('disabled', false);
		} else											$('#oengine, #ohp').prop('disabled', true);
	}
}

function hpSelected() {
	if ($("#hp").val() != "other") 	{
		$('#ohp').prop('disabled', false);
	}
}

function getValues() {
	manufacturer 	= $('#omanufacturer').is(':disabled') 	? $('#manufacturer').val() 	: $('#omanufacturer').val();
	model 			= $('#omodel').is(':disabled') 			? $('#model').val() 		: $('#omodel').val();
	year 			= $('#oyear').is(':disabled') 			? $('#year').val() 			: $('#oyear').val();
	doors 			= $('#odoors').is(':disabled') 			? $('#doors').val() 		: $('#odoors').val();
	engine 			= $('#oengine').is(':disabled') 		? $('#engine').val() 		: $('#oengine').val();
	hp 				= $('#ohp').is(':disabled') 			? $('#hp').val() 			: $('#ohp').val();
	fuel 			= $('#fuel').val();
}

function validate() {
	getValues();
	var isModelOk 	= 	(!$('#ohp').is(':disabled'));
	var allParamsOk =	areParamsOk();

	if (isModelOk && allParamsOk) 									$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))					$("#submit").addClass('disabled');  
}

function preventingAlphabet() {
    $('#oyear, #odoors, #oengine, #ohp').keypress(function(key) {
    	if(key.charCode >= 48 && key.charCode <= 57) 	return true;
    	else if (key.charCode == 46)					return true;
    	else 											return false;
	});
}

function areParamsOk() {
	if ($('#omanufacturer').hasClass('invalid'))	return false;
	if ($('#omodel').hasClass('invalid'))			return false;
	if ($('#oyear').hasClass('invalid'))			return false;
	if ($('#odoors').hasClass('invalid'))			return false;
	if ($('#oengine').hasClass('invalid'))			return false;
	if ($('#ohp').hasClass('invalid'))				return false;
	if ($('#fuel').hasClass('invalid'))				return false;
	if (manufacturer.length == 0)					return false;
	if (model.length == 0)							return false;
	if (year.length == 0)							return false;
	if (doors.length == 0)							return false;
	if (engine.length == 0)							return false;
	if (hp.length == 0)								return false;
	if (fuel.length == 0)							return false;
	return true;
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
			option = "<option value='other'>Otro</option>";
			$('#'+ what).append(option);
			$('select').material_select();
		}
    }
    xmlhttp.open("POST", "php/newModelLoader.php", true);
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
		case 7:
			xmlhttp.send("load=" + what + "&manufacturer=" + arguments[1]+ "&model=" + arguments[2]+ "&fuel=" + arguments[3]+ "&year=" + arguments[4]+ "&doors=" + arguments[5] + "&engine=" + arguments[6]);
			break;
	}
}

function addModel() {
	getValues();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() 	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 	window.location="newVehicle.php?id="+xmlhttp.responseText; 
	}
    xmlhttp.open("POST", "php/addModel.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("&manufacturer=" 	+ manufacturer 
				+ "&model=" 		+ model 
				+ "&fuel=" 			+ fuel 
				+ "&year=" 			+ year 
				+ "&doors=" 		+ doors
				+ "&engine=" 		+ engine
				+ "&hp=" 			+ hp);
}