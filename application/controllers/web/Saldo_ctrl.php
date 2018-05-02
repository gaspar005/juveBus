<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();   
        $this->load->model('web/Saldos_model', 'saldos_model');
		$this->load->model("Admin_model");
		$this->load->helper('date');
    }

	public function saldo(){

		$dato['ruta1'] = "Recarga Saldo";
		$dato['ruta'] = "Modulo Saldo / Recarga Estudiante";
		$dato['active'] = "saldos"; 
		$dato['active1'] = "recarga";

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/saldos/recarga');
        $this->load->view('global_view/foother');

	}

	public function mostrar(){

      $nombre = $this->input->post("nombre");
      $ap_pat = $this->input->post("paterno");
      $ap_mat = $this->input->post("materno");
      $numeropagina = $this->input->post("nropagina");
      $cantidad = $this->input->post("cantidad");
 
      $inicio = ($numeropagina -1)*$cantidad;
      $data = array(
     
        "estudiante" => $this->saldos_model->buscar(1, $nombre, $ap_pat, $ap_mat, $inicio, $cantidad),
        "totalregistros" => count($this->saldos_model->buscar(1, $nombre, $ap_pat, $ap_mat)),
        "cantidad" =>$cantidad
        
      );

      echo json_encode($data);
   }
	private function getCurrentDateTime(){
		$date = mdate('%Y-%m-%d', time());
		$time = mdate('%H:%i:%s', time());
		$created = $date." ".$time;
		return array('date' => $date,
			'time' => $time,
			'created' => $created);
	}
   public function alta_saldo_estudiante(){

	   $currentDateTime = $this->getCurrentDateTime();
	   $fecha = $currentDateTime['date'];
	   $hora  = $currentDateTime['time'];
	   $created = $currentDateTime['created'];

	   $idUsuario = $this->input->post("id");
	   $importe = $this->input->post("saldo");
	   $dataRecargas = array(
	   		'id_usuario' =>    $this->input->post("id"),
		   'id_user_sistem' => $this->session->userdata('id_user_sistem'),
		   'importe'=>         $this->input->post("saldo"),
		   'fecha' => $fecha,
		   'hora' => $hora,
		   'fecha_creacion' => $created
	   );

	   $query = $this->Admin_model->altaSaldo($idUsuario,$importe,$dataRecargas,$currentDateTime);

	   if ($query == 1) {
		   $result['resultado'] = true;
	   } else {
		   $result['resultado'] = false;
	   }
	   echo json_encode($result);

   }


}

/* End of file Saldo_web_ctrl.php */
/* Location: ./application/controllers/Saldo_web_ctrl.php */