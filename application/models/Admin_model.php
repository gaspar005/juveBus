<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function altaSaldo($idUsuario,$importe,$dataRecargas,$currentDateTime){

		$this->db->trans_start();
			$this->db->insert('tab_recargas_de_saldo', $dataRecargas);
			$query = $this->db->query("SELECT * FROM cat_saldos WHERE cat_saldos.id_usuario = ".$idUsuario);
			//si se encontraron registros en la tabla cat_saldos se actualiza el saldo
			if ($query->num_rows() > 0) {
				$queryCat_saldo = $query->result();
				$saldo = $queryCat_saldo[0]->saldo;
				$nuevoSaldo = floatval($saldo) + floatval($importe);
				$this->db->set('saldo', $nuevoSaldo);
				$this->db->where('id_usuario', $idUsuario);
				$this->db->update('cat_saldos');
			}else{
				$dataCatSaldos = $this->_dataFormatCatSaldos($idUsuario,$importe,$currentDateTime);
				$this->db->insert('cat_saldos', $dataCatSaldos);
			}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}else{
			return true;
		}

	}

	private function _dataFormatCatSaldos($idUsuario,$importe,$currentDateTime){
		return array('id_usuario' => $idUsuario,
					 'saldo'=>$importe,
					 'fecha_creacion' =>$currentDateTime['created']);
	}

	//se obtiene los datos del usuario en base a su código joven
	public function getUserData($codJoven){
		$this->db->select('cu.id_usuario, cu.nombre, cu.ap_pat, cu.ap_mat, cu.codigo_joven,cu.avatar, cs.saldo');
		$this->db->from('cat_usuarios cu');
		$this->db->join('cat_saldos cs','cu.id_usuario = cs.id_usuario');
		$this->db->where('cu.codigo_joven',$codJoven);
		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			$idUser = $query->result();
			return $idUser;
		}

		return null;
	}

	public function getSomeOperatorData(){
		$this->db->select("co.id_operador,co.nombre,co.ap_pat,co.ap_mat,co.rfc,co.telefono,co.avatar");
		$this->db->from("cat_operadores co");
		$this->db->order_by("co.nombre");

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}

	// public function _getIdUser(){
	// 	$this->db->select("cat_usuarios.id_usuario");
	// 	$this->db->from("cat_usuarios");
	// 	$this->where("cat_usuarios")
	// }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */