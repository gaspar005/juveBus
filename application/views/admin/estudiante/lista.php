
<style>
	div.dataTables_wrapper {
        margin-bottom: 3em;
    }
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
    .html5buttons{
        display: none !important;
    }
    .dataTables_length{
        display: inline-block ;
    }

    @media (max-width: 1600px) {
      div.dataTables_filter {
       display: inline-block;
        position: absolute;
        right: 16em;
      }
    }
    .centrado {
        display: inline-block;
        padding: 1px 2px;
        width: 6em;
        margin: 2px;
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
	.margenes{
		margin-bottom: 20px;
	}


</style>
<div id="start_loading_lista_estudiante" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/img/loading.gif')?>">
</div>

 <div class="main-inner" id="content_lista_estudiante" style="display: none">
 	<div class="container" >
 		<div class="row">
 			<div class="col-lg-12">
				<div class="ibox float-e-margins ">
					<div class="ibox-content ">
						<div class="table-responsive widget-content ">
							<table id="estudianteListTable" class="table table-striped table-bordered table-hover" >
								<thead>
									<tr>
										<th>Codigo Joven</th>
										<th>Nombre</th>
										<th>Paterno</th>
										<th>Materno</th>
										<th>CURP</th>
										<th>Fecha Nacimiento</th>
										<th>Edad</th>
										<th>Sexo</th>
										<th>CORREO</th>
										<th>TEL. CASA</th>
										<th>TEL. MOVIL</th>
										<th>LUGAR NACIMIENTO</th>
										<th>LOCALIDAD</th>
										<th>MUNICIPIO</th>
										<th>COLONIA</th>
										<th>DOMICILIO</th>
										<th>CRUZAMIENTOS</th>
										<th>GRADO ESTUDIO</th>
										<th>ESCUELA</th>
										<th>TURNO / HORARIO</th>
										<th>LENGUA INDIGENA</th>
										<th  style="text-align: center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($estudiantes != null ):  ?>
										<?php foreach ($estudiantes as $estudiante): ?>
										<tr>
											<td><label  id="codigo_joven"><?php echo $estudiante->codigo_joven ?></label></td>
											<td><label  id="nombre"><?php echo $estudiante->nombre ?></label></td>
											<td><label  id="ap_pat"><?php echo $estudiante->ap_pat ?></label></td>
											<td><label  id="ap_mat"><?php echo $estudiante->ap_mat ?></label></td>
											<td><label  id="curp"><?php echo $estudiante->curp ?></label></td>
											<td><label  id="fecha_nacimiento"><?php echo $estudiante->fecha_nacimiento ?></label></td>
											<td><label  id="edad"><?php echo $estudiante->edad ?></label></td>
											<td><label  id="sexo"><?php echo $estudiante->sexo ?></label></td>
											<td><label  id="correo"><?php echo $estudiante->correo ?></label></td>
											<td><label  id="tel_casa"><?php echo $estudiante->tel_casa ?></label></td>
											<td><label  id="tel_celular"><?php echo $estudiante->tel_celular ?></label></td>
											<td><label  id="lugar_nacimiento"><?php echo $estudiante->lugar_nacimiento ?></label></td>
											<td><label  id="localidad"><?php echo $estudiante->localidad ?></label></td>
											<td><label  id="municipio"><?php echo $estudiante->municipio ?></label></td>
											<td><label  id="colonia"><?php echo $estudiante->colonia ?></label></td>
											<td><label  id="domicilio"><?php echo $estudiante->domicilio ?></label></td>
											<td><label  id="cruzamiento_domicilio"><?php echo $estudiante->cruzamiento_domicilio ?></label></td>
											<td><label  id="grado_estudio"><?php echo $estudiante->grado_estudio?></label></td>
											<td><label  id="escuela"><?php echo $estudiante->escuela ?></label></td>
											<td><label  id="turno_horario"><?php echo $estudiante->turno_horario ?></label></td>
											<td><label  id="lengua_indigena"><?php echo $estudiante->lengua_indigena ?></label></td>
											<td style="text-align: center">
												<?php if ($estudiante->status == 1): ?>
													<button type="button" class="btn btn-danger btn-rounded centrado"
															onclick="deshabilitarEstudiante('<?php echo $estudiante->id_usuario?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat?>')">
														<span class="fa fa-warning"></span> Deshabilitar
													</button>
												<?php else: ?>
													<button type="button" class="btn btn-success btn-rounded centrado"
															onclick="habilitarEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat?>')">
														<span class="fa fa-heart"></span> Habilitar
													</button>
												<?php endif ?>
												<button  type="button" class="btn btn-info btn-rounded centrado" data-backdrop="static" data-keyboard="false"
														 onclick="editEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->codigo_joven ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat ?>', '<?php echo $estudiante->curp ?>','<?php echo $estudiante->fecha_nacimiento ?>','<?php echo $estudiante->lugar_nacimiento ?>', '<?php echo $estudiante->correo ?>', '<?php echo $estudiante->sexo ?>', '<?php echo $estudiante->edad ?>', '<?php echo $estudiante->tel_casa ?>', '<?php echo $estudiante->tel_celular ?>', '<?php echo $estudiante->localidad ?>', '<?php echo $estudiante->municipio ?>', '<?php echo $estudiante->colonia ?>', '<?php echo $estudiante->domicilio ?>', '<?php echo $estudiante->cruzamiento_domicilio ?>', '<?php echo $estudiante->grado_estudio ?>', '<?php echo $estudiante->escuela ?>', '<?php echo $estudiante->turno_horario ?>', '<?php echo $estudiante->lengua_indigena ?>')"
														 data-toggle="modal" data-target="#editarEstudiante">
													<span class="glyphicon glyphicon-edit"></span> Editar
												</button>
											</td>
										</tr>
										<?php endforeach ?>
									<?php else: ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
 			</div>
 		</div>
 	</div>
 </div>

<!-- Modal -->
<div id="editarEstudiante" class="modal  fade " role="dialog" >
    <div class="modal-xs" >
        <div class="modal-content">
            <form id="form_edit_estudiante">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        <h4 id="myModalLabel" class="text-primary">Editar Estudiante</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
							<hr class="style-eight">
                            <input  type="hidden" id="idEditar" name="id">
                            <div class="col-sm-2 col-md-3 col-lg-3" >
                                <label for="codigo">Codigo Joven <span style="color: red;">*</span></label>
                                <input type="text" name="codigo" id="codigoEdit" class="validate form-control margenes" data-validate="required"  tabindex="1" onblur="validarCJEditar(this.value)" >
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="ape_pate">Apellido Paterno <span style="color: red;">*</span></label>
                                <input type="text" name="ape_pate" id="paternoEdit" class="validate form-control margenes" data-validate="required"  tabindex="2" >
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="ape_mate">Apellido Materno <span style="color: red;">*</span></label>
                                <input type="text" name="ape_mate" id="maternoEdit" class="validate form-control margenes" data-validate="required"  tabindex="3">
                            </div>
							<div class="col-sm-3 col-md-3 col-lg-3" >
								<label for="nombre">Nombre(s) <span style="color: red;">*</span></label>
								<input type="text" name="nombre" id="nombreEdit"  class="validate form-control margenes" data-validate="required"  tabindex="4">
							</div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="curp">CURP <span style="color: red;">*</span></label>
                                <input type="text" name="curp" id="curpEdit" class="validate form-control margenes" data-validate="required"  onblur="validarCurpEditar(this)" tabindex="5">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="fecha_nacimiento">Fecha Nacimiento <span style="color: red;">*</span></label>
                                <input type="date" id="fecha_nacimientoEdit" class="validate form-control" data-validate="required"  name="fecha_nacimiento" tabindex="6">
                            </div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label class="color-input">Sexo <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="sexo" id="selectSexoEdit" tabindex="7" data-validate="required">
								</select>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="fecha_nacimiento">Correo <span style="color: red;">*</span></label>
                                <input type="email" id="correoEditar" class="validate form-control margenes" name="correo" tabindex="8" data-validate="required,emails">
                            </div>

							<br><br><br><br><br><br><br>
							<hr class="domicilio">

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Tel. Casa </label>
								<input type="text" name="tel_casa" class=" form-control margenes" id="telCasaEditEdit" onkeypress="return  isNumberKey(event)" tabindex="9" maxlength="10">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Tel. Movil <span style="color: red;">*</span></label>
								<input type="text" name="tel_movil" class="validate form-control margenes" id="telMovilEdit" maxlength="10" data-validate="required" tabindex="10">
							</div>

							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lugar_nacimiento" class="color-input">Lugar Nacimiento <span style="color: red;">*</span></label>
								<input type="text" name="lugar_nacimiento" class="validate form-control margenes" id="lugar_nacimientoEdit" data-validate="required" tabindex="11">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="localidad" class="color-input">Localidad <span style="color: red;">*</span></label>
								<input type="text" name="localidad" id="localidadEdit" class="validate form-control margenes" data-validate="required" tabindex="12">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="id_municipio" class="color-input">Municipio <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="id_municipio" id="selectMunicipioEdit" tabindex="13" data-validate="required" >

								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="colonia" class="color-input">Colonia</label>
								<input type="text" name="colonia" class=" form-control margenes" id="coloniaEdit"  tabindex="14" placeholder="Nombre Colonia">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="domicilio" class="color-input">Domicilio</label>
								<input type="text" name="domicilio" class=" form-control margenes" id="domicilioEdit"  tabindex="15" placeholder="nombre calle, #num casa">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="cruzamientos" class="color-input">Cruzamientos </label>
								<input type="text" name="cruzamientos" class=" form-control margenes" id="cruzamientosEdit"  tabindex="16" placeholder="calle1, calle2">
							</div>

							<br><br><br><br><br><br><br>
							<hr class="escolaridad">
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label class="color-input">Grado Estudio <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="id_grado_estudio" id="selectGradoEstudioEdit" data-validate="required" tabindex="17" >
									<option value=""  selected disabled hidden> seleccione </option>
								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="escuela" class=" color-input">Escuela <span style="color: red;">*</span></label>
								<input type="text" name="escuela" class="validate form-control margenes" id="escuelaEdit" data-validate="required"  tabindex="18" placeholder="Nombre Escuela">
							</div>

							<div class="col-sm-2 col-md-2 col-lg-2" >
								<label for="lugar_nacimiento " class="color-input">Turno / Horario <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="turno_horario" id="turnoEdit" data-validate="required" tabindex="19" >
									<option value=""  selected disabled hidden> seleccione </option>
									<option value="Matitino">Matutino</option>
									<option value="Vespertino">Vespertino</option>
								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lengua_indigena" class="color-input">¿Habla alguna lengua Indigena?</label>
								<input type="text" name="lengua_indigena" class="form-control margenes" id="lengua_indigenaEdit"  tabindex="20" placeholder="Ingrese Lengua indigena">
							</div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" onclick="cancelarEditRegistro();" >Cancelar</button>
                    <button id="guarda_datos_editados" type="submit" class="ladda-button btn btn-primary" data-style="expand-left" tabindex="10" onclick="saveEditEstudiante()" >Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

