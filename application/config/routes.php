<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'web/Login_admin_ctrl/start_session';

//DASHBOARD O VISTA PRINCIPAL AL ENTRAR AL SISTEMA
$route['dashboard'] = 'web/Deshboard_ctrl/dashboard_admin';

//ESTUDIANTES
$route['rigistro-estudiante'] = 'web/Estudiantes_ctrl/index_estudiantes';
$route['lista-estudiantes']   = 'web/Estudiantes_ctrl/lista_estudiantes';

//OPERADOR
$route['operador-reportes'] = 'web/Operador_ctrl/reportes';
$route['operador/consulta/rango']= 'web/Operador_ctrl/searchQueryRango';
$route['operador-lista'] = 'web/Operador_ctrl/lista';
$route['operador-registro'] = 'web/Operador_ctrl/registro';

// SALDOS
$route['saldo-recarga'] = 'web/saldo_ctrl/saldo';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//-------------------------------------------------------------------------------------------------------------
//rutas API

//Operador_ctrl
$route['cobros']['get'] = "api/Operador_ctrl/index";
$route['cobros']['post'] = "api/Operador_ctrl/index";
$route['operador/updateLatLng']['post'] = "api/Operador_ctrl/updatePosition";

//reportes ctrl
$route['reportes/(:num)/(:any)']['get'] = "api/reportes_operador_ctrl/index/$1/$2";

$route['operador/login']['post'] = "api/operador_login_ctrl_api/autenticateOperator";

//user_ctr
// $route['user']['get'] = "user_ctrl/index";
$route['user/reportemes/(:num)/(:any)/(:any)']['get'] = "api/user_ctrl/reportemes/$1/$2/$3";
$route['user/hviajes/(:num)/(:any)/(:any)/(:any)']['get'] = "api/user_ctrl/hviajes/$1/$2/$3/$4";
$route['user/reporte-recargas/(:num)/(:any)/(:any)']['get'] = "api/user_ctrl/recargasSaldoMes/$1/$2/$3";
$route['user/historial-recargas/(:num)/(:num)/(:num)/(:any)/(:any)']['get'] = "api/user_ctrl/historialSaldoMes/$1/$2/$3/$4/$5";
$route['user/consultar-saldo/(:num)']['get'] = "api/user_ctrl/getSaldoActual/$1";
$route['user/get-list-grado-estudios']['get'] = "api/user_ctrl/getLevelOfStudy";
$route['user/get-list-municipios']['get'] = "api/user_ctrl/getListMunicipios";
$route['user/get-list-sexo']['get'] = "api/user_ctrl/getListSexo";
$route['user/update-profile']['post'] = "api/user_ctrl/updateProfile";
$route['user/update-image']['post'] = "api/user_ctrl/updateImage";
$route['user/get-bus-position']['get'] = "api/user_ctrl/getLatLng";
//CAMBIAR CONTRASEÑA
$route['user/change_password']['post'] = "api/user_ctrl/changePassword";

//User_login_ctrl_api
$route['user/login']['post'] = "api/user_login_ctrl_api/autenticateUser";

//ADMIN CONROLLER
$route['admin/alta-saldo']['post'] = "api/admin_ctrl/altaSaldo";
$route['admin/user-data/(:any)']['get'] = "api/admin_ctrl/getDataUser/$1";
$route['admin/operator-data']['get'] = "api/admin_ctrl/getSomeOperatorData";
$route['admin/corte-pago-operador/(:any)']['get'] = "api/admin_ctrl/realizarCorte/$1";

//admin_login_ctrl_api
$route['admin/login']['post'] = "api/admin_login_ctrl_api/autenticateUser";

