<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
    }
	public function get_municipios(){

		$this->db->select('*');
		$this->db->from('cat_municipios');
		return $this->db->get()->result();

	}
	public function get_grado_estudios(){

		$this->db->select('*');
		$this->db->from('cat_grado_estudio');
		return $this->db->get()->result();

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

	  	$this->db->select('codigo_joven');
	  	$this->db->from('cat_usuarios');
	  	$this->db->where('codigo_joven', $cj);
		$query = $this->db->get();
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
	public function get_estudiante_header_email_pdf($id_estudiante){

		$query = $this->db->query(" SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.correo,
											cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo, rs.fecha, rs.hora, rs.id_h_pago
									FROM cat_usuarios cu 
										  inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) 
										  inner join tab_recargas_de_saldo rs on (cu.id_usuario = rs.id_usuario) 
									where cu.id_usuario = $id_estudiante ORDER BY rs.id_h_pago DESC LIMIT 1 ");
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}

	}

}

/* End of file Estudiante_model.php */
/* Location: ./application/models/Estudiante_model.php */
