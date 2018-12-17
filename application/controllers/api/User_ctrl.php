<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: content-type, Authorization');
/**
* 
*/
require APPPATH . "/libraries/REST_Controller.php";

class User_ctrl extends REST_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->library('bcrypt');
		$this->load->model("api/User_model","User_model");
	}
	
	public function reportemes_get($id_user, $year, $month){
		$data = $this->User_model->getRepPorMes($id_user, $year, $month);

		if (!is_null($data)) {
			$this->response(array("response"=>$data),200);
		}else{
			$this->response(array('error' => "No hay pagos" ),404);
		}
	}

	public function hviajes_get($id_user, $year, $month, $created){

		if ($created == 'false') {
			$created = false;
		}else{
			$created = str_replace("%20"," ",$created);
		}

		$data = $this->User_model->getHPorMes($id_user, $year, $month,$created);

		if (!is_null($data)) {
			$this->response(array("response"=>$data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}

	//SE OBTIENE LA INFORMACIÓN DE LAS RECARGAS DE SALDO REALIZADO EN EL MES SELECCIONADO
	public function recargasSaldoMes_get($id_user, $year, $month){

		$data = $this->User_model->recargasSaldoMes($id_user, $year, $month);
		
		if (!is_null($data)) {
			$this->response(array("response"=>$data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}

	//SE OBTITNE EL HISTORIAL DE LAS RECARGAS DEL MES SELECCIONADO
	public function historialSaldoMes_get($id_user, $year, $month, $date, $time){
		if ($date == 'false' && $time == 'false') {
			$created = false;
		}else{
			$created = $date." ".$time;
		}

		$data = $this->User_model->historialRecargasSaldoMes($id_user, $year, $month, $created);

		if (!is_null($data)) {
			$this->response(array("response"=>$data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}

	//SE OBTIENE EL SALDO ACTUAL DEL USUARIO
	public function getSaldoActual_get($idUser){

		$data = $this->User_model->getSaldoActual($idUser);

		if (!is_null($data)) {
			$this->response(array('response' => $data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}
	//ACTUALIZAR PERFIL
	public function updateProfile_post(){
		$postdata = file_get_contents("php://input");

        if (isset($postdata)) {
    		$request = json_decode($postdata);
    		if (isset($request->lugar_nacimiento)) {
    			$id_user 	=  	$request->id_usuario;
    			$data = array(
		    			'domicilio' 				=>	$request->domicilio,
					  	'cruzamiento_domicilio' 	=>	$request->cruzamiento_domicilio,
						'colonia' 					=>	$request->colonia,
						'lugar_nacimiento' 			=>	$request->lugar_nacimiento,
						'correo' 					=>	$request->correo,
						'escuela' 					=>	$request->escuela,
					  	'id_grado_estudio'			=>	$request->id_grado_estudio,
					  	'turno_horario' 			=>	$request->turno_horario,
					  	'id_municipio'				=>	$request->id_municipio,
					  	'localidad' 				=>	$request->localidad,
					  	'tel_casa' 					=>	$request->tel_casa,
					  	'tel_celular' 				=>	$request->tel_celular,
					  	'id_sexo' 						=>	$request->id_sexo,
					  	'lengua_indigena' 			=>	$request->lengua_indigena);
    		}else{
    			$id_user			= $this->input->post('id_usuario');
    			$lugar_nacimiento	= $this->input->post('lugar_nacimiento');
        		$lugar_residencia 	= $this->input->post('lugar_residencia');
    		}	
        }

        $query = $this->User_model->updateProfile($data, $id_user);
        if (!is_null($query)) {
			$this->response(array('response' => $query),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}

	}

	//SE OBTIENE LA LISTA DE GRADO DE ESTUDIOS
	public function getLevelOfStudy_get(){
		$data = $this->User_model->getListLevelOfStudy();

		if (!is_null($data)) {
			$this->response(array('response' => $data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}

	//SE OBTIENE LA LISTA DE LOS MUNICIPIOS
	public function getListMunicipios_get(){
		$data = $this->User_model->getListMunicipios();

		if (!is_null($data)) {
			$this->response(array('response' => $data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}
	//SE OBTIENE LA LISTA DE SEXO
	public function getListSexo_get(){
		$data = $this->User_model->getListSexo();

		if (!is_null($data)) {
			$this->response(array('response' => $data),200);
		}else{
			$this->response(array('error' => "No hay datos" ),404);
		}
	}

	public function updateImage_post(){

        if (isset($_FILES["ionicfile"]["name"]) && $_FILES["ionicfile"]["name"] != null  )  {
            
            $id_user = $this->input->post("id_user");
            $file = $this->input->post("originalName");
            if ($file != null && $file != "") {
	            $path = "./assets/imgs/usuarios/perfil/";
	            if (!is_null($file)) {
	            	if (file_exists("$path/$file")) {
	            		unlink($path.$file);
	            	}
	            }
            }
            
           
            
            $date = date('H:i:s');
            $now = date('Y-m-d');

            $nombreEntero = $_FILES["ionicfile"]["name"];

            $nombre = explode(".", $nombreEntero);
            $nameFile = $nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.'jpg';
            $url = "./assets/imgs/usuarios/perfil/".$nameFile;
        	
            
            if(is_uploaded_file($_FILES["ionicfile"]["tmp_name"])){
            	
        		move_uploaded_file($_FILES["ionicfile"]["tmp_name"], $url);

        		$data = array('avatar' => $nameFile, );
                $this->User_model->updateImage($data,$id_user);

                $response = array('status' => true,
                				  'nameFile' => $nameFile,
                				'message' => 'La imágen se actualizó correctamente');
                $this->response(array('response' => $response),200);
                
            }else{
            	 $response = array('status' => true,
                				  'nameFile' => false,
                				  'message' => 'Error al subir imágen');
            	$this->response(array('response' => $response),200);
            }
            

        }else{
        	 $response = array('status' => true,
                				  'nameFile' => false,
                				 'message' => 'Ocurrio un problema al recibir imágen en el servidor');
        	$this->response(array('response' => $response),200);
        }
        
	}


	private function getCurrentDateTime(){
		$date = mdate('%Y-%m-%d', time());
		$time = mdate('%H:%i:%s', time());
		return array('date' => $date,
					 'time' => $time);
	}

	public function getLatLng_get(){
		$data = $this->User_model->getPosCamiones();

		if (!is_null($data)) {
			$this->response(array("response"=>$data),200);
		}else{
			$this->response(array('response' => false),200);
		}
	}

	public function changePassword_post()
	{
		$postdata = file_get_contents("php://input");

		$response['data']['matchOldPassword'] 	= false;
		$response['data']['changedPassword']	= false;


        if (isset($postdata)){
        	$request = json_decode($postdata);

        	$codigo_joven	= 	$request->codigo_joven;
        	$old_pwd 		=  	$request->old_pwd;
        	$new_pwd 		=  	$request->new_pwd;

        	$query = $this->User_model->getInfoUser($codigo_joven);
        	if (!is_null($query)) {
        		//VERIFICAR QUE LA CONTRASEÑA ANTERIOR SEA LA CORRECTA
        		if ($this->bcrypt->check_password($old_pwd, $query[0]->password)) {
	            	$response['data']['matchOldPassword'] 	= true;
	            	$response['data']['changedPassword']	= $this->User_model->changePassword($codigo_joven,$this->bcrypt->hash_password($new_pwd));
		        }else{
		            $response['data']['matchOldPassword'] = false;
		        }
        	}

        }
        //IMPRIMIR RESPUESTA EN FORMATO JSON
        echo(json_encode($response));
	}

}