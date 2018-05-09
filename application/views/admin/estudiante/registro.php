
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
	.margenes{
		margin-bottom: 20px;
	}
	.color-input{
		color: black;
	}
	/* Glyph, by Harry Roberts */

	hr.style-eight {
		overflow: visible; /* For IE */
		padding: 0;
		border: none;
		border-top: medium double #333;
		color: #333;
		text-align: center;
	}
	hr.style-eight:after {
		content: "Datos Estudiante";
		display: inline-block;
		position: relative;
		top: -0.7em;
		font-size: 1.5em;
		padding: 0 0.25em;
		background: white;
	}
	hr.domicilio {
		overflow: visible; /* For IE */
		padding: 0;
		border: none;
		border-top: medium double #333;
		color: #333;
		text-align: center;
	}
	hr.domicilio:after {
		content: "Domicilio Estudiante";
		display: inline-block;
		position: relative;
		top: -0.7em;
		font-size: 1.5em;
		padding: 0 0.25em;
		background: white;
	}
	hr.escolaridad {
		overflow: visible; /* For IE */
		padding: 0;
		border: none;
		border-top: medium double #333;
		color: #333;
		text-align: center;
	}
	hr.escolaridad:after {
		content: "Escolaridad Estudiante";
		display: inline-block;
		position: relative;
		top: -0.7em;
		font-size: 1.5em;
		padding: 0 0.25em;
		background: white;
	}
</style>

<div id="start_loading_registro" class="container" style="text-align: center; ">
	<img src="<?php echo base_url('assets/img/loading.gif')?>">
