//inicializamos el datepicker cuando cargue el documento.
$(document).ready(function() {
	$('.datepicker').pickadate({
		selectMonths: true,
		selectYears: 116,
		today: '',
		clear: 'Limpiar',
		close: 'Cerrar',
		formatSubmit: 'dd/mm/yyyy',
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
		max: true
	});
	$('select').material_select();
	$(".dropdown-button").dropdown();
	$(".button-collapse").sideNav();
	$('.collapsible').collapsible({
      accordion : false
    });
    $('.parallax').parallax();
});

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

Number.prototype.countDecimals = function () {
    if(Math.floor(this.valueOf()) === this.valueOf()) 	return 0;
    if(this.typeOf === undefined)						return 0;
    return this.toString().split(".")[1].length || 0; 
}

function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
  }
}