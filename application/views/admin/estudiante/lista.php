
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

</style>
<div id="start_loading_lista_estudiante" class="container" style="text-align: center">
	<img src="<?php echo base_url('assets/img/loading.gif')?>">
</div>
 <div class="main-inner" id="content_lista_estudiante" style="display: none">
 	<div class="container " >
 		<div class="row">
 			<div class="col-lg-12">
    				<div class="ibox float-e-margins ">
    	                <div class="ibox-content ">
    	                    <div class="table-responsive widget-content ">
    	                        <table id="example" class="table table-striped table-bordered table-hover" >
    						        <thead>
    						            <tr>
    						                <th>Codigo Joven</th>
    						                <th>Nombre</th>
    						                <th>Paterno</th>
    						                <th>Materno</th>
    						                <th>CURP</th>
    						                <th>Fecha Nacimiento</th>
											<th>CORREO</th>
    						                <th>Lugar Nacimiento</th>
    						                <th>Lugar Recidencia</th>
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
    							                <td><label  id="fecha_nacimiento"><?php echo $estudiante->fecha_nacimiento?></label></td>
    							                <td><label  id="correo"><?php echo $estudiante->correo?></label></td>
    							                <td><label  id="lugar_nacimiento"><?php echo $estudiante->lugar_nacimiento?></label></td>
    							                <td><label  id="lugar_residencia"><?php echo $estudiante->lugar_residencia?></label></td>
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
                                                                 onclick="editEstudiante('<?php echo $estudiante->id_usuario ?>','<?php echo $estudiante->codigo_joven ?>','<?php echo $estudiante->nombre?>','<?php echo $estudiante->ap_pat?>','<?php echo $estudiante->ap_mat ?>', '<?php echo $estudiante->curp ?>','<?php echo $estudiante->fecha_nacimiento ?>','<?php echo $estudiante->lugar_nacimiento ?>', '<?php echo $estudiante->lugar_residencia ?>', '<?php echo $estudiante->correo ?>')"
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
 </div>


<!-- Modal -->
<div id="editarEstudiante" class="modal  fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form_edit_estudiante" class="form_edit_estudiante" method="post">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        <h4 id="myModalLabel" class="text-primary">Editar Estudiante</h4>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                            <input  type="hidden" id="idEditar" name="id">
                            <div class="col-sm-2 col-md-3 col-lg-3" >
                                <label for="codigo">Codigo Joven</label>
                                <input type="text" name="codigo" id="codigoEdit" class="form-control" tabindex="1" onblur="validarCJEditar(this.value)" >
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombreEdit"  class="form-control" tabindex="2">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="ape_pate">Apellido Paterno</label>
                                <input type="text" name="ape_pate" id="paternoEdit" class="form-control" tabindex="3">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="ape_mate">Apellido Materno</label>
                                <input type="text" name="ape_mate" id="maternoEdit" class="form-control" tabindex="4">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="curp">CURP</label>
                                <input type="text" name="curp" id="curpEdit" class="form-control" onblur="validarCurpEditar(this)" tabindex="5">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3" >
                                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                <input type="date" id="fecha_nacimientoEdit" class="form-control" name="fecha_nacimiento" tabindex="6">
                            </div>
							<div class="col-sm-3 col-md-3 col-lg-4" >
                                <label for="fecha_nacimiento">Correo</label>
                                <input type="text" id="correoEditar" class="form-control" name="correo" tabindex="7">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-4" >
                                <label for="lugar_nacimiento">Lugar Nacimiento</label>
                                <input type="text" name="lugar_nacimiento" class="form-control" id="lugar_nacimientoEdit"  tabindex="8">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-4" >
                                <label for="lugar_recidencia">Lugar Recidencia</label>
                                <input type="text" name="lugar_recidencia" class="form-control" id="lugar_recidenciaEdit" tabindex="9">
                            </div>

                    </div>
                </div>
                <div class="modal-footer">'
                    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" onclick="cancelarEditRegistro();" >Cancelar</button>
                    <button type="submit" id="btn_guardar_edit_estudiante"  class="ladda-button btn btn-primary" data-style="expand-left" tabindex="10" onclick="saveEditEstudiante()" >Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

