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

// REPORTE POR RANGO DE DIAS 
	public function getReportePorRango($id_perador, $fechaInicio, $fechaFin){
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias
							FROM tab_cobros
							WHERE tab_cobros.id_operador = '".$id_perador."'
									and tab_cobros.fecha >= '".$fechaInicio."'
									and tab_cobros.fecha <= '".$fechaFin."' ");
		
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
				$date = $this->_getDateWithStringFormatRange($fechaInicio, $fechaFin);
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
	private function _getDateWithStringFormatRange($fechaInicio, $fechaFin){
		$month = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","NOVIEMBRE","DICIEMBRE"];

		$split = explode("-", $fechaInicio);
		$splitFin = explode("-", $fechaFin);

		return $split[2] ." de ".$month[intval($split[1]) - 1] ." de ".$split[0]. " / " .$splitFin[2] ." de ".$month[intval($splitFin[1]) - 1] ." de ".$splitFin[0];
	}


	public function getReportePorMonth($id_perador, $month, $year){
		
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias
							FROM tab_cobros
							WHERE tab_cobros.id_operador = '".$id_perador."'
									AND YEAR(tab_cobros.fecha) = '".$year."'
									AND MONTH(tab_cobros.fecha) = '".$month."' ");
		
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
				$date = $this->_getDateWithStringFormatYearAndMonth($month, $year);
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

	private function _getDateWithStringFormatYearAndMonth($monthh, $year){
		$month = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","NOVIEMBRE","DICIEMBRE"];

		return "Reporte de ".$month[$monthh - 1] ." de ".$year;
	}



	public function getReportePorYear($id_operador, $year){
		
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias
							FROM tab_cobros
							WHERE tab_cobros.id_operador = '".$id_operador."'
									AND YEAR(tab_cobros.fecha) = '".$year."' ");
		
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
				$date = $this->_getDateWithStringFormatYear($year);
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

	private function _getDateWithStringFormatYear($year){
	
		return "Reporte del ".$year;
	}
}