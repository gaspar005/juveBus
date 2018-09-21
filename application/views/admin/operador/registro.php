<style type="text/css">
	.error {
    color:red;
    position: flex;
	}
	.valid {
	    color:green;
	}
	.custom-file-input::-webkit-file-upload-button {
		 visibility: hidden;
	 }
	.custom-file-input::before {
		content: 'Seleccione una Imágen';
		display: inline-block;
		background: rgba(39,107,26,0.87);
		color: white;
		border-radius: 3px;
		outline: none;
		white-space: nowrap;
		-webkit-user-select: none;
		cursor: pointer;
		padding: 2px;
		font-size: 12px;
	}
	.custom-file-input:hover::before {
		border-color: black;
	}
	.custom-file-input:active::before {
		background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
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
	hr.style-eight {
		overflow: visible; /* For IE */
		padding: 0;
		border: none;
		border-top: medium double #333;
		color: #333;
		text-align: center;
	}
	hr.style-eight:after {
		content: "Datos Operador";
		display: inline-block;
		position: relative;
		top: -0.7em;
		font-size: 1.5em;
		padding: 0 0.25em;
		background: white;
	}

</style>

<div id="start_loading_registro_operador" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
</div>

<div class="container" id="showContentRegistroOperador" style="display: none">
	<div class="row">
		<div class="col-lg-12">
				<div id="target-1" class="widget">
		  				<div class="widget-content" style="background: #EDEDED">
							<form id="form_create_operador" class="form_create_operador_clase" >

								<hr class="style-eight">
								<div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="codigo">FRC <span style="color:red;">*</span></label>
					                <input type="text" name="rfc" id="rfcEdit" class="validate form-control margenes"  data-validate="required"  tabindex="1" onblur="validaRFC(this.value)" >
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="ap_pat">Apellido Paterno  <span style="color:red;">*</span></label>
					                <input type="text" name="ap_pat" id="ap_pat"  class="validate form-control margenes"  data-validate="required"  tabindex="2">
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
					                <label for="ap_mat">Apellido Materno  <span style="color:red;">*</span></label>
					                <input type="text" name="ap_mat" id="ap_mat" class="validate form-control margenes"  data-validate="required" tabindex="3">
						        </div>
								<div class="col-sm-2 col-md-2 col-lg-3" >
									<label for="nombre">Nombre  <span style="color:red;">*</span></label>
									<input type="text" name="nombre" id="nombreEdit" class="validate form-control margenes" data-validate="required" tabindex="4">
								</div>
						        <div class="col-sm-3 col-md-3 col-lg-3" >

					                <label style="width: 100%;" for="fecha_nacimiento">Fecha de Nacimiento  <span style="color:red;">*</span></label>

					                <select style="width: 30%; display: inline-block;" name="year_fecha" id="year_fecha_nacimientoEdit" class="validate form-control" data-validate="required" tabindex="5" onchange="validarYear(value);">
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
					                <select  style="width: 31%; display: inline-block;" class="validate form-control"  name="mes_fecha" id="mes_fecha_nacimientoEdit" data-validate="required"  >
					                	   <option class="" style="width: 10%" value="" selected disabled hidden>Mes</option>;
					                </select>
					                <select  style="width: 30%; display: inline-block;" class="validate form-control"  name="dia_fecha" id="dia_fecha_nacimientoEdit" data-validate="required" >
					                	<option class="" style="width: 10%" value="" selected disabled hidden>Día</option>
					                </select>
						        </div>

								<div class="col-sm-2 col-md-2 col-lg-3" >
									<label for="correo">Correo  <span style="color:red;">*</span></label>
									<input type="email" name="correo" id="correoID" class="validate form-control margenes" data-validate="required,emails"   tabindex="6">
								</div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
									<label for="nombre">Teléfono  <span style="color:red;">*</span></label>
									<input type="text" name="telefono" id="telefonoID" class="validate form-control margenes" data-validate="required"   tabindex="7">
						        </div>
						        <div class="col-sm-2 col-md-2 col-lg-3" >
									<label for="nombre">Colonia  </label>
									<input type="text" name="colonia" id="coloniaID" class="form-control margenes"  tabindex="8">
						        </div>
								<div class="col-sm-2 col-md-2 col-lg-3" >
									<label for="nombre">Domicilio  </label>
									<input type="text" name="domicilio" id="domicilioID" class="form-control margenes"  tabindex="9" placeholder="Nombre Calle, #Número de Casa">
						        </div>
								<div class="col-sm-2 col-md-2 col-lg-4" >
									<label for="cruzamientos">Cruzamientos </label>
									<input type="text" name="cruzamientos" id="cruzamientosID" class="form-control margenes" tabindex="10" placeholder="Calle1, Calle2">
						        </div>
								<div class="col-sm-2 col-md-2 col-lg-4" >
									<label class="color-input">Imágenes permitidas <span style="color: #8a1f11">jpg, png, jpeg </span> <strong>(campo Opcional)</strong>  </label>
									<input type="file" name="img_operador" class="custom-file-input" class="form-control margenes" tabindex="11" >
								</div>
						        <div class="col-sm-2 col-md-2 col-lg-3 pull-right button-cta" >
					                <button id="btn_cancelar_estudiante" type="button" class=" btn btn-default " data-style="expand-left"  onclick="cancelSaveOperador()">
					                	 Cancelar
					                </button>
					                <button style="background: #00BA8B; border: 0" id="btn_guardar_operador" type="submit" class=" ladda-button btn btn-primary" data-style="expand-left" tabindex="12" onclick="saveOperador()">
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
	
