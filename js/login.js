/**
 * @author Mario Bastardo
 */

var username, pass;

$(document).ready(function(){
		checkSessionStarted();
		$("#username, #pass").focus(		function(){ 	$("#username, #pass").removeClass("invalid"); 			});
		$("#username, #pass").on('input', 	function(e){	validate();												});
		$("#submit").click(					function(){ 	if(!$(this).hasClass('disabled')) 		checkLogin(); 	});
		$(window).keypress(		function (e) {	if (e.which == 13  && !$("#submit").hasClass('disabled')) { 
																									checkLogin()	
																									return false;}	});
});

function getValues() {
	username 	= 	$("#username").val();
	pass 		= 	$("#pass").val();
}

function validate() {
	getValues();
	var usernameOk 	= 	(!$("#username").hasClass("invalid") 	&&	(username.length != 0));
	var passOk		=	(!$("#pass").hasClass("invalid")		&& 	(pass.length != 0));
	
	if (usernameOk && passOk) 										$("#submit").removeClass('disabled'); 
	else if (!$("#submit").hasClass('disabled'))					$("#submit").addClass('disabled');  
}

function checkLogin() {
	if 		(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var res = xmlhttp.responseText;
			if 	(res == "1") 	login();
			else				failureToLogin();
		}
	}
	xmlhttp.open("POST", "php/checkLogin.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("username=" + username + "&pass=" + pass);
}

function failureToLogin() {
	$("#username, #pass").removeClass("valid");
	$("#username, #pass").addClass("invalid");
	$("label[for='username']").text("Nombre de usuario o contraseña no válidos.");
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

function login() {
	window.location="profile.php";
}