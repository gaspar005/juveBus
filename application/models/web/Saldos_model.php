<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldos_model extends CI_Model {

	public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function buscar($status, $nombre, $ap_pat, $ap_mat = FALSE, $inicio = FALSE, $cantidadregistro = FALSE){

	$query = "SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) where cu.nombre LIKE '%".$nombre."%'  AND cu.ap_pat LIKE '%".$ap_pat."%' AND cu.status = $status ";

    if ($ap_mat != FALSE) {
    	$cardena = "AND cu.ap_mat LIKE '%".$ap_mat."%' ";
    	$query = $query.$cardena;
    }

    if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
    	$limite = "LIMIT $cantidadregistro";
    	$query = $query.$limite;
    }

    $consulta =  $this->db->query($query);;

	if ($consulta->num_rows() > 0){
		return $consulta->result();
	}else{
		return false;
	}
  }
  public function inserta_saldo_estudiante($id_user_sistem, $id_usuario, $saldo,  $date, $now){
		$recarga_saldo = array(
			'id_user_sistem' => $id_user_sistem,
			'id_usuario' => $id_usuario,
			'importe' => $saldo,
			'fecha' => $now,
			'hora' => $date
		);
		return $this->db->insert('tab_recargas_de_saldo', $recarga_saldo);
  }
  public function body_info_send_email_estudiante($id_estudiante){

	$query = $this->db->query("SELECT cu.id_usuario, cu.nombre , cu.ap_pat, cu.codigo_joven, cu.ap_mat, cu.curp, cu.fecha_nacimiento, cu.lugar_nacimiento, cu.lugar_residencia ,sd.saldo FROM cat_usuarios cu inner join cat_saldos sd on (cu.id_usuario = sd.id_usuario) where cu.nombre = $id_estudiante ");
	  if ($query->num_rows() > 0){
		  return $query->result();
	  }else{
		  return false;
	  }
  }

}

/* End of file Saldos_model.php */
/* Location: ./application/models/web/Saldos_model.php */