</div>

 <div class="main-inner" id="showContentRegistro" style="display: none; background-image: url(<?php echo base_url('assets/img/fondo_contenido.jpeg')?>); ">
	<div class="container"  >
	    <div class="row" >
	      	<div class="col-lg-12" >
	      			<div class="widget-content " style="background:rgba(189, 215, 219,0.5);" >
						<form id="form_crear_estudiante" class="form_create_estudiante" >
						<!--	<h4 style="text-align: center; color: dodgerblue;">Registro de Estudiante</h4>-->
							<hr class="style-eight">

							<div class="col-sm-2 col-md-2 col-lg-3 ">
				                <label for="codigo" class="color-input">Codigo Joven <span style="color: red;">*</span></label>
				                <input type="text" name="codigo" id="codigoID"  class=" validate form-control margenes" data-validate="required" tabindex="1" onblur="validarCJ(value)" >
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="ape_pate" class="color-input">Apellido Paterno <span style="color: red;">*</span> </label>
				                <input type="text" name="ape_pate" id="ape_pateID" class="validate form-control margenes"  data-validate="required" tabindex="2">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="ape_mate" class="color-input">Apellido Materno <span style="color: red;">*</span> </label>
				                <input type="text" name="ape_mate" id="ape_matID"  class="validate form-control margenes" data-validate="required" tabindex="3">
					        </div>
							<div class="col-sm-2 col-md-2 col-lg-3 " >
								<label for="nombre" class="color-input">Nombre(s) <span style="color: red;">*</span></label>
								<input type="text" name="nombre" id="nombreID" class="validate form-control margenes" data-validate="required" tabindex="4">
							</div>

							<div class="col-sm-2 col-md-2 col-lg-3 " >
								<label for="curp" class="color-input">CURP <span style="color: red;">*</span> </label>
								<input type="text" name="curp" id="curpID" class="validate form-control margenes" tabindex="5" data-validate="required" onblur="validarCurp(this)"">
							</div>

					        <div class="col-sm-2 col-md-2 col-lg-3"  >
				                <label for="fecha_nacimiento" class="color-input" style="width: 100%;">Fecha Nacimiento <span style="color: red;">*</span></label>
				                <select style="width: 32%; display: inline-block;" name="year_fecha" id="year_fecha_nacimientoEdit" class="validate form-control" tabindex="6" data-validate="required" onchange="validarYear(value);">
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

				                <select  style="width: 33%;display: inline-block;" name="mes_fecha" id="mes_fecha_nacimientoEdit" tabindex="7" class="validate form-control" data-validate="required">
				                	   <option class="" style="width: 10%" value="" selected disabled hidden>Mes</option>
				                </select>

				                <select  style="width: 32%; display: inline-block;" name="dia_fecha" id="dia_fecha_nacimientoEdit" class="validate form-control"  data-validate="required" tabindex="8"  >
				                	<option class="" style="width: 10%" value="" selected disabled hidden>Dia</option>			                	
				                </select>
					        </div>

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label class="color-input">Sexo <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="sexo" id="selectSexo" tabindex="9" data-validate="required">
									<option value=""  selected disabled hidden> seleccione </option>
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
									<option value="Otro">Otro</option>
									<option value="Prefiero no decir">Prefiero no decir</option>
								</select>
							</div>

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Correo <span style="color: red;">*</span></label>
								<input type="email" name="correo" class="validate form-control margenes" id="emailID" data-validate="required,emails" tabindex="10">
							</div>
							<br><br><br><br><br><br><br>
							<hr class="domicilio">

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Tel. Casa </label>
								<input type="text" name="tel_casa" class=" form-control margenes" id="telCasaEdit"  tabindex="11" maxlength="10">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Tel. Movil <span style="color: red;">*</span></label>
								<input type="text" name="tel_movil" class="validate form-control margenes" id="telMovilID" maxlength="10" onkeypress="return  isNumberKey(event)" data-validate="required" tabindex="12">
							</div>

					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="lugar_nacimiento" class="color-input">Lugar Nacimiento <span style="color: red;">*</span></label>
				                <input type="text" name="lugar_nacimiento" class="validate form-control margenes" id="lugar_nacimientoID" data-validate="required" tabindex="13">
					        </div>
					        <div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="localidad" class="color-input">Localidad <span style="color: red;">*</span></label>
				                <input type="text" name="localidad" id="localidadID" class="validate form-control margenes" data-validate="required" tabindex="14">
					        </div>

							<div class="col-sm-2 col-md-2 col-lg-3" >
				                <label for="id_municipio" class="color-input">Municipio <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="id_municipio" id="selectMunicipio" tabindex="15" data-validate="required" >
									<option value=""  selected disabled hidden> seleccione </option>
									<?php if ($municipios != null ): ?>
									    <?php foreach ($municipios as $minicipio):?>
											<option value="<?php echo $minicipio->id_municipio?>"><?php echo $minicipio->nombre?></option>
										<?php endforeach ?>
									<?php else: ?>
									<?php endif ?>
								</select>
					        </div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="colonia" class="color-input">Colonia</label>
								<input type="text" name="colonia" class=" form-control margenes" id="coloniaID"  tabindex="16" placeholder="Nombre Colonia">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="domicilio" class="color-input">Domicilio</label>
								<input type="text" name="domicilio" class=" form-control margenes" id="domicilioID"  tabindex="17" placeholder="nombre calle, #num casa">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="cruzamientos" class="color-input">Cruzamientos </label>
								<input type="text" name="cruzamientos" class=" form-control margenes" id="cruzamientosID"  tabindex="18" placeholder="calle1, calle2">
							</div>

							<br><br><br><br><br><br><br>
							<hr class="escolaridad">
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label class="color-input">Grado Estudio <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="id_grado_estudio" id="selectGradoEstudio" data-validate="required" tabindex="19" >
									<option value=""  selected disabled hidden> seleccione </option>
									<?php if ($grado_estudios != null ): ?>
										<?php foreach ($grado_estudios as $grado):?>
											<option value="<?php echo $grado->id_grado_estudio?>"><?php echo $grado->nombre?></option>
										<?php endforeach ?>
									<?php else: ?>
									<?php endif ?>
								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="escuela" class=" color-input">Escuela <span style="color: red;">*</span></label>
								<input type="text" name="escuela" class="validate form-control margenes" id="escuelaID" data-validate="required"  tabindex="20" placeholder="Nombre Escuela">
							</div>

							<div class="col-sm-2 col-md-2 col-lg-2" >
								<label for="lugar_nacimiento " class="color-input">Turno / Horario <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="turno_horario" id="turnoID" data-validate="required" tabindex="21" >
									<option value=""  selected disabled hidden> seleccione </option>
									<option value="Matitino">Matutino</option>
									<option value="Vespertino">Vespertino</option>
								</select>
							</div>

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lengua_indigena" class="color-input">¿Habla alguna lengua Indigena?</label>
								<input type="text" name="lengua_indigena" class="form-control margenes" id="lengua_indigenaID"  tabindex="22" placeholder="Ingrese Lengua indigena">
							</div>

					        <div class="col-sm-2 col-md-2 col-lg-4" >
				               <label class="color-input">Imagen permitidos <span style="color: #8a1f11">jpg, png, jpeg </span> <strong>(campo Opcional)</strong>  </label>
								<input type="file" name="img_estudiante" class="custom-file-input" class="form-control margenes" tabindex="23" >
					        </div>

					        <div class="col-sm-2 col-md-2 col-lg-3 pull-right button-cta" >
				                <button style="background:#A0A5A7;  border: 0" id="btn_cancelar_estudiante" type="button" class=" btn btn-default " data-style="expand-left"  onclick="cancelarRegistro()"  >
				                	 Cancelar
				                </button>
				                <button style="background: #2BBBAD; border: 0" id="btn_guardar_estudiante" type="submit" class="ladda-button btn btn-primary" data-style="expand-left" tabindex="24" onclick="saveEstudent()">
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




