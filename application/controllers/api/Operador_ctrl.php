<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: content-type, Authorization');


require APPPATH . "/libraries/REST_Controller.php";
class Operador_ctrl extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("api/Operador_model","Operador_model");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index_get()
	{
		$pagos = $this->Operador_model->get();

		if (!is_null($pagos)) {
			$this->response(array("response"=>$pagos),200);
		}else{
			$this->response(array('error' => "No hay pagos" ),404);
		}
	}
	public function index_post()
	{
		$postdata = file_get_contents("php://input");

		if (isset($postdata)) {
			$request = json_decode($postdata);
			$codJoven = $request->codJoven;
			$idOperador = $request->idOperador;
			$latidud = $request->latitud;
			$longitud = $request->longitud;
		}
		// $codJoven = $this->input->post('codJoven');
		// $idOperador = $this->input->post('idOperador');
		// $latidud = $this->input->post('latitud');
		// $longitud = $this->input->post('longitud');
		

		$query = $this->Operador_model->save_pay($codJoven,$idOperador,$latidud,$longitud);

		if (! is_null($query)) {
			$this->response(array("response"=>$query),200);
		}else{
			$this->response(array('error' => "Ha ocurrido un error al guardar pago".$codJoven." ".$idOperador." query ". $query  ),404);
		}

	}

	public function updatePosition_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$id_bus = $request->id_bus;

			$data = array(
		        'latitud' => $request->latitud,
		        'longitud' => $request->longitud
			);
			$query = $this->Operador_model->updateLatLng($id_bus,$data);

			if ($query) {
				$this->response(array("response"=>$query),200);
			}else{
				$this->response(array('error' => "ERROR AL ACTUALIZAR POSICIÓN" ),404);
			}
		}else{
			$this->response(array('error' => "HA OCURRIDO UN ERROR AL RECIBIR LATITUD Y LONGITUD EN EL SERVIDOR "),404);
		}
	}

}