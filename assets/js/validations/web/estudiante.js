
    //mayusculas
	$("#ape_pateID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#ape_matID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#nombreID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#curpID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#lugar_nacimientoID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#localidadID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#coloniaID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#domicilioID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#cruzamientosID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#selectMunicipio").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#escuelaID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("#lengua_indigenaID").keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});

	$(document).ready(function() {

			$("#start_loading_registro").css('display', 'none');
			$("#showContentRegistro").css('display', 'block');
			/*AQUI SE VALIDAN LOS CAMPOS MANUALMENTE CON JS */
			validation.init("form");

			$("#start_loading_lista_estudiante").css('display', 'none');
			$("#content_lista_estudiante").css('display', 'block');
			inicalizarDataTable("estudianteListTable");
			validation.init("form");
			mostrarListaEstudiantes();

	});

	function mostrarListaEstudiantes(){

		$("#my_id").change(function(){
			let selected = $(this).val();
			$.ajax({
				url: baseURL+ "web/Estudiantes_ctrl/cantidad",
				type: "POST",
				data: {cantidad:selected},
				success:function(){
					window.location.href =  baseURL+ "lista-estudiantes";
				}
			});
		});

	}

	function cancelarRegistro() {

		let l = $("#btn_cancelar_estudiante").ladda();
		l.ladda('start');
		document.getElementById("btn_guardar_estudiante").disabled = false;
		$("#form_crear_estudiante")[0].reset();
		l.ladda('stop');
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

			$("#form_crear_estudiante").validate({
				rules: {
					codigo: {required: true},
					ape_pate: {required: true},
					ape_mate: {required: true},
					nombre: {required: true},
					curp: {required: true},
					year_fecha: {required: true},
					mes_fecha: {required: true},
					dia_fecha: {required: true},
					sexo: {required: true},
					correo: {required: true},
					tel_movil: {required: true},
					lugar_nacimiento: {required: true},
					localidad: {required: true},
					id_municipio: {required: true},
					id_grado_estudio: {required: true},
					escuela: {required: true},
					turno_horario: {required: true},
				},
				errorPlacement: function(error,element) {
					return true;
				},
				submitHandler: function(){
					const formData = new FormData($(".form_create_estudiante")[0]);
					let btn_guardando = document.getElementById("btn_guardar_estudiante");
					btn_guardando.textContent = "Guardando";
					btn_guardando.disabled = true;
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
								btn_guardando.textContent = "Guardar";
								btn_guardando.disabled = false;
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
				}
			});
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
	function showDetailEstudiante(id, codigo_joven,nombre,paterno, materno, curp, nacimiento, lugarNacimiento, correo, sexo, edad, tel_casa, tel_celular, localidad, municipio, colonia,domicilio,cruzamiento_domicilio,grado_estudio,escuela,turno_horario, lengua_indigena){

		document.getElementById("idShow").innerHTML=id+"";
		document.getElementById("idShow").value=id;
		let codigo = document.getElementById("codigoShow");
		codigo.textContent=codigo_joven;
		let nombreT = document.getElementById("nombreShow");
		nombreT.textContent=nombre;
		let paternoT = document.getElementById("paternoShow");
		paternoT.textContent = paterno;
		let maternoT = document.getElementById("maternoShow");
		maternoT.textContent = materno;
		let curpT = document.getElementById("curpShow");
		curpT.textContent = curp;
		let correoT = document.getElementById("correoShow");
		correoT.textContent = correo;
		let sexoT = document.getElementById("selectSexoShow");
		sexoT.textContent = sexo;
		let tel_casaT = document.getElementById("telCasaShow");
		tel_casaT.textContent = tel_casa;
		let movil = document.getElementById("telMovilShow");
		movil.textContent = tel_celular;
		let locali = document.getElementById("localidadShow");
		locali.textContent = localidad;
		let mini = document.getElementById("municipioShow");
		mini.textContent = municipio;
		let cruzamiento = document.getElementById("cruzamientosShow");
		cruzamiento.textContent = cruzamiento_domicilio;
		let grado = document.getElementById("grado_estudioShow");
		grado.textContent = grado_estudio;
		let escuelaT = document.getElementById("escuelaShow");
		escuelaT.textContent = escuela;
		let turno = document.getElementById("turno_horarioShow");
		turno.textContent = turno_horario;
		let colo = document.getElementById("coloniaEdit");
		colo.textContent = colonia;
		let domici = document.getElementById("domicilioShow");
		domici.textContent = domicilio;
		let fecha = document.getElementById("fecha_nacimientoShow");
		fecha.textContent = nacimiento;
		let lugar = document.getElementById("lugar_nacimientoShow");
		lugar.textContent = lugarNacimiento;
		let lenguaje = document.getElementById("lengua_indigenaShow");
		lenguaje.textContent = lengua_indigena


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

			$("#form_busqueda").validate({
				rules: {
					codigo: {required: true},
					ape_pate: {required: true},
					ape_mate: {required: true},
					nombre: {required: true},
					curp: {required: true},
					fecha_nacimiento: {required: true},
					sexo: {required: true},
					correo: {required: true},
					tel_movil: {required: true},
					lugar_nacimiento: {required: true},
					localidad: {required: true},
					id_municipio: {required: true},
					id_grado_estudio: {required: true},
					escuela: {required: true},
					turno_horario: {required: true},
				},
				errorPlacement: function(error,element) {
					return true;
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
	}
	function tipo_busqueda(opcion) {

		if (opcion == 1){

			const ajaxNameApe = new XMLHttpRequest();
			ajaxNameApe.open('DELETE', baseURL+'/web/Estudiantes_ctrl/delete_sessionNameApe', true);
			ajaxNameApe.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxNameApe.onload = function(){
				if(this.readyState == 4 && this.status === 200){
					let nombre = document.getElementById("id_nombre");
					let apellidos = document.getElementById("id_apellidos");
					nombre.textContent = "";
					nombre.value = "";
					apellidos.textContent = "";
					apellidos.value = "";
				}
			};
			ajaxNameApe.send();
			$("#contentNameAndApeSearch").css('display','none');
			$("#showWithoutession").css('display','none');
			$("#showWithSession").css('display','none');
			$("#contentCJSearch").css('display','block');
			$("#showWithoutSessionCJ").css('display','block');
			$("#showWithSessionCJ").css('display','block');
		}
		if (opcion == 2 ){

			const xhr = new XMLHttpRequest();
			xhr.open('DELETE', baseURL+'/web/Estudiantes_ctrl/delete_sessionCJ', true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onload = function(){
				if(this.readyState == 4 && this.status === 200){
					let cj = document.getElementById("id_codigo_joven");
					cj.textContent = "";
					cj.value = "";
				}
			};
			xhr.send();
			$("#contentNameAndApeSearch").css('display','block');
			$("#showWithSessionCJ").css('display','none');
			$("#contentCJSearch").css('display','none');
			$("#showWithoutSessionCJ").css('display','none');
			$("#showWithSession").css('display','block');
			$("#showWithoutession").css('display','block');


		}

	}
