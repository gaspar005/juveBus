<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: content-type, Authorization');

require APPPATH . "/libraries/REST_Controller.php";

class User_login_ctrl_api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("api/User_login_model_api","User_login_model_api");
		$this->load->helper('jw_tokens');
	}
	
	public function autenticateUser_post(){

        $postdata = file_get_contents("php://input");

        if (isset($postdata)) {
        	
    		$request = json_decode($postdata);
    		if (isset($request->codjoven)) {
    			$codjoven = $request->codjoven;
        		$password = $request->password;
        		// print_r("hola");
    		}else{
    			$codjoven = $this->input->post('codjoven');
    			$password = $this->input->post('password');
    		}	
        }

        $query 			= $this->User_login_model_api->authUser($codjoven);
        if ($query != false) {
	        $token 			= createToken(); //SE CREA EL NUEVO TOKEN DESDE EL HELPER
	        $queryToFotmat 	= $this->_formatQuery($query,$token); //SE CREA UN NUEVO ARRAY PARA AGREGAR EL TOKEN A LOS DATOS DEL USUARIO
	        if ($this->bcrypt->check_password($password, $query[0]->password)) {
	            $this->response(array("response"=>$queryToFotmat),200);
	        }else{
	            $this->response(array('error' => "usuario o password incorrecto 1"),404);
	        }
        }else{
        	$this->response(array('error' => "usuario o password incorrecto 2"),404);
        }
    }
    
    private function _formatQuery($query,$token){

    	return $array[] = array('id_usuario' => $query[0]->id_usuario,
			    	'nombre' 				=> $query[0]->nombre,
			    	'ap_pat' 				=> $query[0]->ap_pat,
			    	'curp'					=> $query[0]->curp,
			    	'ap_mat' 				=> $query[0]->ap_mat,
			    	'codigo_joven' 			=> $query[0]->codigo_joven,
			    	'avatar' 				=> $query[0]->avatar,
			    	'domicilio' 			=> $query[0]->domicilio,
			    	'cruzamiento_domicilio' => $query[0]->cruzamiento_domicilio,
			    	'colonia' 				=> $query[0]->colonia,
			    	'fecha_nacimiento'		=> $query[0]->fecha_nacimiento,
			    	'lugar_nacimiento' 		=> $query[0]->lugar_nacimiento,
			    	'correo' 				=> $query[0]->correo,
			    	'escuela' 				=> $query[0]->escuela,
			    	'id_grado_estudio' 		=> $query[0]->id_grado_estudio,
			    	'turno_horario' 		=> $query[0]->turno_horario,
			    	'id_municipio' 			=> $query[0]->id_municipio,
			    	'localidad' 			=> $query[0]->localidad,
			    	'tel_casa' 				=> $query[0]->tel_casa,
					'tel_celular' 			=> $query[0]->tel_celular,
					'sexo'					=> $query[0]->descripcion,
			    	'id_sexo' 				=> $query[0]->id_sexo,
			    	'lengua_indigena' 		=> $query[0]->lengua_indigena,
			    	'name' 					=> $query[0]->name,
			    	'token' 				=> $token );
    }

}

/* End of file User_login_ctrl_api.php */
/* Location: ./application/controllers/User_login_ctrl_api.php */