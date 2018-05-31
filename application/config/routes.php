<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'web/Login_admin_ctrl/start_session';
$route['login'] = 'web/Login_admin_ctrl/start_session';

//DASHBOARD O VISTA PRINCIPAL AL ENTRAR AL SISTEMA
$route['dashboard'] = 'web/Deshboard_ctrl/dashboard_admin';
$route['ajustes'] = 'web/Ajustes_ctrl/ajustes';

//ESTUDIANTES
$route['rigistro-estudiante'] = 'web/Estudiantes_ctrl/index_estudiantes';
$route['lista-estudiantes']   = 'web/Estudiantes_ctrl/lista_estudiantes';
$route['lista-estudiantes/pagina/(:num)'] = 'web/Estudiantes_ctrl/lista_estudiantes/$1';

//OPERADOR
$route['operador-reportes'] = 'web/Operador_ctrl/reportes';
$route['operador/consulta/rango']= 'web/Operador_ctrl/searchQueryRango';
$route['operador-lista'] = 'web/Operador_ctrl/lista';
$route['operador-registro'] = 'web/Operador_ctrl/registro';

// SALDOS
$route['saldo-recarga'] = 'web/saldo_ctrl/saldo';
$route['saldo-recarga/pagina/(:num)'] = 'web/saldo_ctrl/saldo/$1';

$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

//$route['cobros']['get'] = "cobros_ctrl/index";
//$route['cobros']['post'] = "cobros_ctrl/index";


//$route['user/reportemes/(:num)/(:any)/(:any)']['get'] = "user_ctrl/reportemes/$1/$2/$3";
//$route['user/hviajes/(:num)/(:any)/(:any)']['get'] = "user_ctrl/hviajes/$1/$2/$3";

//login users 
$route['login_ctrl/autenticateUser']['post'] = "login_ctrl/autenticateUser";
