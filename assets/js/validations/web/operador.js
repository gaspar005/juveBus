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
		}

		//REPORTES
		if (window.location.href === baseURL+"operador-reportes"){
			$("#start_loading_reporte_operador").css('display', 'none');
			$("#showContentReporteOperador").css('display', 'block');
			$('#starQuery').css('display', 'block');
			validation.init("form");
		}



		inicalizarDataTable("operadorTable");
	});
	// METODO PARA EL REPORTE DE OPERADORES
	function getInfoOperador(operador){

		$("#ShowTableDateCobros").css('display', 'none');
		$("#ShowTableDateCobros").empty();
		$("#showButtonQuery").css('display', 'none');
		$("#showButtonQuery").empty();
		$("#showQueryFor").empty();

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/getInfor_operador",
			data: {operador: operador},
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);

				if (obj.resultado === true) {

					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>" + "Reposte de cobros realizados hoy " + obj.operador.fecha +"</strong></p> ";

					if (obj.operador.hayPasajeros === true) {

						HTML += "<table>";
							HTML += "<thead>";
								HTML += "<tr class='table-tr-color ' >";
									HTML += "<th width='33%'>Tarifa</th>";
									HTML += "<th width='34%' >Cantida Pasajos</th>";
									HTML += "<th width='33%' >Total Ganancia</th>";
								HTML += "</tr>";
							HTML += "</thead>";
							HTML += "<tbody>";

								HTML += "<tr>";
									HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +   " </td>";
									HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " </td>";
									HTML += "<td style='text-align:center' >" + "$ " + obj.operador.ganancias + "</td>";
								HTML += "</tr>";

							HTML += "</tbody>";
						HTML += "</table>";

						$("#ShowTableDateCobros").html(HTML).css('display', 'block');

					}else{

						HTML += "<p style='color: red; text-align:center;'> " + obj.operador.pasajeros + " </p>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');

					}

					var htmlSelect = "";

					htmlSelect += "<p>Consulta Personalizada</p>";
					htmlSelect += "<select name='opcionPersonalizada' class='form-control'  id='opcionPersonalizadaSelect' onchange='personalizada(this.value)' > ";

						htmlSelect += "<option class='' style='width: 10%'' value='' selected disabled hidden>Selecciona Tipo</option>";
						htmlSelect += "<option value='dia'> Dia </option>";
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

				htmlSelectDay += "<p>Seleccione Dia</p>";
				htmlSelectDay += "<input style='width:50%'  name='dia' class='form-control datepicker'  type='text' id='diaa'  />";

				$("#showQueryFor").html(htmlSelectDay).css('display', 'block');

				var now = moment();

				$.datepicker.setDefaults($.datepicker.regional["es"]);

				$("#diaa").datepicker({
					dateFormat: 'dd/mm/yy'
				});

				$("#diaa").datepicker('setDate', now.format('DD/MM/YYYY'));

				var showBoton = "";

				showBoton += "<button id='btn_consulta_por_dia' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorDia()' >consultar dia</button>";
				$("#showButtonQuery").html(showBoton).css('display', 'block');

				break;
			case "rango":

				var htmlSelectRange = "";

				htmlSelectRange += "<p>Seleccione Rango Inico - Fin </p>";
				htmlSelectRange += "<input style='display: inline-block; width:39%' type='text' class='form-control' name='inicio' id='inicio' /> ";
				htmlSelectRange += "<input style='display: inline-block; width:39%' type='text' class='form-control' name='fin' id='fin' /> ";

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

				var showBotonRango = "";

				showBotonRango += "<button id='btn_consulta_por_rango' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorRango()' >consultar Rango</button>";
				$("#showButtonQuery").html(showBotonRango).css('display', 'block');
				break;
			case "mes":
				$.ajax({
					type: "GET",
					url: baseURL + "web/Operador_ctrl/getYearEsistentes",
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);

						if (obj.resultado === true) {

							var htmlSelectMes = "";
							var num_fila = 1;
							var num_fila1 = 1;

							var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

								htmlSelectMes += "<p>Seleccione Año y Mes</p>";

								htmlSelectMes += "<select style='display: inline-block; width: 45%;' class='validate form-control' name='year' id='yearQuery' data-validate='required'> ";

								htmlSelectMes += "<option  value='' selected disabled hidden>Año</option>";

								for (l in obj.years) {

									htmlSelectMes += "<option value='" + obj.years[l].year + "'> " + obj.years[l].year + "  </option>";

									num_fila1++;
								}

								htmlSelectMes += "</select> ";
								htmlSelectMes += "<select style='display: inline-block; width: 45%;' class='validate form-control' name='mes' id='mesQuery' data-validate='required'> ";

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

							var showBotonMes = "";
							showBotonMes += "<button id='btn_consulta_por_mes' type='submit' class='ladda-button btn btn-primary' onclick='consultarPorMes()'>consultar Mes</button>";
							$("#showButtonQuery").html(showBotonMes).css('display', 'block');

						}
					}
				});
				break;
			case "year":
				$.ajax({
					type: "GET",
					url: baseURL + "web/Operador_ctrl/getYearEsistentes",
					success: function (respuesta) {
						var obj = JSON.parse(respuesta);

						if (obj.resultado === true) {

							var htmlSelecYear = "";
							var num_fila = 1;
							htmlSelecYear += "<p>Seleccione Año</p>";

							htmlSelecYear += "<select name='year' id='yearQuery' class='form-control' > ";

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

		var id_operador = $("#selectOperador").val();
		var fecha_dia   = $("#diaa").val();

		var l = $("#btn_consulta_por_dia").ladda();

		l.ladda('start');

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/searchQueryDay",
			data: {id_operador: id_operador, fecha_dia: fecha_dia },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {

					l.ladda('stop');
					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>"+ " Reposte de " + obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:92%' >";
								HTML += "<thead>";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%'>Tarifa</th>";
										HTML += "<th width='34%'>Cantida Pasajos</th>";
										HTML += "<th width='33%'>Total Ganancia</th>";
									HTML += "</tr>";
								HTML += "</thead>";
								HTML += "<tbody>";

									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " </td>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";

								HTML += "</tbody>";
							HTML += "</table>";

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

		var id_operador = $("#selectOperador").val();
		var dia_inicio  = $("#inicio").val();
		var dia_fin     = $("#fin").val();

		var l = $("#btn_consulta_por_rango").ladda();

		l.ladda('start');

		$.ajax({
			type: "POST",
			url:baseURL + "operador/consulta/rango",
			data: {id_operador: id_operador, dia_inicio: dia_inicio, dia_fin:dia_fin },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {

					l.ladda('stop');
					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>"+ "Reposte de " + obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:90%'>";

								HTML += "<thead>";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%'>Tarifa</th>";
										HTML += "<th width='33%'>Cantida Pasajos</th>";
										HTML += "<th width='33%'>Total Ganancia</th>";
									HTML += "</tr>";
								HTML += "</thead>";

								HTML += "<tbody>";
									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " </td>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";
								HTML += "</tbody>";

						HTML += "</table>";

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

		var id_operador = $("#selectOperador").val();
		var mes  = $("#mesQuery").val();
		var year = $("#yearQuery").val();

		var l = $("#btn_consulta_por_mes").ladda();

		l.ladda('start');

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/searchQueryMonth",
			data: {id_operador: id_operador, mes: mes, year:year },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {

					l.ladda('stop');
					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'> <strong>"+ "Reposte de "+obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:90%'>";

								HTML += "<thead>";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%'>Tarifa</th>";
										HTML += "<th width='33%'>Cantida Pasajos</th>";
										HTML += "<th width='33%'>Total Ganancia</th>";
									HTML += "</tr>";
								HTML += "</thead>";

								HTML += "<tbody>";
									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " </td>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";
								HTML += "</tbody>";

						HTML += "</table>";

						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}else{
						HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}
				}
			}
		});

	}
	function consultarPorYear(){

		var id_operador = $("#selectOperador").val();
		var year = $("#yearQuery").val();

		var l = $("#btn_consulta_por_year").ladda();

		l.ladda('start');

		$.ajax({
			type: "POST",
			url:baseURL + "web/Operador_ctrl/searchQueryYear",
			data: {id_operador: id_operador, year:year },
			success: function(respuesta) {
			  var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {

					l.ladda('stop');
					var HTML = "";
					HTML += "<br>";
					HTML += "<p style='text-align: center'><strong>"+ " Reposte de "+obj.operador.fecha +"</strong></p> ";
					if (obj.operador.hayPasajeros === true) {
						HTML += "<table style='width:90%'>";

								HTML += "<thead >";
									HTML += "<tr class='table-tr-color '>";
										HTML += "<th width='33%'>Tarifa</th>";
										HTML += "<th width='33%'>Cantida Pasajos</th>";
										HTML += "<th width='33%'>Total Ganancia</th>";
									HTML += "</tr>";
								HTML += "</thead>";

								HTML += "<tbody>";
									HTML += "<tr>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.tarifa +  " Pesos " + " </td>";
										HTML += "<td style='text-align:center' >" + obj.operador.pasajeros+ " </td>";
										HTML += "<td style='text-align:center' >" + "$ " + obj.operador.ganancias +  " Pesos " +  "</td>";
									HTML += "</tr>";
								HTML += "</tbody>";

						HTML += "</table>";

						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}else{
						HTML += "<h1 style='color: red; text-align:center'> " + obj.operador.pasajeros + " </h1>";
						$("#ShowTableDateCobros").html(HTML).css('display', 'block');
					}
				}
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
					$("#rfcEdit").focus().css('border','red solid');
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
					 $("#rfcEdit").focus().css('border','red solid');
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
				rfc: { required: true},
				nombre: { required: true, maxlength: 60 },
				ap_pat: { required: true },
				ap_mat: { required: true },
				year_fecha: { required: true },
				mes_fecha: { required: true },
				telefono: {required: true, number : true},
			},
			errorPlacement: function(error,element) {
				return true;
			},
			submitHandler: function(){

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

}else {
	console.log("no carga nada");
}
