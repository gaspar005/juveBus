<style>
	.error {
		color:red;
		position: flex;
	}
	.valid {
		color:green;
	}

</style>
<div id="start_loading" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
</div>

<div class="main-inner " id="showContent" style="display: none">
	<div class="container" >
		<div class="row">
			<div class="container">
				<div class="col-lg-3">
					<label for="">Seleccione tipo de Busqueda</label>
					<select name="" id="" class="form-control" onchange="tipo_busqueda_estudiante(this.value)">
						<option class="" selected disabled hidden>Tipo Busqueda </option>
						<option value="1">Codigo Joven</option>
						<option value="2">Nombre Y Apellidos</option>
					</select>
				</div>
				<div class="pull-right" >
					<a type='button' href="<?php echo base_url('rigistro-estudiante');?>" style="background: #3CB371 ;color: white; border: 0;" class="btn btn-primary pull-left" > <span style="color: green" class="glyphicon glyphicon-plus"></span> NUEVO ESTUDIANTE</a>
				</div>
			</div>
			<br>

			<div class="col-lg-12">
				<div class="ibox float-e-margins ">
	                <div class="ibox-content ">
						<div class="table-responsive widget-content ">
							<?php if ($this->session->userdata("busqueda_codigo_joven_saldo")) { ?>
								<div class="row" id="showContentCodigoJovenwithSession">
									<?php echo form_open('web/saldo_ctrl/busquedaCJ'); ?>
									<div class="col-md-12 col-lg-12" >
											<div class="col-lg-3">
												<?php echo form_input(["type" => "text", "name" => "codigo_joven", "class" => "form-control", "id"=> "id_codigo_joven_saldo", "placeholder" => "Ingrese Codigo Joven", "value" => $this->session->userdata("busqueda_codigo_joven_saldo")]); ?>
											</div>
											<div class="input-group-btn" >
												<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
											</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							<?php 	}else{ ?>
								<div class="row" id="showContentCodigoJovenWithoutSession" style="display: none">
									<?php echo form_open('web/saldo_ctrl/busquedaCJ'); ?>
									<div class="col-md-12 col-lg-12" >
										<div class="col-lg-3">
											<?php echo form_input(["type" => "text", "name" => "codigo_joven", "class" => "form-control", "id"=> "id_codigo_joven_saldo", "placeholder" => "Ingrese Codigo Joven"]); ?>
										</div>
										<div class="input-group-btn" >
											<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							<?php } ?>
							<?php if ($this->session->userdata("busqueda_nombre_saldo") && $this->session->userdata("busqueda_paterno_saldo")) { ?>
							<div class="row" id="showContentNombreApellidosConSession">
								<?php echo form_open('web/saldo_ctrl/busquedaNombreApe'); ?>
								<div class="col-md-12 col-lg-12" >
									<form id="validar_input">
										<div class="col-lg-3">
											<?php echo form_input(["type" => "text", "name" => "nombre", "class" => "form-control", "id"=> "id_nombre_saldo", "placeholder" => "Ingrese Nombre", "value" => $this->session->userdata("busqueda_nombre_saldo")]); ?>
										</div>
										<div class="col-lg-3">
											<?php echo form_input(["type" => "text", "name" => "paterno", "class" => "form-control", "id"=> "id_paterno_saldo", "placeholder" => "Ingrese Paterno", "value" => $this->session->userdata("busqueda_paterno_saldo")]); ?>
										</div>
										<div class="col-lg-3">
											<?php echo form_input(["type" => "text", "name" => "paterno", "class" => "form-control", "id"=> "id_paterno_saldo", "placeholder" => "Ingrese Paterno", "value" => $this->session->userdata("busqueda_materno_saldo")]); ?>
										</div>

										<div class="input-group-btn" >
											<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
										</div>
									</form>
								</div>
								<?php echo form_close(); ?>
							</div>
							<?php 	}else{ ?>

							<div class="row" id="showContentNombreApellidosSinSession" style="display: none">
								<?php echo form_open('web/saldo_ctrl/busquedaNombreApe'); ?>
								<div class="col-md-12 col-lg-12" >
									<div class="col-lg-3">
										<?php echo form_input(["type" => "text", "name" => "nombre", "class" => "form-control", "id"=> "id_nombre_saldo", "placeholder" => "Ingrese Nombre"]); ?>
									</div>
									<div class="col-lg-3">
										<?php echo form_input(["type" => "text", "name" => "paterno", "class" => "form-control", "id"=> "id_paterno_saldo", "placeholder" => "Ingrese Apellido Paterno"]); ?>
									</div>
									<div class="col-lg-3">
										<?php echo form_input(["type" => "text", "name" => "materno", "class" => "form-control", "id"=> "id_materno_saldo", "placeholder" => "Ingrese Apellido Materno"]); ?>
									</div>
									<div class="input-group-btn" >
										<?php echo form_button(["type" => "submit", "class" => "  btn btn-primary" ,"content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
							<?php } ?>
						    <br>

							<?php if ($estudiantes != null){?>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-info">
										<div class="panel-heading" >
											<p style="margin: 0; border: 0; text-align: center">Lista Resultado</p>
										</div>
										<div class="panel-body">

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
																<button data-toggle="modal" data-target="#recargarSaldoModal" type="button" onclick="showDataEstudiante('<?php echo $estudiante->id_usuario ?>', '<?php echo $estudiante->nombre ?>', '<?php echo $estudiante->ap_pat ?>', '<?php echo $estudiante->ap_mat ?>', '<?php echo $estudiante->codigo_joven ?>', '<?php echo $estudiante->saldo ?>')" class="col-gl-9 btn btn-primary text-center">Recargar</button>
															</td>
														</tr>
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
							<?php }else{ ?>
								<h1>Ingrese los datos Correctamente, Gracias</h1>
							<?php } ?>

					    </div>
	                </div>
	            </div>    		
	        </div>    
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="recargarSaldoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form role="form" id="form_alta_saldo">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Registro de recarga de Saldo</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="idEditar" value="">
					<div class="row">
						<div class="col-lg-3" id="jovenEstu">
						</div>
						<div class="col-lg-3" id="nombreEstu">
						</div>
						<div class="col-lg-3" id="paternoEstu">
						</div>
						<div class="col-lg-3" id="maternoEstu">
						</div>
						<!-- -->
						<div class="col-lg-12 col-sm-6 col-md-6 text-center">
							<div class="col-lg-3"></div>
							<div class="col-lg-3">
								<label for="saldo" style="display: block">Ingrese Saldo</label>
								<input value="4" min="1" pattern="^[0-9]+" type="number" name="saldo" id="saldoRecarga" class="form-control saldo_input_fload col-lg-1" tabindex="1" style="display: inline-block; text-align: right">
							</div>
							<div class="col-lg-2" id="switchButtonAgregar_and_Editar">
							</div>
						</div>

						<div class="col-lg-3" id="saldo_anterior">
						</div>
						<div class="col-lg-3" id="saldo_ingresado" style="display: none">
						</div>
						<div class="col-lg-3" id="saldo_total" style="display: none">
						</div>
						<div class="col-lg-3" id="switchCancelarSaldoAgregado" style="display: none">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelarAltaSaldo()">Cancelar</button>
					<button id="ladda_btn_alta_saldo" type="submit" class="ladda-button btn btn-primary custom-close" tabindex="3" data-style="expand-left" onclick="saveAltaSaldo()">Alta Saldo</button>
				</div>
			</div>
		</form>
	</div>
</div>
