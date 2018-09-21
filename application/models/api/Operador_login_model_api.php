<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operador_login_model_api extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function authOperator($rfc){
	    $this->db->select("co.id_operador,co.nombre,co.ap_pat,co.ap_mat,co.rfc,co.password,cr.name,cb.id_bus");
	    $this->db->from("cat_operadores co");
	    $this->db->join("cat_roles cr","co.id_role = cr.id_role");
	    $this->db->join("cat_buses cb","co.id_bus = cb.id_bus");
	    $this->db->where("co.rfc",$rfc);
	    $this->db->where("co.status",1);

	    $query = $this->db->get();
	    if ($query->num_rows() > 0) {
	        return $query->result();
	    } else {
	        return false;
	    }
	}

}

/* End of file Operador_login_model_api.php */
/* Location: ./application/models/Operador_login_model_api.php */