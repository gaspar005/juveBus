
	<style>
		.error {
		    color:red;
		    font-size: 10px;
		    position: flex;
		    margin: 0;
		}
		.valid {
		    color:green;
		}
		.table-tr-color{
			background: grey; 
			color: white;
			
		}
		tr > th{
			border: solid 1px black;
		}
		tr > td{
			border: solid 1px black;

		}
		[class*="button-"] {
		  display: inline-block;
		  margin: .5em;
		  padding: 18px;
		  color: white;
		}
	</style>
	<div id="start_loading_reporte_operador" class="container" style="text-align: center">
		<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
	</div>
	<div class="container" id="showContentReporteOperador" style="display: none">
		<div class="widget-content">
			<form id="consultaPersonalizada">
				<div class="col-lg-12" >
					<div class="col-lg-3" id="starQuery" style="display: none;">
						<p>Seleccione un operador</p>
						<?php if ($operadores != null ): ?>
							<select name="operador" id="selectOperador" class="form-control" onchange="getInfoOperador(this.value)">
								<option value="" selected disabled hidden >operador</option>
								<?php foreach ($operadores as $operador): ?>
									<option value="<?php echo $operador->id_operador ?>"> <?php echo $operador->nombre.' '.$operador->ap_pat.' '.$operador->ap_mat ?> </option>
								<?php endforeach ?>
							</select>
						<?php endif ?>
					</div>
					<!-- SELECT QUE CARGA AL SELECIONAR UN OPERADOR PARA REALIZAR UNA CONSULTA PERSONALIZADA -->
					<div class="col-lg-2" id="showConstumQuery" >
					</div>
					<!-- SELECT QUE CARGA AL SELECIONAR UN TIPO DE CONSULTA (DIA, RANGO, MES, AÑO) -->
					<div id="showQueryFor" class="col-lg-3 " >
					</div>
					<!-- BOTON PARA EJECUTAR LA CONSULTA -->
					<div id="showButtonQuery" class="button-cta col-lg-3 pull-right text-center"  >
					</div>
				</div>
				<!-- TABLA DE REPORTE DEL DIA ACTUAL (CARGA AL SELECIONAR UN OPERADOR)-->
				<div id="ShowTableDateCobros" class="col-lg-12 ">

				</div>
			</form>
		</div>
	</div>

	<div class="modal fade modal_corte_dia_pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv_corte_dia">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content_dia">
				<div class="modal-header btn-info">
					<button type="button" class="close" data-dismiss="modal" onclick="close_pdf_operador_day()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
					<h4 class="modal-title">Corte por Dia</h4>
					<!--	AQUI SE CREA EL CONTENIDO DEL PDF	-->
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal_corte_dia_pdf_consulta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv_corte_dia_consulta">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content_dia_consulta">
				<div class="modal-header btn-info">
					<button type="button" class="close" data-dismiss="modal" onclick="close_pdf_operador_dia_consulta()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
					<h4 class="modal-title">Corte por Dia</h4>
					<!--	AQUI SE CREA EL CONTENIDO DEL PDF	-->
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal_corte_dias_rango" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv_corte_rango">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content_rango">
				<div class="modal-header btn-info">
					<button type="button" class="close" data-dismiss="modal" onclick="close_pdf_operador_dias_rango()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
					<h4 class="modal-title">Corte por Rango dias</h4>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal_corte_dias_mes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv_corte_mes">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content_mes">
				<div class="modal-header btn-info">
					<button type="button" class="close" data-dismiss="modal" onclick="close_pdf_operador_mes()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
					<h4 class="modal-title">Corte por Mes</h4>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal_corte_year" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv_corte_year">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content_year">
				<div class="modal-header btn-info">
					<button type="button" class="close" data-dismiss="modal" onclick="close_pdf_operador_year()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
					<h4 class="modal-title">Corte por Año</h4>

				</div>
			</div>
		</div>
	</div>
