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
	.hear-th-table {
		font-family: Arial;
		background-color: #bfbfbf;
	}
	table {
		padding: .5em 0;
	}
	@media screen and (max-width: 767px) {
		table {
			border-bottom: 1px solid #ddd;
		}
	}
	p {
		color: #0066cc;
	}
</style>
 <div id="start_loading_lista_estudiante" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
 </div>
 <div id="content_lista_estudiante" style="display: none">
 	<div class="container" >
 		<div class="row">
 			<div class="col-xs-12">
				<div class="ibox float-e-margins">
					<div class="ibox-content ">
						<div class=" widget-content" >
							<div class="col-md-2">
								<a href="<?php echo base_url('rigistro-estudiante')?>" class="btn btn-primary"> <span class="icon-plus"></span> Agregar Estudiante</a>
							</div>
							<div class="col-md-2">
								<div style=" width: 100%">
									<select name="select_option" id="option_search" class="form-control" onchange="tipo_busqueda(this.value)" >
										<option class="" selected disabled hidden>Buscar </option>
										<option value="1">Codigo Joven</option>
										<option value="2">Nombre y Apellido</option>
									</select>
								</div>
							</div>
							<?php if ($this->session->userdata("busqueda_codigo_joven")) { ?>
							<div class="col-md-3"  id="showWithSessionCJ" >
									<?php echo form_open('web/Estudiantes_ctrl/busqueda'); ?>
									<div class="input-group">
										<div class="col-md-12" style="display: inline-block" >
											<?php echo form_input(["type" => "text", "name" => "busqueda", "class" => "form-control", "id"=> "id_codigo_joven", "placeholder" => "Ingrese Codigo Joven", "value" => $this->session->userdata("busqueda_codigo_joven")]); ?>
										</div>
										<span class="input-group-btn" >
											<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
										</span>
									</div>
									<?php echo form_close(); ?>
							</div>
							<?php 	}else{ ?>
									<div class="col-md-3"  id="showWithoutSessionCJ" style="display: none"  >
										<?php echo form_open('web/Estudiantes_ctrl/busqueda'); ?>
										<div class="input-group">
											<?php	echo form_input(["type" => "text", "name" => "busqueda", "class" => "form-control", "placeholder" => "Ingrese Codigo Joven", "id"=> "id_codigo_joven"]); ?>
											<span class="input-group-btn" >
											<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
											</span>
										</div>
									</div>
								<?php echo form_close(); ?>
							<?php } ?>
							<?php if ($this->session->userdata("nombre_busqueda") && $this->session->userdata("paterno_busqueda")) { ?>
							<div class="col-md-5 "  id="showWithSession" >
								<?php echo form_open('web/Estudiantes_ctrl/busqueda_nombres'); ?>
								<div class="input-group">
									<div class="col-md-6" >
									<?php echo form_input(["type" => "text", "name" => "nombre", "class" => "form-control", "id"=> "id_nombre", "placeholder" => "Ingrese Nombre", "value" => $this->session->userdata("nombre_busqueda")]); ?>
									</div>
									<div class="col-md-6"  >
									<?php echo form_input(["type" => "text", "name" => "paterno", "class" => "form-control", "id"=> "id_apellidos", "placeholder" => "Apellido Paterno", "value" => $this->session->userdata("paterno_busqueda")]); ?>
									</div>
									<span class="input-group-btn" >
									   <?php echo form_button(["type" => "submit", "class" => "btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
									</span>
								</div>
								<?php echo form_close(); ?>
							</div>
							<?php } else{ ?>
							<div class="col-md-5 "  id="showWithoutession" style=" display: none">
								<?php echo form_open('web/Estudiantes_ctrl/busqueda_nombres'); ?>
								<div class="input-group">
										<div class="col-lg-6">
											<?php echo form_input(["type" => "text", "name" => "nombre", "class" => "form-control ", "placeholder" => "Ingrese Nombre", "id"=> "id_nombre"]); ?>
										</div>
										<div class="col-lg-6">
											<?php echo form_input(["type" => "text", "name" => "paterno", "class" => "form-control ", "placeholder" => "Apellido Paterno", "id"=> "id_apellidos"]);?>
										</div>
										<span class="input-group-btn">
										   <?php echo form_button(["type" => "submit", "class" => "btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
										</span>
								</div>
								<?php echo form_close(); ?>
							</div>
							<?php } ?>

							<div class="col-md-2 pull-right" >
								<?php echo form_open('web/Estudiantes_ctrl/mostrar');?>
								<?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-info btn-block'");?>
								<?php echo form_close(); ?>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading" >
										<p style="margin: 0; border: 0; text-align: center">Lista de Estudiantes</p>
									</div>
									<div class="panel-body">
										<?php
										$options = array(
											'5'  => '5',
											'10'    => '10'
										);
										$selected = "5";
										if ($this->session->userdata("cantidad")) {
											$selected = $this->session->userdata("cantidad");
										}
										$js = array(
											'id'       => 'my_id'
										);
										?>
										<p style="color: #000;"><strong>Mostrar :<?php  echo form_dropdown('cantidad', $options,$selected, $js)?> Estudiantes  </strong></p>
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>Codigo Joven</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Sexo</th>
													<th>Edad</th>
													<th>Saldo</th>
													<th>CURP</th>
													<th>Correo</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>

											<?php if ($estudiantes != null){?>
												<?php foreach ($estudiantes as $estudiante) { ?>
													<tr>
														<td><?php echo $estudiante->codigo_joven;?></td>
														<td><?php echo $estudiante->nombre;?></td>
														<td><?php echo $estudiante->ap_pat." ".$estudiante->ap_mat;?></td>
														<td><?php echo $estudiante->sexo;?></td>
														<td><?php echo $estudiante->edad;?></td>
														<td>$ <?php echo $estudiante->saldo." Pesos";?></td>
														<td><?php echo $estudiante->curp;?></td>
														<td><?php echo $estudiante->correo;?></td>
														<td style="text-align: center">
															<button  type="button" class="btn btn-info btn-rounded" data-backdrop="static" data-keyboard="false"
																	 onclick="showDetailEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->codigo_joven ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat ?>', '<?php echo $estudiante->curp ?>','<?php echo $estudiante->fecha_nacimiento ?>','<?php echo $estudiante->lugar_nacimiento ?>', '<?php echo $estudiante->correo ?>', '<?php echo $estudiante->sexo ?>', '<?php echo $estudiante->edad ?>', '<?php echo $estudiante->tel_casa ?>', '<?php echo $estudiante->tel_celular ?>', '<?php echo $estudiante->localidad ?>', '<?php echo $estudiante->municipio ?>', '<?php echo $estudiante->colonia ?>', '<?php echo $estudiante->domicilio ?>', '<?php echo $estudiante->cruzamiento_domicilio ?>', '<?php echo $estudiante->grado_estudio ?>', '<?php echo $estudiante->escuela ?>', '<?php echo $estudiante->turno_horario ?>', '<?php echo $estudiante->lengua_indigena ?>')"
																	 data-toggle="modal" data-target="#showInfoEstudiante">
																<span class=" icon-eye-open"></span>
															</button>
															<button  type="button" class="btn btn-warning btn-rounded" data-backdrop="static" data-keyboard="false"
																	 onclick="editEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->codigo_joven ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat ?>', '<?php echo $estudiante->curp ?>','<?php echo $estudiante->fecha_nacimiento ?>','<?php echo $estudiante->lugar_nacimiento ?>', '<?php echo $estudiante->correo ?>', '<?php echo $estudiante->sexo ?>', '<?php echo $estudiante->edad ?>', '<?php echo $estudiante->tel_casa ?>', '<?php echo $estudiante->tel_celular ?>', '<?php echo $estudiante->localidad ?>', '<?php echo $estudiante->municipio ?>', '<?php echo $estudiante->colonia ?>', '<?php echo $estudiante->domicilio ?>', '<?php echo $estudiante->cruzamiento_domicilio ?>', '<?php echo $estudiante->grado_estudio ?>', '<?php echo $estudiante->escuela ?>', '<?php echo $estudiante->turno_horario ?>', '<?php echo $estudiante->lengua_indigena ?>')"
																	 data-toggle="modal" data-target="#editarEstudiante">
																<span class="glyphicon glyphicon-edit"></span>
															</button>
															<?php if ($estudiante->status == 1): ?>
																<button type="button" class="btn btn-danger btn-rounded "
																		onclick="deshabilitarEstudiante('<?php echo $estudiante->id_usuario?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat?>')">
																	<span class=" icon-remove-sign"></span>
																</button>
															<?php else: ?>
																<button type="button" class="btn btn-success btn-rounded "
																		onclick="habilitarEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat?>')">
																	<span class=" icon-heart"></span>
																</button>
															<?php endif ?>

														</td>
													</tr>
												<?php } ?>
											<?php }else{ ?>
												<h3 style="color: red;" class="text-center">No hay resultados, ingrese los datos correctamente :( </h3>
											<?php } ?>
											</tbody>
										</table>
										<div class="text-center">
											<?php echo $this->pagination->create_links(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
 			</div>
 		</div>
 	</div>
 </div>

<!-- Modal mostrar informacion del estidiante-->
<div id="showInfoEstudiante" class="modal fade " role="dialog" >
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<form id="form_detail_estudiante">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >Salir</button>
					<h4 style="border: 0; margin: 0" id="myModalLabel" class="text-primary">Informacion Completa del Estudiante </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<hr class="style-eight">
						<input  type="hidden" id="idShow" >
						<div class="col-sm-2 col-md-3 col-lg-3" >
							<label for="codigo">Código Joven </label>
							<p id="codigoShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="ape_pate">Apellido Paterno </label>
							<p id="paternoShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="ape_mate">Apellido Materno </label>
							<p id="maternoShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="nombre">Nombre(s) </label>
							<p id="nombreShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="curp">CURP </label>
							<p id="curpShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="fecha_nacimiento">Fecha de Nacimiento </label>
							<p id="fecha_nacimientoShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label class="color-input">Sexo </label>
							<p id="selectSexoShow"></p>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3" >
							<label for="fecha_nacimiento">Correo </label>
							<p id="correoShow"></p>
						</div>

						<br><br><br><br><br><br><br>
						<hr class="domicilio">

						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="lugar_nacimiento" class="color-input">Tel. Casa </label>
							<p id="telCasaShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="lugar_nacimiento" class="color-input">Tel. Movil </label>
							<p id="telMovilShow"></p>
						</div>

						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="lugar_nacimiento" class="color-input">Lugar de Nacimiento </label>
							<p id="lugar_nacimientoShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="localidad" class="color-input">Localidad </label>
							<p id="localidadShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="id_municipio" class="color-input">Municipio </label>
							<p id="municipioShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="colonia" class="color-input">Colonia</label>
							<p id="coloniaShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="domicilio" class="color-input">Domicilio</label>
							<p id="domicilioShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="cruzamientos" class="color-input">Cruzamientos </label>
							<p id="cruzamientosShow"></p>
						</div>

						<br><br><br><br><br><br><br>
						<hr class="escolaridad">
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label class="color-input">Grado de Estudio </label>
							<p id="grado_estudioShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="escuela" class=" color-input">Escuela </label>
							<p id="escuelaShow"></p>
						</div>

						<div class="col-sm-2 col-md-2 col-lg-2" >
							<label for="lugar_nacimiento " class="color-input">Turno / Horario </label>
							<p id="turno_horarioShow"></p>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-3" >
							<label for="lengua_indigena" class="color-input">lengua Indígena</label>
							<p id="lengua_indigenaShow"></p>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal editar estudiante-->
<div id="editarEstudiante" class="modal  fade " role="dialog" >
    <div class="modal-xs" >
        <div class="modal-content">
            <form id="form_edit_estudiante" method="POST">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        <h4 id="myModalLabel" class="text-primary">Editar Estudiante</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
							<hr class="style-eight">
                            <input  type="hidden" id="idEditar" name="id">
                            <div class="col-sm-2 col-md-3 col-lg-3" >
                                <label for="codigo">Código Joven <span style="color: red;">*</span></label>
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
                                <label for="fecha_nacimiento">Fecha de Nacimiento <span style="color: red;">*</span></label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimientoEdit" class="validate form-control" data-validate="required" tabindex="6">
                            </div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label class="color-input">Sexo <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="sexo" id="selectSexoEdit" tabindex="7" data-validate="required">
								</select>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="fecha_nacimiento">Correo <span style="color: red;">*</span></label>
                                <input type="email"  name="correo" id="correoEditar" class="validate form-control margenes" tabindex="8" data-validate="required,emails">
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
								<label for="lugar_nacimiento" class="color-input">Lugar de Nacimiento <span style="color: red;">*</span></label>
								<input type="text" name="lugar_nacimiento" class="validate form-control margenes" id="lugar_nacimientoEdit" data-validate="required" tabindex="11">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="localidad" class="color-input">Localidad <span style="color: red;">*</span></label>
								<input type="text" name="localidad" id="localidadEdit" class="validate form-control margenes" data-validate="required" tabindex="12">
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="id_municipio" class="color-input">Municipio <span style="color: red;">*</span></label>
								<select  name="id_municipio" class="validate form-control margenes" id="selectMunicipioEdit" tabindex="13" data-validate="required" >
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
								<label class="color-input">Grado de Estudio <span style="color: red;">*</span></label>
								<select class="validate form-control margenes" name="id_grado_estudio" id="selectGradoEstudioEdit" data-validate="required" tabindex="17" >
								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="escuela" class=" color-input">Escuela <span style="color: red;">*</span></label>
								<input type="text" name="escuela" class="validate form-control margenes" id="escuelaEdit" data-validate="required"  tabindex="18" placeholder="Nombre Escuela">
							</div>

							<div class="col-sm-2 col-md-2 col-lg-2" >
								<label for="lugar_nacimiento " class="color-input">Turno / Horario <span style="color: red;">*</span></label>
								<select name="turno_horario" class="validate form-control margenes" id="turnoEdit" data-validate="required" tabindex="19" >
								</select>
							</div>
							<div class="col-sm-2 col-md-2 col-lg-3" >
								<label for="lengua_indigena" class="color-input">¿Habla alguna lengua Indígena?</label>
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


