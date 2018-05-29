<style type='text/css'>

	.tabla-color tr:nth-child(odd) {
		background-color:#f2f2f2;
	}
	.tabla-color tr:nth-child(even) {
		background-color:#fbfbfb;
	}

	.margen-arriba{
		margin-top: 25px;
	}

</style>
<!-- ************************************************************************ -->
<!-- DATOS DEL EMPLEADO -->
<!-- ************************************************************************ -->
<table  class="tabla-color margen-arriba" id="" style="font-size: 15px; margin-top:40px" width="100%">
	<thead>
		<tr>
			<th COLSPAN="3" class="text-center text-success" style="font-size: 15px; color: #0a6aa1">Detalles Corte del dia <?php echo $datosCorte['fecha'] ?> </th>
		</tr>
		<tr class="warning">
			<th style="font-size: 15px; text-align: center"> <small> RFC: </small>    <?php echo $datosOperador[0]->rfc; ?></th>
			<th style="font-size: 15px; text-align: right">  <small> Nombre:  </small> <?php echo $datosOperador[0]->nombre;echo " ";	echo $datosOperador[0]->ap_pat;echo " ";echo $datosOperador[0]->ap_mat;?></th>
		</tr>
	</thead>
	<tbody id="">

	</tbody>
</table>
<!-- ************************************************************************ -->
<!-- PERCEPCIONES-->
<!-- ************************************************************************ -->

<table class="tabla-color margen-arriba" id="" style="font-size: 15px; margin-top:40px" width="100%">
	<thead>
	<tr>
		<th COLSPAN="3" class="text-center text-success" style="font-size: 15px; color: #0a6aa1">Detalles del Corte </th>
	</tr>
	<tr class="warning">
		<th style="font-size: 15px; text-align: center">Cantidad de Estudiantes</th>
		<th style="font-size: 15px; text-align: center">Trifa Pasaje</th>
		<th style="font-size: 15px; text-align: right">Total Ganancia</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td style="text-align: center"> <?php echo $datosCorte['pasajeros']." "; ?>Estudiantes </td>
		<td style="text-align: center"> $ <?php echo number_format($datosCorte['tarifa'],2)." "; ?> Pesos </td>
		<td style="text-align: right"> $ <?php echo number_format( $datosCorte['ganancias'],2)." "; ?> Pesos </td>
	</tr>
	</tbody>
</table>

<!-- ************************************************************************ -->
<!-- Imprimir Líquido -->
<!-- ************************************************************************ -->

<table width="100%" class="margen-arriba">
	<tr>
		<td width="70%"></td>
		<td width="15%" class="text-left warning" style="font-size: 15px ;" >Saldo Total:</td>
		<td width="15%" class="text-right ">$<?php echo number_format( $datosCorte['ganancias'],2)." "; ?> Pesos</td>
	</tr>
</table>
