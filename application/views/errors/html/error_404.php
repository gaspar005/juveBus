<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>404 Pagina no existe</title>
	<link href="<?php echo base_url('assets/css/bootstrap-real.css'); ?>" rel="stylesheet" >
	<link href="<?php echo base_url('assets/imgs/logo/juveBUS_512.png');?>" rel="icon" type="image/png"  >
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?> "></script>

	<style>
		.ops{
			font-size: 60px;
		}
	</style>
</head>

<body style="background: #ededed;">


<div class="container">
	<div class="row">
		<div class="col-sm-6 col-xs-12 col-sm-offset-3" style="margin-top: -70px;">
			<div class="text-center">
				<h1>Oopss!!</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-xs-12 col-sm-offset-2" style="margin-bottom: 20px;">
			<div class="text-center">
				<img width="530" src="<?php echo base_url('assets/imgs/error_fund_juvebus.png')?>" alt="" id="img_error">
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">

	let img_click = document.getElementById("img_error");
	img_click.addEventListener('click', error);
	function error(){

		window.location.href = "<?php echo base_url('web/Login_admin_ctrl/error');?>";

	}
</script>
</body>
</html>
