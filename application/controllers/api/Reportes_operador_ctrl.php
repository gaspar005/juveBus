<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: content-type, Authorization');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	/**
	* 
	*/
	require APPPATH . "/libraries/REST_Controller.php";
	class Reportes_operador_ctrl extends REST_Controller{
		
		public function __construct(){
			parent::__construct();

			$this->load->model("api/Reportes_model","Reportes_model");
		}

		public function index_get($id_perador,$fecha){

			$data = $this->Reportes_model->getReportePorDia($id_perador, $fecha);

			if (!is_null($data)) {
				$this->response(array("response"=>$data),200);
			}else{
				$this->response(array('error' => "No hay pagos" ),404);
			}

		}

	}
?>