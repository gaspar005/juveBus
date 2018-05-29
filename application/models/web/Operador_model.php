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

      $this->db->select('*');
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

	// REPORTES
	// DIA
	public function getReportePorDia($id_perador, $fecha){
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias, cat_operadores.correo
							FROM tab_cobros, cat_operadores
							WHERE tab_cobros.id_operador = '".$id_perador."' and  tab_cobros.id_operador = cat_operadores.id_operador
							and tab_cobros.fecha = '".$fecha."' ");

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
						'fecha' => $date,
						'correo' => $queryTotales[0]->correo,
					);

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
	// RANGO
	public function getReportePorRango($id_perador, $fechaInicio, $fechaFin){
		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias, cat_operadores.correo
							FROM tab_cobros, cat_operadores
							WHERE tab_cobros.id_operador = '".$id_perador."' and  tab_cobros.id_operador = cat_operadores.id_operador
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
						'fecha' => $date,
						'correo' => $queryTotales[0]->correo
					);
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

		return $split[2] ." de ".$month[intval($split[1]) - 1] ." de ".$split[0]. " al " .$splitFin[2] ." de ".$month[intval($splitFin[1]) - 1] ." de ".$splitFin[0];
	}
	// MES
	public function getReportePorMonth($id_perador, $month, $year){

		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias , cat_operadores.correo
							FROM tab_cobros, cat_operadores
							WHERE tab_cobros.id_operador = '".$id_perador."' and  tab_cobros.id_operador = cat_operadores.id_operador
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
						'fecha' => $date,
						'correo' => $queryTotales[0]->correo
					);

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

		return " ".$month[$monthh - 1] ." de ".$year;
	}
	// AÑO
	public function getReportePorYear($id_operador, $year){

		$this->db->trans_start();
		$queryTotales = $this->db->query("SELECT COUNT(tab_cobros.cobro) as pasajeros, sum(tab_cobros.cobro) as ganancias, cat_operadores.correo
							FROM tab_cobros, cat_operadores 
							WHERE tab_cobros.id_operador = '".$id_operador."' and  tab_cobros.id_operador = cat_operadores.id_operador
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
						'fecha' => $date,
						'correo' => $queryTotales[0]->correo
					);

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
		return " del ".$year;
	}
}

/* End of file Operador_model.php */
/* Location: ./application/models/Operador_model.php */
