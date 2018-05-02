<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Operador_ctrl extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("web/Operador_model", 'Operador_model');
    $this->load->model("Reportes_model");
    $this->load->library('bcrypt');
	}
  
  // MODULO DE REGISTRO DE OPERADORES

  public function registro(){

    $dato['active'] = "operador";
    $dato['active1'] = "registro-operador";
    $dato['ruta1'] = "Registro Operador";
    $dato['ruta'] = "Modulo Operador / Registro";

    $this->load->view('global_view/header', $dato);
    $this->load->view('admin/operador/registro');
    $this->load->view('global_view/foother');
  }
  public function searchRFC(){

    $rfc = $this->input->post("rfc");
    $query = $this->Operador_model->existeRFC($rfc);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);
  }
  public function guardar_operador(){

    $fecha = $this->input->post("year_fecha").'-'.$this->input->post("mes_fecha").'-'.$this->input->post("dia_fecha");
    $operador = array(
                'rfc' => $this->input->post("rfc"), 
                'nombre' => $this->input->post("nombre"), 
                'ap_pat' => $this->input->post("ap_pat"), 
                'ap_mat' => $this->input->post("ap_mat"), 
                'fecha_nacimiento' => $fecha,
                'status' => 1,
                'id_role' => 2,              
                'password' => $this->bcrypt->hash_password($this->input->post("rfc"))
    );
    $query = $this->Operador_model->save_operador($operador);
    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);
  }

  // MODULO DE REGISTRO DE OPERADORES
	public function reportes(){

		$dato['active'] = "operador";
    	$dato['active1'] = "reportes-operador";
		$dato['ruta1'] = "Reporte de Operadores";
		$dato['ruta'] = "Modulo Operador / Reportes";

		$vista['operadores'] = $this->Operador_model->get_list_operadores();

		$this->load->view('global_view/header', $dato);
    	$this->load->view('admin/operador/reportes', $vista);
    	$this->load->view('global_view/foother');
   		
  }

  public function getInfor_operador(){

 		$id = $this->input->post('operador');

    date_default_timezone_set('America/Cancun');
    $fecha = date('Y-m-d');

 		$query = $this->Reportes_model->getReportePorDia($id,$fecha);

 		if ($query != false) {
 			
          $result['resultado'] = true;
          $result['operador'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }

  public function searchQueryDay(){
     
    $id = $this->input->post('id_operador');
    $fecha1 = $this->input->post('fecha_dia');

    $inicio1 = explode("/", $fecha1);
    $fecha = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];
  
    $query = $this->Reportes_model->getReportePorDia($id,$fecha);

    if ($query != false) {
      
          $result['resultado'] = true;
          $result['operador'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }

  public function searchQueryRango(){

    $id = $this->input->post('id_operador');
    $fecha_inicio = $this->input->post('dia_inicio');
    $fecha_fin = $this->input->post('dia_fin');

    $inicio1 = explode("/", $fecha_inicio);
    $inicio = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];
   
    $fin1 = explode("/", $fecha_fin);
    $fin = $fin1[2].'-'.$fin1[1].'-'.$fin1[0]; 

    $query = $this->Reportes_model->getReportePorRango($id,$inicio, $fin);

    if ($query != false) {
      
          $result['resultado'] = true;
          $result['operador'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }

  public function searchQueryMonth(){
    
    $id = $this->input->post('id_operador');
    $mes = $this->input->post('mes');
    $year = $this->input->post('year');

    $query = $this->Reportes_model->getReportePorMonth($id,$mes, $year);

    if ($query != false) {
      
          $result['resultado'] = true;
          $result['operador'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }

  public function getYearEsistentes(){

    $query = $this->Operador_model->getYears();

    if ($query != false) {
      
          $result['resultado'] = true;
          $result['years'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }

  public function searchQueryYear(){

    $id = $this->input->post('id_operador');
    $year = $this->input->post('year');

    $query = $this->Reportes_model->getReportePorYear($id, $year);

    if ($query != false) {
      
          $result['resultado'] = true;
          $result['operador'] = $query;
         
      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);
  }

  // MODULO DE LISTA DE OPERADORES (editar, habilitar, dehabilitar )

  public function lista(){

    $dato['active'] = "operador";
    $dato['active1'] = "lista-operador";
    $dato['ruta1'] = "Lista de Operadores";
    $dato['ruta'] = "Modulo Operador / Lista: editar datos, deshabilitar, habilitar ";

    $vista['operadores'] = $this->Operador_model->get_list_operadoresAll();

    $this->load->view('global_view/header', $dato);
    $this->load->view('admin/operador/lista', $vista);
    $this->load->view('global_view/foother');

  }

  public function updater_operador(){

    $id = $this->input->post("id");

    $operador = array(
        'nombre' => $this->input->post("nombre"),
        'ap_pat' => $this->input->post("ap_pat"),
        'ap_mat' => $this->input->post("ap_mat"),
        'rfc' => $this->input->post("rfc"),
        'fecha_nacimiento' => $this->input->post("fecha_nacimiento"),
    );
   
    $query = $this->Operador_model->save_edit_operador($id, $operador);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }

    echo json_encode($result);

  }
  public function habilitar_operador(){

    $id = $this->input->post('id');
    $query = $this->Operador_model->habilitarOperador($id);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);

  }
  public function deshabilitar_operador(){

    $id = $this->input->post('id');
    $query = $this->Operador_model->deshabilitarOperador($id);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);

  }


}

/* End of file Operador_ctrl.php */
/* Location: ./application/controllers/Operador_ctrl.php */
