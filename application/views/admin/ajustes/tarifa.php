

<div class="container">
	<div id="start_loading_ajustes" class="container" style="text-align: center">
		<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
	</div>
	<section class="contenido" style="display: none" id="showContentAjustes">
			<hr>
				<div id="listaEmpleados" class="col-lg-8">
				</div>
				<div class="col-lg-4" id="showEditSettings" style="display: none">
					<div class="panel panel-default">
						<div class="panel-heading text-center "> <h4 class="text-primary">Editar Tarifa de Pasajes</h4> </div>
						<div class="panel-body">
							<form id="form-actualizar" class="form-horizontal" action="<?php echo base_url();?>empleados/actualizar" method="post" role="form" style="padding:0 10px;">
								<div class="form-group">
									<label>Concepto:</label>
									<input type="hidden" id="idS" name="id" value="">
									<input type="text" name="concepto" id="conceptoID" class="form-control">
								</div>
								<div class="form-group">
									<label>Importe:</label>
									<input type="text" name="tarifa" id="tarifaID" class="form-control" >
								</div>
								<div class="form-group">
									<button type="button" id="btncancelar" class="btn btn-default">Cancelar</button>
									<button type="button" id="btnactualizar" class="btn btn-success" style="background: #00BA8B; border: 0;">Guardar</button>
								</div>
							</form>

						</div>
					</div>
				</div>
	</section>
</div>
