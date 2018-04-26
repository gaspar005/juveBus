<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deshboard_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();      
        $this->load->library('bcrypt');
    }

	public function dashboard_admin()
	{  
        $dato['active'] = "dashboard";  
        $dato['ruta1'] = "Dashboard";
        $dato['ruta'] = "PANEL DE CONTROL ADMINISTRADOR";

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/dashboard/index');
        $this->load->view('global_view/foother');
	}

}

/* End of file Deshboard_controller.php */
/* Location: ./application/controllers/Deshboard_controller.php */