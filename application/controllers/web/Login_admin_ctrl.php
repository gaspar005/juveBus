<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('web/Login_admin_model', 'Login_admin_model' );
        $this->load->library('bcrypt');
        $this->load->helper('url');
    }

	/*ESTA LA PARTE DEL USUARIO ADMIN EN WEB*/ 
	public function start_session(){
		if($this->session->userdata('logged_in')==true){
            redirect('dashboard');
        }else{
            $data['error'] = $this->session->flashdata('error');
            $this->load->view('admin/login',$data);
        }
	}

	public function autentificarUser(){

		if ($this->input->post()) {

            $rfc = $this->input->post('rfc');

            $query1 = $this->Login_admin_model->loginUserAdmin($rfc);
           	
            if($query1){
                if ($this->bcrypt->check_password($this->input->post('password'), $query1[0]->password)) {
                    $data = array(
                        'id_user_sistem' => $query1[0]->id_user_sistem,
                        'nombre' => $query1[0]->nombre,
                        'apellidos' => $query1[0]->ap_pat.' '.$query1[0]->ap_mat,
                        'rfc' => $query1[0]->rfc,
                        'root' => true,
                        'admin' => false,
                        'tipo_usuario' => $query1[0]->name,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                }else {
                    $this->session->set_flashdata('error', '<strong style="color: red">Usuario o Contraseña Incorrecto*</strong>');
                    redirect(base_url());
                }
            }else {
                $this->session->set_flashdata('error', '<strong style="color: red">Nesesario Ingresar Datos*</strong>');
                redirect(base_url());
            }
        }else {
            $this->session->set_flashdata('error', '<strong style="color: red">Nesesario Ingresar Datos*</strong>');
            redirect(base_url());
        }

	}

	public function logout(){

	   $this->session->sess_destroy();
	   redirect(base_url());

	}




}

/* End of file login_admin_ctrl.php */
/* Location: ./application/controllers/login_admin_ctrl.php */
