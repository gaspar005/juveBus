<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

	<?php
		$fecha = $datosEstudiante[0]->fecha;
		$porciones = explode("-", $fecha);
		$D=$porciones[2];
		$M=$porciones[1];
		$Y=$porciones[0];
		setlocale(LC_TIME, 'spanish');
		$nombre=strftime("%B",mktime(0, 0, 0, $M+1, 0 ,0));
		$mes= strtoupper ($nombre );
	?>

	<table width="100%" style="margin: 0;">
		<tr>
			<td rowspan="2" width="200">
				<img style="vertical-align: top" src="<?php echo base_url(); ?>assets/img/logo/juventud.png" width="150" />
			</td>
			<td class="text-center">
				<h5>GOBIERNO DEL ESTADO DE QUINTANA ROO</h5>
			</td>
			<td style="text-align: right; font-size: 11px;">
				<?php echo $D." ".$mes." ".$Y; ?>
			</td>
		</tr>
		<tr>
			<td class="text-center"> <h5>INSTITUTO QUINTANARROENSE DE LA JUVENTUD</h5> </td>
			<td style="text-align: right; font-size: 11px">
				<?php  ini_set('date.timezone','America/Cancun');
				echo date("g:i A");
				?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="text-center"> <h5>RECARGA DE SALDO - SERVICIO JUVEBUS CHETUMAL </h5> </td>
			<td class="text-center" style=" text-align: right; font-size: 11px">
				<?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellidos'); ?>
			</td>
		</tr>
	<!--	<tr>
			<td></td>
			<td class="text-center" style="font:bold 12px "Trebuchet MS"; "> <strong><?php /*echo $header_pdf[0]->concepto_extranombre; */?></strong> </td>
		</tr>-->
		<!--<tr>
			<td></td>
			<td class="text-center" style="font:bold 12px "Trebuchet MS"; "> <h5> DEL <?php /*echo $header_pdf[0]->fecha; */?> </h5> </td>
		</tr>-->
	</table>

