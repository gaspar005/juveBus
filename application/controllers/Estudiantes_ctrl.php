<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiantes_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Estudiante_model');
        $this->load->library('bcrypt');
        $this->load->library('upload');
    }
/*
COMIENZA LA CONSULTA DEL MODULO DE REGISTRO DE ESTUDIANTES
*/
	public function index_estudiantes(){

		$dato['active'] = "estudiante"; 
		$dato['active1'] = "registro";
		$dato['ruta1'] = "Registro Estudiante";
		$dato['ruta'] = "Modulo Estudiante / Registro";

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/estudiante/registro');
        $this->load->view('global_view/foother');
	}
	public function guardar_estudiante(){
       
        
        if (isset($_FILES["img_estudiante"]["name"]) )  {
            
            $type = explode('.', $_FILES["img_estudiante"]["name"]);
            $type = $type[count($type)-1];
           
            date_default_timezone_set('America/Cancun');

            $date = date('H:i:s');
            $now = date('Y-m-d');

            $nombreEntero = $_FILES["img_estudiante"]["name"];

            $nombre = explode(".", $nombreEntero);

            $url = "./profiles/".$nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.$type;
        
            if(in_array($type, array("jpg", "png", "jpeg"))){
                if(is_uploaded_file($_FILES["img_estudiante"]["tmp_name"])){
                    move_uploaded_file($_FILES["img_estudiante"]["tmp_name"], $url);

                     $fecha = $this->input->post("year_fecha").'-'.$this->input->post("mes_fecha").'-'.$this->input->post("dia_fecha");
            
                    $estudiante = array(
                        'codigo_joven' => $this->input->post("codigo"), 
                        'nombre' => $this->input->post("nombre"), 
                        'ap_pat' => $this->input->post("ape_pate"), 
                        'ap_mat' => $this->input->post("ape_mate"), 
                        'curp' => $this->input->post("curp"), 
                        'fecha_nacimiento' => $fecha,
                        'lugar_nacimiento' => $this->input->post("lugar_nacimiento"), 
                        'lugar_residencia' => $this->input->post("lugar_recidencia"), 
                        'status' => 1,
                        'id_role' => 3,
                        'avatar'  => $nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.$type,
                        'password' => $this->bcrypt->hash_password($this->input->post("codigo")),
                    );
                    $query = $this->Estudiante_model->save_estudiante($estudiante);

                    if ($query == 1) {
                    $result['resultado'] = true;
                    } else {
                        $result['resultado'] = false;
                    }

                    echo json_encode($result);

                }
            }else{

                $result['resultado'] = false;

                echo json_encode($result);
            }

        }else{

            $fecha = $this->input->post("year_fecha").'-'.$this->input->post("mes_fecha").'-'.$this->input->post("dia_fecha");
            
            $estudiante = array(
                        'codigo_joven' => $this->input->post("codigo"), 
                        'nombre' => $this->input->post("nombre"), 
                        'ap_pat' => $this->input->post("ape_pate"), 
                        'ap_mat' => $this->input->post("ape_mate"), 
                        'curp' => $this->input->post("curp"), 
                        'fecha_nacimiento' => $fecha,
                        'lugar_nacimiento' => $this->input->post("lugar_nacimiento"), 
                        'lugar_residencia' => $this->input->post("lugar_recidencia"), 
                        'status' => 1,
                        'id_role' => 3,                        
                        'password' => $this->bcrypt->hash_password($this->input->post("codigo")),
            );
            $query = $this->Estudiante_model->save_estudiante($estudiante);

            if ($query == 1) {
            $result['resultado'] = true;
            } else {
                $result['resultado'] = false;
            }

            echo json_encode($result);
        }
        
	}
    public function buscar_codigojoven(){

        $codigo_joven = $this->input->post("codigoJ");

        $query = $this->Estudiante_model->existeCodigoJoven($codigo_joven);

        if ($query) {
            $result['resultado'] = true;
            $result['codigoActual'] = $query;
        } else {
            $result['resultado'] = false;
        }

        echo json_encode($result);  
    }

/*
COMIENZA LA CONSULTA DEL MODULO DE LISTA DE ESTUDIANTES
*/

    public function lista_estudiantes(){

        //DATOS PARA INDICAR EN QUE MODULO ESTA EL USUARIO O ADMINISTRADOR SE VAN AL HEADER
        $dato['active'] = "estudiante"; 
        $dato['active1'] = "lista";
        $dato['ruta1'] = "Lista Estudiantes";
        $dato['ruta'] = "Modulo Estudiante / Lista";

        //DATOS QUE SE VAN A LA VISTA
        $vista['estudiantes'] = $this->Estudiante_model->get_list_estudiantes();

        $this->load->view('global_view/header', $dato);
        $this->load->view('admin/estudiante/lista', $vista);
        $this->load->view('global_view/foother');    
    }
    public function deshabilitar_Estudiante(){

        $id = $this->input->post('id');
        $query = $this->Estudiante_model->deshabilitarEstudiante($id);

        if ($query == 1) {
            $result['resultado'] = true;
        } else {
            $result['resultado'] = false;
        }
        echo json_encode($result);
    }
    public function habilitar_Estudiante(){

        $id = $this->input->post('id');
        $query = $this->Estudiante_model->habilitarEstudiante($id);
        if ($query == 1) {
            $result['resultado'] = true;
        } else {
            $result['resultado'] = false;
        }
        echo json_encode($result);

    }
    public function guardar_estudiante_edit(){

        $id = $this->input->post("id");

        $estudiante = array(
            'codigo_joven' => $this->input->post("codigo"),
            'nombre' => $this->input->post("nombre"),
            'ap_pat' => $this->input->post("ape_pate"),
            'ap_mat' => $this->input->post("ape_mate"),
            'curp' => $this->input->post("curp"),
            'fecha_nacimiento' => $this->input->post("fecha_nacimiento"),
            'lugar_nacimiento' => $this->input->post("lugar_nacimiento"),
            'lugar_residencia' => $this->input->post("lugar_recidencia"),
        );

        $query = $this->Estudiante_model->save_edit_estudiante($id, $estudiante);

        if ($query == 1) {
            $result['resultado'] = true;
        } else {
            $result['resultado'] = false;
        }

        echo json_encode($result);
    }
}

/* End of file Estudiantes_ctrl.php */
/* Location: ./application/controllers/Estudiantes_ctrl.php */