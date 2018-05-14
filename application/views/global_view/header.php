<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo/juveBUS_512.png');?>" />
  <title><?php if ( isset($ruta1) ) { echo $ruta1; } ?>  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- DataTable -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>"> -->
  <!-- <link href="<?php echo base_url('assets/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet"> -->
  <link href="<?php echo base_url('assets/css/plugins/validator/validation.min.css')?>" rel="stylesheet">
  <script async defer src="<?php echo base_url('assets/js/plugins/validator/buttons.js'); ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/css/plugins/dataTables/bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/plugins/dataTables/dataTables.bootstrap.min.css');?>">
  <link href="<?php echo base_url('assets/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet">

  <!-- Bootstrap themplate-->
 <!-- <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet"> -->
  
  <!-- Bootstrap puro original 100% real no fake -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Tipo grafia para la letra -->
	<link href="<?php echo base_url('assets/css/tipografias.css'); ?>" rel="stylesheet">
	       
	<link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">

  <!-- Dashboard -->
	<link href="<?php echo base_url('assets/css/pages/dashboard.css'); ?>" rel="stylesheet">
  <!-- Ladda efecto de botones -->
  <link href="<?php echo base_url('assets/css/plugins/ladda/ladda-themeless.min.css'); ?> " rel="stylesheet">

  <!-- sweetAlert -->
  <link href="<?php echo base_url('assets/css/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet">

  <!-- Toastr style -->
  <link href="<?php echo base_url('assets/css/plugins/toastr/toastr.min.css'); ?> " rel="stylesheet">
  
  <!-- Gritter -->
  <link href="<?php echo base_url('assets/js/plugins/gritter/jquery.gritter.css'); ?>" rel="stylesheet">
  
  <!-- DATATIMEPIKER -->
  <link href="<?php echo base_url('assets/css/plugins/datatimepicker/bootstrap-datetimepicker.css'); ?>" />
  <link href="<?php echo base_url('assets/css/plugins/datatimepicker/jquery-ui.css'); ?>" rel="stylesheet"/> <!--NO QUITAR AFECTA EL DISEÑO DE CALENDARIO -->

  <script>
      var baseURL = "<?php echo base_url(); ?>";

  </script>
	<style>
		.dropdown-togglee:hover{ background: #1b6d85 !important; }
	</style>
</head>
<body>

<nav class="navbar navbar-fixed-top" style="background:#00BA8B; margin-bottom: 0; border: 0;">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" style="color: white;" href="#"> <?php if ( isset($ruta) ) { echo $ruta; } ?> </a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right" >
			  <li class="dropdown" >
				<a href="#" class="dropdown-togglee" data-toggle="dropdown" role="button" aria-haspopup="true" id="salir_login"
				   aria-expanded="false"> <?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellidos'); ?>
				  <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
				  <li><a href="javascript:;">Profile</a></li>
				  <li><a href="<?php echo base_url('web/Login_admin_ctrl/logout'); ?>">Cerrar Sesion</a></li>
				</ul>
			  </li>
			</ul>
		</div>
	</div>
</nav>

<div class="subnavbar" style="height: 40px;">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if (isset($active)) { if ($active == "dashboard") { echo "class='active'"; } } ?>>
          <a href="<?php echo base_url('dashboard'); ?>">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
          </a> 
        </li>
        <li <?php  if ($active == "estudiante") { echo "class='active dropdown'"; }else { echo "class='dropdown'"; } ?> >
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-group"></i>
            <span>Estudiantes</span> 
            <b class="caret"></b>
          </a> 
          <ul class="dropdown-menu">
            <li <?php  if (isset($active1)) {  if ($active1 == "registro") { echo "class='active'"; } } ?> >
              <a href="<?php echo base_url('rigistro-estudiante'); ?>">Registro</a>
            </li>
            <li <?php  if (isset($active1)) {  if ($active1 == "lista") { echo "class='active'"; } } ?>>
              <a href="<?php echo base_url('lista-estudiantes'); ?>">Lista Estudiantes</a>
            </li>
          </ul>
        </li>
        <li <?php  if ($active == "operador") { echo "class='active dropdown'"; }else { echo "class='dropdown'"; } ?>>
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" >
            <i class="icon-cogs"></i>
            <span>Operador</span> 
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li <?php  if (isset($active1)) {  if ($active1 == "reportes-operador") { echo "class='active'"; } } ?>>
              <a href="<?php echo base_url('operador-reportes'); ?>">Reportes</a>
            </li>
            <li <?php  if (isset($active1)) {  if ($active1 == "lista-operador") { echo "class='active'"; } } ?> >
              <a href="<?php echo base_url('operador-lista'); ?>">Lista Operadores</a>
            </li>
            <li <?php  if (isset($active1)) {  if ($active1 == "registro-operador") { echo "class='active'"; } } ?> >
              <a href="<?php echo base_url('operador-registro'); ?>">Registro</a>
            </li>
          </ul>
        </li>
        <li <?php  if ($active == "saldos") { echo "class='active dropdown'"; }else { echo "class='dropdown'"; } ?>>
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" >
            <i class="icon-cogs"></i>
            <span>Saldo</span> 
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li <?php  if (isset($active1)) {  if ($active1 == "recarga") { echo "class='active'"; } } ?>>
              <a href="<?php echo base_url('saldo-recarga'); ?>">Recarga</a>
            </li>          
          </ul>
        </li>
        <li><a href="#"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
            <i class="icon-long-arrow-down"></i>
            <span>Drops</span> 
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Icons</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Pricing Plans</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Signup</a></li>
            <li><a href="#">404</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
