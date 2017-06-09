$(document).ready(function() { 
	$('#modBtn').click(function() { modClick() });
});

function modClick() {
	var activeExpense = $('#expenseList').find(".active").attr('id');
	if (activeExpense == undefined) 	Materialize.toast('Selecciona primero un gasto', 4000, 'rounded');
	else 								window.location="modExpense.php?id=" + activeExpense;
}