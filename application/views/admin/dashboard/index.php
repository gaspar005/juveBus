<style>
	.panel-info{
		display: none;
	}
</style>

<div class="container">

		<div id="start_loading" class="container" style="text-align: center">
			<img src="<?php echo base_url('assets/imgs/loading.gif')?>">
		</div>

		<div class="panel panel-info" id="showContentCardDia">
		<!-- se crea el cart para mostrar el total de Estudiantes que tomaron el camion  y el importe total de pasaje en pesos	-->
			<div id="loadEstadisticasDia" class="panel-heading text-center">
			</div>
			<div class="panel-body">
				<div id="big_stats" class="cf">
				</div>
			</div>
		</div>
	   <!-- Se crea el cart para desglosar el nombre de los operadores para conocer cual es el rendimiento de dia que tiene cada uno	-->
		<div class="panel panel-info" id="load_details_operador">
			<div class="panel-heading text-center" id="header_card_operador">

			</div>
			<br>
			<div class="panel-body" id="consten_table_operdador">

			</div>
		</div>
</div>

<!-- Large modal -->
<style>
	.modal-content{
		width: 900px;
		height: 568px; /* control height here */
	}
	.modal-header{
		border-radius: 5px;
	}
</style>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="showDiv">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="modal-content">
			<div class="modal-header btn-info">
				<button type="button" class="close" data-dismiss="modal" onclick="close_pdf()" aria-label="Close"><span aria-hidden="true" style="text-decoration-color: honeydew;"><strong>Salir</strong></span></button>
				<h4 class="modal-title">Corte del Dia</h4>
				<!--	AQUI SE CREA EL CONTENIDO DEL PDF	-->
			</div>
		</div>
	</div>
</div>








