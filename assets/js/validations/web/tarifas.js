if (window.location.href === baseURL+"ajustes") {
	$(document).on("ready", inicio);

	function inicio() {
		$("#start_loading_ajustes").css('display', 'none');
		$("#showContentAjustes").css('display', 'block');
		mostrarDatos();
		$("body").on("click", "#listaEmpleados a", function (event) {
			let editar = document.getElementById('showEditSettings');
			editar.style.display = 'block';
			event.preventDefault();
			id_settings = $(this).attr("href");
			concepto = $(this).parent().parent().children("td:eq(0)").text();
			tarifa = $(this).parent().parent().children("td:eq(1)").text();
			const regex = /(\d+)/g;
			tarifa1 = tarifa.match(regex);

			$("#idS").val(id_settings);
			$("#conceptoID").val(concepto);
			$("#tarifaID").val(tarifa1);
		});
		$("#btnactualizar").click(actualizar);
		$("#btncancelar").click(cancelarSave);
	}

	function cancelarSave() {
		$("#form-actualizar")[0].reset();
		let editar = document.getElementById('showEditSettings');
		editar.style.display = 'none';
	}

	function mostrarDatos() {

		const xhr = new XMLHttpRequest();
		xhr.open('GET', baseURL + "web/Ajustes_ctrl/mostrar", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onload = function () {
			if (this.readyState == 4 && this.status === 200) {
				const saldos = JSON.parse(this.responseText);
				let htmlTemplate = "";
				htmlTemplate = "<table class='table table-responsive table-bordered'>" +
					"<thead>";
				htmlTemplate += "<tr>" +
					"<th>Concepto</th>" +
					"<th>Tarifa</th>" +
					"<th class='text-center'>Acción</th>" +
					"</tr>";
				htmlTemplate += "</thead>" +
					"<tbody>";
				saldos.forEach(function (saldo) {
					htmlTemplate += "<tr>" +
						"<td>" + saldo.concepto + "</td>" +
						"<td>" + "$ " + saldo.valor + " Pesos" + "</td>" +
						"<td class='text-center'>" +
						"<a href='" + saldo.id_settings + "' class='btn btn-primary' data-toggle='modal' data-target='#myModal'> <span class=' icon-edit'></span></a> " +
						"</td>" +
						"</tr>";
				});
				htmlTemplate += "</tbody>" +
					"</table>";
				document.getElementById("listaEmpleados").innerHTML = htmlTemplate;
			}
		}
		xhr.send();

	}

	function actualizar() {
		let actualizando = document.getElementById('btnactualizar');
		actualizando.disabled = true;
		actualizando.textContent = "Actualizando..";
		$.ajax({
			url: baseURL + "web/Ajustes_ctrl/actualizar",
			type: "POST",
			data: $("#form-actualizar").serialize(),
			success: function (respuesta) {
				var obj = JSON.parse(respuesta);
				if (obj.resultado === true) {
					actualizando.disabled = false;
					actualizando.textContent = "Guardar";
					mostrarDatos();
					let editar = document.getElementById('showEditSettings');
					editar.style.display = 'none';
					setTimeout(function () {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 1500
						};
						toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');
					}, 1300);
				} else {
					var obj = JSON.parse(respuesta);
					if (obj.resultado === false) {
						mostrarDatos();
						swal("No hay cambios aplicados!", "Aplique cambios solo si son requeridos", "error");
						actualizando.disabled = false;
						actualizando.textContent = "Guardar";
					}
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				swal("Error detectado!", "Porfavor verifique su conexion", "error");
			}
		});
	}
}else{
	console.log("no carga nada de tarifas");
}
