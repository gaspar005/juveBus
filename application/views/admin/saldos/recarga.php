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
				<div class="pull-right">
					<a type='button' href="<?php echo base_url('rigistro-estudiante');?>" style="background: #3CB371 ;color: white; border: 0;" class="btn btn-primary pull-left" > <span style="color: green" class="glyphicon glyphicon-plus"></span> NUEVO ESTUDIANTE</a>
				</div>
			</div>
			<br>
			<div class="col-lg-12">
				<div class="ibox float-e-margins ">
	                <div class="ibox-content ">
						<div class="table-responsive widget-content ">
							<div class="row">
								<div class="col-md-12 col-lg-12" >
									<form id="validar_input">
										<div class="col-lg-3">
											<input type="text" id="nombreSearch" name="nombre" placeholder="Ingrese Nombres" class="form-control">
										</div>
										<div class="col-lg-3">
											<input type="text" id="ape_pate" placeholder="Ingrese Apellido Paterno" name="ap_pat" class="form-control">
										</div>
										<div class="col-lg-3">
											<input type="text" id="ape_mate" placeholder="Ingrese Apellido Materno" name="ap_mat" class="form-control">
										</div>
										<div class="col-lg-3  pull-left" >
											<button  id="btn_landa_buscar" type='button' data-style="expand-left" class="ladda-button btn btn-primary "  onclick="buscaEstudiante()">Buscar</button>
										</div>
									</form>
								</div>
							</div>
						    <br>
							<div class="panel panel-primary" id="showNoneTable" style="display: none">
					          	<div class="panel-heading text-center"  style="font-family: Arial; font-size: 14px; padding: 0">ESTUDIANTES ENCONTRADOS</div>
					            <p class="text-center">
					              <strong>Mostrar: </strong>
					              <select name="cantidad" id="cantidad">
					                <option value="7">7</option>
					              </select>
					            </p>
					            <table id="tbclientes" class="table table-bordered">
					              <thead>
					                <tr>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">CODIGO JOVEN</th>
					                  <th class="text-center" style="font-family: Arial; background-color: #bfbfbf; ">NOMBRE</th>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">PATERNO</th>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;"> MATERNO</th>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">CURP</th>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf; font-size: 12px">FECHA NACIMIENTO</th>
									  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf; font-size: 12px">SALDO</th>
					                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">ACCIÓN</th>
					                </tr>
					              </thead>
					              <tbody>
					              </tbody>
					            </table>
					            <div class="text-center paginacion" >

					            </div>
					        </div>
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
