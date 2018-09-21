<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login_model_api extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function authUser($codjoven){
	    $this->db->select("*");
		$this->db->from("cat_usuarios cu");
		$this->db->join("cat_sexo cs","cu.id_sexo = cs.id_sexo");
	    $this->db->join("cat_roles cr","cu.id_role = cr.id_role");
	    $this->db->where("cu.codigo_joven",$codjoven);

	    $query = $this->db->get();
	    if ($query->num_rows() > 0) {
	        return $query->result();
	    } else {
	        return false;
	    }
	}

}

/* End of file User_login_model_api.php */
/* Location: ./application/models/User_login_model_api.php */