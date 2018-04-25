<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login_admin_ctrl/star_session';

$route['dashboard'] = 'Deshboard_ctrl/dashboard_admin';
$route['rigistro-estudiante'] = 'Estudiantes_ctrl/index_estudiantes';
$route['lista-estudiantes']   = 'Estudiantes_ctrl/lista_estudiantes';

$route['operador-reportes'] = 'Operador_ctrl/reportes';
$route['operador/consulta/rango']= 'Operador_ctrl/searchQueryRango';

$route['operador-lista'] = 'Operador_ctrl/lista';

$route['operador-registro'] = 'Operador_ctrl/registro';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//$route['cobros']['get'] = "cobros_ctrl/index";
//$route['cobros']['post'] = "cobros_ctrl/index";


//$route['user/reportemes/(:num)/(:any)/(:any)']['get'] = "user_ctrl/reportemes/$1/$2/$3";
//$route['user/hviajes/(:num)/(:any)/(:any)']['get'] = "user_ctrl/hviajes/$1/$2/$3";

//login users 
$route['login_ctrl/autenticateUser']['post'] = "login_ctrl/autenticateUser";