<link rel="stylesheet" media="print" href="<?php echo base_url('assets/css/assets/css/bootstrap-real.css')?>" />
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

	<table width="100%" style="margin: 0; ">
		<tr >
			<td rowspan="2" width="400" >
				<img style="vertical-align: top; width: 400px" src="<?php echo base_url(); ?>assets/imgs/logo/juventud.png" />
			</td>
			<td ></td>
			<td ></td>
			<td style="text-align: right; font-size: 11px; " >
				<?php echo $D." ".$mes." ".$Y; ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="text-align: right; font-size: 11px">
				<?php  ini_set('date.timezone','America/Cancun');
				echo date("g:i A");
				?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>

			<td class="text-center" style=" text-align: right; font-size: 11px">
				<?php if ($this->session->userdata('nombre')): ?>
					<?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellidos'); ?>
					<br>
					Folio: <strong><?php echo $datosEstudiante[0]->folio; ?></strong>
				<?php else: ?>
					<?php echo $adminData[0]->nombre.' '.$adminData[0]->ap_pat.' '.$adminData[0]->ap_mat; ?>
				<?php endif ?>
				
			</td>
		</tr>
	</table>

