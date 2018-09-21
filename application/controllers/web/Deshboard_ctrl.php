<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deshboard_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();      
        $this->load->library('bcrypt');
        $this->load->model('web/Dashboard_model', 'Dashboard_model');
    }

	public function dashboard_admin()
	{  
        $dato['active'] = "dashboard";  
        $dato['ruta1'] = "Dashboard";
        $dato['ruta'] = "PANEL DE CONTROL ADMINISTRADOR";

        $query['datos'] = $this->Dashboard_model->get_estadisticas();
		$query['operadores'] = $this->Dashboard_model->get_estadisticas_operador_dia();
		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/dashboard/index', $query);
        $this->load->view('global_view/foother');
	}

}

/* End of file Deshboard_controller.php */
/* Location: ./application/controllers/Deshboard_controller.php */
