<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldos_model extends CI_Model {

	public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function buscar($status, $nombre, $ap_pat, $ap_mat = FALSE, $inicio = FALSE, $cantidadregistro = FALSE){

    $this->db->select('cat_usuarios.id_usuario, cat_usuarios.codigo_joven, cat_usuarios.nombre, cat_usuarios.ap_pat, cat_usuarios.ap_mat, cat_usuarios.curp, cat_usuarios.fecha_nacimiento, cat_usuarios.lugar_nacimiento, cat_usuarios.lugar_residencia, cat_saldos.saldo');
    $this->db->from('cat_usuarios');
    $this->db->join('cat_saldos', 'cat_saldos.id_usuario =  cat_usuarios.id_usuario');
    $this->db->where('cat_usuarios.status', $status);
    $this->db->like('cat_usuarios.nombre', $nombre);
    $this->db->like('cat_usuarios.ap_pat', $ap_pat);

    if ($ap_mat != FALSE) {
      $this->db->like('cat_usuarios.ap_mat', $ap_mat);

    }
  
    if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
      $this->db->limit($cantidadregistro,$inicio);
    }

    $consulta = $this->db->get();
    var_dump($consulta->result());
    return $consulta->result();
  }


}

/* End of file Saldos_model.php */
/* Location: ./application/models/web/Saldos_model.php */