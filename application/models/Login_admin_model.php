<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin_model extends CI_Model {

	public function __construct() {
      parent::__construct();
      $this->load->database();
      
   }

   public function loginUserAdmin($rfc){

   		$this->db->select("cat_user_sistem.id_user_sistem, cat_user_sistem.nombre, cat_user_sistem.ap_pat, cat_user_sistem.ap_mat, cat_user_sistem.rfc, cat_user_sistem.password, cat_roles.name");
        $this->db->from("cat_user_sistem");
        $this->db->join("cat_roles","cat_roles.id_role = cat_user_sistem.id_role");
        $this->db->where("cat_user_sistem.rfc = ", $rfc);
        $this->db->where("cat_user_sistem.status", 1);
        $query =  $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
   }

}

/* End of file Login_admin_model.php */
/* Location: ./application/models/Login_admin_model.php */