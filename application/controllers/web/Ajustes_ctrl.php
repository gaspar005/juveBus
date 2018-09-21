<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes_ctrl extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('web/Ajustes_model', 'ajustes_model');
	}

	public function ajustes(){

		$dato['active'] = "ajustes";
		$dato['ruta1'] = "Ajustes de Tarifas";
		$dato['ruta'] = "Panel de Tarifas";

		$this->load->view('global_view/header', $dato);
		$this->load->view('admin/ajustes/tarifa');
		$this->load->view('global_view/foother');
	}
	public function mostrar(){
		$datos = $this->ajustes_model->mostrar();
		echo json_encode($datos);
	}
	function actualizar(){
		if ($this->input->is_ajax_request()) {
			$id_settings = $this->input->post("id");
			$datos = array(
				"concepto" =>  $this->input->post("concepto"),
				"valor" => $this->input->post("tarifa")
			);
			if($this->ajustes_model->actualizar($id_settings,$datos) == true){
				$result['resultado'] = true;
				echo json_encode($result);
			}else{
				$result['resultado'] = false;
				echo json_encode($result);
			}
		}else{
			show_404();
		}
	}


}
