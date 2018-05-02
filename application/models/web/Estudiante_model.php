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

}

/* End of file Estudiante_model.php */
/* Location: ./application/models/Estudiante_model.php */