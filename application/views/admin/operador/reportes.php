
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
	
	 	<div class="container" >
	 		<div class="row">
	 			<div class="col-lg-12">
					
					<div id="target-1" class="widget">
	      			
	      				<div class="widget-content">
	      					<form id="consultaPersonalizada">
	      						<!-- carga los operadores -->
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
								<div id="showConstumQuery" class="col-lg-3">
								</div>

								<!-- SELECT QUE CARGA AL SELECIONAR UN TIPO DE CONSULTA (DIA, RANGO, MES, AÑO) -->
								<div id="showQueryFor" class="col-lg-3" >
								</div>

								<!-- BOTON PARA EJECUTAR LA CONSULTA -->
								<div id="showButtonQuery" class=" button-cta col-lg-2"  >
								</div>

								<!-- TABLA DE REPORTE DEL DIA ACTUAL (CARGA AL SELECIONAR UN OPERADOR)-->
								<div class="col-lg-12"  id="ShowTableDateCobros" >
								</div>

			      			</form>
		      			</div> <!-- /widget-content -->
		      		
	      			</div> <!-- /widget -->

	 			</div>
	 		</div>
	 	</div>
	
