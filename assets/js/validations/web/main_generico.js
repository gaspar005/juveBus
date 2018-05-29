$(document).ready(function() {
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd/mm/yy',
			showButtonPanel: false,
			changeMonth: false,
			changeYear: false,
			/*showOn: "button",
            buttonImage: "images/calendar.gif",
            buttonImageOnly: true,
            minDate: '+1D',
            maxDate: '+3M',*/
			inline: true
		});
	});
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '<Ant',
		nextText: 'Sig>',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});
function validarYear(year){

	anyo=parseInt(year);

	if ((((anyo%100)!=0)&&((anyo%4)==0))||((anyo%400)==0)){

		var HTML = "";
		var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
		var num_fila = 1;

		HTML += "<option class='' style='width: 10%'' value='' selected disabled hidden>Mes</option>";
		for (l in meses) {

			if (num_fila < 10 ) {
				HTML += "<option value='0"+num_fila+"'> " + meses[l] +"  </option>";
			}else{
				HTML += "<option value='"+num_fila+"'> " + meses[l] +"  </option>";
			}
			num_fila ++;
		}

		$("#mes_fecha_nacimientoEdit")[0].setAttribute("onchange", "MesBisiesto(value)");
		$("#mes_fecha_nacimientoEdit").html(HTML);

	}else{

		var HTML = "";
		var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
		var num_fila = 1;

		HTML += "<option class='' style='width: 10%'' value='' selected disabled hidden>Mes</option>";
		for (l in meses) {

			if (num_fila < 10 ) {
				HTML += "<option value='0"+num_fila+"'> " + meses[l] +"  </option>";
			}else{
				HTML += "<option value='"+num_fila+"'> " + meses[l] +"  </option>";
			}
			num_fila ++;
		}

		$("#mes_fecha_nacimientoEdit")[0].setAttribute("onchange", "MesNoBisiesto(value)");
		$("#mes_fecha_nacimientoEdit").html(HTML);

	}
}
function MesBisiesto(mes){

	var febreroDisiesto =   ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29"];
	var generico31 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
	var generico30 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"];

	if (mes == 01) {
		this.generico_31(generico31);
	}
	if (mes == 02) {
		var HTML = "";
		var num_fila = 1;
		for (l in febreroDisiesto) {
			HTML += "<option value='"+febreroDisiesto[l]+"'> " + febreroDisiesto[l] +"  </option>";
			num_fila ++;
		}
		$("#dia_fecha_nacimientoEdit").html(HTML);

	}
	if (mes == 03) {
		this.generico_31(generico31);
	}
	if (mes == 04) {
		this.generico_30(generico30);
	}
	if (mes == 05) {
		this.generico_31(generico31);
	}
	if (mes == 06) {
		this.generico_30(generico30);
	}
	if (mes == 07) {
		this.generico_31(generico31);
	}
	if (mes == 08) {
		this.generico_31(generico31);
	}
	if (mes == 09) {
		this.generico_30(generico30);
	}
	if (mes == 10) {
		this.generico_31(generico31);
	}
	if (mes == 11) {
		this.generico_30(generico30);
	}
	if (mes == 12) {
		this.generico_31(generico31);
	}
}
function MesNoBisiesto(noB){

	var generico31 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
	var generico30 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"];
	var febrero =    ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28"];

	var HTML = "";
	if (noB == 01) {
		this.generico_31(generico31);
	}
	if (noB == 02) {
		var num_fila = 1;
		for (l in febrero) {
			HTML += "<option value='"+febrero[l]+"'> " + febrero[l] +"  </option>";
			num_fila ++;
		}
		$("#dia_fecha_nacimientoEdit").html(HTML);
	}
	if (noB == 03) {
		this.generico_31(generico31);
	}
	if (noB == 04) {
		this.generico_30(generico30);
	}
	if (noB == 05) {
		this.generico_31(generico31);
	}
	if (noB == 06) {
		this.generico_30(generico30);
	}
	if (noB == 07) {
		this.generico_31(generico31);
	}
	if (noB == 08) {
		this.generico_31(generico31);
	}
	if (noB == 09) {
		this.generico_30(generico30);
	}
	if (noB == 10) {
		this.generico_31(generico31);
	}
	if (noB == 11) {
		this.generico_30(generico30);
	}
	if (noB == 12) {
		this.generico_31(generico31);
	}
}
function generico_30(generico30){
	var HTML = "";
	var num_fila = 1;
	for (l in generico30) {
		HTML += "<option value='"+generico30[l]+"'> " + generico30[l] +"  </option>";
		num_fila ++;
	}
	$("#dia_fecha_nacimientoEdit").html(HTML);
}
function generico_31(generico31){
	var HTML = "";
	var num_fila = 1;
	for (l in generico31) {
		HTML += "<option value='"+generico31[l]+"'> " + generico31[l] +"  </option>";
		num_fila ++;
	}
	$("#dia_fecha_nacimientoEdit").html(HTML);
}
