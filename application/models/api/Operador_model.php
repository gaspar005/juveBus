<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operador_model extends CI_Model {

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

	public function save_pay($codJoven,$idOperador,$latidud,$longitud){
		$userData = $this->getIdUser($codJoven); 
		$idUser = $userData[0]->id_usuario; 
		$nombreUser = $userData[0]->nombre." ".$userData[0]->ap_pat." ".$userData[0]->ap_mat;
		$pago = $this->getTarifa(); //se obtiene la tarifa vigente
		if (!is_null($idUser) && !is_null($pago)) {
			$saldo = $this->getSaldoUser($idUser);
			
			//SI EL USUARIO NO ESTÁ EN LA TABLA DE SALDO
			//ENTONCES
			//SU SALDO SE INICIALIZA EN CEROS 0
			if (is_null($saldo)) {
				$saldo = "0";
			}

			if ($saldo != null) {
				
				$saldoRestante = floatval($saldo) - floatval($pago);

				if ($saldoRestante < 0) {
					$msj = "Saldo insuficiente para realizar el pago";
					$transactionComplete = false;
					return $this->_setResponse($msj,$saldo,$nombreUser,$codJoven,$pago,$transactionComplete);
				}else{

					$data = $this->_setPago($pago,$idUser,$idOperador, $saldoRestante,$latidud,$longitud);
			
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
						return $this->_setResponse($msj,$saldoRestante,$nombreUser,$codJoven,$pago,$transactionComplete);
					}
				 	return null;
				}
			}

			return null;
		}
		return null;
	}

	private function _setPago($pago,$idUser,$idOperador,$saldoRestante,$latidud,$longitud){
		$currentDateTime = $this->getCurrentDateTime();
		$fecha = $currentDateTime['date'];
		$hora  = $currentDateTime['time'];
		$timeStamp = $fecha." ".$hora;
		return array(
				'id_usuario' 	=> $idUser,
		 		'id_operador' 	=> $idOperador,
		 		'cobro' 		=> $pago,
		 		'saldo' 		=> $saldoRestante,
		 		'latitud'		=> $latidud,
		 		'longitud'		=> $longitud,
		 		'fecha' 		=> $fecha,
		 		'hora'  		=> $hora,
		 		'created'       => $timeStamp);
	}

	private function _setResponse($msj, $saldo, $nombreUser, $codJoven, $pago, $transactionComplete){
		return array('msj' 					=> $msj,
					'saldo'					=> $saldo,
					'nombre' 				=> $nombreUser,
					'codJoven' 				=> $codJoven,
					'tarifa'				=> $pago,
					'transactionComplete'	=> $transactionComplete);
	}

	//se obtiene los datos del usuario en base a su código joven
	public function getIdUser($codJoven){
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

	private function getCurrentDateTime(){
		$date = mdate('%Y-%m-%d', time());
		$time = mdate('%H:%i:%s', time());
		return array('date' => $date,
					 'time' => $time);
	}

	public function getTarifa(){
		$queryTarifa = $this->db->query("SELECT * FROM cat_settings WHERE cat_settings.id_settings = 1");
		if ($queryTarifa->num_rows() > 0) {
			$tarifa = $queryTarifa->result();

			return $tarifa[0]->valor;
		}

		return null;
	}

	public function updateLatLng($id_bus,$data){
		$this->db->where('id_bus', $id_bus);
		return $this->db->update('cat_buses', $data);
	}
}

/* End of file Pagos_model.php */
/* Location: ./application/models/Pagos_model.php */