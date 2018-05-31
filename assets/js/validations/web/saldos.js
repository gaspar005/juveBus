if (window.location.href === baseURL+"saldo-recarga"){
	/* CONVERTIR TEXTO EN MAYUSCULAS */
	$('input[type=text]').keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
	$(document).ready(function() {
		$("#start_loading").css('display', 'none');
		$("#showContent").css('display', 'block');

	  // mostrarDatos("",1,7);

	  // $("input[name=busqueda]").keyup(function(){
	  //   textobuscar = $(this).val();
	  //   valoroption = $("#cantidad").val();
	  //   mostrarDatos(textobuscar,1,valoroption);
	  // });

	  // $("body").on("click",".paginacion li a",function(e){
	  //   e.preventDefault();
	  //   valorhref = $(this).attr("href");
	  //   valorBuscar = $("input[name=busqueda]").val();
	  //   valoroption = $("#cantidad").val();
	  //   mostrarDatos(valorBuscar,valorhref,valoroption);
	  // });

	  // $("#cantidad").change(function(){
	  //   valoroption = $(this).val();
	  //   valorBuscar = $("input[name=busqueda]").val();
	  //   mostrarDatos(valorBuscar,1,valoroption);
	  // });

		//PRECIONAR ENTER AUTOMATICAMENTE
		$('input[type=text]').keyup(function(e){
			if(e.keyCode == 13)
			{
				$(this).trigger("enterKey");
				buscaEstudiante();
			}
		});

		$('.saldo_input_fload').keypress(function(eve) {
			if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
				eve.preventDefault();
			}
			// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
			$('.saldo_input_fload').keyup(function(eve) {
				if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
				}
			});
		});

	});

	function tipo_busqueda_estudiante(tipo){

		if (tipo == 1) {

			const ajaxNameApe = new XMLHttpRequest();
			ajaxNameApe.open('DELETE', baseURL+'/web/Saldo_ctrl/delete_sessionNameApeMate', true);
			ajaxNameApe.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxNameApe.onload = function(){
				if(this.readyState == 4 && this.status === 200){
					let nombre = document.getElementById("id_nombre_saldo");
					let apellidos = document.getElementById("id_paterno_saldo");
					nombre.textContent = "";
					nombre.value = "";
					apellidos.textContent = "";
					apellidos.value = "";
				}
			};
			ajaxNameApe.send();
			$("#showContentNombreApellidosConSession").css('display','none');
			$("#showContentNombreApellidosSinSession").css('display','none');
			$("#showContentCodigoJovenwithSession").css('display','block');
			$("#showContentCodigoJovenWithoutSession").css('display','block');

		}
		if (tipo == 2) {

			const xhr = new XMLHttpRequest();
			xhr.open('DELETE', baseURL+'/web/Saldo_ctrl/delete_sessionCJ', true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onload = function(){
				if(this.readyState == 4 && this.status === 200){
					let cj = document.getElementById("id_codigo_joven_saldo");
					cj.textContent = "";
					cj.value = "";
				}
			};
			xhr.send();
			$("#showContentCodigoJovenwithSession").css('display','none');
			$("#showContentCodigoJovenWithoutSession").css('display','none');
			$("#showContentNombreApellidosConSession").css('display','block');
			$("#showContentNombreApellidosSinSession").css('display','block');

		}
	}

	function buscaEstudiante(){

		valorBuscarNombre = $("input[name=nombre]").val();
		valorBuscarPerterno = $("input[name=ap_pat]").val();
		valorBuscarMaterno = $("input[name=ap_mat]").val();

		valoroption = $("#cantidad").val();
		if (valorBuscarNombre != "" && valorBuscarNombre != null){
			$("input[name=nombre]").css('border', '1px solid #ccc');
			mostrarDatos(valorBuscarNombre ,valorBuscarPerterno, valorBuscarMaterno ,1,valoroption);
		}else{
			$("#nombreSearch").focus().css('border','red solid');
		}

	}

	function mostrarDatos(valorBuscarNombre ,valorBuscarPerterno, valorBuscarMaterno,pagina,cantidad){
		var l = $("#btn_landa_buscar").ladda();
		l.ladda('start');
		$.ajax({
		   url: baseURL + "web/saldo_ctrl/mostrar",
		   type: "POST",
		   data: {nombre:valorBuscarNombre, paterno: valorBuscarPerterno, materno: valorBuscarMaterno ,nropagina:pagina,cantidad:cantidad},
		   dataType:"json",
		   success:function(response){
		   filas = "";
		   $.each(response.estudiante,function(key,item){

				filas += "<tr> ";
				  filas += "<td style='text-align: left;'>";
					filas += "<label id='codigo_joven"+item.id_usuario+"'>"+item.codigo_joven+"</label>";
				  filas += "</td>";
				  filas += "<td style='text-align: left;'>";
					filas += "<label id='nombre"+item.id_usuario+"'>"+item.nombre+"</label>";
				  filas += "</td>";
				  filas += "<td style='text-align: left;'>";
					filas += "<label id='paterno"+item.id_usuario+"'>"+item.ap_pat+"</label>";
				  filas += "</td>";
				  filas += "<td>";
					filas += "<label id='materno"+item.id_usuario+"'>"+item.ap_mat+"</label>";
				  filas += "</td>";
				  filas += "<td>";
					filas += "<label id='curp"+item.id_usuario+"'>"+item.curp+"</label>";
				  filas += "</td>";
				  filas += "<td class='text-center'>";
					filas += "<label id='fecha_nacimiento"+item.id_usuario+"'>"+item.fecha_nacimiento+"</label>";
				  filas += "</td>";
				  filas += "<td class='text-center'>";
					filas += "<label id='saldo"+item.id_usuario+"'>"+ "$ " +item.saldo+ " PESOS" +"</label>";
				  filas += "</td>";
				  filas += "<td>";
					filas += "<button data-toggle='modal' data-target='#recargarSaldoModal' type='button' onclick=\"showDataEstudiante('" +item.id_usuario +"', '"+item.nombre+"', '"+item.ap_pat+"', '"+item.ap_mat+"', '"+item.codigo_joven+"', '"+item.saldo+"')\" class='col-gl-9 btn btn-primary text-center'>Recargar</button>";
				  filas += "</td>";
				filas += "</tr>";
			});
		   l.ladda('stop');
		   $("#showNoneTable").css('display', 'block');
		   $("#tbclientes tbody").html(filas);
		   linkseleccionado = Number(pagina);
		   //total registros
		   totalregistros = response.totalregistros;
		   //cantidad de registros por pagina
		   cantidadregistros = response.cantidad;

		   numerolinks = Math.ceil(totalregistros/cantidadregistros);
		   paginador = "<ul class='pagination'>";
		   if(linkseleccionado>1){
			  paginador+="<li><a href='1'>&laquo;</a></li>";
			  paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
		   }
		   else{
			paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
			paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
		   }
		   //muestro de los enlaces
		   //cantidad de link hacia atras y adelante
		   cant = 2;
		   //inicio de donde se va a mostrar los links
		   pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
		   //condicion en la cual establecemos el fin de los links
		   if (numerolinks > cant) {
				//conocer los links que hay entre el seleccionado y el final
				pagRestantes = numerolinks - linkseleccionado;
				//defino el fin de los links
				pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
		   }
		   else{
			pagFin = numerolinks;
		   }

		   for (var i = pagInicio; i <= pagFin; i++) {
			if (i == linkseleccionado)
			  paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
			else
			  paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
		   }
		  //condicion para mostrar el boton sigueinte y ultimo
		  if(linkseleccionado<numerolinks) {
			paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
			paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

		  }else {
			paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
			paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
		  }

		  paginador +="</ul>";
		  $(".paginacion").html(paginador);

		}
	  });
	}
	function showDataEstudiante(id, nombre, paterno, materno, codigo_joven, saldo) {

		$("#ladda_btn_alta_saldo").prop('disabled', true);
		document.getElementById("idEditar").innerHTML=id+"";
		document.getElementById("idEditar").value=id;
		var JOVEN = "";var NOMBRE = "";	var PATERNO = "";var MATERNO = ""; var SALDO = "";

		JOVEN += "<label >Codigo Joven</label>";
		JOVEN += "<p >"+ codigo_joven +"</p>";
		$("#jovenEstu").html(JOVEN);

		NOMBRE += "<label >Nombre</label>";
		NOMBRE += "<p >"+ nombre +"</p>";
		$("#nombreEstu").html(NOMBRE);

		PATERNO += "<label >Apellido Paterno</label>";
		PATERNO += "<p >"+ paterno +"</p>";
		$("#paternoEstu").html(PATERNO);

		MATERNO += "<label >Apellido Materno</label>";
		MATERNO += "<p >"+ materno +"</p>";
		$("#maternoEstu").html(MATERNO);

		SALDO += "<label>Saldo Actual</label>";
		SALDO += "<p style='display: inline-block; text-align: center; width: 40%;'>"+ " $ " + saldo +"</p> <p style='width: 35%; display: inline-block; text-align: right;color: red'>"+"+"+"</p>";
		SALDO += "<input type='hidden' id='actual' value='"+ saldo +"'> ";
		$("#saldo_anterior").html(SALDO);

		var AGREGAR = "";
		AGREGAR += "<input type=\"button\" class=\"btn btn-primary\" value=\"Agregar\" style=\"margin-top: 25px\" onclick=\"agregar_saldo()\">";
		$("#switchButtonAgregar_and_Editar").html(AGREGAR).css('display', 'block');

	}
	function cancelarAltaSaldo() {
		$("#form_alta_saldo")[0].reset();
		$("#saldo_ingresado").css('display', 'none');
		$("#saldo_total").css('display', 'none');
		var AGREGAR = "";
		AGREGAR += "<input type=\"button\" class=\"btn btn-primary\" value=\"Agregar\" style=\"margin-top: 25px\" onclick=\"agregar_saldo()\">";
		$("#switchButtonAgregar_and_Editar").html(AGREGAR).css('display', 'block');
	}
	function agregar_saldo() {

		$("#ladda_btn_alta_saldo").prop('disabled', false);
		$("#saldoRecarga").prop('disabled', true);
		var ingresado = $("#saldoRecarga").val();
		var actual = $("#actual").val();

		var totalShow = parseFloat(actual) + parseFloat(ingresado);
		var total = totalShow.toFixed(2);

		var SALDO_MAS = "";
		SALDO_MAS += "<label >Saldo Ingresado</label>";
		SALDO_MAS += "<p style='display: inline-block; text-align: center; width: 40%;'>"+ " $ " + ingresado +"</p><p style='width: 35%; display: inline-block; text-align: right;color: red'>"+"="+"</p>";
		$("#saldo_ingresado").html(SALDO_MAS).css('display', 'block');

		var TOTAL = "";
		TOTAL += "<label >Saldo Total</label>";
		TOTAL += "<p style='color: #00ba8b'>"+ " $ " + total +"</p>";
		$("#saldo_total").html(TOTAL).css('display', 'block');

		var EDITAR = "";
		EDITAR += "<input type=\"button\" class=\"btn btn-info\" value=\"Editar\" style=\"margin-top: 25px\" onclick=\"editar_saldo()\">";
		$("#switchButtonAgregar_and_Editar").html(EDITAR).css('display', 'block');
	}
	function editar_saldo(){
		$("#ladda_btn_alta_saldo").prop('disabled', true);
		$("#saldoRecarga").prop('disabled', false);
		var AGREGAR = "";
		AGREGAR += "<input type=\"button\" class=\"btn btn-primary\" value=\"Agregar\" style=\"margin-top: 25px\" onclick=\"agregar_saldo()\">";
		$("#switchButtonAgregar_and_Editar").html(AGREGAR).css('display', 'block');

		$("#saldo_ingresado").css('display', 'none');
		$("#saldo_total").css('display', 'none');

		$("#switchCancelarSaldoAgregado").css('display', 'none');

	}
	/*TESTEO DEL PDF para eviar al correo del estudiante*/
	function printDetalleExtraudinaria(){
		var id = $("#idEditar").val();
		var saldo = $("#saldoRecarga").val();
		window.open(baseURL + "web/saldo_ctrl/pdf_por_empleadoExtraordinario?id="+ id +"&saldo="+saldo);
	}
	function saveAltaSaldo() {

		$("#form_alta_saldo").validate({
			rules: {
				saldo: { required: true},
			},
			messages: {
				saldo: "Cantidad es Necesarias",
			},
			submitHandler: function(){
				var id = $("#idEditar").val();
				var saldo = $("#saldoRecarga").val();

				var text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
				swal({
					title: text,
					type: "warning",
					showCancelButton: true,
					html:true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "SI, RECARGAR SALDO AHORA!",
					closeOnConfirm: true
				}, function (isConfirm) {
					if (!isConfirm) return;
					var l = $("#ladda_btn_alta_saldo").ladda();
					l.ladda('start');
					$.ajax({
					type: "POST",
					url:baseURL + "web/saldo_ctrl/alta_saldo_estudiante",
					data: {id:id, saldo:saldo},
					dataType: "html",
					success: function(respuesta) {
						var obj = JSON.parse(respuesta);

						if (obj.resultado === true) {
							//Limpiar formulario
							l.ladda('stop');
							$("#form_alta_saldo")[0].reset();
							$("#recargarSaldoModal").modal('hide');
							//Mensaje de operación realizada con éxito
								setTimeout(function() {
									toastr.options = {
										closeButton: true,
										progressBar: true,
										showMethod: 'slideDown',
										timeOut: 1500
									};
									//toastr.success('SALDO ASIGNADO CORRECTAMENTE', 'GUARDARON DATOS');
									swal("Hecho!", "SALDO ASIGNADO CORRECTAMENTE!", "success");
									setTimeout(function() {
										window.location.href = baseURL + "saldo-recarga";
									}, 1300);
								}, 1300);
							}else {
							l.ladda('stop');
							swal("Error al enviar el correo!", "Porfavor Intente de nuevo", "error");
						}

						},
						error: function (xhr, ajaxOptions, thrownError) {
							swal("Error con la conexion!", "Porfavor Intente de nuevo", "error");
						}
					});
				});
			}
		});
	}
}
