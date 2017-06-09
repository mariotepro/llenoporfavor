/**
 * @author Mario Bastardo
 */

var id_user, username, pass, email, bdate, country, photo;

$(document).ready(function() {
	loadProfile();
	
	$("#username, #pass, #email").on('input',		function(){		validate()												});
	$("#username, #pass, #email").focus(			function(){		validate()												});
	$("#country, #bdate").change(					function(){		validate()												});
	$("#submit").click(								function(){ 	if(!$(this).hasClass('disabled')) 		modify(); 		});
	$(window).keypress(					
		function (e) {	
			if (e.which == 13  && !$("#submit").hasClass('disabled')) { 
				register();
				return false;
			}	
		}
	);
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
		Materialize.toast('Tardará unos segundos...', 4000, 'rounded');
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
	username 	= 	$("#username").val();
	pass 		= 	$("#pass").val(); 
	email 		= 	$("#email").val();
	bdate 		= 	$("input[name='_submit']").val();
	country 	= 	$("#country").val();
	photo		= 	$("#filetext").val();
}

//VALIDACION
function validate() {
	getValues();
	var usernameOk 	= 	isYourUsernameOk();
	var passOk 		= 	isPassOk();
	var emailOk		= 	isEmailOk();
	var photoOk		= 	!$('#filetext').hasClass('invalid');
	
	if (usernameOk && passOk && emailOk && bdate && country) 		$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))					$("#submit").addClass('disabled');
}

function isYourUsernameOk() {
	var valid =  (!$("#username").hasClass("invalid") && (username.length != 0));
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText;
			if (res == "1 ") {
				valid = false;
				$("label[for='username']").text("Nombre de Usuario ya en uso.");
				$("#username").removeClass("valid");
				$("#username").addClass("invalid");
			} else {
				$("label[for='username']").text("Nombre de Usuario");
				$("#username").removeClass("invalid");
				$("#username").addClass("valid");
			}
		}
    }
    xmlhttp.open("POST", "php/checkUserDisp.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("username=" + username + "&id=" + id_user);
	return valid;
}

function isPassOk() 	{	return !$("#pass").hasClass("invalid");								}
function isEmailOk() 	{	return (!$("#email").hasClass("invalid") && (email.length != 0));	}
//--VALIDACION

function modify() {
	getValues();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) window.location="profile.php";
    }
    xmlhttp.open("POST", "php/modUser.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id_user=" + id_user + "&username=" + username + "&pass=" + pass + "&email=" + email + "&bdate=" + bdate + "&country=" + country+ "&photo=" + photo);
}

function loadProfile() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if 	(xmlhttp.responseText != "")		{
				res 		= xmlhttp.responseText.split(';');
				id_user 	= res[0];
				username 	= res[1];
				email 		= res[2];
				bdate 		= res[3];
				country 	= res[4];
				photo		= res[5];
				fillForm();
			}
		}
	}
	xmlhttp.open("POST", "php/loadProfile.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("");
}

function fillForm() {
	var monthNames = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];
    var date = new Date(bdate);
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
	$("#username").val(username);
	$("#email").val(email);
	$("#country").val(country);
	$("input[name='_submit']").val(bdate);
	$('#bdate').val(day + " " + monthNames[monthIndex] + ", " + year);
	if (photo != "media/userDefault.jpg") 			$("#filetext").val(photo.slice(6));
	$("label[for='username']").addClass('active');
	$("label[for='email']").addClass('active');
	$("label[for='email']").addClass('active');
	$("label[for='bdate']").addClass('active');
	$('select').material_select();
}



