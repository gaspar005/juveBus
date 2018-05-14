<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo/juveBUS_192.png');?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | JuveBUS</title>

	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" type="text/css" />

	<link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	    
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/pages/signin.css'); ?>" rel="stylesheet" type="text/css">

</head>

<body style="background-image: url(<?php echo base_url("assets/img/fondo.jpeg"); ?>);background-repeat: no-repeat; background-size: 100%; height: 150px">

	<div class="navbar navbar-fixed-top">

		<div class="navbar-inner">
		
			<div class="container" style="height: 50px;">

				<a class="brand" href="#" >
					<img src="<?php echo base_url('assets/img/logo/juveBUS_192.png');?>" alt="">
				</a>
				<a class="brand" href="#" style=" width: 20%; left: 650px; height: 100px; background-color: rgba(158,156,153,0.41)">
					<img src="<?php echo base_url('assets/img/logo/juventud11.png');?>" alt="" style=" width: 100%; height: 90%"  ">
				</a>
			</div> <!-- /container -->
		</div> <!-- /navbar-inner -->
	</div> <!-- /navbar -->

	<div class="account-container"  >

		<div class="content clearfix">

			<form action="<?php echo base_url('web/Login_admin_ctrl/autentificarUser')?>"  method="post" >

				<h1 style="text-align: center;">SISTEMA JUVEBUS</h1>
				<div class="login-fields">
					<p style="text-align: center;">Ingrese los siguiente datos, porfavor</p>
					<div class="field">
						<label for="rfc">Username</label>
						<input type="text" id="rfc" name="rfc" placeholder="Username" class="login username-field" />
					</div> <!-- /field -->

					<div class="field">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" placeholder="Password" class="login password-field"/>
					</div> <!-- /password -->
				</div> <!-- /login-fields -->
				<p class="error"> <?php echo $error ?> </p>
				<div class="login-actions">

					<button type="submit" class="button btn btn-success btn-large"><span class="icon-signout"></span> Ingresar</button>
				</div> <!-- .actions -->

			</form>

		</div> <!-- /content -->

	</div> <!-- /account-container -->


<script src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/signin.js'); ?>"></script>

</body>

</html>
