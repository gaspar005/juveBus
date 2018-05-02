<style type="text/css">
	.error {
    color:red;
    position: flex;
	}
	.valid {
	    color:green;
	}
	[class*="button-"] {
		  display: inline-block;
		  margin: .5em;
		  padding: 18px;
		  color: white;
	}
	.rfcVal{
		border: solid 1px red;

	}
	.margenes{
		margin-bottom: 20px;
	}

</style>

<div id="start_loading_registro_operador" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/img/loading.gif')?>">
</div>
<div class="container" id="showContentRegistroOperador" style="display: none">
	<div class="row">
		<div class="col-lg-12">
				<div id="target-1" class="widget">
		  				<div class="widget-content">

							<form id="form_create_operador" >
								<h5 class="text-primary">Registro de Operador </h5>
								<hr class="colorgraph">

								<div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="codigo">FRC</label>
					                <input type="text" name="rfc" id="rfcEdit" class="form-control margenes"   tabindex="1" onblur="validaRFC(this.value)" >
						        </div>
								<div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="nombre">Nombre</label>
					                <input type="text" name="nombre" id="nombreEdit" class="form-control margenes"   tabindex="2">
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="ap_pat">Apellido Paterno</label>
					                <input type="text" name="ap_pat" id="ap_pat"  class="form-control margenes"  tabindex="3">
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="ap_mat">Apellido Materno</label>
					                <input type="text" name="ap_mat" id="ap_mat" class="form-control margenes"  tabindex="4">
						        </div>
						        
						        <div class="col-sm-3 col-md-3 col-lg-3" >

					                <label style="width: 100%;" for="fecha_nacimiento">Fecha Nacimiento</label>

					                <select style="width: 30%; display: inline-block;" name="year_fecha" id="year_fecha_nacimientoEdit" class="form-control"  onchange="validarYear(value);">
					                	<option class="" style="width: 10%" value="" selected disabled hidden>Año</option>
					                	<?php
											$current_year = date('Y');

											$range = range($current_year, $current_year-50 );
											$years = array_combine($range, $range);
										?>		
											<?php foreach ($years as $year) { ?>
												<option value="<?php echo $year?>"><?php echo $year?></option>
										<?php } ?>
					                </select>

					                <select  style="width: 31%; display: inline-block;" class="form-control"  name="mes_fecha" id="mes_fecha_nacimientoEdit"  >
					                	   <option class="" style="width: 10%" value="" selected disabled hidden>Mes</option>;
					                													           			
					                </select>

					                <select  style="width: 30%; display: inline-block;" class="form-control"  name="dia_fecha" id="dia_fecha_nacimientoEdit" >
					                	<option class="" style="width: 10%" value="" selected disabled hidden>Dia</option>			                	
					                </select>
						        </div>				        
					
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3 pull-right button-cta" >
					                <button id="btn_cancelar_estudiante" type="button" class=" btn btn-default " data-style="expand-left"  onclick="cancelSaveOperador()">
					                	 Cancelar
					                </button>
					                <button id="btn_guardar_operador" type="submit" class=" ladda-button btn btn-primary" data-style="expand-left" tabindex="5" onclick="saveOperador()">
					                	 Guardar
					                </button>
						        </div>			          
							</form>
		  				</div>
		  			
		  		</div>
		  	</div>	
  		</div>
  	</div>
</div>
	
