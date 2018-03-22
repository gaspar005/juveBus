<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');


require APPPATH . "/libraries/REST_Controller.php";
class Cobros_ctrl extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Pagos_model");
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
		$pagos = $this->Pagos_model->get();

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
			$pago = 4;
			$codJoven = $request->codJoven;
			$idOperador = $request->idOperador;
		}

		$query = $this->Pagos_model->save($pago,$codJoven,$idOperador);

		if (! is_null($query)) {
			//echo json_encode($query);
			$this->response(array("response"=>$query),200);
		}
		else{
			$this->response(array('error' => "Ha ocurrido un error al guardar pago".$pago ." ".$codJoven." ".$idOperador." query ". $query  ),404);
		}

	}
}