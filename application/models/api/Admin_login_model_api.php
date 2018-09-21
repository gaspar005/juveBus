<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login_model_api extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	public function authAdmin($rfc){
	    $query =  $this->db->query(" SELECT cat_user_sistem.id_user_sistem,cat_user_sistem.nombre, cat_user_sistem.ap_pat, cat_user_sistem.ap_mat, cat_user_sistem.rfc, cat_user_sistem.password ,
											 cat_roles.name
									 FROM cat_user_sistem, cat_roles
									WHERE cat_user_sistem.id_role = cat_roles.id_role
									      AND  cat_user_sistem.rfc = '".$rfc."'
									  ");
	    if ($query->num_rows() > 0) {
	        return $query->result();
	    } else {
	        return false;
	    }
	}
	

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */