<div class="main-inner ">
	<div class="container" >
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins ">
	                <div class="ibox-content ">
	                    <div class="table-responsive widget-content ">
						
							<div class="row">
						     
					            <div class="col-md-12 col-lg-12" >
					            
						          	<div class="col-lg-3">
						          		<input type="text" id="nombreSearch" name="nombre" placeholder="Ingrese Nombres" class="form-control">
						          	</div>					          	
									<div class="col-lg-3">
										<input type="text" id="ape_pate" placeholder="Ingrese Apellido Paterno" name="ap_pat" class="form-control">
									</div>					          
						          	<div class="col-lg-3">
						          		<input type="text" id="ape_mate" placeholder="Ingrese Apellido Materno" name="ap_mat" class="form-control">
						          	</div>
						          	<button type='button' class="btn btn-primary" onclick="buscaEstudiante()">Buscar</button>
						          	<a type='button' href="<?php echo base_url('rigistro-estudiante');?>" style="background: #3CB371 ;color: white; border: 0" class="btn btn-primary" > <span style="color: green" class="glyphicon glyphicon-plus"></span> NUEVO ESTUDIANTE</a>
					            </div>
					          
					          <!-- <div class="col-xs-6 col-md-4" style="background: red">         
					            <input type="text" class="form-control" id="searchTerm" name="busqueda" placeholder="BUSCAR ESTUDIANTE POR CODIGO JOVEN">
					          </div> -->
						    </div>
						    <br>

							<div class="panel panel-primary">
					          	<div class="panel-heading text-center"  style="font-family: Arial; font-size: 14px; padding: 0">LISTA DE ESTUDIANTES</div>					          	
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

		