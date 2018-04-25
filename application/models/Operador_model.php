<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operador_model extends CI_Model {

	public function __construct() {
      parent::__construct();
      $this->load->database();
      
   	}

   	public function get_list_operadores(){

   		$this->db->select('cat_operadores.id_operador, cat_operadores.nombre, cat_operadores.ap_pat, cat_operadores.ap_mat, cat_operadores.rfc, cat_operadores.status, cat_operadores.fecha_nacimiento');
   		$this->db->from('cat_operadores');
      $this->db->where('status', 1);

   		$query = $this->db->get();

   		if ($query->num_rows() > 0){

           return $query->result();

        }else{

           return false;
        }

   	}
    public function get_list_operadoresAll(){

      $this->db->select('cat_operadores.id_operador, cat_operadores.nombre, cat_operadores.ap_pat, cat_operadores.ap_mat, cat_operadores.rfc, cat_operadores.status, cat_operadores.fecha_nacimiento');
      $this->db->from('cat_operadores');

      $query = $this->db->get();

      if ($query->num_rows() > 0){

           return $query->result();

        }else{

           return false;
        }

    }
   	public function get_info_operador($id){

   		$this->db->select("cat_operadores.id_operador, cat_operadores.nombre, cat_operadores.ap_pat, cat_operadores.ap_mat, cat_operadores.codigo, cat_roles.name");
   		$this->db->from("cat_operadores");
   		$this->db->join("cat_roles", "cat_roles.id_role = cat_operadores.id_role");
   		$this->db->where("cat_operadores.id_operador", $id);

   		$query = $this->db->get();

   		if ($query->num_rows() > 0){
           return $query->result();
        }else{
           return false;
        }

   	}
    public function getYears(){

      $query = $this->db->query("SELECT YEAR(tab_cobros.fecha) as year FROM tab_cobros GROUP BY year");

      if ($query->num_rows() > 0){
           return $query->result();
        }else{
           return false;
        }
    }

    public function existeRFC($rfc){

      $this->db->select('rfc');
      $this->db->from('cat_operadores');
      $this->db->where('rfc', $rfc);

      $query = $this->db->get();       

      if ($query -> num_rows() > 0){

        return true;

      }else{
       return false;
      }

    }

    public function save_operador($operador){
         return $this->db->insert('cat_operadores', $operador);
    }
   	
    public function save_edit_operador($id, $operador){
      $this->db->where('id_operador', $id);
      return $this->db->update('cat_operadores', $operador);
    }
    public function habilitarOperador($id){
      $deshabilitar = array('status' => 1);
      $this->db->where('id_operador', $id);
      return $this->db->update('cat_operadores', $deshabilitar);
    }
    public function deshabilitarOperador($id){

      $deshabilitar = array('status' => 0);
      $this->db->where('id_operador', $id);
      return $this->db->update('cat_operadores', $deshabilitar);
    }

}

/* End of file Operador_model.php */
/* Location: ./application/models/Operador_model.php */