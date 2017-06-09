/**
 * @author Mario Bastardo
 */

var username, pass, email, bdate, country;

$(document).ready(function() {
	checkSessionStarted();
	$('#bdate').val(new Date().toDateInputValue());
	$("#username, #pass, #email").on('input',		function(){		validate()												});
	$("#username, #pass, #email").focus(			function(){		validate()												});
	$("#country, #bdate").change(					function(){		validate()												});
	$("#submit").click(								function(){ 	if(!$(this).hasClass('disabled')) 		register(); 	});
	$(window).keypress(					
		function (e) {	
			if (e.which == 13  && !$("#submit").hasClass('disabled')) { 
				register();
				return false;
			}	
		}
	);
});

function getValues() {
	username 	= 	$("#username").val();
	pass 		= 	$("#pass").val(); 
	email 		= 	$("#email").val();
	bdate 		= 	$("input[name='_submit']").val();
	country 	= 	$("#country").val();
}

//VALIDACION
function validate() {
	getValues();
	var usernameOk 	= 	isUsernameOk();
	var passOk 		= 	isPassOk();
	var emailOk		= 	isEmailOk();
	
	if (usernameOk && passOk && emailOk && bdate && country) 		$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))					$("#submit").addClass('disabled');  															
}

function isUsernameOk() {
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
	xmlhttp.send("username=" + username);
	return valid;
}
function isPassOk() 	{	return (!$("#pass").hasClass("invalid")  && (pass.length != 0));	}
function isEmailOk() 	{	return (!$("#email").hasClass("invalid") && (email.length != 0));	}
//--VALIDACION

function register() {
	getValues();
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) window.location="profile.php";
    }
    xmlhttp.open("POST", "php/addUser.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("username=" + username + "&pass=" + pass + "&email=" + email + "&bdate=" + bdate + "&country=" + country);
}

function checkSessionStarted() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if 	(xmlhttp.responseText != "")		window.location = "profile.php";	
		}
	}
	xmlhttp.open("POST", "php/getSessionID.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("");
}
