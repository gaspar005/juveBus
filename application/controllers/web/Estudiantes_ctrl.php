<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiantes_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('pagination');
        $this->load->model('web/Estudiante_model', 'Estudiante_model');
        $this->load->library('bcrypt');
        $this->load->library('upload');
    }
/*COMIENZA LA CONSULTA DEL MODULO DE REGISTRO DE ESTUDIANTES*/

	public function index_estudiantes(){

		$dato['active'] = "estudiante"; 
		$dato['active1'] = "registro";
		$dato['ruta1'] = "Registro Estudiante";
		$dato['ruta'] = "Modulo Estudiante / Registro";

		$datos['municipios'] = $this->Estudiante_model->get_municipios();
		$datos['grado_estudios'] = $this->Estudiante_model->get_grado_estudios();

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/estudiante/registro', $datos);
        $this->load->view('global_view/foother');
	}
	public function guardar_estudiante(){

        if (isset($_FILES["img_estudiante"]["name"]) && $_FILES["img_estudiante"]["name"] != null  )  {
            
            $type = explode('.', $_FILES["img_estudiante"]["name"]);
            $type = $type[count($type)-1];
           
            date_default_timezone_set('America/Cancun');

            $date = date('H:i:s');
            $now = date('Y-m-d');

            $nombreEntero = $_FILES["img_estudiante"]["name"];

            $nombre = explode(".", $nombreEntero);

            $url = "./assets/imgs/usuarios/profil/".$nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.$type;
			$actualYear = date('Y');
			$estudianteYear = $this->input->post("year_fecha");
			$edad = $actualYear - $estudianteYear;

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
						'edad' => $edad,
						'sexo' => $this->input->post("sexo"),
						'correo' => $this->input->post("correo"),
						'tel_casa' => $this->input->post("tel_casa"),
						'tel_celular' => $this->input->post("tel_movil"),
						'lugar_nacimiento' => $this->input->post("lugar_nacimiento"),
						'colonia' => $this->input->post("colonia"),
						'localidad' => $this->input->post("localidad"),
						'id_municipio' => $this->input->post("id_municipio"),
						'domicilio' => $this->input->post("domicilio"),
						'cruzamiento_domicilio' => $this->input->post("cruzamientos"),
						'id_grado_estudio' => $this->input->post("id_grado_estudio"),
						'escuela' => $this->input->post("escuela"),
						'turno_horario' => $this->input->post("turno_horario"),
						'lengua_indigena' => $this->input->post("lengua_indigena"),
						'avatar'  => $nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.$type,
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
            }else{
                $result['resultado'] = false;
                echo json_encode($result);
            }
        }else{

            $fecha = $this->input->post("year_fecha").'-'.$this->input->post("mes_fecha").'-'.$this->input->post("dia_fecha");
			date_default_timezone_set('America/Cancun');
			$actualYear = date('Y');

			$estudianteYear = $this->input->post("year_fecha");
            $edad = $actualYear - $estudianteYear;
            
            $estudiante = array(
                        'codigo_joven' => $this->input->post("codigo"), 
                        'nombre' => $this->input->post("nombre"), 
                        'ap_pat' => $this->input->post("ape_pate"), 
                        'ap_mat' => $this->input->post("ape_mate"), 
                        'curp' => $this->input->post("curp"), 
                        'fecha_nacimiento' => $fecha,
                        'edad' => $edad,
                        'sexo' => $this->input->post("sexo"),
						'correo' => $this->input->post("correo"),
						'tel_casa' => $this->input->post("tel_casa"),
						'tel_celular' => $this->input->post("tel_movil"),
						'lugar_nacimiento' => $this->input->post("lugar_nacimiento"),
						'colonia' => $this->input->post("colonia"),
                        'localidad' => $this->input->post("localidad"),
                        'id_municipio' => $this->input->post("id_municipio"),
                        'domicilio' => $this->input->post("domicilio"),
                        'cruzamiento_domicilio' => $this->input->post("cruzamientos"),
                        'id_grado_estudio' => $this->input->post("id_grado_estudio"),
                        'escuela' => $this->input->post("escuela"),
                        'turno_horario' => $this->input->post("turno_horario"),
                        'lengua_indigena' => $this->input->post("lengua_indigena"),
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


	/*COMIENZA LA CONSULTA DEL MODULO DE LISTA DE ESTUDIANTES*/
	public function mostrar_lista_estudiante(){

		$cantidad = $this->input->post("cantidad");

		$data = array(

			"estudiante" => $this->Estudiante_model->buscarEstudiantes($cantidad),
			"totalregistros" => $this->Estudiante_model->cantidadEstudiantes(),
			"cantidad" =>$cantidad

		);

		echo json_encode($data);

	}
    public function lista_estudiantes($nropagina = FALSE){

        //DATOS PARA INDICAR EN QUE MODULO ESTA EL USUARIO O ADMINISTRADOR SE VAN AL HEADER
        $dato['active'] = "estudiante"; 
        $dato['active1'] = "lista";
        $dato['ruta1'] = "Lista Estudiantes";
        $dato['ruta'] = "Modulo Estudiante / Lista";

		$inicio = 0;
		$mostrarpor = 5;
		$buscador = "";
		if ($this->session->userdata("cantidad")) {
			$mostrarpor =  $this->session->userdata("cantidad");
		}
		if ($nropagina) {
			$inicio = ($nropagina - 1) * $mostrarpor;
		}

		if ($this->session->userdata("busqueda_codigo_joven")){

			$this->session->unset_userdata('nombre_busqueda');
			$this->session->unset_userdata('paterno_busqueda');

			$buscador = $this->session->userdata("busqueda_codigo_joven");
			$canditad_registro = $this->Estudiante_model->cantidadEstudiantes($buscador);
			$config['total_rows'] = $canditad_registro[0]->totalregistros;
		}
		elseif ($this->session->userdata("nombre_busqueda") && $this->session->userdata("paterno_busqueda")) {
			$this->session->unset_userdata('busqueda_codigo_joven');
			$buscador_nombre = $this->session->userdata("nombre_busqueda");
			$buscador_apelldo = $this->session->userdata("paterno_busqueda");
			$canditad_registroNP = $this->Estudiante_model->cantidadEstudiantesNP($buscador_nombre,$buscador_apelldo);
			$config['total_rows'] = $canditad_registroNP[0]->totalregistros;
		}else{
			$canditad_registroFree = $this->Estudiante_model->cantidadEstudiantesFree($buscador);
			$config['total_rows']  = $canditad_registroFree[0]->totalregistros;
		}
		$config['base_url'] = base_url()."lista-estudiantes/pagina/";

		$config['per_page'] = $mostrarpor;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['first_url'] = base_url()."lista-estudiantes";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='javascript:void(0)'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		if ($this->session->userdata("busqueda_codigo_joven") ){
			$data = array(
				"estudiantes" => $this->Estudiante_model->buscar($buscador,$inicio,$mostrarpor)
			);
		}
		elseif ($this->session->userdata("nombre_busqueda") && $this->session->userdata("paterno_busqueda") ){
			$data = array(
				"estudiantes" => $this->Estudiante_model->buscarNomAp($buscador_nombre,$buscador_apelldo,$inicio,$mostrarpor)
			);
		}else{
			$data = array(
				"estudiantes" => $this->Estudiante_model->buscarFree($inicio,$mostrarpor)
			);
		}

		$this->load->view('global_view/header', $dato);
		$this->load->view('admin/estudiante/lista', $data);
		$this->load->view('global_view/foother');

    }

	public function mostrar(){
		$this->session->unset_userdata('busqueda_codigo_joven');
		$this->session->unset_userdata('nombre_busqueda');
		$this->session->unset_userdata('paterno_busqueda');
		redirect(base_url()."lista-estudiantes");
	}
	public function delete_sessionNameApe(){
		$this->session->unset_userdata('nombre_busqueda');
		$this->session->unset_userdata('paterno_busqueda');
	}
	public function delete_sessionCJ(){
		$this->session->unset_userdata('busqueda_codigo_joven');
	}

	public function busqueda(){

		$this->session->set_userdata("busqueda_codigo_joven",$this->input->post("busqueda"));
		redirect(base_url()."lista-estudiantes");

	}
	public function busqueda_nombres(){

		$this->session->set_userdata("nombre_busqueda",$this->input->post("nombre"));
		$this->session->set_userdata("paterno_busqueda",$this->input->post("paterno"));
		redirect(base_url()."lista-estudiantes");

	}
	public function cantidad(){
		$this->session->set_userdata("cantidad",$this->input->post("cantidad"));
	}

    public function obtener_municipios(){
		$query = $this->Estudiante_model->get_municipios();
		echo json_encode($query);
	}
	public function obtener_grado_estudios(){
		$query = $this->Estudiante_model->get_grado_estudios();
		echo json_encode($query);
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

		date_default_timezone_set('America/Cancun');
		$actualYear = date('Y');
		$splitFecha = $this->input->post("fecha_nacimiento");

		$fecha1 = explode('-', $splitFecha);
		$edad = $actualYear - $fecha1[0];
        $estudiante = array(
            'codigo_joven' => $this->input->post("codigo"),
            'nombre' => $this->input->post("nombre"),
            'ap_pat' => $this->input->post("ape_pate"),
            'ap_mat' => $this->input->post("ape_mate"),
            'curp' => $this->input->post("curp"),
            'fecha_nacimiento' => $this->input->post("fecha_nacimiento"),
            'lugar_nacimiento' => $this->input->post("lugar_nacimiento"),
            'correo' => $this->input->post("correo"),
			'edad' => $edad,
			'sexo' => $this->input->post("sexo"),
			'tel_casa' => $this->input->post("tel_casa"),
			'tel_celular' => $this->input->post("tel_movil"),
			'colonia' => $this->input->post("colonia"),
			'localidad' => $this->input->post("localidad"),
			'id_municipio' => $this->input->post("id_municipio"),
			'domicilio' => $this->input->post("domicilio"),
			'cruzamiento_domicilio' => $this->input->post("cruzamientos"),
			'id_grado_estudio' => $this->input->post("id_grado_estudio"),
			'escuela' => $this->input->post("escuela"),
			'turno_horario' => $this->input->post("turno_horario"),
			'lengua_indigena' => $this->input->post("lengua_indigena"),
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
