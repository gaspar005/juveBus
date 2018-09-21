<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes_model extends CI_Model
{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function mostrar(){
		$this->db->select('*');
		$consulta = $this->db->get("cat_settings");
		return $consulta->result();
	}
	public function actualizar($id,$data){
		$this->db->where('id_settings', $id);
		$this->db->update('cat_settings', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
}
