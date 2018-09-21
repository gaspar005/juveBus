if (window.location.href === baseURL+"operador-registro" || window.location.href === baseURL+"operador-lista"  || window.location.href === baseURL+"operador-reportes")  {

	$('input[type=text]').keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	
	$(document).ready(function() {
		
		//REGISTRO OPERADORES
		if ( window.location.href === baseURL+"operador-registro" ) {
			$("#start_loading_registro_operador").css('display', 'none');
			$("#showContentRegistroOperador").css('display', 'block');
			validation.init("form");
		}

		//LISTA OPERADORES
		if (window.location.href === baseURL+"operador-lista"){
			$("#start_loading_lista_operador").css('display', 'none');
			$("#showContentListaOperadores").css('display', 'block');
			inicalizarDataTable("operadorTable");
		}

		//REPORTES
		if (window.location.href === baseURL+"operador-reportes"){
			$("#start_loading_reporte_operador").css('display', 'none');
			$("#showContentReporteOperador").css('display', 'block');
			$('#starQuery').css('display', 'block');
			validation.init("form");

		}


	});
	// METODO PARA EL REPORTE DE OPERADORES
	function getInfoOperador(operador){

		$("#ShowTableDateCobros").css('display', 'none');
		$("#ShowTableDateCobros").empty();
		$("#showButtonQuery").css('display', 'none');
		$("#showButtonQuery").empty();
		$("#showQueryFor").empty();

		let cargando = document.getElementById("ShowTableDateCobros");
		cargando.style.display  = "block";
		cargando.style.textAlign  = "center";
		cargando.style.color  = "green";
		cargando.textContent  = "Cargando...";

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/getInfor_operador",
			data: {operador: operador},
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);

				if (obj.resultado === true) {
					cargando.style.display  = "none";
					cargando.style.color  = "black";
					let HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center; display: inline-block; '><strong>" + "Reporte de cobros realizados hoy " + obj.operador.fecha +"</strong></p> ";

					if (obj.operador.hayPasajeros === true) {
						// HTML += "<button style='background: blue' >CORTE DEL DIA</button> ";
						HTML += "<table style='width:92%;>";
							HTML += "<thead>";
								HTML += "<tr style='background: grey; color: white' >";
									HTML += "<th width='33%' style='background: grey; color: white; text-align: center'>Tarifa</th>";
									HTML += "<th width='34%' style='background: grey; color: white; text-align: center'>Total de Pasajeros</th>";
									HTML += "<th width='33%' style='background: grey; color: white; text-align:right'>Total de Ganancias</th>";
								HTML += "</tr>";
							HTML += "</thead>";
							HTML += "<tbody>";
								HTML += "<tr>";
									HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +   " </td>";
									HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+  " Estudiantes " + " </td>";
									HTML += "<td style='text-align:right' >" + "$ " + obj.operador.ganancias +  " Pesos " +"</td>";
								HTML += "</tr>";
							HTML += "</tbody>";
						HTML += "</table>";
						HTML += "</br>";
						HTML += "<button style='margin: 1px 1px' class='btn btn-primary' data-backdrop='static'  data-keyboard='false' data-toggle='modal' data-target='.modal_corte_dia_pdf' onclick='print_corte_operador_day("+operador+")'> <span class='icon-print'> </span></button>";
						if (obj.operador.correo) {
							HTML += "<button style='margin: 1px 1px' type='button' class='ladda-button btn btn-success' data-style='expand-left'  id='btn_dia'  onclick='sendEmail_corte_operadorDay("+operador+")'> <span class='icon-envelope-alt'> </span></button>";
						}
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');

					}else{

						HTML += "<h1 style='color: red; text-align:center;'><strong> " + obj.operador.pasajeros + "</strong> </h1>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');

					}

					let htmlSelect = "";
					htmlSelect += "<p>Consulta Personalizada</p>";
					htmlSelect += "<select name='opcionPersonalizada' class='form-control'  id='opcionPersonalizadaSelect' onchange='personalizada(this.value)' > ";
						htmlSelect += "<option class='' style='width: 10%'' value='' selected disabled hidden>Selecciona Tipo</option>";
						htmlSelect += "<option value='dia'> Día </option>";
						htmlSelect += "<option value='rango'> Rango </option>";
						htmlSelect += "<option value='mes'> Mes </option>";
						htmlSelect += "<option value='year'> Año </option>";
					htmlSelect += "</select> ";
					$("#showConstumQuery").html(htmlSelect).css('display', 'block');
				}
			}
		});

	}
	function personalizada(query) {

		$("#ShowTableDateCobros").css('display', 'none');
		$("#ShowTableDateCobros").empty();
		$("#showButtonQuery").css('display', 'none');
		$("#showButtonQuery").empty();
		$("#showQueryFor").empty();

		switch (query) {

			case "dia":

				var htmlSelectDay = "";

				htmlSelectDay += "<p>Seleccione Día</p>";
				htmlSelectDay += "<input style='width:50%'  name='dia' class='form-control datepicker'  type='text' id='diaa'  />";

				$("#showQueryFor").html(htmlSelectDay).css('display', 'block');

				var now = moment();

				$.datepicker.setDefaults($.datepicker.regional["es"]);

				$("#diaa").datepicker({
					dateFormat: 'dd/mm/yy'
				});

				$("#diaa").datepicker('setDate', now.format('DD/MM/YYYY'));

				var showBoton = "";

				showBoton += "<button id='btn_consulta_por_dia' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorDia()' >consultar día</button>";
				$("#showButtonQuery").html(showBoton).css('display', 'block');

				break;
			case "rango":

				let htmlSelectRange = "";

				htmlSelectRange += "<p>Seleccione Rango Inicio - Fin </p>";
				htmlSelectRange += "<input style='display: inline-block; width: 42%' type='text' class='form-control' name='inicio' id='inicio' /> ";
				htmlSelectRange += "<input style='display: inline-block; width: 42%' type='text' class='form-control' name='fin' id='fin' /> ";

				$("#showQueryFor").html(htmlSelectRange).css('display', 'block');

				var now = moment();

				$.datepicker.setDefaults($.datepicker.regional["es"]);

				$("#inicio").datepicker({
					dateFormat: 'dd/mm/yy'
				});
				$("#fin").datepicker({
					dateFormat: 'dd/mm/yy'
				});

				$("#inicio").datepicker('setDate', now.format('DD/MM/YYYY'));
				$("#fin").datepicker('setDate', now.format('DD/MM/YYYY'));

				let showBotonRango = "";

				showBotonRango += "<button id='btn_consulta_por_rango' style='width: 70%;' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorRango()' >consultar Rango</button>";
				$("#showButtonQuery").html(showBotonRango).css('display', 'block');
				break;
			case "mes":
				let cargando = document.getElementById("showQueryFor");
				cargando.style.display  = "block";
				cargando.style.textAlign  = "center";
				cargando.style.color  = "green";
				cargando.textContent  = "Cargando...";
				$.ajax({
					type: "GET",
					url: baseURL + "web/Operador_ctrl/getYearEsistentes",
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);
						if (obj.resultado === true) {
							cargando.style.display  = "none";
							cargando.style.color  = "black";
							let htmlSelectMes = "";
							let num_fila = 1;
							let num_fila1 = 1;
							let meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
								htmlSelectMes += "<p>Seleccione Año y Mes</p>";
								htmlSelectMes += "<select style='display: inline-block; width: 45%;' class='validate form-control' name='year' id='yearQuery' data-validate='required'> ";
								htmlSelectMes += "<option  value='' selected disabled hidden>Año</option>";
								for (l in obj.years) {
									htmlSelectMes += "<option value='" + obj.years[l].year + "'> " + obj.years[l].year + "  </option>";
									num_fila1++;
								}
								htmlSelectMes += "</select> ";

								htmlSelectMes += "<select style='display: inline-block; width: 45%;' class='validate form-control'  name='mes' id='mesQuery' data-validate='required'> ";
								htmlSelectMes += "<option value='' selected disabled hidden> Mes</option>";
								for (l in meses) {
									if (num_fila < 10) {
										htmlSelectMes += "<option value='0" + num_fila + "'> " + meses[l] + "  </option>";
									} else {
										htmlSelectMes += "<option value='" + num_fila + "'> " + meses[l] + "  </option>";
									}

									num_fila++;
								}
								htmlSelectMes += "</select> ";
							$("#showQueryFor").html(htmlSelectMes).css('display', 'block');
							let showBotonMes = "";
							showBotonMes += "<button id='btn_consulta_por_mes' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorMes()'>consultar Mes</button>";
							$("#showButtonQuery").html(showBotonMes).css('display', 'block');
						}
					}
				});
				break;
			case "year":
				let cargandoMes = document.getElementById("showQueryFor");
				cargandoMes.style.display  = "block";
				cargandoMes.style.textAlign  = "center";
				cargandoMes.style.color  = "green";
				cargandoMes.textContent  = "Cargando...";
				$.ajax({
					type: "GET",
					url: baseURL + "web/Operador_ctrl/getYearEsistentes",
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);

						if (obj.resultado === true) {
							cargandoMes.style.display  = "none";
							cargandoMes.style.color  = "black";
							var htmlSelecYear = "";
							var num_fila = 1;
							htmlSelecYear += "<p>Seleccione Año</p>";

							htmlSelecYear += "<select name='year' id='yearQuery' class='validate form-control' data-validate='required' > ";

							htmlSelecYear += "<option value='' selected disabled hidden>Año</option>";

							for (l in obj.years) {

								htmlSelecYear += "<option value='" + obj.years[l].year + "'> " + obj.years[l].year + "  </option>";

								num_fila++;
							}

							htmlSelecYear += "</select> ";
							$("#showQueryFor").html(htmlSelecYear).css('display', 'block');
							var showBotonYear = "";

							showBotonYear += "<button id='btn_consulta_por_year' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorYear()' >consultar Año</button>";
							$("#showButtonQuery").html(showBotonYear).css('display', 'block');
						}
					}
				});
				break;
		}

	}
	function consultarPorDia(){

		let id_operador = $("#selectOperador").val();
		let fecha_dia   = $("#diaa").val();

		let btn_guardar_dia = document.getElementById("btn_consulta_por_dia");
		btn_guardar_dia.textContent = "Consultando...";
		btn_guardar_dia.disabled = true;

		let cargando = document.getElementById("ShowTableDateCobros");
		cargando.style.display  = "block";
		cargando.style.textAlign  = "center";
		cargando.style.color  = "green";
		cargando.textContent  = "Cargando...";

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/searchQueryDay",
			data: {id_operador: id_operador, fecha_dia: fecha_dia },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {
					cargando.style.display  = "none";
					cargando.style.color  = "black";
					btn_guardar_dia.textContent = "Consultar Dia";
					btn_guardar_dia.disabled = false;
					let HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>"+ " Reporte de " + obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:92%' >";
								HTML += "<thead>";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%' style='text-align:center'>Tarifa</th>";
										HTML += "<th width='34%' style='text-align:center'>Total de Pasajeros</th>";
										HTML += "<th width='33%' style='text-align:right'>Total de Ganancias</th>";
									HTML += "</tr>";
								HTML += "</thead>";
								HTML += "<tbody>";
									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " Estudiantes " + "</td>";
										HTML += "<td style='text-align:right' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";
								HTML += "</tbody>";
							HTML += "</table>";
							HTML += "</br>";
							HTML += "<button style='margin: 1px 1px' class='btn btn-primary' data-backdrop='static'  data-keyboard='false' data-toggle='modal' data-target='.modal_corte_dia_pdf_consulta' onclick='print_corte_operador_consulta_dia("+id_operador+")'> <span class='icon-print'> </span></button>";
							if (obj.operador.correo) {
								HTML += "<button style='margin: 1px 1px' type='button' class='ladda-button btn btn-success' ata-style='expand-left' id='btn_dia_consulta' onclick='sendEmailCorteDiaConsulta("+id_operador+")'> <span class='icon-envelope-alt'> </span></button>";
							}
							$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}else{
						HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}
				}
			}
		});
	}
	function consultarPorRango(){

		let id_operador = $("#selectOperador").val();
		let dia_inicio  = $("#inicio").val();
		let dia_fin     = $("#fin").val();

		let btn_guardar_rango = document.getElementById("btn_consulta_por_rango");
		btn_guardar_rango.textContent = "Consultando...";
		btn_guardar_rango.disabled = true;

		let cargando = document.getElementById("ShowTableDateCobros");
		cargando.style.display  = "block";
		cargando.style.textAlign  = "center";
		cargando.style.color  = "green";
		cargando.textContent  = "Cargando...";

		$.ajax({
			type: "POST",
			url:baseURL + "operador/consulta/rango",
			data: {id_operador: id_operador, dia_inicio: dia_inicio, dia_fin:dia_fin },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {
					cargando.style.display  = "none";
					cargando.style.color  = "black";
					btn_guardar_rango.textContent = "Cansultar Rango";
					btn_guardar_rango.disabled = false;
					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>"+ "Reporte de " + obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:94%'>";
								HTML += "<thead>";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%' style='text-align:center'>Tarifa</th>";
										HTML += "<th width='33%' style='text-align:center'>Total de Pasajeros</th>";
										HTML += "<th width='33%' style='text-align:right'>Total de Ganancias</th>";
									HTML += "</tr>";
								HTML += "</thead>";
								HTML += "<tbody>";
									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " Estudiantes " + "</td>";
										HTML += "<td style='text-align:right' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";
								HTML += "</tbody>";
						HTML += "</table>";
						HTML += "</br>";
						HTML += "<button style='margin: 1px 1px' class='btn btn-primary' data-backdrop='static'  data-keyboard='false' data-toggle='modal' data-target='.modal_corte_dias_rango' onclick='print_corte_operador_consulta_rango("+id_operador+")'> <span class='icon-print'> </span></button>";
						if (obj.operador.correo) {
							HTML += "<button style='margin: 1px 1px' type='button' class='ladda-button btn btn-success' id='btn_rango' onclick='sendEmailCorteRango("+id_operador+")'> <span class='icon-envelope-alt'> </span></button>";
						}
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}else{

						HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}
				}
			}
		});

	}
	function consultarPorMes() {

		$("#consultaPersonalizada").validate({
			rules: {
				year: {required : true},
				mes: {required : true},
			},
			errorPlacement: function (error, element) {
				return true;
			},
			submitHandler: function () {
				let id_operador = $("#selectOperador").val();
				let mes = $("#mesQuery").val();
				let year = $("#yearQuery").val();

				let btn_guardar_mes = document.getElementById("btn_consulta_por_mes");
				btn_guardar_mes.textContent = "Consultando...";
				btn_guardar_mes.disabled = true;

				let cargando = document.getElementById("ShowTableDateCobros");
				cargando.style.display = "block";
				cargando.style.textAlign = "center";
				cargando.style.color = "green";
				cargando.textContent = "Cargando...";

				$.ajax({
					type: "POST",
					url: baseURL + "web/Operador_ctrl/searchQueryMonth",
					data: {id_operador: id_operador, mes: mes, year: year},
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);
						if (obj.resultado === true) {
							cargando.style.display = "none";
							cargando.style.color = "black";
							btn_guardar_mes.textContent = "Consultar Mes";
							btn_guardar_mes.disabled = false;
							var HTML = "";
							HTML += "<br>";
							HTML += "<p style='text-align: center'> <strong>" + "Reporte de " + obj.operador.fecha + "</strong></p> ";
							if (obj.operador.hayPasajeros === true) {
								HTML += "<table style='width:94%'>";
								HTML += "<thead>";
								HTML += "<tr class='table-tr-color '>";
								HTML += "<th width='33%' style='text-align:center'>Tarifa</th>";
								HTML += "<th width='33%' style='text-align:center'>Total de Pasajeros</th>";
								HTML += "<th width='33%' style='text-align:right'>Total de Ganancias</th>";
								HTML += "</tr>";
								HTML += "</thead>";
								HTML += "<tbody>";
								HTML += "<tr>";
								HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa + " Pesos " + " </td>";
								HTML += "<td style='text-align:center' >" + obj.operador.pasajeros + " Estudiastes " + " </td>";
								HTML += "<td style='text-align:right' >" + "$ " + obj.operador.ganancias + " Pesos " + "</td>";
								HTML += "</tr>";
								HTML += "</tbody>";
								HTML += "</table>";
								HTML += "</br>";
								HTML += "<button style='margin: 1px 1px' class='btn btn-primary' data-backdrop='static'  data-keyboard='false' data-toggle='modal' data-target='.modal_corte_dias_mes' onclick='print_corte_operador_mes(" + id_operador + ")'> <span class='icon-print'> </span></button>";
								if (obj.operador.correo) {
									HTML += "<button style='margin: 1px 1px' type='button' class='ladda-button btn btn-success' id='btn_mes' onclick='sendEmailCorteMes(" + id_operador + ")'> <span class='icon-envelope-alt'> </span></button>";
								}
								$("#ShowTableDateCobros").html(HTML).css('display', 'block');
							} else {
								HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
								$("#ShowTableDateCobros").html(HTML).css('display', 'block');
							}
						}
					}
				});
			}
		});

	}
	function consultarPorYear(){
		$("#consultaPersonalizada").validate({
			rules: {
				year: {required : true},
			},
			errorPlacement: function (error, element) {
				return true;
			},
			submitHandler: function () {
				var id_operador = $("#selectOperador").val();
				var year = $("#yearQuery").val();

				let btn_guardar_anio = document.getElementById("btn_consulta_por_year");
				btn_guardar_anio.textContent = "Consultando...";
				btn_guardar_anio.disabled = true;

				let cargando = document.getElementById("ShowTableDateCobros");
				cargando.style.display = "block";
				cargando.style.textAlign = "center";
				cargando.style.color = "green";
				cargando.textContent = "Cargando...";

				$.ajax({
					type: "POST",
					url: baseURL + "web/Operador_ctrl/searchQueryYear",
					data: {id_operador: id_operador, year: year},
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);
						if (obj.resultado === true) {
							cargando.style.display = "none";
							cargando.style.color = "black";
							btn_guardar_anio.textContent = "Consultar Año";
							btn_guardar_anio.disabled = false;
							var HTML = "";
							HTML += "<br>";
							HTML += "<p style='text-align: center'><strong>" + " Reporte de " + obj.operador.fecha + "</strong></p> ";
							if (obj.operador.hayPasajeros === true) {
								HTML += "<table style='width:94%'>";

								HTML += "<thead >";
								HTML += "<tr class='table-tr-color '>";
								HTML += "<th width='33%' style='text-align:center'>Tarifa</th>";
								HTML += "<th width='33%' style='text-align:center'>Total de Pasajeros</th>";
								HTML += "<th width='33%' style='text-align:right'>Total de Ganancias</th>";
								HTML += "</tr>";
								HTML += "</thead>";

								HTML += "<tbody>";
								HTML += "<tr>";
								HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa + " Pesos " + " </td>";
								HTML += "<td style='text-align:center' >" + obj.operador.pasajeros + " Estudiantes " + "  </td>";
								HTML += "<td style='text-align:right' >" + "$ " + obj.operador.ganancias + " Pesos " + "</td>";
								HTML += "</tr>";
								HTML += "</tbody>";
								HTML += "</table>";
								HTML += "</br>";
								HTML += "<button style='margin: 1px 1px' class='btn btn-primary' data-backdrop='static'  data-keyboard='false' data-toggle='modal' data-target='.modal_corte_year' onclick='print_corte_operador_year(" + id_operador + ")'> <span class='icon-print'> </span></button>";
								if (obj.operador.correo) {
									HTML += "<button style='margin: 1px 1px' type='button' class='btn btn-success' id='btn_year' onclick='sendEmailCorteYear(" + id_operador + ")'> <span class='icon-envelope-alt'> </span></button>";
								}
								$("#ShowTableDateCobros").html(HTML).css('display', 'block');
							} else {
								HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
								$("#ShowTableDateCobros").html(HTML).css('display', 'block');
							}
						}
					}
				});
			}
		});
	}
	// FIN DE METODOS DE REPORTE DE OPERADOR

	// INICO DE METODO PARA EL REGISTRO DE OPERADORES
	function validaRFC(rfcStr) {

		$.ajax({
			type: "POST",
			url: baseURL +"web/Operador_ctrl/searchRFC",
			data: {rfc: rfcStr},
			 success: function(respuesta){
			   var obj = JSON.parse(respuesta);
			   if (obj.resultado == true) {
					sweetAlert("Ya existe un Operador con el mismo RFC","Intente con otro","error");
					$("#btn_guardar_operador").attr("disabled", true);
					$("#rfcEdit").css('border','red solid');
				}else{
					$("#btn_guardar_operador").attr("disabled", false);
				   $("#rfcEdit").css('border', '1px solid #ccc');
				}
				if (rfcStr.length < 13) {

					$("#btn_guardar_operador").attr("disabled", true);
					$("#rfcEdit").css('border','red solid');
					return false;
				}
				 if (rfcStr.length > 13) {
					$("#btn_guardar_operador").attr("disabled", true);
					 $("#rfcEdit").css('border','red solid');
					return false;
				}
			}
		 });

		var strCorrecta;
		strCorrecta = rfcStr;
		if (rfcStr.length == 12 ){
			var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
			}else{
			var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
		}
		if (rfcStr.length > 13 ){
			var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
			}else{
			var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
		}
		var validRfc=new RegExp(valid);
		var matchArray=strCorrecta.match(validRfc);
		if (matchArray==null) {
			sweetAlert("RFC NO VALIDA","VULVA A INTENTAR","error");
			$("#btn_guardar_operador").attr("disabled", true);
			$("#rfcEdit").css('border','red solid');
		}
		else {
			$("#btn_guardar_operador").attr("disabled", false);
			$("#rfcEdit").css('border', '1px solid #ccc');
			return true;
		}
	}
	function cancelSaveOperador(){

		$("#form_create_operador")[0].reset();

	}
	function saveOperador(){

		$("#form_create_operador").validate({

			rules: {
				rfc: { required: true,  maxlength: 13},
				nombre: { required: true },
				ap_pat: { required: true },
				ap_mat: { required: true },
				year_fecha: { required: true },
				mes_fecha: { required: true },
				dia_fecha: { required: true},
				telefono: {required: true, number : true},
				correo: {required: true, email: true}
			},
			errorPlacement: function(error,element) {
				return true;
			},
			submitHandler: function(){
				alert("holamundo");
				var formData = new FormData($(".form_create_operador_clase")[0]);
				var l = $("#btn_guardar_operador").ladda();
				l.ladda('start');
				$.ajax({
					type: "POST",
					url:baseURL + "web/Operador_ctrl/guardar_operador",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta) {
					  var obj = JSON.parse(respuesta);
						if (obj.resultado === true) {
						   //Limpiar formulario
						   $("#form_create_operador")[0].reset();
						   //Mensaje de operación realizada con éxito
							setTimeout(function() {
								toastr.options = {
									closeButton: true,
									progressBar: true,
									showMethod: 'slideDown',
									timeOut: 1500
								};
							l.ladda('stop');
							toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');
						}, 1300);
						}
					}
				});
			}
		});

	}

	// METODOS DE EDITAR [EDIAR, HABILITAR, DEHABILITAR]

	function cancelEditOperador(){
		 $("#form_edit_operdor")[0].reset();
	}
	function editOperador(id, nombre, paterno, materno, rfc, nacimeinto, telefono, colonia, domicilio, cruzamientos){

		document.getElementById("idEditar").innerHTML=id+"";
		document.getElementById("idEditar").value=id;
		document.getElementById("nombreEdit").value=nombre;
		document.getElementById("ap_patEdit").value=paterno;
		document.getElementById("ap_matEdit").value=materno;
		document.getElementById("rfcEdit").value=rfc;
		document.getElementById("fecha_nacimeintoEdit").value=nacimeinto;
		document.getElementById("telefonoEdit").value=telefono;
		document.getElementById("coloniaEdit").value=colonia;
		document.getElementById("dimicilioEdit").value=domicilio;
		document.getElementById("cruzmaientosEdit").value=cruzamientos;
	}
	function saveEditOperador(){

		$("#form_edit_operdor").validate({

			rules:{
				nombre: { required: true},
				ap_pat: {required: true},
				ap_mat: {required: true},
				rfc: {required: true},
				telefono: {required: true},
				fecha_nacimiento: {required: true, date: true}
			},
			errorPlacement: function(error,element) {
				return true;
			},
			submitHandler: function(){

				var dataString = $("#form_edit_operdor").serialize();
				var l = $("#btn_save_edit_operador").ladda();
				l.ladda('start');
				$.ajax({
					type: "POST",
					url:baseURL + "web/Operador_ctrl/updater_operador",
					data: dataString,
					success: function(respuesta) {
					  var obj = JSON.parse(respuesta);
						if (obj.resultado === true) {
						   //Limpiar formulario
						   l.ladda('stop');
						   $("#editaroperador").modal('hide');
						   //Mensaje de operación realizada con éxito
							setTimeout(function() {
								toastr.options = {
									closeButton: true,
									progressBar: true,
									showMethod: 'slideDown',
									timeOut: 1200
								};
							toastr.success('Los datos se guardaron correctamente', 'ACTUALIZANDO DATOS');
							setTimeout(function() {
							  window.location.href = baseURL + "operador-lista";
							}, 1300);
						}, 1300);
						}
					}
				});

			}

		});

	}
	function habilitarOperador(id, nombre, paterno, materno){

		var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
		var text = "<h3>¿SEGURO DE HABILITAR OPERADOR?</h3>";
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
				url: baseURL + "web/Operador_ctrl/habilitar_operador",
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function () {
					swal("Hecho!", "OPERADOR CORRECTAMENTE HABILITADO!", "success");
					setTimeout(function() {
						window.location.href = baseURL+"operador-lista";
					}, 2000);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Error deleting!", "Please try again", "error");
				}
			});
		});

	}
	function deshabilitarOperador(id, nombre, paterno, materno){
	   var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
		var text = "<h3>¿SEGURO DE DESHABILITAR OPERADOR?</h3>";
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
				url: baseURL + "web/Operador_ctrl/deshabilitar_operador",
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function () {
					swal("Hecho!", "OPERADOR CORRECTAMENTE DESHABILITADO!", "success");
					setTimeout(function() {
						window.location.href = baseURL+"operador-lista";
					}, 2000);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Error Al Deshabilitar!", "Verifique su conexion o intente de nuevo", "error");
				}
			});
		});
	}

	//METODOS  CREAR PDF PARA IMPRIMIR
	function print_corte_operador_day(id_operador){

		let print_pdf_dia = document.getElementById('modal_content_dia');
		let ifram_pdf_dia = document.createElement("iframe");

		ifram_pdf_dia.setAttribute("src", baseURL + "web/Operador_ctrl/pdf_operador_corte_dia?id=" + id_operador);
		ifram_pdf_dia.setAttribute("id", "load_pdf_dia");
		ifram_pdf_dia.style.width = "100%";
		ifram_pdf_dia.style.height = "510px";
		print_pdf_dia.appendChild(ifram_pdf_dia);
	}
	function close_pdf_operador_day() {
		let print_pdf_dia = document.getElementById('modal_content_dia');
		let ifram_pdf_dia = document.getElementById('load_pdf_dia');
		print_pdf_dia.removeChild(ifram_pdf_dia);
	}
	function print_corte_operador_consulta_dia(id_operador){
		let fecha = document.getElementById('diaa').value;

		let print_pdf_dia = document.getElementById('modal_content_dia_consulta');
		let ifram_pdf_dia = document.createElement("iframe");

		ifram_pdf_dia.setAttribute("src", baseURL + "web/Operador_ctrl/pdf_operador_corte_consulta_dia?id=" + id_operador+"&fecha_dia="+fecha  );
		ifram_pdf_dia.setAttribute("id", "load_pdf_dia_consulta");
		ifram_pdf_dia.style.width = "100%";
		ifram_pdf_dia.style.height = "510px";
		print_pdf_dia.appendChild(ifram_pdf_dia);
	}
	function close_pdf_operador_dia_consulta() {
		let print_pdf_dia = document.getElementById('modal_content_dia_consulta');
		let ifram_pdf_dia = document.getElementById('load_pdf_dia_consulta');
		print_pdf_dia.removeChild(ifram_pdf_dia);
	}
	function print_corte_operador_consulta_rango(id_operador){

		let inicio = document.getElementById('inicio').value;
		let fin = document.getElementById('fin').value;

		let print_pdf_dia = document.getElementById('modal_content_rango');
		let ifram_pdf_dia = document.createElement("iframe");

		ifram_pdf_dia.setAttribute("src", baseURL + "web/Operador_ctrl/pdf_operador_corte_consulta_rango?id=" + id_operador+"&inicio="+inicio+"&fin="+fin  );
		ifram_pdf_dia.setAttribute("id", "load_pdf_dias_rango");
		ifram_pdf_dia.style.width = "100%";
		ifram_pdf_dia.style.height = "510px";
		print_pdf_dia.appendChild(ifram_pdf_dia);
	}
	function close_pdf_operador_dias_rango() {
		let print_pdf_dia = document.getElementById('modal_content_rango');
		let ifram_pdf_dia = document.getElementById('load_pdf_dias_rango');
		print_pdf_dia.removeChild(ifram_pdf_dia);
	}
	function print_corte_operador_mes(id_operador){

		let month = document.getElementById("mesQuery").value;
		let year = document.getElementById("yearQuery").value;

		let print_pdf_dia = document.getElementById('modal_content_mes');
		let ifram_pdf_dia = document.createElement("iframe");

		ifram_pdf_dia.setAttribute("src", baseURL + "web/Operador_ctrl/pdf_operador_corte_mes?id=" + id_operador+"&month="+month+"&year="+year  );
		ifram_pdf_dia.setAttribute("id", "load_pdf_mes");
		ifram_pdf_dia.style.width = "100%";
		ifram_pdf_dia.style.height = "510px";
		print_pdf_dia.appendChild(ifram_pdf_dia);
	}
	function close_pdf_operador_mes() {
		let print_pdf_dia = document.getElementById('modal_content_mes');
		let ifram_pdf_dia = document.getElementById('load_pdf_mes');
		print_pdf_dia.removeChild(ifram_pdf_dia);
	}
	function print_corte_operador_year(id_operador){

		let year = document.getElementById("yearQuery").value;

		let print_pdf_dia = document.getElementById('modal_content_year');
		let ifram_pdf_dia = document.createElement("iframe");

		ifram_pdf_dia.setAttribute("src", baseURL + "web/Operador_ctrl/pdf_operador_corte_year?id=" + id_operador+"&year="+year  );
		ifram_pdf_dia.setAttribute("id", "load_pdf_mes");
		ifram_pdf_dia.style.width = "100%";
		ifram_pdf_dia.style.height = "510px";
		print_pdf_dia.appendChild(ifram_pdf_dia);
	}
	function close_pdf_operador_year() {
		let print_pdf_dia = document.getElementById('modal_content_year');
		let ifram_pdf_dia = document.getElementById('load_pdf_mes');
		print_pdf_dia.removeChild(ifram_pdf_dia);
	}
	//METODOS PARA MANDAR PDF A EMAIL
	function sendEmail_corte_operadorDay(id_operador) {

		let text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#btn_dia").ladda();
			l.ladda('start');

			const xhr_operdor_email_dia = new XMLHttpRequest();
			let params = "id_operador=" + id_operador + " ";
			xhr_operdor_email_dia.open('POST', baseURL + '/web/Operador_ctrl/send_email_day', true);
			xhr_operdor_email_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email_dia.onload = function () {
				if (this.readyState == 4 && this.status === 200) {
					//	FALTA DEFINIR EL SWEET ALERT
					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email_dia.send(params);

		});
	}
	function sendEmailCorteDiaConsulta(id_operador) {

		let fecha = document.getElementById('diaa').value;

		let text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#btn_dia_consulta").ladda();
			l.ladda('start');

			const xhr_operdor_email_dia = new XMLHttpRequest();
			let params = "id_operador=" + id_operador + "&fecha_dia="+fecha;
			xhr_operdor_email_dia.open('POST', baseURL + '/web/Operador_ctrl/send_email_day_consulta', true);
			xhr_operdor_email_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email_dia.onload = function () {
				if (this.readyState == 4 && this.status === 200) {
					//	FALTA DEFINIR EL SWEET ALERT
					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email_dia.send(params);

		});
	}
	function sendEmailCorteRango(id_operador) {

		let inicio = document.getElementById('inicio').value;
		let fin = document.getElementById('fin').value;

		let text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#btn_rango").ladda();
			l.ladda('start');

			const xhr_operdor_email_dia = new XMLHttpRequest();
			let params = "id_operador=" + id_operador + "&inicio="+inicio+ "&fin="+fin;
			xhr_operdor_email_dia.open('POST', baseURL + '/web/Operador_ctrl/send_email_rango', true);
			xhr_operdor_email_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email_dia.onload = function () {
				if (this.readyState == 4 && this.status === 200) {
					//	FALTA DEFINIR EL SWEET ALERT
					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email_dia.send(params);

		});
	}
	function sendEmailCorteMes(id_operador) {

		let month = document.getElementById("mesQuery").value;
		let year = document.getElementById("yearQuery").value;

		let text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#btn_mes").ladda();
			l.ladda('start');

			const xhr_operdor_email_dia = new XMLHttpRequest();
			let params = "id_operador=" + id_operador + "&month="+month+ "&year="+year;
			xhr_operdor_email_dia.open('POST', baseURL + '/web/Operador_ctrl/send_email_mes', true);
			xhr_operdor_email_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email_dia.onload = function () {
				if (this.readyState == 4 && this.status === 200) {
					//	FALTA DEFINIR EL SWEET ALERT
					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email_dia.send(params);

		});
	}
	function sendEmailCorteYear(id_operador) {

		let year = document.getElementById("yearQuery").value;

		let text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#btn_year").ladda();
			l.ladda('start');

			const xhr_operdor_email_dia = new XMLHttpRequest();
			let params = "id_operador=" + id_operador+"&year="+year;
			xhr_operdor_email_dia.open('POST', baseURL + '/web/Operador_ctrl/send_email_year', true);
			xhr_operdor_email_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email_dia.onload = function () {
				if (this.readyState == 4 && this.status === 200) {

					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email_dia.send(params);

		});
	}

}
