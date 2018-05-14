if (window.location.href === "http://localhost/juveBus/rigistro-estudiante" || window.location.href === "http://localhost/juveBus/lista-estudiantes") {

	$(document).ready(function() {
		//mayusculas
		$('input[type=text]').keyup(function() {
			$(this).val($(this).val().toUpperCase());
		});

		if(window.location.href === "http://localhost/juveBus/rigistro-estudiante"){
			$("#start_loading_registro").css('display', 'none');
			$("#showContentRegistro").css('display', 'block');

			/*AQUI SE VALIDAN LOS CAMPOS MANUALMENTE CON JS */
			validation.init("form");
			const ap_pat = document.querySelector('#ape_pateID');
			ap_pat.addEventListener('keydown', verificarCampo);
			const ap_mat = document.querySelector('#ape_matID');
			ap_mat.addEventListener('keydown', verificarCampo);
			const nombre = document.querySelector('#nombreID');
			nombre.addEventListener('keydown', verificarCampo);
			const curp = document.querySelector('#curpID');
			curp.addEventListener('keydown', verificarCampo);
			const anio = document.querySelector('#year_fecha_nacimientoEdit');
			anio.addEventListener('keydown', verificarCampo);
			const mes_val = document.querySelector('#mes_fecha_nacimientoEdit');
			mes_val.addEventListener('keydown', verificarCampo);
			const dia_val = document.querySelector('#dia_fecha_nacimientoEdit');
			dia_val.addEventListener('keydown', verificarCampo);
			const sexo = document.querySelector('#selectSexo');
			sexo.addEventListener('keydown', verificarCampo);
			const email = document.querySelector('#emailID');
			email.addEventListener('keydown', verificarCampo);
			const movil = document.querySelector('#telMovilID');
			movil.addEventListener('keydown', verificarCampo);
			const lugar_nacimiento = document.querySelector('#lugar_nacimientoID');
			lugar_nacimiento.addEventListener('keydown', verificarCampo);
			const localidad = document.querySelector('#localidadID');
			localidad.addEventListener('keydown', verificarCampo);
			const municipio = document.querySelector('#selectMunicipio');
			municipio.addEventListener('keydown', verificarCampo);
			const grado_estudio = document.querySelector('#selectGradoEstudio');
			grado_estudio.addEventListener('onchange', verificarCampo);
			const escuela = document.querySelector('#escuelaID');
			escuela.addEventListener('keydown', verificarCampo);
			const turno = document.querySelector('#turnoID');
			turno.addEventListener('onchange', verificarCampo);

			function verificarCampo(){
				if (ap_pat.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (ap_mat.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (nombre.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (curp.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (anio.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (mes_val.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (dia_val.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (sexo.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (email.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (movil.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (lugar_nacimiento.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (localidad.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (municipio.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (grado_estudio.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (escuela.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
				if (turno.value === ""){
					validation.init("form");
					document.getElementById("btn_guardar_estudiante").disabled = true;
				}else{
					document.getElementById("btn_guardar_estudiante").disabled = false;
				}
			}
		}

		if(window.location.href === "http://localhost/juveBus/lista-estudiantes"){

			$("#start_loading_lista_estudiante").css('display', 'none');
			$("#content_lista_estudiante").css('display', 'block');

			inicalizarDataTable("estudianteListTable");

			const ap_pat = document.querySelector('#paternoEdit');
			ap_pat.addEventListener('keydown', verificarCampoEdit);
			const ap_mate = document.querySelector('#maternoEdit');
			ap_mate.addEventListener('keydown', verificarCampoEdit);
			const nombre_edit = document.querySelector('#nombreEdit');
			nombre_edit.addEventListener('keydown', verificarCampoEdit);
			const curpEdit = document.querySelector('#curpEdit');
			curpEdit.addEventListener('keydown', verificarCampoEdit);
			const fecha_nacimientoEdit = document.querySelector('#fecha_nacimientoEdit');
			fecha_nacimientoEdit.addEventListener('keydown', verificarCampoEdit);
			const selectSexoEdit = document.querySelector('#selectSexoEdit');
			selectSexoEdit.addEventListener('keydown', verificarCampoEdit);
			const correoEditar = document.querySelector('#correoEditar');
			correoEditar.addEventListener('keydown', verificarCampoEdit);

			document.querySelector('#telMovilEdit').addEventListener('keydown', validarNumero);
			function validarNumero() {
				var numeroTelefono = document.getElementById('telMovilEdit');
				var expresionRegular1 = /^([0-9]+){9}$/;//<--- con esto vamos a validar el numero
				var expresionRegular2 = /\s/;//<--- con esto vamos a validar que no tenga espacios en blanco
				console.log(numeroTelefono.value);
				if (numeroTelefono.value === '') {
					document.getElementById("guarda_datos_editados").disabled = true;
					document.getElementById("telMovilEdit").style.border = "solid red";
					return false
				} else if (expresionRegular2.test(numeroTelefono.value)) {
					document.getElementById("guarda_datos_editados").disabled = true;
					document.getElementById("telMovilEdit").style.border = "solid red";
					alert('error existen espacios en blanco, quite espacios');
					return false
				} else if (!expresionRegular1.test(numeroTelefono.value)){
					document.getElementById("guarda_datos_editados").disabled = true;
					document.getElementById("telMovilEdit").style.border = "solid red";
					return false
				}else if(Number(numeroTelefono.value)){
					document.getElementById("telMovilEdit").style.border = "1px solid #ccc";
					document.getElementById("guarda_datos_editados").disabled = false;
				}
			}
			const lugar_nacimientoEdit = document.querySelector('#lugar_nacimientoEdit');
			lugar_nacimientoEdit.addEventListener('keydown', verificarCampoEdit);
			const localidadEdit = document.querySelector('#localidadEdit');
			localidadEdit.addEventListener('keydown', verificarCampoEdit);
			const selectMunicipioEdit = document.querySelector('#selectMunicipioEdit');
			selectMunicipioEdit.addEventListener('keydown', verificarCampoEdit);
			const selectGradoEstudioEdit = document.querySelector('#selectGradoEstudioEdit');
			selectGradoEstudioEdit.addEventListener('keydown', verificarCampoEdit);
			const escuelaEdit = document.querySelector('#escuelaEdit');
			escuelaEdit.addEventListener('keydown', verificarCampoEdit);
			const turnoEdit = document.querySelector('#turnoEdit');
			turnoEdit.addEventListener('keydown', verificarCampoEdit);
			function verificarCampoEdit() {
				if (ap_pat.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (ap_mate.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (nombre_edit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (curpEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (selectSexoEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (correoEditar.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (lugar_nacimientoEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (localidadEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (selectMunicipioEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (selectGradoEstudioEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (escuelaEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
				if (turnoEdit.value === "") {
					validation.init("form");
					document.getElementById("guarda_datos_editados").disabled = true;
				} else {
					document.getElementById("guarda_datos_editados").disabled = false;
				}
			}
		}

	});

	function cancelarRegistro() {
		$("#form_crear_estudiante")[0].reset();
	}
	function cancelarEditRegistro() {
		$("#form_edit_estudiante")[0].reset();
	}
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57 ) ){
			return false;
		}else{
			return true;
		}
	}
	function saveEstudent(){

		if (validation.validate("form") === true){
			document.getElementById("btn_guardar_estudiante").disabled = false;
			$("#form_crear_estudiante").validate({
				rules: {
				},
				messages: {
				},
				submitHandler: function(){
					var formData = new FormData($(".form_create_estudiante")[0]);
					var l = $("#btn_guardar_estudiante").ladda();
					l.ladda('start');
					$.ajax({
						type: "POST",
						url:baseURL + "web/Estudiantes_ctrl/guardar_estudiante",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respuesta) {
							var obj = JSON.parse(respuesta);
							if (obj.resultado === true) {
								//Limpiar formulario
								$("#form_crear_estudiante")[0].reset();
								//Mensaje de operación realizada con éxito
								setTimeout(function() {
									toastr.options = {
										closeButton: true,
										progressBar: true,
										showMethod: 'slideDown',
										timeOut: 4000
									};
									toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');
								}, 1300);
							}else{
								sweetAlert("EL TIPO DE ARCHIVO ES INVALIDO","INTENTE CON  OTRO","error");
							}
						}
					});
					l.ladda('stop');
				}
			});
		}else{
			document.getElementById("btn_guardar_estudiante").disabled = true;
		}
	}
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
	function validarCJ(codigoJ){


		$.ajax({
			type: "POST",
			url: baseURL + "web/Estudiantes_ctrl/buscar_codigojoven",
			data: {codigoJ: codigoJ},

			success: function(respuesta){
				var obj = JSON.parse(respuesta);

				if (obj.resultado == true) {
					sweetAlert("YA EXISTE CODIGO JOVEN","INTENTE CON  OTRO","error");
					$("#btn_guardar_estudiante").attr("disabled", true);
					$("#codigoEdit").css('border','red solid');
				}else{
					$("#btn_guardar_estudiante").attr("disabled", false);
					$("#codigoEdit").css('border', '1px solid #ccc');
				}
			}
		});

	}
	function validarCurp(input) {
		var curp = input.value.toUpperCase(),
			valido = "No válido";

		if (procesaCurp(curp)) { // ⬅️ Acá se comprueba
			valido = "Válido";
			$("#btn_guardar_estudiante").attr("disabled", false);

		} else {
			sweetAlert("CURP NO VALIDO","VULVA A INTENTAR","error");
			$("#btn_guardar_estudiante").attr("disabled", true);
			return false;
		}
	}
	function procesaCurp(curp){

		var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
			validado = curp.match(re);

		if (!validado)  //Coincide con el formato general?
			return false;

		//Validar que coincida el dígito verificador
		function digitoVerificador(curp17) {
			//Fuente https://consultas.curp.gob.mx/CurpSP/
			var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
				lngSuma      = 0.0,
				lngDigito    = 0.0;
			for(var i=0; i<17; i++)
				lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
			lngDigito = 10 - lngSuma % 10;
			if (lngDigito == 10) return 0;
			return lngDigito;
		}

		if (validado[2] != digitoVerificador(validado[1]))
			return false;

		return true; //Validado
	}

	/* MODULO DE EDITAR ESTUDIANTES */
	function validarCJEditar(codigoJ){


		$.ajax({
			type: "POST",
			url: baseURL + "web/Estudiantes_ctrl/buscar_codigojoven",
			data: {codigoJ: codigoJ},

			success: function(respuesta){
				var obj = JSON.parse(respuesta);

				if (obj.resultado == true) {
					sweetAlert("YA EXISTE CODIGO JOVEN","INTENTE CON  OTRO","error");
					$("#btn_guardar_edit_estudiante").attr("disabled", false);
				}else{
					$("#btn_guardar_edit_estudiante").attr("disabled", false);
				}
			}
		});

	}
	function validarCurpEditar(input) {
		var curp = input.value.toUpperCase(),
			valido = "No válido";

		if (procesaCurpEditar(curp)) { // ⬅️ Acá se comprueba
			valido = "Válido";
			$("#btn_guardar_edit_estudiante").attr("disabled", false);

		} else {
			sweetAlert("CURP NO VALIDO","VULVA A INTENTAR","error");
			$("#btn_guardar_edit_estudiante").attr("disabled", true);
			return false;
		}
	}
	function procesaCurpEditar(curp){

		var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
			validado = curp.match(re);

		if (!validado)  //Coincide con el formato general?
			return false;

		//Validar que coincida el dígito verificador
		function digitoVerificadorEditar(curp17) {
			//Fuente https://consultas.curp.gob.mx/CurpSP/
			var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
				lngSuma      = 0.0,
				lngDigito    = 0.0;
			for(var i=0; i<17; i++)
				lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
			lngDigito = 10 - lngSuma % 10;
			if (lngDigito == 10) return 0;
			return lngDigito;
		}

		if (validado[2] != digitoVerificadorEditar(validado[1]))
			return false;

		return true; //Validado
	}
	function editEstudiante(id, codigo_joven,nombre,paterno, materno, curp, nacimiento, lugarNacimiento, correo, sexo, edad, tel_casa, tel_celular, localidad, municipio, colonia,domicilio,cruzamiento_domicilio,grado_estudio,escuela,turno_horario, lengua_indigena) {

		var sexos = ["Masculino", "Femenino", "Otro", "Prefiero no decir"];
		var turno = ["Matutino", "Vespertino"];
		document.getElementById("idEditar").innerHTML=id+"";
		document.getElementById("idEditar").value=id;
		document.getElementById("codigoEdit").value=codigo_joven;
		document.getElementById("nombreEdit").value=nombre;
		document.getElementById("paternoEdit").value=paterno;
		document.getElementById("maternoEdit").value=materno;
		document.getElementById("curpEdit").value=curp;
		document.getElementById("correoEditar").value=correo;
		document.getElementById("telCasaEditEdit").value=tel_casa;
		document.getElementById("telMovilEdit").value=tel_celular;
		document.getElementById("localidadEdit").value=localidad;
		document.getElementById("coloniaEdit").value=colonia;
		document.getElementById("fecha_nacimientoEdit").value=nacimiento;
		document.getElementById("lugar_nacimientoEdit").value=lugarNacimiento;
		var HTML = "";
		for (var l = 0; l < sexos.length; l++){
			if (sexos[l] === sexo){
				HTML += "<option value='"+sexos[l]+"' selected>"  + sexo  + "</option>";
			}else{
				HTML += "<option value='"+sexos[l]+"' >"  + sexos[l]  + "</option>";
			}
		}
		document.getElementById("selectSexoEdit").innerHTML = HTML;

		const xhr = new XMLHttpRequest();
		xhr.open('GET', baseURL+'/web/Estudiantes_ctrl/obtener_municipios', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function(){
			if(this.readyState == 4 && this.status === 200){
				const munici = JSON.parse(this.responseText);
				let htmlTemplate = "";
				munici.forEach(function (municipios) {

					if (municipios.nombre === municipio) {
						htmlTemplate +=  "<option value='"+ municipios.id_municipio +"' selected>" + municipio +"</option>" ;
					}else{
						htmlTemplate +=  "<option value='"+ municipios.id_municipio +"'>" + municipios.nombre+"</option>" ;
					}
				});
				document.getElementById("selectMunicipioEdit").innerHTML=htmlTemplate;
			}
		}
		xhr.send();

		document.getElementById("domicilioEdit").value=domicilio;
		document.getElementById("cruzamientosEdit").value=cruzamiento_domicilio;

		const xhr_grado_es = new XMLHttpRequest();
		xhr_grado_es.open('GET', baseURL+'/web/Estudiantes_ctrl/obtener_grado_estudios', true);
		xhr_grado_es.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr_grado_es.onload = function(){
			if(this.readyState == 4 && this.status === 200){
				const grado_estu = JSON.parse(this.responseText);
				let htmlTemplate_GE = "";
				grado_estu.forEach(function (grado_estudio) {

					if (grado_estudio.nombre === grado_estudio) {
						htmlTemplate_GE +=  "<option value='"+ grado_estudio.id_grado_estudio +"' selected>" + grado_estudio +"</option>" ;
					}else{
						htmlTemplate_GE +=  "<option value='"+ grado_estudio.id_grado_estudio +"'>" + grado_estudio.nombre+"</option>" ;
					}
				});
				document.getElementById("selectGradoEstudioEdit").innerHTML=htmlTemplate_GE;
			}
		}
		xhr_grado_es.send();

		document.getElementById("escuelaEdit").value=escuela;
		var HTML1 = "";

		for (var l = 0; l < turno.length; l++){

			if (turno[l] === turno_horario){
				HTML1 += "<option value='"+turno[l]+"' selected>"  + turno_horario  + "</option>";
			}else{
				HTML1 += "<option value='"+turno[l]+"' >"  + turno[l]  + "</option>";
			}
		}
		document.getElementById("turnoEdit").innerHTML = HTML1;
		document.getElementById("lengua_indigenaEdit").value=lengua_indigena;

	}
	function deshabilitarEstudiante(id, nombre, paterno, materno) {

		var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
		var text = "<h3>¿SEGURO DE DESHABILITAR ESTUDIANTE?</h3>";
		swal({
			title: text+name,
			type: "warning",
			showCancelButton: true,
			html:true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI, DESHABILITAR AHORA!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: baseURL + "web/Estudiantes_ctrl/deshabilitar_Estudiante",
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function () {
					swal("Hecho!", "EMPLEADO CORRECTAMENTE DESHABILITADO!", "success");
					setTimeout(function() {
						window.location.href = baseURL+"lista-estudiantes";
					}, 2000);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Error deleting!", "Please try again", "error");
				}
			});
		});
	}
	function habilitarEstudiante(id, nombre, paterno, materno) {

		var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
		var text = "<h3>¿SEGURO DE HABILITAR EMPLEADO?</h3>";
		swal({
			title: text+name,
			type: "warning",
			html:true,
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI, HABILITAR AHORA!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: baseURL + "web/Estudiantes_ctrl/habilitar_Estudiante",
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function () {
					swal("Hecho!", "ESTUDIANTE HABILITADO CORRECTAMENTE!", "success");
					setTimeout(function() {
						window.location.href = baseURL+"lista-estudiantes";
					}, 2000);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Error deleting!", "Please try again", "error");
				}
			});
		});
	}

	function saveEditEstudiante(){

		if (validation.validate("form") === true) {

			document.getElementById("guarda_datos_editados").disabled = false;

			$("#form_edit_estudiante").validate({
				rules: {

				},
				messages: {

				},
				submitHandler: function () {
					var dataString = $("#form_edit_estudiante").serialize();
					var l = $("#btn_guardar_edit_estudiante").ladda();
					l.ladda('start');

					$.ajax({
						type: "POST",
						url: baseURL + "web/Estudiantes_ctrl/guardar_estudiante_edit",
						data: dataString,
						success: function (respuesta) {
							var obj = JSON.parse(respuesta);
							if (obj.resultado === true) {
								l.ladda('stop');
								$("#form_edit_estudiante")[0].reset();
								$("#editarEstudiante").modal('hide');
								setTimeout(function () {
									toastr.options = {
										closeButton: true,
										progressBar: true,
										showMethod: 'slideDown',
										timeOut: 1500
									};
									toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');
									setTimeout(function () {
										window.location.href = baseURL + "lista-estudiantes";
									}, 1300);
								}, 1300);
							}
						}
					});
				}
			});
		}else{
			document.getElementById("guarda_datos_editados").disabled = true;
		}
	}

}else {
	console.log("no carga nada");
}
