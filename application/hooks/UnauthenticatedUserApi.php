<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	//clase de usuarios no autenticados
	use Firebase\JWT\JWT;
	require __DIR__ . '../../../vendor/autoload.php';
	class UnauthenticatedUserApi	{
		//super objeto de codeigniter
		private $ci;

		// cotroladores que puede acceder un usuario cuando no a iniciado session
		private $allowed_controllers;

		// metodos que puede acceder un usuario cuando no a iniciado session
		private $allowed_methods;

		// metodos que no puede acceder un usuario cuando no a iniciado session
		private $disallowed_methods;

		//
		private $drivers_not_allowed;

		public function __construct()
		{
			// super objeto de codeigniter
			$this->ci =& get_instance();
			$this->allowed_controllers		= ['operador_login_ctrl_api','user_login_ctrl_api','admin_login_ctrl_api','Login_admin_ctrl'];
			$this->allowed_methods 			= ['autenticateOperator','autenticateUser','start_session','autentificarUser'];
			$this->ci->load->helper('url');
			$this->ci->load->helper('jw_tokens');
		}

		public function VerifyAccess()
		{
			if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
				$jwt = trim($_SERVER['HTTP_AUTHORIZATION']);

				$checkToken = validateToken($jwt);

				if (!$checkToken) {
					$response = array("response"=>FALSE);
					echo json_encode($response);
					die();
				}else{
					// $response = array("response"=>'Token VALIDO desde hooks');
					// echo json_encode($response);
					// die();
				}
			}else{
				//se obtiene el controlador en que se encuentra el usuario
				$class = $this->ci->router->class;
				//se obtiene el metodo en que se encuentra el usuario
				$method = $this->ci->router->method;
				//se guarda la sesion en una variable unica que este vacia
				$session = $this->ci->session->userdata('logged_in');

				if(empty($session) && !in_array($class, $this->allowed_controllers))
				{
					redirect(base_url());
				}
				if(empty($session) && !in_array($class, $this->allowed_controllers)){
					$response = array("response"=>'¡ERROR! ACCESO DENEGADO 1');
					echo json_encode($response);
					die();
				}

				if(empty($session) && in_array($class, $this->allowed_controllers)){
					if(!in_array($method, $this->allowed_methods))
					{
						$response = array("response"=>'¡ERROR! ACCESO DENEGADO 2');
						echo json_encode($response);
						die();
					}
				}
				//print_r('HOOK NO SE HA ENVIADO TOKEN'); die();
				
			}
			/*//se obtiene el controlador en que se encuentra el usuario
			$class = $this->ci->router->class;

			//se obtiene el metodo en que se encuentra el usuario
			$method = $this->ci->router->method;

			//se guarda la sesion en una variable unica que este vacia
			$session = $this->ci->session->userdata('logged_in');

			if(empty($session) && !in_array($class, $this->allowed_controllers))
			{
				redirect(base_url());
			}

			if(empty($session) && in_array($class, $this->allowed_controllers))
			{
				if(in_array($method, $this->disallowed_methods))
				{
					 redirect(base_url());
				}
			}*/
		}

	}