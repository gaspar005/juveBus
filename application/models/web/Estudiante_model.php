<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function get_list_estudiantes(){

        $this->db->select('*');
        $this->db->from('cat_usuarios');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
           return $query->result();
        }else{
           return false;
        }

    }   

    public function save_estudiante($estudiante){
    	 return $this->db->insert('cat_usuarios', $estudiante);
    }
    public function existeCodigoJoven($cj){

	    $query = $this->db->query("SELECT cat_usuarios.codigo_joven FROM cat_usuarios WHERE cat_usuarios.codigo_joven = '".$cj."' ");    
	  
	    if ($query->num_rows() > 0){
	       return  $query->result();
	    }else{
	       return false;
	    }
    }
    public function deshabilitarEstudiante($id){

        $deshabilitar = array('status' => 0);
        $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $deshabilitar);

    }
    public function habilitarEstudiante($id){

        $habilitar = array('status' => 1);
        $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $habilitar);
    }
    public function save_edit_estudiante($id, $estudiante){
               $this->db->where('id_usuario', $id);
        return $this->db->update('cat_usuarios', $estudiante);
    }

    /* metodo que obtiene los datos del estudiante para mostrarlos en el pdf enviado a su correo */
	public function get_estudiante_for_send_pdf($id_estudiante){
			$this->db->select('codigo_joven, nombre, ap_pat, ap_mat, curp');
			$this->db->where('id_usuario', $id_estudiante);
		return $this->db->get('cat_usuarios')->result();
	}

}

/* End of file Estudiante_model.php */
/* Location: ./application/models/Estudiante_model.php */
