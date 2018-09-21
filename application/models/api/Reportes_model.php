<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}

	public function getReportePorDia($id_perador, $fecha){
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias
							FROM tab_cobros
							WHERE tab_cobros.id_operador = ".$id_perador."
							and tab_cobros.fecha = '".$fecha."'");
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			if ($queryTotales->num_rows() === 1) {

				$queryTotales = $queryTotales->result();

				if (intval($queryTotales[0]->pasajeros) > 0) {
					$tarifa = floatval($queryTotales[0]->ganancias) / intval($queryTotales[0]->pasajeros);
				}else{
					$tarifa = 0;
				}
				$date = $this->_getDateWithStringFormat($fecha);
				if ( intval($queryTotales[0]->pasajeros) > 0) {
				
					$data = array('hayPasajeros' => TRUE,
								  'pasajeros' => $queryTotales[0]->pasajeros,
								  'ganancias' => $queryTotales[0]->ganancias,
								  'tarifa' => $tarifa,
								  'fecha' => $date);
					
					return $data;
				}else{
					return array('hayPasajeros' => false,
								'pasajeros' => 'No hay pasajeros en esta fecha',
							  	'ganancias' => 0,
							  	'tarifa' => '0',
							  	'fecha' => $date);
				}
			}
			
		}

		return null;
	}

	private function _getDateWithStringFormat($fecha){
		$month = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","NOVIEMBRE","DICIEMBRE"];

		$split = explode("-", $fecha);

		return $split[2] ." de ".$month[intval($split[1]) - 1] ." de ".$split[0];
	}
	public function getTarifa(){
		$queryTarifa = $this->db->query("SELECT * FROM cat_settings WHERE cat_settings.id_settings = 1");
		if ($queryTarifa->num_rows() > 0) {
			return $queryTarifa->result();
		}

		return null;
	}

}

/* End of file Reportes_model.php */
/* Location: ./application/models/Reportes_model.php */