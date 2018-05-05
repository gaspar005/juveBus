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
<table  class="table table-striped txt-header-pdf " style="margin-top: 2rem; font-size: 12px;">
	<tbody id="">
	<tr>
		<td width="12%"> Codigo Joven: </td>
		<td width="33%" style="font:bold 12px"> <?php echo $datosActuales_Saldo[0]->codigo_joven; ?> </td>
		<td width="15%" > Nombre:  </td>
		<td width="35%" style="font:bold 12px">
			<?php
				echo $datosActuales_Saldo[0]->nombre;
				echo " ";
				echo $datosActuales_Saldo[0]->ap_pat;
				echo " ";
				echo $datosActuales_Saldo[0]->ap_map;
			?>
		</td>
	</tr>
	<tr>
		<td> CURP:  </td>
		<td style="font:bold 12px"> <?php echo $datosActuales_Saldo[0]->curp; ?></td>
		<td> Lugar Nacimiento: </td>
		<td style="font:bold 12px"> <?php echo $datosActuales_Saldo[0]->lugar_nacimiento; ?> </td>
	</tr>
	</tbody>
</table>
<!-- ************************************************************************ -->
<!-- PERCEPCIONES-->
<!-- ************************************************************************ -->

<table class="tabla-color margen-arriba" id="" style="font-size: 15px; margin-top: 80px" width="100%">
	<thead>
		<tr>
			<th COLSPAN="2" class="text-center success" style="font-size: 15px;">Detalles de Recarga Saldo </th>
		</tr>
		<tr class="warning">
			<th style="font-size: 15px;">Saldo Anterior</th>
			<th style="font-size: 15px;">Importe</th>
			<th style="font-size: 15px;">Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $saldoAnterioEstudiante = $datosActuales_Saldo[0]->saldo - $importe;  ?>
		<tr>
			<td> $ <?php echo number_format($saldoAnterioEstudiante,2); ?> </td>
			<td> $ <?php echo number_format($importe,2); ?> </td>
			<td> $ <?php echo number_format( $datosActuales_Saldo[0]->saldo,2); ?> </td>
		</tr>
	</tbody>
</table>

<!-- ************************************************************************ -->
<!-- Imprimir Líquido -->
<!-- ************************************************************************ -->

<table width="100%" class="margen-arriba">
	<tr>
		<td width="70%"></td>
		<td width="15%" class="text-left">Saldo Total:</td>
		<td width="15%" class="text-right">$<?php echo number_format( $datosActuales_Saldo[0]->saldo,2); ?></td>
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
