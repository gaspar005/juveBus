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
<h5 class="text-info text-center" style="text-align: center; color: #0a6aa1">Datos del Beneficiario</h5>
<table  class="table table-striped txt-header-pdf " style="margin: 0; border: 0; font-size: 12px;">
	<tbody id="">
	<tr>
		<td width="20%"> Codigo Joven: </td>
		<td width="33%" style="font:bold 12px"> <?php echo $datosActuales_Saldo[0]->codigo_joven; ?> </td>
		<td width="15%" > Nombre:  </td>
		<td width="35%" style="font:bold 12px">
			<?php
				echo $datosActuales_Saldo[0]->nombre;
				echo " ";
				echo $datosActuales_Saldo[0]->ap_pat;
				echo " ";
				echo $datosActuales_Saldo[0]->ap_mat;
			?>
		</td>
	</tr>

	</tbody>
</table>
<!-- ************************************************************************ -->
<!-- PERCEPCIONES-->
<!-- ************************************************************************ -->

<table class="tabla-color margen-arriba" id="" style="font-size: 15px; margin-top:40px" width="100%">
	<thead>
		<tr>
			<th COLSPAN="3" class="text-center text-success" style="font-size: 15px; color: #0a6aa1">Detalles de Recarga del Saldo </th>
		</tr>
		<tr class="warning">
			<th style="font-size: 15px; text-align: center">Saldo Anterior</th>
			<th style="font-size: 15px; text-align: center">Importe</th>
			<th style="font-size: 15px; text-align: right">Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $saldoAnterioEstudiante = $datosActuales_Saldo[0]->saldo - $importe;  ?>
		<tr>
			<td style="text-align: center"> $ <?php echo number_format($saldoAnterioEstudiante,2); ?> </td>
			<td style="text-align: center"> $ <?php echo number_format($importe,2); ?> </td>
			<td style="text-align: right"> $ <?php echo number_format( $datosActuales_Saldo[0]->saldo,2); ?> </td>
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
		<td width="15%" class="text-right ">$<?php echo number_format( $datosActuales_Saldo[0]->saldo,2); ?></td>
	</tr>
</table>

<!-- ************************************************************************ -->
<!-- ÁREA DE FIRMAS -->
<!-- ************************************************************************ -->
<!--<hr style="width: 200px; margin-bottom: 0; margin-top: 200px;" />
<h5 class="text-center" style="margin-top: 0;">
	<?php /*echo $datosActuales_Saldo[0]->nombre." ".$datosActuales_Saldo[0]->ap_pat." ".$datosActuales_Saldo[0]->ap_map; */?>
</h5>
<h5 class="text-center">
	RECIBÍ TRANSFERENCIA
</h5>
<h5 class="text-center">
	$<?php /*echo number_format($liquido,2); */?>
</h5>-->
