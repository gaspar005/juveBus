<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_model extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}

	public function get($id = null){
		if (! is_null($id)) {
			$this->db->select("*");
			$this->db->from("tab_cobros");
			$this->db->where("id_cobro",$id);

			$query = $this->db->get();
			if ($query->num_rows() === 1) {
				return $query->row_array();
			}
			return null;
		}

	//SI NO SE TIENE UN ID SE DEVUELVEN TODOS LOS REGISTRO DE LA TABLA
		$this->db->select("*");
		$this->db->from("tab_cobros");
		
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return null;
	}

	public function save($pago,$codJoven,$idOperador){
		$userData = $this->getIdUser($codJoven);
		$idUser = $userData[0]->id_usuario;
		$nombreUser = $userData[0]->nombre." ".$userData[0]->ap_pat." ".$userData[0]->ap_mat;
		if ($idUser != null) {
			$saldo = $this->getSaldoUser($idUser);
			
			if ($saldo != null) {
				$saldoRestante = floatval($saldo) - floatval($pago);

				if ($saldoRestante < 0) {
					$msj = "Saldo insuficiente para realizar el pago";
					$transactionComplete = false;
					return $this->_setResponse($msj,$saldo,$nombreUser,$codJoven, $transactionComplete);
				}else{

					$data = $this->_setPago($pago,$idUser,$idOperador);
			
				 	$this->db->trans_start();
					$this->db->insert("tab_cobros",$data);
					$this->db->set('saldo', $saldoRestante);
					$this->db->where('id_usuario', $idUser);
					$this->db->update('cat_saldos');
					$this->db->trans_complete();

					if ($this->db->trans_status() === TRUE)
					{
						$msj = "El cobro se realizó correctamente";
						$transactionComplete = true;
						return $this->_setResponse($msj,$saldoRestante,$nombreUser,$codJoven,$transactionComplete);
					}
				 	return null;
				}
			}

			return null;
		}
		return null;
	}

	private function _setPago($pago,$idUser,$idOperador){
		return array(
				'id_usuario' => $idUser,
		 		'id_operador' => $idOperador,
		 		'cobro' => $pago);
	}

	private function _setResponse($msj, $saldo, $nombreUser, $codJoven, $transactionComplete){
		return array('msj' 					=> $msj,
					'saldo'					=> $saldo,
					'nombre' 				=> $nombreUser,
					'codJoven' 				=> $codJoven,
					'transactionComplete'	=> $transactionComplete);
	}

	private function getIdUser($codJoven){
		$this->db->select('id_usuario, nombre, ap_pat, ap_mat');
		$this->db->from('cat_usuarios');
		$this->db->where('codigo_joven',$codJoven);
		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			$idUser = $query->result();
			return $idUser;
		}

		return null;
	}

	private function getSaldoUser($idUser){
		$this->db->select('saldo');
		$this->db->from('cat_saldos');
		$this->db->where('id_usuario',$idUser);

		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			$saldo = $query->result();
			return $saldo[0]->saldo;
		}

		return null;
	}
}

/* End of file Pagos_model.php */
/* Location: ./application/models/Pagos_model.php */