
<style>
	.error {
        color:red;
        position: flex;
    }
    .valid {
        color:green;
    }

    .html5buttons{
        display: none;
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
	.margenes{
		margin-bottom: 20px;
	}
</style>
<div id="start_loading_lista_operador" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
</div>
<div class="main-inner " id="showContentListaOperadores" style="display: none">
	<div class="container" >
		<div class="row">
			<div class="col-lg-12">
					<div class="ibox float-e-margins ">
    	                <div class="ibox-content ">
    	                    <div class="table-responsive widget-content ">
    	                        <table id="operadorTable" class="table table-striped table-bordered table-hover" >
    						        <thead>
    						            <tr>
											<th>RFC</th>
    						                <th>Nombre</th>
    						                <th>Apellidos</th>
											<th>Fecha Nacimiento</th>
											<th>TELÉFONO</th>
											<th>COLONIA</th>
											<th>DOMICILIO</th>
											<th>CRUZAMIENTOS</th>
    						                <th  style="text-align: center">Acciones</th>
    						            </tr>
    						        </thead>
    						        <tbody>
    						            <?php if ($operadores != null ):  ?>
                                    		<?php foreach ($operadores as $operador): ?>
    						            	<tr>
												<td><label  id="rfc"><?php echo $operador->rfc ?></label></td>
    							                <td><label  id="nombre"><?php echo $operador->nombre ?></label></td>
    							                <td><label  id="ap_pat"><?php echo $operador->ap_pat." ".$operador->ap_mat ?></label></td>
    							                <td><label  id="fecha_nacimiento"><?php echo $operador->fecha_nacimiento ?></label></td>
    							                <td><label  id="telefono"><?php echo $operador->telefono ?></label></td>
    							                <td><label  id="colonia"><?php echo $operador->colonia ?></label></td>
    							                <td><label  id="domicilio"><?php echo $operador->domicilio ?></label></td>
    							                <td><label  id="cruzamientos"><?php echo $operador->cruzamientos ?></label></td>
    							                <td style="text-align: center">
    							                	<?php if ($operador->status == 1): ?>
    	                                            	<button type="button" class="btn btn-danger btn-rounded centrado"
                                                                onclick="deshabilitarOperador('<?php echo $operador->id_operador?>','<?php echo $operador->nombre?>','<?php echo $operador->ap_pat?>','<?php echo $operador->ap_mat?>')">
                                                            <span class="fa fa-warning"></span> Deshabilitar
                                                        </button>
    	                                            <?php else: ?>
    	                                                <button type="button" class="btn btn-success btn-rounded centrado"
                                                                onclick="habilitarOperador('<?php echo $operador->id_operador ?>','<?php echo $operador->nombre?>','<?php echo $operador->ap_pat?>','<?php echo $operador->ap_mat?>')">
                                                            <span class="fa fa-heart"></span> Habilitar
                                                        </button>
    	                                            <?php endif ?>
    	                                            	<button  type="button" class="btn btn-info btn-rounded centrado" data-backdrop="static" data-keyboard="false"
                                                                 onclick="editOperador('<?php echo $operador->id_operador ?>','<?php echo $operador->nombre?>','<?php echo $operador->ap_pat?>','<?php echo $operador->ap_mat ?>', '<?php echo $operador->rfc ?>','<?php echo $operador->fecha_nacimiento ?>','<?php echo $operador->telefono ?>','<?php echo $operador->colonia ?>','<?php echo $operador->domicilio ?>','<?php echo $operador->cruzamientos ?>')"
                                                                 data-toggle="modal" data-target="#editaroperador">
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


<div class="modal fade" id="editaroperador" role="dialog">
    <div class="modal-dialog modal-lg">
     <form role="form" id="form_edit_operdor">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-primary">Editar Operador</h4>
        </div>
        <div class="modal-body">        
                <input type="hidden" name="id" id="idEditar" value="">
                <div class="row">
						<div class="col-sm-3 col-md-3">
							<label for="rfc">RFC <span style="color:red;">*</span> </label>
							<input type="text" name="rfc" id="rfcEdit" class="validate form-control margenes" tabindex="1" data-validate="required">
						</div>
						<div class="col-sm-3 col-md-3">
                            <label for="ap_pat">Apellido Paterno <span style="color:red;">*</span></label>
                            <input type="text" name="ap_pat" id="ap_patEdit" class="validate form-control margenes" tabindex="2" data-validate="required">
                        </div>
						<div class="col-sm-3 col-md-3">
							<label for="ap_mat">Apelldio Materno <span style="color:red;">*</span></label>
							<input type="text" name="ap_mat" id="ap_matEdit" class="validate form-control margenes " tabindex="3" data-validate="required">
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="num_plaza">Nombre <span style="color:red;">*</span> </label>
							<input type="text" name="nombre" id="nombreEdit" class="validate form-control margenes" tabindex="4" data-validate="required">
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="fecha_nacimientoe">Fecha Nacimiento <span style="color:red;">*</span></label>
							<input type="date" name="fecha_nacimiento" id="fecha_nacimeintoEdit" class="validate form-control margenes" tabindex="5" data-validate="required">
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="telefonoEdit">Teléfono <span style="color:red;">*</span></label>
							<input type="text" name="telefono" id="telefonoEdit" class="validate form-control margenes" tabindex="6" data-validate="required">
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="colonia">Colonia </label>
							<input type="text" name="colonia" id="coloniaEdit" class="form-control margenes" tabindex="7">
						</div>
						<div class="col-sm-3 col-md-3">
							<label for="domicilio">Domicilio</label>
							<input type="text" name="domicilio" id="dimicilioEdit" class="form-control margenes" tabindex="8">
						</div>
						<div class="col-sm-3 col-md-5">
							<label for="cruzamientos">Cruzamientos</label>
							<input type="text" name="cruzamientos" id="cruzmaientosEdit" class="form-control margenes" tabindex="9">
						</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelEditOperador()">Cancelar</button>
            <button type="submit" id="btn_save_edit_operador" class="ladda-button btn btn-primary" data-style="expand-left" tabindex="10" onclick="saveEditOperador()">Guardar Cambios</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
