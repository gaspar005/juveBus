
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
	  content: 'Seleccione una Imagen';
	  display: inline-block;
	  background: -webkit-linear-gradient(top,#e3e3e3,gray );
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
	.margenes{
		margin-bottom: 20px;
	}
</style>

<div id="start_loading_registro" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/img/loading.gif')?>">
</div>

 <div class="main-inner" id="showContentRegistro" style="display: none">
	<div class="container" >
	    <div class="row">	      	
	      	<div class="col-lg-12">
	      			<div class="widget-content" >
						<form id="form_crear_estudiante" class="form_create_estudiante" >
							<h4>Registro de Estudiante</h4>
							<hr class="colorgraph">

							<div class="col-sm-2 col-md-2 col-lg-3 ">
				                <label for="codigo">Codigo Joven</label>
				                <input type="text" name="codigo" id="codigoEdit"  class="form-control margenes"  tabindex="1" onblur="validarCJ(this.value)" >
					        </div>
							<div class="col-sm-2 col-md-2 col-lg-3 " >
				                <label for="nombre">Nombre</label>
				                <input type="text" name="nombre" id="nombreEdit" class="form-control margenes" tabindex="2">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="ape_pate">Apellido Paterno</label>
				                <input type="text" name="ape_pate" id="ape_pate" class="form-control margenes" tabindex="3">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="ape_mate">Apellido Materno</label>
				                <input type="text" name="ape_mate" id="ape_mateEdit"  class="form-control margenes" tabindex="4">
					        </div>

					        <div class="col-sm-3 col-md-3 col-lg-3" >
				                <label for="curp">CURP</label>
				                <input type="text" name="curp" id="curpEdit" class="form-control margenes" onblur="validarCurp(this)" tabindex="5">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >

				                <label for="fecha_nacimiento" style="width: 100%;">Fecha Nacimiento</label>

				                <select style="width: 32%; display: inline-block;" name="year_fecha" id="year_fecha_nacimientoEdit" class="form-control" onchange="validarYear(value);">
				                	<option class="" style="width: 10%" value="" selected disabled hidden>Año</option>
				                	<?php
										$current_year = date('Y');

										$range = range($current_year, $current_year-29 );
										$years = array_combine($range, $range);
									?>		
										<?php foreach ($years as $year) { ?>
											<option value="<?php echo $year?>"><?php echo $year?></option>
									<?php } ?>
				                </select>

				                <select  style="width: 33%;display: inline-block;" name="mes_fecha" id="mes_fecha_nacimientoEdit"  class="form-control" >
				                	   <option class="" style="width: 10%" value="" selected disabled hidden>Mes</option>;
				                													           			
				                </select>

				                <select  style="width: 32%; display: inline-block;" name="dia_fecha" id="dia_fecha_nacimientoEdit" class="form-control" >
				                	<option class="" style="width: 10%" value="" selected disabled hidden>Dia</option>			                	
				                </select>
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="lugar_nacimiento">Lugar Nacimiento</label>
				                <input type="text" name="lugar_nacimiento" class="form-control margenes" id="lugar_nacimientoEdit"  tabindex="7">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >						           				         
				                <label for="lugar_recidencia">Lugar Recidencia</label>
				                <input type="text" name="lugar_recidencia" id="lugar_recidenciaEdit" class="form-control margenes" tabindex="8">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				               <label >Imagen (Opcional)  </label> 
								<input type="file" name="img_estudiante" class="custom-file-input" class="form-control margenes" >
					        </div>

					        <div class="col-sm-2 col-md-2 col-lg-3 pull-right button-cta" >	  				         
				                <button id="btn_cancelar_estudiante" type="button" class=" btn btn-default " data-style="expand-left"  onclick="cancelarRegistro()">
				                	 Cancelar
				                </button>
				                <button id="btn_guardar_estudiante" type="submit" class=" ladda-button btn btn-primary" data-style="expand-left" tabindex="10" onclick="saveEstudent()">
				                	 Guardar
				                </button>
					        </div>
				           
						</form>
					</div> <!-- /widget-content -->
				</div>
      		</div> <!-- /span12 -->
		</div>
  	</div>
</div>
