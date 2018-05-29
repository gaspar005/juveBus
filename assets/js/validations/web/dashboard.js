if (window.location.href === baseURL+"dashboard") {
	$(document).ready(function () {
		document.getElementById("start_loading").style.display = "none";
		document.getElementById("showContentCardDia").style.display = "block";
		document.getElementById("load_details_operador").style.display = "block";
		mostrarTotalesDia();
		detalle_operadores_por_dia();
		setInterval(function () {
			mostrarTotalesDia();
			detalle_operadores_por_dia();
		}, 60000);
	});

	function mostrarTotalesDia() {

		/*let loading = document.getElementById("loadEstadisticasDia");
		let img_loding = document.createElement('img');
		img_loding.setAttribute("src",  baseURL + "assets/imgs/spinner_img_load.gif");
		img_loding.setAttribute("id", "img_load");
		loading.appendChild(img_loding);*/
		const xhr_grado_es = new XMLHttpRequest();
		xhr_grado_es.open('GET', baseURL + '/web/Deshboard_ctrl/get_estadisticas_general_dashboard', true);
		xhr_grado_es.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr_grado_es.onload = function () {
			if (this.readyState == 4 && this.status === 200) {

				/*let print_img = document.getElementById('loadEstadisticasDia');
				let img_remove = document.getElementById('img_load');
				print_img.removeChild(img_remove);*/

				const dia_general = JSON.parse(this.responseText);
				let htmlTemplate_dia = "";
				dia_general.forEach(function (dia) {
					if (dia.estudiantes == 0) {
						htmlTemplate_dia += "<div class='stat'>AUN NO HAY ESTUDIANTES";
					} else {
						htmlTemplate_dia += "<div class='stat'>ESTUDIANTES QUE ABORDARON LOS CAMIONES HOY";
						htmlTemplate_dia += "<i class='icon-group' ><span class='value'>" + dia.estudiantes + "Estudiantes</span></i>";
					}
					htmlTemplate_dia += "</div>";
					if (dia.cantidad === null) {
						htmlTemplate_dia += "<div class='stat'>NO  HAY PASAJEROS <br>";
					} else {
						htmlTemplate_dia += "<div class='stat'>IMPORTE TOTAL DE PASAJERES <br>";
						htmlTemplate_dia += "<img src='" + baseURL + "assets/font/money.png' style='height: 56px; padding-bottom: 20px'>";
						htmlTemplate_dia += "<span class='value'>" + dia.cantidad + "Pesos</span>";
					}
					htmlTemplate_dia += "</div>";

				});
				template = "";
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth() + 1;
				var yyyy = today.getFullYear();
				if (dd < 10) {
					dd = '0' + dd
				}
				if (mm < 10) {
					mm = '0' + mm
				}
				today = dd + '-' + mm + '-' + yyyy;
				template += "<h5>ESTADÍSTICAS DEL DÍA <strong>" + " " + today + "</strong> </h5>";
				document.getElementById("loadEstadisticasDia").innerHTML = template;
				document.getElementById("big_stats").innerHTML = htmlTemplate_dia;
			}
		};
		xhr_grado_es.send();
	}

	function detalle_operadores_por_dia() {

		/*let loading = document.getElementById("loadEstadisticasDia");
		let img_loding = document.createElement('img');
		img_loding.setAttribute("src",  baseURL + "assets/imgs/spinner_img_load.gif");
		img_loding.setAttribute("id", "img_load");
		loading.appendChild(img_loding);*/
		const xhr_operdor_dia = new XMLHttpRequest();
		xhr_operdor_dia.open('GET', baseURL + '/web/Deshboard_ctrl/get_estadisticas_operador_dia', true);
		xhr_operdor_dia.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr_operdor_dia.onload = function () {
			if (this.readyState == 4 && this.status === 200) {

				const operador_dia = JSON.parse(this.responseText);
				let htmlTemplate_operador_body = "";
				let htmlTemplate_operador_dia_header = "";

				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth() + 1;
				var yyyy = today.getFullYear();
				if (dd < 10) {
					dd = '0' + dd
				}
				if (mm < 10) {
					mm = '0' + mm
				}
				today = dd + '-' + mm + '-' + yyyy;
				htmlTemplate_operador_dia_header += "<h5 style='display: inline-block;'>GANANCIA DEL OPERADO POR TOTAL DE ESTUIDIANTES  <strong>" + " " + today + "</strong> </h5>";
				htmlTemplate_operador_dia_header += "<a type='button' class='btn btn-primary pull-right' href='" + baseURL + "operador-reportes" + "' >Más Reportes </a>";
				document.getElementById("header_card_operador").innerHTML = htmlTemplate_operador_dia_header;

				htmlTemplate_operador_body += "<table class='table table-striped table-bordered'>";
				htmlTemplate_operador_body += "<thead>";
				htmlTemplate_operador_body += "<tr>";
				htmlTemplate_operador_body += "<th > Operador </th>";
				htmlTemplate_operador_body += "<th> Cantidad de Estudiantes</th>";
				htmlTemplate_operador_body += "<th> Tarifa Pasaje </th>"
				htmlTemplate_operador_body += "<th class='text-right'> Importe </th>";
				htmlTemplate_operador_body += "<th class='text-center'> Recorte </th>";
				htmlTemplate_operador_body += "</tr>";
				htmlTemplate_operador_body += "</thead>";
				htmlTemplate_operador_body += "<tbody>";
				operador_dia.forEach(function (operador) {
					htmlTemplate_operador_body += "<tr>";
					htmlTemplate_operador_body += "<td> " + operador.nombre + " " + operador.ap_pat + " " + operador.ap_mat + " </td>";
					if (operador.estudiantes == 1) {
						htmlTemplate_operador_body += "<td> " + operador.estudiantes + " Estudiante</td>";
					} else {
						htmlTemplate_operador_body += "<td> " + operador.estudiantes + " Estudiantes</td>";
					}
					htmlTemplate_operador_body += "<td> $ " + operador.cobro + " Pesos</td>";
					htmlTemplate_operador_body += "<td class='text-right'> $ " + operador.importe + " pesos </td>";
					htmlTemplate_operador_body += "<td class='text-center'>";
					htmlTemplate_operador_body += "<button style='margin: 1px 1px' class='btn btn-primary' type='button' data-backdrop='static'  data-keyboard='false' id='print_corte_operador' data-toggle='modal' data-target='.bs-example-modal-lg' onclick='print_day_corte(" + operador.id_operador + ")'  ><span class='icon-print'></span></button>";
					if (operador.correo) {
						htmlTemplate_operador_body += "<button style='margin: 1px 1px' class='ladda-button btn btn-success' data-style='expand-left' id='send_email_operador' onclick='send_day_corte(" + operador.id_operador + ")'><span class='icon-envelope-alt'></span></button>";
					}
					htmlTemplate_operador_body += "</td>";
					htmlTemplate_operador_body += "</tr>";
				});
				htmlTemplate_operador_body += "</tbody>";
				htmlTemplate_operador_body += "</table>";
				document.getElementById("consten_table_operdador").innerHTML = htmlTemplate_operador_body;
			}
		};
		xhr_operdor_dia.send();
	}

	function print_day_corte(id) {

		let print_pdf = document.getElementById('modal-content');
		let ifram_pdf = document.createElement("iframe");

		ifram_pdf.setAttribute("src", baseURL + "web/Deshboard_ctrl/pdf_por_corte_dia?id=" + id);
		ifram_pdf.setAttribute("id", "load_pdf");
		ifram_pdf.style.width = "100%";
		ifram_pdf.style.height = "510px";
		print_pdf.appendChild(ifram_pdf);

	}

	function close_pdf() {
		let print_pdf = document.getElementById('modal-content');
		let ifram_pdf = document.getElementById('load_pdf');
		print_pdf.removeChild(ifram_pdf);
	}

	function send_day_corte(id_operador) {

		var text = "<h3>¿ESTA SEGURO DE REALIZAR ESTA ACCIÓN?</h3>";
		swal({
			title: text,
			type: "info",
			html: true,
			showCancelButton: true,
			confirmButtonColor: "#428BCA",
			confirmButtonText: "SI, ENVIAR CORTE AHORA!",
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function () {

			let l = $("#send_email_operador").ladda();
			l.ladda('start');

			const xhr_operdor_email = new XMLHttpRequest();
			let params = "id_operador=" + id_operador + " ";
			xhr_operdor_email.open('POST', baseURL + '/web/Deshboard_ctrl/send_email_day_operador', true);
			xhr_operdor_email.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr_operdor_email.onload = function () {
				if (this.readyState == 4 && this.status === 200) {
					//	FALTA DEFINIR EL SWEET ALERT
					l.ladda('stop');
					swal("Hecho!", "Correo enviado Correctamente!", "success");
				}
			};
			xhr_operdor_email.send(params);

		});

	}

}
