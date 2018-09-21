<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: content-type, Authorization');

require APPPATH . "/libraries/REST_Controller.php";

class Operador_login_ctrl_api extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Operador_login_model_api','Operador_login_model_api');
		$this->load->helper('jw_tokens');
	}

	public function autenticateOperator_post(){

        $postdata = file_get_contents("php://input");

        if (isset($postdata)) {
        	
    		$request = json_decode($postdata);
    		if (isset($request->rfc)) {
    			$rfc = $request->rfc;
        		$password = $request->password;
        		// print_r("hola");
    		}else{
    			$rfc = $this->input->post('rfc');
    			$password = $this->input->post('password');
    		}	
        }

        $query 			= $this->Operador_login_model_api->authOperator($rfc);
        if ($query != false) {
	        $token 			= createToken(); //SE CREA EL NUEVO TOKEN
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

    	return $array[] = array('id_operador' => $query[0]->id_operador,
			    	'nombre' => $query[0]->nombre,
			    	'ap_pat' => $query[0]->ap_pat,
			    	'ap_mat' => $query[0]->ap_mat,
			    	'rfc'    => $query[0]->rfc,
			    	'name'   => $query[0]->name,
			    	'token'  => $token,
                    'id_bus' => $query[0]->id_bus);
    }

}

/* End of file Operador_login_ctrl_api.php */
/* Location: ./application/controllers/Operador_login_ctrl_api.php */